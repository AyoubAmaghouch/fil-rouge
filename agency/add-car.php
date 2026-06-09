<?php

session_start();

if (!isset($_SESSION['id_agence'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$marques = $pdo->query("SELECT * FROM marques");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une voiture</title>
</head>
<body>

<h1>Ajouter une voiture</h1>

<form action="../crud/add_voiture.php" method="POST" enctype="multipart/form-data">

    <label>Marque :</label><br>

    <select name="id_marque" required>
        <option value="">Choisir une marque</option>

        <?php while($marque = $marques->fetch(PDO::FETCH_ASSOC)) { ?>

            <option value="<?php echo $marque['id_marque']; ?>">
                <?php echo $marque['nom_marque']; ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Modèle :</label><br>
    <input type="text" name="modele" required>

    <br><br>

    <label>Carburant :</label><br>

    <select name="carburant" required>
        <option value="">Choisir</option>
        <option value="Essence">Essence</option>
        <option value="Diesel">Diesel</option>
        <option value="Hybride">Hybride</option>
        <option value="Electrique">Electrique</option>
    </select>

    <br><br>

    <label>Transmission :</label><br>

    <select name="transmission" required>
        <option value="">Choisir</option>
        <option value="Manuelle">Manuelle</option>
        <option value="Automatique">Automatique</option>
    </select>

    <br><br>

    <label>Prix :</label><br>
    <input type="number" step="0.01" name="prix" required>

    <br><br>

    <label>Disponibilité :</label><br>

    <select name="disponibilite" required>
        <option value="1">Disponible</option>
        <option value="0">Indisponible</option>
    </select>

    <br><br>

    <label>Photo voiture :</label><br>
    <input type="file" name="image" required>

    <br><br>

    <button type="submit">
        Ajouter
    </button>

</form>

</body>
</html>