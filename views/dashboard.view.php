<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hexamarket - Dashboard</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Dashboard">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
<body class="body">
	<style>
		.out{
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
			border-radius: 16px;
			padding: 5px;
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
		.out .box .circle{
			font-size: 40px;
			position: absolute;
			right: 50px;
			margin-top: -50px;
			padding: 10px;
			border-radius: 16px;
		}
		.out .box .blue{
			background-color: rgb(200, 204, 255);
			color: rgb(35, 79, 255);
		}
		.out .box .red{
			background-color: rgb(255, 168, 168);
			color: rgb(255, 38, 38);
		}
		.out .box .orange{
			background-color: rgb(255, 207, 149);
			color: rgb(255, 122, 66);
		}
		.out .box .yellow{
			background-color: rgb(255, 230, 154);
			color: rgb(233, 194, 0);
		}
		.out .box .green{
			background-color: rgb(182, 255, 195);
			color: rgb(32,201,151);
		}
		.out svg{
			width: 270px;
			margin-top: -60px;
			float: right;
		}
		.out .box .isvg{
			font-size: 70px;
			position: absolute;
			right: 160px;
			margin-top: 30px;
			color: white;
			padding: 10px;
			border-radius: 100px;
		}
		.out .small{
			color: rgb(0, 0, 0);
			width: 45%;
			border-radius: 35px;
			display: block;
			border: solid 2px #696969;
		}
		.out .small i{
			color: rgb(255, 98, 0);
			font-size: 140px;
			position: absolute;
			transform: rotate(45deg);
			z-index: -1 !important;
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
	</style>
	<?php require "menutemplate.view.php"; ?>
	<div class="out">
		<div class="boxses">
			<p id="authverify"><?php echo $result['status'];?></p>
			<a class="box authnotification" style="background: linear-gradient(280deg, rgb(124, 89, 207) 20%, rgba(59,58,237,1) 100%); color: white;" href="/verify">
				<div style="display: flex; flex-wrap: nowrap;">
					<h2>You must verify the email of your account.</h2>
					<p style="background-color: white; color: black; padding-top: 5px; padding-bottom: 3px; padding-left: 10px;  padding-right: 10px; border-radius: 16px; margin-top: 20px; margin-bottom: 20px;">Verify account</p>
				</div>
			</a>
			<a class="box large">
				<i class="fa-solid fa-shield circle blue"></i>
				<h2>Protect you account</h2>
				<p>Are you sure your account is protected!? Someone could hack you and you could lose all your content!</p>
			</a>
			<a href="" class="box large">
				<i class="fa-solid fa-pen circle red"></i>
				<h2>Customize your account!</h2>
				<p>Your account looks boring 😒. Give a little color and joy to your profile.</p>
			</a>
			<a class="box large">
				<i class="fa-solid fa-eye circle orange"></i>
				<h2>Do you want your profile to be public?</h2>
				<p>It is your public or private profile. Do you want to keep your privacy private?</p>
			</a>
			<a class="box large" style="color: #ffffff; background: linear-gradient(45deg, rgba(132,94,194,1) 7%, rgba(214,93,177,1) 35%, rgba(255,111,145,1) 53%, rgba(255,150,113,1) 65%, rgb(255, 179, 39) 83%, rgb(255, 235, 82)100%); text-align: center;">
				<h2>Go premium!</h2>
				<p>Be exclusive and stand out from others. Get upgrades for your profile. You can pin some of your posts and put an information card. Get rid of the ads and browse Hexamarket in peace</p>
			</a>
			<a class="box large">
				<i class="fa-solid fa-paper-plane circle yellow"></i>
				<h2>Do you want your profile to be public?</h2>
				<p>It is your public or private profile. Do you want to keep your privacy private?</p>
			</a>
			<a class="box large">
				<i class="fa-solid fa-link circle green" style="font-size: 33px; padding-top: 12px !important; padding-bottom: 14px !important;"></i>
				<h2>Do you want your profile to be public?</h2>
				<p>It is your public or private profile. Do you want to keep your privacy private?</p>
			</a>
		</div>
	</div>
	<script>
		let auth = document.getElementById('authverify');
		let notification = document.querySelector('.authnotification');

		if (auth.textContent === 'verified') {
			notification.style.display = "none";
			auth.style.display = "none";
			console.log("verified");
		} else {
			notification.style.display = "block";
			console.log("Not verified");
			auth.style.display = "none";
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