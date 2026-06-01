<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrandN";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* CREATE USERS TABLE WITH ROLE */
$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user'
)";

if (mysqli_query($conn, $createTable)) {
    echo "Users table created successfully.<br>";
} else {
    die("Error creating table: " . mysqli_error($conn));
}

/* INSERT ADMIN USER */
$admin = "
INSERT IGNORE INTO users (username, password, role)
VALUES ('admin', MD5('1234'), 'admin')
";

mysqli_query($conn, $admin);


/* INSERT NORMAL USER */
$user = "
INSERT IGNORE INTO users (username, password, role)
VALUES ('staff', MD5('1234'), 'user')
";

mysqli_query($conn, $user);

echo "Users added successfully.";

mysqli_close($conn);
?>