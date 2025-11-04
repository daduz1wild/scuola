/* Davide Benedetti 4BI */

function calcola() {
    let n1 = parseFloat(document.getElementById("n1").value);
    let n2 = parseFloat(document.getElementById("n2").value);
    let operatore = document.getElementById("operatore").value;
    let risultatiDiv = document.getElementById("risultati");
    if (isNaN(n1) || isNaN(n2)) {
        alert("Inserisci due numeri validi");
        return;
    }
	if (operatore !== "+" && operatore !== "-" && operatore !== "*" && operatore !== "/" && operatore !== "esp" && operatore !== "rad") {
	    alert("Operazione non valida");
        return;
    }
    let risultato;
    switch (operatore) {
        case "+":
            risultato = n1 + n2;
            break;
        case "-":
            risultato = n1 - n2;
            break;
        case "*":
            risultato = n1 * n2;
            break;
        case "/":
            if (n2 === 0) {
                alert("Impossibile dividere per zero");
                return;
            }
            risultato = n1 / n2;
            break;
        case "esp":
            risultato = Math.pow(n1, n2);
            break;
        case "rad":
            if (n1 < 0) {
                alert("Impossibile calcolare la radice quadrata di un numero negativo");
                return;
            }
            risultato = Math.sqrt(n1);
            break;
        default:
            alert("Operazione non valida");
            return;
    }
    risultatiDiv.innerHTML += risultato + ", ";
}
