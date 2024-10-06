<?php

    class AdminController{
        function __construct(){
            include_once("model/adminmodel.php");
			$this->adminmodelobject=new AdminModel($conn);
        }

        function admininsert(){
			if($this->sessioncheck()=="admin"){
				if(empty($_POST)){
					include("view/viewadmininsert.php");
				}
				else{
					$this->adminmodelobject->admindatinsert($_POST);
					$this->adminlist();
				}
			}
			 
		}
		function adminlist(){
			$admindata=$this->adminmodelobject->adminfetch();
			include("view/viewadminlist.php");
		}
        function sessioncheck(){
			if(!empty($_SESSION['user'])){
				if($_SESSION['user']=="admin"){
					return $_SESSION['user'];
				}
				else
					header("location:index.php");
			}
			else
				header("location:index.php");
		}

    }








?>