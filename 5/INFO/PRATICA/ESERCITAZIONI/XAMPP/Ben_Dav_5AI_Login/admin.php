<?php
# Benedetti Davide     5AI     19/12/2025     admin.php

session_start();

if (!isset($_SESSION['tipoUtente'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['tipoUtente'] != "admin") {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>

<h1>Benvenuto ADMIN <?php echo $_SESSION['username']; ?></h1>

<ul>
    <li>Gestione utenti</li>
    <li>Gestione prodotti</li>
    <li>Statistiche</li>
</ul>

<a href="logout.php">LOGOUT</a>

</body>
</html>
