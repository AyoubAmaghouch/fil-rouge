<?php
$page_css = "assets/css/login.css";
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="vc-login-page">

    <div class="vc-login-container">

        <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="vc-flash-notification">
            <span class="vc-flash-icon">⏳</span>
            <span class="vc-flash-text"><?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?></span>
        </div>
        <?php endif; ?>

        <!-- ===== DECORATIVE GLOW ===== -->

        <div class="vc-login-glow"></div>

        <!-- ===== LOGIN CARD ===== -->

        <div class="vc-login-card">

            <div class="vc-login-header">
                <h2>Connexion Agence</h2>
                <p>Accédez à votre espace agence</p>
            </div>

            <form action="crud/login_agence.php" method="POST" class="vc-login-form">

                <div class="vc-form-group">
                    <label for="email">
                        <i class="bi bi-envelope-fill"></i> Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" required>
                </div>

                <div class="vc-form-group">
                    <label for="mot_de_passe">
                        <i class="bi bi-lock-fill"></i> Mot de passe
                    </label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="••••••••" required>
                </div>

                <button type="submit" class="vc-login-btn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </button>

            </form>

            <div class="vc-login-footer">
                <p>
                    Pas encore de compte ?
                    <a href="register.php">S'inscrire</a>
                </p>
            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
