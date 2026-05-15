<?php
require_once 'php/config/database.php';

$tables = ['students', 'classes', 'chapters', 'student_chapter_progress'];

foreach ($tables as $table) {
    echo "\n--- TABLE: $table ---\n";
    try {
        $results = executeSelect("DESCRIBE $table");
        foreach ($results as $row) {
            echo "{$row['Field']} | {$row['Type']} | {$row['Null']} | {$row['Key']} | {$row['Default']} | {$row['Extra']}\n";
        }
    } catch (Exception $e) {
        echo "Error describing table $table: " . $e->getMessage() . "\n";
    }
}
