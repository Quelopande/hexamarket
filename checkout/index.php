<?php

require '../../auth/paypal.php';

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

function createPayment($accessToken, $orderId, $amount) {
    $url = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ];
    $data = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $amount
                ],
                'invoice_id' => $orderId
            ]
        ],
        'application_context' => [
            'return_url' => 'https://hexamarket.store/checkout/success.php?orderId=' . $orderId,
            'cancel_url' => 'https://hexamarket.store/checkout/cancel.php?orderId=' . $orderId
        ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data;
}

$articleId = isset($article->articleId) ? $article->articleId : null;
$price = isset($article->price) ? $article->price : null;
$sellerEmail = isset($eresult['PayPalEmail']) ? $eresult['PayPalEmail'] : null;
$sellerId = isset($eresult['id']) ? $eresult['id'] : null;
$purchaserId = isset($purchaserId) ? $purchaserId : null;

if (empty($articleId) || empty($price) || empty($purchaserId) || empty($sellerEmail)) {
    die('Ohh!! We are missing some data needed to create the payment link. It´s possible that the owner of this post has unlinked their account. To get more information please contact the support team.');
}

$orderId = uniqid('order_');

$accessToken = getAccessToken($clientId, $clientSecret);

$response = createPayment($accessToken, $orderId, $price);
if (isset($response['id'])) {
    $tokenPayPal = $response['id'];
    $approvalUrl = $response['links'][1]['href'];

    $statement = $connection->prepare('SELECT COUNT(*) FROM orders WHERE articleId = :articleId AND purchaserId = :purchaserId');
    $statement->execute(array(
        'articleId' => $articleId,
        'purchaserId' => $purchaserId,
    ));
    $exists = $statement->fetchColumn() > 0;

    if ($exists) {
        $statement = $connection->prepare('UPDATE orders SET tokenPayPal = :tokenPayPal, price = :price, sellerId = :sellerId,status = "pending" WHERE articleId = :articleId AND purchaserId = :purchaserId');
        $statement->execute(array(
            'tokenPayPal' => $tokenPayPal,
            'price' => $price,
            'articleId' => $articleId,
            'purchaserId' => $purchaserId,
            'sellerId' => $sellerId,
        ));
    } else {
        $statement = $connection->prepare('INSERT INTO orders (orderId, tokenPayPal, articleId, purchaserId, price, sellerId, status) VALUES (:orderId, :tokenPayPal, :articleId, :purchaserId, :price, :sellerId, "pending")');
        $statement->execute(array(
            'orderId' => $orderId,
            'tokenPayPal' => $tokenPayPal,
            'articleId' => $articleId,
            'purchaserId' => $purchaserId,
            'price' => $price,
            'sellerId' => $sellerId,
        ));
    }
} else {
    echo '<h3>Error creating PayPal payment:</h3>';
    echo '<pre>' . htmlspecialchars($response['message'] ?? 'Unknown error', ENT_QUOTES, 'UTF-8') . '</pre>';
}
?>
