<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';

$googleSecret = getenv("googleClientSecret");
$google_client = new Google_Client();
$google_client->setClientId('984657386074-ud52oefhvedl35t6jn7ophdpmehefkso.apps.googleusercontent.com');
$google_client->setClientSecret("$googleSecret");
$redirectUri = isset($_GET['link']) ? 
    "https://hexamarket.store/auth/google/index.php?link=" : 
    "https://hexamarket.store/auth/google/index.php";
$google_client->setRedirectUri($redirectUri);

$google_client->addScope('email');
$google_client->addScope('profile');

// if (!isset($_SESSION['access_token'])) {
//     // Genera el enlace de autenticación
//     $login_url = $google_client->createAuthUrl();
//     // Muestra el enlace como un enlace HTML
//     echo '<a href="' . htmlspecialchars($login_url) . '">Login with Google</a>';
// } else {
//     // Si ya tienes el access_token, puedes redirigir al usuario o mostrar un mensaje
//     echo 'You are already logged in.';
// }

?>