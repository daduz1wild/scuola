<?php
/**
 * ================================================
 * RESET PROGRESS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per resettare il progresso di uno studente.
 * Elimina tutti i record di progresso del capitolo per lo studente.
 * Utilizzato dal docente per resettare completamente i progressi di uno studente.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve il studentId via POST
 * 2. Valida che lo studentId sia presente
 * 3. Elimina tutti i record di progresso (student_chapter_progress) per lo studente
 * 4. Ritorna il risultato dell'operazione
 * 
 * ENDPOINT: POST /php/api/reset_progress.php
 * 
 * REQUEST:
 * {
 *   "studentId": "S_xxxxxxxx"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato"
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Reset failed"
];

// Valida lo studentId
if (!$input || !isset($input['studentId'])) {
    $response["message"] = "ID studente non valido";
} else {
    $studentId = $input['studentId'];

    try {
        // Elimina tutti i record di progresso per questo studente
        // Questo include il progresso di tutti i 5 capitoli
        $sqlDelete = "DELETE FROM student_chapter_progress WHERE student_id = ?";
        executeUpdateDelete($sqlDelete, [$studentId]);

        $response["success"] = true;
        $response["message"] = "Tutti i progressi sono stati azzerati";
    } catch (Exception $e) {
        $response["message"] = "Errore durante il reset: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
