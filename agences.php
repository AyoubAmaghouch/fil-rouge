<?php

$page_css = "assets/css/agences.css";
require_once 'config/db.php';

/* Récupérer toutes les agences validées */

$sql_agences = "SELECT id_agence, nom_agence, ville, logo, telephone, email, whatsapp, localisation
                FROM agences
                WHERE statut_validation = 1
                ORDER BY id_agence DESC";

$agences = $pdo->query($sql_agences)->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-agences-page">

    <!-- ===== PAGE BANNER ===== -->

    <section class="vc-agences-banner">

        <div class="container">

            <div class="vc-section-header text-center">
                <span class="vc-section-tag">NOS PARTENAIRES</span>
                <h1 class="vc-section-title">Nos Agences</h1>
                <p class="vc-section-subtitle">
                    Des agences de confiance partout au Maroc
                </p>
                <div class="vc-title-line"></div>
            </div>

        </div>

    </section>

    <!-- ===== AGENCIES LISTING SECTION ===== -->

    <section class="vc-agences-listing">

        <div class="container">

            <!-- Results count -->

            <div class="vc-agences-results">
                <span class="vc-agences-count">
                    <?php echo count($agences); ?> agence<?php echo count($agences) > 1 ? 's' : ''; ?> partenaire<?php echo count($agences) > 1 ? 's' : ''; ?>
                </span>
            </div>

            <?php if(!empty($agences)) { ?>

                <!-- Agencies Grid — same Bootstrap grid as index.php -->

                <div class="row g-4">

                    <?php foreach($agences as $agence) { ?>

                        <div class="col-lg-4 col-md-6 col-sm-12">

                            <a href="agence-details.php?id=<?php echo $agence['id_agence']; ?>" class="vc-agency-link-card">

                                <div class="vc-agency-card">

                                    <!-- Logo -->
                                    <div class="vc-agency-logo-wrap">
                                        <img
                                            src="assets/images/agences/<?php echo htmlspecialchars($agence['logo']); ?>"
                                            alt="<?php echo htmlspecialchars($agence['nom_agence']); ?>"
                                            class="vc-agency-img"
                                        >
                                    </div>

                                    <!-- Body -->
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

                            </a>

                        </div>

                    <?php } ?>

                </div>

            <?php } else { ?>

                <!-- Empty State -->
                <div class="vc-agences-empty">
                    <i class="bi bi-building vc-agences-empty-icon"></i>
                    <p>Aucune agence disponible pour le moment.</p>
                </div>

            <?php } ?>

        </div>

    </section>

</div>

<?php include 'includes/footer.php'; ?>
