<?php
session_start();

$user = $_SESSION['user'];

$errors = '';

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();

if($_GET['unlink'] === 'google'){
    $statement = $connection->prepare('UPDATE users SET googleId = :googleId WHERE user = :user');
    $statement->execute(array(
        ':googleId' => '',
        ':user' => $user,
    ));
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
}else if($_GET['unlink'] === 'discord'){
    $statement = $connection->prepare('UPDATE users SET discordId = :discordId WHERE user = :user');
    $statement->execute(array(
        ':discordId' => '',
        ':user' => $user,
    ));
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
} else if($_GET['unlink'] === 'paypal'){
  $statement = $connection->prepare('UPDATE users SET PayPalEmail = :PayPalEmail WHERE user = :user');
  $statement->execute(array(
      ':PayPalEmail' => '',
      ':user' => $user,
  ));
  $page = $_SERVER['PHP_SELF'];
  $sec = "0";
  header("Refresh: $sec; url=$page");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  $statement = $connection->prepare('UPDATE users SET PayPalEmail = :PayPalEmail WHERE user = :user');
  $statement->execute(array(
      ':PayPalEmail' => $email,
      ':user' => $user,
  ));
  $page = $_SERVER['PHP_SELF'];
  $sec = "0";
  header("Refresh: $sec; url=$page");
}

if (isset($_SESSION['user'])){
  require '../views/link.view.php';
} else if (!isset($_SESSION['user'])){
  header('Location: ../auth/login');
} else {
header('Location: ../auth/ban');
}
