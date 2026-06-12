<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT * FROM agences ORDER BY id_agence DESC";
$stmt = $pdo->query($sql);
$agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Agences — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-agences.css">
</head>
<body class="admin-agences">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Admin Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="agences.php" class="active">🏢 Agences</a>
        <a href="voitures.php">🚗 Voitures</a>
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
        <h1>Gestion des Agences</h1>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($agences as $agence): ?>
                <tr>
                    <td data-label="ID"><?php echo $agence['id_agence']; ?></td>
                    <td data-label="Logo">
                        <img src="../assets/images/agences/<?php echo $agence['logo']; ?>" alt="Logo <?php echo $agence['nom_agence']; ?>">
                    </td>
                    <td data-label="Nom"><?php echo $agence['nom_agence']; ?></td>
                    <td data-label="Email"><?php echo $agence['email']; ?></td>
                    <td data-label="Téléphone"><?php echo $agence['telephone']; ?></td>
                    <td data-label="Ville"><?php echo $agence['ville']; ?></td>
                    <td data-label="Statut">
                        <?php if($agence['statut_validation'] == 1): ?>
                            <span class="status-pill valid">Validée</span>
                        <?php else: ?>
                            <span class="status-pill pending">Non validée</span>
                        <?php endif; ?>
                    </td>
                    <td data-label="Actions">
                        <?php if($agence['statut_validation'] == 0): ?>
                            <a href="../crud/valider_agence.php?id=<?php echo $agence['id_agence']; ?>" class="action-validate">✅ Valider</a>
                        <?php endif; ?>
                        <a href="../crud/supprimer_agence.php?id=<?php echo $agence['id_agence']; ?>"
                           onclick="return confirm('Supprimer cette agence ?');" class="action-delete">🗑️ Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="../assets/js/admin.js"></script>
</body>
</html>
