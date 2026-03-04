
# 1. Il problema da cui nasce tutto

Quando navighi su un sito web, succede sempre questa cosa:

1. Il **browser (client)** manda una richiesta al **server**
    
2. Il server elabora la richiesta
    
3. Il server manda una risposta
    

Esempio semplice:

- apri `google.com`
    
- il browser chiede la pagina al server
    
- il server manda **HTML, CSS, JavaScript**
    

⚠️ Il problema dei siti vecchi era questo:

Ogni volta che servivano nuovi dati → **la pagina si ricaricava tutta**.

Esempio vecchio:

- clicchi un bottone
    
- la pagina si ricarica completamente
    
- appare il nuovo contenuto
    

Questo è lento e poco moderno.

Per risolvere questo problema sono nate **due cose importanti**:

- **AJAX → per comunicare con il server senza ricaricare la pagina**
    
- **JSON → per scambiare dati tra client e server**
    

---

# 2. Cos'è JSON

**JSON** significa:

JavaScript Object Notation

È **un formato per rappresentare dati**.

Serve per **trasmettere dati tra client e server**.

È molto usato perché:

- è **semplice**
    
- è **leggero**
    
- è **facile da leggere**
    
- è compatibile con molti linguaggi
    

---

# Struttura di un JSON

Un JSON è simile a un **oggetto JavaScript**.

Esempio:

{  
  "nome": "Mario",  
  "eta": 20,  
  "studente": true,  
  "lingue": ["it", "en"],  
  "indirizzo": {  
      "citta": "Roma",  
      "cap": 00100  
  }  
}

### Tipi di dati supportati

JSON può contenere:

- stringhe → `"Mario"`
    
- numeri → `20`
    
- booleani → `true`
    
- array → `[ "it", "en" ]`
    
- oggetti → `{ "citta": "Roma" }`
    
- null → `null`
    

La struttura è **gerarchica (ad albero)**.

---

# 3. Perché serve JSON

Quando **client e server comunicano tramite HTTP** possono scambiarsi **solo testo**.

Quindi se voglio inviare un oggetto devo:

1️⃣ trasformarlo in **stringa**  
2️⃣ inviarlo  
3️⃣ riconvertirlo in oggetto

Questo processo si chiama:

|Operazione|Significato|
|---|---|
|serializzazione|oggetto → stringa|
|deserializzazione|stringa → oggetto|

---

# 4. JSON in JavaScript

### Convertire oggetto in JSON

JSON.stringify(oggetto)

Esempio:

let persona = {  
  nome: "Mario",  
  eta: 20  
};  
  
let json = JSON.stringify(persona);

Risultato:

{"nome":"Mario","eta":20}

---

### Convertire JSON in oggetto

JSON.parse(stringaJSON)

Esempio:

let testo = '{"nome":"Mario","eta":20}';  
  
let obj = JSON.parse(testo);  
  
console.log(obj.nome);

Output:

Mario

---

# 5. JSON lato server (PHP)

In PHP esistono due funzioni simili.

### Convertire dati PHP in JSON

json_encode($array);

Serve per **mandare dati al client**.

Esempio:

$dati = [  
  "nome" => "Marco",  
  "eta" => 20  
];  
  
echo json_encode($dati);

Il server invierà:

{"nome":"Marco","eta":20}

---

### Convertire JSON ricevuto

json_decode($json);

Serve per **leggere JSON ricevuto dal client**.

---

# 6. Cos'è AJAX

**AJAX** significa:

Asynchronous JavaScript And XML

Non è un linguaggio.

È **una tecnica per comunicare con il server usando JavaScript senza ricaricare la pagina**.

---

# Esempio reale

Quando scrivi su Google:

pizza

Subito appaiono suggerimenti.

La pagina **non si ricarica**.

Succede perché:

1. JavaScript manda una richiesta al server
    
2. il server manda i suggerimenti
    
3. la pagina aggiorna solo quella parte
    

Questo è **AJAX**.

---

# 7. Comunicazione sincrona vs asincrona

### Sincrona

Il browser **si blocca** aspettando la risposta.

richiesta → attesa → risposta

---

### Asincrona (AJAX)

Il browser **continua a funzionare** mentre aspetta.

richiesta → continua a lavorare → arriva risposta

Quando arriva la risposta viene eseguito del codice.

---

# 8. Come si fa AJAX in JavaScript

Si usa l'oggetto:

XMLHttpRequest

Creazione:

const xhttp = new XMLHttpRequest();

---

# 9. Inviare una richiesta

### Aprire la connessione

xhttp.open("GET", "server.php", true);

Parametri:

|parametro|significato|
|---|---|
|GET / POST|metodo HTTP|
|URL|indirizzo server|
|true|asincrono|

---

### Inviare la richiesta

xhttp.send();

---

# 10. Ricevere la risposta

Quando il server risponde si usa:

xhttp.onload

Esempio:

xhttp.onload = function() {  
    console.log(this.responseText);  
};

`responseText` contiene **la risposta del server**.

---

# 11. Controllare se la richiesta è andata bene

Si controlla lo **status HTTP**.

xhttp.onload = function() {  
  
  if (this.status == 200) {  
      console.log(this.responseText);  
  }  
  
};

Codici comuni:

