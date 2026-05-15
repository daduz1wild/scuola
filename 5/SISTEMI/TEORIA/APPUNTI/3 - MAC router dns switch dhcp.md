Perfetto, continuiamo con **MAC address, router, switch, DNS e DHCP**. Sono concetti molto collegati tra loro e servono per capire come un dispositivo viene riconosciuto e come ottiene i dati di rete.

---

## 4) MAC address

### COS’È

Il **MAC address** è l’indirizzo fisico della scheda di rete di un dispositivo.  
È un codice assegnato all’interfaccia di rete, per esempio alla scheda Wi-Fi o Ethernet.

### A COSA SERVE

Serve per riconoscere un dispositivo **dentro la rete locale**.  
È usato soprattutto nella comunicazione a livello di rete locale, prima ancora dell’IP.

### COME FUNZIONA

Quando un dispositivo deve inviare dati nella LAN, usa anche il MAC address per raggiungere il destinatario corretto.  
L’IP serve per capire **chi** è il destinatario dal punto di vista logico, mentre il MAC serve per consegnare i dati al dispositivo giusto nella rete locale.

Di solito il MAC è scritto così:  
`00:1A:2B:3C:4D:5E`

### ESEMPIO

Il computer vuole mandare un pacchetto alla stampante nella stessa rete.  
Prima identifica l’IP della stampante, poi usa il MAC per consegnare materialmente il dato sulla rete locale.

### DIFFERENZE IMPORTANTI

Da non confondere con l’IP:

- **IP** = indirizzo logico, può cambiare
    
- **MAC** = indirizzo fisico, legato alla scheda di rete
    

### RIASSUNTO FINALE

Il MAC address identifica in modo fisico una scheda di rete.  
Serve soprattutto nella comunicazione locale.  
Non sostituisce l’IP: lo affianca.

---

## 5) Router

### COS’È

Il **router** è un dispositivo che collega reti diverse e decide dove inoltrare i pacchetti.

### A COSA SERVE

Serve per far comunicare reti separate, per esempio la rete di casa con Internet.

### COME FUNZIONA

Il router riceve un pacchetto e legge l’indirizzo di destinazione.  
Poi decide su quale strada inviarlo, cioè lo **instrada** verso la rete corretta.

In una rete domestica, il router:

- collega i dispositivi di casa a Internet
    
- spesso fa anche da gateway
    
- può assegnare indirizzi IP, se ha il servizio DHCP attivo
    

### ESEMPIO

Quando apri un sito web, il tuo PC manda i dati al router.  
Il router li inoltra verso la rete del provider e poi verso il server del sito.

### DIFFERENZE IMPORTANTI

Non è lo stesso dello switch:

- **Router** = collega reti diverse
    
- **Switch** = collega dispositivi nella stessa rete
    

### RIASSUNTO FINALE

Il router instrada i pacchetti tra reti diverse.  
È il dispositivo che permette di uscire dalla LAN e raggiungere Internet.  
Nelle reti domestiche svolge spesso anche il ruolo di gateway.

---

## 6) Switch

### COS’È

Lo **switch** è un dispositivo che collega più dispositivi nella stessa rete locale.

### A COSA SERVE

Serve a far comunicare computer, stampanti, server e altri dispositivi all’interno della LAN.

### COME FUNZIONA

Lo switch riceve un dato su una porta e lo inoltra solo verso la porta giusta, non verso tutti.  
Per fare questo usa soprattutto i **MAC address** dei dispositivi collegati.

Questo lo rende più efficiente di un dispositivo più semplice che trasmette tutto a tutti.

### ESEMPIO

In un laboratorio scolastico, tutti i PC sono collegati allo switch.  
Se un PC invia dati a un altro PC della stessa rete, lo switch li manda solo al destinatario corretto.

### DIFFERENZE IMPORTANTI

Da non confondere con il router:

- **Switch** = rete locale, usa MAC address
    
- **Router** = collega reti diverse, usa IP per instradare
    

### RIASSUNTO FINALE

