<?php
session_start();
include "../includes/konexioa.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: HasiSaioa.php");
    exit;
}

$kostua = intval($_POST['kostua']);
$izena = $_POST['izena'];
$pizza_id = intval($_POST['id']);
$uid = $_SESSION['user_id'];

$xmlPath = __DIR__ . "/../xml/puntuak.xml";

if (!file_exists($xmlPath)) {
    file_put_contents($xmlPath, "<?xml version='1.0'?><puntuak></puntuak>");
}

$xml = simplexml_load_file($xmlPath);

$erabNodo = null;
foreach ($xml->erabiltzaile as $u) {
    if ((string)$u->id === (string)$uid) {
        $erabNodo = $u;
        break;
    }
}

if ($erabNodo === null) {
    $erabNodo = $xml->addChild("erabiltzaile");
    $erabNodo->addChild("id", $uid);
    $erabNodo->addChild("puntuak", 0);
}

$puntuAktualak = intval($erabNodo->puntuak);

if ($puntuAktualak >= $kostua) {

    $erabNodo->puntuak = $puntuAktualak - $kostua;
    $xml->asXML($xmlPath);

    $stmt = $conn->prepare("
        INSERT INTO puntuErosketak (erabiltzaile_id, pizza_id, izena, kostua, data)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param("iisi", $uid, $pizza_id, $izena, $kostua);
    $stmt->execute();

    echo "<h1>$izena puntuekin erosi duzu. 20-25 minututan zure etxean egongo da.</h1>";

} else {
    echo "<h1>Ez duzu puntu nahikorik.</h1>";
}
?>