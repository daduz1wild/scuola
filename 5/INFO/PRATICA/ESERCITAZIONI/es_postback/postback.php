<?php
/*
Si devono gestire le iscrizioni ai convegni di una manifestazione. Ogni persona che desidera partecipare ad un convegno deve accedere ad una pagina web 
in cui tramite checkbox seleziona uno o più convegni a cui iscriversi. Il
form prevede il bottone ISCRIVITI. Realizzare il codice dell’unico script php (uno solo!) che permette sia di selezionare i convegni a cui iscriversi 
che di vedere il convegno a cui l’utente si è iscritto.
*/

function controllo($nome){
    if($nome !=="" )
        return true;
    else
        return false;
}

if(empty($_GET)){
    // mostra il form se non è stato ancora inviato
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
else {
    $nome = $_GET["nome"];

    if(!controllo($nome)){
        echo "Errore: il nome non è valido.<br><br>";
        echo '<a href="http://localhost/ESE_INFO/es_postback/postback.php">Torna indietro</a>';
    } else {
        echo "<h2>Iscrizione completata!</h2>";
        echo "Ciao $nome, ti sei iscritto ai seguenti convegni:<br><ul>";

        $haSelezionato = false;

        // scorro tutto $_GET e stampo solo le chiavi diverse da "nome"
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
        echo '<br><a href="http://localhost/ESE_INFO/es_postback/postback.php">Torna al form</a>';
    }
}
?>
