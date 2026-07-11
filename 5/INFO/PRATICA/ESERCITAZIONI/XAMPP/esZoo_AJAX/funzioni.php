<?php
    function cercaAnimali($specie) {
        $animali = [];
        $fp = fopen("animali.csv", "r");
        if($fp)
        {
            while(($dati = fgetcsv($fp, 0, ";")))
            {
                if(str_contains($dati[2], $specie))
                    $animali[] = $dati;
            }
            fclose($fp);
        }
        return $animali;       
    }
?>