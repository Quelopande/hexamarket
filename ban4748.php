<?php
session_start();
$user = $_SESSION['user'];
$passErrors = '';

require 'connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();
$id = $result['id'];
if ($result['rank'] !== 'admin' && $result['rank'] !== 'mod') {
    header('Location: ban.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $euser = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $reason = filter_var(strtolower($_POST['reason']), FILTER_SANITIZE_STRING);
    $ban = "ban";

    $estatement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
    $estatement->execute(array(':user' => $euser));
    $eresult = $estatement->fetch();
    if($eresult['rank'] == "user"){
        $estatement = $connection->prepare('UPDATE users SET status = :status, rank = :rank WHERE user = :user');
        $estatement->execute(array(
            ':user' => $euser,
            ':status' => $ban,
            ':rank' => $ban,
        ));
    $webhookUrl = "https://discord.com/api/webhooks/1254118321943478414/EHr4sHfQEJaAjekhwvTWF0gZX-8K7LitukW67VIEi-OBLK9lOixF58o7fxWNbwqNA5de";

    $message = [
        'username'   => 'Admin log | Quelopande',
        'avatar_url' => 'https://www.hexamarket.store/assets/media/logo.webp',
        'embeds'     => [
            [
                'title'       => 'User bans Log',
                'description' => "- **Admin:** $user ($id)\n"
                                . "- **Banned user:** $euser\n"
                                . "- **Reason:** $reason\n",
                'color'       => hexdec('FF5733'),
                'footer'      => [
                    'text' => 'Bans admin log | Copyright ©Quelopande 2024. All Rights Reserved',
                ],
                'timestamp'   => date('c'),
            ],
        ],
        'content'    => "<@&1254119069100015697>",
    ];
    $jsonPayload = json_encode($message);

    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);

    $response = curl_exec($ch);
    curl_close($ch);
    echo "<b><em>User banned</em></b>";
    } else if($eresult['rank'] == "ban"){
        echo "<b>User is already banned</b>";
    } else if($eresult['rank'] == "admin" OR $eresult['rank'] == "mod"){
        echo "You can't ban people with admin or mod rank.";
    } else{
        echo "You can't ban people with not user rank.";
    }
    $profileImg = "/assets/media/u/profile/" . $eresult['id'] . ".webp";
    if (file_exists($profileImg)) {
        if (unlink($profileImg)) {
            echo "The img of the user was deleted.";
        }
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="user">Ban user with username:</label>
        <input type="text" name="user" required placeholder="Username">
        <br>
        <label for="reason">User ban reason:</label>
        <input type="text" name="reason" required placeholder="Reason">
        <br>
        <button type="submit">Ban</button>
        <p>Remember to delete all the articles of the user</p>
    </form>
</body>
</html>