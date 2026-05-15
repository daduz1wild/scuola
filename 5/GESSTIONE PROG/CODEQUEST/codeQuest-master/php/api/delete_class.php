<?php
/**
 * ================================================
 * DELETE CLASS API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per eliminare una classe.
 * L'insegnante può solo eliminare le proprie classi.
 * Gli studenti della classe vengono dissociati ma i loro dati rimangono.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con teacherId e classId
 * 2. Valida che il docente sia il proprietario della classe
 * 3. Elimina la classe (vincolo ON DELETE SET NULL dissocia gli studenti)
 * 4. Ritorna il risultato dell'operazione
 * 
 * ENDPOINT: POST /php/api/delete_class.php
 * 
 * REQUEST:
 * {
 *   "teacherId": "T_xxxxxxxx",
 *   "classId": 5
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

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Dati obbligatori mancanti"
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['teacherId'], $input['classId'])) {
    $teacherId = trim($input['teacherId']);
    $classId = intval($input['classId']);

    try {
        // 1. Verifica che il docente sia il proprietario della classe
        // Questo impedisce che un docente elimini le classi di altri docenti
        $sqlCheck = "SELECT class_id FROM classes WHERE class_id = ? AND teacher_id = ?";
        $existing = executeSelect($sqlCheck, [$classId, $teacherId]);

        if (count($existing) === 0) {
            $response["message"] = "Classe non trovata o non autorizzato";
        } else {
            // 2. Esegue l'eliminazione della classe
            // Nota: La tabella students ha ON DELETE SET NULL su class_id,
            // quindi gli studenti vengono dissociati ma non eliminati
            $sqlDelete = "DELETE FROM classes WHERE class_id = ?";
            $conn = getConnection();
            $stmt = $conn->prepare($sqlDelete);
            $stmt->execute([$classId]);
            $deleted = $stmt->rowCount();

            if ($deleted > 0) {
                $response["success"] = true;
                $response["message"] = "Classe eliminata correttamente";
            } else {
                $response["message"] = "Nessuna riga eliminata (già rimossa?)";
            }
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
