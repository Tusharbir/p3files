<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$employee = [];
if ($ssn) {
    $employee = $db->query(
        "SELECT e.Ssn, e.Fname, e.Minit, e.Lname, e.Salary, p.Position_name 
        FROM uw_employee e
        JOIN uw_position p ON e.Position_id = p.Position_id
        WHERE e.Ssn = ?", 
        [$ssn]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
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
    <h1>My Salary</h1>
    
    <form method="get" style="text-align: center; margin-bottom: 20px;">
        <label for="ssn">Enter Employee SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Enter Employee SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Employee Information for SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if (!empty($employee)): ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Initial</th>
                        <th>Last Name</th>
                        <th>Position Name</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employee as $emp): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emp['Fname']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Minit']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Lname']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Position_name']); ?></td>
                            <td><?php echo htmlspecialchars($emp['Salary']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employee found with the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Employee.php'">Back to Employee Panel</button>
</body>
</html>
