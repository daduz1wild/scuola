<?php
# Benedetti Davide     5AI     12/01/2025     register.php
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
    <link rel="stylesheet" href="style.css">
    <title>Registrazione</title>
    <script src="check.js"></script>
</head>
<body>

<h2>REGISTRAZIONE</h2>

<?php
if (isset($_GET['err'])) {
    echo "<p style='color:red'>" . $_GET['err'] . "</p>";
}
?>

<form id="formRegister" action="register.php" method="POST" onsubmit="return checkRegister(this)">
    Username: <input type="text" name="user">
    <span id="userError" class="error"></span><br><br>
    Password: <input type="password" name="psw">
    <span id="pswError" class="error"></span><br><br>
    Conferma Password: <input type="password" name="psw2">
    <span id="psw2Error" class="error"></span><br><br>
    <input type="submit" value="Registrati">
</form>


<p><a href="index.php">Vai al login</a></p>

</body>
</html>
<?php
    }
}
?>
