

Certo: ti lascio una spiegazione unica, ordinata e completa, così puoi studiarla come discorso continuo.

Sul Web l’elaborazione dei dati e la richiesta dei dati non avvengono in un solo nodo, ma in più nodi diversi. Quando un nodo comunica con un altro nodo, bisogna garantire l’univocità di mittente e destinatario nella comunicazione. In un sistema distribuito questo si ottiene tramite l’indirizzo IP pubblico, che identifica in modo univoco una macchina sulla rete. Però una stessa macchina può offrire più servizi contemporaneamente: per esempio una pagina web, una casella di posta, un servizio FTP e così via. Per distinguere questi diversi processi non basta l’IP, ma si usano anche le porte logiche. In pratica, partendo da una sola interfaccia fisica di rete, si creano più porte logiche, ciascuna associata a un servizio diverso.

Una porta logica occupa 2 byte, quindi può assumere valori da 0 a 65535. Questo intervallo si divide in tre categorie: le well-known ports, da 0 a 1023, riservate ai servizi più importanti e standard; le registered ports, da 1024 a 49151, che possono essere usate anche dai client; e le dynamic o private ports, da 49152 a 65535, che sono porte libere e vengono assegnate automaticamente al processo quando serve. Le porte logiche dipendono anche dal protocollo di rete utilizzato, quindi si parla di porte legate a TCP oppure a UDP.

A questo punto entra in gioco il socket. Un socket è una coppia formata da indirizzo IP e porta logica, e serve a identificare in modo preciso un servizio richiesto su una macchina e il relativo servizio di risposta. I socket si dividono in due grandi famiglie: i socket INET e i socket UNIX. I socket INET sono quelli che usiamo noi in rete: sono strutturati con indirizzo IP e numero di porta, e servono per identificare univocamente un servizio su una macchina collegata alla rete. I socket UNIX invece servono per la comunicazione locale tra processi sulla stessa macchina, tipica dei sistemi Unix: in questo caso non si usa l’IP, ma il percorso e il nome della risorsa locale.

Esistono anche tre tipi principali di socket: raw, stream e datagram. I raw socket sono socket più vicini al livello basso della comunicazione. Gli stream socket fanno riferimento al livello 4, quindi al TCP: sono affidabili, asincroni, full-duplex e instaurano una connessione diretta tra i due indirizzi. I datagram socket invece fanno riferimento all’UDP: non instaurano una connessione diretta, funzionano con scambio di datagrammi e sono adatti a comunicazioni uno-a-molti o molti-a-molti. In generale, con TCP si ha una comunicazione unicast, cioè punto-punto; con UDP si può avere multicast o comunque una comunicazione senza connessione stabile.

Dal punto di vista dimensionale, un socket completo occupa 12 byte perché rappresenta due indirizzi IP e due porte. Se invece consideriamo un singolo endpoint, cioè un solo lato della comunicazione, parliamo di 6 byte: 4 byte per l’indirizzo IP IPv4 e 2 byte per la porta. Quindi il valore corretto è che un singolo socket-endpoint occupa 6 byte, mentre la coppia completa di comunicazione tra due estremi arriva a 12 byte.

La comunicazione tramite socket richiama molto la modalità di comunicazione dei file: open, read/write e close. Anche l’uso dei socket segue più o meno la stessa struttura, perché prima si apre o si crea il socket, poi si legge o si scrive, e infine si chiude la comunicazione. Proprio per questo si dice che nasce l’esigenza di utilizzare i socket per standardizzare la comunicazione tra processi diversi.

Facendo un esempio di posta, nei tuoi appunti compare il protocollo SMTP e viene citata la porta 21; però in genere SMTP usa la porta 25, mentre la porta 21 è tipica di FTP. Il concetto da portare a casa è comunque questo: il server ha un indirizzo IP e una porta dedicata, mentre il client non viene identificato solo dall’IP, ma anche da una porta dinamica scelta tra 49152 e 65535. In questo modo la comunicazione risulta precisa e univoca.

