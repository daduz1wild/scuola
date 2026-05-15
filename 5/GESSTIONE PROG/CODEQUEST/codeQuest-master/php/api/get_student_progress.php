<?php
/**
 * ================================================
 * GET STUDENT PROGRESS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Recupera i progressi di uno studente dal database.
 * Utilizzato quando uno studente fa login e non ha un save locale.
 * Converte i dati del DB nel formato GameState per sincronizzare il gioco.
 * 
 * ENDPOINT: POST /php/api/get_student_progress.php
 * 
 * REQUEST:
 * {
 *   "studentId": "S_xxxxxxxx"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "progress": {
 *     "currentChapter": 1,
 *     "puzzlesCompleted": { "1": [0, 1], "2": [0] },
 *     "bossesDefeated": [1],
 *     "araCorruption": 0.1,
 *     "hintsUsed": []
 *   }
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta
$response = [
    "success" => false,
    "message" => "ID studente mancante",
    "progress" => null
];

// Legge il corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['studentId'])) {
    $studentId = trim($input['studentId']);
    error_log('[GET_PROGRESS] Fetching progress for studentId: ' . $studentId);
    
    try {
        // Recupera il capitolo corrente dello studente
        $sql = "SELECT COALESCE(MAX(chapter_id), 1) as current_chapter FROM student_chapter_progress WHERE student_id = ? AND (mission_1_completed = 1 OR mission_2_completed = 1 OR mission_3_completed = 1 OR mission_4_completed = 1 OR boss_completed = 1)";
        $currentChapter = executeSelect($sql, [$studentId]);
        $current = $currentChapter[0]['current_chapter'] ?? 1;
        error_log('[GET_PROGRESS] Current chapter: ' . $current);
        
        // Recupera tutti i progressi dello studente
        $sql = "SELECT chapter_id, mission_1_completed, mission_2_completed, mission_3_completed, mission_4_completed, boss_completed FROM student_chapter_progress WHERE student_id = ? ORDER BY chapter_id ASC";
        $results = executeSelect($sql, [$studentId]);
        error_log('[GET_PROGRESS] Query results count: ' . count($results));
        
        // Converte i risultati nel formato GameState
        $puzzlesCompleted = [];
        $bossesDefeated = [];
        
        foreach ($results as $row) {
            $chapterIdx = $row['chapter_id'];
            $puzzlesCompleted[$chapterIdx] = [];
            
            // Aggiungi le missioni completate
            if ($row['mission_1_completed'] == 1) $puzzlesCompleted[$chapterIdx][] = 0;
            if ($row['mission_2_completed'] == 1) $puzzlesCompleted[$chapterIdx][] = 1;
            if ($row['mission_3_completed'] == 1) $puzzlesCompleted[$chapterIdx][] = 2;
            if ($row['mission_4_completed'] == 1) $puzzlesCompleted[$chapterIdx][] = 3;
            
            // Traccia i boss sconfitti
            if ($row['boss_completed'] == 1) $bossesDefeated[] = $chapterIdx;
        }
        
        // Costruisci l'oggetto di progresso nel formato GameState
        $gameProgress = [
            "currentChapter" => $current,
            "puzzlesCompleted" => $puzzlesCompleted,
            "bossesDefeated" => $bossesDefeated,
            "araCorruption" => 0.1,
            "hintsUsed" => []
        ];
        
        $response["success"] = true;
        $response["message"] = "Progressi recuperati dal server";
        $response["progress"] = $gameProgress;
        error_log('[GET_PROGRESS] Response: ' . json_encode($response));
        
    } catch (Exception $e) {
        $response["message"] = "Errore nel recupero dei progressi: " . $e->getMessage();
        error_log('[GET_PROGRESS] Exception: ' . $e->getMessage());
    }
} else {
    $response["message"] = "ID studente mancante nella richiesta";
    error_log('[GET_PROGRESS] No studentId provided');
}

echo json_encode($response);
?>
