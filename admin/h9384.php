<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

$user = $_SESSION['user'];
$errors = '';

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();
$adminId = $result['id'];
if (!$result) {
    header('Location: ../login.php');
    exit();
}

if ($result['rank'] !== 'admin') {
    header('Location: ../ban.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jsonString = file_get_contents('../content.json');
    $jsonData = json_decode($jsonString, true);

    $articleToDelete = filter_var(strtolower($_POST['ParticleId']), FILTER_SANITIZE_STRING);
    $reason = filter_var(strtolower($_POST['reason']), FILTER_SANITIZE_STRING);

    $articleJson = null;
    $euserIndex = null;
    $articleIndex = null;

    foreach ($jsonData['users'] as $euserIndex => &$euser) {
        $userId = $euser['id'];
        foreach ($euser['articles'] as $articleIndex => $article) {
            if ($article['articleId'] == $articleToDelete) {
                $articleName = $article['articleName'];
                $articleImg = $article['img'];
                $articleFile = "download/" . $articleId . ".zip";
                $articleCategory = $article['category'];
                $articleJson = json_encode($article, JSON_PRETTY_PRINT);
                unset($euser['articles'][$articleIndex]);
                break 2;
            }
        }
    }

    $fileName = "things/$articleCategory/$articleName+$articleToDelete.php";

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
    
    foreach ($jsonData['users'] as &$euser) {
        $euser['articles'] = array_values($euser['articles']);
    }

    $updatedJson = json_encode($jsonData, JSON_PRETTY_PRINT);
    file_put_contents('content.json', $updatedJson);

    $webhookUrl = getenv("adminArticleDeletionWebhook");
    $message = [
        'username'   => 'Admin log | Hexamarket',
        'avatar_url' => 'https://www.hexamarket.store/assets/media/logo.webp',
        'embeds'     => [
            [
                'title'       => 'Article Deletion Log',
                'description' => "- **Admin:** $user ($adminId)\n"
                                 . "- **Article:** $articleToDelete\n"
                                 . "- **Reason:** $reason\n"
                                 . "- **Article user id:** $userId\n",
                'color'       => hexdec('FF5733'),
                'footer'      => [
                    'text' => 'Article admin log',
                ],
                'timestamp'   => date('c'),
            ],
        ],
        'content'    => "<@&1254119069100015697>\n```json\n$articleJson\n```",
    ];

    $jsonPayload = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo 'Message sent successfully!';
    }
}

require 'views/h9384.view.php';
?>