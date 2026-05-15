<?php
/**
 * ================================================
 * STUDENT REGISTRATION API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per la registrazione di un nuovo studente.
 * Lo studente deve fornire un codice classe valido.
 * Crea l'account e inizializza il progresso per il primo capitolo.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve POST con name, email, password e classCode
 * 2. Valida che il codice classe esista nel database
 * 3. Controlla che l'email non sia già registrata
 * 4. Genera ID univoco per lo studente
 * 5. Hash della password con bcrypt
 * 6. Inserisce lo studente nel database, associandolo alla classe
 * 7. Inizializza il record di progresso per il capitolo 1
 * 8. Ritorna success=true se va bene
 * 
 * ENDPOINT: POST /php/api/student_register.php
 * 
 * REQUEST:
 * {
 *   "name": "Mario Rossi",
 *   "email": "mario@scuola.it",
 *   "password": "password123",
 *   "classCode": "ABC123"
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "name": "Mario Rossi"
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Dati incompleti",
    "name" => ""
];

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['name'], $input['email'], $input['password'], $input['classCode'])) {
    $fullName = trim($input['name']);
    $email = trim($input['email']);
    $password = $input['password'];
    $classCode = trim($input['classCode']);

    // Dividi il nome completo in nome e cognome (separati da spazio)
    $nameParts = explode(' ', $fullName, 2);
    $nome = $nameParts[0];
    $cognome = isset($nameParts[1]) ? $nameParts[1] : "";

    try {
        // 1. Verifica che il codice classe esista
        $classData = executeSelect("SELECT class_id FROM classes WHERE class_code = ?", [$classCode]);
        
        if (count($classData) === 0) {
            $response["message"] = "Codice classe non valido";
        } else {
            $classId = $classData[0]['class_id'];

            // 2. Controlla che l'email non sia già registrata
            $existing = executeSelect("SELECT student_id FROM students WHERE email = ?", [$email]);

            if (count($existing) > 0) {
                $response["message"] = "Email già registrata";
            } else {
                // 3. Prepara i dati dello studente
                $studentId = "S_" . substr(md5(uniqid()), 0, 12);  // ID univoco
                $hash = password_hash($password, PASSWORD_BCRYPT);  // Hash sicura della password

                // 4. Inserisce lo studente nel database
                $sqlS = "INSERT INTO students (student_id, nome, cognome, email, password_hash, class_id) VALUES (?, ?, ?, ?, ?, ?)";
                $inserted = executeInsert($sqlS, [$studentId, $nome, $cognome, $email, $hash, $classId]);

                if ($inserted > 0) {
                    // 5. Inizializza il progresso per il capitolo 1
                    // Questo crea il record iniziale per il primo capitolo
                    $sqlP = "INSERT INTO student_chapter_progress (student_id, chapter_id) VALUES (?, 1)";
                    executeInsert($sqlP, [$studentId]);

                    $response["success"] = true;
                    $response["message"] = "Registrazione completata";
                    $response["name"] = $fullName;
                } else {
                    $response["message"] = "Errore durante la registrazione";
                }
            }
        }
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
