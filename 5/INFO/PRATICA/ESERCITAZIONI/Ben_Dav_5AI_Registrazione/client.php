<?php
# Benedetti Davide     5AI     29/12/2025     client.php
session_start();

if (!isset($_SESSION['tipoUtente'])) {
    header("Location: index.php");
} elseif ($_SESSION['tipoUtente'] != "client") {
    header("Location: index.php");
} else {
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Client</title>
</head>
<body>

<h1>Benvenuto <?php echo $_SESSION['username']; ?></h1>

<ul>
    <li>Visualizza prodotti</li>
    <li>Carrello</li>
    <li>Profilo</li>
</ul>

<a href="logout.php">LOGOUT</a>

</body>
</html>
<?php
}
?>
