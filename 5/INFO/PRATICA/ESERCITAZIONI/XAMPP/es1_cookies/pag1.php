<?php 
// Inizia la sessione o verifica se c'è un cookie con il colore scelto
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['colore'])) {
    // Imposta il cookie con il colore scelto
    setcookie("colore", $_GET['colore'], time() + 60 * 60); // Cookie valido per 1 ora
    $colore = $_GET['colore'];
} elseif (isset($_COOKIE['colore'])) {
    $colore = $_COOKIE['colore'];
} else {
    $colore = "white"; // Colore predefinito
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ES cookie</title>
    <style>
        body {
            <?php echo "background-color: " . $colore . ";"; ?>
        }
    </style>
</head>
<body>
    <h1>PAG1</h1>
    <form action="pag2.php" method="get">
        Scegli un colore: <input type="color" name="colore" value="<?php echo $colore; ?>">
        <input type="submit" value="Invia">
    </form>
    <a href="pag2.php"><button>-></button></a>
</body>
</html>
