<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrandN";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Drop table
$drop = "DROP TABLE IF EXISTS itemdetails";
mysqli_query($conn, $drop);

// Create table
$create = "CREATE TABLE IF NOT EXISTS itemdetails (
  id INT NOT NULL AUTO_INCREMENT,
  itemname VARCHAR(60) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  quantity INT NOT NULL,
  status ENUM('Active','On Hold') NOT NULL,
  category ENUM('Sweets','Spices','Cosmetics','Snacks','Dairy Products','baby care') NOT NULL,
  stock_location ENUM('Lamberet','Mexico','Summit') NOT NULL,
  expiry_date DATE NOT NULL,
  description VARCHAR(100) NOT NULL,
  photo VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($conn, $create)) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>