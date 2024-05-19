<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clickable Boxes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(55, 198, 255, 0.9), rgba(185, 235, 255, 0.9), rgba(205, 240, 255, 0.8));
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 430px;
            height: 100vh;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            text-align: center;
        }

        .logo img {
            width: 100px;
            height: auto;
            margin-top: 20px;
        }

        .Text h1 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 10px 0 5px 0;
            font-family: Impact;
            font-size: 29px;
            font-weight: bold;
        }

        .Text h3 {
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            font-family: Impact;
            font-size: 18px;
            margin: 0;
        }

        .rectangle {
            position: absolute;
            top: 300px;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            border: 1px solid black;
            height: 30px;
            margin: 10px auto;
            border-radius: 15px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            display: flex;
        }

        .rectangle a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px; 
            height: 30px;
            margin: 0 20px; 
        }

        .rectangle img {
            width: 100%;
            height: auto;
            margin: 10px;
        }

        .box, .box2, .box3, .box4, .box5 {
            width: 100px;
            height: 100px;
            border: 1px solid black;
            border-radius: 20px;
            margin: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            transition: background-color 0.3s;
            margin-top: 50px;
        }

        .box:hover, .box2:hover, .box3:hover, .box4:hover, .box5:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .box h3, .box2 h3, .box3 h3, .box4 h3, .box5 h3 {
            margin: 0;
        }

        .box a, .box2 a, .box3 a, .box4 a, .box5 a {
            text-decoration: none;
            color: #000;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
        }

        .Today h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
  
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="img/logoo.png" alt="Logo">
        </div>  
        <div class="Text">
            <h1>Marinduque State College</h1>
            <h3>College of Information and Computing Sciences</h3>
        </div>
        <div class="rectangle">
            <a href="page1.php">
                <img src="img/img1.png" alt="Image 1">
            </a>
            <a href="notifications.php">
                <img src="img/img3.png" alt="Image 3">
            </a>
        </div>

        <div class="Today">
            <h1>Choose Computer Lab:</h1>
        </div>

        <a href="comlab1.php" class="box-link">
            <div class="box">
                <h3>Comlab1</h3>
            </div>
        </a>

        <a href="comlab2.php" class="box2-link">
            <div class="box2">
                <h3>Comlab2</h3>
            </div>
        </a>

        <a href="comlab3.php" class="box3-link">
            <div class="box3">
                <h3>Comlab3</h3>
            </div>
        </a>

        <a href="comlab4.php" class="box4-link">
            <div class="box4">
                <h3>Comlab4</h3>
            </div>
        </a>

        <a href="comlab5.php" class="box5-link">
            <div class="box5">
                <h3>Comlab5</h3>
            </div>
        </a>
    </div>
   
</body>
</html>