un archivio è un insieme organizzato di informazioni, tipo come nei csv che i dati soro richiesti in un certo ordine(con un nesso logico).
queste proprieta hanno delle proprieta fondamentali:
- tra di loro c'è un nesso logico
- -

un archivio è una struttura dati astratta costituita da un record, ogni record ha una posizione dentro all'archivio che lo identifica, (l'indirizzo logico) non è lo stesso all'interno del file.
 in un record individuiamo dei campi, che sono vari pezzettini che lo compongono.
 il tracciato del record è l'elenco dei campi del record.
oil file è una struttura di memoria fisica in cui memorizziamo i dati sotto forma di sequenze di by................................................................................te o record. la struttura di dati astratta(record) alla fine viene implementata nel file sottoforma di archivio(insieme dei record)
ogni record all'interno del file è individuato tramite indirizzo fisico.
un archivio di dati è sempre implementato mediante uno o più file.

la creazione di un archivio richiede la definizione preliminare :nome, tracciato del record, supporto da usare per archiviare i dati, dimensione massima dell'archivio, il modo con cui ik dati sono strutturati e collegati .

quando io dalla memoria fisica o dalla memoria di massa, chiedo dati da un file(tipo record), essi vengono trasferiti in blocchi.

blocco fisico letto da file può contenere più record logici 

la fine del record nella lettura di un file è dato dall'EOF(end of file) spesso a capo.
organizzazione sequenziale:
-semplice

organizzazione ad accesso diretto, è una struttura che devo conoscere per alvorarci, ed è molto bello perchè posso arrivare direttamente al punto/record in cui voglio.
pero c'è un problema 

l'organizzazione a indici: di solito quando ho una tabella, e sono che in una certa posizione c'è una specifica persona impazzisco, quindi devo usare la ricerca binaria, ma per poterla usare i dati devono essere ordinati e in file binario.
il campo chiave è quel campo che mi permette di identificare in modo univoco un determinato oggetto; quindi avrò in un file indice un cod. collegato all'ident. numerico cosi poi in un file di testo avrò collegato a quel numero tutti i dati di quella persona (HASHTABLE)



# Che cos’è un **archivio**

Un **archivio** è un insieme organizzato di informazioni che hanno un nesso logico tra loro — cioè riguardano lo stesso argomento (es. anagrafiche studenti, catalogo prodotti, ecc.). Le informazioni sono memorizzate in un formato interpretabile e su un supporto di memoria permanente (disco, SSD, chiavetta), in modo che possano essere lette e scritte e facilmente consultate.

DB01 - Archivi

# Concetti fondamentali (collegati ai tuoi appunti)

- **Nesso logico**: i dati nell’archivio sono correlati (non sono semplici numeri mescolati a caso).
    
    DB01 - Archivi
    
- **Formato interpretabile**: ogni dato è rappresentato in un modo comprensibile (es. testo, numeri, campi fissi).
    
    DB01 - Archivi
    
- **Supporto permanente**: si usa memoria di massa (file sul disco).
    
    DB01 - Archivi
    
- **Facilità di consultazione**: l’organizzazione deve permettere di trovare velocemente i dati.
    
    DB01 - Archivi
    

# Record, campi e tracciato

- Un **record** è una struttura logica che raccoglie i campi relativi a un singolo elemento (es. per uno studente: matricola, cognome, nome). I campi sono i singoli "pezzi" del record.
    
- Il **tracciato del record** è l’elenco dei campi (l’ordine e il tipo di ciascun campo). È fondamentale definirlo prima di creare l’archivio.
    
    

# File (struttura fisica) vs Archivio (astratto)

- Il **file** è la struttura fisica che memorizza i dati sul supporto (sequenza di byte o di record). L’**archivio** è la struttura dati astratta (insieme di record); per memorizzare l’archivio si usa uno o più file. Ogni record nel file ha un **indirizzo fisico** (posizione sul disco), mentre nell’archivio si parla di **indirizzo logico** (posizione logica nel set di record).
    
    

# Specifiche da definire quando si crea un archivio

Durante l’analisi devi decidere:

- nome dell’archivio (es. “archivio fornitori”);
    
- tracciato del record (campi e tipi);
    
- supporto (disco, SSD, cloud, ecc.);
    
- dimensione massima (se serve);
    
- **organizzazione dell’archivio** (sequenziale, ad accesso diretto, a indici, ecc.).
    

    

# Trasferimento dati: blocchi e buffer

- I dati tra memoria centrale (RAM) e periferica (disco) vengono trasferiti in **blocchi** (non record singoli). Tipiche dimensioni di blocco: 2 KB, 4 KB, 8 KB. I dati letti vengono copiati nel **buffer I/O** in RAM.
    
    
- Un blocco fisico può contenere **più record logici**.
    
- **Fattore di blocco** = numero di record logici contenuti in un blocco.  
    Esempio pratico: se il blocco è 4096 byte e ogni record è 200 byte, il fattore di blocco è 4096 ÷ 200 = 20 record per blocco (si prende la parte intera). Questo è utile per valutare l’efficienza di spazio e I/O.
    
    

# Fine del record / fine del file

- Nella registrazione sequenziale la fine di un record può essere marcata con caratteri di delimitazione (es. newline) o da un campo lunghezza; la fine del file è EOF (end-of-file).
    

# Tipi di organizzazione degli archivi (con pro/contro e esempi)

## 1) Organizzazione sequenziale

- I record sono memorizzati uno dopo l’altro. Spesso si usano record a lunghezza variabile e si delimita con EOR (End Of Record).
    
    
- **Pro**: semplice, facile da implementare, adatto a file piccoli o per elaborazioni batch.
    
