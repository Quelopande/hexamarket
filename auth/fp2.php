<?php
session_start();
$errors = '';
$email = '';
$zero = '';
$code = '';
$password = '';
$password2 = '';
$weakPasswords = array("password", "Password", "PASSWORD", "pASSWORD", "football", "basketball", "12345678", "123456789", "1234567890", "00000000", "11111111", "starwars", "qwertyuio", "qwerty123");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
  $code = filter_var(strtolower($_POST['code']), FILTER_SANITIZE_STRING);
  $password = strtolower($_POST['password']);
  $password2 = strtolower($_POST['password2']);

  if (empty($code) || empty($password) || empty($email) || empty($password2)) {
    $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Fill all the gaps.</div></div>';
  } else {
    require '../connection.php';

    $statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute(array(':email' => $email));
    $result = $statement->fetch();
    $resetcode = $result['resetcode'];
    require 'secure_pepper.php';
    $passPepper = $password . $pepper . $result['salt'];


    if (!$result) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Email not found.</div></div>';
    } else if($result['resetcode'] != $code){
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The code is an incorrect code.</div></div>';
    } else if(strlen($password) < 8){
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The password is too short, it must be more than 8 characters.</div></div>';
    } else if (in_array(strtolower($password), $weakPasswords)) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Too easy!! Please put a difficult password.</div></div>';
    } else if ($password != $password2){
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>You must fill both password gaps with the same password.</div></div>';
    } else if (password_verify($passPepper, $result['pass'])) {
      $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>The new password can be the same as the old password.<div></div>';
    }
  }

  if ($errors === '') {
    $hash = password_hash($passPepper, PASSWORD_BCRYPT, ['cost' => 12]);
    $statement = $connection->prepare('UPDATE users SET pass = :pass, resetcode = :resetcode WHERE email = :email');
    $statement->execute(array(
      ':email' => $email,
      ':pass' => $hash,
      ':resetcode' => $zero,
    ));

    require '../config.php';
    require '../vendor/autoload.php';

    $title = 'Your password has been changed';
  
    $message = "
    <html>
        <body style='background-color: rgb(242, 242, 242); margin: 0 auto;padding: 30px;margin-top: 100px; width: 500px;height: 400px;border: solid 3px #989898;border-radius: 20px;'>
            <h1 style='font-weight: 900;'>Your password has been changed</h1>
            <p style='margin-bottom: 20px;'>Hi dear<b> $user !</b> <br> </p>
            <p>Your password has been changed. If it wasn't you, you can change the password again in the 'Forgotten password' by verifying your identity and changing again your password. If you want to get more information about how to recover your account in this <a href='https://www.hexamarket.store/documentation/guides/minecraft/account+recovery' style='color: #0062ff;font-weight: 700;text-decoration: none;'>article</a><p>
            <footer style='display: flex;flex-direction: column; align-items: center;'>
                <p class='sub' style='color: rgb(108, 108, 108);text-align: center;'>This mail was sent by Hexamarket for $user ($email)</p>
                <div class='Hexamarket'>
                    <p style='font-weight: 900;font-size: 25px;margin-left: 10px;'>Hexamarket</p>
                </div>
            </footer>
        </body>
    </html>
    ";
    
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = CONTACTFORM_SMTP_HOSTNAME;
        $mail->SMTPAuth   = true;
        $mail->Username   = CONTACTFORM_SMTP_USERNAME;
        $mail->Password   = CONTACTFORM_SMTP_PASSWORD;
        $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
        $mail->Port       = CONTACTFORM_SMTP_PORT;

        $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        $mail->send();
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        echo 'An error occurred. Please try again later.';
    }

    header('Location: ../login.php');
    exit;
  }
}

require '../views/fp2.view.php';