Per quanto riguarda gli stream socket, cioè quelli che usano TCP, il funzionamento è questo: sul server si crea il socket con `socket()`, cioè si istanzia uno spazio vuoto che ancora non contiene informazioni. Poi si associa il socket all’indirizzo IP e alla porta con `bind(s)`. A questo punto il server ha un IP e una porta precisi e può mettersi in ascolto con `listen(s)`, ad esempio sulla porta 21 o, più correttamente per SMTP, sulla porta 25. Sul lato client si istanzia il socket e lo si inizializza con i dati del server usando `connect(s)`. Dopo la connessione, il client può inviare il messaggio con `write(x)`.

Quando il client effettua la richiesta sulla porta del server, avviene il three-way handshake del TCP. Dopo il three-way handshake la richiesta può arrivare solo se la porta non è occupata da un altro servizio. Sul server, ogni volta che arriva una richiesta, si usa `accept(s)` e viene creato un nuovo socket, chiamato nei tuoi appunti `new`. Questo nuovo socket gestisce proprio quella singola connessione: in questo modo ogni richiesta del client viene trattata tramite il suo socket dedicato, con una connessione punto-punto tra client e server. A questo punto il server risponde con `write(new)` e il client legge con `read(x)`. Infine il server chiude il socket della connessione con `close(new)`. È fondamentale fare `close` sul socket `new` e non sul socket principale `s`, perché `s` è quello che resta in ascolto: se chiudessimo `s`, il servizio non funzionerebbe più. Il socket `new` è quello creato dinamicamente per la singola comunicazione e permette di gestire in modo separato ogni client.

Con UDP, invece, la logica cambia. Siccome non si instaura una connessione diretta, dopo `bind` sia sul server sia sul client non c’è `connect`. Al posto di `write` e `read` si usano `sendto()` e `recvfrom()`. Nel server si usa `recvfrom()` per ricevere i dati e, proprio perché il server deve restare sempre disponibile, in genere non si chiude mai il servizio: il server resta in ascolto costante e non deve interrompere la propria disponibilità.

Se guardiamo la traduzione nel codice, in Java la classe usata per il client è `Socket`, mentre per il server si usa `ServerSocket`. Servono poi anche due flussi, uno di input e uno di output, cioè `DataInputStream in` e `DataOutputStream out`. Nel costruttore viene impostata solo la porta, che deve essere una porta non well-known, quindi una porta casuale o comunque libera: nei tuoi appunti hai messo 3200. L’indirizzo IP spesso è `localhost` quando si lavora in locale, quindi non si usa ancora una rete esterna. La parte davvero operativa avviene poi nel blocco `try-catch`, dove si crea la connessione e si gestiscono eventuali errori.

Nel client avviene la stessa logica: si creano le entità, si imposta la stessa porta del server e si prova la connessione. Quando il client si avvia, tenta di connettersi al server; se la connessione va a buon fine, allora i messaggi possono essere scambiati e il server gestisce il contenuto ricevuto. Bisogna anche fare attenzione alla porta usata: se, per esempio, MySQL sta già occupando una certa porta e noi proviamo a usare la stessa, la comunicazione non può avvenire perché la porta è già occupata da un altro servizio. Proprio per questo l’univocità della porta è fondamentale.

Quindi, in sintesi, i socket servono a identificare in modo preciso una comunicazione tra processi, combinando indirizzo IP e porta logica. Con TCP si usa lo stream socket, che crea una connessione affidabile punto-punto tramite `socket()`, `bind()`, `listen()`, `connect()`, `accept()`, `read()`, `write()` e `close()`. Con UDP si usa il datagram socket, senza connessione diretta, con `sendto()` e `recvfrom()`. I socket INET lavorano in rete con IP e porte, mentre i socket UNIX servono per la comunicazione locale tra processi sulla stessa macchina.

Se vuoi, nel messaggio dopo posso trasformare tutto questo anche in una versione ancora più “da interrogazione”, cioè pronta da dire a voce in 2 minuti.







# LIBRO


Certo — te la riscrivo in modo **molto ordinato**, con **paragrafi e titoletti**, così puoi studiarla bene e ripeterla all’interrogazione.

---

