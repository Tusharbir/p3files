<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();
$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$employee = [];
if ($ssn) {
    $employee = $db->query("SELECT * FROM uw_employee WHERE Ssn = ?", [$ssn]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        form {
            margin: 20px 0;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Find Employee</h1>
    <form method="get">
        <label for="ssn">Enter Employee SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Employee SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Employee Information for SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if ($employee): ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Initial</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Bdate</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Position ID</th>
                        <th>Department Number</th>
                        <th>Supervisor SSN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employee as $emp): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emp['Fname']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Minit']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Lname']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Sex']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Bdate']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Address']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Salary']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Position_id']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Dno']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Super_ssn']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employee found for the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Administration.php'">Back to Admin Panel</button>
</body>
</html>
