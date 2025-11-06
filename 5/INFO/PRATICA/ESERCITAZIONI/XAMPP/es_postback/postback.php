<?php

/*
Si devono gestire le iscrizioni ai convegni di una manifestazione. Ogni persona che desidera partecipare ad un convegno deve accedere ad una pagina web 
in cui tramite checkbox seleziona uno o più convegni a cui iscriversi. Il
form prevede il bottone ISCRIVITI. Realizzare il codice dell’unico script php (uno solo!) che permette sia di selezionare i convegni a cui iscriversi 
che di vedere il convegno a cui l’utente si è iscritto.
L’elenco dei convegni previsti è stato precaricato in un array associativo.
*/

    if(empty($_GET))
        form();
    else{
        $convegni=$_GET;
        foreach($convegni as $key=>$value){
            


            
        }
    }
        
    function form(){
        ?>
            <form id="form">
                Nome:<input type="text" name="nome" id="nome">
                <label for="info">Informatica</label>
                <input type="checkbox" name="info" id="info">
                <label for="tele">Telecomunicazioni</label>
                <input type="checkbox" name="tele" id="tele">
                <label for="mate">Matematica</label>
                <input type="checkbox" name="mate" id="mate">
                <label for="film">Film</label>
                <input type="checkbox" name="film" id="film">
                <label for="macchine">Macchine</label>
                <input type="checkbox" name="macchine" id="macchine">
                <input type="submit" value="ISCRIVITI">
            </form>
        <?php
    }

?>