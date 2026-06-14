<?php
session_start();
$page_css = "assets/css/index.css";
require_once 'config/db.php';

// Fetch the latest 6 available cars
$sql_cars = "SELECT v.id_voiture, v.modele, v.prix,
                    m.nom_marque,
                    (SELECT image FROM images_voitures WHERE id_voiture = v.id_voiture ORDER BY id_image ASC LIMIT 1) AS image
             FROM voitures v
             INNER JOIN marques m ON v.id_marque = m.id_marque
             INNER JOIN agences a ON v.id_agence = a.id_agence
             WHERE a.statut_validation = 1
               AND v.disponibilite = 1
             ORDER BY v.id_voiture DESC
             LIMIT 6";

$voitures_home = $pdo->query($sql_cars)->fetchAll(PDO::FETCH_ASSOC);

// Fetch validated agencies for homepage
$sql_agences = "SELECT id_agence, nom_agence, ville, logo, telephone
                FROM agences
                WHERE statut_validation = 1
                ORDER BY id_agence DESC
                LIMIT 3";

$agences_home = $pdo->query($sql_agences)->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- ===== HERO SECTION ===== -->

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <h1>
                LOUEZ LA VOITURE <br>
                DE VOS RÊVES
            </h1>

            <p>
                Découvrez les meilleures voitures proposées
                par des agences fiables partout au Maroc.
            </p>

            <a href="cars.php" class="hero-btn">
                Voir les voitures
            </a>

        </div>

    </div>

</section>

<!-- ===== ABOUT US SECTION ===== -->

<section class="vc-about-section">

    <div class="container">

        <div class="vc-about-inner">

            <!-- Decorative glow -->
            <div class="vc-about-glow"></div>

            <!-- Section Header -->
            <div class="vc-section-header text-center mb-4">
                <span class="vc-section-tag">À PROPOS</span>
                <h2 class="vc-section-title">Qui Sommes-Nous ?</h2>
                <div class="vc-title-line"></div>
            </div>

            <!-- Elegant Description -->
            <div class="vc-about-intro text-center">
                <p class="vc-about-lead">
                    <strong>VICITY CAR</strong> est une plateforme digitale qui connecte les agences
                    de location de voitures avec les clients à travers tout le Maroc.
                    Nous offrons aux agences une vitrine en ligne pour présenter leurs véhicules
                    et gagner en visibilité, sans avoir besoin d'un local physique.
                </p>
                <p class="vc-about-text">
                    Pour les clients, VICITY CAR centralise toutes les offres de location
                    sur une seule plateforme moderne et intuitive. Parcourez les véhicules
                    de plusieurs agences, comparez les options et trouvez la voiture idéale
                    en quelques clics — un gain de temps considérable pour votre prochaine location.
                </p>
            </div>

            <!-- Features -->
            <div class="vc-about-features">
                <div class="vc-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Agences de location vérifiées et approuvées</span>
                </div>
                <div class="vc-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Toutes les offres réunies en un seul endroit</span>
                </div>
                <div class="vc-feature">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Mise en relation directe avec les agences</span>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-5">
                <a href="cars.php" class="vc-view-all-btn">
                    Explorer nos voitures
                    <span class="vc-btn-arrow">→</span>
                </a>
            </div>

        </div>

    </div>

</section>

<!-- ===== FIN ABOUT US SECTION ===== -->


<!-- ===== SERVICES SECTION ===== -->

<section class="vc-services-section">

    <div class="container">

        <!-- Section Header -->
        <div class="vc-section-header text-center mb-5">
            <span class="vc-section-tag">POURQUOI NOUS</span>
            <h2 class="vc-section-title">Nos Services</h2>
            <p class="vc-section-subtitle">
                La plateforme qui connecte agences et clients
            </p>
            <div class="vc-title-line"></div>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">

            <!-- Service 1 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="vc-service-card">
                    <div class="vc-service-icon-wrap vc-icon-cyan">
                        <i class="bi bi-car-front-fill"></i>
                    </div>
                    <h4 class="vc-service-title">Visibilité pour les agences</h4>
                    <p class="vc-service-desc">
                        Permettez aux agences de location de présenter leurs véhicules en ligne et d'atteindre davantage de clients sans avoir besoin d'un local physique.
                    </p>
                    <div class="vc-service-line"></div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="vc-service-card">
                    <div class="vc-service-icon-wrap vc-icon-pink">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="vc-service-title">Toutes les voitures au même endroit</h4>
                    <p class="vc-service-desc">
                        Consultez les offres de plusieurs agences depuis une seule plateforme et comparez facilement les véhicules disponibles.
                    </p>
                    <div class="vc-service-line"></div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="vc-service-card">
                    <div class="vc-service-icon-wrap vc-icon-cyan">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h4 class="vc-service-title">Recherche rapide et simplifiée</h4>
                    <p class="vc-service-desc">
                        Trouvez rapidement la voiture adaptée à vos besoins grâce à une plateforme centralisée, moderne et facile à utiliser.
                    </p>
                    <div class="vc-service-line"></div>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- ===== FIN SERVICES SECTION ===== -->


