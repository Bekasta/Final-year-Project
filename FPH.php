
<?php
session_start();
require_once('Conn1.php');

$sql = "SELECT * FROM itemdetails";
$result = $conn->query($sql);
// Total Items
$totalItemsQuery = $conn->query("SELECT COUNT(*) AS total FROM itemdetails");
$totalItems = $totalItemsQuery->fetch_assoc()['total'];

// Low Stock Notifications
$lowStockQuery = $conn->query("SELECT COUNT(*) AS total FROM itemdetails WHERE quantity <= 5");
$lowStock = $lowStockQuery->fetch_assoc()['total'];

// Expiring Notifications (within next 30 days)
$expiringQuery = $conn->query("
    SELECT COUNT(*) AS total
    FROM itemdetails
    WHERE expiry_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
");
$expiring = $expiringQuery->fetch_assoc()['total'];

$totalNotifications = $lowStock + $expiring;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Brand Mart | Home </title>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
	background-color:#e6e6e6;
    padding: 20px;
	margin-top:70px;
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
/* TABLE FIX */
table {
    width: 95%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
    border-radius: 15px;
    overflow: hidden;
}
/* HEADER */
th {
    background-color: #990000;
    color: white;
    padding: 12px;
    text-align: center;
}
/* CELLS */
td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ccc;
}
.filterDiv {
    display: none; /* Initially hide all items */
}
.btn.active {
    background-color: #666;
    color: white;
}
.logout-btn{
    margin-left: auto;
    background-color: #cc0000;
}
.heading-container{
    width:95%;
    margin:20px auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-boxes{
    display:flex;
    gap:15px;
}

.summary-box{
    background:white;
    padding:12px 20px;
    border-radius:10px;
    box-shadow:0 2px 5px rgba(0,0,0,0.2);
    text-align:center;
    min-width:140px;
}

.summary-box h4{
    margin:0;
    color:#990000;
    font-size:14px;
}

.summary-box p{
    margin-top:5px;
    font-size:24px;
    font-weight:bold;
}
</style>

</head>
<body>
<header>
    
    <nav class="nav1">
        <ul>
            <li><a href="FPH.php" target="_blank">Home</a></li>
            <li><a href="FPL.php" target="_blank">Add New Item</a></li>
            <li><a href="Noti.php" target="_blank">Notification</a></li>
            <li><a href="Rep.php" target="_blank">Report</a></li>
			<li class="logout-btn" ><a   href="Logout.php">Logout</a></li>
        </ul>
    </nav>
    
</header>
<div class="heading-container">

    <h2>Brand Mart Inventory Item List</h2>

    <div class="summary-boxes">

        <div class="summary-box">
            <h4>Total Items</h4>
            <p><?php echo $totalItems; ?></p>
        </div>

       <div class="summary-box">
            <h4>Total Notifications</h4>
            <p><?php echo $totalNotifications; ?></p>
        </div>

    </div>

</div>
<div class="main">
<table>
    <tr>
        <th>ID</th>
        <th>Item Name</th>
		<th>Price</th>
        <th>Quantity</th>
        <th>Expiry Date</th>
        <th>Status</th>
        <th>Category</th>
        <th>Stock Location</th>
        <th>Description</th>
        <th>Photo</th>
		<th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['itemname']) . "</td>";
		echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['expiry_date'] . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock_location']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";

        if (!empty($row['photo'])) {
            echo "<td><img src='" . $row['photo'] . "' width='80'></td>";
        } else {
            echo "<td>No Image</td>";
        }
        echo "<td>";
        echo "<a href='Upd.php?id=" . $row['id'] . "'>
        <button>Update</button>
        </a>";
          "</td>";
		  echo "<td>";
        if  (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo " <a href='Del.php?id=" . $row['id'] . "'
            onclick='return confirm(\"Delete this item?\")'>
            <button>Delete</button>
           </a>";
}

echo "</td>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}

$conn->close();
?>

</table>
</div>
</body>

<br>
<hr>



</html>