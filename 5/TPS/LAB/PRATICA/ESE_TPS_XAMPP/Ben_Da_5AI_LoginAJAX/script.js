function login(frmLogin){

    let u = frmLogin.user.value;
    let p = frmLogin.psw.value;

    if(u == "" || p == "")
        document.getElementById("ris").innerHTML = "Inserire username e password";
    else{

        const xhttp = new XMLHttpRequest();

        xhttp.open("POST", "serverLogin.php");

        xhttp.onload = function(){
            stampaRisposta(this.responseText);
        }

        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("user="+u+"&psw="+p);
    }
}


function stampaRisposta(risServer){

    if(risServer == '"ERR_CONN"')
        document.getElementById("ris").innerHTML = "Errore - nessuna connessione al server";

    else if(risServer == '"ERR_LOGIN"')
        document.getElementById("ris").innerHTML = "Credenziali errate";

    else
        document.getElementById("ris").innerHTML = risServer;
}