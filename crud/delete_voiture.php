<?php

session_start();

require_once '../config/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM voitures
        WHERE id_voiture = ?
        AND id_agence = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $id,
    $_SESSION['id_agence']
]);

$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    die("Accès refusé");
}

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