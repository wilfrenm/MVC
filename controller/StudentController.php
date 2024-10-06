<?php
	
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for controlling data from model and view
	 */
	class StudentController{
		public $studentmodelobject;
		#Controller class for redirecting and performing bussiness logics
		#Constructor creates object for model and starts the session
		function __construct($conn){
			include_once("model/modelstudent.php");
			$this->studentmodelobject=new ModelStudent($conn);
		}
		#This function used to display the student list
		function studentlist(){
			#if admin is the user then showing all student's data 
			if($this->sessioncheck()=="admin"){
				$pageno=$_GET['pgno'];
				$start=($_GET['pgno']*2)-2;
				$previous=$start-2;
				$studentdata=$this->studentmodelobject->studentlist($start);
				include("view/viewstudentlist.php");
			}
		}
		
		
		
		#This function is used to insert values to database
		function studentinsert(){
			//This if condition is for checking whether the user is admin or not
			if($this->sessioncheck()=="admin"){
				#In form to  differenciate after submitting operation in url used
				if(!isset($_GET["operation"]))
					include("view/viewstudentinsert.php");
				#If operation is set pass the value to model
				else{
					$postdata=$_POST;
					#Checking if the global variable file have data or not
					if(!empty($_FILES)){
						$imgpath="view/images/".$_FILES['photo_location']['name'];
						move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
						$postdata["photo_location"]=$imgpath;
					}
					#now send the data to model and insert into database table1
					$this->studentmodelobject->studentinsert_table1($postdata);
					#select the table data for getting the userid of last inserted data
					$user_id=$this->studentmodelobject->lastinsertedstudent();
					$result=$this->studentmodelobject->studentinsert_table2($postdata,$user_id,$imgpath);
					
						
					if($result)echo"<script>alert('Inserted successfully')</script>";
					
					#After inserting list all the user
					header("location:index.php?mod=student&view=studentlist&pgno=1");
				}
			}
		}
		
		function studentdelete(){
			#Checking if  the user is  set or not for only access to admin
			if($this->sessioncheck()=="admin"){
				//Once delete button clicked id of the particular user is send via url
				$result=$this->studentmodelobject->studentdatadelete($_GET['user_id']);
				if($result)echo"<script>alert('Deleted successfully')</script>";
				header("location:index.php?mod=student&view=studentlist");
			}
		}

		function studentedit(){
			#Checking if  the user is  set or not for only access to admin
			if($this->sessioncheck()=="admin"){
				#data is fetched for the particular user
				$resultset=$this->studentmodelobject->studentdatafetch($_GET['id']);
				include("view/viewstudentedit.php");
			}
		}


		function studentupdate(){
			#Checking if  the user is  set or not for only access to admin
			if($this->sessioncheck()=="admin"){
				$imgpath="";
				#if files uploaded then move to local system and save the path in database
				print_r($_FILES);
				if(!empty($_FILES['photo_location']['full_path'])){
					$imgpath="view/images/".$_FILES['photo_location']['name'];
					move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
					$_POST['photo_location']=$imgpath;
				}
				else{
					unset($_POST['photo_location']);
				}
				$data=$_POST;
				#pass the imagepath,data array from post, and id of the user edited from url
				$result=$this->studentmodelobject->studentupdate($data,$_GET['id']);
				if($result)echo"<script>alert('Updated successfully')</script>";
				header("location:index.php?mod=student&view=studentlist&pgno=1");
			}
			 
		}

		#This function is used to display specific details about the student
		function studentview($resultset){
			#Checking if the session for the variable is set or not
			if($_SESSION['user']){
				#calling model to fetch data of the specific user
				$studentdata=$this->studentmodelobject->studentdataview($resultset['id']);
				if(!empty($studentdata))
					include("view/studentview.php");
			}
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
		#Magic method to avoid using wrong view content in the url to avoid error
		function __call($fun,$result){
			
			if($this->sessioncheck()){
				echo "Invalid view";
				header("location:index.php");
				return null;
			}
		}
	}
	
?>