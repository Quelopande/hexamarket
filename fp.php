<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = str_shuffle($characters);
    $resetcode = substr($randomString, 0, 100);
    $errors = '';
    require 'connection.php';

    $statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute(array(':email' => $email));
    $result = $statement->fetch();

    if ($result !== false) {
        $user = $result['user'];
        $eResetCode = $result['resetcode'];

        require 'config.php';
        require 'vendor/autoload.php';
        $title = 'Change your account password';
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        $message = "
        <html>
            <body style='background-color: rgb(242, 242, 242); margin: 0 auto;padding: 30px;margin-top: 100px; width: 500px;height: 400px;border: solid 3px #989898;border-radius: 20px;'>
                <h1 style='font-weight: 900;'>Change your account password</h1>
                <p style='margin-bottom: 20px;'>Hi dear <b>$user!</b> <br> </p>
                <p>It seems that you forgot your account password. I will help you! As you can see, under this message you have a button, click there and you will get to a page where you must fill the gaps with your new password you want to put twice. If you want to get more information of how to reset your password, read this <a href='https://www.hexamarket.store/documentation/guides/account/account+recovery' style='color: #0062ff;font-weight: 700;text-decoration: none;'>article.</a><p>
                <footer style='display: flex;flex-direction: column; align-items: center;'>
                    <a href='https://hexamarket.store/fp2?email=$email&code=$eResetCode' style='text-decoration: none; color: rgb(255, 255, 255); background-color: rgb(0, 81, 255); padding: 12px; border-radius: 16px; font-weight: 600;'>Change password</a>
                    <p class='sub' style='color: rgb(108, 108, 108);text-align: center;'>This mail was sent by Hexamarket for $user ($email)</p>
                    <div class='Hexamarket'>
                        <p style='font-weight: 900;font-size: 25px;margin-left: 10px;'>Hexamarket</p>
                    </div>
                </footer>
            </body>
        </html>
        ";

        if (empty($email)) {
            $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Please, fill the gaps.</div></div>';
        } else {
            if (!$result) {
                $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Email not found.</div></div>';
            } else if (!empty($eResetCode)) {
                $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Code already sent.</div></div>';
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
                    require 'views/fpdone.view.php';
                    exit;
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    echo 'An error occurred. Please try again later.';
                }
            }
        }

        if ($errors === '') {
            $statement = $connection->prepare('UPDATE users SET resetcode = :resetcode WHERE email = :email');
            $statement->execute(array(
                ':resetcode' => $resetcode,
                ':email' => $email,
            ));

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
                require 'views/fpdone.view.php';
                exit;
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
                echo 'An error occurred. Please try again later.';
            }
        }
    } else {
        $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Email not found.</div></div>';
    }

}
require 'views/fp.view.php';

?>
