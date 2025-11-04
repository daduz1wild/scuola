il db è una collezzione di dati logicamente correlati e condivisi che ha lo scopo di ssoddsfare i fabbisogni informativi di una specifica organizzazione. Se una azienda dovesse perdere il database dovrebbe chiudere, infatti essi sono importantissimi, perche tutti i tuoi clienti dati finanziarti sparirebbero ed è impossibile andare avanti senza.

- i dati congiuntamente con la loro descrizione sono gestiti da un unico sistema( chiamato DBMS, DataBase Management System). user o app che ha le api puo comunicae col database grazie al DBMS, che un altro layer che aumenta la sicurezza separando idati dalle applicazioni.
un database deve essere:
- un database deve essere sicuro questo significa che deve impedire che essa possa essere danneggiato da eventi accidentali(come crash di sistema) o da accessi non autorizzati;
- consistente: quindi i dati in esso contenito devono essere significativi e utilizzabili
- integro: deve garantire che le operazioni effettuate da utenti autorizzati non possono provocare una perdita di consistenza di dati; quindi questo dato è collegato con la consistenza.
-  condivisibile: ossia applicazioni ed utenti devono ppter accedere
- persistente: ossia deve avere unt empo di vita che non è limitato a quello delle singole esecuzioni dei programmi( deve rimanere nel tempo)
- efficiente: l'utilizzo delle risorse(CPU e memoria) deve essere ottimizzato

quando io progetto un database, devo basarmi sulle richieste del cliente e sulla base delle richieste devo trovare il modo di risolvere le richieste.
progettazione logica, progettazione fisica..

esempio di progettazione:
- fase 1(analisi dei reuisiti)=importante scrivere tutte le richiste del cliente,:
	- 
- fase 2(progettazione concettuale):
	- modello entita relazione= è quel diagramma/rappresentazione ggrafica, dei dati ched devono essere memorizzati, e siamo solo a livello concettuale non le cose tecniche, appunto quello che voglio fare(i concetti).
	 - obiettivo= descrivere cosa deve contenere il database senza preoccuiparsi di come verra implementato
	 - non abbiamo preso anciora nessuna scelta su quale database utilizzare
	 
- fase 3(progettazione logica):
	- scegliamo in quale tipo di database mettere i dati
	- obiettivo= traduzione del modello concettuale in uno schema logico(tabelle o altro in base al modello di database scelto) una veria  e propria tabella.
- fase 4(progettazione fisica):
	- obiettivo=creazione del database e verifico che sia corretto il codice
	il test viene fatto tra fase 4 e fase 5 solitamente
- fase 5(realizzazione applicazione):
	- inzizi a usare effettivamente il database creato
-


# Cos’è un database

Un **database** è una collezione di dati _logicamente correlati e condivisi_ pensata per soddisfare i bisogni informativi di una specifica organizzazione. Se un’azienda perdesse il suo database rischierebbe di non poter più accedere a informazioni fondamentali (clienti, dati finanziari, ordini) e questo può bloccare l’attività — da qui l’importanza critica del database.



# DBMS (Database Management System)

I dati insieme alla loro descrizione (metadati, vincoli, schema) sono gestiti da un unico sistema chiamato **DBMS** (DataBase Management System). Il DBMS:

- amministra i dati e controlla gli accessi;
    
- espone interfacce/API usate da utenti o applicazioni per leggere/modificare i dati;
    
- crea un livello di separazione tra dati e applicazioni, aumentando sicurezza e gestione.
    

    

# Proprietà che un database deve avere

Un buon database dovrebbe essere:

- **Sicuro**: deve prevenire danni accidentali (crash, corruzione) e accessi non autorizzati.

    
- **Consistente**: i dati devono essere significativi e utilizzabili (rispettare vincoli, regole aziendali).

    
- **Integro**: le operazioni effettuate da utenti autorizzati non devono compromettere la consistenza complessiva dei dati (integrity constraints).
    
