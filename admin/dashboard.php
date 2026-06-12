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
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
</head>
<body class="admin-dashboard">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Admin Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php" class="active">📊 Dashboard</a>
        <a href="agences.php">🏢 Agences</a>
        <a href="voitures.php">🚗 Voitures</a>
        <hr>
        <a href="../index.php">🏠 Accueil Public</a>
        <a href="../logout.php">🚪 Déconnexion</a>
    </nav>
    <div class="sidebar-footer">
        <p>&copy; <?php echo date('Y'); ?> VICITY CAR</p>
    </div>
</aside>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay"></div>

<!-- Hamburger toggle -->
<button class="sidebar-toggle" aria-label="Menu">☰</button>

<!-- Main Content -->
<main class="admin-main">

    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Vue d'ensemble de la plateforme VICITY CAR</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-cyan">
            <div class="stat-icon">🏢</div>
            <div class="stat-info">
                <span class="stat-value" data-count="<?php echo $nb_agences; ?>">0</span>
                <span class="stat-label">Agences</span>
            </div>
        </div>
        <div class="stat-card stat-pink">
            <div class="stat-icon">🚗</div>
            <div class="stat-info">
                <span class="stat-value" data-count="<?php echo $nb_voitures; ?>">0</span>
                <span class="stat-label">Voitures</span>
            </div>
        </div>
        <div class="stat-card stat-amber">
            <div class="stat-icon">⏳</div>
            <div class="stat-info">
                <span class="stat-value" data-count="<?php echo $nb_attente; ?>">0</span>
                <span class="stat-label">En attente</span>
            </div>
        </div>
    </div>

    <!-- Management Section -->
    <h3 class="section-title">Gestion</h3>
    <div class="management-links">
        <a href="agences.php">🏢 Gérer les agences</a>
        <a href="voitures.php">🚗 Voir les voitures</a>
        <a href="../logout.php" class="logout-link">🚪 Déconnexion</a>
    </div>

</main>

<script src="../assets/js/admin.js"></script>

</body>
</html>