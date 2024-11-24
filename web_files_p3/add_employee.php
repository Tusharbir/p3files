<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php');
    exit();
}

require_once 'model.php';
$db = new SimpleDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Fname = $_POST['Fname'];
    $Minit = $_POST['Minit'];
    $Lname = $_POST['Lname'];
    $Ssn = $_POST['Ssn'];
    $Bdate = $_POST['Bdate'];
    $Address = $_POST['Address'];
    $Sex = $_POST['Sex'];
    $Salary = $_POST['Salary'];
    $Super_ssn = $_POST['Super_ssn'];
    $Dno = $_POST['Dno'];
    $Position_id = $_POST['Position_id'];

    $query = "INSERT INTO uw_employee (Fname, Minit, Lname, Ssn, Bdate, Address, Sex, Salary, Super_ssn, Dno, Position_id) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = [$Fname, $Minit, $Lname, $Ssn, $Bdate, $Address, $Sex, $Salary, $Super_ssn, $Dno, $Position_id];
    $db->query($query, $params);

    $_SESSION['message'] = "Employee added successfully!";
    $_SESSION['message_type'] = 'success';

    header('Location: add_employee.php');
    exit();
}

$departments = $db->query("SELECT Dnumber, Dname FROM uw_department");
$positions = $db->query("SELECT Position_id, Position_name FROM uw_position");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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
            margin: 20px auto;
            width: 50%;
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <h1>Add New Employee</h1>

    <!-- Display success message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message <?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; ?>
            <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="Fname">First Name:</label>
        <input type="text" id="Fname" name="Fname" required>

        <label for="Minit">Middle Initial:</label>
        <input type="text" id="Minit" name="Minit" maxlength="1">

        <label for="Lname">Last Name:</label>
        <input type="text" id="Lname" name="Lname" required>

        <label for="Ssn">SSN:</label>
        <input type="text" id="Ssn" name="Ssn" maxlength="9" required>

        <label for="Bdate">Birthdate:</label>
        <input type="date" id="Bdate" name="Bdate" required>

        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" required>

        <label for="Sex">Gender:</label>
        <select id="Sex" name="Sex" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>

        <label for="Salary">Salary:</label>
        <input type="number" id="Salary" name="Salary" step="0.01" required>

        <label for="Super_ssn">Supervisor SSN:</label>
        <input type="text" id="Super_ssn" name="Super_ssn">

        <label for="Dno">Department Number:</label>
        <select id="Dno" name="Dno" required>
            <?php foreach ($departments as $department): ?>
                <option value="<?php echo $department['Dnumber']; ?>"><?php echo $department['Dname']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="Position_id">Position:</label>
        <select id="Position_id" name="Position_id" required>
            <?php foreach ($positions as $position): ?>
                <option value="<?php echo $position['Position_id']; ?>"><?php echo $position['Position_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Employee</button>
    </form>

    <button onclick="location.href='Administration.php'">Back to Admin Panel</button>
</body>
</html>
