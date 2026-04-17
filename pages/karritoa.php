<?php
session_start();

if (!isset($_SESSION['karrito'])) {
    $_SESSION['karrito'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $izena = $_POST['izena'];
    $prezioa = $_POST['prezioa'];

    if (isset($_SESSION['karrito'][$id])) {
        $_SESSION['karrito'][$id]['kant']++;
    } else {
        $_SESSION['karrito'][$id] = [
            "izena" => $izena,
            "prezioa" => $prezioa,
            "kant" => 1
        ];
    }
}

if (isset($_GET['kendu'])) {
    unset($_SESSION['karrito'][$_GET['kendu']]);
}

if (isset($_GET['hustu'])) {
    $_SESSION['karrito'] = [];
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Karritoa - EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleKarritoa.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="karrito-edukia">
    <h1>Zure Karritoa</h1>

    <?php if (empty($_SESSION['karrito'])): ?>
        <p class="karrito-hutsik">Karritoa hutsik dago</p>
    <?php else: ?>
        <div class="karrito-taula">
            <?php
            $total = 0;
            foreach($_SESSION['karrito'] as $id => $p):
                $guztira = $p['prezioa'] * $p['kant'];
                $total += $guztira;
            ?>
                <div class="karrito-item">
                    <div class="item-info">
                        <h3><?= $p['izena'] ?></h3>
                        <p>Kantitatea: <strong><?= $p['kant'] ?></strong></p>
                    </div>
                    <div class="item-prezioa">
                        <p class="prezioa-unitaria"><?= number_format($p['prezioa'], 2) ?> €</p>
                        <p class="prezioa-total"><strong><?= number_format($guztira, 2) ?> €</strong></p>
                    </div>
                    <a href="karritoa.php?kendu=<?= $id ?>" class="kendu-btn">Kendu</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="karrito-footer">
            <p class="totala">Totala: <strong><?= number_format($total, 2) ?> €</strong></p>
            
            <div class="botoiak">
                <a href="karritoa.php?hustu=1" class="btn-hustu">Hustu karritoa</a>
                <form action="erosita.php" method="POST">
                    <input type="hidden" name="totala" value="<?= $total ?>">
                    <button class="btn-erosi">Erosi orain</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>