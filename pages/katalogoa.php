<?php
session_start();
include "../includes/konexioa.php";

$bilaketa = trim($_GET['keywords'] ?? '');

if ($bilaketa !== '') {
    $stmt = $conn->prepare("SELECT * FROM pizzak WHERE izena LIKE ? OR ingredienteak LIKE ? OR mota LIKE ?");
    $like = "%" . $bilaketa . "%";
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM pizzak");
}

$pizzak = [];
while ($row = $result->fetch_assoc()) {
    $pizzak[] = $row;
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Katalogoa - EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleKatalogoa.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>

<body>

<?php include '../includes/navbar.php'; ?>

<div class="katalogo-edukia">

    <div class="katalogo-burua">
        <h1>Gure Pizzak</h1>
        <?php if ($bilaketa !== ''): ?>
            <p>"<?= htmlspecialchars($bilaketa) ?>" bilaketaren emaitzak: <?= count($pizzak) ?> pizza aurkitu</p>
        <?php else: ?>
            <p>Tokiko osagaiekin egindako pizzarik onenak</p>
        <?php endif; ?>
    </div>

    <div class="iragazkiak">
        <button onclick="iragazi('guztiak')" class="aktibo">Guztiak</button>
        <button onclick="iragazi('Klasikoa')">Klasikoak</button>
        <button onclick="iragazi('Premium')">Premium</button>
        <button onclick="iragazi('Berezi')">Berezia</button>
        <button onclick="iragazi('Barazki')">Beganoa</button>
        <button onclick="iragazi('Euskal')">Euskal</button>
        <button onclick="iragazi('Amerikar')">Amerikar</button>
    </div>

    <div class="produktuen-sarea" id="sarea">

        <?php foreach ($pizzak as $p): ?>
            <div class="produktu-txartela" data-mota="<?= $p['mota'] ?>">

                
                <div class="irudia">
                    <img src="../argazkiak/produktu_argakiak/<?= htmlspecialchars($p['argazkiak'] ?? '') ?>" alt="<?= htmlspecialchars($p['izena']) ?>">
                </div>


                <div class="infoa">
                    <h3><?= htmlspecialchars($p['izena']) ?></h3>
                    <p><?= htmlspecialchars($p['ingredienteak']) ?></p>
                    <strong><?= number_format($p['prezioa'], 2) ?>€</strong>

                    <div class="botoiak">
                        <form action="karritoa.php" method="POST">
                            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                            <input type="hidden" name="izena" value="<?= htmlspecialchars($p['izena']) ?>">
                            <input type="hidden" name="prezioa" value="<?= (float)$p['prezioa'] ?>">
                            <button type="submit">Gehitu</button>
                        </form>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
function iragazi(mota) {
    const karta = document.querySelectorAll('.produktu-txartela');
    karta.forEach(k => {
        k.style.display = (mota === 'guztiak' || k.dataset.mota === mota)
            ? 'flex' : 'none';
    });
}

function karritora(id, izena) {
    alert("Gehituta: " + izena);
}

function xehetasunak(id) {
    alert("Pizza #" + id + " - Xehetasunak");
}
</script>

</body>
</html>