<?php
session_start();

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $_SESSION['username'] = $username; 
        header('Location: page1.php');
        exit();
    } else {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: index.php');
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
    width: 90%;
    width: 430px;
    height: 100vh;
    margin:0 auto;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
    top: 2%;
    box-sizing: border-box;
}
.logo {
    position: absolute;
    top: 0;
    left: 3%;
    transform: translateX(-200%);
    margin-top: 30px;
    transform: scale(.8);
}
.login-form {

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 40px;
}

.Intro h1 {
    font-size: 46px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: left;
    font-family: Impact;
    margin-top: 180px;
    margin-left: 20px;
}


.Intro p {
    text-indent: 40px;
    width: 90%;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 40px;
}

button[type="submit"] {
    display: block;
    margin: 0 auto;
}

.Text {
    position: absolute;
    top: 0;
    left: 42%;
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
    font-size: 29px;
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
    font-size: 18px;
}
.forgot p{
    font-size: 10px;
    text-align: center;
    margin-top: 50px;
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
        <h1>Hi! <br> Welcome</h1>
        <p>Explore our comprehensive webpage designed to streamline the process of checking 
            computer lab availability and booking your preferred time slots, ensuring a 
            hassle-free experience for all users.</p>
    </div>
    
    <form method="POST" action="index.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    <div class="logo">
        <img src="img/logoo.png">
    </div>
    <div class="forgot">
    <p>Don't have an account or forgot password? Contact the technical Staff to create account</p>
    </div>
</div>
</body>
</html>