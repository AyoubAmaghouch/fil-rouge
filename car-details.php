<?php

require_once 'config/db.php';
if (!isset($_GET['id'])) {
    die("Voiture introuvable");
}

$id = $_GET['id'];

$id = $_GET['id'];

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence,
               agences.telephone,
               agences.ville,
               images_voitures.image

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence

        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture

        WHERE voitures.id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails voiture</title>
</head>
<body>

<h1>
    <?php echo $voiture['nom_marque']; ?>
    <?php echo $voiture['modele']; ?>
</h1>

<img
src="assets/images/voitures/<?php echo $voiture['image']; ?>"
width="400">

<p>
    <strong>Marque :</strong>
    <?php echo $voiture['nom_marque']; ?>
</p>

<p>
    <strong>Modèle :</strong>
    <?php echo $voiture['modele']; ?>
</p>

<p>
    <strong>Carburant :</strong>
    <?php echo $voiture['carburant']; ?>
</p>

<p>
    <strong>Transmission :</strong>
    <?php echo $voiture['transmission']; ?>
</p>

<p>
    <strong>Prix :</strong>
    <?php echo $voiture['prix']; ?> DH / Jour
</p>

<hr>

<h2>Agence</h2>

<p>
    <strong>Nom :</strong>
    <?php echo $voiture['nom_agence']; ?>
</p>

<p>
    <strong>Ville :</strong>
    <?php echo $voiture['ville']; ?>
</p>

<p>
    <strong>Téléphone :</strong>
    <?php echo $voiture['telephone']; ?>
</p>
<?php if($voiture['disponibilite'] == 1) { ?>

    <p>
        <strong>Disponibilité :</strong>
        Disponible
    </p>

<?php } else { ?>

    <p>
        <strong>Disponibilité :</strong>
        Indisponible
    </p>

<?php } ?>
<a href="cars.php">
    Retour aux voitures
</a>

</body>
</html>