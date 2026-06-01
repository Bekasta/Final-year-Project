<?php
 $servename="localhost";
 $username="root";
 $password="";
 $dbname="BrandN";
 //create connection
 $conn = mysqli_connect($servename,$username,$password,$dbname);
 //check connection
 if (!$conn) {
	 die ("connection failed:". mysqli_connect_error());
 } 
 ?>