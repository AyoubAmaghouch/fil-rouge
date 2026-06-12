<?php

session_start();

if (!isset($_SESSION['id_agence'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

if (!isset($_GET['id'])) {
    die("Voiture introuvable");
}

$id = $_GET['id'];

$sql = "SELECT * FROM voitures
        WHERE id_voiture = ?
        AND id_agence = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $id,
    $_SESSION['id_agence']
]);

$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    die("Accès refusé");
}

$marques = $pdo->query("
    SELECT *
    FROM marques
    ORDER BY nom_marque ASC
");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Voiture — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/agency-edit-car.css">
</head>
<body class="agency-edit-car">

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>VICITY CAR</h2>
        <span>Agence Panel</span>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php">📊 Dashboard</a>
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
        <h1>Modifier voiture</h1>
    </div>

<form action="../crud/update_voiture.php" method="POST">

    <input
        type="hidden"
        name="id_voiture"
        value="<?php echo $voiture['id_voiture']; ?>">

    <label>Marque :</label><br>

    <select name="id_marque" required>

        <?php while($marque = $marques->fetch(PDO::FETCH_ASSOC)) { ?>

            <option
                value="<?php echo $marque['id_marque']; ?>"
                <?php
                if($marque['id_marque'] == $voiture['id_marque']) {
                    echo "selected";
                }
                ?>
            >
                <?php echo $marque['nom_marque']; ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Modèle :</label><br>

    <input
        type="text"
        name="modele"
        value="<?php echo $voiture['modele']; ?>"
        required>

    <br><br>

    <label>Carburant :</label><br>

    <select name="carburant" required>

        <option value="Essence"
        <?php if($voiture['carburant'] == 'Essence') echo 'selected'; ?>>
            Essence
        </option>

        <option value="Diesel"
        <?php if($voiture['carburant'] == 'Diesel') echo 'selected'; ?>>
            Diesel
        </option>

        <option value="Hybride"
        <?php if($voiture['carburant'] == 'Hybride') echo 'selected'; ?>>
            Hybride
        </option>

        <option value="Électrique"
        <?php if($voiture['carburant'] == 'Électrique') echo 'selected'; ?>>
            Électrique
        </option>

    </select>

    <br><br>

    <label>Transmission :</label><br>

    <select name="transmission" required>

        <option value="Manuelle"
        <?php if($voiture['transmission'] == 'Manuelle') echo 'selected'; ?>>
            Manuelle
        </option>

        <option value="Automatique"
        <?php if($voiture['transmission'] == 'Automatique') echo 'selected'; ?>>
            Automatique
        </option>

    </select>

    <br><br>

    <label>Prix :</label><br>

    <input
        type="number"
        step="0.01"
        name="prix"
        value="<?php echo $voiture['prix']; ?>"
        required>

    <br><br>

    <label>Disponibilité :</label><br>

    <select name="disponibilite" required>

        <option value="1"
        <?php if($voiture['disponibilite'] == 1) echo 'selected'; ?>>
            Disponible
        </option>

        <option value="0"
        <?php if($voiture['disponibilite'] == 0) echo 'selected'; ?>>
            Indisponible
        </option>

    </select>

    <br><br>

    <button type="submit">
        Modifier
    </button>

</form>

</main>

<script src="../assets/js/agency.js"></script>

</body>
</html>