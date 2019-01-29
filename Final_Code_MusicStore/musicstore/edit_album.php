<?php
session_start();
 $con=mysqli_connect("localhost","root","root","musicstore",1433); 
  $title = $_POST['title'];
  $singer = $_POST['singer'];
  $bio = $_POST['bio'];
  $inventory_count = $_POST['inventory_count'];
  $album_id= $_POST['album_id'];
  $album_id=$album_id+1;
  $query = "UPDATE albums SET album_name = '$title' where albumid= '$album_id';";
  $result = mysqli_query ($con,$query);
  $query1= "SELECT `artistid` as artist_id FROM `albums` WHERE albumid ='$album_id';";
  $res1=mysqli_query($con, $query1);
  $row1 = mysqli_fetch_array($res1);
  $artist=$row1['artist_id'];
  $query2 = "UPDATE artist SET artist_name = '$singer' where artistid = '$artist';";
  $result2 = mysqli_query ($con,$query2);
  $query3 = "UPDATE artist SET bio = '$bio' where artistid = '$artist';";
  $result3 = mysqli_query ($con,$query3);
  $query4 = "UPDATE inventory SET count = '$inventory_count' where itemid = '$album_id';";
  $result4 = mysqli_query ($con,$query4);
  
 header('Location: admin_logged.php');

?>
