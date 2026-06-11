<?php

require_once 'config/db.php';

/* Filtres */

$marque = $_GET['marque'] ?? '';
$transmission = $_GET['transmission'] ?? '';
$carburant = $_GET['carburant'] ?? '';
$ville = $_GET['ville'] ?? '';

/* Requête principale */

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
";
$params = [];

/* Filtre Marque */

if (!empty($marque)) {

    $sql .= " AND marques.nom_marque = ?";
    $params[] = $marque;
}

/* Filtre Transmission */

if (!empty($transmission)) {

    $sql .= " AND voitures.transmission = ?";
    $params[] = $transmission;
}

/* Filtre Carburant */

if (!empty($carburant)) {

    $sql .= " AND voitures.carburant = ?";
    $params[] = $carburant;
}

/* Filtre Ville */

if (!empty($ville)) {

    $sql .= " AND agences.ville = ?";
    $params[] = $ville;
}

/* Exécution */

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Marques */

$marques = $pdo->query("
    SELECT *
    FROM marques
    ORDER BY nom_marque ASC
");

/* Transmissions */

$transmissions = $pdo->query("
    SELECT DISTINCT transmission
    FROM voitures
    ORDER BY transmission ASC
");

/* Carburants */

$carburants = $pdo->query("
    SELECT DISTINCT carburant
    FROM voitures
    ORDER BY carburant ASC
");

/* Villes */

$villes = $pdo->query("
    SELECT DISTINCT ville
    FROM agences
    ORDER BY ville ASC
");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nos Voitures</title>
</head>
<body>

<h1>Nos Voitures</h1>

<form method="GET">

    <select name="marque">

        <option value="">Toutes les marques</option>

        <?php while($m = $marques->fetch(PDO::FETCH_ASSOC)) { ?>

            <option
                value="<?php echo $m['nom_marque']; ?>"
                <?php if($marque == $m['nom_marque']) echo "selected"; ?>
            >
                <?php echo $m['nom_marque']; ?>
            </option>

        <?php } ?>

    </select>

    <select name="transmission">

        <option value="">Toutes les transmissions</option>

        <?php while($t = $transmissions->fetch(PDO::FETCH_ASSOC)) { ?>

            <option
                value="<?php echo $t['transmission']; ?>"
                <?php if($transmission == $t['transmission']) echo "selected"; ?>
            >
                <?php echo $t['transmission']; ?>
            </option>

        <?php } ?>

    </select>

    <select name="carburant">

        <option value="">Tous les carburants</option>

        <?php while($c = $carburants->fetch(PDO::FETCH_ASSOC)) { ?>

            <option
                value="<?php echo $c['carburant']; ?>"
                <?php if($carburant == $c['carburant']) echo "selected"; ?>
            >
                <?php echo $c['carburant']; ?>
            </option>

        <?php } ?>

    </select>

    <select name="ville">

        <option value="">Toutes les villes</option>

        <?php while($v = $villes->fetch(PDO::FETCH_ASSOC)) { ?>

            <option
                value="<?php echo $v['ville']; ?>"
                <?php if($ville == $v['ville']) echo "selected"; ?>
            >
                <?php echo $v['ville']; ?>
            </option>

        <?php } ?>

    </select>

    <button type="submit">
        Filtrer
    </button>

    <a href="cars.php">
        Réinitialiser
    </a>

</form>

<br>

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
        Carburant :
        <?php echo $voiture['carburant']; ?>
    </p>

    <p>
        Transmission :
        <?php echo $voiture['transmission']; ?>
    </p>
    <p>
    Disponibilité :

    <?php if($voiture['disponibilite'] == 1) { ?>

        <span style="color:green;">
            Disponible
        </span>

    <?php } else { ?>

        <span style="color:red;">
            Indisponible
        </span>

    <?php } ?>

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