<?php
// * Copyright ©Quelopande 2024. All Rights Reserved
// * Developer: Quelopande (quelopande.netlify.app)
session_start();

require "keys.php";
require "connection.php";
require "auth/google/config.php";

function revokeDiscordToken($accessToken) {
    $url = "https://discord.com/api/v10/oauth2/token/revoke";
    $data = [
        'token' => $accessToken,
        'token_type_hint' => 'access_token'
    ];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
}

function deleteCookie($name) {
    setcookie($name, '', time() - 3600, '/', '', true, true);
}

if (isset($_SESSION['discord_token'])) {
    $discordToken = $_SESSION['discord_token'];
    revokeDiscordToken($discordToken);
    unset($_SESSION['discord_token']);
}

$google_client->revokeToken();

session_unset();
session_destroy();
deleteCookie('user');

header('Location: login');
exit;
?>
