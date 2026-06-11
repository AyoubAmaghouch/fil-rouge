<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';
require_once '../config/db.php';

$sql = "SELECT * FROM agences
        WHERE statut_validation = 0";

$stmt = $pdo->query($sql);

$agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Agences — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/backend.css">
</head>
<body>

<h1>Agences en attente</h1>

<table border="1">

    <?php



if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT *
        FROM agences
        ORDER BY id_agence DESC";

$stmt = $pdo->query($sql);

$agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Agences — VICITY CAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/backend.css">
</head>
<body>

<nav class="vc-back-nav">
    <a href="javascript:void(0)" onclick="history.back()">← Retour</a>
    <a href="../index.php">🏠 Accueil</a>
</nav>

<h1>Gestion des Agences</h1>

<table border="1">

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

<?php foreach($agences as $agence) { ?>

<tr>

    <td><?php echo $agence['id_agence']; ?></td>

    <td>
        <img
        src="../assets/images/agences/<?php echo $agence['logo']; ?>"
        width="80">
    </td>

    <td><?php echo $agence['nom_agence']; ?></td>

    <td><?php echo $agence['email']; ?></td>

    <td><?php echo $agence['telephone']; ?></td>

    <td><?php echo $agence['ville']; ?></td>

    <td>

        <?php if($agence['statut_validation'] == 1) { ?>

            Validée

        <?php } else { ?>

            Non validée

        <?php } ?>

    </td>

    <td>

        <?php if($agence['statut_validation'] == 0) { ?>

            <a href="../crud/valider_agence.php?id=<?php echo $agence['id_agence']; ?>">
                Valider
            </a>

            <br><br>

        <?php } ?>

        <a href="../crud/modifier_agence.php?id=<?php echo $agence['id_agence']; ?>">
            Modifier
        </a>

        <br><br>

        <a href="../crud/supprimer_agence.php?id=<?php echo $agence['id_agence']; ?>"
           onclick="return confirm('Supprimer cette agence ?');">
            Supprimer
        </a>

    </td>

</tr>

<?php } ?>


</table>

<br>

<a href="dashboard.php">
    Retour Dashboard
</a>

</body>
</html>


</table>

</body>
</html>