## I socket e i protocolli per la comunicazione

### Generalità

Le applicazioni di rete sono composte da programmi che vengono eseguiti su due o più computer contemporaneamente e che interagiscono tra loro attraverso la rete. Per questo motivo si parla anche di **applicazioni distribuite**, cioè applicazioni che non girano su un solo elaboratore ma su più macchine collegate tra loro. I processi che fanno parte della stessa applicazione devono scambiarsi messaggi, anche se si trovano nella stessa rete locale oppure in punti molto lontani del mondo.

Per poter comunicare, questi processi devono usare indirizzi e regole comuni. Proprio qui entra in gioco il concetto di **protocollo di comunicazione**, cioè l’insieme di regole che due interlocutori devono seguire per capirsi. In una rete di calcolatori il protocollo non riguarda solo gli aspetti logici, ma anche quelli fisici, come il mezzo trasmissivo, la segnalazione e la codifica dei dati.

---

### Il modello a strati della comunicazione

La comunicazione in rete è organizzata secondo una gerarchia di livelli, dove ogni livello si appoggia ai servizi del livello inferiore per offrire un servizio più completo a quello superiore. Nella pila TCP/IP ci sono **cinque livelli**:

- livello **Applicazione**, dove si gestisce il **messaggio**;
    
- livello **Trasporto**, dove si gestisce il **segmento**;
    
- livello **Rete**, dove si gestisce il **datagram**;
    
- livello **Collegamento**, dove si gestisce il **frame**;
    
- livello **Fisico**, dove non si ha un vero dato ma solo un **segnale fisico**.
    

Ogni passaggio aggiunge le informazioni necessarie per far funzionare correttamente la comunicazione. La pila TCP/IP è diversa dalla pila ISO/OSI, che invece ha sette livelli.

---

### TCP e UDP

Lo strato di trasporto mette a disposizione due protocolli fondamentali: **TCP** e **UDP**.

Il **TCP (Transmission Control Protocol)** è un protocollo **connection-oriented**, cioè orientato alla connessione. È affidabile perché controlla l’integrità dei dati trasmessi e usa il meccanismo di acknowledge per segnalare al mittente che il pacchetto è arrivato correttamente.

L’**UDP (User Datagram Protocol)** è invece **connectionless**, cioè senza connessione. Non garantisce affidabilità come il TCP, ma è più semplice e veloce.

Entrambi utilizzano **IP** a livello di rete, quindi il nome completo del sistema di comunicazione viene spesso indicato come **TCP/IP**.

---

## Le porte di comunicazione

### Perché servono le porte

Affinché un processo su un host invii un messaggio a un altro processo su un altro host, deve poter identificare in modo univoco il destinatario. Siccome un computer ha in genere una sola porta fisica di collegamento alla rete, ma può eseguire più applicazioni contemporaneamente, serve un sistema per distinguere i vari servizi.

Questo sistema è dato dalle **porte logiche**, identificate da un numero detto **port address** o semplicemente **port**. Grazie alle porte, più comunicazioni possono avvenire contemporaneamente sulla stessa macchina senza confondersi.

---

### Intervallo delle porte

Il numero di porta è memorizzato su **2 byte**, quindi va da **0 a 65535**. Le porte si dividono in tre gruppi:

#### Well-known ports

Vanno da **0 a 1023** e sono riservate a servizi particolari come HTTP, FTP, DNS, Telnet e altri. Sono porte usate dai server in apertura passiva.

#### Registered ports

Vanno da **1024 a 49151**. Sono porte registrate e possono essere usate da alcuni servizi; inoltre sono disponibili anche per i client, che normalmente usano porte a partire da 1024 quando si collegano a un sistema remoto.

#### Dynamic e Private ports

Vanno da **49152 a 65535**. Sono porte libere, assegnate dinamicamente dai processi applicativi.

---

### Esempi di porte note

Alcuni esempi di associazione tra porta e servizio sono:

- **7** → ECHO
    
- **21/tcp** → FTP
    
- **22/tcp** → SSH
    
- **23/tcp** → TELNET
    
- **25/tcp** → SMTP
    
