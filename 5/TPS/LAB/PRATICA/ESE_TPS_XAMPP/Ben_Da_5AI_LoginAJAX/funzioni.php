<?php
function checkUtente($u, $p){
    if(!file_exists("utenti.csv"))
        return "ERR_CONN";

    $utenti = file("utenti.csv");

    foreach($utenti as $utente){
        $utente = trim($utente);

        if($utente != ""){
            $tokens = explode(";", $utente);

            // formato: username;password;nome;cognome;sesso;dataNascita;
            if(count($tokens) >= 6){
                if($u == $tokens[0] && $p == $tokens[1])
                    return $tokens;
            }
        }
    }

    return null;
}
?>