Lo switch collega dispositivi nella stessa LAN.  
Smista i dati verso la porta corretta.  
È fondamentale nelle reti locali perché rende la comunicazione ordinata ed efficiente.

---

## 7) DNS

### COS’È

Il **DNS** è il servizio che traduce i nomi dei siti in indirizzi IP.

### A COSA SERVE

Serve perché noi ricordiamo facilmente nomi come `google.com`, ma il computer ha bisogno dell’IP per raggiungere il server.

### COME FUNZIONA

Quando scrivi un indirizzo web nel browser, il dispositivo chiede al DNS quale IP corrisponde a quel nome.  
Il DNS risponde con l’indirizzo corretto, e il browser può contattare il server.

Mini schema:

`nome del sito → DNS → indirizzo IP`

### ESEMPIO

Scrivi `www.esempio.it` nel browser.  
Il DNS traduce il nome in un IP tipo `93.184.216.34`, e il PC si collega a quel server.

### DIFFERENZE IMPORTANTI

Non va confuso con il gateway:

- **DNS** = traduce nomi in IP
    
- **Gateway** = porta di uscita verso altre reti
    

### RIASSUNTO FINALE

Il DNS serve a trasformare i nomi dei siti negli indirizzi IP.  
È essenziale per navigare su Internet in modo semplice.  
Senza DNS dovremmo ricordare tutti gli IP dei siti.

---

## 8) DHCP

### COS’È

Il **DHCP** è il servizio che assegna automaticamente gli indirizzi di rete ai dispositivi.

### A COSA SERVE

Serve per evitare di configurare manualmente IP, subnet mask, gateway e spesso anche DNS.

### COME FUNZIONA

Quando un dispositivo si connette alla rete, chiede i parametri di configurazione al server DHCP.  
Il server risponde con:

- IP
    
- subnet mask
    
- gateway
    
- DNS
    

Così il dispositivo può iniziare a comunicare subito.

### ESEMPIO

Colleghi il telefono al Wi-Fi di casa.  
Il router, se ha il DHCP attivo, gli assegna automaticamente un IP tipo `192.168.1.23`.

### DIFFERENZE IMPORTANTI

Da non confondere con DNS:

- **DHCP** = assegna parametri di rete
    
- **DNS** = traduce nomi in IP
    

### RIASSUNTO FINALE

Il DHCP distribuisce automaticamente la configurazione di rete.  
È molto utile perché evita errori manuali.  
Di solito è presente nel router di casa.

---

## Collegamento tra questi concetti

Questi elementi lavorano insieme così:

1. il dispositivo entra in rete
    
2. il **DHCP** gli assegna IP, mask, gateway e DNS
    
3. il **MAC address** identifica la scheda di rete nella LAN
    
4. lo **switch** collega i dispositivi della rete locale
    
5. il **router** porta i dati fuori dalla rete locale
    
6. il **DNS** trasforma i nomi dei siti in IP
    

Questo collegamento è molto importante all’orale.

---

## Domande possibili da maturità

- Che differenza c’è tra **MAC address e IP**?
    
- A cosa servono **DNS e DHCP**?
    
- Qual è la differenza tra **router e switch**?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: MAC come indirizzo fisico, router per reti diverse, switch per rete locale, DNS per nomi dominio, DHCP per assegnazione automatica.
    
- ⚠ Correzioni: non confondere DNS con DHCP; uno traduce nomi, l’altro assegna parametri di rete.
    
- ➕ Integrazioni utili: ruolo del DHCP nel dare anche gateway e DNS, collegamento tra switch/router e livello di utilizzo nella rete.
    
- ❌ Non trattato: TCP/UDP, porte, HTTP/HTTPS, ISO/OSI, TCP/IP.
    

[DA RICORDARE]

- concetto chiave: DHCP configura automaticamente, DNS traduce i nomi, switch resta nella LAN, router collega reti diverse.
    
- errore comune: pensare che router e switch facciano la stessa cosa; in realtà lavorano in modo diverso.
    
