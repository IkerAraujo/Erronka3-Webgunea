<?php
session_start();

include_once "konexioa.php"; 

$mensaje = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["posta_elektronikoa"];
    $pasahitza = $_POST["pasahitza"];

    $sql = "SELECT id, pass FROM erabiltzaile WHERE gmail = ?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        die("Error en la consulta: " . $conexion->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($pasahitza === $user["pass"]) {
            $_SESSION["user_id"] = $user["id"];

            header("Location: SARRERA.php");
            exit;
        } else {
            $mensaje = "Pasahitza okerra.";
        }
    } else {
        $mensaje = "Ez da aurkitu erabiltzailea.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Erabiltzaileak</title>
    <link rel="stylesheet" href="CSS_Erronka.css">
</head>
<body>

<header>
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
</header>

<main>
    <h2>Login Erabiltzaileak</h2>

    <?php if($mensaje) echo "<div class='mensaje'>$mensaje</div>"; ?>

    <form action="" method="post">
        <div>
            <label for="posta_elektronikoa">Posta elektronikoa</label>
            <input type="email" id="posta_elektronikoa" name="posta_elektronikoa" placeholder="example@gmail.com" required>
        </div>

        <div>
            <label for="pasahitza">Pasahitza</label>
            <input type="password" id="pasahitza" name="pasahitza" required>
        </div>

        <div class="button">
            <button type="reset">Ezabatu</button>
            <button type="submit">Sartu</button>
        </div>
    </form>
</main>

</body>
</html>
