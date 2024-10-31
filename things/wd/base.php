<?php
session_start();
$user = $_SESSION['user'];

$currentURL = $_SERVER['REQUEST_URI'];
$filename = pathinfo($currentURL, PATHINFO_FILENAME);
$lastPlusPosition = strrpos($filename, '+');

if ($lastPlusPosition !== false) {
    $targetIdOld = substr($filename, $lastPlusPosition + 1);
    $targetId = intval($targetIdOld);
} else {
    $targetId = intval($filename);
}

$jsonString = file_get_contents('../../content.json');
if ($jsonString === false) {
    die("Error loading JSON data");
}

$data = json_decode($jsonString);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON data: " . json_last_error_msg());
}

$filteredArticle = [];

foreach ($data->users as $euser) {
    foreach ($euser->articles as $article) {
        if ($article->articleId === $targetId) {
            $filteredArticle[] = $article;
            $publisherId = $euser->id;
            break 2;
        }
    }
}

if (!empty($filteredArticle)) {
    $article = $filteredArticle[0];
    $articleName = $article->articleName;
    $articleDownloadLink = $article->file;
} else {
    die("Article not found");
}

if ($publisherId === null) {
    die("Publisher ID not found for the article");
}

require "../../connection.php";

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->bindParam(':user', $user);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

$estatement = $connection->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
$estatement->bindParam(':id', $publisherId);
$estatement->execute();
$eresult = $estatement->fetch(PDO::FETCH_ASSOC);

if ($eresult === false) {
    die("Publisher not found in the database");
}

$publisherName = $eresult['user'];

function wrapUrlsInAnchors($text) {
    $urlPattern = '/(https?:\/\/[^\s]+)/';
    return preg_replace($urlPattern, '<a href="$1">$1</a>', $text);
}

$purchaserId = $result['id'];

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Quelopande No redirects-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $article->sections[0]->description; ?>">
    <!-- Twitter card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Hexamarket - <?php echo $articleName;?>">
    <meta name="twitter:description" content="<?php echo $article->sections[0]->description; ?>">
    <meta name="twitter:image" content="assets/media/logo.webp">
    <!-- OG card -->
    <meta property="og:locale" content="en"/>
    <meta property="og:site_name" content="©Quelopande"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Hexamarket - <?php echo $articleName;?>"/>
    <meta property="og:description" content="<?php echo $article->sections[0]->description; ?>"/>
    <meta property="og:image" content="assets/media/logo.webp"/>
    <meta property="og:image:width" content="540"/>
    <meta property="og:image:height" content="520"/>
    <!-- Quelopande -->
    <title>Hexamarket - <?php echo $articleName;?> | Discord</title>
    <link rel="website icon" type="png" href="/assets/media/favicon.ico">
    <link rel="stylesheet" href="/assets/css/things.css">
    <link rel="stylesheet" href="/assets/css/menu.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet"/>
    <script src="/assets/js/slider.js" defer></script>
    <script src="/assets/js/section.js" defer></script>
