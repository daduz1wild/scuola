<?php
// Inizializzazione della variabile $coda, se non è ancora definita.
$coda = ''; 
if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {
    // Verifica se è stato premuto "Aggiungi in coda"
    if (isset($_GET['add'])) {
        // Controlla che il campo nome sia stato inserito e non sia vuoto
        if (isset($_GET['nome']) && !empty($_GET['nome'])) {
            $nome = $_GET['nome'];
            $dataOra = date("Y-m-d H:i:s");  // Salva la data e ora attuale

            // Verifica se esiste già il cookie coda
            if (isset($_COOKIE['coda']) && !empty($_COOKIE['coda'])) {
                $coda = $_COOKIE['coda'];  // Prendi il valore del cookie coda
            }

            // Verifica se il nome è già presente nella coda
            if (!nomePresente($nome, $coda)) {
                // Se la coda è vuota, aggiungi nome e data/ora, altrimenti concatena
                if ($coda === '') {
                    $coda = $nome . ',' . $dataOra;
                } else {
                    $coda .= '|' . $nome . ',' . $dataOra;  // Usando | come delimitatore tra le persone
                }

                // Salva nel cookie con durata di 1 ora
                setcookie('coda', $coda, time() + 3600); 
            }
        } else {
            // Mostra un alert JavaScript se il nome è vuoto e se si sta cercando di aggiungere un nome
            echo "<script>alert('Errore: il campo \"Nome\" è obbligatorio!');</script>";
        }
    }

    // Rimuove il primo dalla coda
    if (isset($_GET['rem'])) {
        if (isset($_COOKIE['coda']) && $_COOKIE['coda'] !== '') {
            $coda = $_COOKIE['coda'];
            $codaArray = explode('|', $coda); // Ogni elemento è "Nome,dataOra"

            // Rimuovi il primo elemento
            array_shift($codaArray); 
            $coda = implode('|', $codaArray);  // Riunisci di nuovo la coda

            // Salva il cookie
            setcookie('coda', $coda, time() + 3600);
        }
    }

    // Svuota completamente la coda
    if (isset($_GET['clear'])) {
        setcookie('coda', '', time() - 3600); // Elimina il cookie
        $coda = '';
    }
} else {
    // Inizializza $coda come vuota se non è definita
    if (isset($_COOKIE['coda']) && !empty($_COOKIE['coda'])) {
        $coda = $_COOKIE['coda']; 
    } else {
        $coda = '';  // Inizializza la variabile coda come stringa vuota se non esiste
    }
}

function nomePresente($nome, $coda) {
    // Verifica che la coda non sia vuota prima di esplodere
    if ($coda === '') {
        return false;
    }

    $codaArray = explode('|', $coda); // Splitta la coda in un array
    foreach ($codaArray as $elemento) {
        $parti = explode(',', $elemento); // Separiamo Nome e DataOra
        if (isset($parti[0]) && $parti[0] == $nome) { // Verifica che $parti[0] esista
            return true;
        }
    }
    return false;
}
?>

<html>
<head>
    <title>Coda dal medico</title>
</head>
<body>
    <h1>Gestione coda</h1>
    <form method="get">
        <input type="text" name="nome" placeholder="Nome"><br><br>
        <input type="submit" name="add" value="Aggiungi in coda"><br><br>

        <input type="submit" name="rem" value="Rimuovi il primo dalla coda"><br><br>
        <input type="submit" name="clear" value="Svuota completamente la coda"><br><br>
    </form>

    <h3>Coda attuale:</h3>
    <p>
        <?php
        // Verifica se coda è vuota prima di esplodere
        if ($coda === '') {
            echo "Nessuno in coda.";
        } else {
            echo "<table border='1'>";
            echo "<thead><tr><th>Nome</th><th>Data e Ora</th></tr></thead>";
            $codaArray = explode('|', $coda); // Splitta la coda in un array
            foreach ($codaArray as $elemento) {
                // Ogni elemento è "Nome, DataOra"
                $parti = explode(',', $elemento); // Separiamo Nome e DataOra
                // Controlla se ci sono due parti, altrimenti salta questo elemento
                if (isset($parti[0]) && isset($parti[1])) {
                    echo "<tr><td>$parti[0]</td><td>$parti[1]</td></tr>"; // Stampa il nome e la data
                }
            }
            echo "</table>";
        }
        ?>
    </p>
</body>
</html>
