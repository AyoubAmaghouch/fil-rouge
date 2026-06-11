<nav class="navbar navbar-expand-lg vc-navbar">

    <div class="container-fluid px-4 px-lg-5">

        <!-- Logo far left -->
        <a class="navbar-brand vc-logo" href="index.php">
            <span class="vc-logo-text">VICITY CAR</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler vc-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Centered Navigation Links -->
            <ul class="navbar-nav mx-auto vc-nav">

                <li class="nav-item">
                    <a class="nav-link vc-link<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? ' active' : ''; ?>" href="index.php">
                        <i class="vc-dot"></i> Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link vc-link<?php echo (basename($_SERVER['PHP_SELF']) == 'cars.php') ? ' active' : ''; ?>" href="cars.php">
                        <i class="vc-dot"></i> Voitures
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link vc-link<?php echo (basename($_SERVER['PHP_SELF']) == 'agences.php') ? ' active' : ''; ?>" href="agences.php">
                        <i class="vc-dot"></i> Agences
                    </a>
                </li>

            </ul>

            <!-- Right Side: Auth -->
            <div class="vc-auth">
                <?php if(isset($_SESSION['id_agence'])) { ?>

                    <a href="agency/dashboard.php" class="vc-agency-link" title="Dashboard">
                        <img
                            src="assets/images/agences/<?php echo $_SESSION['logo_agence']; ?>"
                            alt="Logo Agence"
                            class="vc-agency-logo"
                        >
                    </a>

                <?php } else { ?>

                    <a class="vc-connexion-btn" href="login.php">
                        Connexion
                    </a>

                <?php } ?>
            </div>

        </div>

    </div>

</nav>