<?php
session_start();

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT * FROM admins WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {

        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['email_admin'] = $admin['email'];

        header("Location: dashboard.php");
        exit();

    } else {

        echo "Email ou mot de passe incorrect.";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>

<h1>Connexion Admin</h1>

<form method="POST">

    <label>Email :</label><br>
    <input type="email" name="email" required>

    <br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="mot_de_passe" required>

    <br><br>

    <button type="submit">
        Se connecter
    </button>

</form>

</body>
</html>