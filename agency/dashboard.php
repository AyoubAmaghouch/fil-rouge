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
    <title>Dashboard Agence</title>
</head>
<body>

    <h1>Dashboard Agence</h1>

    <p>
        Bienvenue <?php echo $_SESSION['nom_agence']; ?>
    </p>

    <a href="add-car.php">
        Ajouter une voiture
    </a>
    <p>
    <a href="../logout.php">
        Déconnexion
    </a>
</p>

</body>
</html>