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
	/* Full-width input fields */

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
	
</style>
<meta charset="utf-8">
   <link href="home.css" type="text/css" rel="stylesheet" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
$(document).ready(function() {
$(document).on('click','#btndelete', function(e){
		 var id = $(this).attr("id");
    	 
    	 var poststr="request="+id;
		$.ajax({
			url : "delete.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				//$("#divPur").html(result);
				//document.getElementById("divBilling").innerHTML = result;
			}
		});

    // Let's test it out
});
});  
   
</script>
<script type="text/javascript">
$.ajax({url: "admin_logged1.php", success: function(data){$(".main").html(data);}});
</script>
</head>
<body>
<a href="home.html">LOGOUT</a>
<h1>Track Results</h1>
<?php
   session_start();
  // create short variable names
  $searchterm=$_POST['album_id'];
  $admin = $_POST['admin'];
  @ $db = new mysqli('localhost', 'root', 'root', 'musicstore',1433);

	
	if($admin == "0"){

		$query = "SELECT t.track_name as track_name, ar.artist_name as artist_name, al.album_name as al_name, g.genres FROM tracks t JOIN albums al ON t.albumid = al.albumid JOIN artist ar ON al.artistid = ar.artistid JOIN genres g on t.genresid = g.genresid WHERE t.active = 1 AND t.albumid =$searchterm";
		$result = $db->query($query);
		$result_array=array();
		$num_results = $result->num_rows;

		for ($i=0; $i <$num_results; $i++) {
			$row = $result->fetch_assoc();
			$image = $row['track_name'];
			//echo '<div id = "image"><img src="img/'.$image.'.jpg" width = "280" height = "180"></div>';
			$result_array[$i]['track_name'] = $row['track_name'];
			$result_array[$i]['artist_name'] = $row['artist_name'];
			$result_array[$i]['album_name'] = $row['album_name'];
			$result_array[$i]['genres'] = $row['genres'];
		}
	}
	else if($admin == "1"){
	
		$query = "SELECT t.track_name as track_name, ar.artist_name as artist_name, al.album_name as al_name, g.genres FROM tracks t JOIN albums al ON t.albumid = al.albumid JOIN artist ar ON al.artistid = ar.artistid JOIN genres g on t.genresid = g.genresid WHERE t.active = 1 AND t.albumid =$searchterm";
		//$query = "SELECT * FROM tracks t";
		$result = $db->query($query);

		$num_results = $result->num_rows;

		for ($i=0; $i <$num_results; $i++) {
			$row = $result->fetch_assoc();
			$image = $row['track_name'];
			//echo '<div id = "image"><img src="img/'.$image.'.jpg" width = "280" height = "180"></div>';
			$result_array[$i]['track_name'] = $row['track_name'];
			$result_array[$i]['artist_name'] = $row['artist_name'];
			$result_array[$i]['album_name'] = $row['al_name'];
			$result_array[$i]['genres'] = $row['genres'];
			
			$title = $row['track_name'];
			$_SESSION['title'] = $title;
			$_SESSION['album_id'] = $searchterm;
			$_SESSION['admin'] = $admin;
			
			
		}
	}
    $j=0;
	?>
	
	<br />
	<?php
	for($j;$j<$i;$j++){
	  	$album_id=$j + 1;
		$admin=1;
?>		
		<div class="row">
			
			<div class="title">
				<h3 style="color:red;">Track: <?php echo $result_array[$j]['track_name']; ?> </h3> <button onclick="document.getElementById(<?php echo $j; ?>).style.display='block'"> <img src="edit.png" height="20px" width="20px"> </button></h3>   
			</div> 
			<div class="middle">
				<h3 style="color:green;">Artist name: <?php echo $result_array[$j]['artist_name']; ?></h3> 
				<h3 style="color:blue;">Album name: <?php echo $result_array[$j]['album_name']; ?> </h3>
				<h3 style="color:blue;">Genre: <?php echo $result_array[$j]['genres']; ?> </h3>
			</div> 
			
		</div>
		<div class="delete">
				
			<input type = "submit" name = "delete" value = "delete" id="btndelete">
		</div>
		<?php 

	}
  for($j=0;$j<$i;$j++){
  ?>
   
  <div id=<?php echo $j; ?> class="modal">
  
  <form class="modal-content animate" action="edit_track.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById(<?php echo $j; ?>).style.display='none'" class="close" title="Close Modal">&times;</span>
     
    </div>

    <div class="container">
     <b>Track Name</b> <br>
     <input hidden type="text" name="track_id" value="<?php echo $j; ?>">
      <input type="text" value=  "<?php echo $result_array[$j]['track_name']; ?>" name="track_name"><br>    
    </div>
 <div class="container">
     <b>Artist name</b> <br>
     <input hidden type="text" name="track_id" value="<?php echo $j; ?>">
      <input type="text" value=  "<?php echo $result_array[$j]['artist_name']; ?>" name="artist_name"><br>   
    </div>
     <div class="container">
     <b>Album name</b> <br>
     <input hidden type="text" name="track_id" value="<?php echo $j; ?>">
      <input type="text" value=  "<?php echo $result_array[$j]['album_name']; ?>" name="album_name"><br>   
    </div>
	<div class="container">
     <b>Genres</b> <br>
     <input hidden type="text" name="track_id" value="<?php echo $j; ?>">
      <input type="text" value=  "<?php echo $result_array[$j]['genres']; ?>" name="genres"><br>   
    </div>
  <input type="submit" value="Submit Changes" name = "edit">
  </form>
</div>
<?php
	}
  $db->close();

?>

</body>
</html>