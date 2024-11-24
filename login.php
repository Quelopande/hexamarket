<!-- * Copyright ©Quelopande 2024. All Rights Reserved
* Developer: Quelopande (quelopande.netlify.app) -->
<?php
session_start();

require "keys.php";
$show2FAForm = false;
$errors = '';

function encryptCookie($data) {
    global $cookieEncryptKey;
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-gcm'));
    $ciphertext = openssl_encrypt($data, 'aes-256-gcm', $cookieEncryptKey, 0, $iv, $tag);
    return base64_encode($iv . $tag . $ciphertext);
}

function decryptCookie($data) {
    global $cookieEncryptKey;
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length('aes-256-gcm');
    $iv = substr($data, 0, $iv_length);
    $tag = substr($data, $iv_length, 16);
    $ciphertext = substr($data, $iv_length + 16);
    return openssl_decrypt($ciphertext, 'aes-256-gcm', $cookieEncryptKey, 0, $iv, $tag);
}

if (isset($_COOKIE['user'])) {
    $decryptedUser = decryptCookie($_COOKIE['user']);
    if ($decryptedUser) {
        $_SESSION['user'] = $decryptedUser;
        header('Location: /');
        exit;
    }
}

require "vendor/dbMail.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = htmlspecialchars(strtolower(trim($_POST['user'])), ENT_QUOTES, 'UTF-8');
    $password = trim($_POST['password']);
    
    require 'recaptcha.php';

    if (empty($user) || empty($password)) {
        $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert">Please, fill the gaps.</div>';
    } else {
        require 'connection.php';

        $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
        $statement->execute([':user' => $user]);
        $result = $statement->fetch();

        if ($result === false) {
            $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert">Username not found.</div>';
        } else {
            require 'secure_pepper.php';
            $passPepper = $password . $pepper . $result['salt'];

            if (!password_verify($passPepper, $result['pass'])) {
                $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert">Incorrect password.</div>';
            }
        }
    }

    if ($errors === '') {
        $totpStatement = $connection->prepare('SELECT totpSecret, totpKey, totpIv, totpTag FROM usersTotp WHERE id = :id LIMIT 1');
        $totpStatement->execute([':id' => $result['id']]);
        $totpResult = $totpStatement->fetch();

        if ($totpResult) {
            $show2FAForm = true;
            require_once 'GoogleAuthenticator.php';
            $ga = new PHPGangsta_GoogleAuthenticator();

            if (isset($_POST['code1'], $_POST['code2'], $_POST['code3'], $_POST['code4'], $_POST['code5'], $_POST['code6'])) {
                $oneCodeInput = trim($_POST['code1'] . $_POST['code2'] . $_POST['code3'] . $_POST['code4'] . $_POST['code5'] . $_POST['code6']);
                $cypherMethod = 'AES-256-GCM';
                $encryptedData = base64_decode($totpResult['totpSecret']);
                $key = $totpResult['totpKey'];
                $iv = $totpResult['totpIv'];
                $tag = $totpResult['totpTag'];
                $ciphertext = substr($encryptedData, 28);

                $secret = openssl_decrypt($ciphertext, $cypherMethod, $key, $options = 0, $iv, $tag);
                $checkResult = $ga->verifyCode($secret, $oneCodeInput, 2);

                if ($checkResult) {
                    echo 'Código correcto. Autenticación exitosa.';
                    $encryptedCookieValue = encryptCookie($user);
                    setcookie('user', $encryptedCookieValue, time() + 15 * 24 * 60 * 60, '/', '', true, true); // 15 days cookie
                    $_SESSION['user'] = $user;
                    $redirectURL = isset($_POST['redirect']) ? $_POST['redirect'] : (isset($_GET['r']) ? $_GET['r'] : '/saas');
                    header("Location: $redirectURL");
                    exit;
                } else {
                    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert">Incorrect code. Try again.</div>';
                }
            }
        } else {
            $encryptedCookieValue = encryptCookie($user);
            setcookie('user', $encryptedCookieValue, time() + 15 * 24 * 60 * 60, '/', '', true, true, 'Strict'); // 15 days cookie
            $_SESSION['user'] = $user;
            header("Location: /");
            exit;
        }
    }
}

require 'views/login.view.php';
?>
