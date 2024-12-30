<?php session_start();
$user = $_SESSION['user'];
$errors = '';
$h1 = '';  // Inicialización por si no se define en el código
$orders = [];  // Definir como array vacío


require '../connection.php';

$statement = $connection->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
$statement->execute(array(':user' => $user));
$result = $statement->fetch();


if ($result) {
    if ($_GET['q'] === 'sales') {
        $sellerId = $result['id'];

        $sql = "SELECT status, PayerIdPayPal, tokenPayPal, articleId, purchaserId, price, sellerId, created_at FROM orders WHERE sellerId = :sellerId";
        $orderStatement = $connection->prepare($sql);
        
        $orderStatement->execute(array(':sellerId' => $sellerId));
        $orders = $orderStatement->fetchAll(PDO::FETCH_ASSOC);

        $chartStatement = $connection->prepare("SELECT DATE_FORMAT(created_at, '%Y-%m') AS month,  SUM(price) AS total_earnings  FROM orders WHERE sellerId = :sellerId AND status IN ('completed') AND created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH) GROUP BY month ORDER BY month ASC");         
        $chartStatement->execute(array(':sellerId' => $sellerId));
        $chartResults = $chartStatement->fetchAll(PDO::FETCH_ASSOC);

        $chartLabels = [];
        $chartEarnings = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthIndex = (date('n') - $i + 12) % 12;
            $monthName = date('F', mktime(0, 0, 0, $monthIndex + 1, 1));
            $chartLabels[] = $monthName; 
            $chartEarnings[$monthIndex] = 0;
        }

        foreach ($chartResults as $result) {
            $date = DateTime::createFromFormat('Y-m', $result['month']);
            $monthIndex = $date->format('n') - 1; 
            $chartEarnings[$monthIndex] = $result['total_earnings']; 
        }

        echo "
        <script>
            const chartLabels = " . json_encode($chartLabels) . ";
            const chartEarnings = " . json_encode(array_values($chartEarnings)) . ";
        </script>
        ";

        $h1 = '<h1 style="padding-top: 20px;">Sales</h1><canvas id="billing"></canvas>';
        $result['id'] = $sellerId; // Temporal solution, the solution was made to make the dark theme work 

    } else{
        $id = $result['id'];

        $sql = "SELECT status, PayerIdPayPal, tokenPayPal, articleId, purchaserId, price, sellerId, created_at FROM orders WHERE purchaserId = :purchaserId AND status IN ('completed')";
        $orderStatement = $connection->prepare($sql);
        
        $orderStatement->execute(array(':purchaserId' => $id));
        $orders = $orderStatement->fetchAll(PDO::FETCH_ASSOC);

        $h1 = '<h1 style="padding-top: 20px;">Purchases</h1>';
    }
    if (empty($orders)) {
        $errors = '
            <div class="box">
                <h2 style="color: #ff4444;">
                    <i class="fa-solid fa-triangle-exclamation fa-beat"></i> No transaction found
                </h2>
            </div>';
    }

    require '../views/billing.view.php';
} else {
    header('Location: ../login.php');
}
