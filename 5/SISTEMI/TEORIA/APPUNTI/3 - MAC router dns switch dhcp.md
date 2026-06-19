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

Di solito è scritto in esadecimale, per esempio:

`00-16-D4-37-0C-18`

È composto da 6 byte.  
I **primi 3 byte** identificano il produttore della scheda: questo valore si chiama **OUI** (_Organizationally Unique Identifier_).  
Gli **ultimi 3 byte** identificano la scheda o l’interfaccia assegnata dal produttore.


    
- la divisione  è: **primi 24 bit = produttore**, **ultimi 24 bit = parte assegnata dal produttore**
    

Attenzione anche a un punto importante: il MAC è **pensato** per essere univoco, ma nella pratica può essere modificato via software o mascherato in sistemi virtuali.
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
# 3) Hub, switch, CSMA/CD e collisioni

## HUB

### COS’È

L’**hub** è un dispositivo di livello 1, cioè del **livello fisico**.

### A COSA SERVE

Serviva a collegare più dispositivi in una rete locale, ma in modo molto semplice e poco intelligente.

### COME FUNZIONA

Riceve un segnale e lo replica su tutte le porte.  
Per questo tutti i dispositivi condividono lo stesso canale.
Non distingue il destinatario.

Per questo:

- lavora in modo simile a un “ripetitore”
- c’è un solo dominio di collisione
    
- il traffico va in broadcast
    
- servono CSMA/CD e collision detection
    
### ESEMPIO

Se un PC invia un dato a un hub, tutti i PC collegati all’hub ricevono quel segnale.

### DIFFERENZE IMPORTANTI

L’hub crea un unico mezzo condiviso.  
Questo aumenta il traffico inutile e favorisce le collisioni.

### RIASSUNTO FINALE

L’hub lavora al livello fisico e inoltra tutto a tutti.  
È poco efficiente e oggi è quasi sempre sostituito dallo switch.

---

## CSMA/CD

### COS’È
**CSMA/CD** significa _Carrier Sense Multiple Access / Collision Detection_.  
**CSMA/CD** è il meccanismo usato nelle reti Ethernet condivise per controllare l’accesso al mezzo e gestire le collisioni.

### A COSA SERVE

Serve quando più host possono voler trasmettere sullo stesso canale contemporaneamente, tipicamente con **hub**.

### COME FUNZIONA

La logica è questa:

1. un host ascolta il canale;
    
2. se il canale è libero, trasmette;
    
3. se il canale è occupato, aspetta;
    
4. se due host trasmettono insieme, si verifica una **collisione**;
    
5. gli host interrompono la trasmissione;
    
6. inviano un **jamming signal** per segnalare la collisione;
    
7. attendono un tempo casuale e poi ritentano.
    

Il ritardo casuale serve per evitare che due host riprovino nello stesso istante.
a parte importante è il **backoff casuale**: più collisioni ci sono, più aumenta il range di attesa.  
Dopo **16 tentativi** la comunicazione viene considerata fallita.
 il tempo di attesa è random, molto piccolo, nell’ordine dei **microsecondi** nelle reti Ethernet classiche.

### ESEMPIO

In una rete con hub, due PC possono iniziare a trasmettere quasi nello stesso momento.  
La trasmissione si sovrappone, avviene una collisione e il meccanismo CSMA/CD interviene.

### DIFFERENZE IMPORTANTI

- **CSMA** = ascolta prima di trasmettere
    
- **CSMA/CD** = ascolta e rileva anche le collisioni
    

Nelle reti moderne con **switch**, le collisioni quasi non esistono più, quindi CSMA/CD non è più centrale come nelle vecchie Ethernet condivise.

### RIASSUNTO FINALE

CSMA/CD regola l’accesso al mezzo nelle reti condivise e gestisce le collisioni.  
È tipico delle reti con hub o con mezzo trasmissivo condiviso.  
Nelle reti moderne con switch è molto meno importante.

---

## SWITCH

### COS’È
Lo **switch** è un dispositivo che collega più dispositivi nella stessa rete locale.
Lavora a livello 2, cioè del **livello collegamento dati**.

### A COSA SERVE

Serve a collegare più dispositivi nella stessa rete locale in modo più efficiente rispetto all’hub.

### COME FUNZIONA

Lo switch legge i **MAC address** e inoltra il frame solo sulla porta corretta.  
Per farlo usa la **tabella CAM**, che associa:

- **MAC address → porta dello switch**
    

Ogni porta dello switch è, di fatto, un dominio di collisione separato.  
Per questo non si hanno le collisioni tipiche dell’hub.

### ESEMPIO

Se un PC manda un frame a un altro PC collegato allo switch, lo switch lo inoltra solo alla porta del destinatario, non a tutti.

### DIFFERENZE IMPORTANTI

- **Hub** → broadcast a tutte le porte
    
- **Switch** → inoltro selettivo sulla porta giusta
    

Con lo switch non serve CSMA/CD come nelle reti condivise, perché il mezzo non è condiviso nello stesso modo.

### RIASSUNTO FINALE

Lo switch usa i MAC address e la tabella CAM per inviare i dati solo dove servono.  
È più efficiente dell’hub e riduce traffico e collisioni.  
È il dispositivo tipico delle LAN moderne.
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

## **Cosa succede quando inserisci un URL nel browser?**

1. **Il sistema controlla il file `hosts`**

   * È un file locale dove puoi associare manualmente nomi → indirizzi IP.
   * Se trova una corrispondenza, **non interroga il DNS**.

2. Se non trova nulla nel `hosts`, il computer consulta i **server DNS** configurati.

