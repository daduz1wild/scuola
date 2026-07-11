<?php
include "funzioni.php";
if(isset($_POST['specie'])){
    $spc = $_POST['specie'];
    if($spc == "*")
        $risServer = cercaAnimali("");
    else
        $risServer = cercaAnimali($spc);
}else
    $risServer = "ERR_CONN";
echo json_encode($risServer);
?>