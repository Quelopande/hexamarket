<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Login">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
<?php include('keys.php') ?>
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $keys['public']?>"></script>
<body>
<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
		body{
            background: url('/assets/media/bg.png');
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
			border-radius: 25px;
			padding: 40px 30px 40px 30px;
		}
		.btn{
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
		#brand{
			/* display: flex;  */
			display: none;
			align-items: center;
		}
		.brand:nth-child(1){
			margin-right: 20px;
		}
		.brand img{
			margin: 0 auto;
		}
		.form-control{
			border-radius: 10px;
		}
		.title{
			font-weight: 800;
		}
		.alert{
			margin-left: -30px;
		}
		@media (max-width: 837px) {
			.form{
			margin-top: 15vh;
			}
		}
	</style>
		<form class="needs-validation was-validated form" novalidate="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1 class="title">Login</h1>	
			<?php if(!empty($errors)): ?>
				<div>
					<ul>
						<?php echo $errors; ?>
					</ul>
				</div>
			<?php endif; ?>
			<div class="position-relative">
				<label for="validationTooltipUsername" class="form-label">Username</label>
				<div class="input-group quelopande has-validation">
				<span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
				<input type="text" class="form-control user password_btn" name="user" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>
			</div>
			<div class="position-relative">
				<label for="validationTooltip02" class="form-label">Password</label>
				<input class="password form-control" id="validationTooltip02" type="password" name="password" required>
				<a href="fp" style="right: 0px; position: absolute;">Forgot your password?</a>
			</div>
			<input type="hidden" name="token" id="token" />
			<button class="btn" type="submit">Login</button><br>
		</form>
		<div id="morebtn" style="text-align: center; margin-top: -20px; margin-bottom: 30px;"><a ></a>View more login forms</a></div>
		<div class="brand" id="brand">
			<a class="btn brand" style="margin-top: -10px;" href="https://accounts.google.com/o/oauth2/v2/auth?response_type=code&access_type=online&client_id=984657386074-ud52oefhvedl35t6jn7ophdpmehefkso.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fhexamarket.store%2Fauth%2Fgoogle%2Findex.php&state&scope=email%20profile&approval_prompt=auto"><img src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA" alt="Google Logo" width="23xp"></a>
			<a class="btn brand" style="margin-top: -10px;" href='https://discord.com/oauth2/authorize?client_id=1270381953866141808&response_type=code&redirect_uri=https%3A%2F%2Fwww.hexamarket.store%2Fauth%2Fdiscord&scope=identify+guilds.join+email'><img src="https://cdn.prod.website-files.com/6257adef93867e50d84d30e2/636e0a6a49cf127bf92de1e2_icon_clyde_blurple_RGB.png" alt="Google Logo" width="30xp"></a>
		</div>
		You don't have an account? <a href="/register">Sign Up</a>
		<br>
		<p>By logging in, you agree to <a href="/politics/tos">Terms of Use</a> and <a href="/politics/privacypolicy">Privacy Policy</a></p>
		<h>Get back to the <a href="/">homepage</a></h4>
		<script>
			let moreBtn = document.getElementById('morebtn');
			let brand = document.getElementById('brand');


			moreBtn.addEventListener("click", function() {
				moreBtn.style.color = "red";
				brand.style.display = "flex ";
			});
		</script>
		<script>
		console.log(grecaptcha);
        grecaptcha.ready( function(){
            grecaptcha.execute( 
                '<?php echo $keys['public']; ?>',{ action: 'form' }
            ).then( function( responseToken ){
            	let inputToken = document.getElementById('token');
                inputToken.value = responseToken;
            })
        });
	</script>
</body>
</html>