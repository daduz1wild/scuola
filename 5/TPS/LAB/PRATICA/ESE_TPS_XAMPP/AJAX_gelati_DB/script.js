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
        tblGelati += "<td>" + risGelati[0]['nome'] + "</td>";
        tblGelati += "<td>" + risGelati[0][1] + "</td>";
        tblGelati += "</tr></tbody></table>";
        divRis.innerHTML = tblGelati;
    }
}



