<?php
/**
 * ================================================
 * VALIDATE PUZZLE API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Valida il codice scritto dallo studente per una missione del puzzle.
 * Implementa validazione robusta per evitare bypass con commenti vuoti.
 * Controlla keywords richiesti, pattern regex e keywords vietati.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve il codice e la configurazione di validazione
 * 2. Rimuove i commenti HTML, JS e PHP dal codice
 * 3. Controlla se il codice è vuoto
 * 4. Verifica i keywords richiesti (case-insensitive)
 * 5. Verifica il pattern regex se definito
 * 6. Controlla i keywords vietati
 * 7. Ritorna il risultato con lista di errori se fallisce
 * 
 * ENDPOINT: POST /php/api/validate_puzzle.php
 * 
 * REQUEST:
 * {
 *   "code": "let x = 10;",
 *   "validation": {
 *     "requiredKeywords": ["let", "x"],
 *     "regex": "let\\s+\\w+",
 *     "negativeKeywords": ["eval"]
 *   }
 * }
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "errors": ["elenco errori di validazione"]
 * }
 */

header('Content-Type: application/json');
error_reporting(0); // Previene che gli errori PHP rompano l'output JSON

require_once '../config/database.php';

// Legge i dati JSON dal corpo della richiesta
$input = json_decode(file_get_contents('php://input'), true);

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Validazione fallita",
    "errors" => []
];

if (!$input || !isset($input['code'])) {
    $response["message"] = "Richiesta non valida";
} else {
    $code = $input['code'];
    $validation = $input['validation'] ?? null;

    // 1. PULIZIA DEL CODICE
    // Rimuove i commenti HTML (<!-- -->), JS (// e /* */)
    // Handle HTML comments: <!-- -->
    // Handle JS/PHP comments: // and /* */
    $cleanCode = preg_replace('/<!--[\s\S]*?-->|\/\*[\s\S]*?\*\/|([^:]|^)\/\/.*$/m', '', $code);
    $cleanCode = trim($cleanCode);

    // 2. VALIDAZIONE DI BASE
    $isValid = true;

    if (empty($cleanCode)) {
        $isValid = false;
        $response["errors"][] = "Il terminale è vuoto o contiene solo commenti. Scrivi la soluzione!";
    }

    // 3. VALIDAZIONE BASATA SU REGOLE (da JSON)
    if ($isValid && $validation) {
        // Controlla i keywords richiesti
        if (isset($validation['requiredKeywords']) && is_array($validation['requiredKeywords'])) {
            foreach ($validation['requiredKeywords'] as $kw) {
                // Usa stripos per ricerca case-insensitive
                if (stripos($code, $kw) === false) {
                    $isValid = false;
                    $response["errors"][] = "Manca l'elemento richiesto: " . htmlspecialchars($kw);
                }
            }
        }

        // Controlla il pattern regex se definito
        if ($isValid && isset($validation['regex']) && !empty($validation['regex'])) {
            try {
                if (!preg_match("#" . $validation['regex'] . "#i", $code)) {
                    $isValid = false;
                    $response["errors"][] = "La struttura del codice non è corretta per questa sfida.";
                }
            } catch (Exception $e) {
                // Ignora silenziosamente gli errori regex in produzione, ma fallisce in modo sicuro
            }
        }

        // Controlla i keywords vietati (cose che NON DOVREBBERO esserci)
        if ($isValid && isset($validation['negativeKeywords']) && is_array($validation['negativeKeywords'])) {
            foreach ($validation['negativeKeywords'] as $nkw) {
                if (stripos($code, $nkw) !== false) {
                    $isValid = false;
                    $response["errors"][] = "Elemento non ammesso trovato: " . htmlspecialchars($nkw);
                }
            }
        }
    }

    // 4. RISPOSTA FINALE
    if ($isValid) {
        $response["success"] = true;
        $response["message"] = "Eccellente! Codice validato correttamente.";
    } else {
        $response["success"] = false;
        if (empty($response["errors"])) {
            $response["errors"][] = "Il codice non soddisfa i requisiti della missione.";
        }
    }
}

// Ritorna la risposta in formato JSON
// Ritorna la risposta in formato JSON
echo json_encode($response);
