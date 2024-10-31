<?php
session_start();
$user = $_SESSION['user'];


$errors = '';

require 'connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();


if (isset($_SESSION['user'])) {
  require 'views/postsent.view.php';
} else if (!isset($_SESSION['user'])){
header('Location: login.php');
} else {
header('Location: ban.php');
}
