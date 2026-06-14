<?php

$page_css = "assets/css/agence-details.css";
require_once 'config/db.php';

if (!isset($_GET['id'])) {
    die("Agence introuvable");
}

$id = $_GET['id'];

/* Récupérer l'agence */

$sql_agence = "SELECT * FROM agences
               WHERE id_agence = ? AND statut_validation = 1";

$stmt = $pdo->prepare($sql_agence);
$stmt->execute([$id]);

$agence = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agence) {
    die("Agence introuvable");
}

/* Récupérer les voitures de l'agence */

$sql_voitures = "SELECT v.*, m.nom_marque,
                        (SELECT image FROM images_voitures WHERE id_voiture = v.id_voiture ORDER BY id_image ASC LIMIT 1) AS image
                 FROM voitures v
                 INNER JOIN marques m ON v.id_marque = m.id_marque
                 WHERE v.id_agence = ?
                 ORDER BY v.id_voiture DESC";

$stmt_v = $pdo->prepare($sql_voitures);
$stmt_v->execute([$id]);

$voitures = $stmt_v->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-ad-page">

    <!-- ===== PAGE BANNER ===== -->

    <section class="vc-ad-banner">
        <h1><?php echo htmlspecialchars($agence['nom_agence']); ?></h1>
        <p class="vc-ad-subtitle">
            <i class="bi bi-geo-alt-fill"></i>
            <?php echo htmlspecialchars($agence['ville']); ?>
        </p>
    </section>

    <div class="vc-ad-container container">

        <div class="row g-4">

            <!-- ===== LEFT COLUMN: AGENCY INFO ===== -->

            <div class="col-lg-4">

                <div class="vc-ad-logo-card">

                    <div class="vc-ad-logo-wrap">
                        <img
                            src="assets/images/agences/<?php echo htmlspecialchars($agence['logo']); ?>"
                            alt="<?php echo htmlspecialchars($agence['nom_agence']); ?>"
                            class="vc-ad-logo-img"
                        >
                    </div>

                    <h2 class="vc-ad-name"><?php echo htmlspecialchars($agence['nom_agence']); ?></h2>

                    <div class="vc-ad-contact-list">

                        <div class="vc-ad-contact-row">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <span class="vc-ad-contact-label">Ville</span>
                                <span class="vc-ad-contact-value"><?php echo htmlspecialchars($agence['ville']); ?></span>
                            </div>
                        </div>

                        <div class="vc-ad-contact-row">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <span class="vc-ad-contact-label">Téléphone</span>
                                <span class="vc-ad-contact-value"><?php echo htmlspecialchars($agence['telephone']); ?></span>
                            </div>
                        </div>

                        <div class="vc-ad-contact-row">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <span class="vc-ad-contact-label">Email</span>
                                <span class="vc-ad-contact-value"><?php echo htmlspecialchars($agence['email']); ?></span>
                            </div>
                        </div>

                        <?php if(!empty($agence['whatsapp'])) { ?>
                        <div class="vc-ad-contact-row">
                            <i class="bi bi-whatsapp"></i>
                            <div>
                                <span class="vc-ad-contact-label">WhatsApp</span>
                                <span class="vc-ad-contact-value"><?php echo htmlspecialchars($agence['whatsapp']); ?></span>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($agence['localisation'])) { ?>
                        <div class="vc-ad-contact-row">
                            <i class="bi bi-pin-map-fill"></i>
                            <div>
                                <span class="vc-ad-contact-label">Localisation</span>
                                <a href="<?php echo htmlspecialchars($agence['localisation']); ?>" target="_blank" class="vc-ad-map-link">
                                    Voir sur Google Maps
                                </a>
                            </div>
                        </div>
                        <?php } ?>

                    </div>

                </div>

            </div>

            <!-- ===== RIGHT COLUMN: VEHICLES ===== -->

            <div class="col-lg-8">

                <h2 class="vc-ad-section-title">
                    Nos Véhicules
                    <span class="vc-ad-count">(<?php echo count($voitures); ?>)</span>
                </h2>

                <?php if(!empty($voitures)) { ?>

                    <div class="vc-ad-cars-grid">

                        <?php foreach($voitures as $voiture) { ?>

                            <div class="vc-ad-car-card">

                                <div class="vc-ad-car-img-wrap">
                                    <img
                                        src="assets/images/voitures/<?php echo !empty($voiture['image']) ? htmlspecialchars($voiture['image']) : 'default.jpg'; ?>"
                                        alt="<?php echo htmlspecialchars($voiture['nom_marque'] . ' ' . $voiture['modele']); ?>"
                                        class="vc-ad-car-img"
                                    >
                                    <?php if($voiture['disponibilite'] == 1) { ?>
                                        <span class="vc-ad-badge vc-ad-badge-dispo">Disponible</span>
                                    <?php } else { ?>
                                        <span class="vc-ad-badge vc-ad-badge-indispo">Indisponible</span>
                                    <?php } ?>
                                </div>

                                <div class="vc-ad-car-body">
                                    <span class="vc-ad-car-brand"><?php echo htmlspecialchars($voiture['nom_marque']); ?></span>
                                    <h4 class="vc-ad-car-model"><?php echo htmlspecialchars($voiture['modele']); ?></h4>

                                    <div class="vc-ad-car-meta">
                                        <span><i class="bi bi-fuel-pump-fill"></i> <?php echo htmlspecialchars($voiture['carburant']); ?></span>
                                        <span><i class="bi bi-gear-wide-connected"></i> <?php echo htmlspecialchars($voiture['transmission']); ?></span>
                                    </div>

                                    <div class="vc-ad-car-footer">
                                        <div class="vc-ad-car-price">
                                            <span class="vc-ad-price-value"><?php echo number_format($voiture['prix'], 0, ',', ' '); ?></span>
                                            <span class="vc-ad-price-unit">DH / Jour</span>
                                        </div>
                                        <a href="car-details.php?id=<?php echo $voiture['id_voiture']; ?>" class="vc-ad-car-btn">
                                            Voir détails
                                        </a>
                                    </div>
                                </div>

                            </div>

                        <?php } ?>

                    </div>

                <?php } else { ?>

                    <div class="vc-ad-empty">
                        <p>Aucun véhicule disponible pour cette agence.</p>
                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
