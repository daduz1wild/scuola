<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {
    if (isset($_GET['nome']) && !empty($_GET['nome'])) {
        $nome = $_GET['nome'];
        if (isset($_COOKIE['coda'])) {
            $coda = $_COOKIE['coda'];
        } else {
            $coda = '';
        }
        if ($coda === '') {
            $coda = $nome; 
        } else {
            $coda .= ',' . $nome;
        }
        setcookie('coda', $coda, time() + 3600); 
    if (isset($_GET['delPrimo'])) {
        if (isset($_COOKIE['coda']) && $_COOKIE['coda'] !== '') {
            $coda = $_COOKIE['coda'];
            $codaArray = explode(',', $coda);
            array_shift($codaArray);
            $coda = implode(',', $codaArray);
            setcookie('coda', $coda, time() + 3600);
        }
    }

    if (isset($_GET['del'])) {
        setcookie('coda', '', time() - 3600);
        $coda = '';
    }
} else {
    $coda = isset($_COOKIE['coda']) ? $_COOKIE['coda'] : ''; 
}
?>

<html>
<head>
    <title>Form Coda Medici</title>
</head>
<body>
    <h1>Coda Medici</h1>

    <form method="GET">
        Inserisci nome: <input type="text" name="nome">
        <input type="submit" value="Aggiungi" name="add">
        <input type="submit" value="Rimuovi il primo" name="delPrimo">
        <input type="submit" value="Elimina Coda" name="del">
    </form>

    <div id="coda">
        <h2>Lista dei medici in coda:</h2>
        <?php
        if (empty($coda)) {
            echo "Nessuno inserito nella coda";
        } else {
            $codaArray = explode(',', $coda);
            echo "<ul>";
            foreach ($codaArray as $nome) {
                echo "<li>$nome</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
</body>
</html>
