<?php
		session_start();
 		$user = 2;
		$con=mysqli_connect("localhost","root","root","musicstore",1433);
$query = "SELECT orderid, userid, createdate ,total, addressid, shippingid, paymentid, status FROM orders o WHERE o.userid='$user';";

$result = mysqli_query ($con,$query);
$purchases=array();
$total = 0;
$i=0;
while($row = mysqli_fetch_array($result)){
  $purchases[$i]['orderid']='OR0000'.(string)$row['orderid'];
  $purchases[$i]['createdate']=$row['createdate'];
  $purchases[$i]['total']= $row['total'];
  $purchases[$i]['status']= $row['status'];
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
	<h1 style="text-align: center;">My Orders</h1>
	<div>
		
		<div id="divRightPane" class="col-sm-10" >
			<p id="demo" style="font-size: x-small;"></p>
			
		
		<div id="divPurchase"  style="padding-top: 20px; padding-left: 20px;">
			
			<div>
				<div id="divPur" style="padding-top: 20px;">
					<?php 
						echo '<div id="divPurchaseItems" class="table-responsive">
						  <table class="table table-hover table-bordered">
					    <thead style="font-weight: bolder;background-color: green;">
					      <tr>
					        <th>Order #</th>
					        <th>Create Date</th>
					        <th>Total</th>
					        <th>Status</th>
					      </tr>
					    </thead><tbody>';
							for($j=0;$j<$i;$j++){

							 	echo '<tr>
								        <td class="nr">
								          '.$purchases[$j]['orderid'].'
								        </td>
								        <td>'.$purchases[$j]['createdate'].'</td>
								        <td class="pr">'.$purchases[$j]['total'].'</td>
								        <td> '.$purchases[$j]['status'].'</td>
						      		</tr>';
						 	 }

						   echo  '</tbody>
								  </table> 
								</div>'; ?>	
				</div>
				<div id="divPur2" style="color: crimson;">
				</div>
			</div>		
		</div>

		</div>
	</div>	
</body>
</html>