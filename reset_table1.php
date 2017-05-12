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

$sql = "TRUNCATE TABLE total";
$conn->query($sql);

header('Location: http://localhost/sufiyan/form-login2/index1.php');

 ?>
