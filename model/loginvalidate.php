<?php

	class ModelLoginValidate{
		function __construct($conn){
			$this->conn=$conn;
		}
		function loginvalidate(){
			$query = $this->conn->prepare("select * from user_details inner join student_details on user_id=r_user_id where active_status=1 and email=:email and password=:password");
			$query->bindParam(":email",$_POST['email']);
			$password=base64_encode($_POST['pass']);
			$query->bindParam(":password",$password);
			$query->execute();
			$resultset=$query->fetch(PDO::FETCH_ASSOC);
			return $resultset;
		}
	}

?>