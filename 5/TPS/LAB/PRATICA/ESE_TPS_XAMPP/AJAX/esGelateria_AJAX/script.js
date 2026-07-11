function mostraGelati(frmGelati){
    let nome = frmGelati.nome.value;
    let dataScad = frmGelati.dataScadenza.value;
    let produttore = frmGelati.produttore.value;

    if(nome === "" && dataScad === "" && produttore === ""){
        document.getElementById("ris").innerHTML = "";
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "serverGelati.php");
        xhttp.onload = function(){
            stampaGelati(this.responseText);
        }
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("nome=" + nome +"&dataScadenza=" + dataScad +"&produttore=" + produttore);
    }
}

function stampaGelati(risServer){
    let ris = JSON.parse(risServer);
    let risHTML = "";

    if(ris === "ERR_CONN")
        risHTML = "Errore - nessuna connessione al server";
    else if(ris.length === 0)
        risHTML = "Nessun gelato trovato";
    else{
        risHTML = "<table border=1>" +
                  "<thead>" +
                    "<th>Nome</th>" +
                    "<th>Data produzione</th>" +
                    "<th>Data scadenza</th>" +
                    "<th>Quantità</th>" +
                    "<th>Produttore</th>" +
                  "</thead><tbody>";

        for(let i = 0; i < ris.length; i++){
            risHTML += "<tr>";
            for(let y = 0; y < 5; y++)
                risHTML += "<td>" + ris[i][y] + "</td>";
            risHTML += "</tr>";
        }

        risHTML += "</tbody></table>";
    }

    document.getElementById("ris").innerHTML = risHTML;
}
