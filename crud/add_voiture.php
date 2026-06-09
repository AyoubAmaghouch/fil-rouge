<?php

session_start();

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_agence = $_SESSION['id_agence'];

    $id_marque = $_POST['id_marque'];
    $modele = $_POST['modele'];
    $carburant = $_POST['carburant'];
    $transmission = $_POST['transmission'];
    $prix = $_POST['prix'];
    $disponibilite = $_POST['disponibilite'];

    $sql = "INSERT INTO voitures
    (id_agence, id_marque, modele, carburant, transmission, prix, disponibilite)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id_agence,
        $id_marque,
        $modele,
        $carburant,
        $transmission,
        $prix,
        $disponibilite
    ]);

    $id_voiture = $pdo->lastInsertId();

$image = uniqid() . "_" . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file(
        $tmp_name,
        "../assets/images/voitures/" . $image
    );

    $sql_image = "INSERT INTO images_voitures
    (id_voiture, image)
    VALUES (?, ?)";

    $stmt_image = $pdo->prepare($sql_image);

    $stmt_image->execute([
        $id_voiture,
        $image
    ]);

    echo "Voiture ajoutée avec succès !";
}
?>