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
    <h1>PAG1</h1>
    <form action="pag2.php" method="get">
        Scegli un colore: <input type="color" name="colore">
        <input type="submit" value="Invia">
    </form>
    <a href="pag3.php"><button>Vai a Pag3</button></a>
</body>
</html>
