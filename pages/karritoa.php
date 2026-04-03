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

<div class="karrito-edukia">

<?php include '../includes/navbar.php'; ?>

<h1>Zure Karritoa</h1>

<?php if (empty($_SESSION['karrito'])): ?>

    <p>Karritoa hutsik dago.</p>

<?php else: ?>

    <?php
    $total = 0;
    foreach($_SESSION['karrito'] as $id => $p):
        $guztira = $p['prezioa'] * $p['kant'];
        $total += $guztira;
    ?>

    <div class="karrito-item">
        <div>
            <h3><?= $p['izena'] ?></h3>
            <p>Kantitatea: <?= $p['kant'] ?></p>
            <strong><?= number_format($guztira,2) ?>€</strong>
        </div>

        <a href="karritoa.php?kendu=<?= $id ?>">
            <button class="kendu-btn">Kendu</button>
        </a>
    </div>

    <?php endforeach; ?>

    <p id="totala">Totala: <?= number_format($total, 2) ?> €</p>

    <form action="erosita.php" method="POST">
        <input type="hidden" name="totala" value="<?= $total ?>">
        <button class="erosi-btn">Erosi orain</button>
    </form>

<?php endif; ?>

</div>

</body>
</html>