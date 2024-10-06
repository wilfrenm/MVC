<html>
<head>
<link rel="stylesheet" href="view/css/headerstyle.css">
<script src="view/js/validation.js"></script>
</head>
<body>
<?php
	if($_SESSION['user']=="admin"){
		echo"
			<div class='header'>
				<h2>Welcome <span class='color'>{$_SESSION['name']}<span></h2>
				<button class='logout' onclick='return logout()'><a href='index.php?mod=validation&view=logout'>LOG OUT</a></button>
				<button><a href='index.php?mod=student&view=studentinsert'>ADD USER</a></button>
				<button><a href='index.php?mod=student&view=adminlist'>ADMIN LIST</a></button>
				<button><a href='index.php?mod=student&view=admininsert'>ADD ADMIN</a></button>
				<button class='home'><a href='index.php?mod=student&view=studentlist&limitstart=0&limitend=5'>HOME</a></button>
			</div>
			";
	}
	else{
		echo"
			<div class='header'>
				<h2>WELCOME <span class='color'>{$_SESSION['name']}<span></h2>
				<button class='logout' onclick='return logout()'><a href='index.php?mod=student&view=logout'>LOG OUT</a></button>
			</div>
			";
	}

?>
</body>
</html>