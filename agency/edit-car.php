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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier voiture</title>
</head>
<body>

<h1>Modifier voiture</h1>

<form action="../crud/update_voiture.php" method="POST">

    <input type="hidden"
           name="id_voiture"
           value="<?php echo $voiture['id_voiture']; ?>">

    <label>Modèle :</label><br>
    <input type="text"
           name="modele"
           value="<?php echo $voiture['modele']; ?>">

    <br><br>

    <label>Prix :</label><br>
    <input type="number"
           step="0.01"
           name="prix"
           value="<?php echo $voiture['prix']; ?>">

    <br><br>

    <button type="submit">
        Modifier
    </button>

</form>

</body>
</html>