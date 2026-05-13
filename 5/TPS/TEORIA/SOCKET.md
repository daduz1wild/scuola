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

pagina 108