<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Agence</title>
</head>
<body>

    <h2>Connexion Agence</h2>

    <form action="crud/login_agence.php" method="POST">

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