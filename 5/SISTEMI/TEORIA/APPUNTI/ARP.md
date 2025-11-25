ha sostituito il MAC  del server con d

host invia in broadcast messaggio per trovare lo switch e poi lo switch tramite la  tabella ARP ricava l'indirizzo ip e poi invia il mesaggio
 arp ci da la corrispondenza tra MAC e IP, 
porte livello udp stp ssh smtp pop3 http https, sp dhcp dns arp
per vedere la tabella arp si fa arp -a

nella tabella arp si vede anche gli indirizzi di tutte le macchine con cui il proprio pc ha comunicato
la tabella è vuota e il pc non ha comunicato con altri
arp asalva MAC address

arp= mappare indirirzzo IP con indirizzo fisico(MAC) di un host
arp lavoro a livello 3
 //NOME VIDEO PROTOCOLLO ARP in 2 minuti

ogni 5 minuti la tabella arp viene cancellata( perche le comunicazioni sono state).

dhcp livello 7
dns livello 7perche oltre a lavorare con ip lavora anche con stringhe
CSMA lavora a livello 2

hub lavorando a livello fisico non lavora con indirizzo ip

PP point to point

con hub abbiamo piu macchine e un unico canale quindi dobbiamo usare  protocollo CSMA, le comunicaszioni saranno in broadcast

segnale di jamming= segnale di ingorgo avvisa tutti gli altri host della comunicazione che è avvenuta una comunicazione, per questo non vanno a comunicare gli altri

104 millisecondi collisione.
switch lavora a livello 2 ed è un grado di inviare il segnale solo sulla porta a cui è collegato il destinatario
tute le macchine connesse ad un hub fanno parte dello stesso dominio

CSMA CD non serve con switch perche so su che porta inviare i messaggi


Gli switch sono caratterizzati dalla presenza di una memoria interna nota come CAM (Content Addressable Memory), in cui vengono memorizzate le coppie indirizzo MAC sorgente/porta su cui è stato ricevuto un frame. Questa memoria permette allo switch di inoltrare i frame solo sulla porta corretta, riducendo il rischio di collisioni e garantendo un dominio di collisione dedicato per ciascuna porta.

perchè il massimo di porte è 2 alla 16?  well known port prime mille porte
porte sono virtuali, il sistema operativo le utlizza per comunicare.
unico cavo che lavora su porte diverse virtuali 67/68 dhcp

socket: permette di virtualizzare la comunicazione, identifica canale univoco trasmissione

il browser lavora a livello 7 e composto da applicazione client e quella server


