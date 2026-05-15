<?php
/**
 * ================================================
 * GET CLASS PROGRESS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Recupera il progresso di tutti gli studenti in una classe.
 * Usato dalla dashboard del docente per visualizzare il riepilogo della classe.
 * Include controlli di sicurezza per verificare che il docente acceda solo alle proprie classi.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve classId e teacherId come parametri GET
 * 2. Verifica che il docente sia il proprietario della classe
 * 3. Recupera tutti gli studenti della classe
 * 4. Recupera il progresso di tutti gli studenti in tutti i capitoli
 * 5. Organizza i dati in una struttura studente->capitoli
 * 6. Ritorna i dati organizzati
 * 
 * ENDPOINT: GET /php/api/get_class_progress.php?classId=1&teacherId=T_xxxxxxxx
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "data": [
 *     {
 *       "studentInfo": {
 *         "student_id": "S_xxxxxxxx",
 *         "nome": "Mario",
 *         "cognome": "Rossi"
 *       },
 *       "chapters": [...]
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
    "data" => []
];

// Legge i parametri GET
$classId = $_GET['classId'] ?? null;
$teacherId = $_GET['teacherId'] ?? null;

if ($classId && $teacherId) {
    try {
        // Controllo di sicurezza: verifica che la classe appartiene al docente
        $sqlCheck = "SELECT teacher_id FROM classes WHERE class_id = ? AND teacher_id = ? LIMIT 1";
        $check = executeSelect($sqlCheck, [$classId, $teacherId]);
        
        if (count($check) === 0) {
            $response["message"] = "Accesso negato a questa classe";
        } else {
            // Recupera tutti gli studenti della classe
            $sqlStudents = "SELECT student_id, nome, cognome FROM students WHERE class_id = ? ORDER BY cognome, nome ASC";
            $students = executeSelect($sqlStudents, [$classId]);

            // Recupera il progresso di tutti gli studenti in tutti i capitoli
            $sqlProgress = "SELECT p.*, c.titolo 
                            FROM student_chapter_progress p
                            JOIN chapters c ON p.chapter_id = c.chapter_id
                            JOIN students s ON p.student_id = s.student_id
                            WHERE s.class_id = ?
                            ORDER BY p.student_id, p.chapter_id";
            $progressData = executeSelect($sqlProgress, [$classId]);

            // Organizza i dati per studente con i suoi capitoli
            $organizedData = [];
            foreach ($students as $student) {
                $studentId = $student['student_id'];
                $organizedData[$studentId] = [
                    "studentInfo" => $student,
                    "chapters" => []
                ];
            }

            // Popola i dati di progresso organizzati
            foreach ($progressData as $prog) {
                $studentId = $prog['student_id'];
                if (isset($organizedData[$studentId])) {
                    $organizedData[$studentId]["chapters"][] = $prog;
                }
            }

            $response["success"] = true;
            $response["message"] = "Dati recuperati";
            $response["data"] = array_values($organizedData); // Ritorna come array indicizzato
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
