<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$dept_info = [];
if ($ssn) {
    $employee = $db->query(
        "SELECT Dno FROM uw_employee WHERE Ssn = ?", 
        [$ssn]
    );

    if (!empty($employee)) {
        $dno = $employee[0]['Dno'];
        
        $dept_info = $db->query(
            "SELECT d.Dnumber, d.Dname, l.Dlocation
            FROM uw_department d
            JOIN uw_dept_locations l ON d.Dnumber = l.Dnumber
            WHERE d.Dnumber = ?",
            [$dno]
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Information</title>
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
    <h1>My Work Location</h1>
    
    <form method="get" style="text-align: center; margin-bottom: 20px;">
        <label for="ssn">Enter Employee SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Enter Employee SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Work Location for Employee with SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if (!empty($dept_info)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Department Number</th>
                        <th>Department Name</th>
                        <th>Department Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dept_info as $dept): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dept['Dnumber']); ?></td>
                            <td><?php echo htmlspecialchars($dept['Dname']); ?></td>
                            <td><?php echo htmlspecialchars($dept['Dlocation']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No department information found for the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Employee.php'">Back to Employee Panel</button>
</body>
</html>
