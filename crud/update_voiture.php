<?php

session_start();

require_once '../config/db.php';

$id_voiture = $_POST['id_voiture'];

$id_marque = $_POST['id_marque'];
$modele = $_POST['modele'];
$carburant = $_POST['carburant'];
$transmission = $_POST['transmission'];
$prix = $_POST['prix'];
$disponibilite = $_POST['disponibilite'];

$sql = "UPDATE voitures

        SET id_marque = ?,
            modele = ?,
            carburant = ?,
            transmission = ?,
            prix = ?,
            disponibilite = ?

        WHERE id_voiture = ?
        AND id_agence = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    $id_marque,
    $modele,
    $carburant,
    $transmission,
    $prix,
    $disponibilite,

    $id_voiture,
    $_SESSION['id_agence']

]);

header("Location: ../agency/my-cars.php");
exit();