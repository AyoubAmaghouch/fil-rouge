<?php
//mycarsupdate_voiture.php
session_start();

require_once '../config/db.php';

$id_voiture = $_POST['id_voiture'];
$modele = $_POST['modele'];
$prix = $_POST['prix'];

$sql = "UPDATE voitures
        SET modele = ?, prix = ?
        WHERE id_voiture = ?
        AND id_agence = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $modele,
    $prix,
    $id_voiture,
    $_SESSION['id_agence']
]);

header("Location: ../agency/my-cars.php");
exit();