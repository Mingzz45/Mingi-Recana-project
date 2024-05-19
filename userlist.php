<!DOCTYPE html>
<html>
</head>
<style>
  body{ 
            background-attachment: fixed;
            display: flex;
            height: 830px;
            background: linear-gradient(rgba(55, 198, 255, 0.9), rgba(185, 235, 255, 0.9), rgba(205, 240, 255, 0.8));
        }
        .container {
            position: relative; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 800px;
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
          .Intro h1 {
          font-size: 46px;
          margin-bottom: 20px;
          font-weight: bold;
          text-align: left;
          font-family: Impact;
           margin-top: 0;
          }

      .Text h3 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            font-family: Impact;
            font-size: 15px;
            transform: translateX(10%);
        }
        .userlist {
            list-style-type: none;
            padding: 10px;
            margin: 0;
            border: 2px solid #000; 
            border-radius: 5px;
        }
        .userlist li {
            margin-bottom: 10px;
        }
        .goback-btn {
    position: absolute;
    bottom: 20px; 
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

    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="img/logoo.png">
        </div>  
        <div class="Text">
            <h1>Marinduque State College</h1>
            <h3>College of Information and Computing Sciences</h3>
        </div>
        <div class="Intro">
        <h1>List Of Users:</h1>
    </div>
     <ul class="userlist">
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


$sql = "SELECT name, username FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<h2>User List</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Name: " . $row["name"]. " - Username: " . $row["username"]. "</li>";
    }
    echo "</ul>";
} else {
    echo "No users found.";
}

$conn->close();
?>
</ul>
    </div>
    <a href="admindashboard.php" class="goback-btn">Go Back Home</a>
</body>
</html>