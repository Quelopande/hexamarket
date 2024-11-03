<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post has been sent</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Post Sent">
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
			<a class="box large" style="border: 2px red solid;">
				<h2>You have published a new post</h2>
				<p>You have published a new post in Hexamarket, this will appear in the feed of users!</p>
			</a>
            <a class="box large">
				<h2>Manage your posts</h2>
				<p>Check the post that you have published in!</p>
			</a>
            <a class="box large">
				<h2>Dashboard</h2>
				<p>Go to the dashboard.</p>
			</a>
		</div>
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