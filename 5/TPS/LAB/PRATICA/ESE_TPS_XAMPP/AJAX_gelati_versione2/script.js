function cercaNomeGelato(nome){
    const divRis = document.getElementById("risAPI");
    let nomeGelato = nome.value;
    if(nome == "")
        divRis.innerHTML = "Inserire il nome di un gelato";
    else{
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "api_nomeGelato.php?nomeGelato="+nomeGelato);
        xhttp.onload = function(){
            mostraGelatiPerNome(this.responseText, divRis);
        }
        xhttp.send();
    }
}

function mostraGelatiPerNome(risServer, divRis){
    let risGelati = JSON.parse(risServer);
    if(risGelati == "ERR_CONN")
        divRis.innerHTML = "Errore connessione";
    else if(risGelati.length == 0)
        divRis.innerHTML = "Nessun gelato trovato";
    else{
        let tblGelati = "<table border=1><thead><th>Nome</th><th>Data produzione</th><th>Data scadenza</th><th>Qty</th><th>Produttore</th></thead><tbody><tr>";
        for(let i = 0; i<risGelati[0].length; i++){
            tblGelati += "<td>" + risGelati[0][i] + "</td>";
        }
        tblGelati += "</tr></tbody></table>";
        divRis.innerHTML = tblGelati;
    }

}

function cercaScadenzaGelato(frmSc){
    let scd = frmSc.scadenza.value;
    const divRis = document.getElementById("risAPI");
    if(scd == "")
        divRis.innerHTML = "Errore - seleziona una data";
    else{
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "api_scadenzaGelati.php");
        xhttp.onload = function(){
            //mostra gelati nella pagine client
            mostraGelatiPerScadenza(xhttp.responseText, divRis);

        }
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("scadenza=" + scd);
    }
    return false;
}

function  mostraGelatiPerScadenza(risServer, divRis){
    let risServ = JSON.parse(risServer);
    if(risServ == "ERR_CONN")
        divRis.innerHTML = "Errore connessione";
    else if(risServ.length == 0)
         divRis.innerHTML = "Nessun gelato trovato";
    else{
        let elcGelati = "<ul>";
        for(let i = 0; i< risServ.length; i++){
            elcGelati += "<li>" + risServ[i][0] + "; " + risServ[i][1] + "; " + risServ[i][2] + "; " + risServ[i][3] + "; " + risServ[i][4] + "; ";
        }
        elcGelati += "</ul>";
        divRis.innerHTML = elcGelati;
    }
}