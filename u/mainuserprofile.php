<?php
// Copyright (c) 2024 Quelopande
    $currentURL = $_SERVER['REQUEST_URI'];
    $filename = basename($currentURL);
    $filenameWithoutPath = pathinfo($filename, PATHINFO_FILENAME);
    $euser = $filenameWithoutPath;
    require "../connection.php";
    try {
        $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
        $statement->bindParam(':user', $euser);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $rank = $result['rank'];
        }
        } catch (PDOException $e) {
        echo "Error fetching user data: " . $e->getMessage();
    }

    $jsonString = file_get_contents('../content.json');
        
    $data = json_decode($jsonString, true);
    $desiredUserId = $result['id'];

    $articles = [];
    foreach ($data['users'] as $jsonUser) {
        if ($jsonUser['id'] == $desiredUserId) {
            $articles = $jsonUser['articles'];
            break;
        }
    }

        
    $html = '';
    foreach ($articles as $article) {
        $html .= '<div onclick="window.location.href=\'/things/' . $article['category'] . '/' . $article['articleName'] . "+" . $article['articleId'] .'\'">';
        $html .= '<h3>' . $article['articleName'] . '</h3>';
        $html .= '<p>' . implode(', ', array_map('htmlspecialchars', $article['tags'])) . '</p>';
        $html .= '<p> ' . $article['date'] . '</p>';
        $html .= '</div>';
    }
    if($jsonUser['banner'] == 1){
        $banner = "https://hexamarket.store/assets/media/banner1.webp";
    } else if($jsonUser['banner'] == 2){
        $banner = "https://hexamarket.store/assets/media/banner2.webp";
    } else if($jsonUser['banner'] == 3){
        $banner = "https://hexamarket.store/assets/media/banner3.webp";
    } else if($jsonUser['banner'] == 4){
        $banner = "https://hexamarket.store/assets/media/banner4.webp";
    }

    $profileImagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/media/u/profile/' . $desiredUserId . '.webp';
    if (file_exists($profileImagePath)) {
        $profileImage = $profileImagePath;
    } else {
        $profileImage = "/assets/media/notuser.webp";
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Quelopande No redirects-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Twitter card -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Hexamarket - <?php echo $euser;?>">
        <meta name="twitter:image" content="/assets/media/logo.webp">
        <!-- OG card -->
        <meta property="og:locale" content="en"/>
        <meta property="og:site_name" content="©Quelopande"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="Hexamarket - <?php echo $euser;?>"/>
        <meta property="og:url" content="https://menzatix.xyz/u/<?php echo $euser;?>"/>
        <meta property="og:image" content="/assets/media/logo.webp"/>
        <meta property="og:image:width" content="540"/>
        <meta property="og:image:height" content="520"/>
        <!-- Hexamarket -->
        <title>Hexamarket - <?php echo $euser;?></title>
        <link rel="website icon" type="png" href="/assets/media/logo.webp">
        <link rel="stylesheet" href="/assets/css/user.css">
        <link rel="stylesheet" href="/assets/css/menu.css">
        <link rel="stylesheet" href="/assets/css/fonts.css">
        <link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet"/>
        <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
    </head>
    <body>
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PZJ7LXL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <div class="mobile-vr">
            <nav class="nav container" id="nav">
                <h2 class="logo"><span>Hexamarket</span></h2>
                <ul class="links">
                    <li class="item">
                        <a href="/index" class="link"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="item">
                        <a href="/all" class="link"><i class="fa-solid fa-shop"></i> Elements</a>
                    </li>
                    <li class="item">
                        <a href="https://discord.hexamarket.store/" class="link"><i class="fa-brands fa-discord"></i> Discord</a>
                    </li>
                    <div class="ilinks">
                        <li class="item">
                            <a href="/auth" class="link"><i class="fa-sharp fa-solid fa-dice-d20"></i> Login</a>
                        </li>
                        <li class="item">
                            <a href="/auth?signup" class="link"><i class="fa-solid fa-gamepad-modern"></i> Signup</a>
                        </li>
                    </div>
                </ul>
                <a href="#nav" class="hamburguer">
                    <span class="icon"><i class="fas fa-bars"></i></span>
                </a>
                <a href="#" class="close">
                    <i class="fas fa-xmark"></i>
                </a>
            </nav>
        </div>
        <div class="computer-vr">
            <div class="navbar-links">
                <h1 class="logo">Hexamarket</h1>
                <ul>
                    <li class="link">
                        <a href="/index"><i class="fa-solid fa-house"></i><span> Home</span></a>
                    </li>
                    <li class="link">
                        <a href="/all"><i class="fa-solid fa-shop"></i><span> Elements</span></a>
                    </li>
                    <li class="link">
                        <a href="https://discord.hexamarket.store/" target="_blank"><i class="fa-brands fa-discord"></i><span> Discord</span></a>
                    </li>
                    <div class="endlink">
                        <div class="login">
                            <a href="/auth">Login</a>
                        </div>
                        <div class="register">
                            <a href="/auth?signup">SignUp</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <div class="user">
            <section>
                <img src="<?php echo $banner;?>" alt="" >
                <img src="<?php echo $profileImage?>" alt="">
                <h1><?php echo $euser?></h1>
                <div class="tags">
                    <p><?php echo $rank?></p>
                </div>
            </section>
            <?php require "../reportUser.php";?>
            <section>
                <?php echo $html;?>
            </section>
        </div>
        <style>.user section .tags p{background-color: rgb(255, 100, 39);color: white;}.user section:nth-child(2){text-align: left;color: white;}.user section:nth-child(2) p{margin-top: 2px;}.user section:nth-child(2):hover{background-color: var(--background-primary-hover);cursor: pointer;}</style>
            <div id="bottom"></div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script>
                $(function(){
                $("#bottom").load("/es/bottom.html");
                });
            </script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
            <?php     require "../bottom.html"; ?>
        <div class="overlay" onclick="closeImage()"></div>
        <script src="/assets/js/image.js"></script>

    </body>
</html>