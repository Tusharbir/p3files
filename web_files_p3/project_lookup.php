<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 2) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();
$pnumber = isset($_GET['Pnumber']) ? $_GET['Pnumber'] : null;

$projects = [];
if ($pnumber) {
    $projects = $db->query("SELECT * FROM uw_project WHERE Pnumber = ?", [$pnumber]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Lookup</title>
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
    <h1>Project Lookup</h1>
    <form method="get">
        <label for="Pnumber">Enter Project Number:</label>
        <input type="text" id="Pnumber" name="Pnumber" placeholder="Enter Project Number" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($pnumber): ?>
        <h2>Project Information for Project Number: <?php echo htmlspecialchars($pnumber); ?></h2>
        <?php if (!empty($projects)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Project Location</th>
                        <th>Department Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['Pname']); ?></td>
                            <td><?php echo htmlspecialchars($project['Plocation']); ?></td>
                            <td><?php echo htmlspecialchars($project['Dnum']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No project found for the provided Project Number.</p>
        <?php endif; ?>
    <?php endif; ?>

    <button onclick="location.href='Manager.php'">Back to Manager Panel</button>
</body>
</html>
