<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 2) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$dnumber = 2; 
$employees = $db->query(
    "SELECT e.Ssn, e.Fname, e.Minit, e.Lname, e.Position_id, e.Salary, p.Position_name 
    FROM uw_employee e
    JOIN uw_position p ON e.Position_id = p.Position_id
    WHERE e.Dno = ?", 
    [$dnumber]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
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
    <h1>Employees in Department 2</h1>

    <?php if (!empty($employees)): ?>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Initial</th>
                    <th>Last Name</th>
                    <th>Position Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['Fname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Minit']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Lname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Position_name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No employees found in Department 2.</p>
    <?php endif; ?>

    <button onclick="location.href='Manager.php'">Back to Manager Panel</button>
</body>
</html>
