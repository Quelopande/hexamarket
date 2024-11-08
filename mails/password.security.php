<?php session_start();
$user = $_SESSION['user'];

        require '../config.php';
        require '../vendor/autoload.php';
        require '../connection.php';

        $statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
        $statement->execute(array(':user' => $user));
        $result = $statement->fetch();

        $email = $result['email'];
        $code = $result['code'];

        $title = 'Verify account email';
        $message = "
        <html>
        <head></head>
        <body style='background-color: rgb(255, 255, 255); margin: 0; padding: 0;'>
            <div style='max-width: 600px; margin: 50px auto; padding: 30px; border: solid 3px #c5c5c5; border-radius: 20px; background-color: #ffffff;'>
                <h1 style='font-weight: 900; text-align: center;'>Verify your account email address!</h1>
                <p style='margin-bottom: 20px; text-align: center;'>Hello <b>$user</b>! The last step for the registration of your Hexamarket account. With the email verification you can post and manage all your content.</p>
                <p style='text-align: center;'>Use this code to complete your account:</p>
                <h2 style='font-size: 34px; text-align: center;'>$code</h2>
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
            echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";

        } catch (Exception $e) {
            error_log('Error: ' . $e->getMessage());
            echo 'An error occurred. Please try again later.';
        }
?>