- **53** → DNS
    
- **80/tcp** → HTTP
    
- **110/tcp** → POP3
    
- **143/tcp** → IMAP
    
- **161** → SNMP
    
- **443/tcp** → HTTPS
    

È importante ricordare che il numero di porta è relativo anche al protocollo: una certa porta TCP non è la stessa cosa della stessa porta in UDP, perché i protocolli sono distinti.

---

## Il concetto di socket

### Definizione

Un **socket** è formato dalla coppia:

ed è quindi un identificatore univoco di un punto di accesso alla rete. In pratica, il socket rappresenta il punto attraverso cui un processo invia o riceve dati.

Un processo che vuole comunicare manda i dati attraverso il proprio socket, sapendo che la rete li trasporterà fino al socket del destinatario.

---

### Perché il solo numero di porta non basta

Il numero di porta da solo non è sufficiente per identificare univocamente una connessione, perché più host diversi possono usare la stessa porta. Quindi per riconoscere in modo preciso un servizio bisogna combinare:

- l’**indirizzo IP**, che identifica il nodo;
    
- la **porta logica**, che identifica il processo all’interno di quel nodo.
    

Questa combinazione rende il servizio individuabile in modo univoco.

---

### Esempio di più servizi su uno stesso server

Un server può offrire più servizi contemporaneamente:

- il servizio **e-mail**, che usa SMTP e quindi la porta TCP 25;
    
- il servizio **web**, che usa HTTP e quindi la porta TCP 80;
    
- la risoluzione dei nomi, che usa DNS e quindi la porta UDP 53.
    

Se un client vuole richiedere uno di questi servizi, deve specificare non solo l’indirizzo dell’host, ma anche la porta corretta.

---

### Esempi di socket

Un esempio di socket può essere:

- **<137.204.10.85:3300>**
    
- **<137.204.10.85:3301>**
    
- **<137.204.56.10:3301>**
    
- **<137.204.57.85:80>**
    

Due applicazioni sullo stesso host possono avere lo stesso indirizzo IP, ma restano distinte perché hanno porte diverse.

---

## Applicazione di rete e user agent

### Struttura dell’applicazione

Un’applicazione di rete può essere vista come composta da due parti:

1. una **user agent**, che fa da interfaccia tra l’utente e gli aspetti comunicativi;
    
2. l’**implementazione dei protocolli**, che permette all’applicazione di integrarsi con la rete.
    

Nel caso di un browser web, per esempio, la user agent è l’interfaccia che mostra i documenti e permette la navigazione, mentre il motore del browser si occupa di inviare le richieste ai server e ricevere le risposte.

---

## L’association

### Cos’è

Per identificare in modo univoco una connessione esiste una struttura chiamata **association**, che contiene:

- indirizzo IP locale;
    
- protocollo usato;
    
- porta locale;
    
- indirizzo IP remoto;
    
- porta remota.
    

Per esempio, un’association può essere:

**TCP, 192.168.1.2, 1500, 192.168.1.14, 21**

dove TCP è il protocollo, 192.168.1.2 è l’IP del mittente, 1500 è la porta locale, 192.168.1.14 è l’IP del destinatario e 21 è la sua porta.

---

## Il modello client-server

### Come funziona

Nel modello client-server ci sono due moduli distinti:

- il **server**, che realizza il servizio;
    
- il **client**, che acquisisce i dati, li elabora e li invia al server per richiedere il servizio.
    

I server restano in ascolto e attendono le richieste di connessione da parte dei client.

---

### Cosa deve conoscere il client

Il client deve conoscere:

- l’indirizzo IP del server;
    
- il numero di porta usato dal server.
    

Il client usa invece una porta libera, scelta tra quelle disponibili, per esempio una porta dinamica come 52300. Questa porta viene poi trasmessa nella richiesta, così il server potrà inviare la risposta correttamente.

---

### Più client sullo stesso server

Più client possono collegarsi contemporaneamente allo stesso server, anche utilizzando porte diverse o perfino la stessa porta logica in combinazione con IP diversi. Non c’è ambiguità perché il collegamento è identificato dalla coppia di socket.

