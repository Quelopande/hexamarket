<?php
session_start();
$user = $_SESSION['user'];
$passErrors = '';

require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();
$id = $result['id'];
$pass = $result['pass'];
$email = $result['email'];
$code = $result['code'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['changepassword'])) {
    $oldPassword = strtolower($_POST['oldPassword']);
    $newPassword = strtolower($_POST['newPassword']);
    $newPasswordV = strtolower($_POST['newPasswordV']);
    $passwordCode =  htmlspecialchars(strtolower(trim($_POST['passCode'])), ENT_QUOTES, 'UTF-8');
    $newCode= random_int(211111,999999);

    $pepper = getenv("pepper");
    $oldPassPepper = $oldPassword . $pepper . $result['salt'];
    $passPepper = $newPassword . $pepper . $result['salt'];
    $hash = password_hash($passPepper, PASSWORD_BCRYPT, ['cost' => 12]);
    $weakPasswords = array("password", "football", "basketball", "12345678", "123456789", "1234567890", "00000000", "11111111", "starwars", "qwertyuio", "qwerty123");


    if(empty($newPassword) || empty($oldPassword) || empty($newPasswordV)){
      $passErrors .= 'Fill all the gaps';
    } else{
      if(!password_verify($oldPassPepper, $pass)){
        $passErrors .= 'You must fill the "Old password" gap with your actual password.';
      } else{
        if(password_verify($passPepper, $pass)) {
          $passErrors .= 'The new password and the old password can´t be same.';
        } else{
          if($newPassword !== $newPasswordV){
            $passErrors .= 'The "New password" gap and the "New password 2" gap must have the same password.';
          } else{
            if(empty($passwordCode)){
              $passErrors .= 'To change the password you must fill the verification code gap with a code that has been sent to your email.';
            } elseif($passwordCode !== $code){
              $passErrors .= 'The verification code is incorrect.';
            }
            elseif(in_array(strtolower($newPassword), $weakPasswords) || (strlen($newPassword) < 2)){
            $passErrors .= 'The password is too weak. The password must have more than 8 characters. And the password must be secure';
            } else {
              header('Location: ../auth/close.php'); 
              $statement = $connection->prepare('UPDATE users SET pass = :pass, code = :code WHERE id = :id');
              $statement->execute(array(
                ':id' => $id,
                ':pass' => $hash,
                ':code' => $newCode,
              ));
            require '../config.php';
            require '../vendor/autoload.php';
            require "../vendor/dbMail.php";
            $title = 'Password has been changed';
              $message = "
              <html>
                  <body style='background-color: rgb(242, 242, 242); margin: 0 auto;padding: 30px;margin-top: 100px; width: 500px;height: 400px;border: solid 3px #989898;border-radius: 20px;'>
                      <h1 style='font-weight: 900;'>Your account password has been changed</h1>
                      <p style='margin-bottom: 20px;'>Hi dear<b> $user !</b> <br> </p>
                      <p>It seems that you have changed your password. If it wasn't you the person who has changed the password or you don't remember your new password you can recover your account. Get more information about the recovery of an account in this <a href='https://www.hexamarket.store/documentation/guides/account/account+recovery' style='color: #0062ff;font-weight: 700;text-decoration: none;'>article.</a><p>
                      <footer style='display: flex;flex-direction: column; align-items: center;'>
                          <p class='sub' style='color: rgb(108, 108, 108);text-align: center;'>This mail was sent by Hexamarket for $user ($email)</p>
                          <div class='quelopande'>
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
            }
          }
        }
      }
    }
  }
}


if (isset($_SESSION['user'])){
  require '../views/security.view.php';
} else if (!isset($_SESSION['user'])){
  header('Location: ../auth/login');
} else {
header('Location: ../auth/ban');
}