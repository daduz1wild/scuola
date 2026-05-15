<?php
/**
 * ================================================
 * STUDENT LOGIN API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per il login di uno studente.
 * Autentica l'utente tramite email e password.
 * Ritorna i dati dello studente se le credenziali sono corrette.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con email e password
 * 2. Valida che email e password non siano vuote
 * 3. Cerca lo studente nel database per email
 * 4. Verifica che lo studente faccia parte di una classe
 * 5. Verifica la password con bcrypt
 * 6. Se tutto ok, ritorna studentId e name
 * 
 * ENDPOINT: POST /php/api/student_login.php
 * 
 * REQUEST:
 * {
 *   "email": "studente@scuola.it",
 *   "password": "password123"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "studentId": "S_xxxxxxxx",
 *   "name": "Mario Rossi"
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Credenziali mancanti",
    "studentId" => null,
    "name" => ""
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['email'], $input['password'])) {
    $email = trim($input['email']);
    $password = $input['password'];

    try {
        // 1. Cerca lo studente per email
        $sql = "SELECT student_id, nome, cognome, password_hash, class_id FROM students WHERE email = ? LIMIT 1";
        $results = executeSelect($sql, [$email]);

        if (count($results) === 1) {
            $user = $results[0];
            
            // 2. Verifica che lo studente faccia parte di una classe
            // Uno studente senza classe_id non può accedere
            if (is_null($user['class_id'])) {
                $response["message"] = "Accesso negato: Non fai parte di nessuna classe. Contatta il tuo docente.";
            } 
            // 3. Verifica la password
            else if (password_verify($password, $user['password_hash'])) {
                // Credenziali corrette
                $response["success"] = true;
                $response["message"] = "Login effettuato";
                $response["studentId"] = $user['student_id'];
                $response["name"] = trim($user['nome'] . " " . $user['cognome']);
            } else {
                // Password sbagliata
                $response["message"] = "Password errata";
            }
        } else {
            // Email non trovata
            $response["message"] = "Account non trovato";
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
