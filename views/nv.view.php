<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Settings - Manage Content | Hexamarket</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<meta property="og:site_name" content="©Quelopande"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="website icon" type="png" href="assets/media/logo.webp">
</head>
<body class="body">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
		body{
			overflow-x: hidden;
			background-color: #f9f9f9;
			font-family: "Poppins", sans-serif;
		}
		.out{
			display: grid;
			font-weight: 500;
			grid-template-columns: repeat(auto-fit, minmax(0px, 500px));
			justify-content: space-around;
			margin-right: 10px;
			margin-left: 400px;
			margin-top: 40px;
			bottom: 20px;
		}
		.contents{
			margin-right:10px;
			margin-left: 320px;
			margin-top: 40px;
		}
		.content{
            display: block;
			background-color: var(--background-primary);
			padding: 3px;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 16px;
		}
		.content:hover{
			background-color: var(--background-primary-hover);
			cursor: pointer;
		}
		.content:active{
			background-color: var(--background-primary-active);
		}
		.content h2{
			margin-top: 40px;
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
				margin-bottom: 20px;
				margin-left: 10px;
			}
			.box{margin-right: 20px;margin-left: 20px;}
			.contents{margin-right: 20px;margin-left: 20px; !important}
		}
	</style>
	<?php require "menutemplate.view.php"; ?>
    <div class="contents">
		<a class="content" href="/verify">
			<h2>Verify you account to get access to the page</h2>
			<p>For get access to some pages you need to verify your account. <b>Verify account page</b></p>
        </a>
	</div>
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