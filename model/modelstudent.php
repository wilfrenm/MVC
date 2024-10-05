<?php
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for connecting database and execute query
	 */
	class ModelStudent{
		#Constructor has parameter passed in the object of the connection to database
		function __construct($conn){
			$this->conn=$conn;
		}
		
		
		
		
		function studentlist(){
			$query = $this->conn->prepare("select * from user_details where active_status=1 and user_type='student'");
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
		
		
		function studentinsert_table1($postdata){
			$query=$this->conn->prepare("insert into user_details (first_name,last_name,email,password,active_status,user_type) values(:first_name,:last_name,:email,:password,1,'student')");
			$query->bindParam(":first_name",$postdata["fname"]);
			$query->bindParam(":last_name",$postdata["lname"]);
			$query->bindParam(":email",$postdata["email"]);
			$password=base64_encode($postdata["password"]);
			$query->bindParam(":password",$password);
			try{
				$query->execute();
			}
			catch(Exception $e){
				$value=$e->getMessage();
				echo "<script>alert('Error Occured Email already exists')</script>";
			}
		}
		
		function studentinsert_table2($postdata,$id,$imgpath){
			$query=$this->conn->prepare("insert into student_details (r_user_id,dob,age,department,gender,location,phone_number,photo_location) values(:id,:dob,:age,:dept,:gender,:location,:phone_number,:photo_location)");
			print_r($postdata);print_r($id);
			$query->bindParam(":id",$id);
			$query->bindParam(":dob",$postdata["dob"]);
			$query->bindParam(":age",$postdata["age"]);
			$query->bindParam(":dept",$postdata["dept"]);
			$query->bindParam(":gender",$postdata["gender"]);
			$query->bindParam(":location",$postdata["location"]);
			$query->bindParam(":phone_number",$postdata["phone_number"]);
			$query->bindParam(":photo_location",$postdata["photo_location"]);
			try{
				$query->execute();
				return true;
			}
			catch(Exception $e){
				$value=$e->getMessage();
				echo "<script>alert('Error Occured Email already exists')</script>";
			}
		}
		
		function studentdatadelete($id){
			$query=$this->conn->prepare("update user_details set active_status='N' where user_id=:id");
			$query->bindParam(":id",$getdata['user_id']);
			try{
				$query->execute();
				return true;
			}
			catch(Exception $e){
				echo "<script>alert('{$e->getMessage()}')</script>";
				return false;
			}
		}
		
		
		
		
		
		
		
		
		
		#This funtion is used to fetch data of the students
		function studentdatafetch($postdata,$getdata){
			$stmt="select user_id,fname,lname,dob,dept,email,password,photo_location from student_details where active_status='Y'";
			
			#This if is for login check for student user
			if(!empty($postdata['user'])){
				if($postdata['user']=="student"){
					#Checking password as  database has passwords encoded
					$password=base64_encode($postdata['pass']);
					#appending the content to the query
					$stmt=$stmt." and email='".$postdata['email']."' and password='".$password."'";
					$query=$this->conn->prepare("$stmt");
					$query->execute();
					$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
					return $resultset;
				}
			}
			#Filter key check in url
			else if(!empty($getdata['filter'])){
				#Loop for the submitted data in form and append the condition with query
				foreach($postdata as $key=>$value){
					if(!empty($value)){
						#condition for password to encode the password and store it in database
							$stmt=$stmt."and $key='".$value."'";
					}
				}
				$query=$this->conn->prepare("$stmt");
				$query->execute();
				$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
				return $resultset;
			}
			#Operation key check in url
			else if(!empty($getdata['operation'])){
				#Check if operation is not insert this is for viewing all details about specific user
				if($getdata['operation']!='insert'){
					$stmt="select * from student_details where user_id={$getdata['id']}";
				}
				$query=$this->conn->prepare("$stmt");
				$query->execute();
				$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			}
			#limitstart is for getting the pagination values from starting
			if(!empty($getdata['limitstart'])){
				$stmt=$stmt."Limit ".$getdata['limitstart'].",".$getdata['limitend'];
			}
			#If no value then displayed from starting
			else{
				$stmt=$stmt." Limit 0,5";
				$getdata['limitstart']=0;
				$getdata['limitend']=5;
			}
			
			$query=$this->conn->prepare("$stmt");
			$query->execute();
			$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			return $resultset;
		}
		#To get all data of user
		function fetchAllStudentdata(){
			$query=$this->conn->prepare("select count(*) as c from student_details where active_status='Y'");
			$query->execute();
			$total_data_count=$query->fetchAll(PDO::FETCH_ASSOC)[0]['c'];
			return $total_data_count;
		}
		#This function is for inserting the data of the database
		// function studentdatainsert($postdata){
			// $query=$this->conn->prepare("insert into student_details (fname,lname,dob,dept,email,password,photo_location) values(:fname,:lname,:dob,:dept,:email,:password,:photo_location)");
			
			// $query->bindParam(":fname",$postdata["fname"]);
			// $query->bindParam(":lname",$postdata["lname"]);
			// $query->bindParam(":dob",$postdata["dob"]);
			// $query->bindParam(":dept",$postdata["dept"]);
			// $query->bindParam(":email",$postdata["email"]);
			// $password=base64_encode($postdata["password"]);
			// $query->bindParam(":password",$password);
			// $query->bindParam(":photo_location",$postdata["photo_location"]);
			// try{
				// $query->execute();
				// return true;
			// }
			// catch(Exception $e){
				// $value=$e->getMessage();
				// echo "<script>alert('Error Occured Email already exists')</script>";
				// return false;
			// }
		// }
		#This function is to soft delete that is updating the active_status in database to Yes or No
		// function studentdatadelete($getdata){
			// $query=$this->conn->prepare("update student_details set active_status='N' where user_id=:id");
			// $query->bindParam(":id",$getdata['user_id']);
			// try{
				// $query->execute();
				// return true;
			// }
			// catch(Exception $e){
				// echo "<script>alert('{$e->getMessage()}')</script>";
				// return false;
			// }
		// }
		#This function is used to update the existing content to the new values
		function studentupdate($data,$id){
			$query=$this->conn->prepare("update student_details set fname=:fname,lname=:lname,dob=:dob,dept=:dept,email=:email,password=:password,photo_location=:photo_location where user_id=:id");
			
			$query->bindParam(":fname",$data['fname']);
			$query->bindParam(":lname",$data['lname']);
			$query->bindParam(":dob",$data['dob']);
			$query->bindParam(":dept",$data["dept"]);
			$query->bindParam(":email",$data['email']);
			$password=base64_encode($data['password']);
			$query->bindParam(":password",$password);
			$query->bindParam(":photo_location",$data['photo_location']);
			$query->bindParam(":id",$id);
			
			
			try{
				$query->execute();
				return true;
			}
			catch(Exception $e){
			
				print_r($query);
				echo $e->getMessage();
				return false;
			}
		}
		#This function is used to fetch the admin data for checking in the controller
		function admindatafetch($logindata){
			
			$query=$this->conn->prepare("select * from admin where email=:email and password=:pass and active_status='Y'");
			$query->bindParam(":email",$logindata['email']);
			$password=base64_encode($logindata['pass']);
			$query->bindParam(":pass",$password);
			$query->execute();
			$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			
			if(!empty($resultset)){
				return $resultset;
			}
			else{
				return null;
			}
		}
		#Method used to insert admin
		function admindatinsert($getdata){
			$query=$this->conn->prepare("insert into admin (name,email,password) values(:name,:email,:password)");
			$query->bindParam(":name",$getdata['name']);
			$query->bindParam(":email",$getdata['email']);
			$password=base64_encode($getdata['password']);
			$query->bindParam(":password",$password);
			$query->execute();
		}
		#Method admin fetch
		function adminfetch(){
			$query=$this->conn->prepare("select * from admin where active_status='Y'");
			$query->execute();
			$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			return $resultset;
		}
		
		#Fetching specific data of the user
		function studentdataview($resultset){
			// $stmt="select fname,lname,dob,dept,email,password,photo_loation from student_details user_id={$resultset[0]['user_id']}";
			// $query=$this->conn->prepare("$stmt");echo "1";
			$query=$this->conn->prepare("select fname,lname,dob,dept,email,password,photo_location from student_details where user_id=:user_id");
			$query->bindParam(":user_id",$resultset[0]['user_id']);
			$query->execute();echo "ED";
			$studentdata=$query->fetchAll(PDO::FETCH_ASSOC);
			return $studentdata;
		}
		
	}

?>