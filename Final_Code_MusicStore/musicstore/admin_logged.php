<?php
session_start();
?>
<!DOCTYPE html>
<html>
<title>
Music Store</title>
<head>
    <link href="home.css" type="text/css" rel="stylesheet" />
  
   <meta charset="utf-8">
   <link href="home.css" type="text/css" rel="stylesheet" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$.ajax({url: "admin_logged1.php", success: function(data){$(".main").html(data);}});
</script>
</head>
<body>
<div class="top">
<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="#products">Products</a>
  <a href="#newarrivals">New Arrivals</a>
  <a href="#categories">Categories</a>
 
  <img style="margin-left:10px;float:center; margin-top:10px;" src="search.png" height="25px" width="25px">
  <input style=" float:left;margin-top:10px; height:30px;" type="text" name="search" placeholder="Search..">  
  <img style="margin-left:10px;margin-right: 10px;float:center" src="cart.png" height="40px" width="40px">
   <img style="margin-right: 30px;" src="user.png" height="40px" width="40px">
  <a href="home.html"><button style="float:center;">Logout</button></a>

  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</div>
      
<div class="main" style="
    background-color: whitesmoke;
" >>
</div>

</body>
</html>