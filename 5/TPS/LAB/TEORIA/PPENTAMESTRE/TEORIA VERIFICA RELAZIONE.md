## 1️⃣ Diagramma di Contesto

Il **diagramma di contesto** serve a rappresentare **a grandi linee il sistema e tutte le entità esterne che interagiscono con esso**. Ti permette di capire subito **chi interagisce con il sistema e quali casi d’uso principali esistono**.

**Elementi principali:**

- **Sistema:** rappresentato con un rettangolo tratteggiato (contiene i casi d’uso).
    
- **Attori:** entità che interagiscono col sistema (possono essere persone, altri sistemi, ecc.). Si distinguono in:
    
    - **Attore principale:** porta a termine un caso d’uso (es. Cliente che effettua un noleggio).
        
    - **Attore secondario:** partecipa solo ad alcune fasi, non porta a termine il caso d’uso (es. Sistema Bancario che verifica pagamento).
        
- **Casi d’uso:** rappresentano le funzionalità principali che il sistema offre. Collegate agli attori tramite linee continue.
    
- **Associazioni tra casi d’uso:** possono essere di vari tipi:
    
    - **Include (`<<include>>`):** il caso d’uso “incluso” deve essere eseguito obbligatoriamente per il caso d’uso principale.
        
    - **Extend (`<<extend>>`):** caso d’uso facoltativo che si attiva solo in certe condizioni.
        
    - **Generalizzazione:** eredita le caratteristiche di un caso d’uso o di un attore principale (es. Cliente → Privato e Azienda).
        

**Consigli pratici per la verifica:**

- Identifica prima tutti gli **attori principali e secondari**.
    
- Metti i casi d’uso **dentro il rettangolo del sistema**.
    
- Collega con linee continue gli attori principali ai loro casi d’uso.
    
- Per gli attori secondari usa frecce piene che puntano al caso d’uso in cui intervengono.
    
- Specifica eventuali **inclusioni o estensioni** tra i casi d’uso con linee tratteggiate e etichetta `<<include>>` o `<<extend>>`.
    

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

## 3️⃣ Casi d’uso: teoria pratica

- **Caso d’uso:** modalità con cui un attore usufruisce di una funzionalità.
    
- **Scenario:** insieme di passi che l’attore deve eseguire per completare il caso d’uso.
    
    - **Principale:** il percorso “normale” senza eccezioni.
        
    - **Alternativo:** percorsi diversi, a volte causati da eccezioni.
        
- **Include:** vincolo obbligatorio (freccia tratteggiata con `<<include>>` dal caso principale a quello incluso).
    
- **Extend:** funzionalità facoltativa (freccia tratteggiata con `<<extend>>` dal caso opzionale a quello principale).
    
- **Generalizzazione:** ereditarietà (freccia vuota) per attori o casi d’uso più specifici.
    
- **Associazioni:** linee continue tra attore e caso d’uso principale; frecce piene verso casi in cui l’attore secondario partecipa.
    

**Esempio pratico (basato sui tuoi appunti del museo):**

- Attore principale: Utente registrato
    
- Attore secondario: Sistema Bancario
    
- Caso d’uso principale: Acquista Biglietto
    
- Scenario principale:
    
    1. Utente seleziona data e ora.
        
    2. Sistema mostra disponibilità.
        
    3. Utente inserisce numero di biglietti e dati partecipanti.
        
    4. Sistema calcola eventuali sconti.
        
    5. Utente inserisce dati pagamento.
        
    6. Sistema Bancario verifica pagamento.
        
    7. Sistema invia biglietti via email. ✅ Exit condition.
        

---

## 4️⃣ Strutturare la relazione tecnica

La **relazione tecnica** serve a spiegare **come il sistema risolve i requisiti del cliente**:

1. **Descrizione generale del sistema:** breve introduzione sullo scopo.
    
2. **Attori e funzionalità:** descrizione dettagliata degli attori principali e secondari e dei casi d’uso che possono eseguire.
    
3. **Processo di registrazione e login:** obbligatorio per casi d’uso come acquisto biglietti.
    
4. **Flussi principali e alternativi:** spiegare passo passo cosa fa l’attore e come reagisce il sistema.
    
5. **Vincoli e regole:** sconti per gruppi, conferma mail, eccezioni.
    
6. **Output del sistema:** cosa riceve l’utente al termine del caso d’uso (exit condition).
    
7. **Sistemi esterni:** eventuali extension points (es. Sistema Bancario).
    
