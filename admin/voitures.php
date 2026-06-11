
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
    <link rel="stylesheet" href="../assets/css/backend.css">
</head>
<body>

<nav class="vc-back-nav">
    <a href="javascript:void(0)" onclick="history.back()">← Retour</a>
    <a href="../index.php">🏠 Accueil</a>
</nav>

<h1>Toutes les voitures</h1>

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

            Disponible

        <?php } else { ?>

            Indisponible

        <?php } ?>

    </td>

    <td>

        <a href="../agency/edit-car.php?id=<?php echo $voiture['id_voiture']; ?>">
            Modifier
        </a>

        <br><br>

        <a href="../crud/delete_car.php?id=<?php echo $voiture['id_voiture']; ?>"
           onclick="return confirm('Supprimer cette voiture ?');">

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

