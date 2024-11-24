<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

$ssn = isset($_GET['ssn']) ? $_GET['ssn'] : null;

$works = [];
if ($ssn) {
    $works = $db->query(
        "SELECT wo.Pno, p.Pname, wo.Hours
        FROM uw_works_on wo
        JOIN uw_project p ON wo.Pno = p.Pnumber
        WHERE wo.Essn = ?",
        [$ssn]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Work On</title>
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
    <h1>My Work</h1>
    
    <form method="get" style="text-align: center; margin-bottom: 20px;">
        <label for="ssn">Enter Your SSN:</label>
        <input type="text" id="ssn" name="ssn" placeholder="Enter Your SSN" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($ssn): ?>
        <h2>Projects Worked On by Employee SSN: <?php echo htmlspecialchars($ssn); ?></h2>
        <?php if (!empty($works)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Number</th>
                        <th>Project Name</th>
                        <th>Hours Worked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($works as $work): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($work['Pno']); ?></td>
                            <td><?php echo htmlspecialchars($work['Pname']); ?></td>
                            <td><?php echo htmlspecialchars($work['Hours']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No projects found for the provided SSN.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Employee.php'">Back to Employee Panel</button>
</body>
</html>
