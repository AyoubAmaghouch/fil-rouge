    <?php

    session_start();

    if (!isset($_SESSION['id_agence'])) {
        header("Location: ../login.php");
        exit();
    } //if agence is not logged in, redirect to login page

    require_once '../config/db.php';

    $marques = $pdo->query("SELECT * FROM marques"); //fetch all car brands to display in the form
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter une Voiture — VICITY CAR</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/agency-add-car.css">
    </head>
    <body class="agency-add-car">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <h2>VICITY CAR</h2>
            <span>Agence Panel</span>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php">📊 Dashboard</a>
            <a href="my-cars.php">🚗 Mes Voitures</a>
            <a href="add-car.php" class="active">➕ Ajouter une Voiture</a>
            <hr>
            <a href="../index.php">🏠 Accueil Public</a>
            <a href="../logout.php">🚪 Déconnexion</a>
        </nav>
        <div class="sidebar-footer">
            <p>&copy; <?php echo date('Y'); ?> VICITY CAR</p>
        </div>
    </aside>

    <div class="sidebar-overlay"></div>
    <button class="sidebar-toggle" aria-label="Menu">☰</button>

    <main class="admin-main">

        <div class="page-header">
            <h1>Ajouter une voiture</h1>
        </div>

    <form action="../crud/add_voiture.php" method="POST" enctype="multipart/form-data">

        <label>Marque :</label><br>

        <select name="id_marque" required>
            <option value="">Choisir une marque</option>

            <?php while($marque = $marques->fetch(PDO::FETCH_ASSOC)) { ?> //loop for all brands

                <option value="<?php echo $marque['id_marque']; ?>"> 
                    <?php echo $marque['nom_marque']; ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label>Modèle :</label><br>
        <input type="text" name="modele" required>

        <br><br>

        <label>Carburant :</label><br>

        <select name="carburant" required>
            <option value="">Choisir</option>
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
            <option value="Hybride">Hybride</option>
            <option value="Electrique">Electrique</option>
        </select>

        <br><br>

        <label>Transmission :</label><br>

        <select name="transmission" required>
            <option value="">Choisir</option>
            <option value="Manuelle">Manuelle</option>
            <option value="Automatique">Automatique</option>
        </select>

        <br><br>

        <label>Prix :</label><br>
        <input type="number" step="0.01" name="prix" required>

        <br><br>

        <label>Disponibilité :</label><br>

        <select name="disponibilite" required>
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>

        <br><br>

        <label>Photo voiture :</label><br>  
        <input type="file" name="image" required>

        <br><br>

        <button type="submit">
            Ajouter
        </button>

    </form>

    </main>

    <script src="../assets/js/agency.js"></script>

    </body>
    </html>