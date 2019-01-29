<?php
session_start();
$con=mysqli_connect("localhost","root","root","musicstore",1433);
$query = "SELECT albums.name as Album_name, albums.albumid as Album_id, artist.name as Artist_name, artist.bio, artist.picture as Artist_Picture, albums.picture as Album_Picture from albums, artist where albums.artistid=artist.artistid;";
$result = mysqli_query ($con,$query);
$album_ids=array();
$result_array=array();
$i=0;
while($row = mysqli_fetch_array($result)){
  $result_array[$i]['Album_name']=$row['Album_name'];
  $result_array[$i]['Artist_name']=$row['Artist_name'];
  $result_array[$i]['bio']= $row['bio'];
  $result_array[$i]['Artist_Picture']= $row['Artist_Picture'];
  $result_array[$i]['Album_Picture']= $row['Album_Picture'];
  $result_array[$i]['Album_id']= $row['Album_id'];

  $i++;
}
?>

<!DOCTYPE html>
<html>
<style>
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
<title>
Music Store</title>
<head> 
   <meta charset="utf-8">
   <link href="home.css" type="text/css" rel="stylesheet" />
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</head>

<body bgcolor="Violet">
<?php 
$j=0;
  for($j;$j<$i;$j++){
      
  ?>
<div class="row">
  
  <div class="image">
  <?php echo '<img height="225px" width="250px" src="data:image/jpeg;base64,'.base64_encode( $result_array[$j]['Album_Picture'] ).'"/>'; ?> </div>
  <div class="title">
  <h3 style="color:red;">Album: <?php echo $result_array[$j]['Album_name']; echo $j ?> <button onclick="document.getElementById(<?php echo $j ?>).style.display='block'"> <img src="edit.png" height="20px" width="20px"> </button></h3>  
  </div> 

  
  <div class="middle">
  <h3 style="color:green;">Singer: <?php echo $result_array[$j]['Artist_name']; ?> </h3> 
  <h3 style="color:blue;">Bio: <?php echo $result_array[$j]['bio']; ?> </h3> </div> 
  <div class="image_artist">
  <?php echo '<img height="100px" width="100px" src="data:image/jpeg;base64,'.base64_encode( $result_array[$j]['Artist_Picture'] ).'"/>'; ?> </div>
  
  <div class= "addToCart">
  <button id ='addToCart'> Add to cart</button>
  <button id = 'viewAlbum'> View Album</button>
  </div>
</div>
<?php 

  }
  for($j=0;$j<$i;$j++){
  ?>
  <div id=<?php echo $j ?> class="modal">
  
  <form class="modal-content animate" action="edit_title.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById(<?php echo $j ?>).style.display='none'" class="close" title="Close Modal">&times;</span>
     
    </div>
    <?php $_SESSION['sess_albumid']= $j; ?>
    <div class="container">
     <b>Title</b> <br>
     
      <input type="text" placeholder=  "<?php echo $j ?> " name="title" required><br>
    

      
    </div>

  <input type="submit">
   
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<?php
}
?>
</body>
</html>