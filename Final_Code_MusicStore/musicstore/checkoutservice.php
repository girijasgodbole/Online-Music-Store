<?php
	session_start();
 	//header("Cache-Control: no-cache");
    //header("Pragma: nocache");
	//require("dbConnect_getBill.php");
    //$request_id = preg_replace("/[^0-9]/","",$_GET['request']);
    $request_id = $_GET['request'];

    
    
    //echo $request_id;
    //$request_moreinfo = preg_replace("/[^0-9]/","",$_REQUEST['moreinfo']);
    $con=mysqli_connect('localhost','root','root','musicstore',1433);
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
    if(strcmp($request_id,"btnGetBillAddr") == 0|| strcmp($request_id,"btnGetShipAddr") == 0)
    {

    	 //Open modal popup to allow address selection 
        //Address creation
		//TODO: Get User ID from session
		 $user = $_SESSION["sess_userid"];
		//Get Address
		//$con=mysqli_connect("localhost","root","root","musicstore",1433);
		$query = "SELECT ad.addressid as addressid, ad.userid as userid, ad.addr1 as addr1, ad.addr2 as addr2, ad.addr3 as addr3, ad.city as city, ad.state as state, ad.country as country, ad.zip as zip, ad.phone as phone FROM address ad;";
		$result = mysqli_query ($con,$query);
		$result_array=array();
		$i=0;
		while($row = mysqli_fetch_array($result)){
		  $result_array[$i]['addressid']=$row['addressid'];
		  $result_array[$i]['userid']=$row['userid'];
		  $result_array[$i]['addr1']= $row['addr1'];
		  $result_array[$i]['addr2']= $row['addr2'];
		  $result_array[$i]['addr3']= $row['addr3'];
		  $result_array[$i]['city']= $row['city'];
		  $result_array[$i]['state']= $row['state'];
		  $result_array[$i]['country']= $row['country'];
		  $result_array[$i]['zip']= $row['zip'];
		  $result_array[$i]['phone']= $row['phone'];
		  $i++;
		}
		//header("Content-Type:application/json");
		//echo $result_array;
		echo '<div id="divBilling" class="table-responsive">
			  <table class="table table-hover table-bordered">
			    <thead>
			      <tr>
			        <th>Select</th>
			        <th>Address1</th>
			        <th>Address2</th>
			        <th>Address3</th>
			        <th>City</th>
			        <th>State</th>
			        <th>Zip</th>
			      </tr>
			    </thead>
			    <tbody>';
			    for($j=0;$j<$i;$j++){

			     echo '<tr>
			        <td>
			          <input type="radio" name="radios" value="'.$result_array[$j]['addressid'].'" id="radio1" />
			        </td>
			        <td>'.$result_array[$j]['addr1'].'</td>
			        <td>'.$result_array[$j]['addr2'].'</td>
			        <td>'.$result_array[$j]['addr3'].'</td>
			        <td>'.$result_array[$j]['city'].'</td>
			        <td>'.$result_array[$j]['state'].'</td>
			        <td>'.$result_array[$j]['zip'].'</td>	
			      </tr>';
			      
			  }

			   echo  '</tbody>
			  </table> 

		</div>';
		
        
    }
    else if($request_id=="btnSaveAddr"){
    	$param = $_GET['param'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];

    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "UPDATE orders SET addressid='$param' WHERE userid='$user' AND status = 'precheckout';";
    	$result = mysqli_query ($con,$query);
    	$query1 = "SELECT ad.addressid as addressid, ad.userid as userid, ad.addr1 as addr1, ad.addr2 as addr2, ad.addr3 as addr3, ad.city as city, ad.state as state, ad.country as country, ad.zip as zip, ad.phone as phone FROM address ad where ad.addressid = '$param';";
		$result = mysqli_query ($con,$query1);
		$result_array=array();
		$i=0;
		while($row = mysqli_fetch_array($result)){
		  $result_array['addressid']=$row['addressid'];
		  $result_array['userid']=$row['userid'];
		  $result_array['addr1']= $row['addr1'];
		  $result_array['addr2']= $row['addr2'];
		  $result_array['addr3']= $row['addr3'];
		  $result_array['city']= $row['city'];
		  $result_array['state']= $row['state'];
		  $result_array['country']= $row['country'];
		  $result_array['zip']= $row['zip'];
		  $result_array['phone']= $row['phone'];
		  $i++;
		}

		$address = $result_array['addr1'].",<br/> ". $result_array['addr2'] . ", <br/>" . $result_array['city'].', '.$result_array['state'].', '.$result_array['zip'];
		echo $address;		//TODO: Add select query to get the selected address
		
	}else if($request_id=="btnSaveAddrShip"){
    	$param = $_GET['param'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "UPDATE orders SET shippingid='$param' WHERE userid='$user' AND status = 'precheckout';";
    	$result = mysqli_query ($con,$query);
    	$query1 = "SELECT ad.addressid as addressid, ad.userid as userid, ad.addr1 as addr1, ad.addr2 as addr2, ad.addr3 as addr3, ad.city as city, ad.state as state, ad.country as country, ad.zip as zip, ad.phone as phone FROM address ad where ad.addressid = '$param';";
		$result = mysqli_query ($con,$query1);
		$result_array=array();
		$i=0;
		while($row = mysqli_fetch_array($result)){
		  $result_array['addressid']=$row['addressid'];
		  $result_array['userid']=$row['userid'];
		  $result_array['addr1']= $row['addr1'];
		  $result_array['addr2']= $row['addr2'];
		  $result_array['addr3']= $row['addr3'];
		  $result_array['city']= $row['city'];
		  $result_array['state']= $row['state'];
		  $result_array['country']= $row['country'];
		  $result_array['zip']= $row['zip'];
		  $result_array['phone']= $row['phone'];
		  $i++;
		}
 
		$address = $result_array['addr1'].", <br/>". $result_array['addr2'] . ", <br/>" . $result_array['city'].', '.$result_array['state'].', '.$result_array['zip'];
		echo $address;		//TODO: Add select query to get the selected address
		
	}else if(strcmp($request_id,"btnAddPayment") == 0)
    {

		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
		//Get Address
		//$con=mysqli_connect("localhost","root","root","musicstore",1433);
		$query = "SELECT py.id as id, py.userid as userid, py.name as name, py.cardnum as cardnum, py.expdate as expdate, py.cvv2 as cvv2, py.active as active, py.zip as zip FROM payment py;";
		
		$result = mysqli_query ($con,$query);
		$result_array=array();
		$i=0;
		while($row = mysqli_fetch_array($result)){
		  $result_array[$i]['id']=$row['id'];
		  $result_array[$i]['userid']=$row['userid'];
		  $result_array[$i]['name']= $row['name'];
		  $result_array[$i]['cardnum']= $row['cardnum'];
		  $result_array[$i]['expdate']= $row['expdate'];
		  $result_array[$i]['cvv2']= $row['cvv2'];
		  $result_array[$i]['active']= $row['active'];
		  $result_array[$i]['zip']= $row['zip'];
		  $i++;
		}
		//header("Content-Type:application/json");
		//echo $result_array;
		echo '<div id="divBilling" class="table-responsive">
			  <table class="table table-hover table-bordered">
			    <thead>
			      <tr>
			        <th>Select</th>
			        <th>Card Number</th>
			        <th>Card Owner</th>
			        <th>Expiry Date</th>
			        <th>Zip</th>
			      </tr>
			    </thead>
			    <tbody>';
			    for($j=0;$j<$i;$j++){

			     echo '<tr>
			        <td>
			          <input type="radio" name="radiosPay" value="'.$result_array[$j]['id'].'" id="radioPay" />
			        </td>
			        <td>'.$result_array[$j]['cardnum'].'</td>
			        <td>'.$result_array[$j]['name'].'</td>
			        <td>'.$result_array[$j]['expdate'].'</td>
			        <td>'.$result_array[$j]['zip'].'</td>
			      </tr>';
			      
			  }

			   echo  '</tbody>
			  </table> 

		</div>';
		
        
    }else if($request_id=="btnSavePayment2"){
    	$param = $_GET['param'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];

    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "UPDATE orders SET paymentid='$param' WHERE userid='$user' AND status = 'precheckout';";
    	$result = mysqli_query ($con,$query);
    	$query1 = "SELECT py.id as id, py.userid as userid, py.name as name, py.cardnum as cardnum, py.expdate as expdate, py.cvv2 as cvv2, py.active as active, py.zip as zip FROM payment py WHERE py.id='$param';";
		$result = mysqli_query ($con,$query1);
		$result_array=array();
		$i=0;
		while($row = mysqli_fetch_array($result)){
		  $result_array['id']=$row['id'];
		  $result_array['name']=$row['name'];
		  $result_array['cardnum']= $row['cardnum'];
		  $result_array['expdate']= $row['expdate'];
		  $result_array['cvv2']= $row['cvv2'];
		  $result_array['active']= $row['active'];
		  $result_array['zip']= $row['zip'];
		  $i++;
		}

		$address = "Card Number: ".$result_array['cardnum'].",<br/> Owner: ". $result_array['name'].'<br/> Type: AMEX';
		echo $address;		//TODO: Add select query to get the selected address
		
	}else if($request_id=="btnPurQuant"){
    	$purid = $_GET['param1'];
    	$quant = (int)$_GET['param2'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
		if($quant != 0){

    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "SELECT pi.orderid as orderid, i.count as availablecount from purchaseitems pi, inventory i where pi.id = '$purid' and pi.itemid = i.itemid;";	
    	$result = mysqli_query ($con,$query);
    	
		$diff = 0;
		$temp = 0;
		if($row = mysqli_fetch_array($result)){
		 	$temp = (int)$row['availablecount'];
			$diff = $temp - $quant;
		}
		if($diff >= 0){
			//Do the update
			$query = "UPDATE purchaseitems SET quantity='$quant' WHERE id='$purid';";
    		$result = mysqli_query ($con,$query);
			$message = "Quantity Updated !!";			
		}else{
			$message = "Quantity Not Avaialble For Purchase. Please reduce quantity to proceed";	
		}
	} else {
		$message = "Quantity Cannot be Zero ! Plase update Quantity to proceed/ Delete the Item.";
	}
		
		echo $message;		//TODO: Add select query to get the selected address
		
	}else if($request_id=="btnCheckout"){
    	$purid = $_GET['param'];
    	$total = $_GET['param1'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
		$query = "SELECT count(*) as count, orderid FROM orders where userid='$user' and status='precheckout';";
    	$result = mysqli_query ($con,$query);

    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "SELECT pi.orderid as orderid, pi.quantity as quantity, pi.itemid as itemid , i.count as availablecount from purchaseitems pi, inventory i where pi.id = '$purid' and pi.itemid = i.itemid;";
    	$result = mysqli_query ($con,$query);
    	
		$diff = 0;
		$temp = 0;$itemid=0;$orderid=0;$quant=0;
		if($row = mysqli_fetch_array($result)){
		 	$temp = (int)$row['availablecount'];
		 	$quant = (int)$row['quantity'];
			$diff = $temp - $quant;
			$itemid = $row['itemid'];
			$orderid = $row['orderid'];
		}
		//Get the total

		if($diff >= 0){
			//Update iternary
			$query = "UPDATE inventory SET count='$diff' WHERE itemid='$itemid';";
    		$result = mysqli_query ($con,$query);
    		$query = "UPDATE orders SET status='complete', total='$total' WHERE orderid='$orderid';";
    		$result = mysqli_query ($con,$query);
    		//Complete Order
			
		}else{
			$message = "Quantity Not Avaialble For Purchase";	
		}

		
		echo $message;		//TODO: Add select query to get the selected address
		header('Location: admin_logged.php');
		
	}else if($request_id=="btnAddCart"){
		header('Location: checkout.php');
    	$itemid = $_GET['param'];
    	//echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "SELECT i.count as availablecount inventory i where i.id = '$itemid';";
    	$result = mysqli_query ($con,$query);
    	
		$diff = 0;
		$temp = 0;$orderid=0;$quant=0;
		if($row = mysqli_fetch_array($result)){
		 	$temp = (int)$row['availablecount'];
			$diff = $temp - 1;
		}
		//Get the total

		if($diff >= 0){
			//Update iternary
			$query = "SELECT count(*) as count, orderid FROM orders where userid='$user ' and status='precheckout';";
    		$result = mysqli_query ($con,$query);
    		$count = 0;
	    	if($row = mysqli_fetch_array($result)){
			 	$count = (int)$row['count'];
				$orderid = $row['orderid'];
			}
			if ($count > 0){
				$query = "INSERT INTO purchaseitems(orderid, itemid, quantity, active) VALUES ('$orderid', '$itemid', '1','1');";
    			$result = mysqli_query ($con,$query);
			}else{
				$query = "INSERT INTO orders(userid, createdate, total, addressid, shippingid, paymentid, status) VALUES ('$user','12/06/2017', '0', 0, 0, 0, 'precheckout' );";
    			$result = mysqli_query ($con,$query);
    			$query = "SELECT count(*) as count, orderid FROM orders where userid='$user' and status='precheckout';";
	    		$result = mysqli_query ($con,$query);
	    		$count = 0;
		    	if($row = mysqli_fetch_array($result)){
				 	$count = (int)$row['count'];
					$orderid = $row['orderid'];
				}
				$query = "INSERT INTO purchaseitems(orderid, itemid, quantity, active) VALUES ('$orderid', '$itemid', '1','1');";
    			$result = mysqli_query ($con,$query);
			}
			
		}else{
			$message = "Quantity Not Avaialble For Purchase";	
			echo $message;
		}
		
	}
	else if($request_id=="btnPurDel"){
    	$purid = $_GET['param1'];
    //echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];

    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
    	$query = "UPDATE purchaseitems SET active='0' WHERE id='$purid';";	
    	$result = mysqli_query ($con,$query);
    	
 		//Complete Order
    		$query = "SELECT DISTINCT pi.id as purchaseid, pi.orderid as orderid, pi.itemid as itemid, al.album_name as name, pi.quantity as quantity, al.price as price FROM purchaseitems pi, albums al, item it, tracks tr WHERE pi.orderid in (SELECT orderid from orders where userid = '$user' and status='precheckout')
				and pi.itemid = it.itemid and
				it.itemid=al.albumid and pi.active='1'
				UNION
				SELECT DISTINCT pi.id as purchaseid,  pi.orderid as orderid, pi.itemid as itemid, tr.track_name as name, pi.quantity as quantity, tr.price as price  FROM purchaseitems pi, albums al, item it, tracks tr WHERE pi.orderid in (SELECT orderid from orders where userid = '$user' and status='precheckout')
				and pi.itemid = it.itemid and
				pi.itemid=tr.trackid and pi.active='1';";

				$result = mysqli_query ($con,$query);
				$purchases=array();
				$total = 0;
				$i=0;
				while($row = mysqli_fetch_array($result)){
				  $purchases[$i]['purchaseid']=$row['purchaseid'];
				  $purchases[$i]['orderid']=$row['orderid'];
				  $purchases[$i]['itemid']= $row['itemid'];
				  $purchases[$i]['name']= $row['name'];
				  $purchases[$i]['quantity']= $row['quantity'];
				  $purchases[$i]['price']= $row['price'];
				  $total +=  (int)$row['price']*(int)$row['quantity'];
				  $i++;
				}
				//Refresh 
						echo '<div id="divPurchaseItems" class="table-responsive">
						  <table class="table table-hover table-bordered">
					    <thead>
					      <tr>
					        <th>Delete/Update</th>
					        <th>Item Name</th>
					        <th>Item Price</th>
					        <th>Quantity</th>
					      </tr>
					    </thead><tbody>';
							for($j=0;$j<$i;$j++){

							 	echo '<tr>
								        <td class="nr" data-id='.$purchases[$j]['purchaseid']. '>
								          <button name="btnPurDel" id="btnPurDel" class="use-address btn btn-primary" type="button">Delete</button>
								          <button name="btnPurQuant" id="btnPurQuant" class="use-quant btn btn-primary" type="button">Update</button>
								        </td>
								        <td>'.$purchases[$j]['name'].'</td>
								        <td class="pr" data-orig='.$purchases[$j]['price'].'>'.$purchases[$j]['price']*$purchases[$j]['quantity'].'</td>
								        <td> <input type="text" class="inp form-control" name="expdate" value='.$purchases[$j]['quantity'].'></td>
						      		</tr>';
						 	 }

						   echo  '<tr><td></td><td>Total: </td><td class="tt">
						      		'. $total .'</td><td></td>
						      		</tr></tbody>
								  </table> 
								</div>';
			
	}
?>