- **Condivisibile**: più applicazioni/utenti devono poter accedere ai dati in modo controllato.

    
- **Persistente**: i dati rimangono disponibili nel tempo, non solo per la durata di un singolo programma.
    

    
- **Efficiente**: uso ottimizzato delle risorse (CPU, memoria, I/O) per rispondere alle richieste.
    

    

# Progettazione di un database — fasi principali

Quando progetti un database ti basi sui requisiti del cliente e segui tipicamente queste fasi:

**Fase 1: Analisi dei requisiti**

- Raccogli tutte le richieste del cliente: quali dati servono, come verranno usati, vincoli legali, performance richieste, ecc. (es.: gestire una collezione di vini, tracciare posizione/stato/invecchiamento).
    
    
    

**Fase 2: Progettazione concettuale**

- Si descrive _cosa_ deve contenere il database senza preoccuparsi di come verrà implementato.
    
- Si costruisce un **Modello Entità–Relazione (E-R)** che rappresenta entità (es. Bottiglia), attributi (es. NomeVino, Annata) e relazioni tra entità. L’obiettivo è catturare i concetti e le regole del dominio.
    

    

**Fase 3: Progettazione logica**

- Si sceglie il tipo di modello di dati (relazionale, documentale, grafi, ecc.) e si traduce il modello concettuale in uno **schema logico** (tabelle, colonne, chiavi, relazioni nel caso relazionale). Questo è il livello delle tabelle o delle collezioni.

    

**Fase 4: Progettazione fisica**

- Si crea effettivamente il database sul DBMS scelto: definizione tabelle, tipi, indici, partizionamento, backup, configurazioni di storage. Si scrive il codice SQL (o equivalente) e si eseguono test.
    
    

**Fase 5: Realizzazione applicazioni (deploy + test + uso)**

- Si sviluppano le applicazioni che usano il database, si esegue l’inserimento dati (seed), si testano interrogazioni, si monitora performance e si mette in esercizio il sistema. Esempi di INSERT/SELECT e query di analisi vengono eseguiti in questa fase.
    

# Esempio pratico (da prof — collezione di vini)

Il prof ha usato l’esempio di gestione di una **cantina vini** con queste scelte: campi come CodiceBottiglia, NomeVino, Annata, Gradazione, TipoVino, Cantina, DataAcquisto, PrezzoAcquisto, PosizioneCantina, Stato, con vincoli (PK, NOT NULL, CHECK, DEFAULT).

Esempio di codice SQL (creazione del DB e della tabella Bottiglie) preso dal prof:

`CREATE DATABASE CantinaVini; USE CantinaVini;  CREATE TABLE Bottiglie (   CodiceBottiglia VARCHAR(10) PRIMARY KEY,   NomeVino VARCHAR(50) NOT NULL,   Annata INTEGER NOT NULL,   Gradazione DECIMAL(3,1),   TipoVino VARCHAR(10) CHECK (TipoVino IN ('Rosso','Bianco','Rosato','Spumante')),   Cantina VARCHAR(50),   DataAcquisto DATE,   PrezzoAcquisto DECIMAL(6,2),   PosizioneCantina VARCHAR(20),   Stato VARCHAR(15) DEFAULT 'In cantina' );`

(esempi di INSERT e query di SELECT per trovare vini rossi più vecchi e calcolare valore totale della collezione sono anch’essi forniti dal prof).

# Piccoli chiarimenti / suggerimenti pratici

- Quando dici “il DB è importantissimo, se un’azienda lo perde deve chiudere”: è vero come principio — per questo si usano backup regolari, replica, clustering e procedure di disaster recovery.
    
- La **consistenza** e **integrità** non sono la stessa cosa: consistenza riguarda il fatto che i dati siano significativi; integrità indica che i vincoli (es. chiavi, check) impediscono dati incoerenti. Le transazioni (ACID) sono il meccanismo che aiuta a garantire integrità e consistenza nelle operazioni concorrenti.
    
- Nel progettare, pensa anche a: indici per query frequenti, normalizzazione per evitare ridondanze (o denormalizzazione quando serve performance), e politiche di sicurezza (ruoli, autenticazione, cifratura).