<!-- ===== AGENCIES SECTION ===== -->

<section class="vc-agencies-section">

    <div class="container">

        <!-- Section Header -->
        <div class="vc-section-header text-center mb-5">
            <span class="vc-section-tag">NOS PARTENAIRES</span>
            <h2 class="vc-section-title">Nos Agences</h2>
            <p class="vc-section-subtitle">
                Des agences de confiance partout au Maroc
            </p>
            <div class="vc-title-line"></div>
        </div>

        <!-- Agencies Grid -->
        <div class="row g-4">

            <?php if(!empty($agences_home)) { ?>

                <?php foreach($agences_home as $agence) { ?>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="vc-agency-card">
                            <div class="vc-agency-logo-wrap">
                                <img
                                    src="assets/images/agences/<?php echo htmlspecialchars($agence['logo']); ?>"
                                    alt="<?php echo htmlspecialchars($agence['nom_agence']); ?>"
                                    class="vc-agency-img"
                                >
                            </div>
                            <div class="vc-agency-body">
                                <h5 class="vc-agency-name"><?php echo htmlspecialchars($agence['nom_agence']); ?></h5>
                                <div class="vc-agency-meta">
                                    <span class="vc-agency-city">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <?php echo htmlspecialchars($agence['ville']); ?>
                                    </span>
                                    <span class="vc-agency-phone">
                                        <i class="bi bi-telephone-fill"></i>
                                        <?php echo htmlspecialchars($agence['telephone']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col-12 text-center py-5">
                    <p class="vc-no-cars">Aucune agence disponible pour le moment.</p>
                </div>

            <?php } ?>

        </div>

        <!-- View All Agencies -->
        <div class="text-center mt-5">
            <a href="agences.php" class="vc-view-all-btn">
                Voir toutes les agences
                <span class="vc-btn-arrow">→</span>
            </a>
        </div>

    </div>

</section>

<!-- ===== FIN AGENCIES SECTION ===== -->


<!-- ===== NOS VOITURES SECTION ===== -->

<section class="vc-cars-section">

    <div class="container">

        <!-- Section Header -->
        <div class="vc-section-header text-center mb-5">
            <span class="vc-section-tag">NOTRE FLOTTE</span>
            <h2 class="vc-section-title">Nos Voitures</h2>
            <p class="vc-section-subtitle">
                Découvrez notre sélection de véhicules premium disponibles à la location
            </p>
            <div class="vc-title-line"></div>
        </div>

        <!-- Cars Grid -->
        <div class="row g-4">

            <?php if(!empty($voitures_home)) { ?>

                <?php foreach($voitures_home as $car) { ?>

                    <div class="col-lg-4 col-md-6 col-sm-12">

                        <div class="vc-car-card">

                            <!-- Image -->
                            <div class="vc-car-img-wrap">
                                <img
                                    src="assets/images/voitures/<?php echo !empty($car['image']) ? htmlspecialchars($car['image']) : 'default.jpg'; ?>"
                                    alt="<?php echo htmlspecialchars($car['nom_marque'] . ' ' . $car['modele']); ?>"
                                    class="vc-car-img"
                                >
                                <div class="vc-car-img-overlay"></div>
                                <span class="vc-car-badge">Disponible</span>
                            </div>

                            <!-- Body -->
                            <div class="vc-car-body">

                                <div class="vc-car-brand"><?php echo htmlspecialchars($car['nom_marque']); ?></div>
                                <h5 class="vc-car-model"><?php echo htmlspecialchars($car['modele']); ?></h5>

                                <div class="vc-car-footer">
                                    <div class="vc-car-price">
                                        <span class="vc-price-value"><?php echo number_format($car['prix'], 0, ',', ' '); ?></span>
                                        <span class="vc-price-unit">DH / Jour</span>
                                    </div>
                                    <a href="car-details.php?id=<?php echo $car['id_voiture']; ?>" class="vc-car-btn">
                                        Voir détails
                                        <span class="vc-btn-arrow">→</span>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col-12 text-center py-5">
                    <p class="vc-no-cars">Aucune voiture disponible pour le moment.</p>
                </div>

            <?php } ?>

        </div>

        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="cars.php" class="vc-view-all-btn">
                Voir toutes les voitures
                <span class="vc-btn-arrow">→</span>
            </a>
        </div>

    </div>

</section>

<!-- ===== FIN NOS VOITURES SECTION ===== -->


<?php include 'includes/footer.php'; ?>