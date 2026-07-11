<?php

// ricerca per nome
function cercaNomeGelato($nomeGelato) {
    $gelati = [];
    $conn = mysqli_connect("localhost","root","","gelatiDB");

    if($conn){
        $sql = "SELECT * FROM gelati";
        $ris = mysqli_query($conn, $sql);

        while($dati = mysqli_fetch_row($ris)){
            if($nomeGelato != "" && str_contains($dati[0], $nomeGelato))
                $gelati[] = $dati;
        }

        mysqli_close($conn);
    }

    return $gelati;       
}


// ricerca per scadenza
function cercaScadenzaGelato($scadenza) {
    $gelati = [];
    $conn = mysqli_connect("localhost","root","","gelatiDB");

    if($conn){
        $sql = "SELECT * FROM gelati";
        $ris = mysqli_query($conn, $sql);

        while($dati = mysqli_fetch_row($ris)){
            if($scadenza == $dati[2])
                $gelati[] = $dati;
        }

        mysqli_close($conn);
    }

    return $gelati;       
}


// ricerca per produttore
function cercaProduttoreGelato($produttore) {
    $gelati = [];
    $conn = mysqli_connect("localhost","root","","gelatiDB");

    if($conn){
        $sql = "SELECT * FROM gelati";
        $ris = mysqli_query($conn, $sql);

        while($dati = mysqli_fetch_row($ris)){
            if($produttore != "" && str_contains($dati[4], $produttore))
                $gelati[] = $dati;
        }

        mysqli_close($conn);
    }

    return $gelati;       
}

?>