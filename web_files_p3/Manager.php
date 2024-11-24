<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 2) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel</title>
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

        .featureb {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <h1>Welcome to Manager Panel</h1>
    <button class="featureb" onclick="location.href='project_lookup.php'">Project LookUp</button>
    <button class="featureb" onclick="location.href='my_dept.php'">My Department</button>

    <br>
    <br>
    <button onclick="location.href='logout.php'">Log Out</button>

</body>
</html>
