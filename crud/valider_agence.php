<?php

require_once '../config/db.php';

$id = $_GET['id'];

$sql = "UPDATE agences
        SET statut_validation = 1
        WHERE id_agence = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

header("Location: ../admin/agences.php");
exit();