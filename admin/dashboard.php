<?php

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
    <title>Dashboard Admin</title>
</head>
<body>

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