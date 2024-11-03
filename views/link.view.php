<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Link account | Hexamarket</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<meta property="og:site_name" content="©Quelopande"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Link account">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script></head>
<body class="body">
	<style>
		.out{
            background-color: rgb(237 237 237);
            padding: 10px;
			font-weight: 500;
			margin-right: 10px;
			margin-left: 400px;
			margin-top: 40px;
			bottom: 20px;
            border-radius: 30px;
            color: rgb(59 59 59);
		}
        .out h1,.p,.account{
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }
        .out .account{
            font-size: 16px;
            background: white;
            border-radius: 30px;
            padding: 20px;
        }
        .btn{
            margin-top: -15px;
            right: 65px;
            position: absolute;
            color: rgb(59 59 59);
            border: 2px solid black;
            box-shadow: 0px 6px 0px 0px #000;
            border-radius: 34px;
            padding: 10px;
        }
        .btn:hover{
            border: 2px solid black;
            box-shadow: 0px 4px 0px 0px #000;
            transition: all ease-in-out 0.15s;
        }
        .btn:active{
            box-shadow: 0px 0px 0px 0px #000;
            transition: all ease-in-out 0.05s;
        }
		@media (min-width: 837px) {
			.out{
				top: -30px;
			}
		}
		@media (max-width: 837px) {
			.sidebar{display: none; margin-top: -1px;}
			.out{
				margin-bottom: 20px;
				margin-left: 10px;
			}
			.box{margin-right: 20px;margin-left: 20px;}
			.contents{margin-right: 20px;margin-left: 20px; !important}
		}
	</style>
	<style>
		.modal {
			display: none;
			position: fixed;
			z-index: 100;
			padding-top: 100px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
		}
		.modalContent {
			background-color: #fefefe;
			margin: auto;
			padding: 20px;
			width: 80%;
			border-radius: 16px;
		}
		.modalContent .close{
			background-color: red;
			color: white;
			font-weight: 600;
		}
		.modalContent .close:hover{
			background-color: #bf0000;
		}
		.modalContent .submit{
			background-color: #01d416;
			color: white;
			font-weight: 600;
		}
		.modalContent .submit:hover{
			background-color: #00b712;
		}
	</style>
	<?php require "menutemplate.view.php"; ?>
    <div class="out">
        <h1>Link you accounts</h1>
        <p class="p" style="margin-top: -20px;">Hello dear, If you want to be able to access you account with other with Google or Discord you can now link you accounts. Also you will get discord roles in our Discord. Now, you can link your Paypal to get profit from the resources you post.</p>
		<?php
		if(empty($result['PayPalEmail'])){
			echo '
			<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post" name="PaypalEmail">
				<div class="account paypal" id="modalBtn">
					<i class="fa-brands fa-paypal"></i> Paypal 
					<a href="#" class="btn">Link account</a>
				</div>
				<div id="modal" class="modal">
					<div class="modalContent">
						<p>You will receive the money you earn into your PayPal account. By introducing your PayPal account email you will get access to put prices to your resources files.</p>
						<input type="email" name="email" style="padding: 10px; border-radius: 16px; border: none; background-color: rgb(0 0 0 / 9%); font-family: \'Poppins\', sans-serif;" required>
						<br><br>
						<a class="close last">Back</a>
						<button class="last submit" type="submit" name="setPaypalEmail">Set PayPal Email</button>
					</div>
				</div>
			</form>';
		}else{
			echo '<div class="account" id="modalBtn"><i class="fa-brands fa-paypal"></i> Paypal <a href="/link?unlink=paypal" class="btn">Unlink account</a></div>';
		}
        if(empty($result['googleId'])){
            echo '<div class="account"><i class="fa-brands fa-google"></i> Google <a href="https://accounts.google.com/o/oauth2/v2/auth?response_type=code&access_type=online&client_id=984657386074-ud52oefhvedl35t6jn7ophdpmehefkso.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fhexamarket.store%2Fauth%2Fgoogle%2Findex.php%3Flink%3D&state&scope=email%20profile&approval_prompt=auto" class="btn">Link account</a></div>';
        }else{
            echo '<div class="account"><i class="fa-brands fa-google"></i> Google <a href="/link?unlink=google" class="btn">Unlink account</a></div>';
        }
        if(empty($result['discordId'])){
            echo '<div class="account"><i class="fa-brands fa-discord"></i> Discord <a href="https://discord.com/oauth2/authorize?client_id=1270381953866141808&response_type=code&redirect_uri=https%3A%2F%2Fwww.hexamarket.store%2Fauth%2Fdiscord%3Flink&scope=guilds.join+email+identify" class="btn">Link account</a></div>';
        }else{
            echo '<div class="account"><i class="fa-brands fa-discord"></i> Discord <a href="/link?unlink=discord" class="btn">Unlink account</a></div>';
        }
        ?>
        <?php if(isset($_GET['error'])){
            $errorMessage = $_GET['error'];
            echo "<p class='p' style='background: #ffabab; border: solid 2px #ff5959; border-radius: 16px; padding:5px;'>" . $errorMessage . "</p>";
        }?>
	</div>
	<script>
		let modal = document.getElementById("modal");
		let btn = document.getElementById("modalBtn");
		let span = document.getElementsByClassName("close")[0];

		btn.onclick = function() {
		modal.style.display = "block";
		}

		span.onclick = function() {
		modal.style.display = "none";
		}

		window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
		}
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