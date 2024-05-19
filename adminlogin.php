<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "ayawkona@gmail.com"; 
$password = "gwenchana"; 
$database = "users"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL check admin credentials 
    $sql = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin authenticated, redirect to dashboard
        $_SESSION['username'] = $username;
        header('Location: admindashboard.php');
        exit();
    } else {
        $_SESSION['status'] = "Username or password is incorrect";
        header('Location: adminlogin.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <?php

$bg_image_path = "img/bgg.jpg"; 
?>
<style>
body {
    background-image: url('<?php echo $bg_image_path; ?>');
    background-color: rgba(255, 255, 255, 0.5);
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.container {
    position: relative;
    width: 300px;
    height: 300px;
    margin:20px;
    padding: 200px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
    top: 2%;
    
}

.logo {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-200%);
    margin-top: 30px;
}

.login-form {
    margin-top: 40px;
}

.Intro h1 {
    font-size: 46px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: left;
    font-family: Impact;
    margin-top: 10px;
}

.Intro p {
    text-indent: 40px;
    width: 110%;
    text-align: justify;
}

.form {
    text-align: center;
}

button[type="submit"] {
    display: block;
    margin: 0 auto;
}

.Text {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-25%);
    margin-top: 30px;
}

.Text h1 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
    margin-top: 10px;
    font-family: Impact;
    font-size: 32px;
    font-weight: bold;
}

.Text h3 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
    font-family: Impact;
    font-size: 20px;
}

</style>
</head>
<body>
        <div class="container">
    <div class="Text">
        <h1>Marinduque State College</h1>
        <h3>College of Information and Computing Sciences</h3>
    </div>
    <div class="Intro">
        <h1>Admin Login</h1>
    </div>
    
    <form action="adminlogin.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    <div class="logo">
        <img src="img/logoo.png">
    </div>
</div>
</body>
</html>