<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';
require_once '../config/db.php';

$nb_agences = $pdo->query("SELECT COUNT(*) FROM agences")
                  ->fetchColumn();

$nb_voitures = $pdo->query("SELECT COUNT(*) FROM voitures")
                   ->fetchColumn();

$nb_attente = $pdo->query("SELECT COUNT(*) FROM agences
                           WHERE statut_validation = 0")
                  ->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/backend.css">
</head>
<body>

<nav class="vc-back-nav">
    <a href="javascript:void(0)" onclick="history.back()">← Retour</a>
    <a href="../index.php">🏠 Accueil</a>
</nav>

<h1>Dashboard Admin</h1>

<hr>

<h2>Statistiques</h2>

<p>
    Nombre d'agences :
    <?php echo $nb_agences; ?>
</p>

<p>
    Nombre de voitures :
    <?php echo $nb_voitures; ?>
</p>

<p>
    Agences en attente :
    <?php echo $nb_attente; ?>
</p>

<hr>

<h2>Gestion</h2>

<p>
    <a href="agences.php">
        Gérer les agences
    </a>
</p>

<p>
    <a href="voitures.php">
        Voir les voitures
    </a>
</p>
<p>
    <a href="../logout.php">
        Déconnexion
    </a>
</p>

</body>
</html>