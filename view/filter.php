<html>
	<head>
		<script src='view/js/validation.js'></script>
	</head>
<body>
	<div class='margin'>
		<div class='filter'>
			<form action='index.php?mod=student&view=studentlist&filterdata_available=true&filter=true&pgno=1' onsubmit='return filtercheck()' method=post>
				<h3>FILTER</h3>
				<label>First Name</label>
				<input type='text' name='first_name'>
				<label>Last Name</label>
				<input type='text' name='last_name'>
				<label>Department:</label>
				<select name='department'>
					<option value=''>Select any</option>
					<option value='ECE'>ECE</option>
					<option value='CSE'>CSE</option>
					<option value='MECH'>MECH</option>
					<option value='IT'>IT</option>
					<option value='EEE'>EEE</option>
					<option value='CIVIL'>CIVIL</option>
				</select><br>
				<label>Gender:</label><br>
				<input type='radio' name='gender' value='Male' class='click' ><label for='gender'>Male</label><br>
				<input type='radio' name='gender' value='Female' class='click'><label for='gender' >Female</label><br>
				<input type='radio' name='gender' value='Others' class='click'><label for='gender' >Others</label><br>
				<label>Age</label>
				<input type='text' name='age' id='age'><br>
				<input type='submit' value='Apply'>
			</form>
		</div>
</body>
</html>