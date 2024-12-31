<?php
session_start(); // Iniciar la sesión al principio del script (Default empty session: U2FsdGVkX1+uZiT8b0ZsR6NCO2ofWhNZXAYsiEg8FhF/OORTGBKgDOJWimWHZHSg)

require "../keys.php";

$redirectUri = isset($_GET['link']) ? 
    "https://www.hexamarket.store/auth/discord?link" : 
    "https://www.hexamarket.store/auth/discord";

$config = [
    "clientId" => $clientDiscord["clientId"],
    "clientSecret" => $clientDiscord["clientSecret"],
    "redirectUri" => $redirectUri
];


if (!isset($_GET['code'])) {
    die("Authorization code not provided.");
}

$code = $_GET['code'];

$tokenUrl = "https://discord.com/api/oauth2/token";
$data = [
    "client_id" => $config["clientId"],
    "client_secret" => $config["clientSecret"],
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $config["redirectUri"]
];

$options = [
    "http" => [
        "header"  => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method"  => "POST",
        "content" => http_build_query($data)
    ]
];

$context  = stream_context_create($options);
$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
}

curl_close($ch);
$tokenData = json_decode($response, true);

if (isset($tokenData['error'])) {
    die('Error: ' . htmlspecialchars($tokenData['error_description']));
}

$accessToken = $tokenData['access_token'];

$userUrl = "https://discord.com/api/users/@me";
$options = [
    "http" => [
        "header"  => "Authorization: Bearer $accessToken\r\n",
        "method"  => "GET"
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($userUrl, false, $context);

if ($response === FALSE) {
    die('Error fetching user data.');
}

$userData = json_decode($response, true);

if (isset($userData['error'])) {
    die('Error: ' . htmlspecialchars($userData['error_description']));
}

$email = htmlspecialchars($userData['email']);
$authDiscordId = htmlspecialchars($userData['id']);
$authUsername = htmlspecialchars($userData['username']);

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
$statement->execute(array(':email' => $email));
$result = $statement->fetch();

$estatement = $connection->prepare('SELECT * FROM users WHERE discordId = :discordId LIMIT 1');
$estatement->execute(array(':discordId' => $authDiscordId));
$eresult = $estatement->fetch();

$istatement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$istatement->execute(array(':user' => $authUsername));
$iresult = $istatement->fetch();

$discordId = $result['discordId'];
$user = $_SESSION['user'];
if(isset($user)){
    $hstatement = $connection->prepare('SELECT * FROM users WHERE discordId = :discordId LIMIT 1');
    $hstatement->execute(array(':discordId' => $authDiscordId));
    $hresult = $hstatement->fetch();
    if($hresult){
        header('../link?error=<i class="fa-brands fa-discord"></i> Discord ERROR: There is another account with the same Discord account linked.');
    } else{    
        $statement = $connection->prepare('UPDATE users SET discordId = :discordId WHERE user = :user');
        $statement->execute(array(
            ':discordId' => $authDiscordId,
            ':user' => $user,
        ));
    }
} else{
    if($result['discordId'] === ''){
        $statement = $connection->prepare('UPDATE users SET discordId = :discordId WHERE email = :email');
        $statement->execute(array(
            ':discordId' => $authDiscordId,
            ':email' => $email,
        ));
        $user = $result['user'];
        $_SESSION['user'] = $user;
    } elseif($eresult){
        $user = $eresult['user'];
        $_SESSION['user'] = $user;
    } elseif($iresult){
        $newUsername = $authUsername . mt_rand(11111,99999);
        $rank = 'user';
        $status = 'notverified';
        $code = mt_rand(211111,999999);
        $salt = openssl_random_pseudo_bytes(32);
    
        $statement = $connection->prepare('INSERT INTO users (id, user, email, salt, rank, code, status, discordId) VALUES (NULL, :user, :email, :salt, :rank, :code, :status, :discordId)');
        $statement->execute(array(
            ':user' => $newUsername,
            ':rank' => $rank,
            ':email' => $email,
            ':code' => $code,
            ':status' => $status,
            ':salt' => $salt,
            ':discordId' => $authDiscordId,
        ));
        $user = $newUsername;
        $_SESSION['user'] = $user;
    } else{
        $rank = 'user';
        $status = 'notverified';
        $code = mt_rand(211111,999999);
        $salt = openssl_random_pseudo_bytes(32);
    
        $statement = $connection->prepare('INSERT INTO users (id, user, email, salt, rank, code, status, discordId) VALUES (NULL, :user, :email, :salt, :rank, :code, :status, :discordId)');
        $statement->execute(array(
            ':user' => $authUsername,
            ':rank' => $rank,
            ':email' => $email,
            ':code' => $code,
            ':status' => $status,
            ':salt' => $salt,
            ':discordId' => $authDiscordId,
        ));
        $user = $authUsername;
        $_SESSION['user'] = $user;
    }
}
$finalRedirection = isset($_GET['link']) ? 
    "../link" : 
    "../";
header($finalRedirection);