---

### Esempi

Un client può connettersi a un server SMTP remoto usando la porta 25.  
Due client possono accedere alla stessa porta di un server HTTP, per esempio la porta 80, ma non si crea confusione perché ciascuna comunicazione ha una coppia di socket diversa.

---

### Regola importante

Quando un client apre un socket, non dovrebbe usare una porta nota, perché le porte note sono riservate ai servizi dei server.

---

# La connessione tramite socket

## Generalità

Il concetto di socket nasce come estensione del paradigma UNIX di I/O su file, basato sulla sequenza:

- **open**
    
- **read/write**
    
- **close**
    

L’uso dei socket segue una struttura molto simile, ma aggiunge i parametri necessari per la comunicazione tra macchine remote, cioè:

- indirizzi;
    
- protocollo;
    
- numero di porta;
    
- tipo di protocollo.
    

Le socket API, nate in ambiente BSD UNIX, oggi sono disponibili in vari sistemi operativi come Windows, Linux e Solaris.

---

## Le primitive principali

Le principali funzioni usate nella comunicazione tramite socket sono:

- `socket()` / `serversocket()` → crea un nuovo socket;
    
- `close()` → termina l’uso del socket;
    
- `bind()` → collega un indirizzo di rete a un socket;
    
- `listen()` → mette in attesa di messaggi in ingresso;
    
- `accept()` → accetta una connessione in ingresso;
    
- `connect()` → crea una connessione con un host remoto;
    
- `send()` / `write()` → invia dati;
    
- `recv()` / `read()` → riceve dati.
    

---

## Famiglie di socket

### AF_INET

La famiglia **AF_INET** è quella che si usa per la comunicazione in rete. Permette il trasferimento di dati tra processi su macchine remote collegate tramite LAN o Internet.

In questa famiglia l’indirizzo è composto da:

- **indirizzo IP** a 32 bit;
    
- **numero di porta** a 16 bit.
    

---

### AF_UNIX

La famiglia **AF_UNIX** serve invece per la comunicazione tra processi sulla stessa macchina UNIX. In questo caso l’indirizzo è praticamente il pathname del file system.

La differenza principale è quindi questa:

- **AF_UNIX** usa un percorso locale;
    
- **AF_INET** usa IP e porta.
    

---

## Tipi di socket

I socket si dividono fondamentalmente in tre tipi:

- **stream socket**
    
- **datagram socket**
    
- **raw socket**
    

Gli stream e i datagram socket sono quelli usati a livello applicativo; i raw socket servono invece per lo sviluppo di protocolli e non sono il centro di questa trattazione.

---

## Stream socket

### Caratteristiche

Gli **stream socket** (`SOCK_STREAM`) realizzano una connessione sequenziale, tipicamente asimmetrica, affidabile e full-duplex, basata su flussi di byte di lunghezza variabile.

Questo tipo di socket è basato su **TCP**.

---

### Come funzionano

Ogni processo crea il proprio endpoint richiamando `socket()` in C oppure creando l’oggetto socket in Java.

Poi:

- il **server** si mette in ascolto;
    
- quando arriva una richiesta, la accetta con `accept()`;
    
- `accept()` crea un nuovo socket dedicato alla connessione;
    
- il **client** si collega al socket del server;
    
- durante la connessione si realizza implicitamente il binding con la porta locale.
    

---

### Server e client nei socket stream

Nel server TCP esistono due tipi di socket:

- un socket per accettare connessioni, chiamato **connection socket**;
    
- un socket per inviare e ricevere dati, chiamato **data socket**.
    

Il server ha quindi un controllo maggiore, perché è lui che crea il socket iniziale. Più client possono comunicare con lo stesso server, ma solo un server può essere associato a quello specifico socket di ascolto.

Il client, invece, deve conoscere l’indirizzo del server; il server scopre le informazioni del client solo dopo che la connessione è stata stabilita.

---

### Schema logico della comunicazione TCP

In forma logica, la sequenza è questa:

1. il server crea il socket con `socket()`;
    
2. associa indirizzo e porta con `bind()`;
    
