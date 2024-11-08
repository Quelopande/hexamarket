<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Security - Security Managment | Hexamarket</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Security">
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
		.out .container h2,input,button,p,label{
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
			padding-top: 100px;
			font-weight: 300;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
		}
		.modalContent {
			background-color: var(--background-primary);
			color: var(--standard-txt-color);
			margin: auto;
			padding: 20px;
			width: 80%;
			border-radius: 26px;
			text-align: left;
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
		.modalButtons{
			text-align: right;
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
		<div class="sql-change container">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="changepassword" novalidate="">
				<h2>Change password</h2>
				<input type="password" name="oldPassword" placeholder="Old password" required>
				<input type="password" name="newPassword" placeholder="New password" required>
                <input type="password" name="newPasswordV" placeholder="New password 2" required>
				<p><b>Warning:</b> If you change the password this session will expire.</p>
				<a id="modalBtn" class="last" href="/mails/password.security.php" target="_blank" style="display: block;">Change password</a>
				<?php if(!empty($passErrors)): ?>
				<div>
					<ul>
						<?php echo $passErrors; ?>
					</ul>
				</div>
				<?php endif; ?>	
				<div id="modal" class="modal">
					<div class="modalContent">
						<p>Are you sure that you want to change the password. If you put a wrong new password you will loose you account.</p>
						<label for="passCode" style="font-weight: 700;">We have sent you an email with a code.</label>
						<input type="text" name="passCode" id="passCode" style="width: 130px;" placeholder="Verification code">
						<br>
						<div class="modalButtons">
							<a class="close last">Back</a>
							<button class="last submit" type="submit" onclick="login.submit()" name="changepassword" style="width: 190px; left: 0;">Change password</button>
						</div>
					</div>
				</div>
			</form>
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
</body>
</html>