<?php

session_start();

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // LOGIN ADMIN

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {

        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['email_admin'] = $admin['email'];

        header("Location: ../admin/dashboard.php");
        exit();
    }

    // LOGIN AGENCE

    $sql = "SELECT * FROM agences WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $agence = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($agence) {

        if (password_verify($mot_de_passe, $agence['mot_de_passe'])) {

            if ($agence['statut_validation'] == 1) {

                $_SESSION['id_agence'] = $agence['id_agence'];
                $_SESSION['nom_agence'] = $agence['nom_agence'];

                header("Location: ../agency/dashboard.php");
                exit();

            } else {

                echo "Votre agence est en attente de validation.";
            }

        } else {

            echo "Mot de passe incorrect.";
        }

    } else {

        echo "Email introuvable.";
    }
}
?>