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

    // Validate and process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['cancel'])) {
            $id = sanitizeInput($_POST['id']);
            if (cancelSchedule($pdo, $id)) {
                $_SESSION["success"] = "Schedule cancelled successfully.";
            } else {
                $_SESSION["error"] = "Failed to cancel the schedule.";
            }
        } else {
            $username = sanitizeInput($_POST["username"]);
            $startTime = sanitizeInput($_POST["schedule_start_time"]);
            $endTime = sanitizeInput($_POST["schedule_end_time"]);
            $status = sanitizeInput($_POST["status"]);

            // Convert the time to 24-hour format 
            $startTime = date("H:i:s", strtotime($startTime));
            $endTime = date("H:i:s", strtotime($endTime));

            if (validateUser($pdo, $username)) {
                if (!checkScheduleConflict($pdo, $startTime, $endTime)) {
                    addSchedule($pdo, $startTime, $endTime, $username, $status);
                    $_SESSION["success"] = "Schedule added successfully.";
                } else {
                    $_SESSION["error"] = "Lab is already reserved during this time period.";
                }
            } else {
                $_SESSION["error"] = "Username not found.";
            }
        }

        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }

    updateOngoingSchedules($pdo);
    $schedules = fetchAllSchedules($pdo);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

function sanitizeInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function validateUser($pdo, $username) {
    $stmt = $pdo->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->rowCount() > 0;
}

function checkScheduleConflict($pdo, $startTime, $endTime) {
    $stmt = $pdo->prepare("SELECT * FROM comlab3 WHERE (
        (schedule_start_time < ? AND schedule_end_time > ?) OR
        (schedule_start_time >= ? AND schedule_start_time < ?) OR
        (schedule_end_time > ? AND schedule_end_time <= ?)
    ) AND status != 'Cancelled'");
    $stmt->execute([$endTime, $startTime, $startTime, $endTime, $startTime, $endTime]);
    $rowCount = $stmt->rowCount();
    return $rowCount > 1;
}

function addSchedule($pdo, $startTime, $endTime, $username, $status) {
    $stmt = $pdo->prepare("INSERT INTO comlab5 (schedule_start_time, schedule_end_time, username, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$startTime, $endTime, $username, $status]);
}

function cancelSchedule($pdo, $id) {
    $stmt = $pdo->prepare("UPDATE comlab5 SET status = 'Cancelled' WHERE id = ?");
    return $stmt->execute([$id]);
}

function updateOngoingSchedules($pdo) {
    $stmt = $pdo->prepare("UPDATE comlab5 SET status = 'On Going' WHERE schedule_start_time <= NOW() AND schedule_end_time >= NOW() AND status != 'On Going'");
    $stmt->execute();
}

function fetchAllSchedules($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM comlab5");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ComputerLab5</title>
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
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; 
            margin-top: 20%;
        }

        .logo {
            position: absolute;
            top: -10px;
            left: 10%;
            transform: translateX(-50%);
            text-align: center;
        }

        .logo img {
            width: 70px;
            height: auto;
            margin-top: 20px;
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

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="time"],
        select,
        input[type="submit"] {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .vacant {
            background-color: green;
            color: white;
        }

        .reserved {
            background-color: yellow;
            color: black;
        }

        .on-going {
            background-color: red;
            color: white;
        }

        .cancelled {
            background-color: grey;
            color: white;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            color: green;
            margin-top: 10px;
        }
        .on-going {
    background-color: red;
    color: white;
}

.reserved {
    background-color: yellow;
    color: black;
}

.cancelled {
    background-color: grey;
    color: white;
}
.goback-btn {
    position: absolute;
    bottom: -3px; 
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
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="schedule_start_time">Start Time:</label>
            <input type="time" id="schedule_start_time" name="schedule_start_time" required>

            <label for="schedule_end_time">End Time:</label>
            <input type="time" id="schedule_end_time" name="schedule_end_time" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Reserved">Reserved</option>
                <option value="On Going">On Going</option>
            </select>

            <input type="submit" name="submit" value="Set Schedule">
        </form>

        <?php if (isset($_SESSION["error"])) : ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])) : ?>
            <div class="success"><?php echo $_SESSION["success"]; ?></div>
            <?php unset($_SESSION["success"]); ?>
        <?php endif; ?>

        <table>
            <tr>
                <th>Username</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($schedules as $schedule) : ?>
    <tr>
        <td><?php echo htmlspecialchars($schedule['username']); ?></td>
        <td><?php echo date("g:i A", strtotime(htmlspecialchars($schedule['schedule_start_time']))); ?></td>
        <td><?php echo date("g:i A", strtotime(htmlspecialchars($schedule['schedule_end_time']))); ?></td>
        <td class="<?php echo getStatusClass($schedule['status']); ?>">
            <?php echo htmlspecialchars($schedule['status']); ?>
        </td>
        <td>
            <?php if ($schedule['status'] != 'Cancelled') : ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id" value="<?php echo $schedule['id']; ?>">
                    <input type="submit" name="cancel" value="Cancel">
                </form>
            <?php else : ?>
                <button disabled>Cancelled</button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>

<?php
function getStatusClass($status) {
    switch ($status) {
        case 'On Going':
            return 'on-going';
        case 'Reserved':
            return 'reserved';
        case 'Cancelled':
            return 'cancelled';
        default:
            return '';
    }
}
?>
        </table>
        <a href="page1.php" class="goback-btn">Go Back Home</a>
    </div>
</body>
</html>