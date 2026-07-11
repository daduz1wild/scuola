<?php
/* USIAMO PDO che è una libreria per collegarsi al database da php*/
//questa funzione servirà tutte le volte che ci vogliamo collegare al database
function getConnessione(){
    $host= "localhost";
    $DBName= "aziendazambelli";
    $username= "root";
    $password= "";
    $conn=null;
    try{
        $conn= new PDO("mysql:dbname=$DBName;host=$host",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $errore){
        //oppure throw $erroreMio
        $conn=null;
    }
    return $conn;
}
function eseguiQuery($q /*query da eseguire*/){
    $conn=getConnessione();
    $result=null;//risultato della query, inizialmente null

    if($conn!=null){
        try{
        // restituisce l'oggetto chiamato statement che è un oggetto che contiene una query pronta ad essere eseguita

        $statement=$conn->prepare($q);

        //esegue la query preparata e restituisce true se l'esecuzione è avenuta con successo

       $statement->execute();    

        /*se faccio soltanto fetch() invece di fetchAll(), ottengo solo la prima riga del risultato e ogni volta che lo chiamo, 
        man mano prende la riga successiva , quindi ottengo i blocchi di righe uan alla volta, e se faccio fetchColumn() ottengo 
        solo il valore della prima colonna della prima riga del risultato.
        Se come parametro in fetchAll non mettiamo nulla ci saranno dati ridondanti per questo per avere una stampa pulita mettiamo PDO::FETCH_ASSOC
        */

        $result=$statement->fetchAll();
        } catch (PDOException $e){
            $result=null; //ci accontentiamo di ritornare null 
        }
    }
    //gestione else
    return $result;
}
?>