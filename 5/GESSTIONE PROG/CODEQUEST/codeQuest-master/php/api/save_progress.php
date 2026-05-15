<?php
/**
 * ================================================
 * SAVE PROGRESS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Salva il progresso dello studente nel database.
 * Registra il completamento di una missione specifica o del boss.
 * Usato dal gioco per sincronizzare i progressi.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con studentId, chapter, missionIdx
 * 2. Valida che lo studentId sia presente
 * 3. Determina la colonna corretta (mission_1/2/3/4_completed o boss_completed)
 * 4. Se il record esiste, esegue UPDATE; altrimenti INSERT
 * 5. Ritorna il risultato dell'operazione
 * 
 * ENDPOINT: POST /php/api/save_progress.php
 * 
 * REQUEST:
 * {
 *   "studentId": "S_xxxxxxxx",
 *   "chapter": 1,
 *   "missionIdx": 0 (oppure 1, 2, 3, o 'boss')
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "debug": { ... }
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Salvataggio fallito"
];

// Valida lo studentId
if (!$input || !isset($input['studentId'])) {
    $response["message"] = "ID studente non valido";
} else {
    $studentId = $input['studentId'];
    $chapterId = $input['chapter'] ?? 1;  // Default capitolo 1
    $missionIdx = $input['missionIdx'] ?? null;  // 0, 1, 2, 3 o 'boss'

    if ($missionIdx === null) {
        $response["message"] = "ID missione mancante";
    } else {

try {
    // 1. Determina la colonna corretta in base allo schema
    // missionIdx è 0-based per le missioni normali, oppure 'boss' per il boss finale
    $column = "";
    if ($missionIdx === 'boss') {
        $column = "boss_completed";
    } else {
        // Converte 0,1,2,3 a 1,2,3,4 e crea il nome della colonna
        $idx = intval($missionIdx) + 1;
        $column = "mission_{$idx}_completed";
    }

    // 2. Controlla se il record per questo studente e capitolo già esiste
    $sqlCheck = "SELECT student_id FROM student_chapter_progress WHERE student_id = ? AND chapter_id = ?";
    $exists = executeSelect($sqlCheck, [$studentId, $chapterId]);

    if (count($exists) > 0) {
        // Il record esiste: esegui UPDATE sulla colonna della missione
        $sqlUpdate = "UPDATE student_chapter_progress SET $column = 1 WHERE student_id = ? AND chapter_id = ?";
        executeUpdateDelete($sqlUpdate, [$studentId, $chapterId]);
    } else {
        // Il record non esiste: esegui INSERT creando una nuova riga
        $sqlInsert = "INSERT INTO student_chapter_progress (student_id, chapter_id, $column) VALUES (?, ?, 1)";
        executeInsert($sqlInsert, [$studentId, $chapterId]);
    }

    // Operazione riuscita
    $response["success"] = true;
    $response["message"] = "Missione registrata: $column = 1";
    // Informazioni di debug (rimozione consigliata in produzione)
    $response["debug"] = [
        "studentId" => $studentId,
        "chapterId" => $chapterId,
        "column" => $column,
        "mode" => (count($exists) > 0 ? "UPDATE" : "INSERT")
    ];
} catch (Exception $e) {
        $response["message"] = "Errore Database: " . $e->getMessage();
    }
    }
}

// Ritorna la risposta in formato JSON in un unico punto
echo json_encode($response);
