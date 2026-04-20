<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salmenta-baldintzak – EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="orri-goiburua">
    <span class="ikurra">📋</span>
    <h1>Salmenta-baldintzak</h1>
    <p>Online erosketaren arauak eta baldintzak</p>
</div>

<div class="legal-orria">

    <p class="legal-data" style="text-align:center; color:#999; margin-bottom:2.5rem;">Azken eguneraketa: 2026ko urtarrilak 1</p>

    <div class="legal-atala">
        <h2>1. Aplikazio Eremua</h2>
        <p>Salmenta-baldintza hauek EuskoPizza S.L.ren web gunearen bidez egindako erosketa guztiei aplikatzen zaizkie. Eskaera bat egiteak baldintza hauen onarpena suposatzen du.</p>
    </div>

    <div class="legal-atala">
        <h2>2. Produktuak eta Prezioak</h2>
        <ul>
            <li>Katalogoan agertzen diren prezioak BEZarekin (10%) adierazita daude.</li>
            <li>EuskoPizzak prezioak aldatzeko eskubidea gordetzen du aurretiaz jakinarazpenik gabe, beti eskaera baieztatu aurretik.</li>
            <li>Produktuen argazkiak orientagarriak dira. Benetako itxuran ñabardura txikiak egon daitezke.</li>
            <li>Produktuen eskuragarritasuna errealean egiaztatzen da. Eskuragaitz bada, bezeroa abisatuko da.</li>
        </ul>
    </div>

    <div class="legal-atala">
        <h2>3. Erosketa Prozesua</h2>
        <p>Online erosketa prozesuak urrats hauek ditu:</p>
        <ul>
            <li><strong>1. Hautaketa:</strong> Produktuak karritora gehitu.</li>
            <li><strong>2. Erregistroa:</strong> Kontu bat sortu edo saioa hasi.</li>
            <li><strong>3. Helbidea:</strong> Entrega helbidea egiaztatu.</li>
            <li><strong>4. Ordainketa:</strong> Eskaera baieztatu eta ordaindu.</li>
            <li><strong>5. Berrespena:</strong> Berreste mezu bat jasoko duzu.</li>
        </ul>
    </div>

    <div class="legal-atala">
        <h2>4. Entrega Baldintzak</h2>
        <ul>
            <li>Entrega denbora: <strong>20-35 minutu</strong> batez beste, helbidearen arabera.</li>
            <li>Entrega eremua: Bilbo, Donostia eta Gasteizko hiri barruak.</li>
            <li>Gutxieneko eskaera: <strong>10 €</strong>.</li>
            <li>Entrega kostua: <strong>2,50 €</strong> (25 €-tik gora, doan).</li>
            <li>Ordutegia: Astelehenetik ostiralera 12:00-23:00, larunbatean eta igandean 12:00-00:00.</li>
        </ul>
    </div>

    <div class="legal-atala">
        <h2>5. Ordainketa</h2>
        <p>Eskaerak webeko sistemaren bidez ordaintzen dira. Puntu sistema ere onartzen da erregistratutako erabiltzaileentzat. Ordainketa egitean, datuak SSL zifratzez babestuta daude.</p>
    </div>

    <div class="legal-atala">
        <h2>6. Berrespen eta Baliogabetzea</h2>
        <p>Eskaerak prestatzen hasi aurretik (normalean 5 minutu), bezeroek berriz dei dezakete baliogabetzeko: <strong>+34 944 00 00 00</strong>. Sukaldean dagoenean, ezinezkoa da aldatzea.</p>
    </div>

    <div class="legal-atala">
        <h2>7. Elikadura Alergiak</h2>
        <p>Produktuak glutenarekin, laktosearekin, fruitu lehorrak eta beste alergenoekin kontaktuan egon daitezke. Alergiarik baduzu, eskaera baino lehen gurekin harremanetan jar zaitez.</p>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
