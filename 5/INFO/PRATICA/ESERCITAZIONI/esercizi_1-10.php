<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Davide Benedetti 5AI esercizi_1-10.php -->
    <meta charset="UTF-8">
    <title>Esercizi PHP</title>
</head>
<body>

<h1>Esercizio 1</h1>
<?php
    $adesso = time();
    echo date("d/m/Y H:i", $adesso);
?>

<h1>Esercizio 2</h1>
<p>Primi 15 numeri della sequenza di Fibonacci:</p>
<ul>
    <?php
        $x = 1;
        $y = 1;
        echo "<li>$x</li><li>$y</li>";
        for ($cont = 2; $cont < 15; $cont++) {
            $somma = $x + $y;
            echo "<li>$somma</li>";
            $x = $y;
            $y = $somma;
        }
    ?>
</ul>

<h1>Esercizio 3</h1>
<table border="1" style="border-collapse: collapse; text-align:center;">
<?php
    for ($riga = 1; $riga <= 10; $riga++) {
        echo "<tr>";
        for ($col = 1; $col <= 10; $col++) {
            $val = $riga * $col;
            $colore = (($riga + $col) % 2 == 0) ? "yellow" : "red";
            echo "<td style='background-color:$colore;'>$val</td>";
        }
        echo "</tr>";
    }
?>
</table>

<h1>Esercizio 4</h1>
<table border="1" style="border-collapse:collapse;text-align:right;">
    <tr>
        <th>n</th>
        <th>√n</th>
        <th>n²</th>
        <th>n³</th>
    </tr>
<?php
    for ($num = 1; $num <= 15; $num++) {
        $rad = sqrt($num);
        $q = $num ** 2;
        $cub = pow($num, 3);
        echo "<tr>";
        echo "<td>$num</td><td>" . number_format($rad, 2) . "</td><td>$q</td><td>$cub</td>";
        echo "</tr>";
    }
?>
</table>

<h1>Esercizio 5</h1>
<table border="1" style="border-collapse:collapse;text-align:center;">
    <tr>
        <th>dec</th>
        <th>bin</th>
        <th>char</th>
    </tr>
<?php
    for ($cod = 33; $cod <= 127; $cod++) {
        echo "<tr>";
        echo "<td>$cod</td>";
        echo "<td>" . sprintf("%07s", decbin($cod)) . "</td>";
        echo "<td>" . chr($cod) . "</td>";
        echo "</tr>";
    }
?>
</table>

<h1>Esercizio 6</h1>
<p>Estrazione di 5 numeri casuali (1–90):</p>
<?php
    $estratti = [];
    while (count($estratti) < 5) {
        $cas = rand(1, 90);
        if (!in_array($cas, $estratti)) {
            $estratti[] = $cas;
        }
    }
    sort($estratti);
    echo "<ul>";
    foreach ($estratti as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul>";
?>

<h1>Esercizio 7</h1>
<p>Fattoriale dei numeri da 1 a 50</p>
<ul>
<?php
    function calcolaFattoriale($val) {
        $ris = 1;
        for ($j = 2; $j <= $val; $j++) {
            $ris *= $j;
        }
        return $ris;
    }

    for ($n = 1; $n <= 50; $n++) {
        $fat = calcolaFattoriale($n);
        echo "<li>$n! = $fat</li>";
    }
?>
</ul>

<h1>Esercizio 8</h1>
<p>Verifica parole palindrome:</p>
<ul>
<?php
    function checkPalindroma($str) {
        $len = strlen($str);
        for ($k = 0; $k < floor($len / 2); $k++) {
            if ($str[$k] !== $str[$len - 1 - $k]) {
                return "NON palindroma";
            }
        }
        return "palindroma";
    }

    $parole = ["abba", "mamma", "abcdba", "omonomo"];
    foreach ($parole as $p) {
        echo "<li>$p: " . checkPalindroma($p) . "</li>";
    }
?>
</ul>

<h1>Esercizio 9</h1>
<?php
    function mostraImmagine($num = 1) {
        return "<img src='img/img$num.avif' alt='img casuale' width='200' height='200'><br>";
    }

    $randImg = rand(1, 3);
    echo mostraImmagine($randImg);
    echo mostraImmagine();

    $lista = scandir('img');
    print_r($lista);
?>
</body>
</html>
