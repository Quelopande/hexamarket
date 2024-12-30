<?php
function getJSONData($filename) {
    $jsonData = file_get_contents($filename);
    return json_decode($jsonData, true);
}

function saveJSONData($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}
$filename = $contentFile;
$data = getJSONData($filename);

$allArticles = [];

foreach ($data['users'] as &$euser) {
    foreach ($euser['articles'] as $article) {
        if(isset($cat)){
            if ($article['category'] === $cat) {
                $allArticles[] = $article;
            }
        } else{
            $allArticles[] = $article;
        }
    }
}

shuffle($allArticles);
$DBconnection = dbconnection();

if(is_null($article['img'])){
    $img = "https://hexamarket.store/assets/media/no_results_found.webp";
} else{
    $img = $article['img'];
}
?>

    <?php foreach ($allArticles as $article): ?>
        <?php
        $articleId = $article['articleId'];
        $articleName = $article['articleName'];
        $articleCategory = $article['category'];
        
        $fileName = "things/$articleCategory/$articleName+$articleId.php";
        ?>
        <?php if (isset($article['status']) && !empty($article['status'])): ?>
            <a class="container">
                <img loading="lazy" src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($article['articleName']) ?>">
                <h1><?= htmlspecialchars($article['articleName']) ?></h1>
                <div>
                    <button class="download" onclick="window.location.href='<?= htmlspecialchars($article['file'])?>'"><?= $download ?></button>
                    <button class="more" onclick="window.location.href='<?= $fileName; ?>'"><?= $more ?></button>
                </div>
                <p class='hidden-tags'>
                <?php foreach ($article['tags'] as $tag) {
                    echo "<span>" . htmlspecialchars($tag) . "</span> ";
                } ?>
                </p>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>