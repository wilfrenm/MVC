<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="view/css/loginstyle.css">
		<style>
			body{
				background-image:url("view/images/login-image.jpg");
			}
	</style>
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
	</head>
	<body>
		<div class="form">
			<h1>Login</h1>
			<form action="index.php?mod=validation&view=loginvalidate" onsubmit="return verify()" method=post class="form2" id="form3">
				<label>Email</label><br><br>
				<input type="email" name="email" class="input" required><br><br>
				<label>Password</label><br><br>
				<input type="password" name="pass" class="input" id="password" required><br><br>
				<span id="errordisp"></span><br>
				<input type="submit"><br><br>
			</form>
		</div>
	</body>

</html>