function check(form){
    let nome=form.nome;
    let sesso=form.sesso;
    let alt=form.alt;
    let peso=form.peso;
    let email=form.email;
    let psw=form.psw;
    let confPsw=form.confPsw;
    let valido=true;
    if(!contrNome(nome)) valido=false;
    if(!contrSesso(sesso)) valido=false;
    if(!contrAlt(alt)) valido=false;
    if(!contrPeso(peso)) valido=false;
    if(!contrEmail(email)) valido=false;
    if(!contrPsw(psw)) valido=false;
    if(!contrConfPsw(confPsw)) valido=false;
    return valido;
}

document.addEventListener("DOMContentLoaded", function(){
    const form=document.getElementById("form");
    const nome=form.nome;
    const sesso=form.sesso;
    const alt=form.alt;
    const peso=form.peso;
    const email=form.email;
    const psw=form.psw;
    const confPsw=form.confPsw;
    nome.addEventListener("blur",()=> contrNome(nome));
    sesso.addEventListener("blur",()=> contrSesso(sesso));
    alt.addEventListener("blur",()=> contrAlt(alt));
    peso.addEventListener("blur",()=> contrPeso(peso));
    email.addEventListener("blur",()=> contrEmail(email));
    psw.addEventListener("blur",()=> contrPsw(psw));
    confPsw.addEventListener("blur",()=> contrConfPsw(confPsw));
})

function contrNome(input){
    const nome=input.value;
    const span=document.getElementById("nomeError");
    if (nome.trim() === ""){
        span.innerText="Inserisci il nome";
        return false;
    }else{
        span.innerText="";
        return true;
    }
}

function contrSesso(input){
    const sesso=input.value;
    const span=document.getElementById("sessoError");
    if(sesso===""){
        span.innerText="seleziona un'opzione valida";
        return false;
    }else{
        span.innerText="";
        return true;
    }
}
function contrAlt(input){
    const alt=parseFloat(input.value);
    const span=document.getElementById("altError");
    if(isNaN(alt) || alt<20){
        span.innerText="valore non valido(min 20)";
        return false;
    }else{
        span.innerText="";
        return true;
    }
}

function contrPeso(input){
    const peso=parseFloat(input.value);
    const span=document.getElementById("pesoError");
    if(isNaN(peso) || peso<10){
        span.innerText="valore non valido(min 10)";
        return false;
    }else{
        span.innerText="";
        return true;
    }
}

function contrEmail(input){
    const email=input.value;
    const span=document.getElementById("emailError");
    const regex=/.+@.+\..+/;
    if(!regex.test(email)){
        span.innerText="inserisci un amail valida";
        return false;
    }else{
        span.innerText="";
        return true;
    }
}

function contrPsw(input){
    const psw=input.value;
    const span=document.getElementById("pswError");
    const regex=/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%&]).{8,}/;
    if(psw==="" || regex.test(psw)){
        span.innerText="password non valida";
        return false;
    }else{
        span.innerText="";
        return true;
    }

}


