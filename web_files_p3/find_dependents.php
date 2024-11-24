<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();
$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$dependents = [];
if ($ssn) {
    $dependents = $db->query("SELECT * FROM uw_dependent WHERE Essn = ?", [$ssn]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dependents</title>
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
    <h1>Find Dependents</h1>
    <form method="get">
        <label for="ssn">Enter Employee SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Employee SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Dependents for Employee SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if ($dependents): ?>
            <table>
                <thead>
                    <tr>
                        <th>Dependent Name</th>
                        <th>Gender</th>
                        <th>Bdate</th>
                        <th>Relationship</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dependents as $dependent): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dependent['Dependent_name']); ?></td>
                            <td><?php echo htmlspecialchars($dependent['Sex']); ?></td>
                            <td><?php echo htmlspecialchars($dependent['Bdate']); ?></td>
                            <td><?php echo htmlspecialchars($dependent['Relationship']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No dependents found for the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Administration.php'">Back to Admin Panel</button>
</body>
</html>
