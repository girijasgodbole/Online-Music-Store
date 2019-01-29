<?php
session_start();
 $con=mysqli_connect("localhost","root","root","musicstore",1433); 
  $track_name = $_POST['track_name'];
  $artist_name = $_POST['artist_name'];
  $album_name = $_POST['album_name'];
  $genres = $_POST['genres'];
  $track_id= $_POST['track_id'];
  $track_id=$track_id+1;
  $query = "UPDATE tracks SET track_name = '$track_name' where trackid= '$track_id';";
  $result = mysqli_query ($con,$query);
  $query1= "SELECT albumid, generesid FROM tracks WHERE trackid='$track_id';";
  $res1=mysqli_query($con, $query1);
  $row1 = mysqli_fetch_array($res1);
  $album=$row1['albumid'];
  $genres=$row1['generesid'];
  $query2 = "UPDATE album SET album_name = '$album_name' where albumid = '$album';";
  $result2 = mysqli_query ($con,$query2);
  $query3 = "UPDATE generes SET genres = '$generes' where generesid = '$genres';";
  $result3 = mysqli_query ($con,$query3);
  $query1= "SELECT artistid FROM albums WHERE albumid='$album';";
  $res1=mysqli_query($con, $query1);
  $row1 = mysqli_fetch_array($res1);
  $artist = $row1['artistid'];
  $query3 = "UPDATE artist SET artist_name = '$artist_name' where artistid = '$artist';";
  $result3 = mysqli_query ($con,$query3);
 header('Location: admin_logged1.php');

?>