<html>
<head>
<title>Student View</title>
<link rel="stylesheet" href="view/css/studentviewstyle.css">
</head>
<body>
</body>
</html>

<?php

	include("common/header.php");
	echo "<div class='margin'>
			<h1><span class='color'>{$studentdata[0]['fname']}</span> DETAILS</h1>";
	
	echo "<div class='div'>";
	
	echo"<div class='image'>
			<img src='{$studentdata[0]['photo_location']}' class='img'>
		</div><table cellspacing=0 cellpadding=5 align=center >";
	foreach($studentdata[0] as $key=>$value){
		if($key!="password" && $key!="r_user_id" && $key!="photo_location" && $key!="active_status"){
			echo "
				<tr>
					<td><b>$key</b></td><td>:</td>
					<td>$value</td>	
				</tr>
				
			";
		}
	}
	echo "</div></div></div>";

?>

