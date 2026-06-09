<?php

require_once '../config/db.php';

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence";

$stmt = $pdo->query($sql);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Voitures</title>
</head>
<body>

<h1>Toutes les voitures</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Agence</th>
    <th>Marque</th>
    <th>Modèle</th>
    <th>Prix</th>
</tr>

<?php foreach($voitures as $voiture) { ?>

<tr>

    <td><?php echo $voiture['id_voiture']; ?></td>

    <td><?php echo $voiture['nom_agence']; ?></td>

    <td><?php echo $voiture['nom_marque']; ?></td>

    <td><?php echo $voiture['modele']; ?></td>

    <td><?php echo $voiture['prix']; ?> DH</td>

</tr>

<?php } ?>

</table>

</body>
</html>