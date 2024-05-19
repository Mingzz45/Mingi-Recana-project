<!DOCTYPE html>
<html>
</head>
<style>
   body{
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  justify-content: center;
  align-items: center;
  display: flex;
  height: 100vh;
  background: linear-gradient(rgba(55, 198, 255, 0.9), rgba(185, 235, 255, 0.9), rgba(205, 240, 255, 0.8));
  background-attachment: fixed;
  background-size: cover;
  background-repeat: no-repeat;
}
  .container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 650px;
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

.Welcome h1{
  position: relative;
    font-size: 56px;
    font-weight: bold;
    font-family: Impact;
    margin-top: -130px;
    text-align: center;
    letter-spacing: 2px;
}
.Paragraph p {
    position: relative;
    font-size: 20px; 
    margin-top: -10px; 
    text-align: center;
    letter-spacing: 2px;
    line-height: 30px; 
}

.Choices {
        display: flex;
        justify-content: center;
    }

    .Choices > div {
        margin: 0 70px; 
    }
.Choices .forgot a {
    margin-top: 110px;
}

    .Choices a {
        display: block;
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
      <div class="Welcome">
        <h1>Welcome to the Admin Portal of the <br>Comlab Scheduling Website!</h1>
      </div>
     <div class="Paragraph">
        <p>As the designated administrator, it is my responsibility to ensure seamless functionality and user accessibility within our platform. Here, I oversee the creation and management of email accounts, as well as assist in resolving any forgotten password issues for our valued teachers.</p>
        </div>
        <div class="Choices">
    <div>
        <a href="create.php"><h3>Create a new Account</h3></a>
    </div>
    <div class="forgot">
        <a href="forgot.php"><h3>Forgot Password</h3></a>
    </div>
    <div>
        <a href="userlist.php"><h3>View List of Users</h3></a>
    </div>
  
</div>

</body>
</html>