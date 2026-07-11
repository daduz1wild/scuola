<?php
session_start();

if(!isset($_SESSION["nome"]) || !isset($_SESSION["cognome"]) || !isset($_SESSION["dataNascita"])){
    header("Location: index.html");
}

$nome = $_SESSION["nome"];
$cognome = $_SESSION["cognome"];
$data = $_SESSION["dataNascita"];
?>
<html>
    <head>
        <title>Area Riservata</title>
    </head>
    <body>
        <h1>Area Riservata</h1>
        <?php echo "Benvenuto $nome $cognome - $data"; ?>
        <br><br>
        <a href="logout.php">Logout</a>
    </body>
</html>