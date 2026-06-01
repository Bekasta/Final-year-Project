<?php
session_start();
require_once("Conn1.php");

/* TOTAL ITEMS */
$totalItemsQuery = "SELECT COUNT(*) AS total_items FROM itemdetails";
$totalItemsResult = mysqli_query($conn, $totalItemsQuery);
$totalItems = mysqli_fetch_assoc($totalItemsResult)['total_items'];

/* TOTAL INVENTORY VALUE */
$totalValueQuery = "
SELECT COALESCE(SUM(price * quantity), 0) AS total_value
FROM itemdetails
";

$totalValueResult = mysqli_query($conn, $totalValueQuery);
$totalValue = mysqli_fetch_assoc($totalValueResult)['total_value'] ?? 0;

/* THIS MONTH TOTAL */
$thisMonthQuery = "
SELECT COALESCE(SUM(price * quantity), 0) AS this_month_total
FROM itemdetails
WHERE MONTH(expiry_date) = MONTH(CURRENT_DATE())
AND YEAR(expiry_date) = YEAR(CURRENT_DATE())
";

$thisMonthResult = mysqli_query($conn, $thisMonthQuery);

if($thisMonthResult){
    $thisMonthTotal = mysqli_fetch_assoc($thisMonthResult)['this_month_total'] ?? 0;
} else {
    $thisMonthTotal = 0;
}


/* LAST MONTH TOTAL */
$lastMonthQuery = "
SELECT COALESCE(SUM(price * quantity), 0) AS last_month_total
FROM itemdetails
WHERE MONTH(expiry_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
AND YEAR(expiry_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
";

$lastMonthResult = mysqli_query($conn, $lastMonthQuery);

if($lastMonthResult){
    $lastMonthTotal = mysqli_fetch_assoc($lastMonthResult)['last_month_total'] ?? 0;
} else {
    $lastMonthTotal = 0;
}


/* DIFFERENCE */
$difference = $thisMonthTotal - $lastMonthTotal;
?>

<!DOCTYPE html>
<html>
<head>
<title>Brand Mart | Report</title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body{
    font-family: Arial, sans-serif;
    background-color:#e6e6e6;
    padding:20px;
    margin-top:70px;
}

/* HEADER */
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

/* NAVIGATION */
.nav1 ul {
    list-style-type: none;
    display: flex;
    padding: 10px;
}

.nav1 ul li {
    margin-right: 20px;
    border: 5px solid black;
    border-radius: 20px;
    gap: 5px;
    padding: 10px;
    background-color: black;
}

.nav1 ul li a {
    text-decoration: none;
    color: white;
}

/* LOGOUT BUTTON */
.logout-btn{
    margin-left:auto;
    background-color:#cc0000;
}

/* MAIN CONTAINER */
.main{
    margin-top:40px;
}

/* REPORT BOX */
.report-box{
    background:white;
    width:80%;
    margin:auto;
    border-radius:15px;
    padding:30px;
    box-shadow:0 0 10px gray;
}

/* TITLE */
h1{
    text-align:center;
    margin-bottom:30px;
    color:#990000;
}

/* REPORT ITEMS */
.report-item{
    margin:20px 0;
    padding:20px;
    background:#f9f9f9;
    border-left:5px solid #990000;
    font-size:20px;
    border-radius:10px;
}

/* POSITIVE VALUE */
.positive{
    color:green;
}

/* NEGATIVE VALUE */
.negative{
    color:red;
}

</style>

</head>

<body>

<header>

<nav class="nav1">
<ul>
    <li><a href="FPH.php">Home</a></li>
    <li><a href="FPL.php">Add New Item</a></li>
    <li><a href="Noti.php">Notification</a></li>
    <li><a href="Rep.php">Report</a></li>

    <li class="logout-btn">
        <a href="Logout.php">Logout</a>
    </li>
</ul>
</nav>

</header>

<div class="main">

<div class="report-box">

<h1>Brand Mart Inventory Report</h1>

<div class="report-item">
    Total Items:
    <b><?php echo $totalItems; ?></b>
</div>

<div class="report-item">
    Total Inventory Value:
    <b>$<?php echo number_format($totalValue, 2); ?></b>
</div>

<div class="report-item">
    This Month Total:
    <b>$<?php echo number_format($thisMonthTotal, 2); ?></b>
</div>

<div class="report-item">
    Last Month Total:
    <b>$<?php echo number_format($lastMonthTotal, 2); ?></b>
</div>

<div class="report-item">
    Difference:

    <b class="<?php echo ($difference >= 0) ? 'positive' : 'negative'; ?>">
        $<?php echo number_format($difference, 2); ?>
    </b>
</div>

</div>

</div>

</body>
</html>