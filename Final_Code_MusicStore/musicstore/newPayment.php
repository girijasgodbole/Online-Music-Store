<?php
session_start();
	//$request_id = preg_replace("/[^0-9]/","",$_GET['request']);
    //$request_moreinfo = preg_replace("/[^0-9]/","",$_REQUEST['moreinfo']);
     $con=mysqli_connect('localhost','root','root','musicstore',1433);
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
	

	$name = $_POST['name'];
$cardnum =$_POST['cardnum'];
$expdate =$_POST['expdate'];	
$cvv2=$_POST['cvv2'];
$zip =$_POST['zip'];

	$user = $_SESSION["sess_userid"];
    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
		$query = "INSERT INTO payment (userid,name, cardnum, expdate, cvv2, active, zip) VALUES ('$user','$name','$cardnum','$expdate','$cvv2','1','$zip');";
		$result = mysqli_query ($con,$query);
		header('Location: checkout.php');
		//TODO: Call the select query & update the div for a selected Address

?>