<?php
function controllaDati($nome,$eta,&$err){
    $corretto=true;
    if($nome===""){
        $err="nome non inserito";
        $corretto=false;
    }
    if($eta<18 && isNan($eta)) {
        $err="eta deve essere > 18";
        $corretto=false;
    }
    return $corretto;
    
}

?>