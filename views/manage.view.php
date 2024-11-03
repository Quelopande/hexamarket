<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Settings - Manage Content | Hexamarket</title>
	<link href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="website icon" type="webp" href="assets/media/logo.webp">
	<meta property="og:locale" content="en">
	<meta property="og:site_name" content="©Quelopande"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Hexamarket | Manage content">
    <script defer src="https://cdn.overtracking.com/t/t3LztDRiqUxbRS2X6/"></script>
</head>
</head>
<body class="body">
	<style>
		.contents{
			background-color: var(--background-secundary);
			margin-right: 20px;
			margin-left: 320px;
			margin-top: 40px;
			padding: 20px;
			border-radius: 30px;
		}
		.content{
			background-color: var(--background-primary-hover);
			color: var(--standard-txt-color);
			padding: 3px;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 16px;
			margin: 10px;
		}
		.quelopande{
			display: grid;
			font-weight: 500;
			grid-template-columns: repeat(auto-fit, minmax(0px, 500px));
			justify-content: space-around;
			margin-right: 10px;
			margin-left: 400px;
			margin-top: 40px;
			bottom: 20px;
		}
		.content:hover{
			background-color: var(--background-primary-active);
			cursor: pointer;
			transition: 0.2s all;
		}
		.content h2{
			margin-top: 40px;
		}
		.content span{
			position: absolute;
			right: 70px;
			margin-top: 10px;
		}
		.content button{
			padding: 6px;
			border: none;
			padding-left: 9px;
			margin-top: 5px;
			padding-right: 9px;
			border-radius: 13px;
			font-size: 15px;
			background-color: white;
			position: absolute;
			right: 220px;
			font-family: "Poppins", sans-serif;
			font-weight: 400;
		}
		.content button:hover{
			background: #9d9d9d6b;
		}
		.modal-content{
			border-radius: 16px !important;
			border: none;
		}
		.btn-secondary,.btn-primary{
			border-radius: 16px;
			border: none;
		}
		.btn-secondary{
			background-color: #c0c0c042;
			color: black;
		}
		.btn-secondary:hover{
			background-color: #c0c0c0a6;
			color: black;
		}
		.section{
			border: solid 1px black;
			padding: 10px;
			border-radius: 16px;
			margin-top: 10px;
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
			.content h2{
			margin-top: 60px;
		}
		}
	</style>
		<style>
		.emodal {
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
		.emodal-content {
			background-color: #fefefe;
			margin: auto;
			padding: 20px;
			width: 80%;
			border-radius: 16px;
		}
		.emodal-content .close{
			background-color: red;
			color: white;
			font-weight: 600;
		}
		.emodal-content .close:hover{
			background-color: #bf0000;
		}
		.esubmit{
			font-weight: 600;
			border: solid 1px #000 !important;
			position: static !important;
			right: 0;
			margin-left: 20px;
		}
		.esubmit:hover{
			background-color: #00b712;
		}
	</style>
	<?php require "menutemplate.view.php"; ?>
    <div class="contents">
	<?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>
		<?php echo $html;?>
	</div>
	<script>
		let modal = document.getElementById("myModal");
		let btn = document.getElementsByClassName("myBtn")[0];
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
        $(document).ready(function(){
            $('.edit-button').on('click', function(){
                var targetModal = $(this).data('target');
                $(targetModal).modal('show');
            });
        });
    </script>
	<script>
	$(document).ready(function() {
		$('form[id^="editForm"]').submit(function(event) {
			event.preventDefault;
			var formId = $(this).attr('id');
			var articleId = formId.replace('editForm', '');
			
			var formData = $(this).serializeArray();
			
			$.ajax({
				url: 'manageEdit.php',
				type: 'POST',
				data: {
					articleId: articleId,
					formData: formData
				}
			});
		});
	});
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