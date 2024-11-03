<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
require 'connection.php';

    $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
    $statement->execute(array(':user' => $user));
    $result = $statement->fetch();
            $email = $result['email'];
        $sqlCode = $result['code'];

    if ($result === false || $result['status'] !== 'notverified') {
        header('Location: login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $code = trim($_POST['code1'] . $_POST['code2'] . $_POST['code3'] . $_POST['code4'] . $_POST['code5'] . $_POST['code6']);
        $ucode = '';
        $status = 'verified';
        $errors = '';

        if (empty($code)) {
            $errors .= '<li>Please fill in all fields</li>';
        } else {
            if ($sqlCode !== $code) {
                $errors .= '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"/>
                                </svg>
                                <div>Incorrect code.</div>
                            </div>';
            }
        }

        if ($errors === '') {
            $statement = $connection->prepare('UPDATE users SET code = :code, status = :status WHERE user = :user');
            $statement->execute(array(
                ':code' => $ucode,
                ':status' => $status,
                ':user' => $user,
            ));

            $jsonString = @file_get_contents('content.json');
            if ($jsonString === false) {
                throw new Exception('Unable to read content.json');
            }
            
            $jsonData = json_decode($jsonString, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON format in content.json');
            }
            $existingUserIndex = null;
            foreach ($jsonData['users'] as $index => $existingUser) {
                if ($existingUser['id'] === $result['id']) {
                    $existingUserIndex = $index;
                    break;
                }
            }

            $newUser = [
                "id" => $result['id'],
                "banner" => 1,
                "theme" => "black",
                "visibility" => [
                    "true",
                    "true",
                    "true",
                    "true"
                ],
                "articles" => []
            ];

            if ($existingUserIndex == null) {
                $jsonData['users'][] = $newUser;
            }
            $newJson = json_encode($jsonData, JSON_PRETTY_PRINT);
            if (file_put_contents('content.json', $newJson) === false) {
                throw new Exception('Unable to write to content.json');
            }

            if (!is_dir('u')) {
                mkdir('u', 0755, true);
            }

            $fileName = "u/$user.php";
            $htmlContent = <<<HTML
            <?php
                require "mainuserprofile.php";
            ?>
            HTML;
            if (file_put_contents($fileName, $htmlContent) === false) {
                throw new Exception('Unable to write user profile file');
            }

            $_SESSION['user'] = $user;
            header('Location: auth');
            exit;
        }
    }

    if (isset($_POST['sendEmail'])) {
        require 'config.php';
        require 'vendor/autoload.php';

        $title = 'Verify account email';
        $message = "
        <html>
        <head></head>
        <body style='background-color: rgb(255, 255, 255); margin: 0; padding: 0;'>
            <div style='max-width: 600px; margin: 50px auto; padding: 30px; border: solid 3px #c5c5c5; border-radius: 20px; background-color: #ffffff;'>
                <h1 style='font-weight: 900; text-align: center;'>Verify your account email address!</h1>
                <p style='margin-bottom: 20px; text-align: center;'>Hello <b>$user</b>! The last step for the registration of your Hexamarket account. With the email verification you can post and manage all your content.</p>
                <p style='text-align: center;'>Use this code to complete your account:</p>
                <h2 style='font-size: 34px; text-align: center;'>$sqlCode</h2>
                <p class='sub' style='color: rgb(108, 108, 108); text-align: center;'>You need to put this code in the <a href='https://hexamarket.store/verify' style='color: #0062ff; font-weight: 700; text-decoration: none '>Email verification panel</a></p>
                <footer style='display: flex; flex-direction: column; margin-top: 20px;'>
                    <p class='sub' style='color: rgb(108, 108, 108); text-align: center; margin: 0 auto;'>This mail was sent by Hexamarket for $user ($email)</p>
                    <div class='Hexamarket' style='display: flex; justify-content: center; align-items: center; margin-top: -20px;'>
                        <p style='font-family: Arial, sans-serif; font-weight: 900; font-size: 15px; margin-left: 10px; color: white;'>Hexamarket</p>
                    </div>
                </footer>
            </div>
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
    require "views/verify.view.php";
?>