3. **Il gateway** viene usato per raggiungere DNS o server fuori dalla rete locale.
   Se il gateway è assente o errato:

   * puoi risolvere nomi *solo se il DNS è nella tua stessa rete*
   * altrimenti la richiesta DNS **non può uscire** e non puoi navigare.

---


### RIASSUNTO FINALE

Il DNS serve a trasformare i nomi dei siti negli indirizzi IP.  
È essenziale per navigare su Internet in modo semplice.  
Senza DNS dovremmo ricordare tutti gli IP dei siti.

---

## 8) DHCP

### COS’È

Il **DHCP** è il servizio che assegna automaticamente i parametri di rete ai dispositivi.

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

# ✅ **DHCP: processo completo e ruolo dei broadcast** DORA

Quando un host si collega alla rete e non ha un IP, usa il protocollo **DHCP**.
Il processo standard è:

### **1. DHCP Discover (broadcast)**

* L’host non conosce:

  * il gateway
  * l’IP del server DHCP
  * il proprio IP
* Perciò invia un **frame in broadcast**:

  * MAC destinazione: `FF:FF:FF:FF:FF:FF`
  * IP destinazione: `255.255.255.255`

Lo switch inoltra il broadcast a **tutte le porte**, inclusa quella che porta al router (che spesso include un *DHCP relay*).

---

### **2. DHCP Offer**

* I server DHCP che ricevono il discover rispondono con una **DHCP Offer**, che contiene:

  * un indirizzo IP proposto
  * subnet mask
  * gateway
  * DNS
  * tempo di lease

L’host potrebbe ricevere più offerte (se ci sono più server).
Poi sceglie la migliore in base ai suoi algoritmi.

---

### **3. DHCP Request**

* L’host informa **tutti** i server DHCP che accetta **solo l’offerta scelta**.
* Questo serve a:

  * confermare la scelta al server selezionato
  * **far sapere agli altri server** che MUST rilasciare l’IP che avevano offerto (per poterlo ridare a qualcun altro)

---

### **4. DHCP Acknowledgement (ACK)**

* Il server scelto invia il pacchetto finale: **DHCP ACK**.
* Da questo momento:

  * l’IP è assegnato
  * l’host conosce tutte le configurazioni
  * può comunicare normalmente

👉 Il tuo appunto di “l’ultima knowledge” si riferiva a **ACK (Acknowledgement)**.

---

# ✅ **MAC Address: quando diventa conosciuto**

Durante il broadcast:

* l’host non conosce il MAC del DHCP server
* ma il DHCP server **vede il MAC dell’host** nel frame Discover
* dopo l’ACK sarà possibile comunicare **unicast** (MAC → MAC), quindi senza più broadcast.

---

# ✅ **Porta mittente e porta destinatario (Livello 4)**

Nel segmento TCP/UDP sono presenti:

* **porta sorgente** (mittente)
* **porta destinazione** (quella del servizio, es. 67/68 DHCP, 53 DNS, 80 HTTP)

Questo permette al sistema operativo di capire:

* quale processo invia
* a quale servizio è destinata la richiesta


Le porte del DHCP sono:

- **67** per il server
    
- **68** per il client
    

## MODALITÀ DI ASSEGNAZIONE IP

### Dinamica

Il server assegna un IP per un periodo di **lease**.  
Alla scadenza, l’indirizzo può essere riassegnato ad altri host.

### Automatica

Il server assegna un IP in modo automatico e tende a ridare allo stesso host lo stesso indirizzo, se possibile.  
Qui l’idea è più vicina a una **prenotazione**.

### Statica

L’IP è assegnato in modo permanente a un host specifico, per esempio una stampante.

## ESEMPIO

Quando accendi il PC in una rete domestica, il router con DHCP attivo gli assegna un IP, la mask, il gateway e spesso anche il DNS.

## DIFFERENZE IMPORTANTI

- **DHCP** = assegnazione automatica dei parametri di rete
    
- **DNS** = traduzione dei nomi in IP
    
- **porta 67/68** = comunicazione server-client del DHCP
    
---

# 🔷 Versione ultrabreve per ripasso

* La **PDU finale** in una rete locale = **frame Ethernet**.
* Il **pacchetto IP** è incapsulato nel frame.
* DHCP funziona in 4 passi: **Discover → Offer → Request → ACK**.
* Discover è **broadcast** perché l’host non conosce nulla.
* Offer: il server risponde con una proposta.
* Request: il client sceglie un server.
* ACK: conferma finale → configurazione completa.
* Livello 4 usa **porte** (mittente/destinatario) per distinguere le applicazioni.

---

Se vuoi posso creare:
📌 una **mappa concettuale**
📌 uno **schema grafico del DHCP**
📌 un **diagramma OSI di incapsulamento**

Dimmi tu!


---

## Domande possibili da maturità

- Che differenza c’è tra **MAC address e IP**?
    
- A cosa servono **DNS e DHCP**?
    
- Qual è la differenza tra **router e switch**?
    


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

- ✔ Corretto: MAC come indirizzo fisico, shell come interfaccia a comandi, `ipconfig` come comando di rete, DNS e DHCP come servizi diversi ma anche sullo stesso server, hub come dispositivo di livello 1, switch come soluzione più efficiente, CSMA/CD per reti condivise.
    
- concetto chiave: il MAC identifica la scheda nella LAN, il DHCP configura, il DNS traduce i nomi, lo switch è più intelligente dell’hub.
    
- errore comune: confondere topologia con tipologia e pensare che DNS e DHCP siano lo stesso servizio.
    
- collegamento utile: questi concetti spiegano come un dispositivo entra in rete, comunica localmente e poi raggiunge Internet.