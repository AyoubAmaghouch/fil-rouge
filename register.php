<?php
$page_css = "assets/css/register.css";
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-register-page">

    <div class="vc-register-container">

        <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="vc-flash-notification">
            <span class="vc-flash-icon">⏳</span>
            <span class="vc-flash-text"><?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?></span>
        </div>
        <?php endif; ?>

        <!-- ===== DECORATIVE GLOW ===== -->

        <div class="vc-register-glow"></div>

        <!-- ===== REGISTER CARD ===== -->

        <div class="vc-register-card">

            <div class="vc-register-header">
                <h2>Inscription Agence</h2>
                <p>Rejoignez la plateforme VICITY CAR</p>
            </div>

            <form action="crud/add_agence.php" method="POST" enctype="multipart/form-data" class="vc-register-form">

                <div class="vc-form-row">
                    <div class="vc-form-group">
                        <label for="nom_agence">
                            <i class="bi bi-building"></i> Nom Agence
                        </label>
                        <input type="text" id="nom_agence" name="nom_agence" placeholder="Nom de votre agence" required>
                    </div>
                </div>

                <div class="vc-form-row vc-form-row-2col">
                    <div class="vc-form-group">
                        <label for="email">
                            <i class="bi bi-envelope-fill"></i> Email
                        </label>
                        <input type="email" id="email" name="email" placeholder="votre@email.com" required>
                    </div>

                    <div class="vc-form-group">
                        <label for="telephone">
                            <i class="bi bi-telephone-fill"></i> Téléphone
                        </label>
                        <input type="text" id="telephone" name="telephone" placeholder="0600000000" required>
                    </div>
                </div>

                <div class="vc-form-row vc-form-row-2col">
                    <div class="vc-form-group">
                        <label for="whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </label>
                        <input type="text" id="whatsapp" name="whatsapp" placeholder="212612345678" required>
                    </div>

                    <div class="vc-form-group">
                        <label for="ville">
                            <i class="bi bi-geo-alt-fill"></i> Ville
                        </label>
                        <input type="text" id="ville" name="ville" placeholder="Casablanca" required>
                    </div>
                </div>

                <div class="vc-form-group">
                    <label for="localisation">
                        <i class="bi bi-pin-map-fill"></i> Lien Google Maps
                    </label>
                    <input type="url" id="localisation" name="localisation" placeholder="https://maps.google.com/?q=..." required>
                </div>

                <div class="vc-form-group">
                    <label for="mot_de_passe">
                        <i class="bi bi-lock-fill"></i> Mot de passe
                    </label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="••••••••" required>
                </div>

                <div class="vc-form-group">
                    <label for="logo">
                        <i class="bi bi-image"></i> Logo de l'agence
                    </label>
                    <input type="file" id="logo" name="logo" accept="image/*" required>
                </div>

                <button type="submit" class="vc-register-btn">
                    <i class="bi bi-person-plus-fill"></i>
                    S'inscrire
                </button>

            </form>

            <div class="vc-register-footer">
                <p>
                    Déjà inscrit ?
                    <a href="login.php">Se connecter</a>
                </p>
            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
