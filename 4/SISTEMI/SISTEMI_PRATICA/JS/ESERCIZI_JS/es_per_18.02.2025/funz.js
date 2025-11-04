/* Benedetti Davide 4BI funz.js*/

function test(event) {
  event.preventDefault();
  const f = document.getElementById("modulo");
  const nome = f.elements.nome.value;
  const cognome = f.elements.cognome.value;
  const eta = f.elements["età"].value;
  const genere = f.elements.genere.value;
  const colore = f.elements.colore.value;
  const consenso = f.elements.consenso.checked;

  if (nome.trim() === "" || cognome.trim() === "" || !parseInt(eta) || genere === "" || colore === "" || !consenso)
    alert("Almeno un valore errato");
  else
    alert("| " + nome + " | " + cognome + " | " + eta + " | " + genere + " | " + colore + " | " + consenso + " |");
}


