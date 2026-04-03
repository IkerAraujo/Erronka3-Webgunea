<?php
session_start();
include "../includes/konexioa.php";  

$errorea = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $gmail = $_POST['gmail'];
    $pasahitza = $_POST['pasahitza'];

    $sql = "SELECT * FROM erabiltzaileak WHERE gmail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        
        if ($pasahitza == $row['pasahitza']) {

            $_SESSION['erabiltzailea'] = $row['izena'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_izena'] = $row['izena'];
            $_SESSION['user_abizena'] = $row['abizena'];
            $_SESSION['user_helbidea'] = $row['helbidea'];

            header("Location: ../pages/SARRERA.php");
        
        } else {
                    $errorea = " Pasahitza okerra da.";
                }

            } else {
                $errorea = " Gmail hori ez da existitzen.";
            }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Saioa Hasi</title>
    <link rel="stylesheet" href="../css/styleSarrera.css">
    <link rel="stylesheet" href="../css/styleKontuaHasiEtaSortu.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="form-kutxa">
        <h2>Saioa Hasi</h2>

        <?php
            if ($errorea != "") {
                echo "<p class='errorea'>$errorea</p>";
            }
        ?>

        <form method="POST">
            <input class="inputa" type="email" name="gmail" placeholder="Gmail-a" required>
            <input class="inputa" type="password" name="pasahitza" placeholder="Pasahitza" required>

            <button class="botoia">Sartu</button>
        </form>
        <br>
        <a href="../pages/KontuaSortu.php"> Ez daukat Konturik </a>

    </div>

</body>
</html>