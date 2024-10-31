<?php
session_start();

$user = $_SESSION['user'];

$errors = '';

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();


if (isset($_GET['signup'])) {
  if (isset($_SESSION['user'])){
    header('Location: ../dashboard');
  } else if (!isset($_SESSION['user'])){
    header('Location: ../signup');
  } else {
  header('Location: ../ban');
  }
} else {
  if (isset($_SESSION['user'])){
    header('Location: ../dashboard');
  } else if (!isset($_SESSION['user'])){
    header('Location: ../login');
  } else {
  header('Location: ../ban');
  }
}