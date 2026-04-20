<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kokapena – EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="orri-goiburua">
    <span class="ikurra">📍</span>
    <h1>Gure Kokapena</h1>
    <p>Bilbo, Donostia eta Gasteizen aurkitu gaitzazu</p>
</div>

<div class="mapa-edukia">

    <!-- BILBO -->
    <h2 style="color:#0f3460; margin-bottom:0.5rem; font-size:1.3rem;">🍕 Bilbo – Nagusia</h2>
    <p style="color:#666; margin-bottom:1rem;">Zazpikale Kalea, 12 – 48005 Bilbo</p>

    <div class="mapa-kontenedora">
        <!-- Google Maps iframe - Bilboko Zazpikale ingurua -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2905.0!2d-2.9253!3d43.2630!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4e4f93cf7a00db%3A0x801e41f81b7c3e06!2sBilbao%20Old%20Town!5e0!3m2!1seu!2ses!4v1700000000000"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="EuskoPizza Bilbo kokapena">
        </iframe>
    </div>

    <div class="mapa-helbidea">
        <div class="mapa-helbidea-item">
            <span class="kit">🏠</span>
            <div>
                <strong>Helbidea</strong>
                <span>Zazpikale Kalea, 12<br>48005 Bilbo, Bizkaia</span>
            </div>
        </div>
        <div class="mapa-helbidea-item">
            <span class="kit">🕐</span>
            <div>
                <strong>Ordutegia</strong>
                <span>Al–Og: 12:00–23:00<br>Lr–Ig: 12:00–00:00</span>
            </div>
        </div>
        <div class="mapa-helbidea-item">
            <span class="kit">🚇</span>
            <div>
                <strong>Garraioa</strong>
                <span>Metro: Casco Viejo<br>Bus: 71, 72, A2</span>
            </div>
        </div>
        <div class="mapa-helbidea-item">
            <span class="kit">📞</span>
            <div>
                <strong>Telefonoa</strong>
                <span>+34 944 00 00 00</span>
            </div>
        </div>
    </div>

    <!-- DONOSTIA -->
    <h2 style="color:#0f3460; margin: 3rem 0 0.5rem; font-size:1.3rem;">🍕 Donostia</h2>
    <p style="color:#666; margin-bottom:1rem;">Nagusia Kalea, 5 – 20003 Donostia-San Sebastián</p>

    <div class="mapa-kontenedora">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11659.0!2d-1.9761!3d43.3183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51afa2bc2c29c5%3A0x80070b3d3d8c7d4!2sParte%20Vieja%2C%20Donostia-San%20Sebasti%C3%A1n!5e0!3m2!1seu!2ses!4v1700000000001"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="EuskoPizza Donostia kokapena">
        </iframe>
    </div>

    <div class="mapa-helbidea" style="margin-bottom:3rem;">
        <div class="mapa-helbidea-item">
            <span class="kit">🏠</span>
            <div>
                <strong>Helbidea</strong>
                <span>Nagusia Kalea, 5<br>20003 Donostia</span>
            </div>
        </div>
        <div class="mapa-helbidea-item">
            <span class="kit">🕐</span>
            <div>
                <strong>Ordutegia</strong>
                <span>Al–Og: 12:00–23:00<br>Lr–Ig: 12:00–00:00</span>
            </div>
        </div>
        <div class="mapa-helbidea-item">
            <span class="kit">📞</span>
            <div>
                <strong>Telefonoa</strong>
                <span>+34 943 00 00 00</span>
            </div>
        </div>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
