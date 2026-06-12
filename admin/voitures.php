
<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence,
               images_voitures.image

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence

        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture

        ORDER BY voitures.id_voiture DESC";

$stmt = $pdo->query($sql);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voitures — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-voitures.css">
</head>
<body class="admin-voitures">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Admin Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="agences.php">🏢 Agences</a>
        <a href="voitures.php" class="active">🚗 Voitures</a>
        <hr>
        <a href="../index.php">🏠 Accueil Public</a>
        <a href="../logout.php">🚪 Déconnexion</a>
    </nav>
    <div class="sidebar-footer">
        <p>&copy; <?php echo date('Y'); ?> VICITY CAR</p>
    </div>
</aside>

<div class="sidebar-overlay"></div>
<button class="sidebar-toggle" aria-label="Menu">☰</button>

<main class="admin-main">

    <div class="page-header">
        <h1>Toutes les voitures</h1>
    </div>

<div class="table-wrapper">
<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Photo</th>
    <th>Agence</th>
    <th>Marque</th>
    <th>Modèle</th>
    <th>Prix</th>
    <th>Disponibilité</th>
    <th>Actions</th>

</tr>

<?php foreach($voitures as $voiture) { ?>

<tr>

    <td>
        <?php echo $voiture['id_voiture']; ?>
    </td>

    <td>

        <img
        src="../assets/images/voitures/<?php echo $voiture['image']; ?>"
        width="100">

    </td>

    <td>
        <?php echo $voiture['nom_agence']; ?>
    </td>

    <td>
        <?php echo $voiture['nom_marque']; ?>
    </td>

    <td>
        <?php echo $voiture['modele']; ?>
    </td>

    <td>
        <?php echo $voiture['prix']; ?> DH
    </td>

    <td>

        <?php if($voiture['disponibilite'] == 1) { ?>

            <span class="status-pill available">Disponible</span>

        <?php } else { ?>

            <span class="status-pill unavailable">Indisponible</span>

        <?php } ?>

    </td>

    <td>

        <a href="../crud/delete_voiture.php?id=<?php echo $voiture['id_voiture']; ?>"
           onclick="return confirm('Supprimer cette voiture ?');">
            🗑️ Supprimer
        </a>

    </td>

</tr>

<?php } ?>

</table>
</div>

</main>

<script src="../assets/js/admin.js"></script>

</body>
</html>

