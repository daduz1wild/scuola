Ecco una guida di studio organizzata sui principali comandi e concetti che trovi negli appunti:

---

# Guida allo Studio: Programmazione Concorrente in C

Questa guida riassume i comandi e le funzioni fondamentali utilizzate negli esempi, spiegandone la funzione e alcuni concetti teorici essenziali per l'esame.

---

## 1. **Principali Comandi e Funzioni**

### **fork()**

- **Funzione:** Crea un nuovo processo, chiamato **figlio**, duplicando il processo chiamante (**padre**).
- **Comportamento:**
    - fork, ci sono 3 casistiche, <0(processo non creato),0(processo creato/generato e risorsa(CPU) assegnata al procoesso figlio),>0(processo figlio creato(biforcazione avvenuta), ma la risorsa è assegnata al padre, il numero intero restituito indica il pid(valore intero univoco che identifica i processi) del processo figlio)
- **Utilizzo negli esempi:** Viene usato per generare biforcazioni (una o più) per far eseguire compiti differenti (es. calcolare il cubo di un numero, trovare divisori, elaborare stringhe, ecc.).

---

### **exit(int status)**

- **Funzione:** Termina il processo chiamante e restituisce un codice di uscita al sistema operativo.
- **Utilizzo:**
    - Permette di indicare, tramite lo status, se il processo è terminato correttamente o se c’è stato un errore.
    - Negli esempi, viene usato sia nei processi padre che nei figli per segnalare il termine dell’esecuzione.

---

### **wait(int _status) e waitpid(pid_t pid, int _status, int options)__

- **wait():**
    - **Funzione:** Il processo padre si mette in attesa della terminazione di **uno qualsiasi** dei suoi processi figli.
    - **Restituisce:** Il PID del figlio terminato e memorizza lo stato di uscita.
- **waitpid():**
    - **Funzione:** Consente di attendere la terminazione di un **figlio specifico**, identificato dal suo PID.
    - **Utilizzo negli esempi:** Permette di sincronizzare il padre con il figlio che deve terminare per ultimo (o in modo specifico), evitando processi zombie.

---

### **getpid() e getppid()**

- **getpid():**
    - **Funzione:** Restituisce l’identificatore (PID) del processo chiamante.
- **getppid():**
    - **Funzione:** Restituisce il PID del processo padre del processo chiamante.
- **Utilizzo negli esempi:** Utilizzati per stampare e verificare l’identità dei processi (utile per debug e comprensione del flusso).

---

### **sleep(unsigned int seconds)**

- **Funzione:** Sospende l’esecuzione del processo per il numero di secondi specificato.
- **Utilizzo negli esempi:** Simula ritardi e serve a dare tempo ad altri processi (es. per attendere il processo con attesa maggiore).

---

### **pow(double base, double exponent)**

- **Funzione:** Calcola la potenza; ad esempio, `pow(n, 3)` calcola il cubo di _n_.
- **Nota:** Funzione della libreria `<math.h>`.
- **Utilizzo negli esempi:** Per operazioni matematiche (es. calcolare il cubo).

---

### **Funzioni di I/O Standard: printf() e scanf()**

- **printf():**
    - **Funzione:** Stampa a video il testo o i dati formattati.
- **scanf():**
    - **Funzione:** Legge dati dall’input standard.
- **Utilizzo:** Fondamentale per interagire con l’utente e mostrare risultati.

---

### **Costrutti di Controllo (es. for loop)**

- **Utilizzo:** Permette di iterare su array o eseguire operazioni ripetute (es. calcolare divisori, iterare su una stringa, ecc.).

---

## 2. **Concetti Teorici Essenziali**

### **Biforcazione e Concorrenza**

- **fork() come meccanismo di biforcazione:**
    - Permette di eseguire in parallelo più flussi di esecuzione (processi).
    - Dopo la chiamata, padre e figlio eseguono lo stesso codice ma con dati duplicati (memoria separata).
- **Importanza della distinzione padre/figlio:**
    - Il valore di ritorno di `fork()` permette di differenziare il percorso esecutivo: **0 nel figlio** e **PID del figlio nel padre**.
    - Consente di assegnare compiti diversi (es. uno calcola il cubo, l’altro elenca i divisori).

---

### **Gestione della Terminazione dei Processi**

- **Utilizzo di exit():**
    - Termina in modo controllato un processo, liberando risorse.
