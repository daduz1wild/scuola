<?php
# Benedetti Davide     5AI     19/04/2026     checkUser.php

session_start();
require_once("funzioni.php");

if (isset($_POST['user']) && isset($_POST['psw'])) {
    $user = trim($_POST['user']);
    $psw = $_POST['psw'];

    $tipo = checkTipo($user, $psw);

    if ($tipo == "") {
        header("Location: index.php?err=Credenziali errate");
    } else {
        $idU = getIdUtente($user, $psw);

        if ($idU != -1) {
            $ok = addAccesso($idU);

            if ($ok) {
                $_SESSION['tipoUtente'] = $tipo;
                $_SESSION['username'] = $user;
                $_SESSION['idU'] = $idU;
                $_SESSION['ultimoAccesso'] = date("d/m/Y H:i:s");

                if ($tipo == "admin") {
                    header("Location: admin.php");
                } elseif ($tipo == "client") {
                    header("Location: client.php");
                } else {
                    header("Location: index.php?err=Errore imprevisto");
                }
            } else {
                header("Location: index.php?err=Errore durante l'accesso");
            }
        } else {
            header("Location: index.php?err=Errore imprevisto");
        }
    }
} else {
    header("Location: index.php?err=Richiesta non valida");
}
?>