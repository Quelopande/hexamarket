<?php
include('config.php');

$login_button = '';

if(isset($_GET["code"]))
{
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(!isset($token['error']))
    {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $_SESSION['user_first_name'] = $data['given_name'];
        $_SESSION['user_email_address'] = $data['email'];
        $_SESSION['user_google_id'] = $data['id'];

        require '../../connection.php';

        $email = htmlspecialchars($data['email']);
        $authGoogleId = htmlspecialchars($data['id']);
        $authUsername = htmlspecialchars($data['given_name']);

        $statement = $connection->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->execute(array(':email' => $email));
        $result = $statement->fetch();

        $estatement = $connection->prepare('SELECT * FROM users WHERE googleId = :googleId LIMIT 1');
        $estatement->execute(array(':googleId' => $authGoogleId));
        $eresult = $estatement->fetch();

        $istatement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
        $istatement->execute(array(':user' => $authUsername));
        $iresult = $istatement->fetch();

        $user = $_SESSION['user'];
        if(isset($user)){
            $hstatement = $connection->prepare('SELECT * FROM users WHERE googleId = :googleId LIMIT 1');
            $hstatement->execute(array(':googleId' => $authGoogleId));
            $hresult = $hstatement->fetch();
            if($hresult){
                header('../link?error=<i class="fa-brands fa-google"></i> Google ERROR: There is another account with the same Google account linked.');
            } else{    
                $statement = $connection->prepare('UPDATE users SET googleId = :googleId WHERE user = :user');
                $statement->execute(array(
                    ':googleId' => $authGoogleId,
                    ':user' => $user,
                ));
            }
        } else {
            if ($result) {
                $googleId = $result['googleId'];
                if($result['googleId'] === ''){
                    $statement = $connection->prepare('UPDATE users SET googleId = :googleId WHERE email = :email');
                    $statement->execute(array(
                        ':googleId' => $authGoogleId,
                        ':email' => $email,
                    ));
                    $user = $result['user'];
                    $_SESSION['user'] = $user;
                }
            } else {
                if($eresult){
                    $user = $eresult['user'];
                    $_SESSION['user'] = $user;
                } elseif($iresult){
                    $newUsername = $authUsername . mt_rand(11111,99999);
                    $rank = 'user';
                    $status = 'notverified';
                    $code = mt_rand(211111,999999);
                    $salt = openssl_random_pseudo_bytes(32);
    
                    $statement = $connection->prepare('INSERT INTO users (id, user, email, salt, rank, code, status, googleId) VALUES (NULL, :user, :email, :salt, :rank, :code, :status, :googleId)');
                    $statement->execute(array(
                      ':user' => $newUsername,
                      ':rank' => $rank,
                      ':email' => $email,
                      ':code' => $code,
                      ':status' => $status,
                      ':salt' => $salt,
                      ':googleId' => $authGoogleId,
                    ));
                    $user = $newUsername;
                    $_SESSION['user'] = $user;
                } else{
                    $rank = 'user';
                    $status = 'notverified';
                    $code = mt_rand(211111,999999);
                    $salt = openssl_random_pseudo_bytes(32);
    
                    $statement = $connection->prepare('INSERT INTO users (id, user, email, salt, rank, code, status, googleId) VALUES (NULL, :user, :email, :salt, :rank, :code, :status, :googleId)');
                    $statement->execute(array(
                      ':user' => $authUsername,
                      ':rank' => $rank,
                      ':email' => $email,
                      ':code' => $code,
                      ':status' => $status,
                      ':salt' => $salt,
                      ':googleId' => $authGoogleId,
                    ));
                    $user = $authUsername;
                    $_SESSION['user'] = $user;
                }
            }   
        }
    }
}

$finalRedirection = isset($_GET['link']) ? 
    "/link" : 
    "/";
echo "
<script>
    window.location.href = '$finalRedirection';
</script>
";
?>