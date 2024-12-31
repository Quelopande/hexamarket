<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = htmlspecialchars(strtolower(trim($_POST['user'])), ENT_QUOTES, 'UTF-8');
  $password = trim($_POST['password']);
  $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
  $password2 = trim($_POST['password2']);
  $rank = 'user';
  $status = 'notverified';
  $code = random_int(211111,999999);

  $errors = '';

  require "../keys.php";
  require '../recaptcha.php';

  $weakPasswords = array("password", "football", "basketball", "12345678", "123456789", "1234567890", "00000000", "11111111", "starwars", "qwertyuio", "qwerty123");

  if (empty($user) || empty($password) || empty($email) || empty($password2)) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Please you must fill all the gaps.</div></div>';
  } else if (!preg_match('/^[a-zA-Z0-9]+$/', $user)) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Username can only contain letters and numbers.</div></div>';
  } else if (strlen($password) < 8) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The password is too short, it must be more than 8 characters.</div></div>';
  } else if (in_array(strtolower($password), $weakPasswords)) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Too easy!! Please put a difficult password.</div></div>';
  } else if (strlen($user) > 20) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>That username is too long! Cannot be more than 20 characters.</div></div>';
  } else if (strlen($email) > 254) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The email is too long! Cannot be more than 254 characters.</div></div>';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Invalid email address</div></div>';
  } else {
    require '../connection.php';

    $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
    $statement->execute(array(':user' => $user));
    $result = $statement->fetch();

    $statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute(array(':email' => $email));
    $eresult = $statement->fetch();

    if (!isset($_POST['gpdr'])) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>You must have more than 16 before submitting.</div></div>';
    }

    if (!isset($_POST['agree'])) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>You must agree before submitting.</div></div>';
    }

    if ($result != false) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>This username already exists.</div></div>';
    }
    if ($eresult != false) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>This email is already in use! If you think that is an issue, contact the staff.</div></div>';
    }

    $pepper = getenv("pepper");

    $salt = openssl_random_pseudo_bytes(32);
    $passPepper = $password . $pepper . $salt;
    $hash = password_hash($passPepper, PASSWORD_BCRYPT, ['cost' => 12]);

    if ($password !== $password2) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The passwords are not the same</div></div>';
    }
  }

  if ($errors === '') {
    $statement = $connection->prepare('INSERT INTO users (id, user, email, pass, salt, rank, code, status) VALUES (NULL, :user, :email, :pass, :salt, :rank, :code, :status)');
    $statement->execute(array(
      ':user' => $user,
      ':rank' => $rank,
      ':email' => $email,
      ':pass' => $hash,
      ':code' => $code,
      ':status' => $status,
      ':salt' => $salt,
    ));
    
    function encryptCookie($data) {
      $encryptionKey = $cookieEncryptKey;
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-gcm'));
      $ciphertext = openssl_encrypt($data, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);
      return base64_encode($iv . $tag . $ciphertext);
  }

  $encryptedCookieValue = encryptCookie($user);

  setcookie('user', $encryptedCookieValue, time() + 15 * 24 * 60 * 60, '/', '', true, true);
  $_SESSION['user'] = $user;

  header('Location: /');
    exit;
  }
}

require "../vendor/dbMail.php";
require '../views/signup.view.php';?>