<?php
session_start();

require "model.php";
$db = new SimpleDB();

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ssn = $_POST['ssn'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM uw_employee WHERE Ssn = :ssn";
    $user = $db->query($sql, [':ssn' => $ssn]);

    if ($user) {
        $user = $user[0];
        $_SESSION['user'] = $user;

        if ($role === 'admin' && $user['Position_id'] == 1) {
            header("Location: Administration.php");
            exit();
        } elseif ($role === 'manager' && $user['Position_id'] == 2) {
            header("Location: Manager.php");
            exit();
        } elseif ($role === 'employee') {
            header("Location: Employee.php");
            exit();
        } else {
            $error = "Access denied";
        }
    } else {
        $error = "Invalid SSN";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Login</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <label for="ssn">SSN:</label>
        <input type="text" name="ssn" id="ssn" required>
        
        <button type="submit" name="role" value="admin">Administration</button>
        <button type="submit" name="role" value="manager">Manager</button>
        <button type="submit" name="role" value="employee">Employee</button>
    </form>

    <br>

    <button onclick="window.location.href = 'about:blank';">Exit</button>
</body>
</html>
