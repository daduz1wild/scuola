function checkLogin(form) {
    let user = form.user;
    let psw = form.psw;
    let valido = true;

    if (!controllaUser(user)) valido = false;
    if (!controllaPsw(psw)) valido = false;

    return valido;
}

function checkRegister(form) {
    let user = form.user;
    let psw = form.psw;
    let psw2 = form.psw2;
    let valido = true;

    if (!controllaUser(user)) valido = false;
    if (!controllaPsw(psw)) valido = false;
    if (!controllaConfPsw(psw, psw2)) valido = false;

    return valido;
}

function checkRisposta(form) {
    let risposta = form.risposta;
    let valido = true;

    if (!controllaRisposta(risposta)) valido = false;

    return valido;
}

document.addEventListener("DOMContentLoaded", function () {

    /* LOGIN */
    const formLogin = document.getElementById("formLogin");
    if (formLogin) {
        formLogin.user.addEventListener("blur", () => controllaUser(formLogin.user));
        formLogin.psw.addEventListener("blur", () => controllaPsw(formLogin.psw));
    }

    /* REGISTER */
    const formRegister = document.getElementById("formRegister");
    if (formRegister) {
        formRegister.user.addEventListener("blur", () => controllaUser(formRegister.user));
        formRegister.psw.addEventListener("blur", () => controllaPsw(formRegister.psw));
        formRegister.psw2.addEventListener("blur", () =>
            controllaConfPsw(formRegister.psw, formRegister.psw2)
        );
    }

    /* CLIENT */
    const formRisposta = document.getElementById("formRisposta");
    if (formRisposta) {
        formRisposta.risposta.addEventListener("blur", () =>
            controllaRisposta(formRisposta.risposta)
        );
    }
});

/* ===== FUNZIONI DI CONTROLLO ===== */

function controllaUser(input) {
    const span = document.getElementById("userError");
    if (input.value.trim() === "") {
        span.innerText = "Inserisci username";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}

function controllaPsw(input) {
    const span = document.getElementById("pswError");
    if (input.value.trim() === "") {
        span.innerText = "Inserisci password";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}

function controllaConfPsw(psw, psw2) {
    const span = document.getElementById("psw2Error");
    if (psw2.value === "" || psw.value !== psw2.value) {
        span.innerText = "Le password non coincidono";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}

function controllaRisposta(input) {
    const span = document.getElementById("rispostaError");
    if (input.value.trim() === "") {
        span.innerText = "Inserisci una risposta";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}
