<?php
/**
 * ================================================
 * GET STUDENT DETAIL API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Recupera i dati completi dello studente e il suo progresso in tutti i capitoli.
 * Usato dalla dashboard dello studente per visualizzare il profilo e il progresso.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve il studentId come parametro GET
 * 2. Recupera le informazioni dello studente (nome, email, classe)
 * 3. Recupera il progresso dello studente in tutti i 5 capitoli
 * 4. Ritorna i dati in un oggetto con student e progress
 * 
 * ENDPOINT: GET /php/api/get_student_detail.php?studentId=S_xxxxxxxx
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "student": {
 *     "student_id": "S_xxxxxxxx",
 *     "nome": "Mario",
 *     "cognome": "Rossi",
 *     "email": "mario@scuola.it",
 *     "class_name": "Classe 3A"
 *   },
 *   "progress": [
 *     {
 *       "student_id": "S_xxxxxxxx",
 *       "chapter_id": 1,
 *       "mission_1_completed": 1,
 *       "mission_2_completed": 0,
 *       ...
 *     }
 *   ]
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Parametri mancanti",
    "student" => null,
    "progress" => []
];

// Legge il studentId dai parametri GET
$studentId = $_GET['studentId'] ?? null;

if ($studentId) {
    try {
        // Recupera le informazioni dello studente
        $sqlStudent = "SELECT s.student_id, s.nome, s.cognome, s.email, cl.class_name 
                       FROM students s
                       LEFT JOIN classes cl ON s.class_id = cl.class_id
                       WHERE s.student_id = ? LIMIT 1";
        $studentInfo = executeSelect($sqlStudent, [$studentId]);

        if (count($studentInfo) > 0) {
            $response["student"] = $studentInfo[0];
            
            // Recupera il progresso dello studente in tutti i capitoli
            $sqlProgress = "SELECT p.*, c.titolo 
                            FROM student_chapter_progress p
                            JOIN chapters c ON p.chapter_id = c.chapter_id
                            WHERE p.student_id = ?
                            ORDER BY p.chapter_id ASC";
            $progress = executeSelect($sqlProgress, [$studentId]);
            
            $response["success"] = true;
            $response["message"] = "Dati studente recuperati";
            $response["progress"] = $progress;
        } else {
            $response["message"] = "Studente non trovato";
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
