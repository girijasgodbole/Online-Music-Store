<html>
<head>
  <title>Inserted Item</title>
</head>
<body>
<h1>Item inserted type</h1>
<?php
  // create short variable names
  $itemid=$_POST['itemid'];
  $type=$_POST['type'];
  $album_name=$_POST['album_name'];
  $price=$_POST['price'];
  $active =$_POST['active'];
  $genres =$_POST['genres'];
  $artist_name =$_POST['artist_name'];
  $track_name=$_POST['track_name'];
  
  @ $db = new mysqli('localhost', 'root', 'root', 'musicstore',1433);

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  $query = "insert into item values
            ('".$itemid."', '".$type."')";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." item inserted into database.";
  } else {
  	  echo "An error has occurred.  The item was not added.";
  }
  
  $query1 = "SELECT MAX(itemid) as itemid, type FROM item";
  $result = $db->query($query1);
  
  /*$num_results = $result->num_rows;

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". itemid: ";
     echo htmlspecialchars(stripslashes($row['itemid']));
     echo "</strong><br />type: ";
     echo stripslashes($row['type']);
     echo "</p>";
  }*/
  $query = "insert into albums values
            ('','1','".$album_name."','".$price."','','','1')";
  $result = $db->query($query);
  

  $db->close();
  header('Location: admin_logged.php');
?>

</body>
</html>
