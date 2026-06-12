<?php

session_start();

if (!isset($_SESSION['id_agence'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT voitures.*, marques.nom_marque, images_voitures.image
        FROM voitures
        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque
        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture
        WHERE voitures.id_agence = ?"; //Jib ghir tomobilat dyal agence 3

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['id_agence']]);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Voitures — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/my-cars.css">
</head>
<body class="agency-my-cars">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Agence Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="my-cars.php" class="active">🚗 Mes Voitures</a>
        <a href="add-car.php">➕ Ajouter une Voiture</a>
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
        <h1>Mes voitures</h1>
    </div>

<div class="table-wrapper">
<table border="1">

    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Prix</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    <?php foreach($voitures as $voiture) { ?> 
    <tr>

        <td><?php echo $voiture['id_voiture']; ?></td>

        <td>
            <img
            src="../assets/images/voitures/<?php echo $voiture['image']; ?>"
            width="100">
        </td>

        <td><?php echo $voiture['nom_marque']; ?></td>

        <td><?php echo $voiture['modele']; ?></td>

        <td><?php echo $voiture['prix']; ?> DH</td>

        <td>

            <?php if($voiture['disponibilite'] == 1) { ?>

                <span class="status-pill available">Disponible</span>

            <?php } else { ?>

                <span class="status-pill unavailable">Indisponible</span>

            <?php } ?>

        </td>

    <td>

    <a href="edit-car.php?id=<?php echo $voiture['id_voiture']; ?>">
        ✏️ Modifier
    </a>

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

<script src="../assets/js/agency.js"></script>

</body>
</html>
