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
		.sidebar{
			background-color: #ffffff;
			display: flex;
			flex-direction: column;
			margin-left: -10px;
			width: 300px;
			height: 100%;
			position: fixed;
			bottom: 0;
			top: 0;
			border: solid #d4d4d4 1px;
			text-align: center;
			font-size: 20px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select:none;
			user-select:none;
			z-index: 90;
		}
		.sidebar .username{
			display: flex;
			word-wrap: break-word;
			flex-direction: row;
			-ms-flex-align: center;
			background-color: #cbcbcb8c;
			border-radius: 100px;
			margin-left: 20px;
			margin-right: 20px;
			margin-top: 60px;
			/* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.25); */
		}
		.sidebar .username:hover{
			cursor: pointer;
			box-shadow: 0px 0px 1px 5px #cbcbcb53;
		}
		.sidebar .username img{
			border-radius: 100px;
			width: 60px;
			margin-left: 5px;
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.sidebar .username p{
			font-size: 17px;
			margin-top: 22px;
			margin-left: 10px;
		}
		ul{
			font-size: 16px;
			font-weight: 300;
			list-style: none;
			text-align: left;
			margin-left: -10px;
		}
		ul li{
			padding-top: 5px;
			padding-bottom: 5px;
			border-radius: 16px;
			padding-left: 10px;
			margin-right: 20px;
			margin-top: 20px;
			cursor: pointer;
		}
		ul li:hover{
			background-color: #c0c0c042; /* c0c0c072 */
			cursor: pointer;
		}
		ul li:active{
			background-color: #c0c0c0a6;
		}
		.bottom{
			position: absolute;
			bottom: 40px;
			width: 90%;
			font-weight: 500;
			margin-left: 5%;
		}
		.bottom > :nth-child(2){
			background-color: rgb(20, 20, 20);
			color: white;
			font-weight: 300;
		}
		.bottom > :nth-child(2):hover{
			font-weight: 500;
			background-color: rgba(20, 20, 20, 0);
			color: black;
		}
		.bottom a{
			padding: 10px;
			display: block;
			border-radius: 200px;
			margin-left: 20px;
			margin-right: 20px;
			border: solid 2px rgb(20, 20, 20);
			margin-top: 10px;
		}
		.bottom a:hover{
			background-color: rgb(20, 20, 20);
			color: white;
			cursor: pointer;
			transition: all 0.1s;
			font-weight: 300;
			border-radius: 10px;
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
			color: #000000;
			text-decoration: none;
			background: #ffffff;
			border: solid 1px #c3c3c3;
			display: flex;
			border-radius: 16px;
			flex-direction: column;
			text-align: center;
			margin-top: 6%;
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
			background-color: #ffffff;
			border: 3px dotted #000;
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
			background-color: rgb(227, 227, 227);
			border: none;
			border-radius: 10px;
			padding: 10px;
			margin-bottom: 10px;
			font-size: 15px;
		}
		.last:hover{
			cursor: pointer;
			background-color: rgb(212, 212, 212);
		}
		.last:active{
			background-color: rgb(166, 166, 166);
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
			font-size: 15px;
			border: 1px #d0d0d0 solid;
			padding: 12px;
			border-radius: 10px;
			width: 90%;
		}
		.out .sql-change button{
			width: 95%;
			margin-top: 7px;
		}
		.out .sql-change input:focus{
			border: 1px #d0d0d0 solid;
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
				<p id="modalBtn" class="last" onclick="return false;">Change password</p>
				<?php if(!empty($passErrors)): ?>
				<div>
					<ul>
						<?php echo $passErrors; ?>
					</ul>
				</div>
				<?php endif; ?>	
				</div>
				<div id="modal" class="modal">
					<div class="modalContent">
						<p>Are you sure that you want to change the password. If you put a wrong new password you will loose you account.</p>
						<a class="close last">Back</a>
						<button class="last submit" type="submit" onclick="login.submit()" name="changepassword">Change password</button>
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