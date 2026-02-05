<?php
# Benedetti Davide     5AI     19/12/2025     funzioni.php

function checkTipo($u, $p) {
    $utenti = file("utenti.csv");
    foreach ($utenti as $utente) {
        $utente = trim($utente);
        if ($utente == "") {
            // linea vuota, ignora
        } else {
            $tokens = explode(";", $utente);
            if (count($tokens) >= 3) {
                if ($u == $tokens[0] && $p == $tokens[1]) {
                    return $tokens[2];
                }
            }
        }
    }
    return "";
}

?>
