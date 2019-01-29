<?php
header('Location: admin_logged1.php');
session_start();
$track_name = $_SESSION['title'];
@ $db = new mysqli('localhost', 'root', 'root', 'musicstore', 1433);

if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
}

//$query = "DELETE from tracks WHERE track_name = ".$track_name."";
$query = "UPDATE tracks SET active = 0 WHERE track_name = '$track_name'";
if ($db->query($query) == TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}

$db->close();
header('Location: admin_logged.php');

?>