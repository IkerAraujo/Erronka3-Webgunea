<?php
session_start();
include "../includes/konexioa.php";

$nirePuntuak = 0;

if (isset($_SESSION['user_id'])) {
    $xml = simplexml_load_file("../xml/puntuak.xml");
    foreach ($xml->erabiltzaile as $u) {
        if ((string)$u->id === (string)$_SESSION['user_id']) {
            $nirePuntuak = (int)$u->puntuak;
            break;
        }
    }
}

$sql = "SELECT * FROM puntuPizzak";
$result = $conn->query($sql);

$pizzak = [];
while ($row = $result->fetch_assoc()) {
    $pizzak[] = $row;
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Puntuzko Pizzak</title>
    <link rel="stylesheet" href="../css/stylePuntuPizzak.css">
    <link rel="stylesheet" href="../css/styleSarrera.css">
</head>
<body>

<?php include "../includes/navbar.php"; ?>

<div class="katalogo-edukia">

    <div class="katalogo-burua">
        <h1>Puntuz eros daitezkeen pizzak</h1>
        <p>Zure puntuak: <strong><?= $nirePuntuak ?></strong></p>
    </div>

    <div class="produktuen-sarea-mini">

        <?php foreach ($pizzak as $p): ?>
            <div class="produktu-txartela-mini">

                <div class="irudia-mini">
                    <img src="/EuskoPizza/argazkiak/produktu_argazkiak/<?= $p['argazkiak'] ?>">
                </div>

                <div class="infoa-mini">
                    <h3><?= $p['izena'] ?></h3>
                    <p><?= $p['kostua_puntuetan'] ?> puntu</p>

                    <?php if ($nirePuntuak >= $p['kostua_puntuetan']): ?>
                        <form action="puntuErosi.php" method="POST">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="izena" value="<?= $p['izena'] ?>">
                            <input type="hidden" name="kostua" value="<?= $p['kostua_puntuetan'] ?>">
                            <button class="mini-btn">Erosi puntuekin</button>
                        </form>
                    <?php else: ?>
                        <p class="puntu-gutxi">Puntu gutxi</p>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div>

</body>
</html>