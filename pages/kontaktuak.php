<?php
session_start();

$mezua_bidalia = false;
$errorea = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $izena = htmlspecialchars(trim($_POST['izena'] ?? ''));
    $gmail  = htmlspecialchars(trim($_POST['gmail'] ?? ''));
    $gaia   = htmlspecialchars(trim($_POST['gaia'] ?? ''));
    $testua = htmlspecialchars(trim($_POST['testua'] ?? ''));

    if ($izena && $gmail && $gaia && $testua) {
        // Hemen posta bidalketa gehitu daiteke: mail(), PHPMailer, etab.
        $mezua_bidalia = true;
    } else {
        $errorea = "Mesedez, bete eremu guztiak.";
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktuak – EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="orri-goiburua">
    <span class="ikurra">📬</span>
    <h1>Kontaktuak</h1>
    <p>Galdera bat duzu? Laguntzeko prest gaude</p>
</div>

<div class="kontaktu-edukia">

    <!-- INFORMAZIOA -->
    <div class="kontaktu-txartela">
        <h2>Informazioa</h2>
        <ul class="kontaktu-info-zerrenda">
            <li>
                <span class="kit">📍</span>
                <div>
                    <strong>Helbidea (Bilbo)</strong><br>
                    Zazpikale Kalea, 12<br>
                    48005 Bilbo, Bizkaia
                </div>
            </li>
            <li>
                <span class="kit">📞</span>
                <div>
                    <strong>Telefonoa</strong><br>
                    +34 944 00 00 00
                </div>
            </li>
            <li>
                <span class="kit">✉️</span>
                <div>
                    <strong>Email</strong><br>
                    info@euskopizza.eus
                </div>
            </li>
            <li>
                <span class="kit">🕐</span>
                <div>
                    <strong>Ordutegia</strong><br>
                    Al–Og: 12:00 – 23:00<br>
                    Lr–Ig: 12:00 – 00:00
                </div>
            </li>
        </ul>
    </div>

    <!-- FORMULARIOA -->
    <div class="kontaktu-txartela">
        <h2>Mezu bat bidali</h2>

        <?php if ($mezua_bidalia): ?>
            <div style="background:#e8f5e9; color:#2e7d32; padding:1.25rem; border-radius:0.5rem; text-align:center;">
                <strong>✅ Mezu bidalita!</strong><br>
                Laster erantzungo dizugu. Eskerrik asko!
            </div>
        <?php else: ?>

            <?php if ($errorea): ?>
                <p style="color:#d84315; margin-bottom:1rem;">⚠️ <?= $errorea ?></p>
            <?php endif; ?>

            <form method="POST" class="kontaktu-form">
                <input type="text" name="izena" placeholder="Zure izena *"
                    value="<?= htmlspecialchars($_POST['izena'] ?? '') ?>" required>
                <input type="email" name="gmail" placeholder="Zure emaila *"
                    value="<?= htmlspecialchars($_POST['gmail'] ?? '') ?>" required>
                <input type="text" name="gaia" placeholder="Gaia *"
                    value="<?= htmlspecialchars($_POST['gaia'] ?? '') ?>" required>
                <textarea name="testua" placeholder="Zure mezua..." required><?= htmlspecialchars($_POST['testua'] ?? '') ?></textarea>
                <button type="submit">Bidali ✉️</button>
            </form>

        <?php endif; ?>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
