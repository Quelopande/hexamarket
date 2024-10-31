<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot password 2 | Don't share the url</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Forgotten Password 2nd step">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script></head>
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
			box-shadow: 0px 4px 0px 0px #000;
			transition: all ease-in-out 0.15s;
            background-color: white;
		}
		.btn:active{
			box-shadow: 0px 0px 0px 0px #000;
			transition: all ease-in-out 0.05s;
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
    <form class="needs-validation was-validated form" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?email=<?php echo isset($_GET['email']) ? urlencode($_GET['email']) : ''; ?>&code=<?php echo isset($_GET['code']) ? urlencode($_GET['code']) : ''; ?>" method="POST" name="login">
        <h1 class="title">Reset password</h1>
        <?php if(!empty($errors)): ?>
            <div>
                <ul>
                    <?php echo $errors;  ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="position-relative">
            <label for="validationTooltip01" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" id="validationTooltip01" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" >
        </div>
        <div class="position-relative">
            <label for="validationTooltip02" class="form-label">Code</label>
            <input type="text" name="code" id="code" class="form-control" id="validationTooltip02" required value="<?php echo isset($_GET['code']) ? htmlspecialchars($_GET['code']) : ''; ?>">
        </div>
        <div class="position-relative">
            <label for="validationTooltip02" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="validationTooltip02" required value="<?php echo isset($_GET['password']) ? htmlspecialchars($_GET['password']) : ''; ?>">
        </div>
        <div class="position-relative">
            <label for="validationTooltip02" class="form-label">Password 2</label>
            <input type="password" name="password2" class="form-control" id="validationTooltip02" required value="<?php echo isset($_GET['password2']) ? htmlspecialchars($_GET['password2']) : ''; ?>">
        </div>
        <input class="btn" type="submit" value="Reset password">
        <br>
        You don't have an account? <a href="/register">Sign Up</a>
        <br>
        Do you already have an account? <a href="/login">Login</a>
    </form>
    <script>
        let urlParams = new URLSearchParams(window.location.search);
        let email = urlParams.get('email');
        let code = urlParams.get('code');
        document.getElementById("email").value = email;
        document.getElementById("code").value = code;
    </script>
</body>
</html>