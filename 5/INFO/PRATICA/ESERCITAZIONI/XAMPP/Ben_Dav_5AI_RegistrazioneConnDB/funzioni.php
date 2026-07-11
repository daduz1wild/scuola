<?php
# Benedetti Davide     5AI     19/04/2026     funzioni.php

require "db.php";

function checkTipo($u, $p) {
    $tipo = "";

    $sql = "
        SELECT t.tipo
        FROM utenti u
        INNER JOIN tipoutente t ON u.tipo = t.id
        WHERE u.email = :email
        AND u.password = :password
    ";

    $params = [
        ":email" => $u,
        ":password" => $p
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $tipo = $result[0]["tipo"];
    }

    return $tipo;
}

function getIdUtente($u, $p) {
    $id = -1;

    $sql = "
        SELECT idU
        FROM utenti
        WHERE email = :email
        AND password = :password
    ";

    $params = [
        ":email" => $u,
        ":password" => $p
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $id = $result[0]["idU"];
    }

    return $id;
}

function getIdTipo($tipo) {
    $id = -1;

    $sql = "
        SELECT id
        FROM tipoutente
        WHERE tipo = :tipo
    ";

    $params = [
        ":tipo" => $tipo
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $id = $result[0]["id"];
    }

    return $id;
}

function userExists($u) {
    $esiste = false;

    $sql = "
        SELECT idU
        FROM utenti
        WHERE email = :email
    ";

    $params = [
        ":email" => $u
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $esiste = true;
    }

    return $esiste;
}

function telefonoExists($telefono) {
    $esiste = false;

    $sql = "
        SELECT idU
        FROM utenti
        WHERE telefono = :telefono
    ";

    $params = [
        ":telefono" => $telefono
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $esiste = true;
    }

    return $esiste;
}

function addUser($nome, $cognome, $dataNascita, $sesso, $email, $password, $telefono, $residenza, $tipo) {
    $ok = false;

    if ($nome != "" && $cognome != "" && $dataNascita != "" && $sesso != "" && $email != "" && $password != "" && $telefono != "" && $residenza != "") {
        $sql = "
            INSERT INTO utenti
            (nome, cognome, dataNascita, sesso, email, password, telefono, residenza, tipo)
            VALUES
            (:nome, :cognome, :dataNascita, :sesso, :email, :password, :telefono, :residenza, :tipo)
        ";

        $params = [
            ":nome" => $nome,
            ":cognome" => $cognome,
            ":dataNascita" => $dataNascita,
            ":sesso" => $sesso,
            ":email" => $email,
            ":password" => $password,
            ":telefono" => $telefono,
            ":residenza" => $residenza,
            ":tipo" => $tipo
        ];

        $result = executeInsert($sql, $params);

        if ($result != null) {
            $ok = true;
        }
    }

    return $ok;
}

function addAccesso($idU) {
    $ok = false;

    $dataInizio = date("Y-m-d");
    $oraInizio = date("H:i:s");

    $sql = "
        INSERT INTO accessi
        (dataInizio, oraInizio, utente)
        VALUES
        (:dataInizio, :oraInizio, :utente)
    ";

    $params = [
        ":dataInizio" => $dataInizio,
        ":oraInizio" => $oraInizio,
        ":utente" => $idU
    ];

    $result = executeInsert($sql, $params);

    if ($result != null) {
        $ok = true;
    }

    return $ok;
}

function chiudiUltimoAccesso($idU) {
    $ok = false;

    $sql = "
        SELECT idA
        FROM accessi
        WHERE utente = :utente
        AND dataFine IS NULL
        AND oraFine IS NULL
        ORDER BY idA DESC
        LIMIT 1
    ";

    $params = [
        ":utente" => $idU
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $idA = $result[0]["idA"];
        $dataFine = date("Y-m-d");
        $oraFine = date("H:i:s");

        $sqlUpdate = "
            UPDATE accessi
            SET dataFine = :dataFine,
                oraFine = :oraFine
            WHERE idA = :idA
        ";

        $paramsUpdate = [
            ":dataFine" => $dataFine,
            ":oraFine" => $oraFine,
            ":idA" => $idA
        ];

        $update = executeUpdateOrDelete($sqlUpdate, $paramsUpdate);

        if ($update != null && $update > 0) {
            $ok = true;
        }
    }

    return $ok;
}

function getAccessiUtente($idU) {
    $accessi = [];

    $sql = "
        SELECT idA, dataInizio, oraInizio, dataFine, oraFine
        FROM accessi
        WHERE utente = :utente
        ORDER BY idA DESC
    ";

    $params = [
        ":utente" => $idU
    ];

    $result = executeSelect($sql, $params);

    if ($result != null) {
        $accessi = $result;
    }

    return $accessi;
}

function getUtenti() {
    $utenti = [];

    $sql = "
        SELECT idU, nome, cognome, email
        FROM utenti
        ORDER BY cognome, nome
    ";

    $result = executeSelect($sql);

    if ($result != null) {
        $utenti = $result;
    }

    return $utenti;
}

function deleteUser($idU) {
    $ok = false;

    $sql1 = "
        DELETE FROM accessi
        WHERE utente = :utente
    ";

    $params1 = [
        ":utente" => $idU
    ];

    $delAcc = executeUpdateOrDelete($sql1, $params1);

    if ($delAcc !== null) {
        $sql2 = "
            DELETE FROM utenti
            WHERE idU = :idU
        ";

        $params2 = [
            ":idU" => $idU
        ];

        $delUser = executeUpdateOrDelete($sql2, $params2);

        if ($delUser != null && $delUser > 0) {
            $ok = true;
        }
    }

    return $ok;
}

