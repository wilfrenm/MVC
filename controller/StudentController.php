<?php
	
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for controlling data from model and view
	 */
	class StudentController{
		#Controller class for redirecting and performing bussiness logics
		#Constructor creates object for model and starts the session
		function __construct($conn){
			include_once("model/modelstudent.php");
			$this->studentmodelobject=new ModelStudent($conn);
			if(empty($_SESSION['user'])){
				session_start();
			}
		}
		#This function used to display the student list
		function studentlist(){
			#if admin is the user then showing all student's data 
			if($this->sessioncheck()=="admin"){
				$studentdata=$this->studentmodelobject->studentlist();
				include("view/viewstudentlist.php");
				// $_SESSION['count']=$this->studentmodelobject->fetchAllStudentdata();
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
					#now send the data to model and insert into database table
					$this->studentmodelobject->studentinsert_table1($postdata);
					$result=$this->studentmodelobject->studentlist();
					$user_id=$result[count($result)-1]['user_id'];
					
					$result=$this->studentmodelobject->studentinsert_table2($postdata,$user_id,$imgpath);
					
						
					if($result)echo"<script>alert('Inserted successfully')</script>";
					
					#After inserting list all the user
					$this->studentlist();
				}
			}
		}
		
		function studentdelete(){
			#Checking if  the user is  set or not for only access to admin
			if($this->sessioncheck()=="admin"){
				//Once delete button clicked id of the particular user is send via url
				$result=$this->studentmodelobject->studentdatadelete($_GET);
				if($result)echo"<script>alert('Deleted successfully')</script>";
				$this->studentlist();
			}
			 
		}
		
		
		
		
		
		
		function admininsert(){
			if($this->sessioncheck()=="admin"){
				if(empty($_POST)){
					include("view/viewadmininsert.php");
				}
				else{
					$this->studentmodelobject->admindatinsert($_POST);
					$this->adminlist();
				}
			}
			 
		}
		function adminlist(){
			$admindata=$this->studentmodelobject->adminfetch();
			include("view/viewadminlist.php");
		}
		#This function is used to soft delete the value
		// function studentdelete(){
			// #Checking if  the user is  set or not for only access to admin
			// if($this->sessioncheck()=="admin"){
				// Once delete button clicked id of the particular user is send via url
				// $result=$this->studentmodelobject->studentdatadelete($_GET);
				// if($result)echo"<script>alert('Deleted successfully')</script>";
				// $this->studentlist();
			// }
			 
		// }
		#This function is used to update the existing user with new values
		function studentupdate(){
			#Checking if  the user is  set or not for only access to admin
			if($this->sessioncheck()=="admin"){
				#If url has getvalue then then edit form is displayed
				if($_GET['operation']=='getvalue'){
					#data is fetched for the particular user
					$resultset=$this->studentmodelobject->studentdatafetch(null,$_GET);
					include("view/viewstudentedit.html");
				}
				#This is for updating the values entered in the form
				else if($_GET['operation']=='update'){
					$imgpath="";
					#if files uploaded then move to local system and save the path in database
					if(!empty($_FILES)){
						$imgpath="view/images/".$_FILES['photo_location']['name'];
						move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
					}
					$_POST['photo_location']=$imgpath;
					$data=$_POST;
					#pass the imagepath,data array from post, and id of the user edited from url
					$result=$this->studentmodelobject->studentupdate($data,$_GET['id']);
					if($result)echo"<script>alert('Update successfully')</script>";
					$this->studentlist();
				}
			}
			 
		}
		/*This is  the initial function executed for checking the values entered by the users
		in login page*/
		function studentcheck(){
			#Once form submitted checking if user in the form checked or not
			if(!empty($_POST['user'])){
				#If the user is checked in admin column then fetch data of admin
				if($_POST['user']=="admin")
					$resultset=$this->studentmodelobject->admindatafetch($_POST);
				#else check the data of the student
				else
					$resultset=$this->studentmodelobject->studentdatafetch($_POST,null);
			}
			#This else is for view button in list
			else{
				$resultset=$this->studentmodelobject->studentdatafetch(null,$_GET);
			}
			#Checking if the fetched data has values or not
			if(!empty($resultset)){
				#radio button check in login page selected or not
				if(!empty($_POST['user'])){
					/*If user is admin then set session variable user to admin and name to the actual
					name for displaying in all pages*/
					if($_POST['user']=="admin"){
						$_SESSION['user']="admin";
						$_SESSION['name']=$resultset[0]['name'];
						#once data fetched then it is a true user so list all the data of students
						$this->studentlist();
					}
					#for checking if the user is student getting the fetched data from database
					#and checking if it has fname which means that the student name
					
					else if(!empty($resultset[0]['fname'])){
						$_SESSION['user']="student";
						$_SESSION['name']=$resultset[0]['fname'];
						#Once checked the specific data of the student is displayed and no
						#operations can be performed except loggin out
						$this->studentview($resultset);
					}
				}
				#To view the data using view button as view button has a link with operation=getvalue
				else if(!empty($_GET['operation']) && !empty($resultset[0]['fname'])){
					$this->studentview($resultset);
				}
				else{
					echo "<script>alert('Invalid Email or Password Please Enter Again')</script>";
					include("view/studentlogin.php");
				}
			}
			else{
				echo "<script>alert('Invalid Email or Password Please Enter Again')</script>";
				include("view/studentlogin.php");
			}
		}
		#This function is used to display specific details about the student
		function studentview($resultset){
			#Checking if the session for the variable is set or not
			if(isset($_SESSION['user'])){
				#calling model to fetch data of the specific user
				$studentdata=$this->studentmodelobject->studentdataview($resultset);
				if(!empty($studentdata))
					include("view/studentview.php");
			}
			else
				include("view/studentlogin.php");
		}
		
		function sessioncheck(){
			if(!empty($_SESSION['user']))
				return $_SESSION['user'];
			else
				header("location:index.php");
		}
		#Magic method to avoid using wrong view content in the url to avoid error
		function __call($fun,$result){
			
			if($this->sessioncheck()){
				echo "Invalid view";
				include("view/studentlogin.php");
				return null;
			}
		}
	}
	
?>