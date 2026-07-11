<?php
/*
    ERR_CONN = errore di connessione
    [] = Nessun gelato trovato
    JSON[gelati]
*/
require_once('funzioni.php');

if(!isset($_GET['produttore']))
    $ris = "ERR_CONN";
else{
    $prod = $_GET['produttore'];
    $query = "SELECT * FROM gelati WHERE produttore LIKE '%$prod%';";
    $ris = eseguiQuery($query);
}

echo json_encode($ris);
?>