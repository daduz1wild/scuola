il caso d'uso è la modalità con la quale l'attore usufruisce della funzionalita

  

lo scenario è l'insieme di passi o di punti (percorso) da svolgerein riferimento al caso d'uso. Di scenari ne abbiamo diversi:

- Principale: è quello che avviene senza eccezioni

- alternativi: sono quelli con eccezioni

  
  

-include:caso d'uso che impone un vincolo, cioe il caso d'uso che punta al caso d'uso incluso, puo essere eseguito solo se il caso d'uso puntato è stato eseguito

- estensione: serve per indicare che un caso d'uso puo essere eseguito durante l'esecuzione del caso d'uso

- generalizzazione: è un tipo di asscoiziazione in ui andiamo a scomporre un caso spuso o attore principale in più categorie che hanno delle specifiche aggiuntive rispetto a quello principale.

  

nei diagrammi che donbbiamo fare in veri9fica in generale è sempre meglio inserire come casi d'uso: gestione profilo

  

admin  che nella relazione devo indicare come riceve le credenziali gestisce il catalogo, quindi puo aggiungere veicoli, togliere veicoli e i inoltre puo gestire utenti e gestire noleggi/car sharing

  

diagramma di contesto

Noleggio

Il cliente effettua un noleggio di un veicolo scelto dal catalogo

Scopo(insiemi generali dei passi da seguire) Scelta del Veicolo, inserimento dei dati temporali e spaziali, inserimento dati di pagamento, conferma noleggio

Cliente, Sistema Bancario

Cliente

Richiesta Optional

Noleggio di un veicolo senza richiesta di optional

entry condition(quale è la condizione necessaria affinché io posso noleggiare): il cliente deve avere effettuato la registrazione e il login.

