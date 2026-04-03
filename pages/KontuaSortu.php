<?php
session_start();
include "../includes/konexioa.php";

$errorea = "";
$ongi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $izena = $_POST['izena'];
    $abizena = $_POST['abizena'];
    $nan = $_POST['nan'];
    $telefonoa = $_POST['telefonoa'];
    $helbidea = $_POST['helbidea'];
    $gmail = $_POST['gmail'];
    $pasahitza = $_POST['pasahitza'];

    $checkNan = $conn->prepare("SELECT id FROM erabiltzaileak WHERE nan = ?");
    $checkNan->bind_param("s", $nan);
    $checkNan->execute();
    $nanResult = $checkNan->get_result();

    if ($nanResult->num_rows > 0) {
        $errorea = " NAN hori dagoeneko erabilita dago.";
    }

    else {
        $checkGmail = $conn->prepare("SELECT id FROM erabiltzaileak WHERE gmail = ?");
        $checkGmail->bind_param("s", $gmail);
        $checkGmail->execute();
        $gmailResult = $checkGmail->get_result();

        if ($gmailResult->num_rows > 0) {
            $errorea = " Gmail hori dagoeneko erabilita dago.";
        }
    }

    if ($errorea == "") {
        $stmt = $conn->prepare("INSERT INTO erabiltzaileak 
        (izena, abizena, nan, telefonoa, helbidea, gmail, pasahitza)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss",
            $izena, $abizena, $nan, $telefonoa, $helbidea, $gmail, $pasahitza
        );

        if ($stmt->execute()) {
            $ongi = " Kontua ondo sortu da!";
        } else {
            $errorea = " Errore bat gertatu da kontua sortzean.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Kontua Sortu</title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleKontuaHasiEtaSortu.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="form-kutxa">
        <h2>Kontua Sortu</h2>

        <?php
            if ($errorea != "") echo "<p class='errorea'>$errorea</p>";
            if ($ongi != "") echo "<p class='ongi'>$ongi</p>";
        ?>

        <form method="POST">
            <input class="inputa" type="text" name="izena" placeholder="Izena" required>
            <input class="inputa" type="text" name="abizena" placeholder="Abizena" required>
            <input class="inputa" type="text" name="nan" placeholder="NAN" required>
            <input class="inputa" type="text" name="telefonoa" placeholder="Telefonoa">
            <input class="inputa" type="text" name="helbidea" placeholder="Helbidea">
            <input class="inputa" type="email" name="gmail" placeholder="Gmail-a" required>
            <input class="inputa" type="password" name="pasahitza" placeholder="Pasahitza" required>

            <button class="botoia">Sortu Kontua</button>
        </form>

    </div>

</body>
</html>