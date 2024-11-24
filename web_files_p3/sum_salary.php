<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$query = "SELECT SUM(Salary) AS total_salary FROM uw_employee";
$result = $db->query($query);
$totalSalary = $result[0]['total_salary'] ?? 0; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Salary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        .summary-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .summary-container h1 {
            color: #333;
        }
        
    </style>
</head>
<body>
    <div class="summary-container">
        <h1>Total Salary of All Employees</h1>
        <p>The total salary for all employees in the system is:</p>
        <h1><?php echo number_format($totalSalary, 2); ?> USD</h1>
    </div>
    <button onclick="location.href='Administration.php'">Back to Admin Panel</button>
</body>
</html>
