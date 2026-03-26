<?php 
session_start();
// include_once "konexioa.php"; 
?>

<!DOCTYPE html>
<html lang="en">
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
                <a href="SARRERA.php" class="nav-logo">
                    <img src="argazkiak/EuskoPizza(LOGOA).png" alt="EuskoPizza">
                </a>
            </div>

            <form action="KATALOGOA.php" method="get" class="bilatzailea">
                <input type="text" name="keywords" placeholder="Bilatu produktuak..." />
                <button type="submit" name="search" value="1">BILATU</button>
            </form>
            <div class="nav-links">
                <a href="KATALOGOA.php">KATALOGOA</a>
                <a href="HASI SAIOA.php">HASI SAIO</a>
                <a href="karritoa.php" class="nav-saskia">
                    <img src="argazkiak/saskia.png" alt="Saskia" class="saskia-img">
                </a>
            </div>

        </div>
    </nav>
    <img src="argazkiak/Baner1.png" alt="" id="Baner1">

    <marquee scrollamount="10" behavior="" direction="" class="texto-movimiento">Probatu gure ofertak 2x1 ostegunetan OSTEGUNLOKO!!!</marquee>

    <div class="intro">
        <h2>Ongi etorri!</h2>
        <p>
        EuskoPizzan tokiko osagaiekin egindako pizzak sortzen ditugu,
        beti freskoak eta bertako zaporearekin. Gure helburua:
        pizza ona, erraza eta gertukoa.
        </p>

        <a href="KATALOGOA.php" class="btn">Ikusi Katalogoa</a>
    </div>

    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script>
    $('.fade').slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
    });
    </script>
</body>
</html>