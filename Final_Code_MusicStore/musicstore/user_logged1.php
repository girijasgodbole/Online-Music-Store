<?php
$con=mysqli_connect("localhost","root","root","musicstore",1433);
$query = "SELECT albums.album_name as Album_name, artist_name.name as Artist_name, artist.bio, artist.picture as Artist_Picture, albums.picture as Album_Picture from albums, artist where albums.artistid=artist.artistid;";
$result = mysqli_query ($con,$query);
$result_array=array();
$i=0;
while($row = mysqli_fetch_array($result)){
  $result_array[$i]['Album_name']=$row['Album_name'];
  $result_array[$i]['Artist_name']=$row['Artist_name'];
  $result_array[$i]['bio']= $row['bio'];
  $result_array[$i]['Artist_Picture']= $row['Artist_Picture'];
  $result_array[$i]['Album_Picture']= $row['Album_Picture'];
  $i++;
}
?>

<!DOCTYPE html>
<html>
<title>
Music Store</title>
<head> 
   <meta charset="utf-8">
   <link href="home.css" type="text/css" rel="stylesheet" />

</head>

<body bgcolor="Violet">

<?php 
$j=0;
	for($j;$j<$i;$j++){
	  	$album_id=$j +1;
	  	$admin=0;
	?>
<div class="row">
	<form action="track.php" method="post">
	<div class="image">
	<?php echo '<img height="225px" width="250px" src="data:image/jpeg;base64,'.base64_encode( $result_array[$j]['Album_Picture'] ).'"/>'; ?> </div>
	<div class="title">
	<h3 style="color:red;">Album: <?php echo $result_array[$j]['Album_name']; ?></h3>
	</div> 
	<div class="middle">
	<h3 style="color:green;">Singer: <?php echo $result_array[$j]['Artist_name']; ?></h3> 
	<h3 style="color:blue;">Bio: <?php echo $result_array[$j]['bio']; ?></h3></div>
	<div class="image_artist">
	<?php echo '<img height="100px" width="100px" src="data:image/jpeg;base64,'.base64_encode( $result_array[$j]['Artist_Picture'] ).'"/>'; ?> </div>
	<form action="track.php" method="post">
	<div class= "addToCart">
	<form action="checkout.php" method="post">
			<input hidden type="text" value="<?php echo $j+1; ?>" name="btnAddCart"  class="btn btn-primary">
			<input hidden type="text" value="btnAddCart" name="btnAddCart2"  class="btn btn-primary">
			   <button type="submit" id="" value=""  class="">Add To Cart</button>
  		</form> 
    <input hidden type=text name="album_id" value="<?php echo $album_id; ?>">
    <input hidden  type=text name="admin" value="<?php echo $admin; ?>">
    <input name="css_sub" type="submit" value="View Album">
	</div>
  </form>
	</form>
</div>
<?php 

	}
?>
<div class="pagination">
  <a href="#">&laquo;</a>
  <a href="#" class="active">1</a>
  <a href="#" >2</a>
  <a href="#">&raquo;</a>
</div>
</body>
</html>