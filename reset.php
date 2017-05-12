<?php

include_once 'dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "TRUNCATE TABLE total";
$sql2 = "TRUNCATE TABLE process_total";
$sql3 = "TRUNCATE TABLE overhead_total";
$sql4 = "TRUNCATE TABLE labour_total";
$sql5 = "TRUNCATE TABLE profit_total";
$sql6 = "TRUNCATE TABLE tax_total";
$conn->query($sql);
$conn->query($sql2);
$conn->query($sql3);
$conn->query($sql4);
$conn->query($sql5);
$conn->query($sql6);

header('Location: 1.php');

 ?>
