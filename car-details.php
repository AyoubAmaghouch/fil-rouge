<?php

$page_css = "assets/css/car-details.css";
require_once 'config/db.php';

if (!isset($_GET['id'])) {
    die("Voiture introuvable");
}

$id = $_GET['id'];

$sql = "SELECT voitures.*,
               marques.nom_marque,
               agences.nom_agence,
               agences.telephone,
               agences.ville,
               agences.id_agence,
               images_voitures.image

        FROM voitures

        INNER JOIN marques
        ON voitures.id_marque = marques.id_marque

        INNER JOIN agences
        ON voitures.id_agence = agences.id_agence

        LEFT JOIN images_voitures
        ON voitures.id_voiture = images_voitures.id_voiture

        WHERE voitures.id_voiture = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    die("Voiture introuvable");
}

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-cd-page">

    <!-- ===== PAGE BANNER ===== -->

    <section class="vc-cd-banner">
        <h1>
            <?php echo htmlspecialchars($voiture['nom_marque']); ?>
            <?php echo htmlspecialchars($voiture['modele']); ?>
        </h1>
    </section>

    <div class="vc-cd-container container">

        <div class="row g-4">

            <!-- ===== LEFT COLUMN: IMAGE + INFO ===== -->

            <div class="col-lg-8">

                <!-- Image Gallery -->
                <div class="vc-cd-gallery">
                    <img
                        src="assets/images/voitures/<?php echo !empty($voiture['image']) ? htmlspecialchars($voiture['image']) : 'default.jpg'; ?>"
                        alt="<?php echo htmlspecialchars($voiture['nom_marque'] . ' ' . $voiture['modele']); ?>"
                        class="vc-cd-main-img"
                    >
                    <?php if($voiture['disponibilite'] == 1) { ?>
                        <span class="vc-cd-badge vc-cd-badge-dispo">Disponible</span>
                    <?php } else { ?>
                        <span class="vc-cd-badge vc-cd-badge-indispo">Indisponible</span>
                    <?php } ?>
                </div>

                <!-- Info Card -->
                <div class="vc-cd-info-card">

                    <h2 class="vc-cd-info-title">Informations du véhicule</h2>

                    <div class="vc-cd-info-grid">

                        <div class="vc-cd-info-item">
                            <i class="bi bi-car-front-fill"></i>
                            <span class="vc-cd-info-label">Marque</span>
                            <span class="vc-cd-info-value"><?php echo htmlspecialchars($voiture['nom_marque']); ?></span>
                        </div>

                        <div class="vc-cd-info-item">
                            <i class="bi bi-bookmark-fill"></i>
                            <span class="vc-cd-info-label">Modèle</span>
                            <span class="vc-cd-info-value"><?php echo htmlspecialchars($voiture['modele']); ?></span>
                        </div>

                        <div class="vc-cd-info-item">
                            <i class="bi bi-fuel-pump-fill"></i>
                            <span class="vc-cd-info-label">Carburant</span>
                            <span class="vc-cd-info-value"><?php echo htmlspecialchars($voiture['carburant']); ?></span>
                        </div>

                        <div class="vc-cd-info-item">
                            <i class="bi bi-gear-wide-connected"></i>
                            <span class="vc-cd-info-label">Transmission</span>
                            <span class="vc-cd-info-value"><?php echo htmlspecialchars($voiture['transmission']); ?></span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- ===== RIGHT COLUMN: PRICE + AGENCY ===== -->

            <div class="col-lg-4">

                <!-- Price Card -->
                <div class="vc-cd-price-card">

                    <div class="vc-cd-price-header">
                        <span class="vc-cd-price-label">PRIX PAR JOUR</span>
                        <div class="vc-cd-price-value">
                            <span class="vc-cd-price-number"><?php echo number_format($voiture['prix'], 0, ',', ' '); ?></span>
                            <span class="vc-cd-price-unit">DH</span>
                        </div>
                    </div>

                </div>

                <!-- Agency Card -->
                <div class="vc-cd-agency-card">

                    <h3 class="vc-cd-agency-title">Agence</h3>

                    <div class="vc-cd-agency-info">
                        <div class="vc-cd-agency-row">
                            <i class="bi bi-building"></i>
                            <div>
                                <span class="vc-cd-agency-label">Nom</span>
                                <span class="vc-cd-agency-value"><?php echo htmlspecialchars($voiture['nom_agence']); ?></span>
                            </div>
                        </div>

                        <div class="vc-cd-agency-row">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <span class="vc-cd-agency-label">Ville</span>
                                <span class="vc-cd-agency-value"><?php echo htmlspecialchars($voiture['ville']); ?></span>
                            </div>
                        </div>

                        <div class="vc-cd-agency-row">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <span class="vc-cd-agency-label">Téléphone</span>
                                <span class="vc-cd-agency-value"><?php echo htmlspecialchars($voiture['telephone']); ?></span>
                            </div>
                        </div>
                    </div>

                    <a href="agence-details.php?id=<?php echo $voiture['id_agence']; ?>" class="vc-cd-agency-link">
                        Voir l'agence
                        <span class="vc-cd-arrow">→</span>
                    </a>

                </div>

                <!-- Back Link -->
                <a href="cars.php" class="vc-cd-back-link">
                    <i class="bi bi-arrow-left"></i>
                    Retour aux voitures
                </a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
