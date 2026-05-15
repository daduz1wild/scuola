<?php
/**
 * ================================================
 * GET TEACHER CLASSES API - CodeQuest
 * ================================================
 * 
 * DESCRIZIONE:
 * Recupera tutte le classi create da un insegnante.
 * Usato dalla dashboard del docente per popolare i dropdown e la lista delle classi.
 * 
 * FUNZIONAMENTO:
 * 1. Riceve il teacherId come parametro GET
 * 2. Recupera tutte le classi associate a quell'insegnante
 * 3. Ordina le classi per nome
 * 4. Ritorna l'array delle classi
 * 
 * ENDPOINT: GET /php/api/get_teacher_classes.php?teacherId=T_xxxxxxxx
 * 
 * RESPONSE:
 * {
 *   "success": true/false,
 *   "message": "messaggio di stato",
 *   "classes": [
 *     {
 *       "class_id": 1,
 *       "class_code": "ABC123",
 *       "class_name": "Classe 3A"
 *     },
 *     {
 *       "class_id": 2,
 *       "class_code": "XYZ789",
 *       "class_name": "Classe 4B"
 *     }
 *   ]
 * }
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// Inizializza la risposta di default (fallimento)
$response = [
    "success" => false,
    "message" => "Insegnante non identificato",
    "classes" => []
];

// Legge il teacherId dai parametri GET
// In un'applicazione reale, useremmo una sessione sicura.
$teacherId = $_GET['teacherId'] ?? null;

if ($teacherId) {
    try {
        // Recupera tutte le classi dell'insegnante, ordinate per nome
        $sql = "SELECT class_id, class_code, class_name FROM classes WHERE teacher_id = ? ORDER BY class_name ASC";
        $results = executeSelect($sql, [$teacherId]);

        $response["success"] = true;
        $response["message"] = "Classi recuperate";
        $response["classes"] = $results;
    } catch (Exception $e) {
        $response["message"] = "Errore di sistema: " . $e->getMessage();
    }
}

// Ritorna la risposta in formato JSON
echo json_encode($response);
?>
