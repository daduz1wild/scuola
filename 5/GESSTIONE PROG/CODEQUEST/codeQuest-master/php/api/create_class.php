<?php
/**
 * ================================================
 * CREATE CLASS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per creare una nuova classe.
 * L'insegnante fornisce il nome della classe.
 * Il sistema genera automaticamente un codice univoco di 6 caratteri.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con teacherId e className
 * 2. Valida che i dati non siano vuoti
 * 3. Genera un codice classe univoco (fino a 10 tentativi)
 * 4. Inserisce la classe nel database
 * 5. Ritorna il codice generato
 * 
 * ENDPOINT: POST /php/api/create_class.php
 * 
 * REQUEST:
 * {
 *   "teacherId": "T_xxxxxxxx",
 *   "className": "Classe 3A"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "classCode": "ABC123"
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Dati obbligatori mancanti",
    "classCode" => ""
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['teacherId'], $input['className'])) {
    $teacherId = trim($input['teacherId']);
    $className = trim($input['className']);

    try {
        // 1. Genera un codice classe univoco
        $isUnique = false;
        $classCode = "";
        $attempts = 0;

        // Tenta di generare un codice univoco (max 10 tentativi)
        while (!$isUnique && $attempts < 10) {
            // Genera 6 caratteri alfanumerici casuali
            $classCode = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
            
            // Controlla se il codice esiste già
            $existing = executeSelect("SELECT class_id FROM classes WHERE class_code = ?", [$classCode]);
            if (count($existing) === 0) {
                $isUnique = true;
            }
            $attempts++;
        }

        if (!$isUnique) {
            // Non è riuscito a generare un codice univoco dopo 10 tentativi
            $response["message"] = "Impossibile generare un codice univoco. Riprova.";
        } else {
            // 2. Inserisce la nuova classe nel database
            $sql = "INSERT INTO classes (class_code, teacher_id, class_name) VALUES (?, ?, ?)";
            $inserted = executeInsert($sql, [$classCode, $teacherId, $className]);

            if ($inserted > 0) {
                $response["success"] = true;
                $response["message"] = "Classe creata con successo";
                $response["classCode"] = $classCode;
            } else {
                $response["message"] = "Errore durante l'inserimento della classe";
            }
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
