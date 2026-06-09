<?php

require_once 'config/db.php';

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence,
               agences.ville,
               images_voitures.image

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence

        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture

        WHERE agences.statut_validation = 1
        AND voitures.disponibilite = 1";

$stmt = $pdo->query($sql);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nos Voitures</title>
</head>
<body>

<h1>Nos Voitures</h1>

<?php foreach($voitures as $voiture) { ?>

<div style="border:1px solid black; padding:10px; margin:10px;">

    <img
    src="assets/images/voitures/<?php echo $voiture['image']; ?>"
    width="200">

    <h3>
        <?php echo $voiture['nom_marque']; ?>
        <?php echo $voiture['modele']; ?>
    </h3>

    <p>
        Ville :
        <?php echo $voiture['ville']; ?>
    </p>

    <p>
        Prix :
        <?php echo $voiture['prix']; ?> DH / Jour
    </p>

    <a href="car-details.php?id=<?php echo $voiture['id_voiture']; ?>">
        Voir détails
    </a>

</div>

<?php } ?>

</body>
</html>