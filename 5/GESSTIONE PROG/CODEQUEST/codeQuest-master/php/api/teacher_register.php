<?php
/**
 * ================================================
 * TEACHER REGISTRATION API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per la registrazione di un nuovo insegnante.
 * Crea l'account nel database e ritorna un codice classe (deprecato - non più utilizzato).
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con name, email, password
 * 2. Valida che email e password non siano vuote
 * 3. Controlla se email esiste già
 * 4. Genera ID univoco per l'insegnante
 * 5. Hash della password con bcrypt
 * 6. Inserisce l'insegnante nel database
 * 7. Ritorna success=true se va bene, false altrimenti
 * 
 * ENDPOINT: POST /php/api/teacher_register.php
 * 
 * REQUEST:
 * {
 *   "name": "Mario Rossi",
 *   "email": "mario@scuola.it",
 *   "password": "password123"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "name": "Mario Rossi",
 *   "classCode": "XXXXXX" (deprecato, sempre vuoto)
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Dati obbligatori mancanti",
    "name" => "",
    "classCode" => ""
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

// Controlla che tutti i campi obbligatori siano presenti
if (isset($input['name'], $input['email'], $input['password'])) {
    $fullName = trim($input['name']);
    $email = trim($input['email']);
    $password = $input['password'];

    // Dividi il nome completo in nome e cognome (separati da spazio)
    $nameParts = explode(' ', $fullName, 2);
    $nome = $nameParts[0];
    $cognome = isset($nameParts[1]) ? $nameParts[1] : "";

    try {
        // 1. Controlla se l'email è già registrata
        $existing = executeSelect("SELECT teacher_id FROM teachers WHERE email = ?", [$email]);
        
        if (count($existing) > 0) {
            $response["message"] = "Email già registrata";
        } else {
            // 2. Prepara i dati per l'insegnante
            $teacherId = "T_" . substr(md5(uniqid()), 0, 8);  // ID univoco
            $hash = password_hash($password, PASSWORD_BCRYPT);  // Hash sicura della password

            // 3. Inserisce l'insegnante nel database
            $sqlT = "INSERT INTO teachers (teacher_id, nome, cognome, email, password_hash) VALUES (?, ?, ?, ?, ?)";
            $inserted = executeInsert($sqlT, [$teacherId, $nome, $cognome, $email, $hash]);

            if ($inserted > 0) {
                // Registrazione riuscita
                $response["success"] = true;
                $response["message"] = "Account creato con successo";
                $response["name"] = $fullName;
                // classCode è vuoto (non creiamo classe di default)
                $response["classCode"] = "";
            } else {
                $response["message"] = "Errore durante la creazione dell'account";
            }
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
