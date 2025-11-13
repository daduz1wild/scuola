<?php
// 0 = nessun dato, 1 = elaborazione corretta, 2 = dati non validi
$caso = 0;
$err = "";

// Se il form è stato inviato
if(!empty($_GET)){

    // Controllo che esista la chiave 'nome' prima di usarla
    if(isset($_GET['nome'])){
        $nome = $_GET['nome'];

        // controllo con la funzione richiesta
        if(controllo($nome)){
            $caso = 1; // dati validi → mostra iscrizione
        } else {
            $caso = 2; // dati non validi → errore
            $err = "Errore: il nome non è valido.";
        }

    } else {
        // Mancanza del campo 'nome'
        $caso = 2;
        $err = "Errore: campo 'nome' non trovato.";
    }
}

// funzione di controllo richiesta dal testo
function controllo($nome){
    if($nome !== "" )
        return true;
    else
        return false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iscrizione ai convegni</title>
</head>
<body>

<?php
// --- CASO 0 o 2: mostra il form ---
if($caso == 0 || $caso == 2){
    if($caso == 2)
        echo "<p style='color:red;'>$err</p>";
    ?>
    <form method="get">
        Nome: <input type="text" name="nome"><br><br>

        <label for="info">Informatica</label>
        <input type="checkbox" name="info" id="info"><br>

        <label for="tele">Telecomunicazioni</label>
        <input type="checkbox" name="tele" id="tele"><br>

        <label for="mate">Matematica</label>
        <input type="checkbox" name="mate" id="mate"><br>

        <label for="film">Film</label>
        <input type="checkbox" name="film" id="film"><br>

        <label for="macchine">Macchine</label>
        <input type="checkbox" name="macchine" id="macchine"><br><br>

        <input type="submit" value="ISCRIVITI">
    </form>
    <?php
}
// --- CASO 1: mostra l’esito dell’iscrizione ---
else if($caso == 1){
    $nome = $_GET['nome'];
    echo "<h2>Iscrizione completata!</h2>";
    echo "Ciao $nome, ti sei iscritto ai seguenti convegni:<br><ul>";

    $haSelezionato = false;
    foreach($_GET as $key => $value){
        if($key != "nome"){
            echo "<li>$key</li>";
            $haSelezionato = true;
        }
    }

    if(!$haSelezionato){
        echo "<li>Nessun convegno selezionato</li>";
    }

    echo "</ul>";
    echo '<br><a href="http://localhost/progetti/ESE_INFO/es_postback/postback.php">Torna al form</a>';
}
?>

</body>
</html>
