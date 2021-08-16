<?php
$dsn = "mysql:host=localhost;dbname=user0512";
$user = "root";
$password = "";
try{
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>