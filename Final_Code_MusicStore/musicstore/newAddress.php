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
	$addr1 = $_POST['addr1'];
$addr2 =$_POST['addr2'];
$city =$_POST['city'];
$state =$_POST['state'];
$country=$_POST['country'];
$zipcode =$_POST['zipcode'];
$cell =$_POST['cell'];
	$user = $_SESSION["sess_userid"];
    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
		$query = "INSERT INTO address (userid,addr1,addr2,addr3,city,state,country,zip,phone) VALUES ('$user','$addr1','$addr2','$addr2','$city','$state','$country','$zipcode','$cell');";
$result = mysqli_query ($con,$query);
		header('Location: checkout.php');
		//TODO: Call the select query & update the div for a selected Address

?>