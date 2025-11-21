<?php
    if(isset($_POST['nome']))
        $ris="Ciao " . $_POST['nome'];
    else
        $ris="errore nell'invio dei dati";
    echo $ris
?>