- **Uso di wait() / waitpid():**
    - Essenziale per il processo padre per:
        - Sincronizzare la terminazione dei figli.
        - Impedire la formazione di processi zombie (processi terminati ma non "raccogliti" dal padre).

---

### **Sincronizzazione e Attesa**

- **sleep():**
    - Simula ritardi nell’esecuzione, utile per evidenziare la concorrenza e per sincronizzare processi.
- **Differenze tra wait() e waitpid():**
    - `wait()` attende qualsiasi figlio, mentre `waitpid()` consente di scegliere il figlio da attendere (utile quando si hanno più processi figli con comportamenti differenti).

---

### **Esecuzione Parallela e Concorrenza vs. Parallellismo**

- **Concorrenza:** I processi (o thread) possono essere in esecuzione quasi contemporaneamente, ma non necessariamente in parallelo (dipende dalle risorse hardware e dal sistema operativo).
- **Parallellismo:** Esecuzione simultanea vera e propria (richiede più core/processori).

---

## 3. **Esempi Pratici dagli Appunti**

1. **Divisori e Cubo del Numero:**
    
    - **Figlio:** Calcola il cubo (usando `pow()`) e termina con `exit(1)`.
    - **Padre:** Calcola e stampa i divisori del numero, terminando con `exit(0)`.
2. **Calcolo del Maggiore e Media di 4 Numeri:**
    
    - **Figlio:** Calcola e stampa la media.
    - **Padre:** Calcola e stampa il valore maggiore.
3. **Elaborazione di una Parola con 2 Figli:**
    
    - **Primo Figlio:** Sostituisce le vocali con `*` e stampa la parola modificata.
    - **Secondo Figlio:** Calcola e stampa la lunghezza della parola.
    - **Padre:** Stampa la parola originale (e in alcuni esempi la scrive su file).
4. **Attesa del Figlio con Tempo Maggiore:**
    
    - **Processo Padre:** Attende (usando `waitpid()`) il figlio con il tempo di attesa (sleep) maggiore.
    - **Ogni Figlio:** Attende per un numero di secondi specificato e poi stampa il proprio PID e quello del padre.
5. **Esempi di Attesa e Sincronizzazione:**
    
    - Un processo padre che crea più figli e usa `wait()` per sincronizzarsi con il completamento di uno di essi, stampando lo status di terminazione.
6. **Creazione Dinamica di Figli:**
    
    - Uso di una funzione (es. `creaFiglio()`) in un ciclo per generare un numero variabile di processi figli.
    - Dimostra come i processi possono essere creati in maniera iterativa, con output differenziato per padre e figlio.

---

## 4. **Consigli per l'Esame**

- **Comprendere il meccanismo di `fork()`:**
    
    - Sapere distinguere tra il percorso esecutivo del padre e quello del figlio.
    - Capire il significato del valore di ritorno di `fork()`.
- **Gestione della terminazione:**
    
    - Saper usare `exit()`, `wait()` e `waitpid()` per evitare processi zombie.
    - Conoscere il flusso di sincronizzazione tra processi.
- **Identificazione dei processi:**
    
    - Utilizzare `getpid()` e `getppid()` per verificare l’identità dei processi durante il debug.
- **Uso di `sleep()` per la sincronizzazione:**
    
    - Capire come il ritardo possa influenzare l’ordine di esecuzione dei processi.
- **Leggere e analizzare il codice:**
    
    - Saper seguire il flusso logico di un programma concorrente e individuare il punto in cui ogni processo esegue il proprio compito.
- **Aspetti teorici:**
    
    - Conoscere la differenza tra concorrenza e parallellismo.
    - Saper spiegare perché è importante la gestione dei processi (es. per evitare risorse non liberate, processi zombie, ecc.).

---

Studia questi comandi e concetti, e assicurati di capire come e perché vengono usati negli esempi. Buona preparazione per la verifica!
- **Perché si fa il `notify()` qui?**
    
    - Per **risvegliare un altro thread** (cioè un'altra `Auto`) che magari sta aspettando di entrare nel parcheggio ma non può farlo perché il parcheggio è pieno o perché l'accesso è sincronizzato.
        
    - Subito dopo, il thread **si mette in pausa con `wait()`**, **rilasciando il lock**, e permettendo ad altri di entrare nel blocco `synchronized(par)`.
        

📌 **Nota importante:** Se non ci fosse questo primo `notify()`, e tutte le auto chiamassero `wait()` senza svegliare nessuno, si rischierebbe un **deadlock**: tutti in attesa e nessuno che sveglia gli altri.
