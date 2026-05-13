



# Relazione – Architetture distribuite, applicazioni web e applicazioni di rete

## Introduzione

Un sistema distribuito è costituito dall’insieme di più elaboratori interconnessi che cooperano per raggiungere un obiettivo comune. Negli ultimi decenni, l’evoluzione tecnologica ha portato a un cambiamento significativo nel modo in cui i sistemi vengono progettati, passando da architetture centralizzate a modelli distribuiti sempre più complessi.

Questo cambiamento è stato influenzato anche dai limiti fisici dei microprocessori: la legge di Moore, che prevedeva il raddoppio della potenza ogni due anni, sta raggiungendo i suoi limiti a causa della miniaturizzazione estrema dei componenti e dei vincoli imposti dalla fisica, come la velocità della luce e la dissipazione del calore.

Per questo motivo, si è resa necessaria l’introduzione di nuove architetture sia hardware sia software, capaci di sfruttare il parallelismo e la distribuzione delle risorse.

---

## Architetture distribuite hardware

Dal punto di vista hardware, si è passati da sistemi con una sola CPU a sistemi con più unità di elaborazione, detti **architetture parallele**.

Una classificazione fondamentale è quella di Flynn (1972), basata su due flussi:

- flusso di istruzioni;
    
- flusso di dati.
    

Da questa classificazione derivano quattro tipologie:

### SISD (Single Instruction Single Data)

È il modello tradizionale, con una sola CPU che esegue un’unica sequenza di istruzioni su un singolo flusso di dati. Le operazioni avvengono in modo sequenziale.

### SIMD (Single Instruction Multiple Data)

Un’unica istruzione viene applicata contemporaneamente a più dati. È utilizzata in elaborazioni vettoriali e grafiche.

### MISD (Multiple Instruction Single Data)

Più istruzioni operano sullo stesso flusso di dati. È poco diffusa e non esistono implementazioni commerciali significative.

### MIMD (Multiple Instruction Multiple Data)

Più processori eseguono istruzioni diverse su dati diversi. È il modello più diffuso nei sistemi moderni.

Le architetture MIMD si dividono in:

- **multiprocessori** (memoria condivisa);
    
- **multicomputer** (memoria privata e comunicazione tramite messaggi).
    

---

## Cluster e Grid Computing

### Cluster computing

Un cluster è un insieme di computer omogenei collegati in rete ad alta velocità che lavorano come un unico sistema. Offre:

- alte prestazioni (HPC);
    
- elevata velocità di trasferimento dati;
    
- gestione centralizzata.
    

### Grid computing

È un sistema distribuito altamente decentralizzato e eterogeneo, in cui le risorse (hardware e software) vengono condivise tra organizzazioni diverse.

---

## Sistemi distribuiti pervasivi

Questi sistemi sono caratterizzati da nodi piccoli, mobili e spesso wireless. Comprendono:

- sistemi domotici;
    
- reti di sensori;
    
- wearable computing.
    

Le principali caratteristiche sono:

- adattabilità al contesto;
    
- configurazione dinamica;
    
- condivisione continua delle risorse.
    

---

## Architetture distribuite software

L’evoluzione software ha seguito quella hardware:

### Terminali remoti

Un unico elaboratore centrale gestisce tutto, mentre i terminali sono passivi.

### Client-server

I client richiedono servizi ai server, che elaborano le richieste e inviano le risposte.

### Web-centric

Le applicazioni si spostano sul server, mentre il client gestisce principalmente l’interfaccia.

### Architettura cooperativa

Basata su componenti autonomi che interagiscono tramite servizi standardizzati.

### Architettura completamente distribuita

Le entità sono paritetiche e collaborano senza un centro unico.

### Microservizi

L’applicazione è suddivisa in servizi indipendenti, ciascuno con una funzione specifica.

---

## Middleware

Il middleware è uno strato software intermedio tra sistema operativo e applicazioni.  
Ha il compito di:

- gestire la comunicazione tra componenti;
    
- garantire interoperabilità;
    
- semplificare lo sviluppo di sistemi distribuiti.
    

Supporta diversi modelli di comunicazione, come:

- RPC (Remote Procedure Call);
    
- message passing.
    

---

## Applicazioni web

Un’applicazione web è un software utilizzato tramite tecnologie web.

### Tecnologie del Web

Si distinguono in:

#### Client-side

L’elaborazione avviene sul browser (es. HTML, JavaScript). Il codice è visibile all’utente.

#### Server-side

L’elaborazione avviene sul server (es. PHP, Servlet). Il codice non è visibile al client.

### Linguaggi del Web

- **Mark-up**: strutturano i documenti (HTML, XML);
    
- **Programmazione**: definiscono logica e comportamenti.
    

---

## Modello client-server

Il modello client-server è basato su:

- client che richiedono servizi;
    
- server che li forniscono.
    

### Funzionamento

1. Il client invia una richiesta;
    
2. Il server la riceve;
    
3. Elabora il servizio;
    
4. Invia la risposta;
    
5. Il client la riceve.
    

### Socket

Un socket è identificato da:

- indirizzo IP;
    
- numero di porta.
    

Permette la comunicazione tra processi.

### Comunicazione

- **Unicast**: un client alla volta;
    
- **Multicast**: più client contemporaneamente.
    

---

## Architetture a livelli (tier)

### 1-tier

Sistema centralizzato (mainframe).

### 2-tier

Client-server:

- thin client: logica sul server;
    
- thick client: logica sul client.
    

### 3-tier

- presentation layer;
    
- business logic;
    
- data layer.
    

Vantaggi:

- scalabilità;
    
- sicurezza;
    
- distribuzione del carico.
    

### N-tier

Estensione del modello 3-tier con più livelli intermedi.

---

## Applicazioni di rete

Un’applicazione di rete è composta da più programmi che comunicano tra loro tramite rete.

### Livello applicazione

Gestisce protocolli come:

- HTTP;
    
- FTP;
    
- SMTP;
    
- DNS.
    

### Identificazione dei servizi

Avviene tramite:

- indirizzo IP;
    
- numero di porta.
    

### Struttura

- user agent (interfaccia utente);
    
- protocollo di comunicazione.
    

---

## Architetture delle applicazioni di rete

### Client-server

- server sempre attivo;
    
- client comunicano solo con il server;
    
- possibile uso di server farm.
    

### Peer-to-peer (P2P)

#### P2P decentralizzato

Tutti i nodi sono equivalenti.

#### P2P centralizzato

Un server mantiene l’indice delle risorse.

#### P2P ibrido

Alcuni nodi (super-peer) gestiscono l’indicizzazione.

---

## Conclusione

L’evoluzione delle architetture informatiche ha portato a sistemi sempre più distribuiti, scalabili e complessi. Dalle architetture hardware parallele fino alle moderne applicazioni web e di rete, il concetto fondamentale è la cooperazione tra più entità attraverso protocolli standardizzati.

La scelta dell’architettura più adatta dipende dal tipo di applicazione, dai requisiti di prestazione, sicurezza e scalabilità. Comprendere questi modelli è fondamentale per progettare sistemi efficienti e affidabili nel contesto dell’informatica moderna.