flusso di eventi(non dobbiamo solamente indicare cosa fa l'attore ma dobbiamo dire anche come risponde il sistema/cosa mostra e senza mettere condizioni):

1. il cliente clicca sul bottone in alto a sinistra "Effettua Noleggio"

2. il sistema mostra il catalogo con i possibili veicoli da noleggiare(il sistema mostra esclusivamente i veicoli disponibili)

3. l'utente seleziona il veicolo desiderato

4. il sistema visualizza una pagina con tutte le info riferite al veicolo selezionato

5. Il cliente conferma la scelta del veicolo

6. Il sistema visualizza una finestra in cui il cliente dovrà inserire i dati riferiti a:

    - data e stazione di ritiro

    - data e stazione di deposito

7. il cliente compila il Form con i dati temporali e  spaziali richiesti al punto 6

8. Il sistema visualizza un messaggio sulla pagina confermando i dati spaziali e temporali inseriti dal cliente

9. Il sistema mostra una pagina dove richiede di inserire i dati di pagamento(Il sistema consente i seguenti tipi di pagamento: carta di credito, carta di debito, bonifico).

10. il cliente inserisce i dati di pagamento richiesti

11. Il sistema bancario verifica i dati di pagamento inseriti dal cliente

12. il sistema mostra un messaggio su pagina di pagamento in cui viene confermato all'utente l'avvenuta verifica dei dati di pagamento inseriti e della loro correttezza

13. Il sistema mostra una pagina in cui è indicata la conferma del noleggio del veicolo scelto, mostrando il riepilogo dell'ordine effettuato

  

exit condition: Il cliente riceve un'email di conferma del noleggio con il riepilogo.

  
  

scenari alternativi: Noleggio di un veicolo con optional: tutto uguale ma si aggiunge 5. Il cliente accede alla sezione di richiesta optional  6. Il sistema mostra una finestra con i possibili optional da aggiungere al veicolo selezionato7. Il cliente in …

  

eccezioni:

A. data o luogo di ritiri/deposito non disponibile:

    - il sistema mostra sulla pagina un messaggio al cliente indicando che data o luogo del ritiro/deposito indicate non sono0 disponibili per il veicolo selezionato

    - il sistema richiede di inserire i dati indicati nel punto precedente

B.  Dati di pagamento non validi(dati inseriti errati o saldo insufficiente):

    - Il sistema mostra sulla pagina un messaggio al cliente indicando che i dati di pagamento inseriti non sono validi

  

requisiti speciali(funzioni premium che l'utente puo richiedere)

extensions point: sono attori esterni con cui si comunica: sistema bancario

frequenza stimata all'utilizzo: 100 utenti al giorno

criticità: latenza dei server, mancanza di connessione



Perfetto, ti riscrivo gli appunti in modo **ordinato, chiaro e professionale**, mantenendo **tutte le informazioni** ma sistemate bene, come da studio per verifica.

---

# 📌 Fasi della progettazione di un software

Il primo step della progettazione software è l’analisi della documentazione fornita dal committente (cliente).

Dopo un colloquio con il committente, si raccolgono tutti i requisiti necessari per iniziare la fase di progettazione. Da questa fase derivano tre elementi fondamentali:

---

## 1️⃣ Relazione tecnica

La relazione tecnica è il documento in cui si spiega come è stato risolto il problema posto dal cliente.

Deve specificare:

- Le caratteristiche del sistema
    
- Chi utilizza il sistema (attori)
    
- Quali funzionalità il sistema offre
    
- Le operazioni che gli utenti devono o possono svolgere (casi d’uso)
    

Bisogna descrivere:

- Se è prevista la registrazione
    
- Se è necessario il login
    
- Tutte le azioni possibili nel sistema
    

La relazione deve essere chiara, non ambigua e scritta con linguaggio semplice, perché verrà letta anche dagli stakeholder.

---

## 2️⃣ Diagramma di contesto (o diagramma dei casi d’uso)

Rappresenta in modo schematico le informazioni descritte nella relazione.

### Attore

Un attore NON è necessariamente un essere umano.  
È qualsiasi entità interna o esterna che interagisce con il sistema.

Regole fondamentali:

- Deve essere identificato in modo univoco
    
- Si rappresenta con uno stickman
    
- Non deve mai chiamarsi “Sistema”
    

Si distinguono:

- **Attore principale** → porta a termine il caso d’uso e ne beneficia  
    (esempio: utente che acquista un prodotto)
    
- **Attore secondario** → partecipa a una o più fasi del caso d’uso ma non lo termina  
    (esempio: sistema bancario che gestisce il pagamento)
    

Il sistema viene rappresentato con un rettangolo (contenente i casi d’uso), mentre gli attori si trovano all’esterno.

---

### Caso d’uso

Il caso d’uso è la modalità con cui un attore utilizza una funzionalità del sistema.

- **Funzionalità** = azione o servizio che il sistema offre
    
- **Scenario** = insieme dei passi necessari per completare un caso d’uso
    

Ogni caso d’uso può avere:

- Uno scenario principale
    
- Più scenari alternativi
    
- In alcuni casi, infiniti scenari possibili
    

Portare a termine un caso d’uso significa completare l’obiettivo (esempio: acquisto concluso con successo).

---

### Associazioni

Le associazioni sono linee continue che collegano attore e caso d’uso.

Un caso d’uso può essere collegato a più attori.

Se dobbiamo distinguere attore principale e secondario, utilizziamo una freccia piena verso l’attore secondario.

---

## Relazioni tra casi d’uso

### 🔹 Inclusione (<>)

Si usa quando un caso d’uso dipende obbligatoriamente da un altro.

Esempio:  
Acquisto prodotto include Login.

Significa che l’acquisto può essere effettuato solo se prima è stato eseguito il login.

Si rappresenta con:

- Freccia tratteggiata
    
- Punta piena
    
- Scritta <>
    
- Direzione: dal caso d’uso che richiede, verso quello richiesto
    

Non si vincola la Registrazione al Login, perché un utente non registrato non può comunque accedere alle funzioni riservate.

---

### 🔹 Estensione (<>)

Indica un comportamento facoltativo.

Esempio:  
Durante l’acquisto, l’utente può richiedere Assistenza online.

Si rappresenta con:

- Freccia tratteggiata
    
- Punta piena
    
- Scritta <>
    
- Direzione: dal caso facoltativo verso quello principale
    

---

### 🔹 Generalizzazione

È collegata al concetto di ereditarietà della programmazione a oggetti.

Una classe figlia eredita attributi e metodi pubblici della classe padre.

Nel diagramma:

- Si usa una linea continua
    
- Freccia con punta vuota
    

Esempi:

- Acquisto CD e Acquisto libro possono generalizzare Acquisto prodotto.
    
- Cliente azienda e Cliente privato possono generalizzare Cliente registrato.
    

Tutti ereditano anche i vincoli (esempio: obbligo di login).

---

## 2️⃣ Diagramma di Jacobson (Tabella dei casi d’uso)

Il **diagramma di Jacobson** è più dettagliato e serve a descrivere **ogni caso d’uso in maniera completa**. È la base per il manuale del sistema.

**Sezioni principali di un diagramma di Jacobson (tabella):**

1. **Nome del caso d’uso:** breve e chiaro (es. `Effettua Noleggio`).
    
2. **Scopo:** descrive in breve cosa fa il caso d’uso e quali passi principali comprende.
    
3. **Attori coinvolti:** distinguere tra principale e secondario.
    
4. **Entry condition:** cosa deve essere vero per iniziare il caso d’uso (es. Cliente registrato e loggato).
    
5. **Flusso di eventi (scenario principale):**
    
    - Passo per passo, includendo sia **azioni dell’attore** sia **risposta del sistema**.
        
    - Non mettere condizioni, solo sequenza di azioni e reazioni.
        
6. **Exit condition:** cosa succede alla fine, come si capisce che il caso d’uso è completato (es. “Cliente riceve e-mail di conferma”).
    
7. **Scenari alternativi:** percorsi diversi rispetto allo scenario principale (es. aggiunta optional, sconto gruppi).
    
8. **Eccezioni:** cosa succede se qualcosa va storto (es. pagamento non valido, data non disponibile).
    
9. **Requisiti speciali:** funzionalità premium o vincoli particolari (es. abbonamento con spedizione rapida).
    
10. **Extension points:** sistemi esterni con cui il caso d’uso comunica (es. Sistema Bancario).
    
11. **Frequenza stimata utilizzo:** numero di utenti o operazioni previste al giorno.
    
12. **Criticità:** punti deboli o rischi (es. latenza server, assenza connessione).
    

**Consigli pratici:**

- Segui sempre lo **stesso schema per ogni caso d’uso**, così chi legge (stakeholder) capisce subito cosa fa il sistema.
    
- Scrivi **in modo chiaro e non ambiguo**: chi fa cosa, cosa mostra il sistema, eventuali vincoli.
    
- Per gli attori secondari, specifica bene **quando intervengono**.
    
- Se c’è un **estensione o inclusione**, indicala nella riga corrispondente (`UseCase d’Extend`).

---

## Documento dei requisiti (SRS)

Il documento dei requisiti (Software Requirements Specification) descrive in modo formale il sistema.

Quando si compila la tabella dettagliata dei casi d’uso significa che il prodotto è già stato progettato e si sta documentando ciò che è stato realizzato.

---

# 📍 Riassunto delle fasi

1. Analisi dei requisiti (colloquio con il cliente)
    
2. Relazione tecnica + diagramma di contesto (fase di progettazione)
    
3. Diagrammi di Jacobson (fase finale di descrizione dettagliata)
    

---

Se vuoi, al prossimo messaggio posso trasformarti questi appunti in:

- 🧠 versione super sintetica da ripasso pre-verifica
    
- 📄 versione perfetta da consegnare
    
- 📊 schema riassuntivo da studiare velocemente
    

Dimmi quale ti serve.