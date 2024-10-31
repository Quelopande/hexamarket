<!doctype html>
<html lang="en">
<head>
    <link rel="alternate" hreflang="es" href="https://www.hexamarket.store/es/fivem">
    <link rel="alternate" hreflang="es" href="https://www.hexamarket.store/fivem">
    <link rel="alternate" hreflang="x-default" href="https://www.hexamarket.store/fivem"/>
    <!-- Hexamarket No redirects-->
    <meta name="theme-color" content="#0010ff">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Hexamarket - Five scripts">
    <meta name="description" content="Hexamarket is a startup that offers free pre-configured plugins and scripts for minecraft and FiveM servers.">
    <!-- Twitter card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Hexamarket - FiveM">
    <meta name="twitter:description" content="Hexamarket is a company that offers free pre-configured plugins and scripts for minecraft and FiveM servers.">
    <meta name="twitter:image" content="assets/media/logo.webp">
    <!-- Facebook & discord -->
    <meta property="og:locale" content="en"/>
    <meta property="og:site_name" content="©Quelopande"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Hexamarket - FiveM"/>
    <meta property="og:description" content="Hexamarket is a company that offers free pre-configured plugins and scripts for minecraft and FiveM servers."/>
    <meta property="og:url" content="https://www.hexamarket.store/fivem"/>
    <meta property="og:image" content="/assets/media/logo.webp"/>
    <meta property="og:image:width" content="540"/>
    <meta property="og:image:height" content="520"/>
    <!-- Hexamarket -->
    <title>Hexamarket - FiveM</title>
    <link rel="website icon" type="png" href="/assets/media/logo.webp">
    <link rel="stylesheet" href="/assets/css/elements.css">
    <link rel="stylesheet" href="/assets/css/menu.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet"/>
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
                                <p><a hreflang="es" href="/es/fivem"><img src="assets/media/spain.webp" alt="Spanish flag">Español</a></p>
                                <p><a hreflang="en" href="/fivem"><img src="assets/media/uk.webp" alt="UK flag">English</a></p>
                            </div>
                        </div>
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
                        <a href="all"><i class="fa-solid fa-shop"></i><span> Elements</span></a>
                    </li>
                    <li class="link">
                        <div class="dropdown">
                            <a><i class="fa-regular fa-globe"></i><span> Languages</span></a>
                            <div class="dropdown-content">
                                <p><a hreflang="es" href="/es/fivem"><img src="assets/media/spain.webp" alt="Spanish flag">Español</a></p>
                                <p><a hreflang="en" href="/fivem"><img src="assets/media/uk.webp" alt="UK flag">English</a></p>
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
        <div class="all">
            <div class="head">
                <div class="tags">
                    <a href="/all"class="tag">All</a>
                    <a href="/minecraft" class="tag">Minecraft</a>
                    <a href="/fivem" class="tag" id="target"> <i class="fa-sharp fa-solid fa-circle-check"></i> FiveM</a>
                    <a href="/webdeveloment" class="tag">Web Develoment</a>
                    <a href="/discordbots" class="tag">Discord Bot</a>
                </div>
                <div>
                    <input class="search" id="searchbar" onkeyup="search_container()" type="text" name="search" placeholder="Search...">
                </div>
            </div>
            <hr style="width: 100%;">
            <?php
                $cat = "fivem";
                $download = "Download";
                $more = "See more";
                $contentFile = "content.json";
                require "ArticleIndexer.php";
            ?>
            <div class="containers" id="existing-containers">
                <a class="container" href="">
                    <img src="/assets/media/no_results_found.webp">
                    <h1>Not found</h1>
                    <div>
                        <button class="download">Download</button>
                        <button class="more">See more</button>
                    </div>
                </a>
            </div>
            <div id="notification">
                <i class="fa-solid fa-circle-exclamation fa-shake"></i>
                <h1>Error</h1>
                <p class="error-info"></p>
            </div>
            <?php require "bottom.php";?>
        </div>
        <script src="/assets/js/search.js"></script>
    </body>
</html>