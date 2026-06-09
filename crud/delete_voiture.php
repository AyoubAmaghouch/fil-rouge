<?php

require_once '../config/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM images_voitures
        WHERE id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$sql = "DELETE FROM voitures
        WHERE id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../agency/my-cars.php");
exit();