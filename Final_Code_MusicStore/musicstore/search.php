<html>
<head>
  <title>track</title>
  <style>
	#image {
		padding: 2em;
	}
	#section {
		clear: right;
		
	}
	
</style>
</head>
<body>
<h1>Track Results</h1>
<?php
  // create short variable names
  $searchterm=trim($_POST['searchterm']);
  $searchtype=$_POST['searchtype'];
 

  if (!$searchtype || !$searchterm ) {
     echo 'You have not entered search details.  Please go back and try again.';
     exit;
  }

  if (!get_magic_quotes_gpc()){
    $searchterm = addslashes($searchterm);
	$searchtype = addslashes($searchtype);

  }

  @ $db = new mysqli('localhost', 'root', 'root', 'musicstore',1433);

  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }
	
		$query = "SELECT t.albumid as album_id, t.track_name, ar.artist_name, al.album_name, g.genres FROM tracks t JOIN albums al ON t.albumid = al.albumid JOIN artist ar ON al.artistid = ar.artistid JOIN genres g on t.genresid = g.genresid WHERE $searchtype like '%".$searchterm."%'";
		$result = $db->query($query);

		$num_results = $result->num_rows;

		for ($i=0; $i <$num_results; $i++) {
			$row = $result->fetch_assoc();
			$image = $row['track_name'];
			echo '<div id = "image"><img src="img/'.$image.'.jpg" width = "280" height = "180"></div>';
			echo "<p id = 'section'><strong>".($i+1).". Title Name: ";
			echo htmlspecialchars(stripslashes($row['track_name']));
			echo "</strong><br />Artist name: ";
			echo stripslashes($row['artist_name']);
			echo "<br />Album name: ";
			echo stripslashes($row['album_name']);
			echo "<br />Genres: ";
			echo stripslashes($row['genres']);
			echo "</strong><br />Albumid: ";
			echo stripslashes($row['album_id']);
			?><button>Add to cart</button><?php
			echo "</p>";
		}
	
    	
  

  $db->close();

?>

</body>
</html>