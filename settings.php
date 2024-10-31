<?php
session_start();
$user = $_SESSION['user'];
$profileImgNotifications = '';
$userErrors = '';
$emailErrors = '';

require 'connection.php';
require "vendor/dbMail.php";

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();
$id = $result['id'];
$email = $result['email'];
require 'config.php';
require 'vendor/autoload.php';
// $mail = new PHPMailer\PHPMailer\PHPMailer();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST["changeProfileImgSubmit"])) {
    $targetDir = "assets/media/u/profile/";
    $fileName = $id . ".webp";
    
    $targetFilePath = $targetDir . $fileName;
      if (!empty($_FILES["image"]["name"])) {
        $allowTypes = array('webp', 'jpeg', 'jpg', 'png', 'gif');
        $fileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $profileImgNotifications .= "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " was uploaded successfully.";
          } else {
            $profileImgNotifications .= "There was an error while uploading a file.";
          }
        } else {
          $profileImgNotifications .= "You must upload files of this types: " . implode(', ', $allowTypes);
        }
      } else {
        $profileImgNotifications .= "Select a image for your profile.";
      }
  }
  
  if (isset($_POST['changeUsernameSubmit'])) {
    $oldUser = filter_var(strtolower($_POST['oldUser']), FILTER_SANITIZE_STRING);
    $newUser = filter_var(strtolower($_POST['newUser']), FILTER_SANITIZE_STRING);

    $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
    $statement->execute(array(':user' => $newUser));
    $eresult = $statement->fetch();

    if(empty($newUser) || empty($oldUser)){
      $userErrors .= 'Fill all the gaps';
    } else{
      if(($oldUser == $user) == false){
        $userErrors .= 'You must fill the "Old user" gap with your actual username.';
      } else{
        if($oldUser == $newUser) {
          $userErrors .= 'The new username and the old username are the same.';
        } else{
          if($eresult == false){
            $userErrors .= 'This username is being used by someone else.';
          } else{
            rename("u/$user.php", "u/$newUser.php");
            header('Location: close.php'); 
            $statement = $connection->prepare('UPDATE users SET user = :user WHERE id = :id');
            $statement->execute(array(
                ':id' => $id,
                ':user' => $newUser,
            ));
            $title = 'Username has been changed';

            $message = "
            <html>
                <body style='background-color: rgb(242, 242, 242); margin: 0 auto;padding: 30px;margin-top: 100px; width: 500px;height: 300px;border: solid 3px #989898;border-radius: 20px;'>
                    <h1 style='font-weight: 900;'>Your username has been changed</h1>
                    <p style='margin-bottom: 20px;'>Hi dear<b> $user !</b> <br> </p>
                    <p>You recently have changed your account username from <b>$user</b> to <b>$newUser</b>. If it wasn't you, you can change again your username in the <a href='https://hexamarket.store/settings' style='color: #0062ff;font-weight: 700;text-decoration: none;'>settings page</a>.<p>
                    <footer style='display: flex;flex-direction: column; align-items: center;'>
                        <p class='subpande' style='color: rgb(108, 108, 108);text-align: center;'>This mail was sent by Hexamarket for $newUser ($email)</p>
                        <div class='quelopande'>
                            <p style='font-weight: 900;font-size: 25px;margin-left: 10px;'>Hexamarket</p>
                        </div>
                    </footer>
                </body>
            </html>
            ";
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
  if (isset($_POST['changeEmailSubmit'])) {
    $email = $result['email'];
    $oldEmail = filter_var(strtolower($_POST['oldEmail']), FILTER_SANITIZE_EMAIL);
    $newEmail = filter_var(strtolower($_POST['newEmail']), FILTER_SANITIZE_EMAIL);
    $status = 'notverified';
    $code=mt_rand(211111,999999);

    $statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute(array(':email' => $newEmail));
    $iresult = $statement->fetch();

    if(empty($newEmail) || empty($oldEmail)){
      $emailErrors .= 'Fill all the gaps';
    } else{
      if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL) OR !filter_var($oldEmail, FILTER_VALIDATE_EMAIL)){
        $emailErrors .= 'Invalid email adress.';
      } else{
        if(($oldEmail == $email) == false){
          $emailErrors .= 'You must fill the "Old user" gap with your actual email.';
        } else{
          if($oldEmail == $newEmail) {
            $emailErrors .= 'The new email and the old email can´t be same.';
          } else{
            if($iresult == false){
              $emailErrors .= 'This email is being used by someone else.';
            } else{
              header('Location: close.php'); 
              $statement = $connection->prepare('UPDATE users SET email = :email, status = :status, code = :code WHERE id = :id');
              $statement->execute(array(
                  ':id' => $id,
                  ':code' => $code,
                  ':status' => $status,
                  ':email' => $newEmail,
              ));
              $etitle = 'Email has been changed';

              $emessage = "
              <html>
                  <body style='background-color: rgb(242, 242, 242); margin: 0 auto;padding: 30px;margin-top: 100px; width: 500px;height: 350px;border: solid 3px #989898;border-radius: 20px;'>
                      <h1 style='font-weight: 900;'>Your account email has been changed</h1>
                      <p style='margin-bottom: 20px;'>Hi dear<b> $user !</b> <br> </p>
                      <p>You recently have changed your Hexamarket account username from <b>$email</b> to <b>$newEmail</b>. If it wasn't you, you can change again your email, in the settings page. Therefore you must verify your email in <a href='https://hexamarket.store/verify'  style='color: #0062ff;font-weight: 700;text-decoration: none;'>verify page</a> by entering the code we´ve sent you to your new email.<p>
                      <footer style='display: flex;flex-direction: column; align-items: center;'>
                          <p class='sub' style='color: rgb(108, 108, 108);text-align: center;'>This mail was sent by Hexamarket for $user ($email)</p>
                          <div class='Hexamarket'>
                              <p style='font-weight: 900;font-size: 25px;margin-left: 10px;'>Hexamarket</p>
                          </div>
                      </footer>
                  </body>
              </html>
              ";
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
                $mail->Subject = $etitle;
                $mail->Body    = $emessage;
                $mail->AltBody = strip_tags($emessage);

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
  require 'views/settings.view.php';
} else if (!isset($_SESSION['user'])){
  header('Location: login.php');
} else {
header('Location: ban.php');
}