<?php
session_start();
$user = $_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header('Location: auth');
    exit();
}

$errors = '';

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();
$adminId = $result['id'];
if (!$result) {
    header('Location: ../auth');
    exit();
}

if ($result['rank'] !== 'admin') {
    header('Location: ../ban.php');
    exit();
} 

function getJSONData($filename) {
    $jsonData = file_get_contents($filename);
    return json_decode($jsonData, true);
}

function saveJSONData($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

$filename = '../content.json';
$data = getJSONData($filename);

$date = new DateTime('now', new DateTimeZone('GMT'));
$formattedDate = $date->format('d/m/Y H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['articleId']) && isset($_POST['select'])) {
        $articleId = $_POST['articleId'];
        $status = $_POST['select'];
        $reason = $_POST['reason'];

        foreach ($data['users'] as &$euser) {
            foreach ($euser['articles'] as $key => &$article) {
                if ($article['articleId'] == $articleId) {
                    $articleOwner = $euser['id'];
                    if ($status == "no_approve") {
                        $articleId = $article['articleId'];
                        $articleName = $article['articleName'];
                        $articleImg = $article['img'];
                        $articleCategory = $article['category'];
                        $articleFile = "download/" . $articleId . ".zip";
                        $articleJson = $euser['articles'][$key];

                        $fileName = "things/$articleCategory/$articleName+$articleId.php";
                        if (unlink($fileName)) {
                            echo "The article was deleted correctly, please check.";
                        }
                    
                        if (file_exists($articleImg)) {
                            if (unlink($articleImg)) {
                                echo "Img deleted correctly.";
                            }
                        }
                        if (file_exists($articleFile)) {
                            if (unlink($articleFile)) {
                                echo "File deleted correctly.";
                            }
                        }
                        $webhookUrl = getenv("adminNotApprovedWebhook");
                        $message = [
                            'username'   => 'Admin log | Hexamarket',
                            'avatar_url' => 'https://www.hexamarket.store/assets/media/logo.webp',
                            'embeds'     => [
                                [
                                    'title'       => 'User articles ***NOT*** **APPROVATED** Log',
                                    'description' => "- **Admin:** $user ($adminId)\n"
                                                    . "- **Article owner user id:** $articleOwner\n"
                                                    . "- **Date:** $formattedDate\n"
                                                    . "- **Reason:** $reason\n",
                                    'color'       => hexdec('ff3d3d'),
                                    'footer'      => [
                                        'text' => 'Article not approvation admin log',
                                    ],
                                    'timestamp'   => date('c'),
                                ],
                            ],
                            'content'    => "<@&1261705881834487983>\n```json\n " . json_encode($articleJson, JSON_PRETTY_PRINT) . "\n```",
                        ];
                        
                        $jsonPayload = json_encode($message);

                        $ch = curl_init($webhookUrl);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    
                        $response = curl_exec($ch);
                        curl_close($ch);
                        unset($euser['articles'][$key]);
                    } else {
                        $article['status'] =  [
                            "$user",
                            "$adminId",
                            "$reason",
                            "$formattedDate"
                        ];
                        $webhookUrl = getenv("adminApprovedWebhook");
                        $message = [
                            'username'   => 'Admin log | Hexamarket',
                            'avatar_url' => 'https://www.hexamarket.store/assets/media/logo.webp',
                            'embeds'     => [
                                [
                                    'title'       => 'User articles **APPROVATED** Log',
                                    'description' => "- **Admin:** $user ($adminId)\n"
                                                    . "- **Article owner user id:** $articleOwner\n"
                                                    . "- **Date:** $formattedDate\n"
                                                    . "- **Reason:** $reason\n",
                                    'color'       => hexdec('07cc00'),
                                    'footer'      => [
                                        'text' => 'Article approvation admin log',
                                    ],
                                    'timestamp'   => date('c'),
                                ],
                            ],
                            'content'    => "<@&1261705948825649224>",
                        ];
                        
                        $jsonPayload = json_encode($message);

                        $ch = curl_init($webhookUrl);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    
                        $response = curl_exec($ch);
                        curl_close($ch);
                    }
                    break 2;
                }
            }
        }

        foreach ($data['users'] as &$euser) {
            $euser['articles'] = array_values($euser['articles']);
        }

        saveJSONData($filename, $data);

        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <title>Approvement</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');
        body {
            font-family: "Poppins", sans-serif;
        }
        body h2 {
            font-size: 20px;
        }
        body p {
            font-size: 15px;
        }
        .article {
            background: #efefef;
            border: 1px #d9d9d9 solid;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            position: relative;
        }
        .article img {
            border-radius: 16px;
            height: 200px;
        }
        .information {
            margin-left: 20px;
            margin-top: -10px;
        }
        .tag {
            background: white;
            border: #d9d9d9 solid 1px;
            padding: 2px;
            border-radius: 10px;
        }
        .buttons {
            position: absolute;
            right: 20px;
        }
        .buttons button {
            font-family: "Poppins", sans-serif;
            background: #cdcdcd;
            padding: 5px;
            border-radius: 10px;
            margin-left: 10px;
            border: none;
            cursor: pointer;
            border: solid 1px #cdcdcd;
        }
        .buttons button:hover {
            border: solid 1px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
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
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #555;
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
    <div class="articles">
        <?php foreach ($data['users'] as $euser): ?>
            <?php foreach ($euser['articles'] as $article): ?>
                <?php if (is_null($article['status'])): ?>
                <?php if(htmlspecialchars($article['category']) == "wd"){
                        $category = "Web development";
                    } else if(htmlspecialchars($article['category']) == "mc"){
                        $category = "Minecraft";
                    } else if(htmlspecialchars($article['category']) == "dcb"){
                        $category = "Discord bots";
                    } else if(htmlspecialchars($article['category']) == "fivem"){
                        $category = "FiveM";
                    } else{
                        $category = "Not found, please contact a developer. Send a screenshot.";
                    }?>
                    <div class="article">
                        <img src="<?= htmlspecialchars($article['img']) ?>" alt="<?= htmlspecialchars($article['articleName']) ?>">
                        <div class="information">
                            <h2><?= htmlspecialchars($article['articleName']) ?></h2>
                            <p><strong>Category:</strong> <?= $category ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($article['date']) ?></p>
                            <p><strong>File:</strong> <a href="<?= htmlspecialchars($article['file'])?>" target="_blank">Download</a></p>
                            <p class='tags'><strong>Tags:</strong>
                            <?php foreach ($article['tags'] as $tag) {
                                echo "<span class='tag'>" . htmlspecialchars($tag) . "</span> ";
                            }
                            echo "</p>";?>
                        </div>
                        <div class="buttons">
                            <button onclick="openLink('/things/<?= $article['category'] ?>/<?= $article['articleName'] ?>+<?= $article['articleId'] ?>')">View</button>
                            <button class="modalBtn" data-articleid="<?= $article['articleId'] ?>">Set a status</button>
                        </div>
                        <div id="modal<?= $article['articleId'] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" data-articleid="<?= $article['articleId'] ?>">&times;</span>
                                <form method="post">
                                    <input type="hidden" name="articleId" value="<?= $article['articleId'] ?>">
                                    <select name="select" required>
                                        <option value="approve">Approve</option>
                                        <option value="no_approve">Don't approve</option>
                                    </select>
                                    <input type="text" name="reason" id="reason" required>
                                    <button type="submit">Set Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <script>
        let modalBtns = document.querySelectorAll(".modalBtn");
        modalBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                let articleId = btn.getAttribute("data-articleid");
                let modal = document.getElementById("modal" + articleId);
                modal.style.display = "block";
            });
        });

        let closeBtns = document.querySelectorAll(".close");
        closeBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                let articleId = btn.getAttribute("data-articleid");
                let modal = document.getElementById("modal" + articleId);
                modal.style.display = "none";
            });
        });

        window.onclick = function(event) {
            if (event.target.className === "modal") {
                event.target.style.display = "none";
            }
        };

        function openLink(url) {
            window.open(url, '_blank');
        }
    </script>
</body>
</html>
