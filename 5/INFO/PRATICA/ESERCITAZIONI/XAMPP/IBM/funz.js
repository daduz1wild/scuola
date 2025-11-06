function convalida(form){
    let alt=form.alt;
    let peso=form.peso;
    let valido=true;
    if(!contrAlt(alt)) valido = false;
    if(!contrPeso(peso)) valido = false;
    return valido;
}

document.addEventListener("DOMContentLoaded", function() {
    const altInput = document.getElementById("alt");
    const pesoInput = document.getElementById("peso");

    altInput.addEventListener("blur", () => contrAlt(altInput));
    pesoInput.addEventListener("blur", () => contrPeso(pesoInput));
});


function contrAlt(input) {
    const alt = parseFloat(input.value);
    const span = document.getElementById("altError");

    if(alt < 20 || isNaN(alt)) {
        span.innerText = "Altezza non valida (min 20)";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}

function contrPeso(input) {
    const peso = parseFloat(input.value);
    const span = document.getElementById("pesoError");

    if(peso < 2 || isNaN(peso)) {
        span.innerText = "Peso non valido (min 2)";
        return false;
    } else {
        span.innerText = "";
        return true;
    }
}
