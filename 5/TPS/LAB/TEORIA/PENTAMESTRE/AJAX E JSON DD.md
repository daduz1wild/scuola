
# JSON e AJAX – Spiegazione completa

## 1. Il formato JSON

Uno dei formati più utilizzati per lo **scambio di dati tra client e server** è **JSON (JavaScript Object Notation)**.

JSON è un formato **testuale leggero** usato per rappresentare dati strutturati (oggetti, array, valori).

Esempio JSON:

```json
{
  "nome": "Marco",
  "eta": 20,
  "citta": "Roma"
}
```

Questo formato è molto usato nelle applicazioni web perché:

- è **facile da leggere**
    
- è **leggero**
    
- è **facile da convertire in oggetti JavaScript**
    

### Conversione JSON

Quando client e server comunicano tramite **HTTP**, possono scambiarsi **solo stringhe di testo**.

Per questo JSON permette di:

- **convertire oggetti o array in stringhe**
    
- inviare queste stringhe al server
    
- farle **riconvertire in oggetti o array**
    

In JavaScript:

```javascript
JSON.encode(array)   // converte in stringa
JSON.parse(stringa)     // riconverte in oggetto/array
```

---

# 2. Cos'è AJAX

**AJAX** significa:

**Asynchronous JavaScript And XML**

Non è un linguaggio di programmazione.

È un **insieme di tecniche** che permettono di rendere le pagine web **dinamiche**, comunicando con il server **senza ricaricare tutta la pagina**.

### Esempio reale

Quando scrivi qualcosa nella barra di ricerca di Google:

- i suggerimenti appaiono mentre scrivi
    
- la pagina **non viene ricaricata**
    
- viene aggiornata **solo una piccola parte della pagina**
    

Questo è possibile grazie ad **AJAX**.

---

# 3. Comunicazione asincrona

La caratteristica principale di AJAX è la **comunicazione asincrona**.

### Comunicazione sincrona

Nel modello sincrono:

1. Il client manda la richiesta
    
2. Il client **rimane in attesa**
    
3. Quando arriva la risposta la pagina si aggiorna
    

Questo blocca l'esecuzione.

---

### Comunicazione asincrona

Nel modello asincrono:

1. Il client invia la richiesta al server
    
2. Il client **continua a lavorare**
    
3. Quando il server risponde, il client **recupera la risposta**
    

Quindi:

**il tempo di risposta del server non blocca il client**

---

# 4. Perché si chiama AJAX

### A – Asynchronous

La comunicazione è **asincrona**.

---

### J – JavaScript

Le tecniche AJAX sono implementate usando **JavaScript**.

JavaScript gestisce:

- la richiesta al server
    
- la ricezione della risposta
    
- l'aggiornamento della pagina
    

---

### X – XML

Originariamente i dati venivano scambiati in **XML**.

XML è un linguaggio di marcatura simile a HTML.

Esempio:

```xml
<persona>
    <nome>Marco</nome>
    <eta>20</eta>
</persona>
```

XML è **estensibile**, perché puoi creare **tag personalizzati**.

Oggi però si usa molto di più **JSON**, perché è più semplice e leggero.

---

# 5. Come funziona AJAX in JavaScript

Per gestire AJAX si usa l'oggetto:

```javascript
XMLHttpRequest
```

Creazione dell'oggetto:

```javascript
const xhttp = new XMLHttpRequest();
```

Questo oggetto permette di:

- inviare richieste HTTP al server
    
- ricevere la risposta
    
- aggiornare la pagina senza ricaricarla
    

---

# 6. Gestire la risposta del server

Una proprietà molto importante è:

```javascript
xhttp.onload
```

Qui si assegna una funzione che verrà eseguita **quando il server invia la risposta**.

Esempio:

```javascript
xhttp.onload = function() {
    console.log(this.responseText);
};
```

Questa funzione viene eseguita quando:

```
readyState = 4
```

cioè quando la richiesta è completata.

---

# 7. Stabilire la connessione con il server

Per iniziare la richiesta si usa il metodo:

```javascript
open()
```

Sintassi:

```javascript
xhttp.open(metodo, url, asincrono);
```

Esempio:

```javascript
xhttp.open("GET", "server.php", true);
```

Parametri:

1️⃣ **Metodo HTTP**

- GET
    
- POST
    

2️⃣ **URL**

esempio:

```
server.php?nome=marco
```

3️⃣ **True o False**

- `true` → richiesta **asincrona**
    
- `false` → richiesta **sincrona**
    

---

# 8. Invio dei dati

Per inviare la richiesta si usa:

```javascript
xhttp.send();
```

### Con GET

I dati vengono messi nell'URL:

```
server.php?nome=marco
```

---

### Con POST

I dati vengono messi nel **body della richiesta HTTP**, quindi non sono visibili nell'URL.

Esempio:

```javascript
xhttp.send("nome=marco&eta=20");
```

---

