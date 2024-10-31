<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');
body {
    overflow-x: hidden;
    background-color: #f9f9f9;
    font-family: "Poppins", sans-serif;
}
</style>
<?php
require '../auth/paypal.php';

$clientId = $PayPal['clientId'];
$clientSecret = $PayPal['clientSecret'];

function getAccessToken($clientId, $clientSecret) {
    $url = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
    $headers = [
        'Accept: application/json',
        'Accept-Language: en_US'
    ];
    $postFields = 'grant_type=client_credentials';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['access_token'];
}

function capturePayment($accessToken, $tokenPayPal) {
    $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$tokenPayPal}/capture";
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data;
}

$tokenPayPal = $_GET['token'] ?? null; // Ahora usamos 'token' para capturar el tokenPayPal
$PayerIdPayPal = $_GET['PayerID'] ?? null;

if ($tokenPayPal && $PayerIdPayPal) {
    $accessToken = getAccessToken($clientId, $clientSecret);

    require '../connection.php';

    $statement = $connection->prepare('SELECT tokenPayPal FROM orders WHERE tokenPayPal = :tokenPayPal AND status = "pending"');
    $statement->execute(array('tokenPayPal' => $tokenPayPal));
    $existingPaymentId = $statement->fetchColumn();
    if ($existingPaymentId) {
        $response = capturePayment($accessToken, $tokenPayPal);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $statement = $connection->prepare("UPDATE orders SET status = 'completed', PayerIdPayPal = :PayerIdPayPal WHERE tokenPayPal = :tokenPayPal");
            $statement->execute(array(
                'PayerIdPayPal' => $PayerIdPayPal,
                'tokenPayPal' => $tokenPayPal
            ));

            echo '<div style="text-align:center; margin-top:50px;">';
            echo '<h1 style="color:green;">Payment Successful!</h1>';
            echo '<p>Your payment has been completed successfully.</p>';
            echo '<a href="/home" style="padding:10px 20px; background-color:#4CAF50; color:white; text-decoration:none; border-radius:10px;">Return to Home</a>';
            echo '</div>';
        } else {
            echo '<div style="text-align:center; margin-top:50px;">';
            echo '<h1 style="color:red;">Payment Failed!</h1>';
            echo '<p>There was an issue processing your payment. Please try again.</p>';
            echo '<a href="/checkout" style="padding:10px 20px; background-color:#f44336; color:white; text-decoration:none; border-radius:10px;">Try Again</a>';
            echo '</div>';
        }
    } else {
        echo '<div style="text-align:center; margin-top:50px;">';
        echo '<h1 style="color:red;">Invalid Order!</h1>';
        echo '<p>We couldn\'t find your order. Please contact support.</p>';
        echo '<a href="/home" style="padding:10px 20px; background-color:#f44336; color:white; text-decoration:none; border-radius:10px;">Return to Home</a>';
        echo '</div>';
    }
} else {
    echo '<div style="text-align:center; margin-top:50px;">';
    echo '<h1 style="color:red;">Error!</h1>';
    echo '<p>Order ID or Payer ID is missing. Please try again.</p>';
    echo '<a href="/home" style="padding:10px 20px; background-color:#f44336; color:white; text-decoration:none; border-radius:10px;">Return to Home</a>';
    echo '</div>';
}
?>
