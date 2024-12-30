<?php
session_start();

$id = null;
$username = null;
$result = null;
$error = null;
require 'connection.php';
$user = $_SESSION['user'];

$verifyStatement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$verifyStatement->execute(array(':user' => $user));
$verifyResult = $verifyStatement->fetch();

if ($verifyResult['rank'] !== 'admin' && $verifyResult['rank'] !== 'mod') {
  header('Location: ban.php');
  exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];


        $statement = $connection->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $statement->execute(array(':id' => $id));
        $result = $statement->fetch();

        if (!$result) {
            $error = "No se encontró ningún usuario con el ID proporcionado.";
        }
    }
    elseif (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = $_POST['username'];

        require 'connection.php';
        $statement = $connection->prepare('SELECT * FROM users WHERE user = :username LIMIT 1');
        $statement->execute(array(':username' => $username));
        $result = $statement->fetch();

        if (!$result) {
            $error = "No se encontró ningún usuario con el nombre de usuario proporcionado.";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        require 'connection.php';
        $statement = $connection->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $statement->execute(array(':id' => $id));
        $result = $statement->fetch();

        if (!$result) {
            $error = "A user with that ID couldn't be found.";
        }
    }
    elseif (isset($_GET['username']) && !empty($_GET['username'])) {
        $username = $_GET['username'];

        require 'connection.php';

        $statement = $connection->prepare('SELECT * FROM users WHERE user = :username LIMIT 1');
        $statement->execute(array(':username' => $username));
        $result = $statement->fetch();

        if (!$result) {
            $error = "A user with that username couldn't be found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar usuario</title>
</head>
<body>
    <h2>Look for a user</h2>
    <form method="POST">
        <label for="id">ID of the user:</label>
        <input type="text" id="id" name="id">
        <button type="submit">Searh by id</button>
    </form>
    <br>
    <form method="POST">
        <label for="username">Username of the user:</label>
        <input type="text" id="username" name="username">
        <button type="submit">Searh by username</button>
    </form>
    <br>

    <?php if ($result): ?>
        <h3>Search result:</h3>
        <p>ID: <?php echo $result['id']; ?></p>
        <p>Username: <?php echo $result['user']; ?></p>
        <p>Email: <?php if ($verifyResult['rank'] == 'admin'){
echo $result['email'];
        } else {echo "You can't get access to that information with your actual perms level.";}?></p>
    <?php elseif ($error): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>