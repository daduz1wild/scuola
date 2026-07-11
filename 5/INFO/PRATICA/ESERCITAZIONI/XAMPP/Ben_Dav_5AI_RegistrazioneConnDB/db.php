<?php
# Benedetti Davide     5AI     19/04/2026     db.php

function getConnection() {
    $host = "localhost";
    $DBName = "bd_gestioneutenti";
    $username = "root";
    $password = "";
    $conn = null;

    try {
        $conn = new PDO("mysql:dbname=$DBName;host=$host", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $errore) {
        $conn = null;
    }

    return $conn;
}

function getPdoType($value) {
    $tipo = PDO::PARAM_STR;

    if (is_int($value)) {
        $tipo = PDO::PARAM_INT;
    } elseif (is_bool($value)) {
        $tipo = PDO::PARAM_BOOL;
    } elseif (is_null($value)) {
        $tipo = PDO::PARAM_NULL;
    }

    return $tipo;
}

function executeSelect($sql, $params = []) {
    $result = null;
    $conn = getConnection();

    if ($conn != null) {
        try {
            $stmt = $conn->prepare($sql);

            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value, getPdoType($value));
            }
            unset($value);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = null;
        }
    }

    return $result;
}

function executeInsert($sql, $params = []) {
    $result = null;
    $conn = getConnection();

    if ($conn != null) {
        try {
            $stmt = $conn->prepare($sql);

            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value, getPdoType($value));
            }
            unset($value);

            $stmt->execute();
            $result = $conn->lastInsertId();
        } catch (PDOException $e) {
            $result = null;
        }
    }

    return $result;
}

function executeUpdateOrDelete($sql, $params = []) {
    $result = null;
    $conn = getConnection();

    if ($conn != null) {
        try {
            $stmt = $conn->prepare($sql);

            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value, getPdoType($value));
            }
            unset($value);

            $stmt->execute();
            $result = $stmt->rowCount();
        } catch (PDOException $e) {
            $result = null;
        }
    }

    return $result;
}
?>