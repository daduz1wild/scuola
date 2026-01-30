° INDIRIZZI IP CLASSI E SUBNETTING
L'indirizzamento IP permette di identificare ogni host all'interno di una rete TCP/IP. Grazie all'utiòizzo delle classi di indirizzi ed  al subnetting è possibile organizzare e gestire in modo piu efficiente il proprio network.
Un indirizzo ip chiamato anche indirizzo logico, rappresenta un identificativo software per le interfacce di rete, esso viene utilizzato in combinazione con l'iindirizzo fisico (MAC), il quale consente di dterminare in modo univoco formato da 6 numeri ogni numero due valori esadecimali essendo che ogni numero occupa 8 bit che è 1 byte hogni interfaccia di un dispositivo di rete, un ip address è un numero di 32 bit bit suddiviso in quattro gruppi da 8 bit ciascuno la forma con la quale viene solitasmente, essendo ogni numero rappresentato da 8 bit, può assumere un range 
metwork broadcast e loopback non possono essere usati come indirizzo di un host.
NETWORK= quando i bit dell'ottetto che rappresenyta l'host hanno tutti valore 0 l'indirizzo è detto di rete
BROADCAST tutti i bit dell'host sono posti a uno equivale a mandare un pacchetto a tutti gli host della rete 
broadcast e loopback inoltra messaggio a chiunque
loopback è utilizzato per funzioni del protocollo TCP/IP, non genera traffico di rete e corrsiponde all'indrizzo 127.0.0.1
broadcast di rete manda a tutti elementi della rete
loopback (127.0.0.1) non è un indirizzo IP di nessuna rete infatti è loopback per tutti.
permette di ottenere 126 reti 
ogni rete ha dei certi bit che sono fissi a 1 per cui nel calcolo delle reti disponibili per una certa classe facciamo 2**(numero di bit variabili).
Per determinare se il destinatario dei propri pacchetti e nella stessa rete si fa ANDING.

il subnetting di una rete comporta diversi vantaggi :
minor spreco di indirizzi= in quanto è possibile scegliere il numero di host che faranno parte della sottorete
riduzione del traffico di rete= in quanto si riduce il dominio di broadcast(broadcast domain)
miglioramento delle performance della rete=in conseguenza della riduzione del traffico

se mando un pacchetto in broadcast il messaggio arriva a tutti i dispositivi della rete, quindi broadcast domain è la rete

utilizzo della classe di rete corrispondente a quella che si avvicina di più a quella che si vuole gestire a volte non è sufficiente , puo essere necessario dover suddividere la rete in ulteriori sottoreti, usiamo la tecnica del subnetting.

jl subnetting consiste nell'utilizzare alcuni bit "presi in prestito" (borrowed) dalla parte host dell'indirizzoo di rete, è possiobile pòrocedere alla suddivisione della rete ij sottoreti più piccole tramite lo shcema seguente determinando:
- il numero di sottoreti necessarie
- il numero di host per ogni sottorete
- le subnet valide
- indirizzi di network e broadcast delle subnet
- gli host validi

1. dterminare il numero di sottoreti necesarie:è necessario tenere presente che il numero subnet che si pòossono creare è dato da 2**x dove x è rappresentato dai bit presi in prestito dalla parte host dell'indirizzo

Es. prendendo in prestito 4 bit da un indirizzo di classe B, sarà possibile creare 16 sottoreti
non ho capito come si fa a vedere se 2 indirizzi ip sono della stessa rete nel caso in cui si usa il subnetting tramite l'anding

numero di host per ogni sottorete->determinare subnet valide 256(256 -> tutti possibili indirizzi generabili 2**x valore della subnet)
2. determinare il numero di host per ogni sottorete
questo valore è dato da 2**y-2 dove y è il valore delle...

3. determinar le subnet valide:
serve il valore della subnet mask quindi 256-broadcast
per avere una subnet da 2 alla 24 l'indirizzo ip


esercizi
1. indirizzo classe B pubblico, che scegliamo noi, numero del resitro * 2 quindi = 4 e secondo numero registro*10=20. fai 7 sottoreti