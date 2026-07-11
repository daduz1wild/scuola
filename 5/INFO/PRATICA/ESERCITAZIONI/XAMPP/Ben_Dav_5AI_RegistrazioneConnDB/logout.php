<?php

# Benedetti Davide     5AI     19/04/2026     logout.php

session_start();
require_once("funzioni.php");

if (isset($_SESSION['idU'])) {
    chiudiUltimoAccesso($_SESSION['idU']);
}

session_unset();
session_destroy();

header("Location: index.php");
?>