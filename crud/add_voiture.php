<?php

session_start();

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_agence = $_SESSION['id_agence'];

    $id_marque     = $_POST['id_marque'];
    $modele        = $_POST['modele'];
    $carburant     = $_POST['carburant'];
    $transmission  = $_POST['transmission'];
    $prix          = $_POST['prix'];
    $disponibilite = $_POST['disponibilite'];

    /* ── Insert the car ── */
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

    /* ── Handle images (up to 5) ── */
    if (!empty($_FILES['images']['name'][0])) {

        $files = $_FILES['images'];

        $max_images = 5;
        $count      = count($files['name']);

        if ($count > $max_images) {
            die("Erreur : vous ne pouvez pas ajouter plus de {$max_images} images par voiture.");
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
// Check each image
        for ($i = 0; $i < $count; $i++) {

            $tmp_name = $files['tmp_name'][$i];
            $orig     = $files['name'][$i];
            $type     = $files['type'][$i];
            $size     = $files['size'][$i];

            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            if (!in_array($type, $allowed)) {
                continue;
            }

            if ($size > 5 * 1024 * 1024) { // 5 MB
                continue;
            }

            $image = uniqid() . "_" . basename($orig);

            move_uploaded_file(
                $tmp_name,
                "../assets/images/voitures/" . $image
            );

            $sql_image = "INSERT INTO images_voitures
                          (id_voiture, image)
                          VALUES (?, ?)";

            $stmt_image = $pdo->prepare($sql_image);
            $stmt_image->execute([$id_voiture, $image]);
        }
    }

    header("Location: ../agency/my-cars.php");
    exit();
}
