<?php
# Benedetti Davide     5AI     12/01/2025     funzioni.php

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

function insFile($p1, $p2, $p3, $p4, $p5, $sol) {
    $lastId = lastId() + 1;
    $data = date("Y-m-d");
    $dati = array($p1, $p2, $p3, $p4, $p5, $sol, $lastId, $data);
    $riga = implode(";", $dati) . PHP_EOL;
    $f = fopen("eredita.csv", "a");
    $f2 = fopen("lastId.csv", "w");
    if ($f && $f2) {
        fwrite($f, $riga);
        fclose($f);
        fwrite($f2, $lastId);
        fclose($f2);
        return true;
    } else {
        return false;
    }
}



function leggiParole() {
    $righe = file("eredita.csv");
    if ($righe != false && count($righe) > 0) {
        return trim($righe[count($righe) - 1]);
    } else {
        return "";
    }
}

function salvaRisposta($user, $risposta) {
    $corretta = checkRight($risposta);
    $id = lastId();
    $riga = $user . ";" . $risposta . ";" . $corretta . ";" . $id . "\n";
    $f = fopen("risposte.csv", "a");
    if ($f) {
        fwrite($f, $riga);
        fclose($f);
        return true;
    } else {
        return false;
    }
}


function checkRight($parolaIns) {
    $righe = file("eredita.csv");
    if ($righe != false && count($righe) > 0) {
        $ultimaRiga = trim($righe[count($righe) - 1]);
        $dati = explode(";", $ultimaRiga);
        $soluzione = $dati[5];
        if ($parolaIns == $soluzione) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}


function lastId(){
    if (!file_exists("lastId.csv")) {
        return 0;
    }
    $righe = file("lastId.csv");
    $id = intval($righe[0]);
    return $id;
}

function getHistory($desUser = "") {

    $giochi = file("eredita.csv");
    $risposte = file("risposte.csv");

    $storico = array();

    /* preparo array giochi */
    foreach ($giochi as $r) {
        $r = trim($r);
        if ($r != "") {
            $d = explode(";", $r);
            $id = $d[6];

            $storico[$id] = array(
                "data" => $d[7],
                "tot" => 0,
                "vinti" => 0,
                "persi" => 0
            );
        }
    }

    /* conto risposte */
    foreach ($risposte as $r) {
        $r = trim($r);
        if ($r != "") {
            $d = explode(";", $r);

            $user = $d[0];
            $ok = $d[2];
            $id = $d[3];

            if ($desUser == "" || $desUser == $user) {
                if (isset($storico[$id])) {
                    $storico[$id]["tot"]++;

                    if ($ok == 1) {
                        $storico[$id]["vinti"]++;
                    } else {
                        $storico[$id]["persi"]++;
                    }
                }
            }
        }
    }

    return $storico;
}

?>

