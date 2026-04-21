<?php
session_start();
include '../includes/config_irakurri.php';
?>

<!DOCTYPE html>
<html lang="<?= $cfg['hizkuntza'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($cfg['denda_izena']) ?></title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

    <div class="promo-banner">
        <p class="promo-text">⭐ Probatu gure ofertak 2x1 ostegunetan OSTEGUNLOKO!!! ⭐ Probatu gure ofertak 2x1 ostegunetan OSTEGUNLOKO!!! ⭐</p>
    </div>

    <section class="gorputza">
        <div class="gorputza-content">
            <h1>Ongi etorri EuskoPizza</h1>
            <p>EuskoPizza tokiko osagaiekin egindako pizzak sortzen ditugu, beti freskoak eta bertako zaporearekin. Gure helburua: pizza ona, erraza eta gertukoa.</p>
            <a href="katalogoa.php" class="btn">Ikusi Katalogoa</a>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>

</body>
</html>