# 9. Proprietà importanti

## onreadystatechange

Questa funzione viene eseguita **ogni volta che cambia lo stato della richiesta**.

```javascript
xhttp.onreadystatechange = function() {

}
```

Gli stati principali sono:

|readyState|Significato|
|---|---|
|0|richiesta non inizializzata|
|1|connessione stabilita|
|2|richiesta inviata|
|3|risposta in arrivo|
|4|risposta completata|

Quando:

```
readyState == 4
```

significa che il server ha risposto.

---

# 10. Leggere la risposta del server

Dopo la risposta del server possiamo usare:

### responseText

Restituisce la risposta **come testo**

```javascript
xhttp.responseText
```

---

### responseXML

Restituisce la risposta **come documento XML**

```javascript
xhttp.responseXML
```

---

# 11. Esempio completo AJAX

```javascript
function caricaDati() {

    const xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        document.getElementById("demo").innerHTML = this.responseText;
    };

    xhttp.open("GET", "server.php", true);

    xhttp.send();

}
```

Questo codice:

1. crea una richiesta AJAX
    
2. invia la richiesta al server
    
3. riceve la risposta
    
4. aggiorna una parte della pagina
    

senza ricaricare tutto il sito.

---

# Riassunto semplice

AJAX permette di:

- comunicare con il server
    
- senza ricaricare la pagina
    
- usando JavaScript
    

I dati vengono scambiati in formato:

- JSON (più usato oggi)
    
- XML (usato in passato)
    

La comunicazione avviene tramite:

```
XMLHttpRequest
```

che permette di:

- aprire una connessione (`open`)
    
- inviare dati (`send`)
    
- ricevere la risposta (`onload`, `responseText`)
    

---

Se vuoi, posso anche farti:

- **uno schema perfetto da interrogazione**
    
- **una mappa mentale**
    
- **10 domande da verifica su AJAX e JSON** (che i prof fanno spesso).


Ottima domanda, perché è **uno dei punti che confonde quasi tutti**.  
La risposta breve è:

**JSON e AJAX sono due cose diverse, ma vengono spesso usate insieme.**

Ora ti spiego **bene come sono collegati**.

---

# 1. AJAX e JSON NON sono la stessa cosa

|||
|---|---|
|**AJAX**|è una **tecnica per comunicare con il server senza ricaricare la pagina**|
|**JSON**|è un **formato per rappresentare e scambiare dati**|

Quindi:

- **AJAX = modo di comunicare**
    
- **JSON = formato dei dati che si scambiano**
    

---


# 2. Come lavorano insieme

Quando una pagina usa AJAX succede questo:

1️⃣ Il **client (browser)** manda una richiesta al server  
2️⃣ Il **server elabora la richiesta**  
3️⃣ Il server manda dei **dati come risposta**  
4️⃣ JavaScript riceve quei dati e aggiorna la pagina

Questi dati spesso sono **in formato JSON**.

Schema semplice:

```
Browser (AJAX)
     ↓ richiesta
Server (PHP, Java, ecc)
     ↓ risposta
    JSON
     ↓
JavaScript usa i dati
```

---

# 3. Esempio concreto

Supponiamo di chiedere al server i dati di un utente.

### Richiesta AJAX

```javascript
const xhttp = new XMLHttpRequest();

xhttp.onload = function() {
    let dati = JSON.parse(this.responseText);
    console.log(dati.nome);
}

xhttp.open("GET", "utente.php", true);
xhttp.send();
```

---

### Risposta del server (JSON)

Il server risponde con:

```json
{
  "nome": "Marco",
  "eta": 20
}
```

---

### Cosa succede

1️⃣ AJAX manda la richiesta  
2️⃣ Il server risponde con **JSON**  
3️⃣ JavaScript converte il JSON in oggetto

```javascript
JSON.parse()
```

4️⃣ Il sito aggiorna la pagina

---

# 4. Perché nei tuoi appunti sembrano la stessa cosa

Nei corsi spesso si studiano insieme perché:

- AJAX serve per **comunicare**
    
- JSON serve per **trasmettere i dati**
    

Quindi nella pratica si usa spesso:

```
AJAX + JSON
```

---

# 5. Un paragone semplice

Immagina:

- **AJAX = il corriere**
    
- **JSON = il pacco**
    

Il corriere (AJAX) **trasporta il pacco (JSON)** tra client e server.

---

# 6. In una frase da interrogazione

Puoi dire così:

> AJAX è un insieme di tecniche che permettono di comunicare con il server in modo asincrono senza ricaricare la pagina.  
> JSON invece è un formato di dati utilizzato per rappresentare e scambiare informazioni tra client e server, spesso usato nelle comunicazioni AJAX.

---

Se vuoi ti spiego anche una cosa che **il 90% degli studenti non capisce su AJAX** ma che i prof chiedono spesso all'esame:  
**perché AJAX si chiama ancora "XML" se oggi usiamo JSON.**