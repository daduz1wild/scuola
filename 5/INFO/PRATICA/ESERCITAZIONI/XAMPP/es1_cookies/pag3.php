<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['colore'])) {
    setcookie("colore", $_GET['colore'], time() + 60 * 60);
    $colore = $_GET['colore'];
} elseif (isset($_COOKIE['colore'])) {
    $colore = $_COOKIE['colore'];
} else {
    $colore = "white";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ES cookie</title>
    <style>
        body {
            <?php echo "background-color: " . $colore . ";"; ?>
        }
    </style>
</head>
<body>
    <h1>PAG3</h1>
    <a href="pag2.php"><button><-</button></a>
</body>
</html>
