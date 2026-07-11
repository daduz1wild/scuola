<?php
# Benedetti Davide     5AI     19/04/2026     client.php

session_start();
require_once("funzioni.php");

if (!isset($_SESSION['tipoUtente'])) {
    header("Location: index.php");
} elseif ($_SESSION['tipoUtente'] != "client") {
    header("Location: index.php");
} else {
    $messaggio = "";
    $op = "";
    $utente = getUtenteById($_SESSION['idU']);
    $accessi = [];

    $ultimoAccesso = "Primo accesso";
    if (isset($_SESSION['ultimoAccesso']) && $_SESSION['ultimoAccesso'] != "") {
        $ultimoAccesso = $_SESSION['ultimoAccesso'];
    }

    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $op == "modificaProfilo") {
        $nome = "";
        $cognome = "";
        $dataNascita = "";
        $sesso = "";
        $email = "";
        $password = "";
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
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['telefono'])) {
            $telefono = trim($_POST['telefono']);
        }
        if (isset($_POST['residenza'])) {
            $residenza = trim($_POST['residenza']);
        }

        if ($nome != "" && $cognome != "" && $dataNascita != "" && $sesso != "" && $email != "" && $password != "" && $telefono != "" && $residenza != "") {
            $tipo = $utente['tipo'];

            $ok = updateUtente($_SESSION['idU'], $nome, $cognome, $dataNascita, $sesso, $email, $password, $telefono, $residenza, $tipo);

            if ($ok) {
                $messaggio = "Profilo aggiornato con successo";
                $_SESSION['username'] = $email;
                $utente = getUtenteById($_SESSION['idU']);
            } else {
                $messaggio = "Errore durante l'aggiornamento del profilo";
            }
        } else {
            $messaggio = "Compila tutti i campi";
        }
    } elseif ($op == "cronologiaAccessi") {
        $accessi = getAccessiUtente($_SESSION['idU']);
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Client</title>
</head>
<body>

<h1>Benvenuto <?php echo $_SESSION['username']; ?></h1>
<p>Ultimo accesso: <?php echo $ultimoAccesso; ?></p>

<nav style="margin-bottom:20px;">
    <a href="client.php?op=modificaProfilo">Modifica profilo</a> |
    <a href="client.php?op=cronologiaAccessi">Cronologia accessi</a>
</nav>

<?php
if ($messaggio != "") {
    echo "<p><strong>$messaggio</strong></p>";
}

if ($op == "modificaProfilo") {
?>
    <h2>Modifica il mio profilo</h2>

    <form method="POST" action="client.php?op=modificaProfilo">
        Nome: <input type="text" name="nome" value="<?php echo $utente['nome']; ?>" required><br><br>
        Cognome: <input type="text" name="cognome" value="<?php echo $utente['cognome']; ?>" required><br><br>
        Data nascita: <input type="date" name="dataNascita" value="<?php echo $utente['dataNascita']; ?>" required><br><br>
        Sesso:
        <select name="sesso" required>
            <option value="M" <?php if ($utente['sesso'] == "M") echo "selected"; ?>>M</option>
            <option value="F" <?php if ($utente['sesso'] == "F") echo "selected"; ?>>F</option>
        </select><br><br>
        Email: <input type="email" name="email" value="<?php echo $utente['email']; ?>" required><br><br>
        Password: <input type="text" name="password" value="<?php echo $utente['password']; ?>" required><br><br>
        Telefono: <input type="text" name="telefono" value="<?php echo $utente['telefono']; ?>" required><br><br>
        Residenza: <input type="text" name="residenza" value="<?php echo $utente['residenza']; ?>" required><br><br>
        <input type="submit" value="Salva modifiche">
    </form>

<?php
} elseif ($op == "cronologiaAccessi") {
?>
    <h2>Cronologia dei miei accessi</h2>

    <table border="1">
        <tr>
            <th>ID Accesso</th>
            <th>Data inizio</th>
            <th>Ora inizio</th>
            <th>Data fine</th>
            <th>Ora fine</th>
        </tr>

        <?php
        if (count($accessi) > 0) {
            foreach ($accessi as $a) {
                echo "<tr>";
                echo "<td>" . $a["idA"] . "</td>";
                echo "<td>" . $a["dataInizio"] . "</td>";
                echo "<td>" . $a["oraInizio"] . "</td>";
                echo "<td>" . $a["dataFine"] . "</td>";
                echo "<td>" . $a["oraFine"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td>Nessun accesso trovato</td></tr>";
        }
        ?>
    </table>

<?php
}
?>

<br>
<a href="logout.php">LOGOUT</a>

</body>
</html>
<?php
}
?>