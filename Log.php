<?php
session_start();
require_once("Conn1.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Redirect based on role
        if ($row['role'] == 'admin') {
            header("Location: FPH.php");
        } else {
            header("Location: FPH.php");
        }
        exit();

    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Brand Mart Login</title>

<style>
body {
    font-family: Arial;
    background: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-box {
    background: white;
    padding: 30px;
    width: 300px;
    border-radius: 10px;
    box-shadow: 0 0 10px gray;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

button {
    width: 100%;
    padding: 10px;
    background: #990000;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #cc0000;
}

.error {
    color: red;
    margin-bottom: 10px;
}
</style>

</head>

<body>

<div class="login-box">
    <h2>Brand Mart</h2>

    <?php if ($error) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>