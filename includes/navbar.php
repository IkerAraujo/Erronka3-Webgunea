<nav>
        <div class="nav">
            <div class="nav-top">
                <a href="SARRERA.php" class="nav-logo">
                    <img src="../argazkiak/EuskoPizza(LOGOA).png" alt="EuskoPizza">
                </a>
            </div>

            <form action="katalogoa.php" method="GET" class="bilatzailea">
                <input type="text" name="keywords" placeholder="Bilatu produktuak...">
                <button type="submit">BILATU</button>
            </form>

            <div class="nav-links">
                <a href="../pages/katalogoa.php">KATALOGOA</a>
                <a href="../pages/puntuPizzak.php"> PUNTUAK </a>
                <a href="../pages/HasiSaioa.php">HASI SAIO</a>
                <a href="karritoa.php" class="nav-saskia">
                    <img src="../argazkiak/saskia.png" alt="Saskia" class="saskia-img">
                </a>
            </div>
            
            <?php if(isset($_SESSION['erabiltzailea'])): ?>
                <span style="color:white; margin-left:10px; font-weight:600;">
                    Kaixo, <?php echo $_SESSION['erabiltzailea']; ?>!
                </span>

            <?php endif; ?>

        </div>
    </nav>