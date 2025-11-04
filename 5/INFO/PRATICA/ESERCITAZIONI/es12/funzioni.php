/* 12. Filtro articoli

Realizza un’applicazione web che visualizzi in una tabella i dati contenuti nel file articoli.csv fornito, composto dalle colonne codice, descrizione, tipologia e prezzo.

Il file e la funzione PHP di supporto leggiArticoli($nomeFile) sono già forniti.

L’applicazione deve includere un form che consenta all’utente di filtrare gli articoli in base alla tipologia, selezionabile da un menu a tendina con le opzioni “tutte”, “informatica”, “cartoleria” e “audio”.

Devono essere mostrati solo gli articoli che rispettano i criteri di ricerca all’interno di una tabella HTML; se nessun articolo soddisfa i criteri, deve comparire il messaggio “Nessun articolo trovato”.

Estensioni:

- Aggiungere la possibilità di filtrare anche per prezzo;

- Aggiungere la possibilità di cercare una parte di testo nella descrizione dell’articolo.*/


<?php
function leggiArticoli($nomeFile) {
    $righe = file($nomeFile); //Legge l'intero file in un vettore
    $articoli = [];

    for ($i = 1; $i < count($righe); $i++) {
        $campi = explode(";", trim($righe[$i]));
        $articoli[] = [
            "codice" => $campi[0],
            "descrizione" => $campi[1],
            "tipologia" => $campi[2],
            "prezzo" => floatval($campi[3])
        ];
    }
    return $articoli;
}
?>
