<?php
# Benedetti Davide     5AI     19/12/2025     checkUser.php
session_start();
require_once("funzioni.php");

if (isset($_POST['user']) && isset($_POST['psw'])) {
    $user = $_POST['user'];
    $psw = $_POST['psw'];

    $tipo = checkTipo($user, $psw);

    if ($tipo == "") {
        header("Location: index.php?err=Credenziali errate");
    } else {
        $_SESSION['tipoUtente'] = $tipo;
        $_SESSION['username'] = $user;

        if ($tipo == "admin") {
            header("Location: admin.php");
        } elseif ($tipo == "client") {
            header("Location: client.php");
        } else {
            header("Location: index.php?err=Errore imprevisto");
        }
    }
} else {
    header("Location: index.php?err=Richiesta non valida");
}
?>
