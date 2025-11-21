<?php
    function cercaGelati($nome, $dataScadenza, $produttore) {
        $gelati = [];
        $fp = fopen("gelati.csv", "r");

        if($fp) {
            while(($dati = fgetcsv($fp, 0, ";"))) {
                $match = true;
                // filtro per nome (se non vuoto)
                if($nome !== "") {
                    if(!str_contains(strtolower($dati[0]), strtolower($nome)))
                        $match = false;
                }

                // filtro per data di scadenza (se non vuota)
                // Mostro i gelati con data di scadenza <= di quella inserita
                if($dataScadenza !== "") {
                    if($dati[2] > $dataScadenza)
                        $match = false;
                }

                // filtro per produttore (se non vuoto)
                if($produttore !== "") {
                    if(!str_contains(strtolower($dati[4]), strtolower($produttore)))
                        $match = false;
                }

                if($match)
                    $gelati[] = $dati;
            }
            fclose($fp);
        }

        return $gelati;
    }
?>
