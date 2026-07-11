<?php
/*
    ERR_CONN = errore connessione al server
    
    ERR_DATA = errore invio dei dati

    ERR_CRD = credenziali errate
    LOG_OK = credenziali corrette
*/
require_once("function.php");
$ris = "ERR_CONN";
if(!isset($_POST["usr"], $_POST["psw"]))
    $ris = "ERR_DATA";
else{
    $user = cercaUser($_POST["usr"], $_POST["psw"]);
    if($user == null)
        $ris = "ERR_CRD";
    else{
         $ris = "LOG_OK";
         session_start();
         $_SESSION["user"] = json_encode($user);  
    }
}
echo $ris;



?>