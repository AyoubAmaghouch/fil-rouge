<?php

session_start();

if (!isset($_SESSION['id_agence'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql_count = "SELECT COUNT(*) FROM voitures WHERE id_agence = ?";
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute([$_SESSION['id_agence']]);
$nb_voitures = $stmt_count->fetchColumn();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agence — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/agency-dashboard.css">
</head>
<body class="agency-dashboard">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Agence Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php" class="active">📊 Dashboard</a>
        <a href="my-cars.php">🚗 Mes Voitures</a>
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
        <h1>Dashboard Agence</h1>
        <p>Bienvenue, <?php echo $_SESSION['nom_agence']; ?></p>
    </div>

    <div class="stats-grid">
        <div class="stat-card stat-cyan">
            <div class="stat-icon">🚗</div>
            <div class="stat-info">
                <span class="stat-value" data-count="<?php echo $nb_voitures; ?>">0</span>
                <span class="stat-label">Mes Voitures</span>
            </div>
        </div>
    </div>

    <h2 class="section-title">Actions rapides</h2>

    <div class="management-links">
        <a href="add-car.php">➕ Ajouter une voiture</a>
        <a href="my-cars.php">📋 Gérer mes voitures</a>
        <a href="../logout.php" class="logout-link">🚪 Déconnexion</a>
    </div>

</main>

<script src="../assets/js/agency.js"></script>

</body>
</html>