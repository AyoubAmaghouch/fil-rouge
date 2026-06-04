<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Agence</title>
</head>
<body>

    <h2>Inscription Agence</h2>

    <form action="../crud/add_agence.php" method="POST" enctype="multipart/form-data">

        <label>Nom Agence :</label><br>
        <input type="text" name="nom_agence" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Téléphone :</label><br>
        <input type="text" name="telephone" required><br><br>

        <label>Ville :</label><br>
        <input type="text" name="ville" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="mot_de_passe" required><br><br>

        <label>Logo :</label><br>
        <input type="file" name="logo" required><br><br>

        <button type="submit">S'inscrire</button>

    </form>

</body>
</html>