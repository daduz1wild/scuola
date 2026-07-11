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

function accessiPerNomeCognome($nome, $cognome) {
    $risultati = [];

    $sql = "
        SELECT a.*
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE u.nome = :nome
        AND u.cognome = :cognome
        ORDER BY a.dataInizio DESC, a.oraInizio DESC
    ";

    $params = [
        ":nome" => $nome,
        ":cognome" => $cognome
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
               TIMESTAMPDIFF(HOUR, CONCAT(a.dataInizio, ' ', a.oraInizio), CONCAT(a.dataFine, ' ', a.oraFine)) AS durataAcc
        FROM accessi a
        INNER JOIN utenti u ON a.utente = u.idU
        WHERE a.dataFine IS NOT NULL
        AND a.oraFine IS NOT NULL
        AND TIMESTAMPDIFF(HOUR, CONCAT(a.dataInizio, ' ', a.oraInizio), CONCAT(a.dataFine, ' ', a.oraFine)) > 1
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