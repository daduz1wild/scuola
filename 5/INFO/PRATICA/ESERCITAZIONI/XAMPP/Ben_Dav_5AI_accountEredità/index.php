<?php
# Benedetti Davide     5AI     12/01/2025     index.php
session_start();
require("funzioni.php");
$err="";
if (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "client") {
    header("Location: client.php");
} elseif (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "admin") {
    header("Location: admin.php");
} else {
    /* leggo le parole */
    $riga = leggiParole();
    $par1 = $par2 = $par3 = $par4 = $par5 = "";

    if ($riga != "") {
        $dati = explode(";", $riga);

        $par1 = $dati[0];
        $par2 = $dati[1];
        $par3 = $dati[2];
        $par4 = $dati[3];
        $par5 = $dati[4];
    } else {
        $err = "Nessuna parola disponibile";
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <script src="check.js"></script>
</head>
<body>

<h2>LOGIN</h2>

<?php
    if (isset($_GET['err'])) {
        echo "<p style='color:red'>" . $_GET['err'] . "</p>";
    }
    if ($err != "") {
        echo "<p style='color:red;'>$err</p>";
    }
    echo "<h2>QUIZ DI OGGI:</h2><br>$par1 - $par2 - $par3 - $par4 - $par5<br><br>";
?>

<form id="formLogin" action="checkUser.php" method="POST" onsubmit="return checkLogin(this)">
    Username: <input type="text" name="user">
    <span id="userError" class="error"></span><br><br>
    Password: <input type="password" name="psw">
    <span id="pswError" class="error"></span><br><br>
    <input type="submit" value="Login">
</form>

<br>

<form action="register.php" method="GET">
    <input type="submit" value="Registrati">
</form>

</body>
</html>
<?php
}
?>