- **Contro**: per trovare il record i-esimo (o un record specifico) devi scorrere tutti quelli precedenti → accesso **sequenziale** (lento per ricerche puntuali).
    
- **Esempio pratico**: un CSV è tipicamente sequenziale: per trovare la riga con una certa chiave bisogni leggere riga per riga.
    

## 2) Organizzazione ad accesso diretto (random)

- I record hanno **lunghezza fissa** e si possono indirizzare direttamente: si calcola l’offset (posizione) del record N e si legge direttamente quel punto del file.
    
    
- **Formula tipica** (se non c’è header e si contano i byte dall’inizio):  
    offset = (N − 1) × L_record  
    (es.: se L_record = 100 byte e vuoi il record N=5 → offset = (5−1)×100 = 400 → vai a byte 400 e leggi 100 byte). Questo permette accesso casuale molto rapido.
    
- **Pro**: accesso diretto, velocissimo per letture a caso.
    
- **Contro**: record a lunghezza fissa (meno flessibile), gestione cancellazioni/insert può richiedere tecniche di riuso/compattazione.
    
    DB01 - Archivi
    

## 3) Organizzazione a indici

- Si crea un **file indice** (o più livelli di indici) che contiene le **chiavi** ordinate e un puntatore alla posizione del record nel file primario (spesso un file ad accesso diretto).
    
    DB01 - Archivi
    
- Per cercare si effettua una **ricerca binaria** (dicotomica) nella tabella delle chiavi per recuperare il puntatore al record. I dati (file principale) non sono cercati direttamente per posizione, ma tramite indice.
    
    DB01 - Archivi
    
- Si può indicizzare la **chiave primaria** (campo che identifica univocamente) oppure campi secondari (es. cognome).
    
- **Vantaggi**: migliora molto le prestazioni di lettura (leggi più spesso che scrivi).
    
- **Svantaggi**: occupa spazio aggiuntivo (file indice) e l’inserimento richiede aggiornamento dell’indice → operazione più lenta.
    
    DB01 - Archivi
    

### Indici multilivello

- Per grandi archivi si costruiscono indici su più livelli (indice di livello 2 che punta all’indice di livello 1 che punta al file primario). Questo riduce la dimensione della porzione che devi cercare con la ricerca binaria.
    
    DB01 - Archivi
    

## 4) Strutture avanzate per indice: B-tree e Hashing

- **B-tree (alberi bilanciati)**: struttura ad albero che mantiene le chiavi ordinate e permette ricerche, inserimenti e cancellazioni in tempo logaritmico; molto usata nei DBMS per gli indici.
    
    DB01 - Archivi
    
- **Hashing**: una funzione hash calcola una posizione a partire dalla chiave; permette accesso diretto vicino a O(1) ma ha gestione delle collisioni (quando due chiavi mappano stessa posizione). Utile per lookup molto veloci ma meno per range query (intervalli).
    
    DB01 - Archivi
    

# Inserimento, cancellazione, aggiornamento e interrogazione

- **Sequenziale**: inserimento tipicamente in coda (append). Cancellazioni: spesso si marca come "cancellato" e si compattano/ricostruisce il file periodicamente.
    
- **Direct access**: si può riscrivere direttamente il record alla sua posizione se la dimensione è fissa; cancellazione può lasciare “buche” da riutilizzare.
    
- **Indice**: ogni inserimento/cancellazione richiede aggiornamento dell’indice (più costoso in scrittura, ma tempo di lettura migliore).
    
    DB01 - Archivi
    

# Collegamento con i tuoi appunti (correzioni e integrazioni)

- Tu hai scritto: “l'indirizzo logico non è lo stesso all'interno del file.” → corretto: l’indirizzo logico identifica la posizione logica del record (es. record numero 10), mentre l’indirizzo fisico è l’offset/posizione sul disco; i due possono corrispondere solo in alcune organizzazioni (accesso diretto) ma in generale sono concetti distinti.
    
    DB01 - Archivi
    
- Hai scritto “il file è una struttura di memoria fisica in cui memorizziamo i dati sotto forma di sequenze di by...te o record” → giusto: byte o record.
    
    DB01 - Archivi
    
- “la fine del record ... è dato dall'EOF (spesso a capo)” → per i file sequenziali a testo (CSV) la fine del record è spesso il newline; EOF indica la fine del file.
    
    DB01 - Archivi
    

# Piccoli esempi pratici per fissare i concetti

- CSV (sequenziale): per trovare l’utente con ID 123 devi leggere riga per riga fino a trovarlo → O(n).
    
- File binario a record fissi (direct access): se ogni record fa 100 byte e vuoi il record 5 → vai a byte 400 e leggi 100 byte → accesso diretto (molto veloce).
    
- Indice: costruisci una tabella che mappa la **chiave** → puntatore; cerchi la chiave nell’indice (ricerca binaria) e ottieni il puntatore al file primario.
    

# Consigli pratici per studiare e ricordare

1. **Distinguere sempre**: concetti logici (archivio, record, campo) vs concetti fisici (file, blocco, indirizzo fisico).
    
2. **Esempi**: tieni due esempi in testa — CSV (sequenziale) e file a record fissi (direct access). Confrontali per capire pro/contro.
    
3. **Memorizza la formula** per accesso diretto: offset = (N−1) × L_record (e ricorda l’effetto di header o se si usa base 1/0).
    
4. **Blocchi e fattore di blocco**: calcola qualche esempio (es. blocco 4096 B, record 200 B → 20 record per blocco). Ti aiuta a capire perché la dimensione record influenza I/O.






