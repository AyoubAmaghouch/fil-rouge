<?php

$page_css = "assets/css/cars.css";
require_once 'config/db.php';

/* Filtres */

$marque = $_GET['marque'] ?? '';
$transmission = $_GET['transmission'] ?? '';
$carburant = $_GET['carburant'] ?? '';
$ville = $_GET['ville'] ?? '';

/* Requête principale */

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence,
               agences.ville,
               images_voitures.image

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence

        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture

        WHERE agences.statut_validation = 1
";
$params = [];

/* Filtre Marque */

if (!empty($marque)) {

    $sql .= " AND marques.nom_marque = ?";
    $params[] = $marque;
}

/* Filtre Transmission */

if (!empty($transmission)) {

    $sql .= " AND voitures.transmission = ?";
    $params[] = $transmission;
}

/* Filtre Carburant */

if (!empty($carburant)) {

    $sql .= " AND voitures.carburant = ?";
    $params[] = $carburant;
}

/* Filtre Ville */

if (!empty($ville)) {

    $sql .= " AND agences.ville = ?";
    $params[] = $ville;
}

/* Exécution */

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Marques */

$marques = $pdo->query("
    SELECT *
    FROM marques
    ORDER BY nom_marque ASC
");

/* Transmissions */

$transmissions = $pdo->query("
    SELECT DISTINCT transmission
    FROM voitures
    ORDER BY transmission ASC
");

/* Carburants */

$carburants = $pdo->query("
    SELECT DISTINCT carburant
    FROM voitures
    ORDER BY carburant ASC
");

/* Villes */

$villes = $pdo->query("
    SELECT DISTINCT ville
    FROM agences
    ORDER BY ville ASC
");

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-cars-page">

    <!-- ===== PAGE BANNER ===== -->

    <section class="vc-cars-banner">

        <div class="container">

            <div class="vc-section-header text-center">
                <span class="vc-section-tag">NOTRE FLOTTE</span>
                <h1 class="vc-section-title">Nos Voitures</h1>
                <p class="vc-section-subtitle">
                    Découvrez notre sélection de véhicules premium disponibles à la location
                </p>
                <div class="vc-title-line"></div>
            </div>

        </div>

    </section>

    <!-- ===== FILTERS ===== -->

    <div class="container">

        <form method="GET" action="cars.php" class="vc-cars-filters">

            <select name="marque">
                <option value="">Toutes les marques</option>
                <?php while($m = $marques->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option
                        value="<?php echo $m['nom_marque']; ?>"
                        <?php if($marque == $m['nom_marque']) echo "selected"; ?>
                    >
                        <?php echo $m['nom_marque']; ?>
                    </option>
                <?php } ?>
            </select>

            <select name="transmission">
                <option value="">Toutes les transmissions</option>
                <?php while($t = $transmissions->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option
                        value="<?php echo $t['transmission']; ?>"
                        <?php if($transmission == $t['transmission']) echo "selected"; ?>
                    >
                        <?php echo $t['transmission']; ?>
                    </option>
                <?php } ?>
            </select>

            <select name="carburant">
                <option value="">Tous les carburants</option>
                <?php while($c = $carburants->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option
                        value="<?php echo $c['carburant']; ?>"
                        <?php if($carburant == $c['carburant']) echo "selected"; ?>
                    >
                        <?php echo $c['carburant']; ?>
                    </option>
                <?php } ?>
            </select>

            <select name="ville">
                <option value="">Toutes les villes</option>
                <?php while($v = $villes->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option
                        value="<?php echo $v['ville']; ?>"
                        <?php if($ville == $v['ville']) echo "selected"; ?>
                    >
                        <?php echo $v['ville']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" class="vc-filter-btn">
                <i class="bi bi-funnel-fill"></i> Filtrer
            </button>

            <a href="cars.php" class="vc-reset-btn">
                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
            </a>

        </form>

    </div>

    <!-- ===== CARS LISTING SECTION ===== -->

    <section class="vc-cars-listing">

        <div class="container">

            <!-- Results count -->

            <div class="vc-cars-results">
                <span class="vc-cars-count">
                    <?php echo count($voitures); ?> véhicule<?php echo count($voitures) > 1 ? 's' : ''; ?> trouvé<?php echo count($voitures) > 1 ? 's' : ''; ?>
                </span>
            </div>

            <?php if(!empty($voitures)) { ?>

                <!-- Cars Grid — same Bootstrap grid as index.php -->

                <div class="row g-4">

                    <?php foreach($voitures as $voiture) { ?>

                        <div class="col-lg-4 col-md-6 col-sm-12">

                            <div class="vc-car-card">

                                <!-- Image -->
                                <div class="vc-car-img-wrap">
                                    <img
                                        src="assets/images/voitures/<?php echo !empty($voiture['image']) ? htmlspecialchars($voiture['image']) : 'default.jpg'; ?>"
                                        alt="<?php echo htmlspecialchars($voiture['nom_marque'] . ' ' . $voiture['modele']); ?>"
                                        class="vc-car-img"
                                    >
                                    <div class="vc-car-img-overlay"></div>

                                    <?php if($voiture['disponibilite'] == 1) { ?>
                                        <span class="vc-car-badge vc-badge-dispo">Disponible</span>
                                    <?php } else { ?>
                                        <span class="vc-car-badge vc-badge-indispo">Indisponible</span>
                                    <?php } ?>
                                </div>

                                <!-- Body -->
                                <div class="vc-car-body">

                                    <div class="vc-car-brand"><?php echo htmlspecialchars($voiture['nom_marque']); ?></div>
                                    <h5 class="vc-car-model"><?php echo htmlspecialchars($voiture['modele']); ?></h5>

                                    <!-- Info rows -->
                                    <div class="vc-car-meta-list">
                                        <span class="vc-car-meta-item">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <?php echo htmlspecialchars($voiture['ville']); ?>
                                        </span>
                                        <span class="vc-car-meta-item">
                                            <i class="bi bi-fuel-pump-fill"></i>
                                            <?php echo htmlspecialchars($voiture['carburant']); ?>
                                        </span>
                                        <span class="vc-car-meta-item">
                                            <i class="bi bi-gear-wide-connected"></i>
                                            <?php echo htmlspecialchars($voiture['transmission']); ?>
                                        </span>
                                    </div>

                                    <!-- Footer — same structure as index.php -->
                                    <div class="vc-car-footer">
                                        <div class="vc-car-price">
                                            <span class="vc-price-value"><?php echo number_format($voiture['prix'], 0, ',', ' '); ?></span>
                                            <span class="vc-price-unit">DH / Jour</span>
                                        </div>
                                        <a href="car-details.php?id=<?php echo $voiture['id_voiture']; ?>" class="vc-car-btn">
                                            Voir détails
                                            <span class="vc-btn-arrow">&rarr;</span>
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            <?php } else { ?>

                <!-- Empty State -->
                <div class="vc-cars-empty">
                    <i class="bi bi-car-front-fill vc-cars-empty-icon"></i>
                    <p>Aucune voiture ne correspond à vos critères.</p>
                    <a href="cars.php" class="vc-view-all-btn">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Réinitialiser les filtres
                    </a>
                </div>

            <?php } ?>

        </div>

    </section>

</div>

<?php include 'includes/footer.php'; ?>
