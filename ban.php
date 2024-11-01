<?php
session_start();

$user = $_SESSION['user'];

$errors = '';

require 'connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();


if (isset($_SESSION['user'])){
} else if (!isset($_SESSION['user'])){
  header('Location: login.php');
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body{
            overflow-x: hidden;
            background-color: #f9f9f9;
            font-family: "Poppins", sans-serif;
        }
    </style>
    You have been banned from Hexamarket
    <br>
    <!-- <p>If you just changed the username. Try to <a href="close.php">close the sesion</a></p> -->
</body>
</html>