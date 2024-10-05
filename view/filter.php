<?php
	echo"<div class='margin'>";
	if(!empty($_GET['filter'])){
		$flag=0;
		foreach($_POST as $key=>$value){
			if(!empty($value)){
				if($flag==0)
						echo"<h1 class='filter'>Filtered data based on </h1><ol>";
				if($key!="password")
					echo "<li>$key = $value</li>";
				else
					echo "<li>$key = ".($value)."</li>";
				$flag=1;
			}
		}
		if($flag)
			echo "</ol><button><a href='index.php?mod=student&view=studentlist'>REMOVE FILTER</a></button>";
		
	}
	echo "
		<div class='filter'>
			<form action='index.php?mod=student&view=studentlist&filter=true' method=post>
				<h3>FILTER</h3>
				<label>First Name</label>
				<input type='text' name='fname'>
				<label>Last Name</label>
				<input type='text' name='lname'>
				<label>Email</label>
				<input type='email' name='email'>
				<label>DOB</label>
				<input type='date' name='dob'>
				<label>Department</label>
				<input type='text' name='dept'><br>
				<input type='submit' value='Apply'>
			</form>
		</div>
		";
?>