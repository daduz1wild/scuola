<?php
# Benedetti Davide     5AI     29/12/2025     funzioni.php

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

function userExists($u) {
    $utenti = file("utenti.csv");
    foreach ($utenti as $utente) {
        $utente = trim($utente);
        if ($utente == "") {
            // ignora
        } else {
            $tokens = explode(";", $utente);
            if (count($tokens) >= 1) {
                if ($u == $tokens[0]) {
                    return true;
                }
            }
        }
    }
    return false;
}

function addUser($u, $p) {
    $u = trim($u);
    $p = trim($p);

    if ($u == "" || $p == "") {
        return false;
    }

    $tokens = array($u, $p, "client");
    $riga = implode(";", $tokens) . "\n";

    $f = fopen("utenti.csv", "a");
    if ($f) {
        fwrite($f, $riga);
        fclose($f);
        return true;
    } else {
        return false;
    }
}
?>
