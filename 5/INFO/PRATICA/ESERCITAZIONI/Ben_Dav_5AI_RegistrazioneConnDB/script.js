//Benedetti Davide     5AI     11/05/2026     script.js

function cercaAccessiUtente(sel) {
    const divRis = document.getElementById("risAPI");
    let idU = sel.value;

    if (idU == "") {
        divRis.innerHTML = "Seleziona un utente";
    } else {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "api_accessiUtente.php?idU=" + idU);

        xhttp.onload = function () {
            mostraAccessiUtente(this.responseText, divRis);
        };

        xhttp.send();
    }
}

function mostraAccessiUtente(risServer, divRis) {
    let risAccessi = JSON.parse(risServer);

    if (risAccessi == "ERR_CONN") {
        divRis.innerHTML = "Errore connessione";
    } else if (risAccessi.length == 0) {
        divRis.innerHTML = "Nessun accesso trovato";
    } else {
        let tbl = "<table border='1' cellpadding='5' cellspacing='0'>";
        tbl += "<tr>";
        tbl += "<th>idA</th>";
        tbl += "<th>dataInizio</th>";
        tbl += "<th>oraInizio</th>";
        tbl += "<th>dataFine</th>";
        tbl += "<th>oraFine</th>";
        tbl += "</tr>";

        for (let i = 0; i < risAccessi.length; i++) {
            tbl += "<tr>";
            tbl += "<td>" + risAccessi[i]["idA"] + "</td>";
            tbl += "<td>" + risAccessi[i]["dataInizio"] + "</td>";
            tbl += "<td>" + risAccessi[i]["oraInizio"] + "</td>";
            tbl += "<td>" + risAccessi[i]["dataFine"] + "</td>";
            tbl += "<td>" + risAccessi[i]["oraFine"] + "</td>";
            tbl += "</tr>";
        }

        tbl += "</table>";
        divRis.innerHTML = tbl;
    }
}