function inviaDati(form){
    let nome=form.nome.value;
    const xhttp = new XMLHttpRequest();//creiamo l'oggetto per gestione asincrona
    xhttp.onload = function(){//vuole essere assegnato a una funzione quindi la definisco, e verra elaborata finche il serve non risponde
            document.getElementById('ris').innerHTML= xhttp.responseText;
    }
    xhttp.open("POST", "server.php");
    //solo con le richieste in pos tdevi aggiungere questa riga
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("nome="+nome);
}