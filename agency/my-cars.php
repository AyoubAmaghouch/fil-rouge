    <?php

    session_start();

    if (!isset($_SESSION['id_agence'])) {
        header("Location: ../login.php");
        exit();
    }

    require_once '../config/db.php';

    $sql = "SELECT voitures.*, marques.nom_marque, images_voitures.image
            FROM voitures
            INNER JOIN marques
            ON voitures.id_marque = marques.id_marque
            LEFT JOIN images_voitures
            ON voitures.id_voiture = images_voitures.id_voiture
            WHERE voitures.id_agence = ?"; //Jib ghir tomobilat dyal agence 3

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id_agence']]);

    $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mes Voitures — VICITY CAR</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/backend.css">
    </head>
    <body>

    <nav class="vc-back-nav">
        <a href="javascript:void(0)" onclick="history.back()">← Retour</a>
        <a href="../index.php">🏠 Accueil</a>
    </nav>

    <h1>Mes voitures</h1>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>

        <?php foreach($voitures as $voiture) { ?> 
        <tr>

            <td><?php echo $voiture['id_voiture']; ?></td>

            <td>
                <img
                src="../assets/images/voitures/<?php echo $voiture['image']; ?>"
                width="100">
            </td>

            <td><?php echo $voiture['nom_marque']; ?></td>

            <td><?php echo $voiture['modele']; ?></td>

            <td><?php echo $voiture['prix']; ?> DH</td>

        <td>

        <a href="edit-car.php?id=<?php echo $voiture['id_voiture']; ?>">
            Modifier
        </a>

        |

        <a href="../crud/delete_voiture.php?id=<?php echo $voiture['id_voiture']; ?>">
            Supprimer
        </a>

    </td>
        </tr>

        <?php } ?>

    </table>

    </body>
    </html>