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

