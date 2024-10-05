<?php
	
	class MainController
	{
		function __construct(){
			include("common/conn.php");
			$obj=new DbConnect();
			$this->conn=$obj->conn();
		}
		/**
		 * @author Wilfren
		 * @since 25/09/2024
		 * @update Wilfren(26-09-2024)
		 * @method hook
		 * 
		 *  This function is used to process the $_SERVER'S REQUEST_URI datas
			return array
		 */
		public function hook()
		{
			#Get's the URL
			$url=$_SERVER['REQUEST_URI'];
			#To divid's the path and query string
			$request=parse_url($url);
			if(array_key_exists('query',$request))
			{
				#To Seperates the query string with the seperator of &
				$query=explode("&",$request['query']);
				#To Seperates the query string process data with the seperator of =
				foreach($query as $query_data)
					$query_split[]=explode("=",$query_data);
				#processed data in the format of single array inside multi arrays ,so we decided to form as associate array
				$data=array_column($query_split,1,0);
				#if it's array then do to.
				#Both mod and view are exists means processed the data
				if(isset($data['mod'])&& isset($data['view']))
				{
					$datas=[
						'model'=>$data['mod'],
						'controller'=>$data['mod'],
						'view'=>$data['view'],
					];
					unset($data['mod'],$data['view']);
					$datas['request_data']=$data;
					#returns model, view and data in the associate array format
					$this->run_module($datas);
				}
				else
				{
					echo "URL is missing some datas";
				}
			}
			else
			{
				require "view/studentlogin.php";
			}   
		}

		/**
		 * @author Wilfren
		 * @since 25/09/2024
		 * @update Wilfren (26-09-2024)
		 * @method run_module
		 * 
		 *  This function is used to re-direct the execution flow. 
		 *  Geten datas from the hook to identify                                                                     the model data to re-directs the flow wi the certain mod and view data.
			return void
		 */

		public function run_module($request_datas)
		{
			#handling the file exception
			try 
			{
				session_start();
				$classname=ucfirst($request_datas['controller'])."Controller";
				#path direction(sub-Controller)
				$path = "controller/{$classname}.php";
				#file type doesn't throw exception so, include file_exists method
				if (!file_exists($path)) 
				{
					#controller file is not exists means
					throw new Exception('File not included');
				}
				else
				{
					include $path;
					$main=new $classname($this->conn);
					$func_name=$request_datas['view'];
					#dynamically call's the sub-contoller method 
					call_user_func(array($main,$func_name),$request_datas);
				}  
			}
			catch (Exception $e) 
			{
				echo $e->getMessage();
				die;
			}       
		}
	}
	$main=new MainController;
	$main->hook();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	// class Main_Controller{
		// /**
		 // * @author WILFREN M
		 // * @since 25/09/2024
		 // * @method hook
		 // *
		 // * This function is used to get url and form the array and send to the next function
		// */
		// function __construct(){
			// include("common/conn.php");
			// $obj=new DbConnect();
			// $this->conn=$obj->conn();
		// }
		// function hook(){
			// linkdata for storing the query string data in array format
			// $linkdata=[];
			// $linkdata=parse_url($_SERVER['REQUEST_URI']);
			// $exdata=explode("&",$linkdata['query']);
			// Loop for getting the key and value
			// $linkdata=[];
			// foreach($exdata as $value){
				// $data=explode("=",$value);
				// $linkdata[$data[0]]=$data[1];
			// }
			// Checking if model and view exist in url
			// if(array_key_exists('mod',$linkdata)&&array_key_exists('view',$linkdata)){
				// $request['controller']=$linkdata['mod'];
				
				// Loop to store data of the url in arranged format
				// foreach($linkdata as $key=>$value){
					// if($key!='mod'&&$key!='view'){
						// $request['data']["$key"]=$value;
					// }
					// else{
						// $request[$key]=$value;
					// }
				// }
				// $this->controllerinclude($request);	
			// }	
			// else{
				// echo "Invalid link";
			// }
			
		// }
		
		// function for creating object for model and function call for model
		// function controllerinclude($request){
			// $controllername=$request['controller']."Controller";
			// if(file_exists("controller/$controllername.php")){
				// include("controller/$controllername.php");
				// $controllername=ucfirst($controllername);
				// $obj=new $controllername($this->conn);
				// $funcname=$request['view'];
				// call_user_func(array($obj,$funcname),$request);
				
			// }
			// else{
				// echo "No such $controllername model";
			// }
			
		// }
	// }
		
	// $obj=new Main_Controller();
	// $obj->hook();

?>