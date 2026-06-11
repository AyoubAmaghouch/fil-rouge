<?php

session_start();

if (!isset($_SESSION['id_agence'])) {
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agence — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/backend.css">
</head>
<body>

<nav class="vc-back-nav">
    <a href="javascript:void(0)" onclick="history.back()">← Retour</a>
    <a href="../index.php">🏠 Accueil</a>
</nav>

    <h1>Dashboard Agence</h1>

    <p>
        Bienvenue <?php echo $_SESSION['nom_agence']; ?>
    </p>

    <a href="add-car.php">
    Ajouter une voiture
</a>

<a href="my-cars.php">
    Mes voitures
</a>
    <a href="../logout.php">
        Déconnexion
    </a>
</p>

</body>
</html>