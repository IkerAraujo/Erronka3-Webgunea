<?php
session_start();

if (!isset($_SESSION['karrito'])) {
    $_SESSION['karrito'] = [];
}

// POST: produktu berria gehitu (katalogotik)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id     = (int)$_POST['id'];
    $izena  = htmlspecialchars(trim($_POST['izena']));
    $prezioa = (float)$_POST['prezioa'];

    if (isset($_SESSION['karrito'][$id])) {
        $_SESSION['karrito'][$id]['kant']++;
    } else {
        $_SESSION['karrito'][$id] = [
            "izena"   => $izena,
            "prezioa" => $prezioa,
            "kant"    => 1
        ];
    }
    $itzulera = $_SERVER['HTTP_REFERER'] ?? 'katalogoa.php';
    header("Location: " . $itzulera);
    exit;
}

// GET ekintzak
if (isset($_GET['gehitu'])) {
    $id = (int)$_GET['gehitu'];
    if (isset($_SESSION['karrito'][$id])) {
        $_SESSION['karrito'][$id]['kant']++;
    }
    header("Location: karritoa.php");
    exit;
}

if (isset($_GET['gutxitu'])) {
    $id = (int)$_GET['gutxitu'];
    if (isset($_SESSION['karrito'][$id])) {
        $_SESSION['karrito'][$id]['kant']--;
        if ($_SESSION['karrito'][$id]['kant'] <= 0) {
            unset($_SESSION['karrito'][$id]);
        }
    }
    header("Location: karritoa.php");
    exit;
}

if (isset($_GET['kendu'])) {
    $id = (int)$_GET['kendu'];
    unset($_SESSION['karrito'][$id]);
    header("Location: karritoa.php");
    exit;
}

if (isset($_GET['hustu'])) {
    $_SESSION['karrito'] = [];
    header("Location: karritoa.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Karritoa - EuskoPizza</title>
    <link rel="stylesheet" href="../css/styleKarritoa.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="karrito-edukia">
    <h1>Zure Karritoa</h1>

    <?php if (empty($_SESSION['karrito'])): ?>
        <div class="karrito-hutsik">
            <p>Karritoa hutsik dago</p>
            <a href="katalogoa.php" class="btn-katalogora">Itzuli Katalogora</a>
        </div>
    <?php else: ?>
        <div class="karrito-taula">
            <?php
            $total = 0;
            foreach ($_SESSION['karrito'] as $id => $p):
                $guztira = $p['prezioa'] * $p['kant'];
                $total += $guztira;
            ?>
                <div class="karrito-item">
                    <div class="item-info">
                        <h3><?= htmlspecialchars($p['izena']) ?></h3>
                        <p class="prezioa-unitaria"><?= number_format($p['prezioa'], 2) ?> € / unitate</p>
                    </div>

                    <div class="kantitate-kontrolak">
                        <a href="karritoa.php?gutxitu=<?= $id ?>" class="kant-btn">−</a>
                        <span class="kant-zenbakia"><?= $p['kant'] ?></span>
                        <a href="karritoa.php?gehitu=<?= $id ?>" class="kant-btn">+</a>
                    </div>

                    <div class="item-prezioa">
                        <p class="prezioa-total"><strong><?= number_format($guztira, 2) ?> €</strong></p>
                    </div>

                    <a href="karritoa.php?kendu=<?= $id ?>" class="kendu-btn" title="Kendu">✕</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="karrito-footer">
            <p class="totala">Totala: <strong><?= number_format($total, 2) ?> €</strong></p>

            <div class="botoiak">
                <a href="karritoa.php?hustu=1" class="btn-hustu">Hustu karritoa</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="erosita.php" method="POST" class="entrega-form">
                        <input type="hidden" name="totala" value="<?= $total ?>">

                        <div class="entrega-aukera">
                            <p class="entrega-titulua">Entrega mota:</p>
                            <label class="entrega-radio">
                                <input type="radio" name="entrega_mota" value="dendan" checked onchange="entregaMota(this.value)">
                                Dendan jaso
                            </label>
                            <label class="entrega-radio">
                                <input type="radio" name="entrega_mota" value="etxez-etxe" onchange="entregaMota(this.value)">
                                Etxez-etxe bidali
                            </label>
                        </div>

                        <div class="helbide-kutxa" id="helbidea-div" style="display:none;">
                            <input type="text" name="helbidea_entrega" id="helbidea_input"
                                placeholder="Entrega helbidea..."
                                value="<?= htmlspecialchars($_SESSION['user_helbidea'] ?? '') ?>">
                        </div>

                        <button class="btn-erosi">Erosi orain</button>
                    </form>
                <?php else: ?>
                    <a href="HasiSaioa.php" class="btn-erosi">Saioa hasi &amp; erosi</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>

<script>
function entregaMota(balioa) {
    document.getElementById('helbidea-div').style.display =
        balioa === 'etxez-etxe' ? 'block' : 'none';
    document.getElementById('helbidea_input').required = (balioa === 'etxez-etxe');
}
</script>
</body>
</html>
