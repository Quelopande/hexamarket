<?php
	$id = $result['id'];
	$jsonString = file_get_contents('content.json');
	$data = json_decode($jsonString, true);
	foreach ($data['users'] as $jsonUser) {
		if ($jsonUser['id'] == $id) {
			$theme = $jsonUser['theme'];
		}
	}

	$profileImagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/media/u/profile/' . $id . '.webp';
	if (file_exists($profileImagePath)) {
		$profileImage = '/assets/media/u/profile/' . $id . '.webp';
	} else {
		$profileImage = "/assets/media/notuser.webp";
	}
?>
<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
		<?php if ($theme === 'white'): ?>
        :root {
            --background-page: #f9f9f9;
            --background-primary: #d4d4d46b;
            --background-primary-hover: #e1e1e2;
            --background-primary-active: #d2d2d2;
            --background-secundary: #ededed;
            --background-tertiary: rgb(220, 220, 220);
            --border-primary: rgb(101, 101, 101);
            --standard-border-radius: 16px;
            --standard-txt-color: black;
            --standard-txt-color-opposite: white;
            --secondary-txt-color: rgb(59, 59, 59);
            --standard-txt-font-weight: 400;
        }
		<?php else: ?>
			:root {
				--background-page: #131314;
				--background-primary: #1e1f20;
				--background-primary-hover: #2a2a2a;
				--background-primary-active: #3d3d3d;
				--background-secundary: #1c1c1c;
				--background-tertiary: rgb(43, 43, 43);
				--border-primary: rgb(101, 101, 101);
				--standard-border-radius: 16px;
				--standard-txt-color: white;
				--standard-txt-color-opposite: rgb(12, 12, 12);
				--secondary-txt-color: rgb(237, 237, 237);
				--standard-txt-font-weight: 300;
			}
		<?php endif; ?>
		body{
			overflow-x: hidden;
			background-color: var(--background-page);
			font-family: "Poppins", sans-serif;
		}
		a{
			text-decoration: none;
			color: var(--standard-txt-color);
		}
		.util{
			background-color: rgba(0, 0, 0, 0.072);
			color: var(--standard-txt-color);
			position: fixed;
			margin-top: -30px;
			border-radius: 100px;
			padding: 15px;
			z-index: 100;
			border: solid 1px rgb(76, 76, 76);
		}
		.x-mark{
			display: none;
			padding-left: 17px;
			padding-right: 17px;
		}
		.sidebar{
			background-color: var(--background-page);
			color: var(--standard-txt-color);
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
			background-color: var(--background-primary);
			border-radius: 100px;
			margin-left: 20px;
			margin-right: 20px;
			margin-top: 60px;
			/* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.25); */
		}
		.sidebar .username:hover{
			cursor: pointer;
			box-shadow: 0px 0px 1px 5px var(--background-primary-active);
		}
		.sidebar .username img{
			border-radius: 100px;
			width: 60px;
			margin-left: 5px;
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.sidebar .username p{
			word-wrap: break-word;
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
			background-color: var(--background-primary-hover); /* c0c0c072 */
			cursor: pointer;
		}
		ul li:active{
			background-color: var(--background-primary-active);
		}
		.bottom{
			position: absolute;
			bottom: 40px;
			width: 90%;
			font-weight: var(--standard-txt-font-weight);
			margin-left: 5%;
		}
		.bottom > :nth-child(2){
			background-color: var(--standard-txt-color);
			color: var(--standard-txt-color-opposite);
			font-weight: var(--standard-txt-font-weight);
		}
		.bottom > :nth-child(2):hover{
			font-weight: var(--standard-txt-font-weight);
			background-color: #ffffff00;
			color: var(--standard-txt-color);
		}
		.bottom a{
			padding: 10px;
			display: block;
			border-radius: 200px;
			margin-left: 20px;
			margin-right: 20px;
			border: solid 2px var(--standard-txt-color);
			margin-top: 10px;
		}
		.bottom a:hover{
			background-color: var(--standard-txt-color);
			color: var(--standard-txt-color-opposite);
			cursor: pointer;
			transition: all 0.1s;
			font-weight: 300;
			border-radius: 10px;
		}
		#authverify{
			visibility: hidden
		}
		@media (min-width: 837px) {
			.util{display: none;}
		}
		@media (max-width: 837px) {
			.sidebar{display: none; margin-top: -1px;}
		}
</style>
<meta property="og:site_name" content="©Quelopande"/>
	<i class="fa-solid fa-list util"></i>
	<i class="fa-solid fa-x x-mark util"></i>
	<div class="sidebar">
		<div class="username" onclick="window.location.href='/dashboard'">
			<img src="<?php echo $profileImage?>" alt="Profile image" width="60px" height="60px">
			<p><?php echo $_SESSION['user'] ?></p>
		</div>
		<ul>                            
			<li onclick="window.open('/u/<?php echo $_SESSION['user'] ?>')"><i class="fa-solid fa-user"></i> Public page</li>
			<li onclick="window.location.href='/settings'"><i class="fa-solid fa-gear"></i> Settings</li>
			<li onclick="window.location.href='/security'"><i class="fa-solid fa-shield" style="color: rgb(55, 55, 255);"></i> Security</li>
			<!-- <li onclick="window.location.href='/privacy'"><i class="fa-solid fa-user-unlock"></i> Privacy</li> -->
			<li onclick="window.location.href='/link'"><i class="fa-solid fa-link"></i> Link account</li>
			<!-- <li onclick="window.location.href='/upgrade'"><i class="fa-solid fa-star" style="color: rgb(231, 123, 0);"></i> Upgrade</li> -->
			<li onclick="window.location.href='/manage'"><i class="fa-solid fa-pen"></i> Manage content</li>
			<li onclick="window.location.href='/billing'"><i class="fa-solid fa-wallet"></i> Billing</li>
			<!--  <li onclick="window.location.href='/remove'"><i class="fa-solid fa-trash" style="color: rgb(255, 44, 44);"></i> Remove account</li>-->
		</ul>
		<div class="bottom">
			<p onclick="window.location.href='/'"><i class="fa-solid fa-arrow-left-to-line"></i> Back to homepage</p>
			<a href="/post"><i class="fa-solid fa-cloud-arrow-up"></i> Post content</a>
			<a href="/close"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
		</div>
	</div>
	<style>
		.sidebar .bottom p{
			font-weight: 400;
			font-size: 17px;
			cursor: pointer;
		}
		.sidebar ul li{
			cursor: pointer;
		}
	</style>