<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuskoPizza</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <div class="nav">
            <div class="nav-top">
                <a href="index.php" class="nav-logo">
                    <img src="argazkiak/EuskoPizza(LOGOA).png" alt="EuskoPizza">
                </a>
            </div>

            <form action="katalogoa.php" method="GET" class="bilatzailea">
                <input type="text" name="keywords" placeholder="Bilatu produktuak...">
                <button type="submit">BILATU</button>
            </form>

            <div class="nav-links">
                <a href="katalogoa.php">KATALOGOA</a>
                <a href="login.php">HASI SAIO</a>
                <a href="karritoa.php" class="nav-saskia">
                    <img src="argazkiak/saskia.png" alt="Saskia" class="saskia-img">
                </a>
            </div>
        </div>
    </nav>

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

    <footer>
        <p> &copy 2024 EuskoPizza. Uraren baimena gordeta </p>
    </footer>

</body>
</html>