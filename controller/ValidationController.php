<?php

	class ValidationController{
		
		function __construct($conn){
			include_once("model/modelstudent.php");
			$this->stud_mod_object=new ModelStudent($conn);
			include_once("model/loginvalidate.php");
			$this->login_mod_object=new ModelLoginValidate($conn);
		}
		
		function loginvalidate(){
			$resultset=$this->login_mod_object->loginvalidate();
			if(!empty($resultset)){
				if($resultset['user_type']=="admin"){
					$_SESSION['user']="admin";	
					$_SESSION['name']=strstr($resultset['email'],"@",true);
					header("location:index.php?mod=student&view=studentlist");
				}
				else{
					$_SESSION['user']="student";	
					$_SESSION['name']=strstr($resultset['email'],"@");
					$url="location:index.php?mod=student&view=studentview&id=".$resultset['user_id'];
					header("$url");
				}
			}
			else{
				print_r($resultset);
				header("location:index.php");
			}
		}
		
		function logout(){
			session_unset();
			session_destroy();
			header("location:index.php");
		}
		
		
	}




?>