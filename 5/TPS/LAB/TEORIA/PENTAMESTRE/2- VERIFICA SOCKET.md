Certo. Ti lascio le risposte **ordinate esercizio per esercizio**, con le **crocette** sulle alternative giuste e con il **codice Java** impostato nello stile dei tuoi appunti/progetto.

---

# 1) Differenze tra protocollo TCP e UDP

Il **TCP** è un protocollo **connection-oriented**, quindi prima di comunicare instaura una connessione tra client e server. È inoltre **affidabile**, perché controlla che i dati arrivino correttamente, usa gli acknowledge e garantisce l’ordine dei pacchetti. Lavora in modalità **full-duplex**.

L’**UDP** è invece un protocollo **connectionless**, quindi non stabilisce una connessione vera e propria. È **più veloce**, ma **non affidabile** come TCP, perché non garantisce né l’ordine di arrivo né la consegna sicura dei pacchetti.

---

## 2) Concetto di socket e perché viene utilizzato

Un **socket** è l’identificatore di un punto preciso di comunicazione in rete, formato da:

**indirizzo IP + porta logica**

Serve perché un computer può avere più servizi attivi contemporaneamente, quindi non basta l’IP da solo: bisogna anche indicare la porta che identifica il processo giusto.

In pratica il socket permette di distinguere in modo univoco **mittente, destinatario e servizio**.

---

# 3) Caratteristiche delle porte e categorie

Le **porte logiche** servono a distinguere i vari servizi presenti sulla stessa macchina. Una porta occupa **2 byte**, quindi può assumere valori da **0 a 65535**.

Le categorie sono:

- **Well-known ports**: da **0 a 1023**, riservate ai servizi più noti.
    
- **Registered ports**: da **1024 a 49151**, usabili anche dai client.
    
- **Dynamic/Private ports**: da **49152 a 65535**, assegnate dinamicamente ai processi.
    

**Esempio di protocollo con porta associata:**

- **HTTP → porta 80/tcp**
    

---

# 4) Cosa si intende per port address?

✅ **c. Il numero associato ad una porta logica**

---

# 5) Il numero di porta di un socket è specificato utilizzando

Le risposte corrette sono equivalenti:

✅ **b. 16 bit**  
✅ **d. 2 byte**

Se devi segnarne una sola, la forma più “tecnica” è **b. 16 bit**.

---

# 6) Operazioni del paradigma UNIX di I/O su file

✅ **c. open - read/write - close**

---

# 7) Parametri necessari per realizzare la connessione tramite socket

Le risposte corrette sono:

✅ **a. gli indirizzi**  
✅ **c. il tipo di protocollo**  
✅ **d. il protocollo e il numero di porta**

Non sono corretti:

- b. il tipo di sistema operativo
    
- e. il tipo di processore
    
- f. Tutte le precedenti
    

---

# 8) AF_UNIX e AF_INET

**AF_UNIX** è la famiglia di socket usata per la comunicazione **locale** tra processi sulla **stessa macchina Unix**. Non usa indirizzi IP, ma il **percorso nel file system** della risorsa.

**AF_INET** è la famiglia di socket usata per la comunicazione in rete, quindi tra macchine diverse collegate tramite LAN o Internet. È specificata da:

- **indirizzo IP** a **32 bit**
    
- **numero di porta** a **16 bit**
    

---
## 9) Concetto di stream socket e funzionamento client-server

Gli **stream socket** sono socket di tipo **SOCK_STREAM** e sono associati al protocollo **TCP**.

### Caratteristiche

- sono **affidabili**;
- sono **connection-oriented**;
- sono **full-duplex**;
- trasferiscono un flusso continuo di byte.

### Nel paradigma client-server

- il **server** crea il socket, si lega a una porta e si mette in ascolto;
- il **client** si connette al server conoscendo IP e porta;
- il server accetta la connessione con `accept()`;
- dopo l’accettazione si crea un nuovo socket con i dati del client per quella comunicazione;
- client e server si scambiano dati con lettura e scrittura.

Con TCP, dopo il **three-way handshake**, la connessiwone viene gestita in modo puntuale tra client e server.

---

# 10) VERO / FALSO

a. **Sullo stesso host non possono essere in esecuzione più processi.**  
❌ **Falso** — su uno stesso host possono esserci più processi contemporaneamente.

b. **Prende il nome di indirizzo del socket un numero di porta concatenato a un indirizzo MAC.**  
❌ **Falso** — il socket è `<IP, porta>`, non MAC + porta.

c. **I datagram socket sono utilizzati a livello application.**  
✅ **Vero**

d. **Con i datagram socket viene garantito l’ordine di arrivo dei pacchetti.**  
❌ **Falso** — UDP non garantisce l’ordine.

e. **AF_INET è specificato da due valori, indirizzo IP (32 bit) e numero di porta (16 bit).**  
❌ **Falso**

f. **La comunicazione di tipo multicast coinvolge un gruppo di host.**  
✅ **Vero**

g. **Il metodo close(), una volta richiamato, elimina socket.**  
*profe di dice falso
✅ **Vero** — termina l’uso del socket.

h. **La classe Socket, nel linguaggio Java, gestisce socket client e socket server.**  
❌ **Falso** — in Java il server usa `ServerSocket`, mentre `Socket` è usato per il client.

i. **Il metodo bind() collega l’indirizzo di rete dal client a quello del server in ascolto.**  
❌ **Falso** — `bind()` associa un indirizzo/porta a un socket locale.

j. **La porta 1024 può essere utilizzata da un client per collegarsi ad un servizio remoto.**  
✅ **Vero**

---

# 11) Metodo richiamato da un server socket per instaurare una connessione con un client

✅ **a. accept()**

---

# 12) Un client comunica un messaggio al server tramite metodi di quale classe?

✅ **c. DataOutputStream**

Per inviare si usa il flusso di **output**.

---

# 13) Istruzioni Java per istanziare socket client e server

## Lato client

```java
Socket socketCli = new Socket("192.168.15.2", 80);
```

## Lato server

```java
ServerSocket socketSer = new ServerSocket(80);  
Socket socketCli = socketSer.accept();
```

---

# 14) Codice Java del metodo `avvioServer()`

```java
public void avvioServer() {
    try {
        socketSer = new ServerSocket(porta);
        socketCli = socketSer.accept();

        in = new DataInputStream(socketCli.getInputStream());
        out = new DataOutputStream(socketCli.getOutputStream());

    } catch (Exception e) {
        System.err.println("ERR - Server non attivo");
    }
}
```

Se il docente vuole il modello del tuo progetto, si può anche scrivere così:

```java
public void avvioServer() {
    try {
        setSocketSer(new ServerSocket(porta));
        setSocketCli(socketSer.accept());

        setIn(new DataInputStream(socketCli.getInputStream()));
        setOut(new DataOutputStream(socketCli.getOutputStream()));

    } catch (Exception e) {
        System.err.println("ERR - Server non attivo");
    }
}
```

---

# 15) Metodi richiamati dal server per inviare “ciao client” e ricevere la risposta

## Invio del messaggio al client

```java
out.writeBytes("ciao client\n");
```

## Ricezione della risposta

```java
String rispostaCli = in.readLine();
System.out.println("Client: " + rispostaCli);
```

## Sequenza completa

```java
out.writeBytes("ciao client\n");
String rispostaCli = in.readLine();
System.out.println("Client: " + rispostaCli);
```

---
