<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post something</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Post">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
    <body class="body">
        <style>
            .out{
                position: absolute;
                right: 10px;
                left: 400px;
                margin-top: 40px;
                bottom: 20px ;
            }
            .out h1{
                font-size: 60px;
            }
            .form{
                background-color: var(--background-secundary);
                color: var(--secondary-txt-color);
                padding: 20px;
                padding-left: 40px;
                padding-right: 40px;
                border-radius: 30px;
            }
            form input,textarea,select{
                display: block;
                font-family: "Poppins", sans-serif;
                font-size: 16px;
                border-radius: 16px;
                padding: 7px;
                background: var(--background-primary);
                color: var(--standard-txt-color);
                border: solid 1px;
                width: 100%;
            }
            select{
            }
            form input,textarea,select:focus{
                outline: none;
            }
            .btn{
                margin-top: 40px;
                font-family: "Poppins", sans-serif;
                font-size: 16px;
                border: 2px solid black;
                color: black;
                background-color: white;
                box-shadow: 0px 6px 0px 0px #000;
                font-weight: 600;
                border-radius: 100px;
                padding: 10px;
                width: 100%;
                margin-bottom: 40px !important;
            }
            .btn:hover{
                border: 2px solid black;
                box-shadow: 0px 4px 0px 0px #000;
                transition: all ease-in-out 0.15s;
            }
            .btn:active{
                box-shadow: 0px 0px 0px 0px #000;
                transition: all ease-in-out 0.05s;
            }
            .hide{
                display: none;
            }
            .upload {
                width: 100%;
                background-color: var(--background-tertiary);
                border-radius: 20px;
                padding-top: 5px;
                padding-bottom: 25px;
            }
            .buttons {
                display: flex;
                border-bottom: 2px dotted;
                margin-bottom: 20px;
            }
            .upload #priceNull, .upload #priceSet {
                padding: 10px;
                background: var(--standard-txt-color-opposite);
                margin-left: 20px;
                margin-right: 20px;
                width: 50%;
                text-align: center;
                font-weight: 400;
                border-radius: 14px;
                cursor: pointer;
            }
            .activated input {
                cursor: pointer;
                width: 99%;
            }
            .sections > .section:last-of-type{
                background: red;
            }
            button{
                font-family: "Poppins", sans-serif;
                border: none;
                border-radius: 100px;
                padding: 7px 14px 7px 14px;
                font-size: 14px;
                margin-top: 20px;
            }
            @media (min-width: 837px) {
                .util{display: none;}
                .out{
                    top: -30px;
                }
            }
            @media (max-width: 837px) {
                .sidebar{display: none; margin-top: -1px;}
                .out{
                    position: unset;
                    margin-bottom: 20px;
                }
                .upload #priceNull, .upload #priceSet {
                    margin-left: 10px;
                    margin-right: 10px;
                }
                .activated{
                    margin-left: -10px;
                }
            }
            .priceNull, .priceSet{
                margin-left: 20px;
                margin-right: 30px;
            }
        </style>
	    <?php require "menutemplate.view.php"; ?>
        <div class="out">
            <div class="form">
            <form method="post" enctype="multipart/form-data">
                <h1>Post content</h1>
                <?php if(!empty($errors)): ?>
                    <div>
                        <ul>
                            <?php echo $errors; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <label for="articleName">Article Name:</label>
                <input type="text" id="articleName" name="articleName" required minlength="2" maxlength="25" value="<?php echo htmlspecialchars($savedFormData['articleName'] ?? '', ENT_QUOTES); ?>">
                <br>
                <label for="category">Category:</label>
                <select name="category" id="" required>
                    <option value="" disabled <?php echo empty($savedFormData['category']) ? 'selected' : ''; ?>>Select one category</option>
                    <option value="mc" <?php echo (isset($savedFormData['category']) && $savedFormData['category'] == 'mc') ? 'selected' : ''; ?>>Minecraft</option>
                    <option value="fivem" <?php echo (isset($savedFormData['category']) && $savedFormData['category'] == 'fivem') ? 'selected' : ''; ?>>FiveM</option>
                    <option value="dcb" <?php echo (isset($savedFormData['category']) && $savedFormData['category'] == 'dcb') ? 'selected' : ''; ?>>Discord</option>
                    <option value="wd" <?php echo (isset($savedFormData['category']) && $savedFormData['category'] == 'wd') ? 'selected' : ''; ?>>Web development</option>
                </select>
                <br>
                <label for="tags">Tags (comma-separated):</label>
                <br>
                <input type="text" id="tags" name="tags" required value="<?php echo htmlspecialchars($savedFormData['tags'] ?? '', ENT_QUOTES); ?>"> <br>
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept=".gif,.jpg,.jpeg,.png,.webp">
                <br>
                <div style="margin-bottom: 20px;">
                    <label for="upload">Download file (only zip):</label>
                    <input type="file" id="upload" name="upload" accept=".zip">
                </div>
                <div class="upload">
                    <div class="buttons">
                        <p id="priceNull">Free and public resource</p>
                        <p id="priceSet">Add payment</p>
                    </div>
                    <div class="activated">
                      <?php
                            if (empty($result['PayPalEmail'])) {
                                echo "<div style='margin-left: 20px; margin-right: 20px; font-weight:400'>You must Link a PayPal account to post a resource with a price and to receive your respective income.</div>";
                            }else{
                                echo "
                                <div class='priceNull'>
                                    Your resource will be free for everyone and the people could download your resource without login in.
                                </div>";
                                echo "
                                <div class='priceSet' style='display: none;'>
                                    <label for='price'>Price ($ - USD):</label>
                                    <input type='number' id='price' name='price' min='1' max='1000' step='0.01' placeholder='0.00'>
                                </div>";
                            }
                        ?>
                    </div>
                </div>
                <br>
                <div id="sections">
                    <?php
                    if (isset($savedFormData['sections']) && is_array($savedFormData['sections'])) {
                        foreach ($savedFormData['sections'] as $index => $section) {
                            ?>
                            <div class="section">
                                <label for="section<?= $index ?>_title">Section Title:</label>
                                <br>
                                <input type="text" id="section<?= $index ?>_title" name="sections[<?= $index ?>][title]" required minlength="2" maxlength="30" size="20" value="<?php echo htmlspecialchars($section['title'], ENT_QUOTES); ?>"> <br>

                                <label for="section<?= $index ?>_description">Section Description:</label><br>
                                <textarea id="section<?= $index ?>_description" name="sections[<?= $index ?>][description]" rows="4" cols="50" required minlength="10" maxlength="500"><?php echo htmlspecialchars($section['description'], ENT_QUOTES); ?></textarea> <br>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="section">
                            <label for="sectionA_title">Section Title:</label>
                            <br>
                            <input type="text" id="sectionA_title" name="sections[0][title]" required minlength="2" maxlength="30" size="20"> <br>

                            <label for="sectionA_description">Section Description:</label><br>
                            <textarea id="sectionA_description" name="sections[0][description]" rows="4" cols="50" required minlength="10" maxlength="500"></textarea> <br>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <button type="button" id="addSectionButton">Add Another Section</button>
                <button type="button" id="removeSectionButton" onclick="removeSection()">Remove Section</button>

                <input type="submit" class="btn">
            </form>
            </div>
        </div>
        <script>
            function removeSection() {
                var result = '<?php removeSession(); ?>'
            }
        </script>
        <script>
            let addSectionButton = document.getElementById('addSectionButton');
            let removeSectionButton = document.getElementById('removeSectionButton');
            addSectionButton.addEventListener('click', function() {
                let sectionsDiv = document.getElementById('sections');
                let sectionCount = sectionsDiv.getElementsByClassName('section').length;

                let newSection = document.createElement('div');
                newSection.className = 'section';

                let titleLabel = document.createElement('label');
                titleLabel.setAttribute('for', 'section_title');
                titleLabel.textContent = 'Section Title:';
                newSection.appendChild(titleLabel);

                newSection.appendChild(document.createElement('br'));

                let titleInput = document.createElement('input');
                titleInput.type = 'text';
                titleInput.id = `section${sectionCount}_title`;
                titleInput.name = `sections[${sectionCount}][title]`;
                titleInput.required = 'true';
                newSection.appendChild(titleInput);

                newSection.appendChild(document.createElement('br'));

                let descriptionLabel = document.createElement('label');
                descriptionLabel.setAttribute('for', 'section_description');
                descriptionLabel.textContent = 'Section Description:';
                newSection.appendChild(descriptionLabel);

                newSection.appendChild(document.createElement('br'));

                let descriptionTextarea = document.createElement('textarea');
                descriptionTextarea.id = `section${sectionCount}_description`;
                descriptionTextarea.name = `sections[${sectionCount}][description]`;
                descriptionTextarea.rows = 4;
                descriptionTextarea.cols = 50;
                descriptionTextarea.minLength = 10;
                descriptionTextarea.required = 'true';
                newSection.appendChild(descriptionTextarea);

                newSection.appendChild(document.createElement('br'));

                sectionsDiv.appendChild(newSection);
            });
            removeSectionButton.addEventListener('click', function() {
                let sectionsDiv = document.getElementById('sections');
                let sectionCount = sectionsDiv.getElementsByClassName('section').length;

                if (sectionCount > 0) {
                    sectionsDiv.removeChild(sectionsDiv.lastElementChild);
                }
            });
            // Copyright Quelopande
    </script>
    <script>
        let clickCount = 0;
        addSectionButton.addEventListener('click', function() {
            clickCount++;
            if(clickCount === 3){
                addSectionButton.classList.add("hide");
            }
        });
    </script>
        <script>
            let xMark = document.querySelector('.x-mark');
            let lMark = document.querySelector('.fa-list');
            let sidebar = document.querySelector('.sidebar');
            let main = document.querySelector('.out');
            let body = document.querySelector('.body');
    
            lMark.addEventListener('click', () => {
                xMark.style.display = "block";
                lMark.style.display = "none";
                sidebar.style.display = "flex";
                main.style.left = "400px";
                body.style.overflowY = "hidden";
            });
            xMark.addEventListener('click', () => {
                xMark.style.display = "none";
                lMark.style.display = "block";
                sidebar.style.display = "none";
                main.style.left = "30px";
                body.style.overflowY = "scroll";
            });
            if (window.innerWidth < 837) {
                main.addEventListener('click', () => {
                    xMark.style.display = "none";
                    lMark.style.display = "block";
                    sidebar.style.display = "none";
                    main.style.left = "30px";
                    body.style.overflowY = "scroll";
                });
            }
        </script>
        <script>
            let priceNullBtn = document.getElementById("priceNull");
            let priceSetBtn = document.getElementById("priceSet");
            let priceNull = document.querySelector(".priceNull");
            let priceSet = document.querySelector(".priceSet");

            priceSetBtn.addEventListener('click', () => {
                priceSet.style.display = "block";
                priceNull.style.display = "none";
            });
            priceNullBtn.addEventListener('click', () => {
                priceNull.style.display = "block";
                priceSet.style.display = "none";
            });
        </script>
    </body>
    </html>
</body>
</html>
