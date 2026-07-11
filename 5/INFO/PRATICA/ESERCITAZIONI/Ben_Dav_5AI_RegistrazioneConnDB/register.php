<?php

# Benedetti Davide     5AI     25/04/2025     register.php

session_start();
require_once("funzioni.php");

if (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "client") {
    header("Location: client.php");
} elseif (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "admin") {
    header("Location: admin.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome = "";
        $cognome = "";
        $dataNascita = "";
        $sesso = "";
        $email = "";
        $psw = "";
        $psw2 = "";
        $telefono = "";
        $residenza = "";

        if (isset($_POST['nome'])) {
            $nome = trim($_POST['nome']);
        }
        if (isset($_POST['cognome'])) {
            $cognome = trim($_POST['cognome']);
        }
        if (isset($_POST['dataNascita'])) {
            $dataNascita = $_POST['dataNascita'];
        }
        if (isset($_POST['sesso'])) {
            $sesso = $_POST['sesso'];
        }
        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
        }
        if (isset($_POST['psw'])) {
            $psw = $_POST['psw'];
        }
        if (isset($_POST['psw2'])) {
            $psw2 = $_POST['psw2'];
        }
        if (isset($_POST['telefono'])) {
            $telefono = trim($_POST['telefono']);
        }
        if (isset($_POST['residenza'])) {
            $residenza = trim($_POST['residenza']);
        }

        if ($nome == "" || $cognome == "" || $dataNascita == "" || $sesso == "" || $email == "" || $psw == "" || $psw2 == "" || $telefono == "" || $residenza == "") {
            header("Location: register.php?err=Compilare tutti i campi");
        } elseif ($psw != $psw2) {
            header("Location: register.php?err=Le password non coincidono");
        } elseif (userExists($email)) {
            header("Location: register.php?err=Email già presente");
        } elseif (telefonoExists($telefono)) {
            header("Location: register.php?err=Telefono già presente");
        } else {
            $idTipo = getIdTipo("client");
            $ok = false;

            if ($idTipo != -1) {
                $ok = addUser($nome, $cognome, $dataNascita, $sesso, $email, $psw, $telefono, $residenza, $idTipo);
            }

            if ($ok) {
                header("Location: index.php?err=Registrazione completata");
            } else {
                header("Location: register.php?err=Errore durante la registrazione");
            }
        }

    } else {
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
</head>
<body>

<h2>REGISTRAZIONE</h2>

<?php
if (isset($_GET['err'])) {
    echo "<p style='color:red'>" . $_GET['err'] . "</p>";
}
?>

<form action="register.php" method="POST">
    Nome: <input type="text" name="nome" required><br><br>
    Cognome: <input type="text" name="cognome" required><br><br>
    Data nascita: <input type="date" name="dataNascita" required><br><br>
    Sesso:
    <select name="sesso" required>
        <option value="">Seleziona</option>
        <option value="M">M</option>
        <option value="F">F</option>
    </select><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="psw" required><br><br>
    Conferma Password: <input type="password" name="psw2" required><br><br>
    Telefono: <input type="text" name="telefono" maxlength="10" required><br><br>
    Residenza: <input type="text" name="residenza" required><br><br>
    <input type="submit" value="Registrati">
</form>

<p><a href="index.php">Vai al login</a></p>

</body>
</html>
<?php
    }
}
?>