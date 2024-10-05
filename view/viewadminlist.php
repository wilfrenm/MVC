<?php
	include("common/header.php");
?>
<html>
<head>
	<title>DATALIST</title>
	<link rel="stylesheet" href="view/css/studentliststyle.css">
</head>
<body>
	
	
<?php
	if(!empty($admindata)){
		echo "<h1 class='heading'>ADMIN DETAILS</h1>";
		echo "<table align=center border=1 cellspacing=0 cellpadding=5 width=950><tr>";
		//For loop to print only keys so fetched first row's keys
		foreach($admindata[0] as $key=>$value){
			echo"<td bgcolor='lightgreen' align=center><b>$key</b></td>";
		}
		echo"</tr>";
		foreach($admindata as $key=>$value){
			echo"<tr>";
			foreach($value as $k2=>$v2){
				if($k2=='password'){
					echo"<td bgcolor='skyblue' align=center>".base64_decode($v2)."</td>";
				}
				else{
					echo"<td bgcolor='skyblue' align=center>$v2</td>";
				}
			}
			echo"</tr>";
		}
		
		echo"</tr></table><br><br>";
		
		echo"</div>";
	}
	

?>

</body>
</html>
