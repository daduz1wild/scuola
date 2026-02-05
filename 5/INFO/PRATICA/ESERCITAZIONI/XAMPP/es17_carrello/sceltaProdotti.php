<?php

// LEGGI PRODOTTI
$prodotti = file("prodotti.csv");

// LEGGI CARRELLO DAL COOKIE
$carrello = [];
if (isset($_COOKIE['carrello'])) {
    $carrello = explode("|", $_COOKIE['carrello']);
}

// AGGIUNGI PRODOTTO (GET)
if (isset($_GET['aggiungi'])) {
    $carrello[] = $_GET['prod'];
    setcookie("carrello", implode("|", $carrello), time() + 3600);
}

// VISUALIZZA CARRELLO
$mostraCarrello = isset($_GET['mostra']);

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Negozio</title>
</head>
<body>

<h1>ELENCO PRODOTTI</h1>

<form method="get">
    Seleziona prodotto:
    <select name="prod">
        <?php
        foreach ($prodotti as $riga) {
            $riga = trim($riga);
            $dati = explode(";", $riga);
            echo "<option value='$riga'>" . $dati[0] . " - " . $dati[1] . "€</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" name="aggiungi" value="Aggiungi al carrello">
    <input type="submit" name="mostra" value="Visualizza carrello">
</form>

<hr>

<?php
if ($mostraCarrello) {
    echo "<h2>CARRELLO</h2>";

    $totale = 0;
    for ($i = 0; $i < count($carrello); $i++) {
        $dati = explode(";", $carrello[$i]);
        echo $dati[0] . " " . $dati[1] . "€<br>";
        $totale += $dati[1];
    }

    echo "<br>TOTALE: " . $totale . "€";
}
?>

</body>
</html>
