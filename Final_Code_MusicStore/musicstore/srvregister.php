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
	$fname = $_POST['fname'];
	$lname =$_POST['lname'];
	$email =$_POST['email'];
	$pwd=$_POST['pwd'];
	$admin =$_POST['admin'];

	$user = $_SESSION["sess_userid"];
    	//mysqli_query($con,"UPDATE orders SET addressid=1 WHERE userid=1 ");
		$query = "INSERT INTO users (fname, lname, email, password, administrator, addressid,active) VALUES ('$fname','$lname','$email','$pwd','$admin',0,'1');";
	$result = mysqli_query ($con,$query);
		header('Location: login.php');
		//TODO: Call the select query & update the div for a selected Address

?>