<?php
	session_start();
 $user = $_SESSION["sess_userid"];
 $itemid = $_POST['btnAddCart'];
$con=mysqli_connect("localhost","root","root","musicstore",1433);
if($_POST['btnAddCart2'] == 'btnAddCart'){
    	//echo $param;
    	//Pass AddressId
    	//$addressId = $_GET['addrId'];
    	//Code to save the seleted address
  		//TODO: Get User ID from session
		$user = $_SESSION["sess_userid"];
		//echo $user;
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
$con=mysqli_connect("localhost","root","root","musicstore",1433);
$query = "SELECT DISTINCT pi.id as purchaseid, pi.orderid as orderid, pi.itemid as itemid, al.album_name as name, pi.quantity as quantity, al.price as price FROM purchaseitems pi, albums al, item it, tracks tr WHERE pi.orderid in (SELECT orderid from orders where userid = 2 and status='precheckout')
and pi.itemid = it.itemid and
it.itemid=al.albumid and pi.active='1'
UNION
SELECT DISTINCT pi.id as purchaseid,  pi.orderid as orderid, pi.itemid as itemid, tr.track_name as name, pi.quantity as quantity, tr.price as price  FROM purchaseitems pi, albums al, item it, tracks tr WHERE pi.orderid in (SELECT orderid from orders where userid = 2 and status='precheckout')
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

?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script 
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta charset="ISO-8859-1">
<script src="checkout.js"></script> 
<title>Music Store Checkout</title>
</head>
<body class="body">
	<h1 style="text-align: center;">Checkout</h1>
	<div>
		<div id="divLeftPane" class="col-sm-4">
		<div id="divBillAddr" style="background-color: whitesmoke;padding-left: 20px;padding-top: 10px;">
			<div class="header">
				<h3>Billing Address</h3>
			</div>
			<div>
				<div id="divSelectedBillAddr">
					<p id="pBillAddr">Select a Billing Address</p>
				</div>
				<button name="btnGetBillAddr" id="btnGetBillAddr" class="btn btn-primary" type="button">Add/Select Billing Address</button>
			</div>		
		</div>
		<div id="divShipAddr" style="padding-left: 20px;padding-top: 20px;background-color: whitesmoke;">
			<div class="header">
				<h3>Shipping Address</h3>
			</div>
			<div>
				<div id="divSelectedShipAddr">
					<p id="pShipAddr">Select a Shipping Address</p>
				</div>
				<button name="btnGetShipAddr" id="btnGetShipAddr" class="btn btn-primary" type="button">Add/Select Shipping Address</button>
			</div>		
		</div>
			<!--<button name="btnAddCart" id="btnAddCart" class="btn btn-primary" type="button">Add To Cart</button>-->
		</div>
		<div id="divRightPane" class="col-sm-8">
			<p id="demo" style="font-size: x-small;"></p>
			<div id="divShipMethod" style="background-color: whitesmoke;padding-left: 20px;padding-top: 5px;">
			<div class="header">
				<h3>Shipping Method</h3>
			</div>
			<div>
				<div id="divSelectedShipAddr2">
					<p id="pShipAddr">Want Faster Shipping ?</p>
				</div>
				<div >
				<div >
          			<input type="radio" name="rbtnShip" value="3" id="rbtnShip3" />
          			<label for="radio1">2nd Day Air ($15.00)</label>
          		</div>
          		<div >
          			<input type="radio" name="rbtnShip" value="4" id="rbtnShip4" />
          			<label for="radio1">Next Day Air ($35.00)</label>
          		</div>
          			
          			
				</div>
			</div>		
		</div>
		<div id="divPayment" style="padding-left: 20px;padding-top: 20px;background-color: whitesmoke;">
			<div class="header">
				<h3>Payment Method</h3>
			</div>
			<div>
				<div id="divSelectedPayment">
					<p id="pPayMethod">Select Payment Method</p>
				</div>
				<div >
					<button name="btnAddPayment" id="btnAddPayment" class="btn btn-primary" type="button">Add Payment Method</button>
				</div>
			</div>		
		</div>
		<div id="divPurchase" style="padding-left: 20px;padding-top: 10px;background-color: whitesmoke; padding-right: 20px;">
			<div class="header">
				<h3>Purchases</h3>
			</div>
			<div>
				<div id="divPur">
					<?php 
						echo '<div id="divPurchaseItems" class="table-responsive">
						  <table class="table table-hover table-bordered">
					    <thead style="font-weight: bolder;background-color: green;">
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

						   echo  '<tr><td></td><td>Total $: </td><td class="tt">
						      		'. $total .'</td><td></td>
						      		</tr></tbody>
								  </table> 
								</div>'; ?>	
				</div>
				<div id="divPur2" style="color: crimson;">
				</div>
			</div>		
		</div>
	
		<div style="padding-left: 20px;padding-top: 20px;background-color: whitesmoke;">
			<button name="btnCheckout" id="btnCheckout" class="btn btn-primary" type="button">Check Out</button>
		</div>
		</div>
	</div>	
<!-- Show modal popup -->
<!-- Modal - Billing Address -->
<div id="mdlBilling" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Select Address</h2>
    </div>
    <div class="modal-body" style="overflow-y:auto;max-height: 400px;">
      <p>Please Select Address</p>
      <div w3-include-html="billingaddr.html"></div> 
      <script type="text/javascript">
w3.includeHTML();
</script>
    </div>
    <div class="modal-footer">
      <!--<h3>Message: Select Address for</h3>-->
    </div>
  </div>
</div>
<!-- Modal - Payment -->
<div id="mdlPayment" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close1">&times;</span>
      <h2>Payment</h2>
    </div>
    <div class="modal-body" style="overflow-y:auto;max-height: 400px;">
      <p>Please Select Payment</p>
      <div w3-include-html="payment.html"></div> 
      <script type="text/javascript">
w3.includeHTML();
</script>
    </div>
    <div class="modal-footer">
      <!--<h3>Message: Select Address for</h3>-->
    </div>
  </div>

</div>
<script>

</script>
</body>
</html>