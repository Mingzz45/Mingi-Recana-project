<!DOCTYPE html>
<html>
<head>
<style>
  body { 
    background-attachment: fixed;
    display: flex;
    height: 100vh;
    background: linear-gradient(rgba(55, 198, 255, 0.9), rgba(185, 235, 255, 0.9), rgba(205, 240, 255, 0.8));
    background-repeat: no-repeat;
    justify-content: center;
    align-items: center;
    margin: 0;
  }

  .container {
    width: 100%;
    max-width: 600px;
    padding: 50px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
    text-align: center;
    height: 75%;
  }

  .logo {
    margin-top: -40px; 
  }

  .Text {
    margin-top: 20px;
  }

  .Text h1 {
    font-family: Impact;
    font-size: 32px;
    font-weight: bold;
    margin: 0;
  }

  .Text h3 {
    font-family: Impact;
    font-size: 20px;
    margin: 10px 0;
  }

  .goback-btn {
    position: absolute;
    bottom: 90px; 
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 1000px;
  }
  .goback-btn:hover {
    background-color: #0056b3;
  }

  form {
    margin-top: 20px;
    text-align: left;
  }

  form label {
    display: block;
    margin: 10px 0 5px;
  }

  form input[type="text"],
  form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  form input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  form input[type="submit"]:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>

<?php
$servername = "localhost";
$username = "ayawkona@gmail.com"; 
$password = "gwenchana"; 
$database = "users"; 

// Create the connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process  the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($name) || empty($username) || empty($password)) {
        echo "<p style='color: red;'>Name, username, and password are required.</p>";
    } else {
        // Insert user into database
        $sql = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $username, $password);
        if ($stmt->execute()) {
            echo "<p style='color: green;'>User created successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error creating user: " . $conn->error . "</p>";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<div class="container">
  <div class="logo">
    <img src="img/logoo.png" alt="Logo">
  </div>  
  <div class="Text">
    <h1>Marinduque State College</h1>
    <h3>College of Information and Computing Sciences</h3>
  </div>
  <h2>User Registration</h2>
  <form action="" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <input type="submit" value="Register">
  </form>
  <a href="admindashboard.php" class="goback-btn">Go Back Home</a>
</div>
</body>
</html>
