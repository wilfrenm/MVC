<?php

	class ModelLoginValidate{
		function loginvalidate(){
			$query = $this->conn->prepare("select * from user_details where active_status=1 and email=:email and password=:password");
			$query->bindParam(":email",$_POST['email']);
			$query->bindParam(":password",$_POST['pass']);
			$query->execute();
			return $query->fetch(PDO::FETCH_ASSOC);
		}
	}

?>