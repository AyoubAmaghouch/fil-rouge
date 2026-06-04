<?php

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_agence = $_POST['nom_agence'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $ville = $_POST['ville'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $logo = $_FILES['logo']['name'];
    $tmp_name = $_FILES['logo']['tmp_name'];

    move_uploaded_file($tmp_name, "../assets/images/agences/" . $logo);

    $sql = "INSERT INTO agences
            (nom_agence, email, telephone, ville, mot_de_passe, logo, statut_validation)
            VALUES
            (?, ?, ?, ?, ?, ?, 0)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom_agence,
        $email,
        $telephone,
        $ville,
        $mot_de_passe,
        $logo
    ]);

    echo "Agence enregistrée avec succès !";
}
?>