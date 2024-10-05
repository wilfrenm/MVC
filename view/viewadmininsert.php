<?php
	include("common/header.php");
?>
<html>
<head>
	<title>INSERT</title></head>
	<link rel="stylesheet" href="view/css/studentinsertstyle.css">
<body>
	<div class="form">
		<h1>INSERT ADMIN DATA</h1>
		<form action="index.php?mod=student&view=admininsert" method=post enctype="multipart/form-data">
			<label>Name:</label><br><br>
			<input type="text" name="name" class="click" required><br><br>
			<label>Email:</label><br><br>
			<input type="email" name="email" class="click" required><br><br>
			<label>Password:</label><br><br>
			<input type="password" name="password" class="click" required><br><br>
			<input type="submit"  class="click"><br><br>
		</form>
	<div>
</body>
</html>