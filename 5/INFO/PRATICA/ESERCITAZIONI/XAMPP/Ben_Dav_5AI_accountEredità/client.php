<?php
# Benedetti Davide     5AI     12/01/2025     client.php

session_start();
require("funzioni.php");

$msg = "";
$err = "";

/* controllo accesso */
if (!isset($_SESSION['tipoUtente']) || $_SESSION['tipoUtente'] != "client") {
    header("Location: index.php?err=Accesso non permesso");
    exit;
}

/* leggo le parole */
$riga = leggiParole();

if ($riga != "") {
    $dati = explode(";", $riga);

    $par1 = $dati[0];
    $par2 = $dati[1];
    $par3 = $dati[2];
    $par4 = $dati[3];
    $par5 = $dati[4];
} else {
    $err = "Nessuna parola disponibile";
    $par1 = $par2 = $par3 = $par4 = $par5 = ""; // evita warning
}

// gestione tentativi giornalieri
$maxTentativi = 1;
$cookieName = "tentativi_giorno";

// se il cookie non esiste, lo inizializzo a 0
if (!isset($_COOKIE[$cookieName])) {
    $tentativi = 0;
} else {
    $tentativi = intval($_COOKIE[$cookieName]);
}

/* gestione risposta */
if (isset($_POST['risposta'])) {

    if ($tentativi >= $maxTentativi) {
        $err = "Hai raggiunto il numero massimo di tentativi per oggi ($maxTentativi).";
    } else {

        $risposta = $_POST['risposta'];
        $user = $_SESSION['username'];

        if ($risposta != "") {

            $ok = salvaRisposta($user, $risposta);

            if ($ok) {
                // incremento tentativi e aggiorno cookie (scadenza a mezzanotte)
                $tentativi++;
                $scadenza = strtotime("tomorrow");
                setcookie($cookieName, $tentativi, $scadenza);

                $msg = "<h2>Risposta inviata:</h2><br>$risposta<br>";

                if ($risposta == $dati[5]) {
                    $msg .= "Bravo, hai indovinato";
                } else {
                    $msg .= "Accidenti, non hai indovinato";
                }

            } else {
                $err = "Errore salvataggio risposta";
            }

        } else {
            $err = "Inserisci una risposta";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="check.js"></script>
    <title>Client</title>
</head>
<body>

<h1>Benvenuto <?php echo $_SESSION['username']; ?></h1>

<?php
if ($msg != "") {
    echo $msg;
} elseif ($err != "") {
    echo "<p style='color:red;'>$err</p>";
}
?>

<?php
if ($par1 != "") {
    echo "<h2>QUIZ DI OGGI:</h2><br>$par1 - $par2 - $par3 - $par4 - $par5<br><br>";
    echo "<p>Tentativi rimasti oggi: " . ($maxTentativi - $tentativi) . "</p>";
}
?>

<form id="formRisposta" method="POST" onsubmit="return checkRisposta(this)">
    RISPOSTA:
    <input type="text" name="risposta">
    <span id="rispostaError" class="error"></span><br><br>
    <input type="submit" value="Invia">
</form>

<h2>IL TUO STORICO</h2>

<?php
$user = $_SESSION['username'];
$history = getHistory($user);

$giocati = 0;
$vinti = 0;
$persi = 0;

foreach ($history as $g) {
    $giocati += $g["tot"];
    $vinti += $g["vinti"];
    $persi += $g["persi"];
}

$totGiochi = count($history);

echo "<p>Giochi disponibili: $totGiochi</p>";
echo "<p>Giocati: $giocati</p>";
echo "<p>Vinti: $vinti</p>";
echo "<p>Persi: $persi</p>";
?>


<br>
<a href="logout.php">LOGOUT</a>

</body>
</html>
