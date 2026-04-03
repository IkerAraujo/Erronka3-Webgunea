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

$stmt = $conn->prepare("
    INSERT INTO erosketak (erabiltzaile_id, izena, abizena, helbidea, totala, data) 
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
<p>Helbidea: <strong><?= $helbidea ?></strong></p>

<a href="Katalogoa.php">Itzuli Katalogora</a>

</body>
</html>