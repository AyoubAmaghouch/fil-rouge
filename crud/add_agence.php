<?php

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_agence = $_POST['nom_agence'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $whatsapp = $_POST['whatsapp'];
    $ville = $_POST['ville'];
    $localisation = $_POST['localisation']; // lien Google Maps

    $mot_de_passe = password_hash(
        $_POST['mot_de_passe'],
        PASSWORD_DEFAULT
    ); // hashage du mot de passe

    $logo = $_FILES['logo']['name']; // le nom du photo
    $tmp_name = $_FILES['logo']['tmp_name']; // le chemin temporaire du photo

    move_uploaded_file(
        $tmp_name,
        "../assets/images/agences/" . $logo
    ); // déplacer le photo vers le dossier des agences

    $sql = "INSERT INTO agences
            (
                nom_agence,
                email,
                telephone,
                whatsapp,
                ville,
                localisation,
                mot_de_passe,
                logo,
                statut_validation
            )
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, 0)";

    $stmt = $pdo->prepare($sql); // préparer la requête SQL

    $stmt->execute([
        $nom_agence,
        $email,
        $telephone,
        $whatsapp,
        $ville,
        $localisation,
        $mot_de_passe,
        $logo
    ]);

    echo "Agence enregistrée avec succès !";
}
?>