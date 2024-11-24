<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$benefits = [];
if ($ssn) {
    $benefits = $db->query(
        "SELECT eb.Benefit_name, eb.Description
        FROM uw_employee_benefits eb
        WHERE eb.Essn = ?",
        [$ssn]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Benefits</title>
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
    <h1>My Benefits</h1>
    
    <form method="get" style="text-align: center; margin-bottom: 20px;">
        <label for="ssn">Enter Your SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Enter Your SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Benefits for Employee SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if (!empty($benefits)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Benefit Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($benefits as $benefit): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($benefit['Benefit_name']); ?></td>
                            <td><?php echo htmlspecialchars($benefit['Description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No benefits found for the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Employee.php'">Back to Employee Panel</button>
</body>
</html>
