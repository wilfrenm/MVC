<?php
	include("common/header.php");
?>
<html>
<head>
	<title>INSERT</title></head>
	<link rel="stylesheet" href="view/css/studentinsertstyle.css">
	<script>
		function verify(){
			let password=document.getElementById("password").value;
			let p='w@123';
			let pattern1=/[a-z]/g;
			let pattern2=/[0-9]/g;
			let pattern3=/[!@#$&*]/g;
			let pattern4=/[A-Z]/g;
			let pattern=/^[a-zA-Z0-9!@#$&*]{6,16}$/;
			console.log(pattern.test(password));
			if(password.length>5){
				console.log("length matched");
				let g=pattern.test(password);
				console.log(g);
				if(pattern1.test(password)){
					console.log("pattern1 true");
					if(pattern2.test(password)){
						console.log("pattern2 true");
						if(pattern3.test(password)){
							console.log("pattern3 true");
							if(pattern4.test(password)){
								console.log("pattern4 true");
								return true;
							}
							else{
								document.getElementById("errordisp").innerHTML="Password must have caps values";
								alert("Password must have caps values");
								return false;
							}
						}
						else{
							document.getElementById("errordisp").innerHTML="Password must have special symbols";
							return false;
						}
					}
					else
						document.getElementById("errordisp").innerHTML="Password must have digits";
						return false;
				}
				else{
					document.getElementById("errordisp").innerHTML="Password must have characters";
					return false;
				}
			}
			else{
				document.getElementById("errordisp").innerHTML="Password length must be greater than 5";
				return false;
				
			}
			
		}
	</script>
<body>
	<div class="form">
		<h1>INSERT NEW DATA</h1>
		<form action="index.php?mod=student&view=studentinsert&operation=insert&limitstart=0&limitend=5" method=post onsubmit="return verify()" enctype="multipart/form-data">
			<label>First Name:</label><br><br>
			<input type="text" name="fname" class="click" required><br><br>
			<label>Last Name:</label><br><br>
			<input type="text" name="lname" class="click" required><br><br>
			<label>Email:</label><br><br>
			<input type="email" name="email" class="click" required><br><br>
			<label>Password:</label><br><br>
			<input type="password" name="password" id="password" class="click" required><br><br>
			<span id="errordisp"></span><br>
			<label>DOB:</label><br><br>
			<input type="date" name="dob" class="click" required><br><br>
			<label>Age:</label><br><br>
			<input type="number" name="age" class="click" required><br><br>
			<label>Department:</label><br><br>
			<select name="dept">
				<option value="ECE">ECE</option>
				<option value="CSE">CSE</option>
				<option value="MECH">MECH</option>
				<option value="IT">IT</option>
				<option value="EEE">EEE</option>
				<option value="CIVIL">CIVIL</option>
			</select><br><br>
			<label>Gender:</label><br><br>
			<input type="radio" name="gender" value="Male" class="click" required><label for="gender">Male</label>
			<input type="radio" name="gender" value="Female" class="click" required><label for="gender">Female</label>
			<input type="radio" name="gender" value="Others" class="click" required><label for="gender">Others</label><br><br>
			<label>Location:</label><br><br>
			<input type="text" name="location" class="click" required><br><br>
			<label>Phone number:</label><br><br>
			<input type="number" name="phone_number" class="click" required><br><br>
			<label>Photo :</label><br><br>
			<input type="file" name="photo_location" class="click" required><br><br>
			<input type="submit">
		</form>
	<div>
</body>
</html>