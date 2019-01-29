<?php
session_start();
 $con=mysqli_connect("localhost","root","root","musicstore",1433); 
  $username = $_POST['uname'];
  $password = $_POST['psw'];
  $query = "SELECT userid, password, administrator, fname FROM users WHERE email = '$username';";

  $result = mysqli_query ($con,$query);
  $numberOfRows = $result->num_rows;
  if($numberOfRows == 0){
  	echo "USERNAME DOES NOT EXIST!!";
	echo "<br><a href='home.html'>Back</a>";
  }
  else{
 $row = mysqli_fetch_array($result);
if($row['password']==$password){
	$_SESSION["sess_userid"]=$row['userid'];
	$_SESSION["sess_fname"]=$row['fname'];
	if($row['administrator']==1){
		header('Location: admin_logged.php');
	}
	else{
		header('Location: user_logged.php');
	}	
}
else{
	echo "INCORRECT PASSWORD!!";
	echo "<br><a href='home.html'>Back</a>";
}
}

?>