</head>
<body>
    <?php require "../../nav.php" ;?>
    <style>
        #prev,#next{
            display: none;
        }
    </style>
    <div class="things">
        <div class="img">
            <section class="wrapper">
                <i class="fa-solid fa-arrow-left button" id="prev"></i>
                <div class="image-container">
                    <div class="carousel">
                        <img class="cimg" src="/assets/media/u/posts/<?php echo $targetId;?>.webp" alt="" onclick="enlargeImage('/assets/media/u/posts/<?php echo $targetId;?>.webp')"/>
                    </div>
                    <i class="fa-solid fa-arrow-right button" id="next"></i>
                </div>
            </section>
        </div>
        <style>.section{word-wrap: wrap;} </style>
        <div class="things">
            <div class="img">
                <section class="wrapper">
                    <i class="fa-solid fa-arrow-left button" id="prev"></i>
                    <div class="image-container">
                      <div class="carousel">
                        <img class="cimg" src="/assets/media/u/posts/<?php echo $targetId;?>.webp" alt="" onclick="enlargeImage('/assets/media/u/posts/<?php echo $targetId;?>.webp')"/>
                      </div>
                      <i class="fa-solid fa-arrow-right button" id="next"></i>
                    </div>
                  </section>
            </div>
            <style>.section{word-wrap: wrap;} </style>
            <div class="information">
                <?php require "../../reportContent.php";?>
                <h1><?php echo $article->articleName;?></h1>
                <p class="pubName" style="text-align:left; margin-left: 20px; color: white; font-size: 16px;"><a href="/u/<?php echo $publisherName;?>" style="padding: 10px;"><?php echo $publisherName;?></a></p>
                <div class="sections">
                    <div class="section">
                        <?php if (!empty($article->sections[0]->title) || !empty($article->sections[0]->description)) : ?>
                            <h2 class="btn-section" data-section="section1"><?php echo $article->sections[0]->title; ?><i class="fa-solid fa-chevron-down"></i></h2>
                            <h4 id="section1" style="display: none;"><?php echo wrapUrlsInAnchors($article->sections[0]->description); ?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="section">
                        <?php if (!empty($article->sections[1]->title) || !empty($article->sections[1]->description)) : ?>
                            <h2 class="btn-section" data-section="section2"><?php echo $article->sections[1]->title; ?> <i class="fa-solid fa-chevron-down"></i></h2>
                            <h4 id="section2" style="display: none;"><?php echo wrapUrlsInAnchors($article->sections[1]->description); ?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="section">
                        <?php if (!empty($article->sections[2]->title) || !empty($article->sections[2]->description)) : ?>
                            <h2 class="btn-section" data-section="section3"><?php echo $article->sections[2]->title; ?> <i class="fa-solid fa-chevron-down"></i></h2>
                            <h4 id="section3" style="display: none;"><?php echo wrapUrlsInAnchors($article->sections[2]->description); ?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="section">
                        <?php if (!empty($article->sections[3]->title) || !empty($article->sections[3]->description)) : ?>
                            <h2 class="btn-section" data-section="section4"><?php echo $article->sections[3]->title; ?> <i class="fa-solid fa-chevron-down"></i></h2>
                            <h4 id="section4" style="display: none;"><?php echo wrapUrlsInAnchors($article->sections[3]->description); ?></h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Checkout connection developed by Quelopande-->
            <?php
            if(is_null($article->price)){
                echo '
            <button class="download-btn" data-timer="10" id="download">
                <i class="fa-solid fa-arrow-down-to-line"></i>
                <span class="text">Download Files</span>
            </button>
            <script>
                const downloadBtn = document.querySelector(".download-btn");
                const fileLink = "' . $article->file . '";

                const initTimer = () => {
                    if(downloadBtn.classList.contains("disableTimer")) {
                        return location.href = fileLink;
                    }
                    let timer = downloadBtn.dataset.timer;
                    downloadBtn.classList.add("timer");
                    downloadBtn.innerHTML = `Your files will download in <b>${timer}</b> seconds`;
                    const initCounter = setInterval(() => {
                        if(timer > 0) {
                            timer--;
                            return downloadBtn.innerHTML = `Your files will download in <b>${timer}</b> seconds`;
                        }
                        clearInterval(initCounter);
                        location.href = fileLink;
                        downloadBtn.innerText = "Se están descargando los archivos";
                        setTimeout(() => {
                            downloadBtn.classList.replace("timer", "disableTimer");
                            downloadBtn.innerHTML = `<span class="icon material-symbols-rounded">vertical_align_bottom</span>
                                                    <span class="text">Download again</span>`;
                        }, 3000);
                    }, 1000);
                }
                    
                downloadBtn.addEventListener("click", initTimer);
            </script>';
            } else{
                if(isset($user)){
                    require "../../checkout/index.php";
                    echo '<button type="submit" class="download-btn" data-timer="0" id="download" onclick="window.location.href=`' . $approvalUrl . '`;">Buy Now for ' . $article->price . '</button>';
                } else{
                    echo '<button type="submit" class="download-btn" data-timer="0" id="download" onclick="window.location.href=`/login?r=' . $currentURL . '`;">Buy Now for ' . $article->price . '</button>';
                }
            }
            ?>
        </div>
        <?php require "sponsor.php"?>
    </div>
    <?php require "../../bottom.html"?>
    <div class="overlay" onclick="closeImage()"></div>
</body>
</html>
