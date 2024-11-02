<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Verify Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket - Verify account">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
<body>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
		body{
            background: url('/menzatyx/assets/media/bg.png');
            background-position: center;
			background-repeat: no-repeat; 
			background-size: cover; 
			background-attachment: fixed;
			display: flex;
			margin-left: 10px;
			margin-right: 10px;
			font-family: "Poppins", sans-serif;
		}
		.form{
			margin-inline: auto;
			margin-top: 25vh;
			background: white;
			width: 500px;
			border-radius: 36px;
			padding: 40px 30px 40px 30px;
		}
		.btn{
			margin-top: 20px;
			margin-bottom: 10px;
		}
		h6{
			color: #505050;
		}
		.title{
			font-weight: 800;
		}
		.alert{
			margin-left: -30px;
		}
		.sendEmail{
			border: solid 1px #000;
			padding: 5px;
			border-radius: 200px;
			margin-bottom: 30px;
			font-family: "Poppins", sans-serif;
		}
		.otp-container {
			display: flex;
			margin-top: 20px;
			gap: 10px;
			justify-content: center;
		}
		.otp-input {
			border: solid 1px #797979;
			width: 50px;
			height: 50px;
			font-size: 2rem;
			text-align: center;
			border-radius: 10px;
			background-color: #e5e5e5;
			outline: none;
			transition: background-color 0.5s;
		}
		.otp-input:focus {
			border: solid 1px #c0c0c0 !important;
			background-color: #c0c0c0;
			border-color: #000;
		}
		.btn{
			color: #000;
			margin-top: 40px;
			border: 2px solid black;
			box-shadow: 0px 6px 0px 0px #000;
			font-weight: 600;
			border-radius: 100px;
			padding: 10px;
			width: 100%;
			margin-bottom: 40px !important;
			background-color: white;
		}
		.btn:hover{
			border: 2px solid black;
			background-color: white;
			box-shadow: 0px 4px 0px 0px #000;
			transition: all ease-in-out 0.15s;
		}
		.btn:active{
			box-shadow: 0px 0px 0px 0px #000;
			transition: all ease-in-out 0.05s;
		}
	</style>
	<form class="needs-validation was-validated form" novalidate="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h1 class="title">Verify</h1>
		<h6>Username: <?php echo $_SESSION['user'] ?></h6>
		<?php if(!empty($errors)): ?>
				<div>
					<ul>
						<?php echo $errors; ?>
					</ul>
				</div>
			<?php endif; ?>
		<div class="otp-container">
			<input type="text" name="code1" class="otp-input" maxlength="1" required>
			<input type="text" name="code2" class="otp-input" maxlength="1" required>
			<input type="text" name="code3" class="otp-input" maxlength="1" required>
			<input type="text" name="code4" class="otp-input" maxlength="1" required>
			<input type="text" name="code5" class="otp-input" maxlength="1" required>
			<input type="text" name="code6" class="otp-input" maxlength="1" required>
		</div>
		<button class="btn" type="submit" name="submit">Submit form</button><br>
		<button name="sendEmail" class="sendEmail">Send the email again</button>
		<br>
		You don't have an account? <a href="/register">Sign Up</a>
		<br>
		Do you already have an account? <a href="/login">Login</a>
		<br>
		Wrong account? <a href="/close">Close</a>
	</form>
	<script>
	document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
		input.addEventListener('input', () => {
			if (input.value.length === 1 && index < inputs.length - 1) {
				inputs[index + 1].focus();
			}
		});

		input.addEventListener('keydown', (event) => {
			if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
				inputs[index - 1].focus();
			}
		});
	});
	</script>
</body>
</html>