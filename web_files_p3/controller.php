<?php
session_start();

require "model.php";
$db = new SimpleDB();

if (isset($_GET['ssn'])) {
    $ssn = $_GET['ssn'];
    $sqlUser = "SELECT * FROM uw_employee WHERE Ssn = :ssn";
    $user = $db->query($sqlUser, [':ssn' => $ssn]);

    if ($user) {
        $user = $user[0];
        $_SESSION['user'] = $user;

        $position_id = $user['Position_id'];
        if ($position_id == 1 && isset($_GET['role']) && $_GET['role'] === 'admin') {
            header("Location: Administration.php");
        } elseif ($position_id == 2 && isset($_GET['role']) && $_GET['role'] === 'manager') {
            header("Location: Manager.php");
        } else {
            header("Location: Employee.php");
        }
        exit();
    } else {
        echo "Invalid SSN.";
    }
} else {
    echo "No SSN provided.";
}
