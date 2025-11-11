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
    <h1>PAG3</h1>
    <a href="pag2.php"><button><-</button></a>
    <a href="pag1.php"><button>-></button></a>
</body>
</html>
