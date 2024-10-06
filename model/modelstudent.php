<?php
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for connecting database and execute query
	 */
	class ModelStudent{
		public $conn;
		#Constructor has parameter passed in the object of the connection to database
		function __construct($conn){
			$this->conn=$conn;
		}
		
		function studentlist($start,$filtercontent){
			$stmt="select * from user_details inner join student_details on user_id = r_user_id where active_status=1 and user_type='student'";
			$query = $this->conn->prepare("$stmt");
			$query->execute();
			$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			$_SESSION['count']=count($resultset);
			if(!empty($filtercontent)){
				foreach($filtercontent as $key=>$value){
					if(!empty($value))
						$stmt .= " and $key='$value'";
				}
			}
			$stmt.=" Limit $start,2";
			$query=$this->conn->prepare("$stmt");
			$query->execute();
			$resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			return $resultset;
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

		function lastinsertedstudent(){
			$query = $this->conn->prepare("select user_id from user_details order by user_id desc limit 1");
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
		
		function studentinsert_table2($postdata,$id){
			$query=$this->conn->prepare("insert into student_details (r_user_id,dob,age,department,gender,location,phone_number,photo_location) values(:id,:dob,:age,:dept,:gender,:location,:phone_number,:photo_location)");
			
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
			$query->bindParam(":id",$id);
			try{
				$query->execute();
				return true;
			}
			catch(Exception $e){
				echo "<script>alert('{$e->getMessage()}')</script>";
				return false;
			}
		}


		function studentupdate($postdata,$id){
			$query=$this->conn->prepare("update user_details set first_name=:first_name,last_name=:last_name,email=:email,password=:password,active_status=1,user_type='student' where user_id=:id");
			$query->bindParam(":first_name",$postdata["fname"]);
			$query->bindParam(":last_name",$postdata["lname"]);
			$query->bindParam(":email",$postdata["email"]);
			$password=base64_encode($postdata["password"]);
			$query->bindParam(":password",$password);
			$query->bindParam(":id",$id);
			if(!empty($postdata['photo_location'])){
				$query2=$this->conn->prepare("update student_details set dob=:dob,age=:age,department=:department,gender=:gender,location=:location,phone_number=:phone_number,photo_location=:photo_location where r_user_id=:id");
				$query2->bindParam(":photo_location",$postdata["photo_location"]);
			}
			else
				$query2=$this->conn->prepare("update student_details set dob=:dob,age=:age,department=:department,gender=:gender,location=:location,phone_number=:phone_number where r_user_id=:id");
			
			$query2->bindParam(":id",$id);
			$query2->bindParam(":dob",$postdata["dob"]);
			$query2->bindParam(":age",$postdata["age"]);
			$query2->bindParam(":department",$postdata["dept"]);
			$query2->bindParam(":gender",$postdata["gender"]);
			$query2->bindParam(":location",$postdata["location"]);
			$query2->bindParam(":phone_number",$postdata["phone_number"]);
			
			try{
				$query->execute();
				$query2->execute();
				return true;
			}
			catch(Exception $e){
			
				// print_r($query);
				echo $e->getMessage();
				return false;
			}
		}

		#Fetching specific data of the user
		function studentdataview($id){
			$query=$this->conn->prepare("select * from user_details inner join student_details on user_id=r_user_id where active_status=1 and user_type='student' and user_id=:id");
			$query->bindParam(":id",$id);
			$query->execute();
			$studentdata=$query->fetchAll(PDO::FETCH_ASSOC);
			return $studentdata;
		}
		
		#This funtion is used to fetch data of the students
		function studentdatafetch($id){
				$query=$this->conn->prepare("select * from user_details inner join student_details on user_id=r_user_id where active_status=1 and user_type='student' and user_id=:id");
				$query->bindParam(":id",$id);
				$query->execute();
				$resultset= $query->fetchAll(PDO::FETCH_ASSOC);
				return $resultset;
		}
		
	}

?>