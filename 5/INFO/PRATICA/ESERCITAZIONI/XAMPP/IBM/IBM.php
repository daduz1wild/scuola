<html>
<head>
    <title>Risultato calcolo IBM</title>
    <link rel="stylesheet" href="IBM.css">
</head>
<body>

<?php
if (isset($_GET['peso']) && isset($_GET['alt']) && $_GET['peso'] > 0 && $_GET['alt'] > 20) {
    echo "<table border=2>";
    foreach ($_GET as $c => $v) {
        echo "<tr><td>$c</td><td>$v</td></tr>";
    }
    echo "</table><br><br><br>";

    $alt = $_GET['alt'] / 100;
    $ibm = $_GET['peso'] / ($alt * $alt);

    if ($ibm < 18.5) {
        echo "sottopeso<br>";
        echo "<img src='sottopeso.webp' alt='sottopeso'>";
    } else if ($ibm < 24.9) {
        echo "normopeso<br>";
        echo "<img src='normopeso.webp' alt='normopeso'>";
    } else if ($ibm < 29.9) {
        echo "sovrappeso<br>";
        echo "<img src='sovrappeso.webp' alt='sovrappeso'>";
    } else {
        echo "obeso<br>";
        echo "<img src='obeso.webp' alt='obeso'>";
    }
} else {
    echo "dati non validi";
}
?>

</body>
</html>