- collegamento utile: questi concetti spiegano come un dispositivo entra in rete e poi raggiunge un sito internet.


Certo. Qui ci sono i punti **corretti e ripuliti**, messi in ordine in modo da essere buoni anche per l’orale.

---

## 1) MAC address

### COS’È

Il **MAC address** è l’indirizzo fisico della scheda di rete di un dispositivo.  
Serve a identificare l’interfaccia di rete nella **rete locale**.

### A COSA SERVE

Serve per la comunicazione a livello di **collegamento dati**: nella LAN, i dispositivi usano il MAC per consegnare i dati alla macchina giusta.

### COME FUNZIONA

Di solito è scritto in esadecimale, per esempio:

`00-16-D4-37-0C-18`

È composto da 6 byte.  
I **primi 3 byte** identificano il produttore della scheda: questo valore si chiama **OUI** (_Organizationally Unique Identifier_).  
Gli **ultimi 3 byte** identificano la scheda o l’interfaccia assegnata dal produttore.


    
- la divisione  è: **primi 24 bit = produttore**, **ultimi 24 bit = parte assegnata dal produttore**
    

Attenzione anche a un punto importante: il MAC è **pensato** per essere univoco, ma nella pratica può essere modificato via software o mascherato in sistemi virtuali.

### ESEMPIO

In una rete con switch, il MAC serve per capire a quale dispositivo mandare una trama Ethernet nella LAN.

### DIFFERENZE IMPORTANTI

Da non confondere con l’IP:

- **MAC** = indirizzo fisico, usato nella rete locale
    
- **IP** = indirizzo logico, usato per comunicare tra reti
    

### RIASSUNTO FINALE

Il MAC identifica la scheda di rete nella LAN.  
I primi 24 bit indicano il produttore, gli altri 24 bit identificano l’interfaccia.  
È molto importante per capire come i dati si muovono nella rete locale.

---

## 2) Shell dei comandi e `ipconfig`

### COS’È

La **shell** è un programma che permette all’utente di comunicare con il sistema operativo tramite comandi testuali.

### A COSA SERVE

Serve per controllare il computer, vedere configurazioni, eseguire operazioni e ottenere informazioni sulla rete o sul sistema.

### COME FUNZIONA

Invece di usare solo finestre e menu, scrivi comandi in una finestra testuale.  
La shell legge il comando e lo passa al sistema operativo.

`ipconfig` è un comando tipico di Windows che mostra la configurazione di rete del computer.

### ESEMPIO

Con `ipconfig` puoi vedere:

- indirizzo IP
    
- subnet mask
    
- gateway
    
- eventuale configurazione DHCP
    


### RIASSUNTO FINALE

La shell è l’interfaccia testuale con il sistema operativo.  
`ipconfig` è uno dei comandi usati per vedere la configurazione di rete.  
È utile soprattutto per capire come il PC è collegato alla rete.

---

## 3) DNS e DHCP: perché possono avere lo stesso indirizzo IP

### COS’È

**DHCP** assegna automaticamente i parametri di rete.  
**DNS** traduce i nomi dei siti in indirizzi IP.

### A COSA SERVONO

- **DHCP**: configura automaticamente il dispositivo
    
- **DNS**: permette di usare nomi facili da ricordare, come `google.com`
    

### COME FUNZIONANO

Qui c’è un punto importante: **DNS e DHCP possono avere lo stesso indirizzo IP** perché possono essere **due servizi diversi sullo stesso dispositivo**.

Per esempio, il router di casa può avere:

- servizio **DHCP**
    
- servizio **DNS** o inoltro delle richieste DNS
    

Quindi il PC può avere come indirizzo:

- del server DHCP: `192.168.1.1`
    
- del server DNS: `192.168.1.1`
    

Questo non significa che DNS e DHCP siano la stessa cosa.  
Significa solo che **stanno sulla stessa macchina**.

### ESEMPIO

Quando il telefono si collega al Wi-Fi:

