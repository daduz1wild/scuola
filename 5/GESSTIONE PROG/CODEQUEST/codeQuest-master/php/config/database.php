<?php
/**
 * ================================================
 * DATABASE CONFIGURATION - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Contiene le funzioni wrapper per l'accesso al database tramite PDO.
 * Implementa un pattern singleton per la connessione.
 * Fornisce metodi helper per SELECT, INSERT, UPDATE, DELETE.
 * 
 * FUNZIONAMENTO:
 * 1. getConnection() apre una connessione PDO una sola volta (singleton)
 * 2. executeSelect() esegue query SELECT e ritorna un array di righe
 * 3. executeInsert() esegue INSERT e ritorna il numero di righe inserite
 * 4. executeUpdateDelete() esegue UPDATE/DELETE e ritorna le righe modificate
 * 5. Tutte le funzioni usano prepared statements per evitare SQL injection
 * 
 * CONFIGURAZIONE:
 * - Host: localhost
 * - Database: codequest
 * - User: root (XAMPP default)
 * - Password: (vuota, XAMPP default)
 */

/**
 * OTTENIMENTO CONNESSIONE DATABASE
 * Implementa il pattern singleton: crea la connessione una sola volta
 * e la riusa per tutte le query
 * 
 * @return PDO Istanza della connessione
 * @throws Exception Se la connessione fallisce
 */
function getConnection() {
    static $conn = null;
    
    if ($conn === null) {
        $host     = "localhost";
        $dbname   = "codequest";
        $user     = "root";
        $password = "";
        
        try {
            // Crea connessione PDO con charset UTF-8
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
            // Configura il comportamento degli errori
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Imposta il fetch mode di default (risultati come array associativo)
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $conn = null; // Assicura che rimanga null in caso di errore
            throw new Exception("Errore di connessione al database");
        }
    }
    return $conn;
}

/**
 * ESECUZIONE QUERY SELECT
 * Esegue una query SELECT e ritorna tutti i risultati come array
 * 
 * UTILIZZO:
 *   $results = executeSelect("SELECT * FROM students WHERE class_id = ?", [$classId]);
 * 
 * @param String $sql - Query SQL con parametri placeholder (?)
 * @param Array $params - Array dei valori da sostituire ai placeholder
 * @return Array - Array di righe (ciascuna è un array associativo)
 * @throws Exception Se la query fallisce
 */
function executeSelect($sql, $params = []) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        throw new Exception("Errore durante la select: " . $e->getMessage());
    }
}

/**
 * ESECUZIONE QUERY INSERT
 * Esegue una query INSERT e ritorna il numero di righe inserite
 * 
 * UTILIZZO:
 *   $count = executeInsert("INSERT INTO students VALUES (?, ?, ?)", [$id, $name, $email]);
 * 
 * @param String $sql - Query SQL INSERT con parametri placeholder (?)
 * @param Array $params - Array dei valori da sostituire ai placeholder
 * @return Integer - Numero di righe inserite
 * @throws Exception Se la query fallisce
 */
function executeInsert($sql, $params = []) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount(); 
    } catch (Exception $e) {
        throw new Exception("Errore durante l'inserimento: " . $e->getMessage());
    }
}

/**
 * ESECUZIONE QUERY UPDATE/DELETE
 * Esegue una query UPDATE o DELETE e ritorna il numero di righe modificate
 * 
 * UTILIZZO:
 *   $count = executeUpdateDelete("UPDATE students SET email = ? WHERE student_id = ?", [$newEmail, $id]);
 *   $count = executeUpdateDelete("DELETE FROM classes WHERE class_id = ?", [$classId]);
 * 
 * @param String $sql - Query SQL UPDATE o DELETE con parametri placeholder (?)
 * @param Array $params - Array dei valori da sostituire ai placeholder
 * @return Integer - Numero di righe modificate
 * @throws Exception Se la query fallisce
 */
function executeUpdateDelete($sql, $params = []) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    } catch (Exception $e) {
        throw new Exception("Errore durante la modifica: " . $e->getMessage());
    }
}

/**
 * OTTENIMENTO ULTIMO ID INSERITO
 * Ritorna l'ID auto-generato dell'ultima riga inserita
 * Utile per INSERT con colonne auto-increment
 * 
 * @return String - ID dell'ultima riga inserita
 */
function getLastInsertedId() {
    return getConnection()->lastInsertId();
}
?>
