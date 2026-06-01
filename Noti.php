<?php
require_once('Conn1.php');

// Define thresholds
$low_stock_limit = 20;
$expiry_warning_days = 30;

$today = date('Y-m-d');
$warning_date = date('Y-m-d', strtotime("+$expiry_warning_days days"));

// Query
$sql = "SELECT * FROM itemdetails 
        WHERE quantity <= $low_stock_limit
        OR expiry_date <= '$warning_date'
        ORDER BY expiry_date ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Brand Mart | Inventory Notifications</title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
    top: 0;
	right:0;
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
body {
    font-family: Arial, sans-serif;
    background-color:#e6e6e6;
    padding: 20px;
	margin-top:70px;
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
/* ROW HOVER */
tr:hover {
    background-color: #f5f5f5;
}

/* STATUS COLORS */
.expired {
    background-color: #ffcccc;
}

.warning {
    background-color: #fff3cd;
}

.low {
    background-color: #cce5ff;
}

/* IMAGE */
img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

/* TITLE */
h2 {
    text-align: center;
    margin-bottom: 20px;
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

<h2> Inventory Notifications</h2>

<table>
<tr>
    <th>ID</th>
    <th>Item Name</th>
    <th>Quantity</th>
    <th>Expiry Date</th>
    <th>Status</th>
    <th>Alert</th>
    <th>Photo</th>
</tr>

<?php
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $class = "";
        $alert = [];

        // Expiry check
        if (!empty($row['expiry_date'])) {
            if ($row['expiry_date'] < $today) {
                $class = "expired";
                $alert[] = "Expired";
            } elseif ($row['expiry_date'] <= $warning_date) {
                $class = "warning";
                $alert[] = "Expiring Soon";
            }
        }

        // Low stock
        if ($row['quantity'] <= $low_stock_limit) {
            $class = "low";
            $alert[] = "Low Stock";
        }

        echo "<tr class='$class'>";
        echo "<td>{$row['id']}</td>";
        echo "<td>" . htmlspecialchars($row['itemname']) . "</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['expiry_date']}</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . implode(", ", $alert) . "</td>";

        if (!empty($row['photo'])) {
            echo "<td><img src='{$row['photo']}'></td>";
        } else {
            echo "<td>No Image</td>";
        }

        echo "</tr>";
    }

} else {
    echo "<tr><td colspan='7'>No notifications</td></tr>";
}

$conn->close();
?>

</table>

</body>
</html>