<?php
/*
    ERR_CONN = errore di connessione
    "" = Nessun gelato trovato
    JSON[gelati]
*/
require_once("funzioni.php");
if(!isset($_GET['nomeGelato']))
    $ris = "ERR_CONN";
else{
    $ris = cercaNomeGelato($_GET['nomeGelato']);
}
echo json_encode($ris);
?>