3. si mette in ascolto con `listen()`;
    
4. il client crea il socket con `socket()`;
    
5. il client si collega con `connect()`;
    
6. avviene il **three-way handshake**;
    
7. il server accetta la connessione con `accept()`;
    
8. si crea un nuovo socket dedicato alla comunicazione;
    
9. client e server si scambiano dati con `read()` e `write()`;
    
10. la comunicazione termina con `close()`.
    

---

### Java e TCP

In Java i due socket vengono distinti chiaramente:

- `ServerSocket(int port)` → crea il connection socket per accettare connessioni;
    
- `Socket(InetAddress address, int port)` → crea il data socket, cioè il socket di comunicazione vero e proprio.
    

---

## Datagram socket

### Caratteristiche

I **datagram socket** (`SOCK_DGRAM`) realizzano una comunicazione **senza connessione**. I messaggi contengono sia l’indirizzo di destinazione sia quello di provenienza.

Questa comunicazione avviene tramite datagrammi, che possono avere dimensione variabile, ma non garantiscono:

- l’ordine dei pacchetti;
    
- l’arrivo sicuro di tutti i pacchetti.
    

Per questo la comunicazione è considerata **inaffidabile**.

Questo tipo di socket è supportato nel dominio Internet dal protocollo **UDP**.

---

### Come funzionano

Con i datagram socket si può:

- inviare da un socket a più destinazioni;
    
- ricevere su un socket da più sorgenti.
    

Per questo si parla spesso di comunicazione **molti-a-molti**.

Operativamente:

- il server si mette in attesa con `receive()` in Java o `recvfrom()` in C;
    
- quando riceve i dati, può rispondere con `send()` in Java o `sendto()` in C;
    
- il client invia con le stesse primitive e può attendere una risposta con le stesse funzioni.
    

Alla fine il socket viene chiuso.

---

### Un vantaggio dell’UDP

Il vantaggio principale è la velocità. Inoltre, nelle comunicazioni UDP le funzioni usate dai vari processi sono sostanzialmente le stesse: non c’è una distinzione rigida tra client e server come nel TCP. È solo l’ordine delle operazioni a stabilire quale processo svolge il ruolo di client e quale quello di server.

---

## Conclusione

I socket sono il meccanismo fondamentale con cui i processi comunicano in rete. La comunicazione avviene combinando **indirizzo IP**, **porta logica** e **protocollo**. I socket possono essere di tipo **stream**, se usano TCP e instaurano una connessione affidabile, oppure di tipo **datagram**, se usano UDP e non richiedono connessione. Esistono inoltre socket **INET**, per la rete, e socket **UNIX**, per la comunicazione locale.

Se vuoi, nel messaggio successivo posso anche trasformare tutto questo in una **versione ancora più da interrogazione**, con frasi più naturali e facili da memorizzare.

---


sul web la parte di elaborazione dei dati e di richiesta dei dati non confluisce in un solo nodo ma in piu nodi, quaanndo un nodo comunica e contatta un altro nodo, dobbiamo garantire l'univocita di mittente e destinatario in una comunicazione, per farlo in un sistema distribuito, lo si fa tramite un indirizzo ip pubblico. ognuno di questi processi potrebbe effettuare una richiesta differente ad esempio una pagina mail e una pagina web , si utilizzano le porte per differenziarlo. basandoci su una porta fisica andiamo a creare diverse porte logiche
una porta logica occuopa 2 byte, puo assumere ragnge dui valori che andiamo a dividere in 3 categorie:
- well known ports(0-1023)
- registered ports(1024-49151) porte possono essere utilizzate anche dai client
- dynamic and private ports(49152-65535)(porte libere che il nostro processo in automatico gestisce)
le porte logiche dipendono dal protocollo di rete utilizzato (TCP, UDP).le differenze 

