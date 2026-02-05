<?php
# Benedetti Davide     5AI     12/01/2025     admin.php

session_start();
require("funzioni.php");

$msg = "";
$err = "";

/* controllo accesso */
if (!isset($_SESSION['tipoUtente']) || $_SESSION['tipoUtente'] != "admin") {
    header("Location: index.php?err=Accesso non permesso");
} elseif (isset($_POST['par1']) &&
    isset($_POST['par2']) &&
    isset($_POST['par3']) &&
    isset($_POST['par4']) &&
    isset($_POST['par5']) &&
    isset($_POST['soluzione'])
) {

    /* assegno i POST a variabili */
    $par1 = $_POST['par1'];
    $par2 = $_POST['par2'];
    $par3 = $_POST['par3'];
    $par4 = $_POST['par4'];
    $par5 = $_POST['par5'];
    $soluzione = $_POST['soluzione'];

    /* controllo campi vuoti */
    if (
        $par1 != "" &&
        $par2 != "" &&
        $par3 != "" &&
        $par4 != "" &&
        $par5 != "" &&
        $soluzione != ""
    ) {

        $succ = insFile($par1, $par2, $par3, $par4, $par5, $soluzione);
        $i=0;
        if ($succ) {
            $msg = "<h1>PAROLE INSERITE CON SUCCESSO</h1><br><br><h2>PAROLE:</h2>";
            foreach($_POST as $el){
                if($i==0){
                    $msg = $msg . $el;
                }else{
                    $msg = $msg .", ". $el;
                }
                $i++;
            }
        $msg=$msg."<br><br>";
        } else {
            $err = "Errore inserimento nel file";
        }

    } else {
        $err = "Compila tutti i campi";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>

<h1>Benvenuto ADMIN <?php echo $_SESSION['username']; ?></h1>

<?php
if ($msg != "") {
    echo $msg;
} else {
    if ($err != "") {
        echo "<p style='color:red;'>$err</p><br>";
    }
}
?>

<form method="POST">
    PAROLA 1: <input type="text" name="par1"><br>
    PAROLA 2: <input type="text" name="par2"><br>
    PAROLA 3: <input type="text" name="par3"><br>
    PAROLA 4: <input type="text" name="par4"><br>
    PAROLA 5: <input type="text" name="par5"><br><br>
    SOLUZIONE: <input type="text" name="soluzione"><br><br>
    <input type="submit" value="Invia">
</form>

<h2>STORICO GIOCHI</h2>

<?php
$history = getHistory();
$totGiochi = count($history);

echo "<p>Giochi disponibili: $totGiochi</p>";

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Data</th>
<th>Tentativi</th>
<th>Vinti</th>
<th>Persi</th>
</tr>";

foreach ($history as $id => $g) {
    echo "<tr>
        <td>$id</td>
        <td>{$g['data']}</td>
        <td>{$g['tot']}</td>
        <td>{$g['vinti']}</td>
        <td>{$g['persi']}</td>
    </tr>";
}

echo "</table>";
?>


<br><a href="logout.php">LOGOUT</a>

</body>
</html>
