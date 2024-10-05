<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>Student Details</title>
<style>
	
</style>
</head>
<body>
	<div>
		<table cellpadding=10>
			<tr>
				<td>First Name : </td>
				<td><?php echo $resultset['fname'] ?></td>
			</tr>
			<tr>
				<td>Last Name : </td>
				<td><?php echo $resultset['lname'] ?></td>
			</tr>
			<tr>
				<td>Date Of Birth : </td>
				<td><?php echo $resultset['dob'] ?></td>
			</tr>
			<tr>
				<td>Email : </td>
				<td><?php echo $resultset['email'] ?></td>
			</tr>
			<tr>
				<td>Password : </td>
				<td><?php echo base64_decode($resultset['password']) ?></td>
			</tr>
		</table>
		<button><a href="index.php?mod=student&view=studentcheck">BACK TO LOGIN</a></button>
	</div>
</body>
</html>