function deleteAccessiPrimaData($data) {
    $ok = false;

    $sql = "
        DELETE FROM accessi
        WHERE dataInizio < :data
    ";

    $params = [
        ":data" => $data
    ];

    $result = executeUpdateOrDelete($sql, $params);

    if ($result != null) {
        $ok = true;
    }

    return $ok;
}

function utentiNatiPrima($data) {
    $risultati = [];

    $sql = "
        SELECT *
        FROM utenti
        WHERE dataNascita < :data
        ORDER BY cognome, nome
    ";

    $params = [
        ":data" => $data
    ];

    $result = executeSelect($sql, $params);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function utentiNatiAnno($anno) {
    $risultati = [];

    $sql = "
        SELECT *
        FROM utenti
        WHERE YEAR(dataNascita) = :anno
        ORDER BY cognome, nome
    ";

    $params = [
        ":anno" => $anno
    ];

    $result = executeSelect($sql, $params);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function ingressiTraDate($data1, $data2) {
    $risultati = [];

    $sql = "
        SELECT u.email, u.nome, u.cognome,
               a.dataInizio, a.oraInizio, a.dataFine, a.oraFine
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE a.dataInizio BETWEEN :data1 AND :data2
        ORDER BY a.dataInizio, a.oraInizio
    ";

    $params = [
        ":data1" => $data1,
        ":data2" => $data2
    ];

    $result = executeSelect($sql, $params);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function utentiConPiuDi4AccessiMese($mese) {
    $risultati = [];

    $sql = "
        SELECT u.email, u.nome, u.cognome, COUNT(a.idA) AS NumAcc
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE MONTH(a.dataInizio) = :mese
        GROUP BY u.idU, u.email, u.nome, u.cognome
        HAVING COUNT(a.idA) > 4
        ORDER BY u.cognome, u.nome
    ";

    $params = [
        ":mese" => $mese
    ];

    $result = executeSelect($sql, $params);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function accessiDurataSup1h() {
    $risultati = [];

    $sql = "
        SELECT u.email, u.nome, u.cognome,
               a.dataInizio, a.oraInizio, a.dataFine, a.oraFine,
               TIMESTAMPDIFF(MINUTE,
               CONCAT(a.dataInizio, ' ', a.oraInizio),
               CONCAT(a.dataFine, ' ', a.oraFine)) AS durataMin
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE a.dataFine IS NOT NULL
        AND a.oraFine IS NOT NULL
        AND TIMESTAMPDIFF(MINUTE,
            CONCAT(a.dataInizio, ' ', a.oraInizio),
            CONCAT(a.dataFine, ' ', a.oraFine)
        ) > 60
        ORDER BY u.cognome, u.nome
    ";

    $result = executeSelect($sql);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function utenteDurataMassima() {
    $risultati = [];

    $sql = "
        SELECT u.email, u.nome, u.cognome,
               TIMESTAMPDIFF(SECOND, CONCAT(a.dataInizio, ' ', a.oraInizio), CONCAT(a.dataFine, ' ', a.oraFine)) AS durataAcc
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE a.dataFine IS NOT NULL
        AND a.oraFine IS NOT NULL
        AND TIMESTAMPDIFF(SECOND, CONCAT(a.dataInizio, ' ', a.oraInizio), CONCAT(a.dataFine, ' ', a.oraFine)) =
            (
                SELECT MAX(
                    TIMESTAMPDIFF(SECOND, CONCAT(dataInizio, ' ', oraInizio), CONCAT(dataFine, ' ', oraFine))
                )
                FROM accessi
                WHERE dataFine IS NOT NULL
                AND oraFine IS NOT NULL
            )
        ORDER BY u.cognome, u.nome
    ";

    $result = executeSelect($sql);

    if ($result != null) {
        $risultati = $result;
    }

    return $risultati;
}

function getUltimoAccesso($idU) {
    $ultimo = "";

    $sql = "
        SELECT dataInizio, oraInizio
        FROM accessi
        WHERE utente = :utente
        AND dataFine IS NOT NULL
        AND oraFine IS NOT NULL
        ORDER BY idA DESC
        LIMIT 1
    ";

    $params = [
        ":utente" => $idU
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $ultimo = $result[0]["dataInizio"] . " " . $result[0]["oraInizio"];
    }

    return $ultimo;
}

function getUtentiCompleti() {
    $utenti = [];

    $sql = "
        SELECT *
        FROM utenti
        ORDER BY cognome, nome
    ";

    $result = executeSelect($sql);

    if ($result != null) {
        $utenti = $result;
    }

    return $utenti;
}

function getUtenteById($idU) {
    $utente = [];

    $sql = "
        SELECT *
        FROM utenti
        WHERE idU = :idU
    ";

    $params = [
        ":idU" => $idU
    ];

    $result = executeSelect($sql, $params);

    if ($result != null && count($result) > 0) {
        $utente = $result[0];
    }

    return $utente;
}

function updateUtente($idU, $nome, $cognome, $dataNascita, $sesso, $email, $password, $telefono, $residenza, $tipo) {
    $ok = false;

    $sql = "
        UPDATE utenti
        SET nome = :nome,
            cognome = :cognome,
            dataNascita = :dataNascita,
            sesso = :sesso,
            email = :email,
            password = :password,
            telefono = :telefono,
            residenza = :residenza,
            tipo = :tipo
        WHERE idU = :idU
    ";

    $params = [
        ":nome" => $nome,
        ":cognome" => $cognome,
        ":dataNascita" => $dataNascita,
        ":sesso" => $sesso,
        ":email" => $email,
        ":password" => $password,
        ":telefono" => $telefono,
        ":residenza" => $residenza,
        ":tipo" => $tipo,
        ":idU" => $idU
    ];

    $result = executeUpdateOrDelete($sql, $params);

    if ($result != null && $result > 0) {
        $ok = true;
    }

    return $ok;
}

?>