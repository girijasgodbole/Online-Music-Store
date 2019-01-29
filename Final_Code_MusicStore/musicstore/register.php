<!DOCTYPE html>
<html>
<head>
<title>Register User</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script 
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
//DB Call to get data

</script>
<style type="text/css">
	.table-responsive tbody tr {
  cursor: pointer;
}
.table-responsive .table thead tr th {
  padding-top: 15px;
  padding-bottom: 15px;
}
.table-responsive .table tbody tr td {
  padding-top: 15px;
  padding-bottom: 10px;
}
</style>
     
</head>
<body style="background-color: whitesmoke">

<div id="divRegister" class="form-group col-sm-5" style="background-color: whitesmoke">
  <h3 class="head">Regsiter User</h3>
  <form action="srvregister.php" method="post">
    First Name: <input type="text" class="form-control" name="fname"><br>
    Last Name: <input type="text" class="form-control" name="lname"><br>
    E-mail: <input type="text" class="form-control" name="email"><br>
    Password: <input type="text" class="form-control" name="pwd"><br>
    IsAdmin(Yes / No): <input type="text" class="form-control" name="admin"><br>
    <input type="submit" id="btnRegister"  class="btn btn-primary">
  </form>

</div>
	
</body>
</html>