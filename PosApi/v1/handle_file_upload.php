<?php

//getting the dboperation class
require_once '../includes/DbOperation.php';
	



		$filename=$_FILES["afile"]["tmp_name"];		


		 if($_FILES["afile"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                $order_date =$getData[5];
				$order_priority = $getData[4];
				$units_sold = $getData[8];
				$unit_price =$getData[9];
				$total_cost =$getData[12];
				$total_revenue =$getData[11];
				$item_type =$getData[2];
				
				
					//creating a new dboperation object
				$db = new DbOperation();
				      
				//creating a new record in the database
				$result = $db->createSales(
					 $order_date,
					 $order_priority,
					 $units_sold,
					 $unit_price,
					 $total_cost,
					 $total_revenue,
					 $item_type
					
				);

	           
	         }
			
	         fclose($file);	
		 }
		 


 ?>