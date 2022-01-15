<?php
$servername = "localhost";
$username = "root";
$password = "";


$con = new PDO("mysql:host=$servername;dbname=steam", $username, $password);


//try {
//    $conn = new PDO("mysql:host=$servername;dbname=steam", $username, $password);
//    // set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
//} catch(PDOException $e) {
//    echo "Connection failed: " . $e->getMessage();
//}


?>


