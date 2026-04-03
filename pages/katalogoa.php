<?php
session_start();
include "../includes/konexioa.php";

$sql = "SELECT * FROM pizzak";
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
    <title>Katalogoa - EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleKatalogoa.css">
</head>

<body>

<?php include '../includes/navbar.php'; ?>

<div class="katalogo-edukia">

    <div class="katalogo-burua">
        <h1>Gure Pizzak</h1>
        <p>Tokiko osagaiekin egindako pizzarik onenak</p>
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
                    <img src="/EuskoPizza/argazkiak/produktu_argazkiak/<?= $p['argazkiak'] ?>" 
                    alt="<?= $p['izena'] ?>">
                </div>


                <div class="infoa">
                    <h3><?= $p['izena'] ?></h3>
                    <p><?= $p['ingredienteak'] ?></p>
                    <strong><?= number_format($p['prezioa'], 2) ?>€</strong>

                    <div class="botoiak">
                        <form action="karritoa.php" method="POST">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="izena" value="<?= $p['izena'] ?>">
                            <input type="hidden" name="prezioa" value="<?= $p['prezioa'] ?>">
                            <button type="submit">Gehitu</button>
                        </form>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>

<footer>
    <p>&copy; 2026 EuskoPizza</p>
</footer>

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