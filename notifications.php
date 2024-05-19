<?php
session_start();


$host = 'localhost';
$dbname = 'users'; 
$username_db = 'ayawkona@gmail.com'; 
$password_db = 'gwenchana';

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch notifications from  tables
    $notifications = [];

    $stmt = $pdo->query("SELECT * FROM comlab1 WHERE (status = 'On Going' OR status = 'Reserved') AND schedule_end_time < NOW()");
    $comlab1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($comlab1 as $item) {
        $start_time = date('h:i A', strtotime($item['schedule_start_time'])); // Adjust column name if necessary
        $end_time = date('h:i A', strtotime($item['schedule_end_time'])); // Adjust column name if necessary
        $message = $item['status'] == 'Cancelled' ? 
            " ComLab 1 reservation by {$item['username']} has been cancelled." : 
            " ComLab 1 is Reserved by {$item['username']} from {$start_time} to {$end_time}.";
        
   
        if ($item['status'] == 'On Going' && strtotime($item['schedule_end_time']) < time()) {
            $message = " ComLab 1 reservation by {$item['username']} has finished.";
        }

        $notifications[] = [
            'message' => $message,
            'user' => $item['username'],
            'schedule_start_time' => $start_time,
            'schedule_end_time' => $end_time,
            'created_at' => date('Y-m-d h:i A')
        ];
    }

  
    $stmt = $pdo->query("SELECT * FROM comlab2 WHERE (status = 'Reserved' OR status = 'Cancelled') AND schedule_end_time < NOW()");
    $comlab2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($comlab2 as $item) {
        $start_time = date('h:i A', strtotime($item['schedule_start_time']));
        $end_time = date('h:i A', strtotime($item['schedule_end_time']));
        $message = $item['status'] == 'Cancelled' ? 
            " ComLab 2 reservation by {$item['username']} has been cancelled." : 
            " ComLab 2 is Reserved by {$item['username']} from {$start_time} to {$end_time}.";

        if ($item['status'] == 'Reserved' && strtotime($item['schedule_end_time']) < time()) {
            $message = " ComLab 2 reservation by {$item['username']} has finished.";
        }

        $notifications[] = [
            'message' => $message,
            'user' => $item['username'],
            'schedule_start_time' => $start_time,
            'schedule_end_time' => $end_time,
            'created_at' => date('Y-m-d h:i A')
        ];
    }

    $stmt = $pdo->query("SELECT * FROM comlab3 WHERE (status = 'Reserved' OR status = 'Cancelled') AND schedule_end_time < NOW()");
    $comlab3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($comlab3 as $item) {
        $start_time = date('h:i A', strtotime($item['schedule_start_time']));
        $end_time = date('h:i A', strtotime($item['schedule_end_time']));
        $message = $item['status'] == 'Cancelled' ? 
            " ComLab 3 reservation by {$item['username']} has been cancelled." : 
            " ComLab 3 is Reserved by {$item['username']} from {$start_time} to {$end_time}.";

        if ($item['status'] == 'Reserved' && strtotime($item['schedule_end_time']) < time()) {
            $message = " ComLab 3 reservation by {$item['username']} has finished.";
        }

        $notifications[] = [
            'message' => $message,
            'user' => $item['username'],
            'schedule_start_time' => $start_time,
            'schedule_end_time' => $end_time,
            'created_at' => date('Y-m-d h:i A')
        ];
    }

    $stmt = $pdo->query("SELECT * FROM comlab4 WHERE (status = 'Reserved' OR status = 'Cancelled') AND schedule_end_time < NOW()");
    $comlab4 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($comlab4 as $item) {
        $start_time = date('h:i A', strtotime($item['schedule_start_time']));
        $end_time = date('h:i A', strtotime($item['schedule_end_time']));
        $message = $item['status'] == 'Cancelled' ? 
            " ComLab 4 reservation by {$item['username']} has been cancelled." : 
            " ComLab 4 is Reserved by {$item['username']} from {$start_time} to {$end_time}.";

        if ($item['status'] == 'Reserved' && strtotime($item['schedule_end_time']) < time()) {
            $message = " ComLab 4 reservation by {$item['username']} has finished.";
        }

        $notifications[] = [
            'message' => $message,
            'user' => $item['username'],
            'schedule_start_time' => $start_time,
            'schedule_end_time' => $end_time,
            'created_at' => date('Y-m-d h:i A')
        ];
    }

    $stmt = $pdo->query("SELECT * FROM comlab5 WHERE (status = 'Reserved' OR status = 'Cancelled') AND schedule_end_time < NOW()");
    $comlab5 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($comlab5 as $item) {
        $start_time = date('h:i A', strtotime($item['schedule_start_time']));
        $end_time = date('h:i A', strtotime($item['schedule_end_time']));
        $message = $item['status'] == 'Cancelled' ? 
            " ComLab 5 reservation by {$item['username']} has been cancelled." : 
            " ComLab 5 is Reserved by {$item['username']} from {$start_time} to {$end_time}.";

        if ($item['status'] == 'Reserved' && strtotime($item['schedule_end_time']) < time()) {
            $message = " ComLab 5 reservation by {$item['username']} has finished.";
        }

        $notifications[] = [
            'message' => $message,
            'user' => $item['username'],
            'schedule_start_time' => $start_time,
            'schedule_end_time' => $end_time,
            'created_at' => date('Y-m-d h:i A')
        ];
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computer Lab Notifications</title>
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
            max-width: 800px;
            height: 100%;
            margin: 40px auto;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            position: fixed;
            margin-top: auto;
            margin-bottom: auto;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .logo {
            position: absolute;
            top: 0px;
            left: 15%;
            transform: translateX(-50%);
            text-align: center;
        }

        .logo img {
            width: 90px;
            height: auto;
            margin-top: 40px;
        }

        .Text {
            text-align: center;
            margin-bottom: 20px;
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

        .notification-list {
            max-height: 500px; 
            overflow-y: auto; 
            margin-top: 20px;
            padding-right: 10px;
        }

        .notification-item {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            transition: box-shadow 0.3s ease;
        }

        .notification-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .notification-message {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .notification-user {
            font-size: 14px;
            color: #666;
        }

        .notification-time {
            font-size: 14px;
            color: #666;
        }

        .notification-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .notification-link:hover {
            text-decoration: underline;
        }

        .no-notifications {
            text-align: center;
            margin-top: 20px;
        }
        .notif{
          white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 10px 0 5px 0;
            font-family: Impact;
            font-size: 20px;
            font-weight: bold;
  }
  .goback-btn {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 725px;
  }
  .goback-btn:hover {
    background-color: #0056b3;
  }
    </style>
</head>
<body>
    <div class="container">
       <a href="page1.php" class="goback-btn">Go Back Home</a>
        <div class="logo">
            <img src="img/logoo.png" alt="Logo">
        </div>
        <div class="Text">
            <h1>Marinduque State College</h1>
            <h3>College of Information and Computing Sciences</h3>
        </div>
        <div class="notif">
          <h1>Notifications:</h1>
        </div>

        <div class="notification-list">
            <?php if (empty($notifications)) : ?>
                <div class="no-notifications">No notifications found.</div>
            <?php else : ?>
                <?php foreach ($notifications as $notification) : ?>
                    <div class="notification-item">
                        <div class="notification-message"><?php echo $notification['message']; ?></div>
                        <?php if (!empty($notification['user'])) : ?>
                            <div class="notification-user">User: <?php echo $notification['user']; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($notification['schedule_start_time']) && !empty($notification['schedule_end_time'])) : ?>
                            <div class="notification-time">Time: <?php echo $notification['schedule_start_time']; ?> - <?php echo $notification['schedule_end_time']; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>
</html>
