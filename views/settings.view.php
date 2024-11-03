<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Settings - Account Managment | Hexamarket</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Dashboard - Settings">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
<body class="body">
<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
		body{
			overflow-x: hidden;
			background-color: #f9f9f9;
			font-family: "Poppins", sans-serif;
		}
		a{
			text-decoration: none;
			color: black;
		}
		.util{
			background-color: rgba(0, 0, 0, 0.072);
			position: fixed;
			margin-top: -30px;
			border-radius: 100px;
			padding: 15px;
			z-index: 92;
			border: solid 1px rgb(76, 76, 76);
		}
		.x-mark{
			display: none;
			padding-left: 17px;
			padding-right: 17px;
		}
		.box{
			background-color: #d4d4d46b;
			border-radius: 16px;
			padding: 5px;
			margin-top: 50px;
			margin-right: 40px;
			display: block;
			margin-right: 10px;
			margin-left: 400px;
			margin-top: 40px;
			bottom: 20px ;
		}
		.out{
			display: grid;
			font-weight: 500;
			grid-template-columns: repeat(auto-fit, minmax(0px, 500px));
			justify-content: space-around;
			margin-right: 10px;
			margin-left: 400px;
			margin-top: 40px;
			bottom: 20px ;
		}
		.out .container{
			color: var(--standard-txt-color);
			text-decoration: none;
			background: var(--background-primary);
			border: solid 1px var(--background-primary-active);
			display: flex;
			border-radius: 26px;
			flex-direction: column;
			text-align: center;
			padding: 13px;
			height: auto;
			margin-top: 40px;
		}
		.out .container h2{
			margin-top: 15px !important;
		}
		.out .container h2,input,button,p{
			margin-left: 10px;
			margin-right: 10px;
			margin-top: 10px;
			font-family: "Poppins", sans-serif;
		}
		.out .container .file-upload{
			border: 3px dotted var(--standard-txt-color);
			border-radius: 20px;
			padding: 5px 8px;
			cursor: pointer;
			font-size: 20px;
			margin-left: 10px;
			margin-right: 10px;
			font-weight: 400;
		}
		.out .container .file-upload i{
			font-size: 30px;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		.out .container .file-upload h6{
			margin-top: 10px;
			font-size: 15px;
			font-weight: 400;
		}
		.btnNewPassword{
			display: flex;
		}
		.last{
			background-color: var(--background-primary-hover);
			border: 1px solid var(--background-primary-hover);
			color: var(--standard-txt-color);
			border-radius: var(--standard-border-radius);
			padding: 10px;
			margin-bottom: 10px;
			font-size: 15px;
		}
		.last:hover{
			cursor: pointer;
			background-color: var(--background-primary-active);
			border: 1px solid var(--background-primary-active);
		}
		.last:active{
			border: 1px solid var(--standard-txt-color);
		}
		.out .sql-img input{
			display: none;
		}
		.uploaded i{
			color: rgb(0, 183, 0);
			font-size: 20px;
		}
		.last:disabled{
			color: red;
		}

		.out .sql-change input{
			background: none;
			color: var(--standard-txt-color);
			font-size: 15px;
			border: 1px #d0d0d0 solid;
			padding: 12px;
			border-radius: var(--standard-border-radius);
			width: 90%;
		}
		.out .sql-change button{
			width: 95%;
			margin-top: 7px;
		}
		.out .sql-change input:focus{
			outline: none !important;
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
		}
	</style>
	<style>
		.modal {
			display: none;
			position: fixed;
			z-index: 100;
			left: 0;
			top: 0;
			padding-top: 20px;
			width: 100%;
			height: 100%;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
			overflow-y: auto;
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
		.modal img{
			object-fit: cover;
			border-radius: 26px;
			border: solid black 1px;
			width: 100%;
			height: 200px;
		}
	</style>
	<?php require "menutemplate.view.php"; ?>
	<p id="authverify"><?php echo $result['status'];?></p>
	<a class="box authnotification" style="background: linear-gradient(280deg, rgb(124, 89, 207) 20%, rgba(59,58,237,1) 100%); color: white;" href="/verify">
		<div style="display: flex; flex-wrap: nowrap;">
			<h2 style="margin-left: 10px;">You must verify the email of your account.</h2>
			<p style="background-color: white; color: black; padding-top: 5px; padding-bottom: 3px; padding-left: 10px;  padding-right: 10px; border-radius: 16px; margin-top: 20px; margin-bottom: 20px;">Verify account</p>
		</div>
	</a>
	<div class="out">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="changeProfileImgSubmit" novalidate="" enctype="multipart/form-data">
    		<div class="sql-img container">
				<h2>Set up your new profile picture here!</h2>
				<label class="file-upload" for="upload"><i class="fa-solid fa-upload"></i> <br>Drag or Drop your new profile picture here <br> <h6>Only image files</h6></label>
				<input class="upload" id="upload" type="file" name="image" accept=".apng,.avif,.gif,.jpg,.jpeg,.jfif,.pjpeg,.pjp,.png,.svg,.webp" required onchange="check()">
				<p class="uploaded"></p>
				<button class="last" type="submit" name="changeProfileImgSubmit">Save the picture</button>
				<?php if(!empty($profileImgNotifications)): ?>
				<div>
					<ul>
						<?php echo $profileImgNotifications; ?>
					</ul>
				</div>
				<?php endif; ?>	
			</div>
		</form>
		<div class="sql-change container">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="changeusername" novalidate="">
				<h2>Change username</h2>
				<input type="email" name="oldUser" placeholder="Old username" required>
				<input type="email" name="newUser" placeholder="New username" required>
				<p><b>Warning:</b> By changing the username this session will expire.</p>
				<button class="last" type="submit" name="changeUsernameSubmit">Change username</button>
				<?php if(!empty($userErrors)): ?>
				<div>
					<ul>
						<?php echo $userErrors; ?>
					</ul>
				</div>
				<?php endif; ?>	
			</form>
		</div>
		<div class="sql-change container">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="changeusername" novalidate="">
				<h2>Change Email</h2>
				<input type="email" name="oldEmail" placeholder="Old email" required>
				<input type="email" name="newEmail" placeholder="New email" required>
				<p><b>Warning:</b> If you change the email you will need to verify your account again. This session will expire.</p>
				<p id="modalBtn" class="last" onclick="return false;">Change Email</p>
				<?php if(!empty($emailErrors)): ?>
				<div>
					<ul>
						<?php echo $emailErrors; ?>
					</ul>
				</div>
				<?php endif; ?>	
				<div id="modal" class="modal">
					<div class="modalContent">
						<h1>Profile banner selector</h1>
						<img src="/menzatyx/assets/media/banner1.webp" alt="Banner 1, GTA city">
						<img src="/menzatyx/assets/media/banner2.webp" alt="Banner 2, Minecraft nature">
						<img src="/menzatyx/assets/media/banner3.webp" alt="Banner 3, Minecraft nature">
						<img src="/menzatyx/assets/media/banner4.webp" alt="Banner 4, GTA city">
						<a class="close last">Back</a>
						<button class="last submit" type="submit" name="changeBannerSubmit">Set new banner</button>
						<!-- <p>Are you sure that you want to change the email. If you put a wrong new email you will loose you account.</p>
						<a class="close last">Back</a>
						<button class="last submit" type="submit" onclick="login.submit()" name="changeEmailSubmit">Change email</button> -->
					</div>
				</div>
			</form>
		</div>
		<style>
			.themes a{
				background: var(--background-primary-hover);
				padding: 10px;
				border-radius: 20px;
				border: 1px solid var(--background-primary-active);
			}
			.themes a:hover{
				background: var(--background-primary-active);
				transition: 0.3s all;
			}
			.themes a:active{
				border: 1px solid var(--standard-txt-color);
			}
		</style>
		<div class="sql-change container themes" style="text-align: left;">
			<h2 style="text-align: center; margin-top:10px !important;">Themes</h2>
			<a href="/settings?theme=black" style=" display:flex; flex-direction: row; margin-bottom: 20px;"><img src="/assets/media/blacktheme.png" alt="white theme" width="180px" style="border-radius: 16px;"><h2 style="margin-top: 30px !important;">Dark theme</h2></a>
			<a href="/settings?theme=white" style=" display:flex; flex-direction: row;"><img src="/assets/media/whitetheme.png" alt="white theme" width="180px" style="border-radius: 16px;"><h2 style="margin-top: 30px !important;">Light theme</h2></a>
		</div>
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
	<script>
		function check() {
			const fileInput = document.getElementById('upload');
			const filePath = fileInput.value;
			const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;

			if (!allowedExtensions.exec(filePath)) {
				alert('Invalid file type');
				fileInput.value = '';
				return false;
			} else {
				const fileName = filePath.split('\\').pop();
				document.querySelector('.uploaded').innerText = `Selected file: ${fileName}`;
			}
		}
	</script>
</body>
</html>