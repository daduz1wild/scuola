<?php
# Benedetti Davide     5AI     19/04/2026     admin.php

session_start();
require_once("funzioni.php");

if (!isset($_SESSION['tipoUtente']) || $_SESSION['tipoUtente'] != "admin") {
    header("Location: index.php");
}

$op = "";
$messaggio = "";
$risultati = [];
$utenti = getUtenti();
$utenteDaModificare = [];
$ultimoAccesso = "Primo accesso";

if (isset($_SESSION['ultimoAccesso']) && $_SESSION['ultimoAccesso'] != "") {
    $ultimoAccesso = $_SESSION['ultimoAccesso'];
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}

if ($op == "accessiDurataSup1h") {
    $risultati = accessiDurataSup1h();
} elseif ($op == "durataMassima") {
    $risultati = utenteDurataMassima();
} elseif ($op == "utentiAlfabetico") {
    $sql = "
        SELECT *
        FROM utenti
        ORDER BY cognome, nome
    ";
    $risultati = executeSelect($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $op != "") {
    if ($op == "deleteUser") {
        if (isset($_POST['idU']) && $_POST['idU'] != "") {
            $idU = intval($_POST['idU']);

            if ($idU > 0) {
                if (deleteUser($idU)) {
                    $messaggio = "Utente eliminato con successo";
                } else {
                    $messaggio = "Errore durante la cancellazione dell'utente";
                }
            } else {
                $messaggio = "Seleziona un utente valido";
            }
        } else {
            $messaggio = "Seleziona un utente";
        }

    } elseif ($op == "deleteAccessiPrimaData") {
        if (isset($_POST['data']) && $_POST['data'] != "") {
            if (deleteAccessiPrimaData($_POST['data'])) {
                $messaggio = "Accessi eliminati con successo";
            } else {
                $messaggio = "Errore durante la cancellazione degli accessi";
            }
        } else {
            $messaggio = "Inserisci una data";
        }

    } elseif ($op == "utentiNatiPrima") {
        if (isset($_POST['data']) && $_POST['data'] != "") {
            $risultati = utentiNatiPrima($_POST['data']);
        }

    } elseif ($op == "utentiNatiAnno") {
        if (isset($_POST['anno']) && $_POST['anno'] != "") {
            $risultati = utentiNatiAnno($_POST['anno']);
        }

    } elseif ($op == "ingressiTraDate") {
        if (isset($_POST['data1']) && isset($_POST['data2']) && $_POST['data1'] != "" && $_POST['data2'] != "") {
            $risultati = ingressiTraDate($_POST['data1'], $_POST['data2']);
        }

    } elseif ($op == "piuDi4AccessiMese") {
        if (isset($_POST['mese']) && $_POST['mese'] != "") {
            $risultati = utentiConPiuDi4AccessiMese($_POST['mese']);
        }

    } elseif ($op == "modificaUtente") {
        if (isset($_POST['caricaUtente']) && isset($_POST['idU']) && $_POST['idU'] != "") {
            $utenteDaModificare = getUtenteById(intval($_POST['idU']));
        } elseif (isset($_POST['salvaUtente'])) {
            $idU = intval($_POST['idU']);
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $dataNascita = $_POST['dataNascita'];
            $sesso = $_POST['sesso'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telefono = $_POST['telefono'];
            $residenza = $_POST['residenza'];
            $tipo = intval($_POST['tipo']);

            $ok = updateUtente($idU, $nome, $cognome, $dataNascita, $sesso, $email, $password, $telefono, $residenza, $tipo);

            if ($ok) {
                $messaggio = "Utente modificato con successo";
            } else {
                $messaggio = "Errore durante la modifica dell'utente";
            }

            $utenteDaModificare = getUtenteById($idU);
        }
    }
}

function stampaTabella($dati) {
    if ($dati == null || count($dati) == 0) {
        echo "<p>Nessun risultato trovato</p>";
    } else {
        echo "<table border='1'>";

        echo "<tr>";
        foreach (array_keys($dati[0]) as $chiave) {
            echo "<th>" . $chiave . "</th>";
        }
        echo "</tr>";

        foreach ($dati as $riga) {
            echo "<tr>";
            foreach ($riga as $valore) {
                echo "<td>" . $valore . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <script src="script.js"></script>
</head>
<body>

<h1>Benvenuto ADMIN <?php echo $_SESSION['username']; ?></h1>
<p>Ultimo accesso: <?php echo $ultimoAccesso; ?></p>

<nav style="margin-bottom:20px;">
    <a href="admin.php?op=deleteUser">Cancellazione utente</a> |
    <a href="admin.php?op=deleteAccessiPrimaData">Cancella accessi prima di una data</a> |
    <a href="admin.php?op=utentiNatiPrima">Utenti nati prima di una data</a> |
    <a href="admin.php?op=utentiNatiAnno">Utenti nati in un anno</a> |
    <a href="admin.php?op=ingressiTraDate">Accessi tra due date</a> |
    <a href="admin.php?op=piuDi4AccessiMese">Utenti con più di 4 accessi in un mese</a> |
    <a href="admin.php?op=accessiDurataSup1h">Accessi con durata > 1h</a> |
    <a href="admin.php?op=durataMassima">Durata massima</a> |
    <a href="admin.php?op=utentiAlfabetico">Utenti alfabetico</a> |
    <a href="admin.php?op=accessiAjax">Accessi utente con AJAX</a> |
    <a href="admin.php?op=modificaUtente">Modifica dati utente</a>
</nav>

<?php
if ($messaggio != "") {
    echo "<p><strong>$messaggio</strong></p>";
}

if ($op == "deleteUser") {
?>
    <h2>Cancellazione utente</h2>
    <form method="POST" action="admin.php?op=deleteUser">
        <select name="idU" required>
            <option value="">Seleziona un utente</option>
            <?php
            foreach ($utenti as $u) {
                echo "<option value='" . $u['idU'] . "'>";
                echo $u['cognome'] . " " . $u['nome'] . " (" . $u['email'] . ")";
                echo "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Elimina">
    </form>

<?php
} elseif ($op == "deleteAccessiPrimaData") {
?>
    <h2>Cancellazione accessi antecedenti una data</h2>
    <form method="POST" action="admin.php?op=deleteAccessiPrimaData">
        Data: <input type="date" name="data" required>
        <input type="submit" value="Elimina">
    </form>

<?php
} elseif ($op == "utentiNatiPrima") {
?>
    <h2>Utenti nati prima di una data</h2>
    <form method="POST" action="admin.php?op=utentiNatiPrima">
        Data: <input type="date" name="data" required>
        <input type="submit" value="Visualizza">
    </form>

<?php
} elseif ($op == "utentiNatiAnno") {
?>
    <h2>Utenti nati in un determinato anno</h2>
    <form method="POST" action="admin.php?op=utentiNatiAnno">
        Anno: <input type="number" name="anno" min="1900" max="2100" required>
        <input type="submit" value="Visualizza">
    </form>

<?php
} elseif ($op == "ingressiTraDate") {
?>
    <h2>Accessi tra due date</h2>
    <form method="POST" action="admin.php?op=ingressiTraDate">
        Data inizio: <input type="date" name="data1" required><br><br>
        Data fine: <input type="date" name="data2" required><br><br>
        <input type="submit" value="Visualizza">
    </form>

<?php
} elseif ($op == "piuDi4AccessiMese") {
?>
    <h2>Utenti con più di 4 accessi in un mese</h2>
    <form method="POST" action="admin.php?op=piuDi4AccessiMese">
        Mese: <input type="number" name="mese" min="1" max="12" required>
        <input type="submit" value="Visualizza">
    </form>

<?php
} elseif ($op == "utentiAlfabetico") {
?>
    <h2>Elenco utenti in ordine alfabetico</h2>
<?php
    stampaTabella($risultati);

} elseif ($op == "accessiAjax") {
?>
    <h2>Accessi di un utente con AJAX</h2>

    <select id="selUtente" onchange="cercaAccessiUtente(this);">
        <option value="">Seleziona un utente</option>
        <?php
        foreach ($utenti as $u) {
            echo "<option value='" . $u['idU'] . "'>";
            echo $u['cognome'] . " " . $u['nome'] . " (" . $u['email'] . ")";
            echo "</option>";
        }
        ?>
    </select>

    <div id="risAPI"></div>

<?php
} elseif ($op == "modificaUtente") {
?>
    <h2>Modifica dati di un utente</h2>

    <?php
    if (!isset($_POST['caricaUtente']) && !isset($_POST['salvaUtente'])) {
    ?>
        <form method="POST" action="admin.php?op=modificaUtente">
            <select name="idU" required>
                <option value="">Seleziona un utente</option>
                <?php
                foreach ($utenti as $u) {
                    echo "<option value='" . $u['idU'] . "'>";
                    echo $u['cognome'] . " " . $u['nome'] . " (" . $u['email'] . ")";
                    echo "</option>";
                }
                ?>
            </select>
            <input type="submit" name="caricaUtente" value="Carica">
        </form>
    <?php
    }

    if (count($utenteDaModificare) > 0) {
    ?>
        <form method="POST" action="admin.php?op=modificaUtente">
            <input type="hidden" name="idU" value="<?php echo $utenteDaModificare['idU']; ?>">

            Nome: <input type="text" name="nome" value="<?php echo $utenteDaModificare['nome']; ?>" required><br><br>
            Cognome: <input type="text" name="cognome" value="<?php echo $utenteDaModificare['cognome']; ?>" required><br><br>
            Data nascita: <input type="date" name="dataNascita" value="<?php echo $utenteDaModificare['dataNascita']; ?>" required><br><br>
            Sesso:
            <select name="sesso" required>
                <option value="M" <?php if ($utenteDaModificare['sesso'] == "M") echo "selected"; ?>>M</option>
                <option value="F" <?php if ($utenteDaModificare['sesso'] == "F") echo "selected"; ?>>F</option>
            </select><br><br>
            Email: <input type="email" name="email" value="<?php echo $utenteDaModificare['email']; ?>" required><br><br>
            Password: <input type="text" name="password" value="<?php echo $utenteDaModificare['password']; ?>" required><br><br>
            Telefono: <input type="text" name="telefono" value="<?php echo $utenteDaModificare['telefono']; ?>" required><br><br>
            Residenza: <input type="text" name="residenza" value="<?php echo $utenteDaModificare['residenza']; ?>" required><br><br>
            Tipo: <input type="number" name="tipo" value="<?php echo $utenteDaModificare['tipo']; ?>" required><br><br>

            <input type="submit" name="salvaUtente" value="Salva modifiche">
        </form>
    <?php
    }

} elseif ($op == "accessiDurataSup1h" || $op == "durataMassima") {
?>
    <h2>Risultato</h2>
<?php
    if (count($risultati) > 0) {
        stampaTabella($risultati);
    } else {
        echo "<p>Nessun risultato trovato</p>";
    }
} elseif ($op == "utentiNatiPrima" || $op == "utentiNatiAnno" || $op == "ingressiTraDate" || $op == "piuDi4AccessiMese") {
    if (count($risultati) > 0) {
        echo "<h2>Risultato</h2>";
        stampaTabella($risultati);
    } else {
        echo "<p>Nessun risultato trovato</p>";
    }
}
?>

<br>
<a href="logout.php">LOGOUT</a>

</body>
</html>