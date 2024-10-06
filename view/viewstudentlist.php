<?php
	include("common/header.php");
	if(empty($_GET['open'])){
		echo "<button class='fil'><a href='index.php?mod=student&view=studentlist&open=true&pgno=1'>Filter</a></button>";
	}
	if(!empty($_GET['open'])){
		include("view/filter.php");
	}
?>
<html>
<head>
	<title>DATALIST</title>
	<link rel="stylesheet" href="view/css/studentliststyle.css">
	<script src="view/js/validation.js"></script>
</head>
<body>
	
	
<?php
	if(!empty($studentdata)){
		echo "<h1 class='heading'>STUDENT DETAILS</h1>";
		echo "<table align=center border=1 cellspacing=0 cellpadding=5 width=950><tr>";
		//For loop to print only keys so fetched first row's keys
		foreach($studentdata[0] as $key=>$value){
			if($key=="user_id" || $key=="first_name" || $key=="last_name" || $key=="email" || $key=="password")
				echo"<td bgcolor='lightgreen' align=center><b>".strtoupper($key)."</b></td>";
		}
		echo"<td bgcolor='lightgreen' align=center><b>DELETE</b></td>";
		echo"<td bgcolor='lightgreen'align=center><b>EDIT</b></td>";
		echo"<td bgcolor='lightgreen'align=center><b>VIEW</b></td>";
		echo"</tr>";
		foreach($studentdata as $key=>$value){
			echo"<tr>";
			foreach($value as $k2=>$v2){
				if($k2=='password'){
					echo"<td bgcolor='skyblue' align=center>".base64_decode($v2)."</td>";
				}
				else if($k2=="user_id" or $k2=="first_name" or $k2=="last_name" or $k2=="email"){
					echo"<td bgcolor='skyblue' align=center>$v2</td>";
				}
			}
			echo"<td bgcolor='skyblue' align=center><button class='button' onclick='return verify2()'><a href='index.php?mod=student&view=studentdelete&user_id=".$value['user_id']."' ><b>Delete</a></button></td>";
			echo"<td bgcolor='skyblue' align=center><button class='button'><a href='index.php?mod=student&view=studentedit&id=".$value['user_id']."'><b>Edit</a></button></td>";
			echo"<td bgcolor='skyblue' align=center><button class='button'><a href='index.php?mod=student&view=studentview&id=".$value['user_id']."'><b>View</a></button></td>";
			echo"</tr>";
		}
		
		echo"</tr></table><br><br>";
		
		echo"</div>";
	}

		echo "<div class='page'>";
		$prev=$pageno-1;
		if(empty($_GET['filter'])){
			if($pageno>1)
				echo"<br><button class='button'><a href='index.php?mod=student&view=studentlist&pgno=$prev'>Previous</a></button>";
			
			for($i=1;$i<=ceil($_SESSION['count']/2);$i++){
				if($i==$pageno)
					echo " &nbsp &nbsp <b><a href='index.php?mod=student&view=studentlist&pgno=$i' class='highlight'>$i</a></b> &nbsp &nbsp ";
				else
					echo " &nbsp &nbsp <a href='index.php?mod=student&view=studentlist&pgno=$i'>$i</a> &nbsp &nbsp ";
			}
			$next=$pageno+1;
			if($pageno<ceil($_SESSION['count']/2))
				echo "<button class='button'><a href='index.php?mod=student&view=studentlist&pgno=".$next."'>Next</a></button>";
		}
		else{
			echo"<h2>Filter Applied</h2>";
			if($pageno>1)
				echo"<br><button class='button'><a href='index.php?mod=student&view=studentlist&filter=true&pgno=$prev'>Previous</a></button>";
			
			for($i=1;$i<=ceil($_SESSION['count']/2);$i++){
				if($i==$pageno)
					echo " &nbsp &nbsp <b><a href='index.php?mod=student&view=studentlist&filter=true&pgno=$i' class='highlight'>$i</a></b> &nbsp &nbsp ";
				else
					echo " &nbsp &nbsp <a href='index.php?mod=student&view=studentlist&filter=true&pgno=$i'>$i</a> &nbsp &nbsp ";
			}
			$next=$pageno+1;
			if($pageno<ceil($_SESSION['count']/2))
				echo "<button class='button'><a href='index.php?mod=student&view=studentlist&filter=true&pgno=".$next."'>Next</a></button>";
		}
		echo "</div>";

?>

</body>
</html>