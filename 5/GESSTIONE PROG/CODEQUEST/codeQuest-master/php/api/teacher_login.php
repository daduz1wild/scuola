<?php
/**
 * ================================================
 * TEACHER LOGIN API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per il login di un insegnante.
 * Autentica l'utente tramite email e password.
 * Ritorna i dati dell'insegnante se le credenziali sono corrette.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con email e password
 * 2. Valida che email e password non siano vuote
 * 3. Cerca l'insegnante nel database per email
 * 4. Verifica la password con bcrypt
 * 5. Se tutto ok, ritorna teacherId e name
 * 
 * ENDPOINT: POST /php/api/teacher_login.php
 * 
 * REQUEST:
 * {
 *   "email": "prof@scuola.it",
 *   "password": "password123"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "teacherId": "T_xxxxxxxx",
 *   "name": "Mario Rossi",
 *   "classCode": "ABC123" (deprecato, sempre vuoto)
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Email o password mancanti",
    "teacherId" => null,
    "name" => "",
    "classCode" => ""
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['email'], $input['password'])) {
    $email = trim($input['email']);
    $password = $input['password'];

    try {
        // 1. Cerca l'insegnante per email
        // Recupera anche il codice della prima classe (se esiste) - deprecato
        $sql = "SELECT t.teacher_id, t.nome, t.cognome, t.password_hash, c.class_code 
                FROM teachers t 
                LEFT JOIN classes c ON t.teacher_id = c.teacher_id 
                WHERE t.email = ? LIMIT 1";
        $results = executeSelect($sql, [$email]);

        if (count($results) === 1) {
            $user = $results[0];
            
            // 2. Verifica la password
            if (password_verify($password, $user['password_hash'])) {
                // Credenziali corrette
                $response["success"] = true;
                $response["message"] = "Login effettuato";
                $response["teacherId"] = $user['teacher_id'];
                $response["name"] = trim($user['nome'] . " " . $user['cognome']);
                // classCode non è più utilizzato (sempre null)
                $response["classCode"] = $user['class_code'];
            } else {
                // Password sbagliata
                $response["message"] = "Password errata";
            }
        } else {
            // Email non trovata
            $response["message"] = "Email non trovata";
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