un socket è una coppia formata da indirizzo ip e porta logica specifica per il servizio. i socjket si dividono in 2 grandi famiglie( INET=quelli che utilizziamo noi,strutturato da indirizzi ip e numeri di porte,servono per identificare univocamente un servizio richiesto su una macchina  e il servizio di risposta UNIX=i socket unix sono usate dalle macchine unix in locale, su una macchina posso avere piu servizi in locale senza andare su internet e lo si fa tramite il percorso e il nome della risorsa) possiamo avere 3 tipo di socket(raw, stream=fanno riferimento e vengono utilizzati quando utilizziamo a livello 4 quindi TCP , asimmetrica ffidabile  e full-duplex vine instaurata una connessione diretta fra i 2 indirizzi. servizio mittente e servizio destinatario crea il suo socket , una volta che lo hanno creato il server soi mette in ascolto in attesa di un collegamento arriva la richiesta viene creato il nuovo socket il client si mette in cod e quando viene acce,datagram)
un socket intero occupa 12 byte 2 indirizzi ip e 2 porte

la  modalita di comunicazione utilizzata con socket fa riferimento alla modalita di comunicazione dei file: open, read/write, close.
l'utilizzo dei socket avviene pressoche con la stessa struttura

pag 150 circa circa fino a fine capitolo
nasce l'esigenza di utilizzare i socket

richiesta di posta protocollo SMTP (protocollo posta) porta 21, server avrà un indirizzo ip , il client dovra essere identificato non solo da ip ma anche da una certa porta 49152 a 65535.
un socket singolo abbiamo detto che occupa 6 byte.

stream socket

unix comunicazione tra piu processi
noi facciamo inet

# STREAM SOCKET (USA TCP)

s= socket() , istanzia uno spazio che non contiene nulla, bind associa le informazioni riferite all'ip e alla porta, con bind(s)
a questo punto il server ha un ip e una porta e si puo mettere in ascolto con listen(s)ad esempio sulla porta 21

il client invece istanzia il socket e per inizializzarlo comn i dati usa connect(s)

per mandare il messaggio fai write(x)

una volta effettuata la richiesta sulla porta 21 da qua avviene il 3 -way handshake
dopo il 3 wway hanshake , la richiesta arriva solo se la porta non è occupata 

con new=accept(s) ogni volta che c'è una richiesta viene creato un nuovo socket cosi se la richiesta del client arriva essa verra gestita proprio attraverso quel socket con connessioni punto punto tra client e server.

cioe che viene risposto dal server con write(new) viene letto dal client con read(x)
poi il server chiude il sochet (close di new) è importantr il fatto che queste  operazion vengano effettuate su new perche ovviamente non si puo fare close di s(socket) altrimenti il servizio FTP non funzionerebbe più
new è quello generato dinamicamente e che genera dinamicamente le porte del server.
 

sappiamo che col tcp si instaura una connessione unicast(punto punto), invece UDP multicast uno molti o molti molti, i socket che usano questo tipo di comunicazione so i datagram socket, non viene instaurata una connessione diretta
i comandi dopo bind effettuato in questo cso sia su server che su client, essendo che non nessun tipo di connessione non c'è connect nel server c'è sendto() recvfrom() e poi close 
invece il server recvfrom() (recieve from), e poi la connessione non viene mai chiusa , perché il server è sempre in ascolto non chiuda mai il servizio.

dal punto di vista del codice come trasformiamo:

classe cbhe vinee usata per istanziare un socket clientr è socket
invece server è serverSocket, poi servono anche i 2 flussi , di input e output le cui classi sono DataInputStream in;
DataOutputStream out;
e poi lo stream ha bisogno della porta private int, ci sarebbe anche l'ip ma utilizziamo il locahost essendo che per ora è in locale.
nel costruttore viene settato solo la porta che è una porta non well know ma una casuale io homesso 3200 , poi c'è la parte che realmente lavora nel try catch,

passando al client tutto lo stesso crazione di entita e la porta che settiamo è la stessa del server
Avvio del client: provo a connettermi al server: avvenuta la connessione
si possono mandare i messaggi e la gestione che avviene nel server è che il messaggio viene 

si deve anche stare attenti alla porta che si usa ad esempio se attiviamo my sql e utilizziamo la stessa porta che utilizza lui allora la comunicazione non puo avvenire perché la porta è gia occupata da MySQL.
studia da pag 163 a pag 174