8. **Criticità e requisiti speciali:** punti critici, funzioni premium, frequenza di utilizzo stimata.
    

**Regole d’oro per la relazione:**

- Un caso d’uso alla volta: descrivi bene attore, flusso, eccezioni.
    
- Usa sempre **scenari principali, alternativi e eccezioni**.
    
- Specifica sempre **chi riceve cosa**: email, biglietto, conferma.
    
- Evidenzia chiaramente **attore principale vs secondario**.
    
- Mantieni **chiarezza assoluta**, perché la relazione deve essere comprensibile a stakeholder non tecnici.



ESEMPIO JACOBSON

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



ESEMPIO  RELAZIONE

L’applicativo che si andrà a realizzare prevederà la presenza di un utente non registrato il quale potrà visitare il sito web per verificare gli orari e le date dei vari ingressi del museo. Nel caso in cui un utente intenda acquistare online dei biglietti dovrà registrarsi sul portale inserendo le seguenti informazioni: e-mail, password, nome, cognome, data di nascita, luogo di nascita, codice fiscale. Nel caso in cui sia un istituto scolastico a voler registrarsi, i dati da inserire saranno i seguenti: e-mail istituzionale, password, codice meccanografico (codice d’identificazione univoca della scuola). In entrambi i casi l’e-mail dovrà essere verificata poiché all’atto della conferma dei dati inseriti l’utente non registrato riceverà sulla e-mail indicata un messaggio contenente un link che si dovrà cliccare per confermare la creazione dell’account. Una volta che l’utente avrà confermato l’e-mail potrà effettuare l’accesso alla piattaforma tramite l’e-mail utilizzata per la registrazione e la password creata.

Nel caso in cui l’utente registrato intenda acquistare dei biglietti potrà, dopo aver effettuato il login, accedere alla sezione specifica in cui dovrà indicare il giorno e l’ora della visita tra quelli ancora disponibili. Una volta scelti giorno e fascia oraria, l’utente andrà a selezionare il numero di biglietti da acquistare, corrispondente al numero di persone che effettueranno la visita. Per le persone aggiuntive l’utente registrato dovrà indicare nome, cognome, codice fiscale e data di nascita, così da permettere al sistema di applicare automaticamente eventuali scontistiche previste per fasce di età o categorie tutelate.

Una volta inseriti i dati indicati, l’utente registrato dovrà selezionare il metodo di pagamento. Se il numero di biglietti supera la soglia minima per i gruppi indicata dal gestore del museo, verrà automaticamente applicato uno sconto sul totale. Nel caso in cui invece l’acquisto venga effettuato da una scolaresca si dovrà indicare giorno e ora della visita, il numero di studenti partecipanti e i dati degli accompagnatori (nome, cognome, codice fiscale e data di nascita). Per le scuole l’acquisto sarà consentito esclusivamente tramite il sito web, come previsto dai requisiti.

L’utente registrato, una volta definiti i biglietti da acquistare, andrà a inserire i dati per il pagamento online, che verranno verificati dal sistema bancario associato al metodo di pagamento scelto. Una volta confermato il pagamento, l’utente registrato riceverà sulla mail indicata nella fase di registrazione una copia digitale dei biglietti acquistati, valida per l’ingresso al museo.

Nel caso in cui una persona voglia acquistare un biglietto tramite la biglietteria, una volta recatosi in loco, interverrà l’addetto alla biglietteria il quale, dopo aver effettuato l’accesso alla piattaforma tramite le credenziali fornite dall’admin, andrà a selezionare data e ora, nome, cognome e data di nascita indicati dalla persona e, in seguito al pagamento da parte di quest’ultima, verrà fornita una copia cartacea del biglietto. L’acquisto offline potrà essere effettuato esclusivamente dall’addetto alla biglietteria, mentre eventuali sconti per categorie, gruppi o scolaresche seguiranno le regole impostate dal sistema, con l’eccezione delle scuole, che potranno acquistare solo online.

L’applicativo prevede inoltre la gestione delle guide museali, le quali, accedendo con le proprie credenziali, potranno visualizzare l’elenco delle visite loro assegnate, con indicazione di data, ora, numero di partecipanti e altre eventuali informazioni utili. In questo modo la guida potrà organizzare il proprio lavoro e prepararsi in anticipo alle visite programmate. L’amministratore del sistema potrà assegnare le visite alle guide e gestire eventuali modifiche o annullamenti, garantendo un flusso di lavoro ordinato ed efficiente.