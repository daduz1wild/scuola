

ARP, MAC, IP e comunicazioni di rete
Nella tabella ARP si vedono gli indirizzi delle macchine con cui il PC ha comunicato. Se il PC non ha comunicato con nessuno, la tabella è vuota.
ARP salva le associazioni tra indirizzi IP e indirizzi MAC.

ARP: cos’è e a cosa serve
ARP (Address Resolution Protocol) serve a mappare un indirizzo IP con il relativo indirizzo fisico MAC dell’host.
Lavora tra livello 2 e livello 3 (Data Link / Network).
La tabella ARP contiene coppie del tipo IP → MAC.
Per visualizzarla si usa il comando “arp -a”.
La tabella ARP è vuota finché non avvengono comunicazioni.
Le associazioni ARP vengono cancellate automaticamente dopo circa 5 minuti.

Funzionamento di ARP

1. Un host vuole inviare dati a un indirizzo IP che non conosce a livello MAC.
2. Invia un messaggio ARP in broadcast sulla rete locale.
3. Tutti gli host lo ricevono; solo quello con l’IP richiesto risponde inviando il proprio MAC (ARP Reply).
4. Lo switch utilizza la tabella CAM per associare ogni MAC alla porta fisica.
5. L’host che ha fatto la richiesta salva la coppia IP/MAC nella propria tabella ARP.

Nota: ARP trova il MAC partendo dall’IP, non può fare il contrario.

---

Switch, Hub, CSMA/CD e collisioni

Hub
Un hub lavora a livello 1 (Fisico). Non usa né IP né MAC.
Tutto ciò che riceve su una porta viene replicato in broadcast su tutte le altre.
Tutti gli host collegati a un hub condividono lo stesso dominio di collisione.
È necessario l’uso del protocollo CSMA/CD per gestire le collisioni.

CSMA/CD
Usato nelle reti Ethernet con hub.
Se due host trasmettono contemporaneamente avviene una collisione.
Gli host inviano un jamming signal per informare la rete della collisione.
Il tempo minimo per rilevare una collisione dipende dalla lunghezza della rete (circa 104 ms).
Dopo la collisione, ogni host aspetta un tempo casuale e poi ritenta la trasmissione.

Switch
Uno switch lavora a livello 2.
Ogni porta è un dominio di collisione separato, quindi non avvengono collisioni.
Inoltra i frame solo sulla porta corretta, usando la tabella CAM (MAC → porta).
Lo switch rende la rete più efficiente rispetto all’hub.

Con uno switch non serve CSMA/CD perché non esiste un mezzo condiviso dove possono verificarsi collisioni.

---

Porte, socket e protocolli

Numero massimo di porte
Le porte sono identificate da un numero a 16 bit.
2^16 = 65536 porte totali, numerate da 0 a 65535.

Tipi di porte
0–1023: porte “well known”, usate da servizi come HTTP (80), HTTPS (443), SSH (22), SMTP (25), DNS (53), DHCP (67–68).
Le porte sono virtuali e vengono gestite dal sistema operativo.

Socket
Un socket identifica un canale di comunicazione ed è composto da:
IP sorgente + porta sorgente + IP destinazione + porta destinazione.
Serve a creare una connessione logica tra due processi che comunicano.

---

Protocolli e livelli
UDP/TCP: livello 4 (Trasporto)
DHCP: livello 7 (Applicazione)
DNS: livello 7
ARP: livello 2/3
CSMA/CD: livello 2
HTTP/HTTPS: livello 7
SSH, SMTP, POP3: livello 7

---

Hub e dominio di collisione
Con un hub si ha un unico canale condiviso.
Per questo motivo serve CSMA/CD e tutto avviene in broadcast.

---

Browser
Il browser lavora a livello 7 (Applicazione).
È composto da una parte client (sul PC dell’utente) e una parte server (web server che risponde alle richieste).
