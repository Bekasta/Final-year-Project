<?php
session_start();

if($_SESSION['role'] != 'admin'){
    die("Access Denied");
}
require_once('Conn1.php');

$id = $_GET['id'];

$sql = "DELETE FROM itemdetails WHERE id='$id'";

if(mysqli_query($conn, $sql)){
    header("Location: FPH.php");
    exit();
} else {
    echo "Error deleting item.";
}

mysqli_close($conn);
?>