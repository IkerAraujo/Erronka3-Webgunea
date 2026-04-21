<?php
session_start();
include "../includes/konexioa.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: HasiSaioa.php");
    exit;
}

$erabiltzaile_id = $_SESSION['user_id'];
$izena = $_SESSION['user_izena'];
$abizena = $_SESSION['user_abizena'];
$helbidea = $_SESSION['user_helbidea'];

$totala = $_POST['totala'];
$entrega_mota = $_POST['entrega_mota'] ?? 'dendan';
$etxeko = ($entrega_mota === 'etxez-etxe');
$entrega_helbidea = $etxeko ? trim($_POST['helbidea_entrega'] ?? $helbidea) : '';

$stmt = $conn->prepare("
    INSERT INTO erosketak (web_erabiltzaile_id, izena, abizena, helbidea, totala, data)
    VALUES (?, ?, ?, ?, ?, NOW())
");

$stmt->bind_param("isssd",
    $erabiltzaile_id,
    $izena,
    $abizena,
    $helbidea,
    $totala
);

$stmt->execute();

// Eskaera sukaldarian pantailan agertzeko
$oharra = $izena . " " . $abizena . "|" . $entrega_helbidea;
$stmt2 = $conn->prepare("INSERT INTO eskaerak (web_erabiltzaile_id, egoera, oharra, sortze_data, eguneratze_data) VALUES (?, 'Prestatzeko zain', ?, NOW(), NOW())");
$stmt2->bind_param("is", $erabiltzaile_id, $oharra);
$stmt2->execute();
$eskaera_id = $conn->insert_id;

// Eskaeraren elementuak txertatu
$stmt3 = $conn->prepare("INSERT INTO eskaera_elementuak (eskaera_id, pizza_id, kantitatea, prezioa) VALUES (?, ?, ?, ?)");
foreach ($_SESSION['karrito'] as $pizza_id => $p) {
    $kantitatea = (int)$p['kant'];
    $prezioa_bak = (float)$p['prezioa'];
    $stmt3->bind_param("iiid", $eskaera_id, $pizza_id, $kantitatea, $prezioa_bak);
    $stmt3->execute();
}

// Etxez-etxekoa bada, banaketak taulan txertatu
if ($etxeko && $entrega_helbidea !== '') {
    $stmt4 = $conn->prepare("INSERT INTO banaketak (eskaera_id, helbidea) VALUES (?, ?)");
    $stmt4->bind_param("is", $eskaera_id, $entrega_helbidea);
    $stmt4->execute();
}

$_SESSION['karrito'] = [];

$xmlPath = __DIR__ . "/../xml/puntuak.xml";

if (!file_exists($xmlPath)) {

    $sortu = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<puntuak></puntuak>";
    file_put_contents($xmlPath, $sortu);
}

$xml = simplexml_load_file($xmlPath);

if ($xml === false) {
    die("Errorea: ezin izan da XML fitxategia kargatu.");
}

$puntuak_irabazi = floor($totala);

$erab_nodoa = null;
foreach ($xml->erabiltzaile as $u) {
    if ((string)$u->id === (string)$erabiltzaile_id) {
        $erab_nodoa = $u;
        break;
    }
}

if ($erab_nodoa === null) {
    $erab_nodoa = $xml->addChild("erabiltzaile");
    $erab_nodoa->addChild("id", $erabiltzaile_id);
    $erab_nodoa->addChild("puntuak", 0);
}

$erab_nodoa->puntuak = (int)$erab_nodoa->puntuak + $puntuak_irabazi;

$xml->asXML($xmlPath);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Eskerrik Asko!</title>

<style>
body { 
    font-family: Arial; 
    text-align: center; 
    margin-top: 4rem; 
}
h1 { 
    color: #0f3460; 
}
a {
    margin-top: 2rem;
    display: inline-block;
    padding: 1rem 2rem;
    background: #d84315;
    color: white;
    border-radius: 10px;
    text-decoration: none;
}
</style>

</head>
<body>

<h1>Eskerrik asko, <?= $izena ?> <?= $abizena ?>!</h1>
<p>Zure erosketa ondo egin da.</p>
<p>Totala: <strong><?= $totala ?> €</strong></p>
<p>Entrega mota: <strong><?= $etxeko ? 'Etxez-etxe' : 'Dendan jaso' ?></strong></p>
<?php if ($etxeko && $entrega_helbidea !== ''): ?>
<p>Helbidea: <strong><?= htmlspecialchars($entrega_helbidea) ?></strong></p>
<?php endif; ?>

<a href="katalogoa.php">Itzuli Katalogora</a>

</body>
</html>