|codice|significato|
|---|---|
|200|successo|
|404|pagina non trovata|
|500|errore server|

---

# 12. Esempio AJAX con JSON

### JavaScript

const xhttp = new XMLHttpRequest();  
  
xhttp.onload = function() {  
  
    let dati = JSON.parse(this.responseText);  
  
    console.log(dati.nome);  
  
};  
  
xhttp.open("GET", "utente.php", true);  
xhttp.send();

---

### PHP (server)

<?php  
  
$utente = [  
  "nome" => "Marco",  
  "eta" => 20  
];  
  
echo json_encode($utente);  
  
?>

---

# Cosa succede passo per passo

1️⃣ JavaScript manda richiesta al server (AJAX)

GET utente.php

2️⃣ Il server crea i dati

{"nome":"Marco","eta":20}

3️⃣ Il browser riceve il JSON

4️⃣ JavaScript lo converte con

JSON.parse()

5️⃣ Ora i dati sono utilizzabili nel codice

---

# 13. Differenza fondamentale

|Tecnologia|Cosa fa|
|---|---|
|AJAX|permette la comunicazione client-server senza ricaricare la pagina|
|JSON|formato per rappresentare i dati|

Quindi:

AJAX = come comunico  
JSON = che formato uso per i dati

---

# 14. Schema completo

Browser (JavaScript)  
  
     AJAX request  
          ↓  
  
Server (PHP)  
  
     crea dati  
          ↓  
  
       JSON  
          ↓  
  
Browser riceve JSON  
  
JSON.parse()  
  
dati utilizzabili

---

# 15. Perché spesso nei form si usa `return false`

Quando invii un form normalmente:

submit → ricarica pagina

Se vuoi usare **AJAX**, devi **bloccare il comportamento normale del form**.

Per questo si usa:

onsubmit="return false"

così:

- il form **non ricarica la pagina**
    
- JavaScript invia i dati con **AJAX**
    

---

# Riassunto super semplice

**JSON**

→ formato per rappresentare dati

{"nome":"Mario","eta":20}

---

**AJAX**

→ tecnica per comunicare con il server **senza ricaricare la pagina**

---

**insieme**

AJAX invia richiesta  
Server risponde con JSON  
JavaScript legge JSON  
Pagina si aggiorna

 
In Google man mano che scrivo nella barra di ricerca si vanno a mostrare i relativi risultati, e non riaggiornando la pagina ma viene aggiornata solo una piccola sezione, 
questo è possibile grazie all'utilizzo AJAX, che non è un linguaggio di programmazione infatti è un insieme di tecniche o tecnologie che noi andiamo a implementare in una pagina per farla diventare dinamica.
AJAX(Asynchronous Javascript And XML) :
1. nella comunicazione asincrona io client elaboro la richiesta la invio al server, poi il client non si mette in attesa della risposta della response del server, ma continua  l'esecuzione, e nel momento in cui il server risponde il client si svincola e preleva  la risposta, quindi tempo di risposta svincolato al server 
2. Javascript perche le tecniche che andiamo a implementare nelle nostre pagine le andremo a implementare con java tipo oggetti da Java.
3. XML linguaggio di marcatura andiamo a mostrare il formato dei dati, useremo JSON linguaggio che rappresenta lo scambio dei dati.
quello che scambiano client e server con http scambiano solo stringhe di testo.
ma io posso comunque usare HTTP grazie a JSON e grazie  a funzioni sue, possiamo prendere un array convertirlo in una stringa e spedirla al server, che prende quella stringa e la riconverte in un array e lo utilizza a suo piacere.
file XML sono estendibili, cioè posso creare tag miei sulla base di sotto-entità create il testo che io scrivo i programmazione viene convertito in array e mandato al server.
per gestire la parte di Ajax utilizzeremo la classe const xhttp= new XMLHttpRequest() all'interno di una funzione, primo metodo da utilizzare di questa classe è onload a cui viene associata una funzione che verra elaborata nel momento in cui c'è una risposta del server.tutte le cose effettuate nel mentre che il server risponde soo proprio dentro alla funzione assegnata nell'onloa(xhttp.onload=function(){}
nella stra grande dei casi come risposta ci verra data la pagina php server, la classe il cui oggetto è stato dichiarato all'inizo puo gestire sia classe sincrone che asincrone, se nel parametro della funzione open mettiamo true come terzo parametro useremo asincrono.
pen permette di stabilire la connessione con il server , per inviare i dati utilizziamo il metodo dell classe dichiarata inzialmente send(method(GET POST),url( es. SERVER:PHP?home=hshh  quindi i dati vengono inviati nel body della richiesta http nel caso in cui usiamo il get altrimenti li devi inseire nel parametro dell metodo send in modo che i dati si rovano nel body e quindi non sono visualizzabili), true(per dire asincrono).

ALCUNE PROPRIETA CHE CI INTERESSANO: onreadystatechange(viene eseguia ogni volta che c'è un cambio nello stato di prontezza quindi noi utilizzeremo onload() solitamente(che viene eseguito quando il ready state è a 4)(definisce una funzione richiamata al cambio della proprieta ready state) quindi in general e per vedere se il server è pronto con le funzioni responseXML o responseTEXT prendo la risaposta del server.




