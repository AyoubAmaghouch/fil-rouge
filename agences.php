<?php

require_once 'config/db.php';

$sql = "SELECT * FROM agences
        WHERE statut_validation = 1";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
include 'includes/navbar.php';

?>

<div class="container mt-5">

    <h1 class="mb-4">
        Nos Agences
    </h1>

    <div class="row">

        <?php foreach($agences as $agence) { ?>

            <div class="col-md-4 mb-4">

                <div class="card h-100">

                    <img
                    src="assets/images/agences/<?php echo $agence['logo']; ?>"
                    class="card-img-top"
                    alt="Logo Agence">

                    <div class="card-body">

                        <h5 class="card-title">
                            <?php echo $agence['nom_agence']; ?>
                        </h5>

                        <p>
                            <strong>Ville :</strong>
                            <?php echo $agence['ville']; ?>
                        </p>

                        <p>
                            <strong>Téléphone :</strong>
                            <?php echo $agence['telephone']; ?>
                        </p>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>