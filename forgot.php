<!DOCTYPE html>
<html>
</head>
<style>
 body{ 
    background-attachment: fixed;
    display: flex;
    height: 100vh;
    background: linear-gradient(rgba(55, 198, 255, 0.9), rgba(185, 235, 255, 0.9), rgba(205, 240, 255, 0.8));
    background-repeat: no-repeat;
  }
  .container {
    position: absolute; 
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 600px;
    max-width: 1000px;
    padding: 20px;
    background-color: #f1f1f1;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
}
.logo {
  position: relative;
    top: -50px;
    left: 50%; 
    transform: translateX(-75%); 
    margin-top: 50px;
}

.Text {
  position: relative;
    top:-190px; 
    left: 50%; 
    transform: translateX(-55%); 
    margin-top: 30px;
}

.Text h1 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transform: translateX(10%);
    margin-top: 20px;
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
    transform: translateX(10%);
 
}
.goback-btn {
    position: absolute;
    top: 600px; 
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.goback-btn {
    position: absolute;
    top: 500px; 
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.goback-btn:hover {
    background-color: #0056b3;
}
  form {
            position: absolute;
            top: 250px; 
            left: 50%;
            transform: translateX(-50%); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3); 
        }
h2 {
            text-align: center;
            margin-top: -160px; 
            margin-bottom: 20px; 
        }

</style>
<body>
  <div class="container">
      <div class="logo">
        <img src="img/logoo.png">
      </div>  
      <div class="Text">
        <h1>Marinduque State College</h1>
        <h3>College of Information and Computing Sciences</h3>
     </div>
     <!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
<h2>Forgot Password</h2>
    <form action="forgot.php" method="POST">
        <label for="username">Enter Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Enter New Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Reset Password</button>
    </form>
    <?php
$servername = "localhost";
$username = "ayawkona@gmail.com"; 
$password = "gwenchana"; 
$database = "users"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from data
    $username = $_POST['username'];
    $new_password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($new_password)) {
        echo "Username and new password are required.";
        exit();
    }

    // Update user's password
    $sql = "UPDATE users SET password=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password, $username);
    if ($stmt->execute()) {
        echo "Password reset successfully.";
    } else {
        echo "Error resetting password: " . $conn->error;
    }


    $conn->close();
}
?>
    <a href="admindashboard.php" class="goback-btn">Go Back Home</a>
</body>
</html>
