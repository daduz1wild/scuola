<?php
session_start();
require_once("funzioni.php");

if(isset($_POST['user']) && isset($_POST['psw'])){

    $user = $_POST['user'];
    $psw  = $_POST['psw'];

    $utente = checkUtente($user, $psw);

    if($utente == "ERR_CONN")
        echo json_encode("ERR_CONN");

    else if($utente == null)
        echo json_encode("ERR_LOGIN");

    else{
        $_SESSION["nome"] = $utente[2];
        $_SESSION["cognome"] = $utente[3];
        $_SESSION["dataNascita"] = $utente[5];

        echo "<h1>Area Riservata</h1>";
        echo "Benvenuto ".$utente[2]." ".$utente[3]." - ".$utente[5];
        echo "<br><br><a href='logout.php'>Logout</a>";
    }

}else
    echo json_encode("ERR_CONN");
?>