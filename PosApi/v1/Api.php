<?php 
    //https://profreehost.com/
	//getting the dboperation class
	require_once '../includes/DbOperation.php';

	//function validating all the paramters are available
	//we will pass the required parameters to this function 
	function isTheseParametersAvailable($params){
		//assuming all parameters are available 
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		//if parameters are missing 
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
			//displaying error
			echo json_encode($response);
			
			//stopping further execution
			die();
		}
	}
	
	//an array to display response
	$response = array();
	
	//if it is an api call 
	//that means a get parameter named api call is set in the URL 
	//and with this parameter we are concluding that it is an api call
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			//the CREATE operation
			//if the api call value is 'createhero'
			//we will create a record in the database
			case 'createsale':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('order_date', 'order_priority' ,'units_sold' ,'unit_price' ,'total_cost' ,'total_revenue', 'item_type'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				      
				//creating a new record in the database
				$result = $db->createSales(
					$_POST['order_date'],
					$_POST['order_priority'],
					$_POST['units_sold'],
					$_POST['unit_price'],
					$_POST['total_cost'],
					$_POST['total_revenue'],
					$_POST['item_type']
					
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'Sale addedd successfully';

					//and we are getting all the heroes from the database in the response
					$response['Sales'] = $result;
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break;


            case 'getprofite':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('order_date_start', 'order_date_end'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				      
				//creating a new record in the database
				$result = $db->getProfite(
					$_POST['order_date_start'],
					$_POST['order_date_end']
					
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'profite returened successfully';

					//and we are getting all the heroes from the database in the response
					$response['Sales'] = $result;
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break; 


            case 'getprofitable':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('order_date_start', 'order_date_end'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				      
				//creating a new record in the database
				$result = $db->getProfitable(
					$_POST['order_date_start'],
					$_POST['order_date_end']
					
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'profitable returened successfully';

					//and we are getting all the heroes from the database in the response
					$response['Sales'] =$result;
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break; 			
			
			//the READ operation
			//if the call is getheroes
			case 'getsale':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Request successfully completed';
				$response['Sales'] = $db->getSales();
			break; 
			
			
			//the UPDATE operation
			case 'updatesale':
				isTheseParametersAvailable(array('id','order_date', 'order_priority' ,'units_sold' ,'unit_price' ,'total_cost' ,'total_revenue', 'item_type'));
				$db = new DbOperation();
				$result = $db->updateSales(
				    $_POST['id'],
					$_POST['order_date'],
					$_POST['order_priority'],
					$_POST['units_sold'],
					$_POST['unit_price'],
					$_POST['total_cost'],
					$_POST['total_revenue'],
					$_POST['item_type']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Sale updated successfully';
					$response['Sales'] = $db->getSales();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
			break; 
			
			case 'getsalebyid':
				isTheseParametersAvailable(array('id'));
				$db = new DbOperation();
				$result = $db->getSalesById(
				    
					$_POST['id']
		
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Sale updated successfully';
					$response['Sales'] = $result;
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
			break;
			
			//the delete operation
			case 'deletesale':
                isTheseParametersAvailable(array('id'));
				
				$db = new DbOperation();
				$result = $db->deleteSales(
				    $_POST['id']
					
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Sale deleted successfully';
					$response['Sales'] = $db->getSales();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
			break; 
			
			case 'paginatesells':
				
			isTheseParametersAvailable(array('skip'));
				
			$db = new DbOperation();
			$result = $db->getPaginatedSells($_POST['skip']);

				if($result){
					$response['error'] = false; 
					$response['message'] = 'reterned results ';
					$response['results'] = $result;
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
	        break;
			
			
			case 'simplecountsalessubmision':
				
				//isTheseParametersAvailable(array('name'));
				
			$db = new DbOperation();
			$result = $db->getSellsCountAll();

				if($result){
					$response['error'] = false; 
					$response['message'] = 'reterned results ';
					$response['totalresults'] = $result;
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
	        break;
		}
		
	}else{
		//if it is not api call 
		//pushing appropriate values to response array 
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	//displaying the response in json structure 
	echo json_encode($response);
	
	
