<?php

	class ModelLoginValidate{
		function __construct($conn){
			$this->conn=$conn;
		}
		function loginvalidate($data){
			$query = $this->conn->prepare("select * from user_details where active_status=1 and email=:email and password=:password");
			$query->bindParam(":email",$data['email']);
			$password=base64_encode($data['pass']);
			$query->bindParam(":password",$password);
			$query->execute();
			$resultset=$query->fetch(PDO::FETCH_ASSOC);print_r($resultset);
			return $resultset;
		}
	}

?>