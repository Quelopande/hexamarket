<!doctype html>
<html lang="es">
<head>
    <link rel="alternate" hreflang="en" href="https://www.menzatyx.xyz/minecraft">
    <link rel="alternate" hreflang="es" href="https://www.menzatyx.xyz/es/minecraft">
    <link rel="alternate" hreflang="x-default" href="https://www.menzatyx.xyz/minecraft"/>
    <!-- Menzatyx No redirects-->
    <meta name="theme-color" content="#0010ff">
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
    <meta property="og:url" content="https://menzatix.netlify.app/es/minecraft"/>
    <meta property="og:image" content="/assets/media/logo.webp"/>
    <meta property="og:image:width" content="540"/>
    <meta property="og:image:height" content="520"/>
    <!-- Menzatyx -->
    <title>Menzatyx - Minecraft</title>
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
                                <p><a hreflang="es" href="/es/minecraft"><img src="/assets/media/spain.webp" alt="Bandera de España">Español</a></p>
                                <p><a hreflang="en" href="/minecraft"><img src="/assets/media/uk.webp" alt="Bandera de Reino Unido">English</a></p>
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
                                <p><a hreflang="es" href="/es/minecraft"><img src="/assets/media/spain.webp" alt="Bandera de España">Español</a></p>
                                <p><a hreflang="en" href="/minecraft"><img src="/assets/media/uk.webp" alt="Bandera de Reino Unido">English</a></p>
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
                    <a href="/es/minecraft" id="target" class="tag"> <i class="fa-sharp fa-solid fa-circle-check"></i> Minecraft</a>
                    <a href="/es/fivem" class="tag">FiveM</a>
                    <a href="/es/webdeveloment" class="tag">Web Develoment</a>
                    <a href="/es/discordbots" class="tag">Discord Bot</a>
                </div>
                <div>
                    <input class="search" id="searchbar" onkeyup="search_container()" type="text" name="search" placeholder="Search...">
                </div>
            </div>
            <hr style="width: 100%;">
            <div class="containers">
                <?php
                    $cat = "mc";
                    $download = "Download";
                    $more = "See more";
                    $contentFile = "../content.json";
                    require "../ArticleIndexer.php";
                ?>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/economyshopgui.webp" alt="Economyshopgui image">
                    <h1>Economyshopgui</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/economyshopgui#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/economyshopgui'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/tablist.webp" alt="Tablist image">
                    <h1>Tablist</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/tablist#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/tablist'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/protectionstones.webp" alt="Protection Stones image">
                    <h1>Protectionstones</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/protectionstones#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/protectionstones'">Ver más</button>
                    </div>
                </a>

                <a class="container">
                    <img loading="lazy" src="/assets/media/all/luckperms.webp" alt="Luckperms image">
                    <h1>Luckperms</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/Luckperms#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/Luckperms'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/mycommand.webp" alt="mycommand">
                    <h1>Mycommand</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/mycommand#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/mycommand'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/animatedscoreboard.webp" alt="animatedscoreboard">
                    <h1>AnimatedScoreboard</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/AnimatedScoreboard#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/AnimatedScoreboard'">Ver más</button>
                    </div>
                </a>

                <a class="container">
                    <img loading="lazy" src="/assets/media/all/animatedscoreboardv2.webp" alt="animatedscoreboardv2">
                    <h1>AnimatedScoreboard v2</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/AnimatedScoreboardv2#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/AnimatedScoreboardv2'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/essentialsx.webp" alt="Essentialsx" height="70%">
                    <h1>Essentialsx</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/essentialsx#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/essentialsx'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/advancedban.webp" alt="advancedban image">
                    <h1>AnunciovancedBan</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/advancedban#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/advancedban'">Ver más</button>
                    </div>
                </a>

                <a class="container">
                    <img loading="lazy" src="/assets/media/all/deathmessage.webp" alt="DeathMessage image">
                    <h1>DeathMessage</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/deathmessage#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/deathmessage'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/no_results_found.webp" alt="Rankup image">
                    <h1>Rankup</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/Rankup#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/Rankup'">Ver más</button>
                    </div>
                </a>
                <a class="container">
                    <img loading="lazy" src="/assets/media/all/inventoryrollback.webp" alt="inventoryrollback image">
                    <h1>Inventory RollBack</h1>
                    <div>
                        <button class="download" onclick="window.location.href='/es/things/mc/inventoryrollback#download'">Descargar</button>
                        <button class="more" onclick="window.location.href='/es/things/mc/inventoryrollback'">Ver más</button>
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