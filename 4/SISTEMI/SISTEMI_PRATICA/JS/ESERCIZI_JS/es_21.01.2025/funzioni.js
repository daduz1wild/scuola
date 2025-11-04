//Davide Benedetti 4BI funz.js

function aggiungiVoto() {
	let votoCorrente = document.getElementById("campoVoto").value;
	if (isNaN(votoCorrente) || votoCorrente==NULL) {
		alert("Il valore inserito non e valido.");
	} else if (votoCorrente < 0 || votoCorrente > 10) {
		alert("Il voto deve essere compreso tra 0 e 10.");
	} else {
		votazioni.push(parseInt(votoCorrente));
	}
}

function calcolaMediaAritmetica() {
	if (votazioni.length == 0) {
		document.getElementById("output").innerHTML = "Non hai inserito voti.";
	} else {
		let totale = 0;
		for (let i = 0; i < votazioni.length; i++) {
			totale += votazioni[i];
		}
		let media = totale / votazioni.length;
		document.getElementById("output").innerHTML = "La media aritmetica e: " + media;
	}
}

function calcolaMediaGeometrica() {
	if (votazioni.length == 0) {
		document.getElementById("output").innerHTML = "Non hai inserito voti.";
	} else {
		let prodotto = votazioni[0];
		for (let i = 1; i < votazioni.length; i++) {
			prodotto *= votazioni[i];
		}
		let media = Math.pow(prodotto, 1 / votazioni.length);
		document.getElementById("output").innerHTML = "La media geometrica e: " + media;
	}
}

function azzera() {
	for(let i=votazioni.lenght;i>0;i--){
		votazioni.pop();
	}
	document.getElementById("output").innerHTML="voti resettati";
}
