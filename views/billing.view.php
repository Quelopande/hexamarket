<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hexamarket - Billing</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<meta property="og:site_name" content="©Quelopande"/>
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Billing">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script></head>
<body class="body">
	<style>
		.out{
			color: var(--secondary-txt-color);
			position: absolute;
			right: 10px;
			left: 400px;
			margin-top: 40px;
			bottom: 20px ;
		}
		.out i{
			z-index: 1;
		}
		.out .box{
			background-color: var(--background-primary);
			border-radius: 30px;
			padding: 23px;
			margin-top: 50px;
			margin-right: 40px;
			display: block;
		}
		.out .box:hover{
			background-color: var(--background-primary-hover);
			cursor: pointer;
		}
		.out .box:active{
			background-color: var(--background-primary-active);
		}
		.out .boxses div{
			display: flex;
			flex-direction: row;
		}
		.out .boxses h2{
			margin-left: 20px;
			margin-right: 10px;
		}
		.out .boxses p{
			font-size: 15px;
			margin-left: 20px;
			margin-right: 20px;
		}
		canvas{
			max-height: 40vh !important;
			margin-right: 20px;
		}
		@media (min-width: 837px) {
			.util{display: none;}
			.out{
				top: -30px;
			}
		}
		@media (max-width: 837px) {
			.sidebar{display: none; margin-top: -1px;}
			.out{
				position: unset;
				margin-bottom: 20px;
			}
			.out .box{
				margin-left: 10px;
				margin-right: 10px;
			}
		}
		.tableover::-webkit-scrollbar {
			margin-top: 10px;
			height: 8px;
		}
		.tableover::-webkit-scrollbar-track {
			margin-top: 10px;
			border: solid 1px var(--standard-txt-color);
			border-radius: 100px;
		}
		.tableover::-webkit-scrollbar-thumb {
			background: var(--standard-txt-color);
			border-radius: 100px;
		}
		.tableover{
			padding: 3px;
			overflow-x: auto;
			width: 100%;
		}
		table {
			color: var(--standard-txt-color);
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            border-spacing: 0px;
        }

        td, th {
            min-width: 170px;
            text-align: left;
			border: 1px solid var(--standard-txt-color);
            padding: 8px;
        }
</style>
	<?php require "menutemplate.view.php"; ?>
	<div class="out">
		<div class="boxses">
			<?php 
			if($_GET['q']){
				echo $h1;
				foreach ($orders as $orderData):?>
					<div class="box details">
						<div class="tableover">
						<table>
							<tr>
								<th style="border-radius:16px 0px 0px 0px;">Payer ID (PayPal)</th>
								<th>PayPal Token</th>
								<th>Article ID</th>
								<th>Purchaser ID</th>
								<th>Price</th>
								<th>Seller ID</th>
								<th style="border-radius:0px 16px 0px 0px;">Creation Date</th>
							</tr>
							<tr>
								<td style="border-radius:0px 0px 0px 16px;"><?php echo htmlspecialchars($orderData['PayerIdPayPal']); ?></td>
								<td><?php echo htmlspecialchars($orderData['tokenPayPal']); ?></td>
								<td><?php echo htmlspecialchars($orderData['articleId']); ?></td>
								<td><?php echo htmlspecialchars($orderData['purchaserId']); ?></td>
								<td><?php echo htmlspecialchars($orderData['price']); ?></td>
								<td><?php echo htmlspecialchars($orderData['sellerId']); ?></td>
								<td style="border-radius:0px 0px 16px 0px;"><?php echo htmlspecialchars($orderData['created_at']); ?></td>
							</tr>
						</table>
						</div>
					</div>
				<?php endforeach;
			} else{
				echo '
				<a href="/billing?q=purchases" class="box">
					<h2><i class="fa-solid fa-bag-shopping"></i> Purchases</h2>
					<p>Hey! Have you purchased a product from the platform and want to know the purchase details? Check the owner of the product you bought. You can also see the product details and other information about the purchase, such as the date, product owner ID, and the price of the product when you purchased it.</p>
				</a>
				<a href="/billing?q=sales" class="box">
					<h2><i class="fa-solid fa-money-check-dollar"></i> Sales</h2>
					<p>Discover the products you have sold throughout your account history. Check how much you have earned from each product. View who has purchased your products. Only for sellers.</p>
				</a>';
			}
			echo $errors;
			?>
		</div>
	</div>
	<script>
    const labels = chartLabels;
    const earnings = chartEarnings;

    console.log("Últimos 6 meses:", labels);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Sales in ($)',
            data: earnings,
            fill: false,
            borderColor: '#4C52F0',
            tension: 0
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                x: {
                    grid: {
                        color: 'rgba(200, 200, 200, 0.3)',
                        backgroundColor: '#f5f5f5',
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(200, 200, 200, 0.3)',
                        backgroundColor: '#f5f5f5',
                    }
                }
            },
            plugins: {
                tooltip: {
                    enabled: true
                }
            }
        }
    };

    window.onload = function() {
        const ctx = document.getElementById('billing').getContext('2d');
        new Chart(ctx, config);
    };
</script>
	<script>
		const xMark = document.querySelector('.x-mark');
		const lMark = document.querySelector('.fa-list');
		const sidebar = document.querySelector('.sidebar');
		const main = document.querySelector('.out');
		const body = document.querySelector('.body');

		lMark.addEventListener('click', () => {
			xMark.style.display = "block";
			lMark.style.display = "none";
			sidebar.style.display = "flex";
			main.style.left = "400px";
			body.style.overflowY = "hidden";
		});
		xMark.addEventListener('click', () => {
			xMark.style.display = "none";
			lMark.style.display = "block";
			sidebar.style.display = "none";
			main.style.left = "30px";
			body.style.overflowY = "scroll";
		});
		if (window.innerWidth < 837) {
			main.addEventListener('click', () => {
				xMark.style.display = "none";
				lMark.style.display = "block";
				sidebar.style.display = "none";
				main.style.left = "30px";
				body.style.overflowY = "scroll";
			});
		}
	</script>
</body>
</html>