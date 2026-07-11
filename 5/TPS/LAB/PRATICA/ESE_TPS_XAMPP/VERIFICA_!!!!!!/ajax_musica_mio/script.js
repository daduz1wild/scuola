function srcUser(form){
    let user=form.email.value;
    let psw=form.psw.value;
    const xhttp=new XMLHttpRequest();
    xhttp.open("POST","api_login.php");
    xhttp.onload = function(){
        stampaLogin(this);
    }
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("email="+email+"&psw="+psw);
}

function stampaLogin(xhttp){
    let rispServer = xhttp.responseText;
    const divRis= document.getElementById("msgErr");
    if(rispServer=="ERR_CONN"){
        divRis.innerHTML="errore connessione server";
    }else if(rispServer=="NO_USR"){
        divRis.innerHTML="user non trovato";
    }else {
        location='homepage.php';
    }
}

function cercaBraniCat(form){
    let cat = form.cat.value;
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET","api_cercaBraniCat?cat=" + cat);
    xhttp.onload=function(){
        stampaBraniCat(this);
    }
    xhttp.send();
}
function stampaBraniCat(xhttp){
    
}