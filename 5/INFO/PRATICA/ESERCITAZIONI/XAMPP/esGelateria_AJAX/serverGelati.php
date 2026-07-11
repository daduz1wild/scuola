<?php
include "funzioni.php";

if(isset($_POST['nome']) && isset($_POST['data']) && isset($_POST['produttore'])){
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $produttore = $_POST['produttore'];

    if($nome == "*")
        $risServer = cercaGelati("", $data, $produttore);
    else
        $risServer = cercaGelati($nome, $data, $produttore);
}
else
    $risServer = "ERR_CONN";

echo json_encode($risServer);
?>