<?php

$host = "localhost"; //datbase host 
$dbname = "vicity_car"; //database name
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>