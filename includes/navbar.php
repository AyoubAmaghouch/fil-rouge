<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand logo" href="index.php">
            VICITY CAR
        </a>

        <!-- Mobile Button -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- Menu -->
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="cars.php">
                        Voitures
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="agences.php">
                        Agences
                    </a>
                </li>

            </ul>

            <!-- Connexion ou Logo Agence -->
            <?php if(isset($_SESSION['id_agence'])) { ?>

                <a href="agency/dashboard.php">
                    <img
                    src="assets/images/agences/<?php echo $_SESSION['logo_agence']; ?>"
                    alt="Logo Agence"
                    width="50"
                    height="50"
                    style="border-radius:50%; object-fit:cover;">
                </a>

            <?php } else { ?>

                <a class="register-btn" href="login.php">
                    Connexion
                </a>

            <?php } ?>

        </div>

    </div>
</nav>

<!-- ===== FIN NAVBAR ===== -->