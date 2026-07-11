<?php
/*
    ERR_CONN = errore di connessione
    [] = Nessun gelato trovato
    JSON[gelati]
*/
require_once('funzioni.php');
if(!isset($_POST['scadenza']))
    $ris = "ERR_CONN";
else{
    $ris = cercaScadenzaGelato($_POST['scadenza']);
    echo json_encode($ris);
}



?>