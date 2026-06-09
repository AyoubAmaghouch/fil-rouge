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
    <title>Validation Agences</title>
</head>
<body>

<h1>Agences en attente</h1>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Ville</th>
        <th>Logo</th>
        <th>Action</th>
    </tr>

    <?php foreach($agences as $agence) { ?>

    <tr>

        <td><?php echo $agence['id_agence']; ?></td>

        <td><?php echo $agence['nom_agence']; ?></td>

        <td><?php echo $agence['email']; ?></td>

        <td><?php echo $agence['ville']; ?></td>

        <td>
            <img
            src="../assets/images/agences/<?php echo $agence['logo']; ?>"
            width="80">
        </td>

        <td>
            <a href="../crud/valider_agence.php?id=<?php echo $agence['id_agence']; ?>">
                Valider
            </a>
        </td>

    </tr>

    <?php } ?>

</table>

</body>
</html>