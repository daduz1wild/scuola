<?php
function cercaGelati($nome, $data, $produttore) {
    $gelati = [];
    $fp = fopen("gelati.csv", "r");

    if($fp)
    {
        while(($dati = fgetcsv($fp, 0, ";")))
        {
            if(
                str_contains($dati[0], $nome) &&
                str_contains($dati[4], $produttore) &&
                ($data == "" || $dati[2] <= $data)
            )
                $gelati[] = $dati;
        }
        fclose($fp);
    }

    return $gelati;       
}
?>