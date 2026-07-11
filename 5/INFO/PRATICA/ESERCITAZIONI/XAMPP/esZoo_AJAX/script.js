function mostraAnimali(frmZoo){
    let spc = frmZoo.specie.value;
    if(spc == "")
        document.getElementById("ris").innerHTML = "";
    else{
        const xhttp = new XMLHttpRequest();
        //xhttp.open("GET", "serverZoo.php?specie="+spc);
        xhttp.open("POST", "serverZoo.php");
        xhttp.onload = function(){
            stampaAnimali(this.responseText);
        }
        //xhttp.send(); senza parametri per richieste in GET
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//esclusivamente per le richeiste in POST
        xhttp.send("specie="+spc);
    }
}

function stampaAnimali(risServer){
    let ris = JSON.parse(risServer);
    let risHTML = "";
    if(ris == "ERR_CONN")
        risHTML = "Errore - nessuna connessione al server";
    else if(ris.length == 0)
        risHTML = "Nessun animale trovato";
    else{
        risHTML = "<table border=1><thead><th>Nome</th><th>Eta</th><th>Specie</th></thead><tbody>";
        for(let i = 0; i<ris.length; i++){
            risHTML += "<tr>";
            for(let y = 0; y<3;y++)
                risHTML += "<td>" + ris[i][y] + "</td>";
            risHTML += "</tr>";
        }
        risHTML += "</tbody></table>";
    }
    document.getElementById("ris").innerHTML = risHTML;
}