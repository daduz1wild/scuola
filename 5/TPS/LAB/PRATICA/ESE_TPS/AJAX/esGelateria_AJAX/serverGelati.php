<?php
include "funzioni.php";

if(isset($_POST['nome']) && isset($_POST['dataScadenza']) && isset($_POST['produttore'])){
    $nome = $_POST['nome'];
    $dataScadenza = $_POST['dataScadenza'];
    $produttore = $_POST['produttore'];
    $risServer = cercaGelati($nome, $dataScadenza, $produttore);
} else {
    $risServer = "ERR_CONN";
}

echo json_encode($risServer);
?>
