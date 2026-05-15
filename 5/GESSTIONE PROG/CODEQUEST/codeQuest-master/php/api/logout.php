<?php
/**
 * ================================================
 * LOGOUT API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Endpoint per il logout dell'utente.
 * Distrugge la sessione PHP (se utilizzata).
 * In CodeQuest, il logout è principalmente gestito lato client 
 * tramite la pulizia di localStorage.
 * 
 * FUNZIONAMENTO:
 * 1. Avvia la sessione
 * 2. Unset e destroy della sessione
 * 3. Ritorna un messaggio di successo
 * 
 * ENDPOINT: GET/POST /php/api/logout.php
 * 
 * RESPONSE:
 * {
 *   "success": true,
 *   "message": "Logout effettuato"
 * }
 */

session_start();
session_unset();
session_destroy();

header('Content-Type: application/json');
echo json_encode(["success" => true, "message" => "Logout effettuato"]);
?>
