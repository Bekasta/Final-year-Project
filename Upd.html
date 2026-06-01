<?php
require_once('Conn1.php');

/* GET ITEM ID */
$id = $_GET['id'];

/* FETCH EXISTING DATA */
$sql = "SELECT * FROM itemdetails WHERE id='$id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

/* UPDATE ITEM */
if(isset($_POST['update'])){

    $itemname = $_POST['itemname'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $stock_location = $_POST['stock_location'];
    $expiry_date = $_POST['expiry_date'];
    $description = $_POST['description'];

    /* PHOTO UPDATE */
    if(!empty($_FILES['photo']['name'])){

        $photo = "uploads/" . basename($_FILES['photo']['name']);

        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);

        $update = "UPDATE itemdetails SET
        itemname='$itemname',
        price='$price',
        quantity='$quantity',
        status='$status',
        category='$category',
        stock_location='$stock_location',
        expiry_date='$expiry_date',
        description='$description',
        photo='$photo'
        WHERE id='$id'";

    } else {

        $update = "UPDATE itemdetails SET
        itemname='$itemname',
        price='$price',
        quantity='$quantity',
        status='$status',
        category='$category',
        stock_location='$stock_location',
        expiry_date='$expiry_date',
        description='$description'
        WHERE id='$id'";
    }

    if(mysqli_query($conn, $update)){
        header("Location: FPH.php");
        exit();
    } else {
        echo "Error Updating Item";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<Title>Brand Mart | Update Item</Title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}     

body {
    font-family: Arial, sans-serif;          
}

header {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
    background-color: #990000;
    border-bottom: 1px solid #ccc;
    width: 100%;
	right:0;
    top: 0;
    position: fixed;
}

.nav1 ul {
    list-style-type: none;
    display: flex;
    padding: 10px;
}

.nav1 ul li {
    margin-right: 20px;
    border: 5px solid;
    border-radius: 20px;
    gap: 5px;
    padding: 10px;
    background-color: black;
}

.nav1 ul li a {
    text-decoration: none;
    color: white;
}

#form {
margin-top:100px;
margin-left:15px;		 
}

.form-section {
    margin-bottom: 20px;
}

.form-section h3 {
    margin-bottom: 10px;
}

.form-group {
    display: flex;
    flex-wrap:wrap;
    gap: 15px;
}

.form-group label {
    flex:25%;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>

</head>

<body>

<header>

<nav class="nav1">
<ul>
    <li><a href="FPH.php">Home</a></li>
    <li><a href="FPL.html">Add New Item</a></li>
    <li><a href="Noti.php">Notification</a></li>
    <li><a href="Rep.php">Report</a></li>
    <li><a href="Upd.html">Update</a></li>
    <li class="logout-btn"><a href="Logout.php">Logout</a></li>
</ul>
</nav>

</header>

<form id="form" method="post" enctype="multipart/form-data">

<h1 align="center"><u> Update Item </u></h1>

<div class="form-section">

<div class="form-group">

<label for="itemname">
Item Name
<input type="text"
name="itemname"
value="<?php echo $row['itemname']; ?>"
required>
</label>

<label for="quantity">
Quantity
<input type="number"
name="quantity"
value="<?php echo $row['quantity']; ?>">
</label>

<label for="status">
Status
<select name="status">

<option <?php if($row['status']=="Active") echo "selected"; ?>>
Active
</option>

<option <?php if($row['status']=="On Hold") echo "selected"; ?>>
On Hold
</option>

</select>
</label>

</div>
</div>

<div class="form-section">

<div class="form-group">

<label for="category">
Category
<select name="category">

<option <?php if($row['category']=="Sweets") echo "selected"; ?>>
Sweets
</option>

<option <?php if($row['category']=="Spices") echo "selected"; ?>>
Spices
</option>

</select>
</label>

<label for="stock_location">
Stock Location
<select name="stock_location">

<option <?php if($row['stock_location']=="Lamberet") echo "selected"; ?>>
Lamberet
</option>

<option <?php if($row['stock_location']=="Mexico") echo "selected"; ?>>
Mexico
</option>

</select>
</label>

<label for="expiry_date">
Expiry Date
<input type="date"
name="expiry_date"
value="<?php echo $row['expiry_date']; ?>">
</label>

<label for="price">
Price
<input type="number"
name="price"
value="<?php echo $row['price']; ?>">
</label>

<label for="description">
Description
<input type="text"
name="description"
value="<?php echo $row['description']; ?>">
</label>

</div>
</div>

<br>

<div class="form-section">
<div class="form-group">

Photo<br>

<input type="file" name="photo">

<br><br>

<button type="submit" name="update">
Update Item
</button>

<button type="reset">
Reset
</button>

</div>
</div>

</form>

</body>
</html>