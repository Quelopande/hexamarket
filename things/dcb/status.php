<!doctype html>
<html lang="en">
<head>
    <link rel="alternate" hreflang="es" href="https://hexamarket.store/es/things/dcb/status">
    <link rel="alternate" hreflang="en" href="https://hexamarket.store/things/dcb/status">
    <link rel="alternate" hreflang="x-default" href="https://hexamarket.store/thing/dcb/status"/>
    <!-- Hexamarket No redirects-->
    <meta name="theme-color" content="#00d601">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Set a state to your discord bot. Discord states make your bot indicate data or is simply an aesthetic purpose. The states can be put emojis and other elements. In this case the State is established in playing. The discord states are translated, as can be seen in the image above.">
    <!-- Twitter card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Hexamarket - Status | Discord Bots">
    <meta name="twitter:description" content="Set a state to your discord bot. Discord states make your bot indicate data or is simply an aesthetic purpose. The states can be put emojis and other elements. In this case the State is established in playing. The discord states are translated, as can be seen in the image above.">
    <meta name="twitter:image" content="assets/media/logo.webp">
    <!-- OG card -->
    <meta property="og:locale" content="en"/>
    <meta property="og:site_name" content="©Quelopande"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Hexamarket - Status | Discord Bots"/>
    <meta property="og:description" content="Set a state to your discord bot. Discord states make your bot indicate data or is simply an aesthetic purpose. The states can be put emojis and other elements. In this case the State is established in playing. The discord states are translated, as can be seen in the image above."/>
    <meta property="og:url" content="https://hexamarket.store/things/dcb/status"/>
    <meta property="og:image" content="assets/media/logo.webp"/>
    <meta property="og:image:width" content="540"/>
    <meta property="og:image:height" content="520"/>
    <!-- Hexamarket -->
    <title>Hexamarket - Status | Discord bot code</title>
    <link rel="website icon" type="png" href="/assets/media/favicon.ico">
    <link rel="stylesheet" href="/assets/css/things.css">
    <link rel="stylesheet" href="/assets/css/menu.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet"/>
    <script src="/assets/js/per-page/status.js" defer></script>
    <script src="/assets/js/section.js" defer></script>
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
    <body>
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
                        <div class="dropdown">
                            <a class="link"><i class="fa-regular fa-globe"></i><span> Languages</span></a>
                            <div class="dropdown-content">
                                <p><a hreflang="es" href="/es/things/dcb/status"><img alt="Spain-flag" src="/assets/media/spain.webp">Español</a></p>
                                <p><a hreflang="en" href="/things/dcb/status"><img alt="UK-flag" src="/assets/media/uk.webp">English</a></p>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <a href="https://discord.hexamarket.store/" class="link"><i class="fa-brands fa-discord"></i> Discord</a>
                    </li>
                    <div class="ilinks">
                        <li class="item">
                            <a href="/auth" class="link"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                        <li class="item">
                            <a href="/auth?signup" class="link"><i class="fa-solid fa-user-plus"></i> SignUp</a>
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
                        <div class="dropdown">
                            <a><i class="fa-regular fa-globe"></i><span> Languages</span></a>
                            <div class="dropdown-content">
                                <p><a hreflang="es" href="/es/things/dcb/status"><img alt="Spain-flag" src="/assets/media/spain.webp">Español</a></p>
                                <p><a hreflang="en" href="/things/dcb/status"><img alt="UK-flag" src="/assets/media/uk.webp">English</a></p>
                            </div>
                        </div>
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
        <div class="things">
            <div class="img">
                <img src="/assets/media/bots/status.webp" alt="" onclick="enlargeImage('/assets/media/bots/status.webp')"/>
            </div>
            <div class="information">
                <h1>Playing Status</h1>
                <div class="sections">
                    <div class="section">
                        <h2 class="btn-section" data-section="section1">What is discordjs? <i class="fa-solid fa-chevron-down"></i></h2>
                        <h4 id="section1" style="display: none;">Discord.js is a compact module that is coded using node.js, another "extension" of JavaScript, the most popular language in the world. This module is used in a variety of applications such as websites, software, apps, and bots.</h4>
                    </div>
                    <div class="section">
                        <h2 class="btn-section" data-section="section2">Description of Bot Status <i class="fa-solid fa-chevron-down"></i></h2>
                        <h4 id="section2" style="display: none;">Set a state to your discord bot. Discord states make your bot indicate data or is simply an aesthetic purpose. The states can be put emojis and other elements. In this case the State is established in playing. The discord states are translated, as can be seen in the image above.</h4>
                    </div>
                    <div class="section">
                        <h2 class="btn-section" data-section="section3">How to install <i class="fa-solid fa-chevron-down"></i></h2>
                        <h4 id="section3" style="display: none;">Give the download button, which is just below this message. There you will get a JavaScript (.js) file. With a code editor such as Visual Studio Code opens the file. Copy the content and take it in the base code of your bot. It is important that the code does not interfere with another and that it is put correctly. To change the text of which he is playing replaces the text "Hexamarket" with the text you want.</h4>
                    </div>
                    <div class="section">
                        <h2 class="btn-section" data-section="section4">These things are required/optional: <i class="fa-solid fa-chevron-down"></i></h2>
                        <ul>
                            <h4 id="section4" style="display: none;">
                                <li><a href="https://discord.js.org/#/">- Discordjs v.12 + (We recommend the version 13)</a></li>
                            </h4>
                        </ul>
                    </div>
                </div>
            </div>
            <button class="download-btn" data-timer="10" id="download">
                <i class="fa-solid fa-arrow-down-to-line"></i>
                <span class="text">Download Files</span>
            </button>
            <?php require "sponsor.php"?>
        </div>
        <?php require "../../bottom.html"?>
        <div class="overlay" onclick="closeImage()"></div>
        <script src="/assets/js/image.js"></script>
    </body>
</html>