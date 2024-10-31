<!doctype html>
<html lang="es">
<head>
    <link rel="alternate" hreflang="en" href="https://www.menzatyx.xyz/fivem">
    <link rel="alternate" hreflang="es" href="https://www.menzatyx.xyz/es/fivem">
    <link rel="alternate" hreflang="x-default" href="https://www.menzatyx.xyz/fivem"/>
    <!-- Menzatyx No redirects-->
    <meta name="theme-color" content="#00d601">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Menzatyx es una empresa que ofrece complementos y scripts preconfigurados gratuitos para servidores Minecraft y FiveM.">
    <!-- Twitter card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Menzatyx">
    <meta name="twitter:description" content="Menzatyx es una empresa que ofrece complementos y scripts preconfigurados gratuitos para servidores Minecraft y FiveM.">
    <meta name="twitter:image" content="assets/media/logo.webp">
    <!-- OG card -->
    <meta property="og:locale" content="es"/>
    <meta property="og:site_name" content="©Quelopande"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Menzatyx"/>
    <meta property="og:description" content="Menzatyx es una empresa que ofrece complementos y scripts preconfigurados gratuitos para servidores Minecraft y FiveM."/>
    <meta property="og:url" content="https://menzatix.netlify.app/es/fivem"/>
    <meta property="og:image" content="/assets/media/logo.webp"/>
    <meta property="og:image:width" content="540"/>
    <meta property="og:image:height" content="520"/>
    <!-- Menzatyx -->
    <title>Menzatyx - Scripts para FiveM</title>
    <link rel="website icon" type="png" href="/assets/media/favicon.ico">
    <link rel="stylesheet" href="/assets/css/elements.css">
    <link rel="stylesheet" href="/assets/css/menu.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="mobile-vr">
            <nav class="nav container" id="nav">
                <h2 class="logo"><span>Menzatyx</span></h2>
                <ul class="links">
                    <li class="item">
                        <a href="/es/index" class="link"><i class="fa-solid fa-house"></i> Inicio</a>
                    </li>
                    <li class="item">
                        <a href="/es/all" class="link"><i class="fa-solid fa-shop"></i> Elementos</a>
                    </li>
                    <li class="item">
                        <div class="dropdown">
                            <a class="link"><i class="fa-regular fa-globe"></i><span> Idiomas</span></a>
                            <div class="dropdown-content">
                                <p><a hreflang="es" href="/es/fivem"><img src="/assets/media/spain.webp" alt="Bandera de España">Español</a></p>
                                <p><a hreflang="en" href="/fivem"><img src="/assets/media/uk.webp" alt="Bandera de Reino Unido">English</a></p>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <a href="https://discord.menzatyx.xyz/" class="link"><i class="fa-brands fa-discord"></i> Discord</a>
                    </li>
                    <div class="ilinks">
                        <li class="item">
                            <a href="/auth" class="link"><i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión</a>
                        </li>
                        <li class="item">
                            <a href="/auth?signup" class="link"><i class="fa-solid fa-user-plus"></i> Regístrate</a>
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
                <h1 class="logo">Menzatyx</h1>
                <ul>
                    <li class="link">
                        <a href="/es/index"><i class="fa-solid fa-house"></i><span> Inicio</span></a>
                    </li>
                    <li class="link">
                        <a href="/es/all"><i class="fa-solid fa-shop"></i><span> Elementos</span></a>
                    </li>
                    <li class="link">
                        <div class="dropdown">
                            <a><i class="fa-regular fa-globe"></i><span> Idiomas</span></a>
                            <div class="dropdown-content">
                                <p><a hreflang="es" href="/es/fivem"><img src="/assets/media/spain.webp" alt="Bandera de España">Español</a></p>
                                <p><a hreflang="en" href="/fivem"><img src="/assets/media/uk.webp" alt="Bandera de Reino Unido">English</a></p>
                            </div>
                        </div>
                    </li>
                    <li class="link">
                        <a href="https://discord.menzatyx.xyz/" target="_blank"><i class="fa-brands fa-discord"></i><span> Discord</span></a>
                    </li>
                    <div class="endlink">
                        <div class="login">
                            <a href="/auth">Iniciar Sesión</a>
                        </div>
                        <div class="register">
                            <a href="/auth?signup">Regístrate</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <div class="all">
            <div class="head">
                <div class="tags">
                    <a href="/es/all" class="tag">Todo</a>
                    <a href="/es/minecraft" class="tag">Minecraft</a>
                    <a href="/es/fivem" id="target" class="tag"> <i class="fa-sharp fa-solid fa-circle-check"></i> FiveM</a>
                    <a href="/es/webdeveloment" class="tag">Web Develoment</a>
                    <a href="/es/discordbots" class="tag">Discord Bot</a>
                </div>
                <div>
                    <input class="search" id="searchbar" onkeyup="search_container()" type="text" name="search" placeholder="Buscar...">
                </div>
            </div>
            <hr style="width: 100%;">
            <div class="containers">
                <?php
                    $cat = "fivem";
                    $download = "Download";
                    $more = "See more";
                    $contentFile = "../content.json";
                    require "../ArticleIndexer.php";
                ?>
                <a class="container" href="">
                    <img src="https://cdn.dribbble.com/users/1554526/screenshots/3399669/no_results_found.webp" alt="Not found image">
                    <h1 class="12">Not found</h1>
                    <div>
                        <button class="download">Descargar</button>
                        <button class="more">Ver más</button>
                    </div>
                </a>
            </div>
            <div id="notification">
                <i class="fa-solid fa-circle-exclamation fa-shake"></i>
                <h1>Error</h1>
                <p class="error-info"></p>
            </div>
            <?php require "bottom.html";?>
        </div>
        <script src="/assets/js/search.js"></script>
    </body>
</html>