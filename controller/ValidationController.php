<?php

	class ValidationController{
		
		function __construct($conn){
			include_once("model/modelstudent.php");
			$this->stud_mod_object=new ModelStudent($conn);
		}
		
		function loginvalidate(){
			$resultset=$this->stud_mod_object->loginvalidate();
			if(!empty($resultset)){
				$_SESSION['user']="admin";
				header("location:index.php?mod=student&view=studentlist");
			}
			else{
				header("index.php");
			}
		}
		
		function logout(){
			header("location:index.php");
		}
		
		
	}




?>