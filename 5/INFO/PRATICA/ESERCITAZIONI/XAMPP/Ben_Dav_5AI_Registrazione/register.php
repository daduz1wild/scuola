<?php
# Benedetti Davide     5AI     29/12/2025     register.php
session_start();
require_once("funzioni.php");

if (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "client") {
    header("Location: client.php");
} elseif (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "admin") {
    header("Location: admin.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user = "";
        $psw = "";
        $psw2 = "";

        if (isset($_POST['user'])) {
            $user = trim($_POST['user']);
        }

        if (isset($_POST['psw'])) {
            $psw = $_POST['psw'];
        }

        if (isset($_POST['psw2'])) {
            $psw2 = $_POST['psw2'];
        }

        if ($user == "" || $psw == "" || $psw2 == "") {
            header("Location: register.php?err=Compilare tutti i campi");
        } elseif ($psw != $psw2) {
            header("Location: register.php?err=Le password non coincidono");
        } elseif (userExists($user)) {
            header("Location: register.php?err=Username già presente");
        } else {
            $ok = addUser($user, $psw);
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
    Username: <input type="text" name="user" required><br><br>
    Password: <input type="password" name="psw" required><br><br>
    Conferma Password: <input type="password" name="psw2" required><br><br>
    <input type="submit" value="Registrati">
</form>

<p><a href="index.php">Vai al login</a></p>

</body>
</html>
<?php
    }
}
?>
