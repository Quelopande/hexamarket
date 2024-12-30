<?php session_start();
$errors = '';
$sectionCount = 0;
$user = $_SESSION['user'];
require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();

function removeSession(){
    unset($_SESSION['formData']);
}

function sanitize_input($data) {
    $data = str_replace(['<', '>', '/'], '', $data);
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function sanitize_filename($filename) {
    return preg_replace('/[^A-Za-z0-9_\- ]/', '_', $filename);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articleName = sanitize_input($_POST['articleName']);
    $category = sanitize_input($_POST['category']);

    if (strpos($articleName, '/') !== false || strpos($category, '/') !== false) {
        $errors .= "The article and the category mustn't have /.";
    }

    $articleName = sanitize_filename($articleName);
    $category = sanitize_filename($category);
    $tags = array_map('sanitize_input', explode(",", $_POST['tags']));
    $url = isset($_POST['url']) ? filter_var($_POST['url'], FILTER_SANITIZE_URL) : '';

    $sections = [];
    foreach ($_POST['sections'] as $section) {
        if ($sectionCount < 4) {
            $sections[] = [
                'title' => sanitize_input($section['title']),
                'description' => sanitize_input($section['description'])
            ];
            $sectionCount++;
        } else {
            $errors .= "You can't have more than 4 sections.";
        }
    }

    if (empty($articleName) || empty($_POST['tags']) || empty($_POST['sections'])) {
        $errors .= "You must fill all the gaps.";
    }

    $jsonString = file_get_contents('../content.json');
    $jsonData = json_decode($jsonString, true);

    $maxArticleId = 0;
    foreach ($jsonData['users'] as $user) {
        foreach ($user['articles'] as $article) {
            if ($article['articleId'] > $maxArticleId) {
                $maxArticleId = $article['articleId'];
            }
        }
    }
    $newArticleId = $maxArticleId + 1;

    if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
        $uploadFileType = strtolower(pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION));
        $uploadTargetDir = "download/";

        $uniqueUploadFileName = $newArticleId . "." . $uploadFileType;
        $uploadTargetFile = $uploadTargetDir . $uniqueUploadFileName;
        $downloadLink = "https://hexamarket.store/" . $uploadTargetFile;
        if ($uploadFileType !== "zip") {
            $errors .= "The file must be a .zip file. If you want to upload another type of file you must enter a download link (Mediafire, Google Drive ...) instead of uploading the file directly in Hexamarket.";
        } else {
            if (!move_uploaded_file($_FILES["upload"]["tmp_name"], $uploadTargetFile)) {
                $errors .= "Error while uploading the file.";
            }
        }
    } else {
        if (!empty($url)) {
            $downloadLink = $url;
        }
    }
    if (!isset($_FILES['upload']) && empty($url)) {
        $errors .= "You must upload a valid download file or enter a URL.";
    }

    $date = new DateTime('now', new DateTimeZone('GMT'));
    $formattedDate = $date->format('Y-m-d H:i:s');

    if (isset($_POST['price'])) {
        $price = sanitize_input($_POST['price']);
    
        if ($_POST['price'] === '') {
            $formattedPrice = null;
        } elseif (is_numeric($price) && $price >= 1 && $price <= 1000) {
            $formattedPrice = number_format((float)$price, 2, '.', '');
        } else {
            $errors .= "Please, introduce a valid price between 1 and 1000 USD.";
        }
    }    

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "assets/media/u/posts/";

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                $errors .= "Failed to create directory: $targetDir.";
            }
        }

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $errors .= "The file is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 7000000) {
            $errors .= "The file maximum size is 7MB.";
            $uploadOk = 0;
        }

        $allowedExtensions = ["jpg", "png", "jpeg", "gif", "webp"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            $errors .= "Only these image extensions are allowed: JPG, JPEG, PNG, GIF, and WEBP.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            $uniqueImageName = $newArticleId . '.webp';
            $targetFile = $targetDir . $uniqueImageName;
            $lastTargetFile = "/" . $targetFile;

            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $errors .= "Sorry, there was an error while uploading the file.";
            }
        } else {
            $errors .= "The file was not uploaded.";
        }
    }

    if ($errors == '') {
        $userIndex = null;
        foreach ($jsonData['users'] as $index => $user) {
            if ($user['id'] === $result['id']) {
                $userIndex = $index;
                break;
            }
        }
        if ($userIndex !== null) {
            $newArticle = [
                "articleId" => $newArticleId,
                "articleName" => $articleName,
                "category" => $category,
                "tags" => $tags,
                "status" => null,
                "sections" => $sections,
                "date" => $formattedDate,
                "file" => $downloadLink,
                "img" => $lastTargetFile,
                "price" => $formattedPrice
            ];

            array_push($jsonData['users'][$userIndex]['articles'], $newArticle);

            $updatedData = json_encode($jsonData, JSON_PRETTY_PRINT);
            file_put_contents('../content.json', $updatedData);

            $fileName = "things/$category/$articleName+$newArticleId.php";
            $htmlContent = <<<HTML
            <?php
            require "base.php";
            ?>
            <!-- 
            * Copyright ©Quelopande 2024. All Rights Reserved
            * Developer: Quelopande (quelopande.netlify.app)
            -->
            HTML;
            $directory = "things/$category";
            if (!is_dir($directory)) {
                if (!mkdir($directory, 0777, true)) {
                    $errors .= "Failed to create directory: $directory.";
                }
            }

            if (file_put_contents($fileName, $htmlContent) === false) {
                $errors .= "Failed to create the article file: $fileName.";
            } else {
                unset($_SESSION['formData']);
                header("Location: postsent?durl=$downloadLink");
                exit;
            }
        } else {
            echo "User not found.";
        }
    } else {
        $_SESSION['formData'] = $_POST;
    }
}

$savedFormData = $_SESSION['formData'] ?? [];

if ($result['status'] == 'verified') {
    require '../views/post.view.php';
} elseif ($result['status'] == 'notverified') {
    require '../views/nv.view.php';
} elseif (!isset($_SESSION['user'])) {
    header('Location: ../login');
} else {
    require '../ban.php';
}
?> 