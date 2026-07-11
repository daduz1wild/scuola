<?php
/*
    ERR_CONN = errore di connessione
    [] = Nessun gelato trovato
    JSON[gelati]
*/
require_once("funzioni.php");
if(!isset($_GET['nomeGelato']))
    $ris = "ERR_CONN";
else{
    $nomeG = $_GET['nomeGelato'];
    $query = "SELECT * FROM gelati WHERE nome LIKE '%$nomeG%';";
    $ris = eseguiQuery($query);
}
echo json_encode($ris);
?>




