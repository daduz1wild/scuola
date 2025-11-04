// script.js
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrazione");
  if (!form) return;

  form.nome.addEventListener("blur", () => validaNome(form.nome));
  form.cognome.addEventListener("blur", () => validaCognome(form.cognome));
  form.maschio.addEventListener("blur", () => validaSesso(form));
  form.femmina.addEventListener("blur", () => validaSesso(form));
  form.dataNasc.addEventListener("blur", () => validaDataNasc(form.dataNasc));
  form.numCel.addEventListener("blur", () => validaNumCel(form.numCel));
  form.email.addEventListener("blur", () => validaEmail(form.email));
  form.password.addEventListener("blur", () => validaPassword(form.password));
  form.passConf.addEventListener("blur", () => validaPassConf(form.passConf, form));
});


// ===== VALIDAZIONE COMPLETA SU SUBMIT =====
function checkForm(form) {
  let valido = true;
  if (!validaNome(form.nome)) valido = false;
  if (!validaCognome(form.cognome)) valido = false;
  if (!validaSesso(form)) valido = false;
  if (!validaDataNasc(form.dataNasc)) valido = false;
  if (!validaNumCel(form.numCel)) valido = false;
  if (!validaEmail(form.email)) valido = false;
  if (!validaPassword(form.password)) valido = false;
  if (!validaPassConf(form.passConf, form)) valido = false;
  return valido;
}

// ===== VALIDATORI SINGOLI =====
function validaNome(campo) {
  const val = campo.value.trim();
  if (!val) return setError(campo, "Compila il nome");
  if (val.length < 2) return setError(campo, "Il nome deve avere almeno 2 caratteri");
  campo.value = capitalize(val);
  return setError(campo, "");
}

function validaCognome(campo) {
  const val = campo.value.trim();
  if (!val) return setError(campo, "Compila il cognome");
  if (val.length < 2) return setError(campo, "Il cognome deve avere almeno 2 caratteri");
  campo.value = capitalize(val);
  return setError(campo, "");
}

function validaSesso(form) {
  if (!form.sesso.value) return setError(form.maschio, "Seleziona il sesso", "errSesso");
  return setError(form.maschio, "", "errSesso");
}

function validaDataNasc(campo) {
  const val = campo.value;
  if (!val) return setError(campo, "Inserisci la data di nascita");
  if (isDataFutura(val)) return setError(campo, "Data futura non valida");
  if (!isMinAge(val, 13)) return setError(campo, "Devi avere almeno 13 anni");
  return setError(campo, "");
}

function validaNumCel(campo) {
  if (!campo.value.trim()) return setError(campo, "Compila il numero di telefono");
  return setError(campo, "");
}

function validaEmail(campo) {
  const val = campo.value.trim();
  if (!val) return setError(campo, "Compila la E-Mail");
  if (!isEmailValida(val)) return setError(campo, "Formato E-Mail non valido");
  return setError(campo, "");
}

function validaPassword(campo) {
  const val = campo.value.trim();
  if (!val) return setError(campo, "Compila la password");
  if (!isPasswordValida(val)) return setError(campo, "La password deve avere almeno 8 caratteri, una maiuscola, una minuscola, un numero e un simbolo");
  return setError(campo, "");
}

function validaPassConf(campo, form) {
  const val = campo.value.trim();
  if (!val) return setError(campo, "Compila la conferma della password");
  if (val !== form.password.value) return setError(campo, "Le password non corrispondono");
  return setError(campo, "");
}

// ===== GESTIONE ERRORI =====
function setError(campo, msg, idErrore) {
  const id = idErrore || "err" + capitalize(campo.id);
  const span = document.getElementById(id);
  if (span) span.textContent = msg;
  campo.className = msg ? "errore" : "giusto";
  return msg === "";
}

function isDataFutura(dataStr) {
  const oggi = new Date();
  const d = new Date(dataStr + "T00:00:00");
  return d > oggi;
}

function isMinAge(dataStr, etaMin) {
  const oggi = new Date();
  const d = new Date(dataStr + "T00:00:00");
  let anni = oggi.getFullYear() - d.getFullYear();
  const mese = oggi.getMonth() - d.getMonth();
  if (mese < 0 || (mese === 0 && oggi.getDate() < d.getDate())) anni--;
  return anni >= etaMin;
}

function isPasswordValida(pwd) {
  if (pwd.length < 8) return false; // almeno 8 caratteri
	  let hasLower = false; // minuscola
	  let hasUpper = false; // maiuscola
	  let hasDigit = false; // numero
	  let hasSymbol = false; // simbolo

	  for (let i = 0; i < pwd.length; i++) {
		const code = pwd.charCodeAt(i);

		// minuscola a-z (ASCII 97–122)
		if (code >= 97 && code <= 122) {
		  hasLower = true;
		}
		// maiuscola A-Z (ASCII 65–90)
		else if (code >= 65 && code <= 90) {
		  hasUpper = true;
		}
		// numero 0-9 (ASCII 48–57)
		else if (code >= 48 && code <= 57) {
		  hasDigit = true;
		}
		// simboli
		else if (
		  (code >= 33 && code <= 47) || // ! " # $ % & ' ( ) * + , - . /
		  (code >= 58 && code <= 64) || // : ; < = > ? @
		  (code >= 91 && code <= 96) || // [ \ ] ^ _ `
		  (code >= 123 && code <= 126)  // { | } ~
		) {
		  hasSymbol = true;
		}
  }

  return hasLower && hasUpper && hasDigit && hasSymbol;
}

function capitalize(str) {
  if (!str) return "";
  return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}
