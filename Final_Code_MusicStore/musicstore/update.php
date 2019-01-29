<?php

@ $db = new mysqli('localhost', 'root', 'root', 'musicstore',1433);

if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
}



?>