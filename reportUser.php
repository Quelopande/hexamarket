<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            width: 80%;
            border-radius: 16px;
        }
        .modal-content .close {
            font-weight: 600;
        }
        .modal-content .submit {
            background-color: #d4d4d473;
            font-weight: 400;
        }
        .modal-content .submit:hover {
            background-color: #d4d4d4da;
        }
        .modal-content .submit:active {
            background-color: #bcbcbc;
        }
        .inModalBtn {
            padding: 8px;
            border-radius: 16px;
            cursor: pointer;
            border: none;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
        }
        #modalBtn {
            background: #ff6060;
            display: block;
            position: absolute;
            right: 20px;
            width: 100px;
            text-align: center;
            border-radius: 200px;
            color: white;
        }
        .modal input, .modal select, .modal option {
            width: 98%;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            padding: 10px;
            border: none;
            border-radius: 16px;
            background-color: #e3e3e3;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<p id="modalBtn" class="last"><i class="fa-solid fa-shield"></i> Report</p>
<div id="modal" class="modal">
    <div class="modal-content">
        <h2>Report</h2>
        <p>Please do not send fake reports. Please select the option that describes the report reason. If you don't find an option, select "Other" and specify your reason.</p>
        <form method="post">
            <select id="report" name="select">
                <option value="s">Spam</option>
                <option value="im">Inappropriate media</option>
                <option value="spi">Share private information</option>
                <option value="ubw">Use bad words</option>
                <option value="ube">User ban evasion</option>
                <option value="ms">Mention suicide</option>
                <option value="sdoaig">Selling drugs or another illegal goods</option>
                <option value="aoh">Abuse or harassment</option>
                <option value="hs">Hate speech</option>
                <option value="t">Threats</option>
                <option value="sf">Start fights</option>
                <option value="d">Doxing (publishing private personal information)</option>
                <option value="ub">Use of bots</option>
                <option value="if">Identity fraud</option>
                <option value="o">Other reason</option>
            </select>
            <br>
            <input type="text" id="other" name="other" style="display: none;" placeholder="Other reason">
            <br>
            <a class="close last inModalBtn">Back</a>
            <button class="last submit inModalBtn" type="submit" name="changepassword"><i class="fa-solid fa-shield"></i> Report</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("modalBtn").onclick = function() {
        document.getElementById("modal").style.display = "block";
    };
    
    let selectElement = document.getElementById("report");
    let other = document.getElementById("other");
    if (selectElement) {
        selectElement.addEventListener("change", function() {
            let selectedOption = selectElement.options[selectElement.selectedIndex];
            let selectedValue = selectedOption.value;
    
            if (selectedValue === 'o') {
                other.style.display = "block";
                other.required = true;
            } else {
                other.style.display = "none";
            }
        });
    }
</script>
<script>
    let modal = document.getElementById("modal");
    let btn = document.getElementById("modalBtn");
    let close = document.querySelectorAll(".close");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    close.forEach(function(element) {
        element.addEventListener("click", function() {
            modal.style.display = "none";
        });
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and process form input
    $select = filter_var(strtolower($_POST['select']), FILTER_SANITIZE_STRING);
    $description = "";

    if ($select == 'o') {
        $other = filter_var(strtolower($_POST['other']), FILTER_SANITIZE_STRING);
        $description = $other;
    } else {
        $reasons = array(
            "s" => "Spam",
            "im" => "Inappropriate media",
            "spi" => "Share private information",
            "ubw" => "Use bad words",
            "ube" => "User ban evasion",
            "ms" => "Mention suicide",
            "sdoaig" => "Selling drugs or another illegal goods",
            "aoh" => "Abuse or harassment",
            "hs" => "Hate speech",
            "t" => "Threats",
            "sf" => "Start fights",
            "d" => "Doxing (publishing private personal information)",
            "ub" => "Use of bots",
            "if" => "Identity fraud"
        );
        $realName = isset($reasons[$select]) ? $reasons[$select] : 'Unknown reason';
        $description = $realName;
    }

    // Get current URL
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $url = $protocol . $host . $requestUri;

    // Prepare data for the JSON file
    $reportData = array(
        "select" => $select,
        "description" => $description,
        "url" => $url,
        "admin" => null,
        "timestamp" => date("c")
    );

    $currentData = file_get_contents('../../userReports.json');
    $currentDataArray = json_decode($currentData, true);
    $currentDataArray['userReports'][] = $reportData;
    $jsonData = json_encode($currentDataArray, JSON_PRETTY_PRINT);
    file_put_contents('../../userReports.json', $jsonData);

    // Prepare data for Discord webhook
    $title = basename(parse_url($requestUri, PHP_URL_PATH));
    $webhookUrl = "https://discord.com/api/webhooks/1254007171918725120/E_U8s3KXCeFf897_VJcCmqsyJ7tvIr7PPS2xVR6r5AgjhkXxZ32J49NWBvKfI2_bpaQj";
    $embed = array(
        "title" => $title,
        "description" => $description,
        "url" => $url,
        "color" => hexdec("ffffff"),
        "footer" => array(
            "text" => "Hexamarket | Content reports System",
            "icon_url" => "https://www.hexamarket.store/assets/media/logo.webp"
        ),
        "timestamp" => date("c")
    );
    $username = "Hexamarket - Content report form";
    $avatarUrl = "https://www.hexamarket.store/assets/media/logo.webp";

    function sendDiscordEmbed($webhookUrl, $embed, $username = "Webhook Bot", $avatarUrl = null) {
        $data = array(
            "username" => $username,
            "embeds" => array($embed)
        );
        if ($avatarUrl) {
            $data["avatar_url"] = $avatarUrl;
        }
        $json_data = json_encode($data);
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }

    // Send the report to Discord
    $response = sendDiscordEmbed($webhookUrl, $embed, $username, $avatarUrl);

    // Redirect back to the same page with the success message
    echo "<script>
    let btn = document.querySelector('button'); // Change 'button' to your button selector if needed
    btn.style.background = 'green';
    btn.textContent = 'Reported';
    btn.onclick = function() {
        let modal = document.querySelector('#modal'); // Change '#modal' to your modal selector if needed
        modal.style.display = 'none';
    }
    </script>";
}
?>
