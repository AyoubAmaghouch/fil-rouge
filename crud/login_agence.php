    <?php

    session_start();

    require_once '../config/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];

        // LOGIN ADMIN

        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]); //admin email

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) { //condition de vérification du mot de passe
//pasword verify hiya li tsna3 meno motpasse hash 
            $_SESSION['id_admin'] = $admin['id_admin'];//hfd admin
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

            if (password_verify($mot_de_passe, $agence['mot_de_passe'])) { //condition de vérification du mot de passe $2y$10$....

                if ($agence['statut_validation'] == 1) {  //condition de vérification de validation de l'agence

                    $_SESSION['id_agence'] = $agence['id_agence']; //hfd agence
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