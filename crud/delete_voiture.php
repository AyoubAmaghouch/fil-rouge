<?php

session_start();

if (!isset($_SESSION['id_agence']) && !isset($_SESSION['id_admin'])) {
    die("Accès refusé");
}

require_once '../config/db.php';

$id = $_GET['id'];

// Admin can delete any car
if (isset($_SESSION['id_admin'])) {
    $sql = "SELECT * FROM voitures WHERE id_voiture = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $voiture = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$voiture) {
        die("Voiture introuvable");
    }
} else {
    // Agency can only delete their own cars
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
}

$sql = "DELETE FROM images_voitures
        WHERE id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$sql = "DELETE FROM voitures
        WHERE id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Redirect based on user type
if (isset($_SESSION['id_admin'])) {
    header("Location: ../admin/voitures.php");
} else {
    header("Location: ../agency/my-cars.php");
}
exit();