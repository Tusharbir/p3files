<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];

    $query = "DELETE FROM uw_employee WHERE Ssn = ?";

    $db->query($query, [$ssn]);

    header('Location: delete_employee.php');
    exit();
}

$employees = $db->query("SELECT Ssn, Fname, Minit, Lname, Dno FROM uw_employee");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
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
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Delete Employee</h1>
    
    <table>
        <thead>
            <tr>
                <th>SSN</th>
                <th>Name</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['Ssn']; ?></td>
                    <td><?php echo $employee['Fname'] . ' ' . $employee['Minit'] . ' ' . $employee['Lname']; ?></td>
                    <td><?php echo $employee['Dno']; ?></td>
                    <td>
                        <a href="delete_employee.php?ssn=<?php echo $employee['Ssn']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="location.href='Administration.php'">Back to Admin Panel</button>
</body>
</html>
