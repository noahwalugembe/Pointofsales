<?php
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
	
	/*
	* The create operation
	* When this method is called a new record is created in the database
	*/
	
	
	function createSales($order_date, $order_priority, $units_sold, $unit_price, $total_cost, $total_revenue, $item_type){
		$stmt = $this->con->prepare("INSERT INTO sales (order_date ,order_priority ,units_sold ,unit_price, total_cost, total_revenue ,item_type) VALUES ('$order_date', '$order_priority', '$units_sold', '$unit_price', '$total_cost', '$total_revenue', '$item_type')");
		//$stmt->bind_param("ssis", $name, $realname, $rating, $teamaffiliation);
		
		if($stmt->execute()){
			return true; 
		}else{
		   return false;
		}		
	}

	/*
	* The read operation
	* When this method is called it is returning all the existing record of the database
	*/
	function getSales(){
		$stmt = $this->con->prepare("SELECT id,order_date,order_priority,units_sold,unit_price,total_cost, total_revenue,item_type FROM sales ORDER BY order_date DESC LIMIT 6");
		$stmt->execute();
		$stmt->bind_result($id,$order_date, $order_priority, $units_sold, $unit_price, $total_cost, $total_revenue, $item_type);
		
		$Sales = array(); 
		
		while($stmt->fetch()){
			$Sale  = array();
			$Sale['id'] = $id; 
			$Sale['order_date'] = $order_date; 
			$Sale['order_priority'] = $order_priority; 
			$Sale['units_sold'] = $units_sold; 
			$Sale['unit_price'] = $unit_price;
            $Sale['total_cost'] = $total_cost; 
			$Sale['total_revenue'] = $total_revenue; 
			$Sale['item_type'] = $item_type; 
            			
			
			array_push($Sales, $Sale); 
		}
		
		return $Sales; 
	}
	
	function getPaginatedSells($skip){
		$stmt = $this->con->prepare("SELECT id,order_date,order_priority,units_sold,unit_price,total_cost, total_revenue,item_type FROM sales ORDER BY order_date DESC LIMIT 6 OFFSET $skip");
		$stmt->execute();
		$stmt->bind_result($id,$order_date, $order_priority, $units_sold, $unit_price, $total_cost, $total_revenue, $item_type);
		
		$Sales = array(); 
		
		while($stmt->fetch()){
			$Sale  = array();
			$Sale['id'] = $id; 
			$Sale['order_date'] = $order_date; 
			$Sale['order_priority'] = $order_priority; 
			$Sale['units_sold'] = $units_sold; 
			$Sale['unit_price'] = $unit_price;
            $Sale['total_cost'] = $total_cost; 
			$Sale['total_revenue'] = $total_revenue; 
			$Sale['item_type'] = $item_type; 
            			
			
			array_push($Sales, $Sale); 
		}
		
		return $Sales; 
	}
	
	function getSellsCountAll(){
		$stmt = $this->con->prepare("SELECT count(*) as total FROM sales");
		
		$stmt->execute();
		$stmt->bind_result($total);
		
		$sales = array(); 
		
		while($stmt->fetch()){
			$sale  = array();
			
			$sale['total'] = $total;
             			

			array_push($sales, $sale); 
		}
		
		
		return $sales; 
	}
	
	
	
	
	
	function getProfite($order_date_start,$order_date_end){
		$stmt = $this->con->prepare("SELECT (SELECT SUM(total_revenue-total_cost) AS Total FROM sales WHERE  order_date  >= '$order_date_start' AND order_date  <= '$order_date_end' ) AS profit");
		$stmt->execute();
		$stmt->bind_result($profit);
		
		$Profits = array(); 
		
		while($stmt->fetch()){
			$Profit  = array();
			$Profit['profit'] = $profit; 

			array_push($Profits, $Profit); 
		}
		
		return $Profits; 
	}
	
	function getProfitable($order_date_start,$order_date_end){
		$stmt = $this->con->prepare("SELECT sales.item_type, sum(sales.total_revenue - sales.total_cost) AS profit FROM sales WHERE  order_date  >= '$order_date_start' AND order_date  <= '$order_date_end' GROUP BY 1 ORDER BY profit  DESC LIMIT 3");
		$stmt->execute();
		$stmt->bind_result($item_type,$profit);
		
		$Profitables = array(); 
		
		while($stmt->fetch()){
			$Profitable  = array();
			$Profitable['item_type'] = $item_type; 
			$Profitable['profit'] = $profit; 
			
			
			array_push($Profitables, $Profitable); 
		}
		
		return $Profitables; 
	}
	
	function getSalesById($id){
		$stmt = $this->con->prepare("SELECT id,order_date ,order_priority ,units_sold ,unit_price, total_cost, total_revenue ,item_type FROM sales WHERE id='$id'");
		$stmt->execute();
		$stmt->bind_result($id,$order_date, $order_priority, $units_sold, $unit_price, $total_cost, $total_revenue, $item_type);
		
		$Sales = array(); 
		
		while($stmt->fetch()){
			$Sale  = array();
			$Sale['id'] = $id; 
			$Sale['order_date'] = $order_date; 
			$Sale['order_priority'] = $order_priority; 
			$Sale['units_sold'] = $units_sold; 
			$Sale['unit_price'] = $unit_price;
            $Sale['total_cost'] = $total_cost; 
			$Sale['total_revenue'] = $total_revenue; 
			$Sale['item_type'] = $item_type; 
            			
			
			array_push($Sales, $Sale); 
		}
		
		return $Sales; 
	}
	
	/*
	* The update operation
	* When this method is called the record with the given id is updated with the new given values
	*/
	function updateSales($id,$order_date, $order_priority, $units_sold, $unit_price, $total_cost, $total_revenue, $item_type){
		$stmt = $this->con->prepare("UPDATE sales SET order_date='$order_date', order_priority='$order_priority', units_sold='$units_sold', unit_price='$unit_price', total_cost='$total_cost', total_revenue='$total_revenue', item_type='$item_type' WHERE id='$id'");
		//$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute()){
			return true; 
		}else{
		return false;
        }		
	}
	
	
	/*
	* The delete operation
	* When this method is called record is deleted for the given id 
	*/
	function deleteSales($id){
		$stmt = $this->con->prepare("DELETE FROM sales WHERE id='$id' ");
		
		if($stmt->execute()){
			return true; 
		}else{
		
		return false; 
		}
	}
}