1. chiede al DHCP i parametri di rete
    
2. riceve IP, gateway, mask e DNS
    
3. quando scrive un sito, usa il DNS per tradurre il nome in IP
    

### DIFFERENZE IMPORTANTI

- **DHCP** = assegna configurazione di rete
    
- **DNS** = traduce nomi in IP
    

### RIASSUNTO FINALE

DNS e DHCP possono avere lo stesso IP perché possono essere servizi presenti sullo stesso router o server.  
Sono però due cose diverse.  
Il DHCP configura, il DNS traduce i nomi.

---

## 4) MAC, CSMA e CSMA/CD

### COS’È

**CSMA** è un metodo per gestire l’accesso a un mezzo trasmissivo condiviso.  
**CSMA/CD** aggiunge il controllo delle collisioni.

### A COSA SERVE

Serve quando più dispositivi potrebbero voler trasmettere sullo stesso canale.  
L’obiettivo è evitare o gestire sovrapposizioni di trasmissione.

### COME FUNZIONA

La logica base è questa:

1. il dispositivo **ascolta** il canale
    
2. se il canale è libero, trasmette
    
3. se il canale è occupato, aspetta
    
4. se due dispositivi trasmettono insieme, si ha una **collisione**
    
5. con **CSMA/CD**, i dispositivi se ne accorgono, interrompono la trasmissione e ritentano dopo un tempo casuale
    

Questo tempo casuale serve a evitare che due dispositivi riprovino nello stesso momento.

Se le collisioni continuano, dopo vari tentativi il sistema smette di insistere: in Ethernet classica il massimo è **16 tentativi**.

### ESEMPIO

In una vecchia rete Ethernet condivisa, due PC possono “pensare” che il canale sia libero e iniziare insieme a trasmettere.  
Allora la trasmissione si rovina e interviene il meccanismo di collisione.

### DIFFERENZE IMPORTANTI

- **CSMA** = ascolta prima di trasmettere
    
- **CSMA/CD** = ascolta, trasmette e rileva anche le collisioni
    

Importante: questo vale per reti **con mezzo condiviso**.  
Nelle reti moderne con **switch** e collegamenti point-to-point, le collisioni praticamente non ci sono più, quindi CSMA/CD non è più centrale come una volta.

### RIASSUNTO FINALE

CSMA controlla se il canale è libero prima di trasmettere.  
CSMA/CD aggiunge il rilevamento delle collisioni.  
È un concetto storico molto importante per capire l’evoluzione delle reti Ethernet.

---

## 5) Hub

### COS’È

L’**hub** è un dispositivo di livello fisico che riceve un segnale e lo inoltra a tutte le porte.

### A COSA SERVE

Serviva a collegare più dispositivi nella rete locale, ma in modo molto semplice e poco efficiente.

### COME FUNZIONA

Se un computer invia un dato all’hub, l’hub lo manda a tutti i dispositivi collegati.  
Non capisce chi sia il destinatario reale.

Quindi lavora come un “ripetitore multiplo”.

### ESEMPIO

Se un PC manda un messaggio attraverso un hub, tutti gli altri PC lo ricevono, anche se il messaggio non è per loro.

### DIFFERENZE IMPORTANTI

- **Hub**: manda tutto a tutti
    
- **Switch**: manda i dati solo alla porta giusta
    

### RIASSUNTO FINALE

L’hub lavora al livello fisico e inoltra tutto a tutti.  
Crea molto traffico inutile.  
Per questo oggi è quasi completamente sostituito dallo switch.

---

## 6) Topologia e tipologia di rete

### COS’È

Qui c’è una correzione importante.

- **Topologia** = struttura della rete, cioè come sono collegati i dispositivi
    
- **Tipologia** = classificazione della rete, per esempio in base all’estensione
    

### A COSA SERVE

Serve per distinguere:

- **come è fatta** la rete
    
- **quanto è grande** o quanto si estende
    

### COME FUNZIONA

Le **topologie** più comuni sono:

- **bus**
    
