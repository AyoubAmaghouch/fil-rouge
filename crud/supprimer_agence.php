
<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['id'])) {
    die("Agence introuvable");
}

$id_agence = $_GET['id'];

/*
|--------------------------------------------------
| Supprimer les images des voitures
|--------------------------------------------------
*/

$sql = "DELETE images_voitures

        FROM images_voitures

        INNER JOIN voitures
        ON images_voitures.id_voiture = voitures.id_voiture

        WHERE voitures.id_agence = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_agence]);

/*
|--------------------------------------------------
| Supprimer les voitures
|--------------------------------------------------
*/

$sql = "DELETE FROM voitures
        WHERE id_agence = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_agence]);

/*
|--------------------------------------------------
| Supprimer l'agence
|--------------------------------------------------
*/

$sql = "DELETE FROM agences
        WHERE id_agence = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_agence]);

header("Location: ../admin/agences.php");
exit();
?>