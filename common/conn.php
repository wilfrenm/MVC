<?php
	class DbConnect{
		function conn(){
			$server="localhost";
			$dbname="collegedatabase";
			$user="root";
			$conn=new PDO("mysql:host=$server;dbname=$dbname;port=3307","$user","");
			return $conn;
			
		}
	}
	
	
?>