- **stella**
    
- **anello**
    

Le **tipologie** più comuni sono:

- **LAN**
    
- **MAN**
    
- **WAN**
    

“GAN” è poco usato nel programma scolastico; di solito si parla soprattutto di LAN, MAN e WAN.

### ESEMPIO

- Rete di laboratorio scolastico: **topologia a stella**, tipologia **LAN**
    
- Rete di una città: tipologia **MAN**
    
- Internet: tipologia **WAN**
    

### DIFFERENZE IMPORTANTI

- **Topologia** = disposizione fisica o logica dei nodi
    
- **Tipologia** = estensione geografica della rete
    

### RIASSUNTO FINALE

La topologia dice come sono collegati i dispositivi.  
La tipologia dice quanto è estesa la rete.  
Sono due concetti diversi e spesso confusi.

---

## 7) Perché oggi si usa lo switch e non l’hub

### COS’È

Lo **switch** è il successore pratico dell’hub nelle reti locali.

### A COSA SERVE

Serve a collegare dispositivi nella LAN in modo più intelligente ed efficiente.

### COME FUNZIONA

Lo switch non manda tutto a tutti: invia i dati solo alla porta corretta, usando i MAC address.

Questo riduce:

- traffico inutile
    
- collisioni
    
- spreco di banda
    

### ESEMPIO

In una classe con switch, un PC comunica con un altro PC senza disturbare tutti gli altri.

### DIFFERENZE IMPORTANTI

- **Hub** = broadcast verso tutti
    
- **Switch** = inoltro selettivo
    

### RIASSUNTO FINALE

Lo switch ha sostituito l’hub perché è molto più efficiente.  
Riduce il traffico e migliora la comunicazione nella rete locale.  
È il dispositivo tipico delle reti moderne.

---

## Collegamento finale tra tutti i concetti

Questi appunti, messi insieme, descrivono bene una rete locale:

1. il dispositivo ha un **MAC address**
    
2. la rete può essere collegata tramite **switch**
    
3. in passato si usavano anche **hub**
    
4. l’accesso al mezzo, nelle reti condivise, era regolato da **CSMA/CD**
    
5. il dispositivo ottiene i parametri tramite **DHCP**
    
6. usa il **DNS** per risolvere i nomi
    
7. puoi vedere i parametri con comandi come **ipconfig**
    

---

## Domande possibili da maturità

- Che differenza c’è tra **MAC address e IP**?
    
- Perché **hub e switch** non sono la stessa cosa?
    
- Come funzionano **CSMA e CSMA/CD**?
    
- Perché **DNS e DHCP** possono avere lo stesso indirizzo IP?
    
- Che differenza c’è tra **topologia** e **tipologia** di rete?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: MAC come indirizzo fisico, shell come interfaccia a comandi, `ipconfig` come comando di rete, DNS e DHCP come servizi diversi ma anche sullo stesso server, hub come dispositivo di livello 1, switch come soluzione più efficiente, CSMA/CD per reti condivise.
    
- ⚠ Correzioni: il MAC non è “immutabile” in senso assoluto; i primi 24 bit identificano il produttore tramite OUI; DNS e DHCP non sono la stessa cosa; topologia e tipologia non vanno confuse.
    
- ➕ Integrazioni utili: distinzione tra reti condivise e reti con switch, massimo 16 ritenti in Ethernet classica, ruolo dell’hub nel broadcast.
    
- ❌ Non trattato: dettaglio dei livelli ISO/OSI legati a questi concetti, ARP, incapsulamento, collision domain e broadcast domain in modo formale.
    

[DA RICORDARE]

- concetto chiave: il MAC identifica la scheda nella LAN, il DHCP configura, il DNS traduce i nomi, lo switch è più intelligente dell’hub.
    
- errore comune: confondere topologia con tipologia e pensare che DNS e DHCP siano lo stesso servizio.
    
- collegamento utile: questi concetti spiegano come un dispositivo entra in rete, comunica localmente e poi raggiunge Internet.