<?php
# Benedetti Davide     5AI     11/05/2026     api_accessiUtente.php

session_start();
require_once("funzioni.php");

$ris = [];

if (!isset($_SESSION['tipoUtente']) || $_SESSION['tipoUtente'] != "admin") {
    $ris = [];
} elseif (!isset($_GET['idU']) || $_GET['idU'] == "") {
    $ris = [];
} else {
    $idU = intval($_GET['idU']);
    $ris = getAccessiUtente($idU);
}

echo json_encode($ris);
?>