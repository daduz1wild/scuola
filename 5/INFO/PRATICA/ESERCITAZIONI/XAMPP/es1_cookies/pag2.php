<?php
if (!empty($_GET['colore'])) {
    setcookie("colore", $_GET['colore'], time() + 60*60);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ES cookie</title>
    <style>
        body {
            <?php
                if (isset($_COOKIE['colore']))
                    echo "background-color: " . $_COOKIE['colore'] . ";";
                else
                    echo "background-color: white;";
            ?>
        }
    </style>
</head>
<body>
    <h1>PAG2</h1>
    <a href="pag1.php"><button><-</button></a>
    <a href="pag3.php"><button>-></button></a>
</body>
</html>
