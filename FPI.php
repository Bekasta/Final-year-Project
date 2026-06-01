<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrandN";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data safely
$itemname = $_POST['itemname'] ?? null;

$price = $_POST['price'] ?? null;

$quantity = $_POST['quantity'] ?? null;
$expiry_date = $_POST['expiry_date'] ?? null;
$status = $_POST['status'] ?? null;
$category = $_POST['category'] ?? null;
$stock_location = $_POST['stock_location'] ?? null;
$description = $_POST['description'] ?? null;

// Handle photo upload
$photo = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

    $upload_dir = 'uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

    $file_type = $_FILES['photo']['type'];
    $file_size = $_FILES['photo']['size'];

    if (in_array($file_type, $allowed_types) && $file_size <= 2 * 1024 * 1024) {

        $photo_name = uniqid('photo_', true) . '.' .
        pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        $photo = $upload_dir . $photo_name;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
            die("Error: Failed to upload the photo.");
        }

    } else {
        die("Error: Invalid file type or size.");
    }
}

// Insert into database
$sql = "INSERT INTO itemdetails
(itemname, price, quantity, expiry_date, status,
category, stock_location, description, photo)

VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "sdissssss",

        $itemname,
        $price,
        $quantity,
        $expiry_date,
        $status,
        $category,
        $stock_location,
        $description,
        $photo
    );

   if (mysqli_stmt_execute($stmt)) {

    header("Location: FPL.php?success=1");
    exit();

} else {

        echo "Error executing query: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

} else {

    echo "Error preparing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>