<?php

$servername = "localhost";
$username = "root";
$password = "Unico@1989";
$dbname = "form2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql2 = "TRUNCATE TABLE process_total";
$conn->query($sql2);

header('Location: http://localhost/sufiyan/form-login2/index2.php');

 ?>
