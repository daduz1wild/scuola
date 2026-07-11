function checkForm(frm){
    let usr = frm.usr.value;
    let psw = frm.psw.value;
    const msgRis = document.getElementById("msgRis");
    if(usr == "" || psw == "")
        msgRis.innerHTML = "ERR - inserisci tutti i dati per il login";
    else{
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "apiLogin.php");
        xhttp.onload =function(){
            gestisciRisServer(this.responseText, msgRis);
        };
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("usr="+usr+"&psw="+psw);
    }
}

function gestisciRisServer(risServer, msgRis){
    if(risServer == "ERR_CONN")
        msgRis.innerHTML = "ERR - errore server";
    else if (risServer == "ERR_DATA")
        msgRis.innerHTML = "ERR - dati non inviati";
    else if(risServer == "ERR_CRD")
        msgRis.innerHTML = "ERR - credenziali errate";
    else{
        location = "paginaRiservata.php";
    }

}