# 1) ARP, MAC e IP

## COS’È

**ARP** (_Address Resolution Protocol_) è il protocollo che serve a trovare l’**indirizzo MAC** corrispondente a un certo **indirizzo IP** all’interno della rete locale.

In pratica, ARP collega:

- **IP** = indirizzo logico
    
- **MAC** = indirizzo fisico della scheda di rete
    

## A COSA SERVE

Serve quando un host conosce l’**IP** del destinatario, ma non conosce ancora il suo **MAC**.  
Senza il MAC, nella LAN non può consegnare il frame al dispositivo giusto.

## COME FUNZIONA

Il funzionamento è semplice:

1. un host vuole inviare dati a un IP della rete locale;
    
2. controlla nella propria **tabella ARP** se conosce già il MAC;
    
3. se non lo conosce, invia una richiesta **ARP Request in broadcast**; `FF:FF:FF:FF:FF:FF`
    
4. tutti i dispositivi della LAN ricevono la richiesta;
    
5. risponde solo il dispositivo che possiede quell’IP, inviando il proprio MAC con **ARP Reply**;
    
6. il mittente salva l’associazione nella tabella ARP.
    

Mini schema:

`IP noto → cerco MAC → ARP Request → ARP Reply → salvo IP/MAC`

## ESEMPIO

Se il PC deve inviare dati a `192.168.1.20`, ma non conosce il MAC di quel dispositivo, manda una richiesta ARP nella rete locale.  
Il dispositivo con quell’IP risponde con il proprio MAC, e il PC può finalmente inviare il frame.

## DIFFERENZE IMPORTANTI

- **ARP trova il MAC partendo dall’IP**
    
- **non fa il contrario**
    
- lavora solo nella **rete locale**
    
- non serve per cercare host lontani su Internet
    

## RIASSUNTO FINALE

ARP serve a tradurre un indirizzo IP nel corrispondente MAC nella rete locale.  
La tabella ARP memorizza queste associazioni e si aggiorna quando c’è comunicazione.  
È un passaggio fondamentale per far funzionare davvero la consegna dei dati nella LAN.

---
## INFO IMPORTANTI SU PACCHETTO IP E FRAME

Sì, la correggerei perché il termine "payload applicativo" è fuorviante per ICMP (che è un protocollo di rete, non di applicazione) e tecnicamente il messaggio ICMP è il payload del pacchetto IP, mentre i dati reali sono il payload del messaggio ICMP.

Ecco la versione corretta e più precisa, mantenendo la tua struttura:

# 2) Frame Ethernet, pacchetto IP e ping

## COS’È

Un dato che viaggia in rete viene incapsulato a più livelli.

## A COSA SERVE

Serve per permettere al messaggio di viaggiare correttamente nella rete.

## COME FUNZIONA

Nel caso del ping:

Il **payload** è la parte **utile** di un messaggio o di un pacchetto dati.
È il contenuto reale che vuoi trasportare, escludendo tutte le informazioni di servizio (come indirizzi, intestazioni o codici di controllo) necessarie solo per farlo arrivare a destinazione.

- il **payload** del pacchetto IP è l'intero **messaggio ICMP** (header + dati)
    
- il **payload** del messaggio ICMP sono i **dati di test** (byte inviati dall'utente)
    
- tutto viene inserito in un **pacchetto IP**
    
- il pacchetto IP viene inserito in un **frame Ethernet**
    

Quindi:

- **IP packet** = contiene IP sorgente, IP destinazione e messaggio ICMP
    
- **Ethernet frame** = contiene MAC sorgente, MAC destinazione, il pacchetto IP e il trailer


    

### Correzione importante

L’IP **da solo non basta** per inviare il pacchetto su una LAN.  
Per la consegna a livello locale servono anche i **MAC address**.

Se il destinatario è fuori rete, il frame non va al MAC del destinatario finale, ma al **MAC del gateway/router**.

## ESEMPIO

Quando fai ping a un altro PC della rete, il pacchetto IP viene trasportato dentro un frame Ethernet con i MAC corretti.

## DIFFERENZE IMPORTANTI

- **IP packet** = livello rete
    
- **Ethernet frame** = livello collegamento dati
    
- **broadcast MAC** = `FF:FF:FF:FF:FF:FF`
    

Ecco la spiegazione semplice di cosa sono concretamente questi "dati" nei due livelli:

### 1. Il "Messaggio ICMP" (Payload del Pacchetto IP)
Immagina il pacchetto IP come una **busta da spedizione**.
*   **Cosa c'è scritto sulla busta (Header IP):** Indirizzo IP di chi manda e di chi riceve.
*   **Cosa c'è dentro la busta (Payload IP):** È l'intero **messaggio ICMP**.
    *   Questo messaggio è un "pacchetto chiuso" che dice: *"Ehi, sono un Ping (Echo Request), rispondimi!"*.
    *   Contiene a sua volta una sua piccola intestazione (tipo, "sono un messaggio di tipo 8") e i dati veri e propri.
    *   **A cosa serve:** Dire al computer di destinazione: "Non scartare questo pacchetto, è un comando di controllo, elaboralo".

### 2. I "Dati di Test" (Payload del Messaggio ICMP)
Immagina il messaggio ICMP come una **lettera aperta** dentro la busta.
*   **L'intestazione della lettera (Header ICMP):** Dice il tipo di messaggio (Echo Request) e un codice di controllo.
*   **Il testo della lettera (Payload ICMP):** Sono i **dati di test**.
    *   **Cosa sono:** Una sequenza di byte (spesso lettere dell'alfabeto in ordine come `a, b, c, d...` o numeri) che il tuo computer inventa al momento.
    *   **A cosa servono:** Servono solo a **riempire spazio** per testare la rete.
		    *   Quando il computer riceve il ping, prende *esattamente* quegli stessi byte e te li rispedisce indietro. Se tornano identici, la connessione è integra e non ha corrotto i dati.
## RIASSUNTO FINALE

Il pacchetto IP contiene gli indirizzi IP e i dati.  
Il frame Ethernet aggiunge i MAC e il trailer.  
Sulla rete locale, senza MAC il pacchetto non può essere consegnato correttamente.
# 3) Tabella ARP

## COS’È

La **tabella ARP** è una memoria temporanea del computer che contiene le associazioni tra **IP e MAC** dei dispositivi con cui ha comunicato.

## A COSA SERVE

Serve per evitare di rifare sempre la richiesta ARP ogni volta che si deve parlare con lo stesso dispositivo.

## COME FUNZIONA

Quando il PC scopre un’associazione IP/MAC, la salva nella tabella.  
Quando deve comunicare di nuovo con lo stesso host, controlla prima lì.

La tabella non è permanente: le voci scadono dopo un certo tempo, che può variare a seconda del sistema operativo e della configurazione.  
Quindi è corretto dire che è **temporanea**, ma non fissare sempre un valore unico come “5 minuti”.

Comando utile:

- `arp -a` → mostra la tabella ARP
    

## ESEMPIO

Se il PC ha appena parlato con la stampante della rete, la relativa associazione può comparire nella tabella ARP.  
Se non ha ancora comunicato con nessuno, la tabella può essere vuota o quasi vuota.

## DIFFERENZE IMPORTANTI

La tabella ARP non è la stessa cosa della tabella CAM dello switch:

- **tabella ARP** → IP ↔ MAC, sta nel computer
    
- **tabella CAM** → MAC ↔ porta, sta nello switch

**tabella CAM nelle reti informatiche** (switch Ethernet), essa è la **tabella di indirizzamento MAC** memorizzata nella memoria ad accesso rapido (Content-Addressable Memory) dello switch. Questa tabella mappa gli **indirizzi MAC** dei dispositivi alle **porte fisiche** dello switch, permettendo il forwarding efficiente dei frame solo verso la porta di destinazione, evitando il flooding su tutte le porte. 
    

## RIASSUNTO FINALE

La tabella ARP conserva temporaneamente le associazioni IP/MAC già scoperte.  
Serve a velocizzare le comunicazioni locali.  
Si può visualizzare con `arp -a`.

---

- concetto chiave: ARP collega IP e MAC, DNS collega nomi e IP, DHCP configura il dispositivo, switch usa i MAC per inoltrare i frame.
    
- errore comune: pensare che l’IP basti da solo; in rete locale servono anche MAC, ARP e incapsulamento Ethernet.
    
- collegamento utile: ARP, DHCP, DNS e switch spiegano come un host entra in rete e comunica davvero con gli altri dispositivi.
# 4) Porte e socket

## PORTE

### COS’È

Le **porte** sono numeri logici usati dal sistema operativo per distinguere i diversi servizi che comunicano in rete sullo stesso dispositivo.

### A COSA SERVONO

Servono a capire **a quale applicazione** devono arrivare i dati.

L’IP identifica il dispositivo, la porta identifica il servizio.

### COME FUNZIONA

Le porte sono numerate su **16 bit**, quindi il loro intervallo va da:

- `0` a `65535`
    

Le porte più usate sono le **well-known ports** da `0` a `1023`, per esempio:

- `80` → HTTP
    
- `443` → HTTPS
    
- `22` → SSH
    
- `25` → SMTP
    
- `53` → DNS
    
- `67-68` → DHCP
- **Porta 21 (TCP)**: È la porta di controllo standard. Viene utilizzata per stabilire la connessione iniziale, autenticare l'utente e trasmettere i comandi tra client e server. 
    
- **Porta 20 (TCP)**: È la porta dati standard nella **modalità attiva**.  Il server usa questa porta per inviare i dati al client dopo che la connessione di controllo è stata stabilita.

### ESEMPIO

Un server web può avere:

- IP: `192.168.1.10`
    
- porta 80 per HTTP
    
- porta 443 per HTTPS
    

### DIFFERENZE IMPORTANTI

La porta non è un componente fisico.  
È un numero logico gestito dal sistema operativo.

### RIASSUNTO FINALE

Le porte servono a indirizzare i dati al servizio giusto sullo stesso dispositivo.  
Sono fondamentali insieme a IP e protocollo.  
Le porte più note sono 80, 443, 22, 53, 25 e 67-68.

---

## SOCKET

### COS’È

Un **socket** è l’elemento logico che serve a identificare in modo univoco una connessione tra un’applicazione client e un’applicazione server.


### A COSA SERVE

Serve per collegare una comunicazione a una coppia precisa di dispositivi e servizi.

### COME FUNZIONA

Un socket è collegato a:

- IP sorgente
    
- porta sorgente
    
- IP destinazione
    
- porta destinazione
- protocollo

Questa combinazione permette di riconoscere in modo preciso la connessione.

## A COSA SERVE

Serve per distinguere correttamente:

* quale dispositivo sta comunicando
* quale applicazione del dispositivo sta comunicando
* quale servizio sul server deve ricevere i dati

Questo è fondamentale perché sullo stesso computer possono esserci più programmi in rete contemporaneamente:

### ESEMPIO

Quando il tuo browser apre un sito, la comunicazione non dipende solo dall’IP del server, ma anche dalla porta usata e dal processo che gestisce la richiesta.

### Caso del browser

Quando apri un sito web:

1. il browser fa una richiesta verso un server, per esempio Google
2. il tuo PC usa il proprio IP
3. il sistema operativo assegna una **porta sorgente temporanea** al browser
4. il server risponde sulla **porta di destinazione** corretta, per esempio:

   * 80 per HTTP
   * 443 per HTTPS

## ESEMPIO

Supponiamo di avere due richieste contemporanee dal tuo PC:

* browser 1 → porta sorgente `1000`
* browser 2 → porta sorgente `2000`

Entrambe vanno verso Google.

Allora le connessioni si distinguono così:

* `IP_PC:1000 → IP_Google:80`
* `IP_PC:2000 → IP_Google:80`

Anche se il server di destinazione è lo stesso, il sistema distingue le due comunicazioni grazie alle porte sorgenti diverse.

### Esempio ancora più realistico

Se apri:

* una pagina web
* un client email
* un trasferimento FTP

il sistema usa socket diversi per non confondere i flussi di dati.

---

## DIFFERENZE IMPORTANTI

### Socket vs porta

* **porta** = numero che identifica il servizio o il processo
* **socket** = identificazione completa della comunicazione

### Socket vs IP

* **IP** = identifica il dispositivo
* **socket** = identifica la comunicazione tra dispositivi e processi


### Socket client e socket server

* il **server** resta in ascolto su una porta nota, per esempio 80 o 443
* il **client** usa di solito una porta temporanea, chiamata anche porta effimera
### DIFFERENZE IMPORTANTI

- **IP** = dispositivo
    
- **porta** = servizio
    
- **socket** = canale logico di comunicazione
    

### RIASSUNTO FINALE

Il socket rappresenta la comunicazione tra due estremi di rete.  
Usa IP e porte per identificare in modo preciso chi comunica con chi.  
È un concetto molto importante per capire TCP/IP.

---

# 5) Protocolli e livelli

## COS’È

I protocolli lavorano su livelli diversi del modello di rete.

## A COSA SERVE

Serve per capire dove si colloca ogni tecnologia nel processo di comunicazione.

## COME FUNZIONA

In base ai tuoi appunti:

- **ARP** → livello 2/3
    
- **CSMA/CD** → livello 2
    
- **TCP/UDP** → livello 4
    
- **HTTP/ livello 7
- HTTPS** → livello  5-6-7
    
- **DNS** → livello 7
    
- **DHCP** → livello 7
    
- **SSH, SMTP, POP3** → livello 7
    

Questa classificazione è utile per studiare, anche se in alcuni casi i protocolli vengono descritti con sfumature leggermente diverse nei libri o nei prof.  
Per la maturità, l’idea importante è sapere **a che livello agiscono**.

### RIASSUNTO FINALE

Ogni protocollo lavora a un livello preciso del modello di rete.  
ARP e CSMA/CD stanno vicino ai livelli bassi, mentre HTTP, DNS e DHCP stanno al livello applicativo.  
TCP e UDP appartengono al trasporto.

---

# 6) Browser e livello applicazione

## COS’È

Il **browser** è il programma che usi per navigare sul web.

## A COSA SERVE

Serve per inviare richieste ai server web e visualizzare le risposte.

## COME FUNZIONA

Il browser lavora al **livello 7**, cioè al livello applicazione.  
Quando apri un sito:

1. il browser invia una richiesta
    
2. usa HTTP o HTTPS
    
3. la richiesta passa attraverso i livelli inferiori della rete
    
4. il server risponde
    
5. il browser mostra la pagina
    

Attenzione a una correzione importante:  
il browser **non ha una “parte server” dentro di sé**.  
Il browser è il **client**.  
Il **server** è un’altra macchina, con un altro software, che risponde alle richieste.

### ESEMPIO

Quando scrivi un indirizzo web nel browser, il browser fa la richiesta.  
Il server web risponde con la pagina richiesta.

### DIFFERENZE IMPORTANTI

- **Browser** = client
    
- **Web server** = server
    

### RIASSUNTO FINALE

Il browser è il client usato per navigare sul web.  
Lavora al livello applicazione e comunica con i server tramite HTTP o HTTPS.  
Il server è un sistema separato che risponde alla richiesta.

---

# 7) Collegamento generale tra tutti i concetti

Un flusso completo può essere visto così:

1. il PC ottiene i parametri di rete;
    
2. usa l’**IP** per identificare il dispositivo;
    
3. usa la **subnet mask** per capire se il destinatario è locale;
    
4. se serve, usa il **gateway** per uscire dalla rete;
    
5. nella LAN usa il **MAC**;
    
6. se non conosce il MAC, usa **ARP**;
    
7. lo **switch** inoltra il frame sulla porta giusta;
    
8. i **protocolli di trasporto** usano le **porte**;
    
9. il browser usa **HTTP/HTTPS**;
    
10. il tutto si può studiare con i modelli **ISO/OSI** e **TCP/IP**.
    

Questo è uno dei collegamenti più importanti da saper dire all’orale.

---

## Domande possibili da maturità

- Che differenza c’è tra **ARP, IP e MAC**?
    
- Come funziona **CSMA/CD** e perché era necessario con l’hub?
    
- Qual è la differenza tra **hub e switch**?
    
- Che cosa sono **porte e socket**?
    
- In quale livello si collocano **HTTP, DNS, DHCP e ARP**?
    

---

[CONTROLLO S
    

[DA RICORDARE]

- concetto chiave: ARP collega IP e MAC nella LAN, lo switch usa MAC e CAM, le porte identificano i servizi, il socket identifica la comunicazione.
    
- errore comune: confondere hub e switch, oppure pensare che l’IP basti da solo senza MAC, porta e protocollo.
    
- collegamento utile: ARP, switch, porte e socket spiegano come una richiesta passa dal livello locale fino al servizio applicativo come HTTP o HTTPS.


## SMTP (Simple Mail Transfer Protocol)

Protocollo standard per l’invio e il trasferimento delle email tra client e server SMTP e tra server SMTP di domini diversi.



## DSL, ADSL e Fibra Ottica

- **DSL/ADSL:** connessioni Internet via linea telefonica in rame. ADSL offre velocità asimmetriche (più veloce in download) sfruttando frequenze diverse per upload e download. Costi contenuti ma dipendenza da distanza centrale e interferenze.
    
- **Fibra Ottica:** trasmissione dati tramite impulsi luminosi in cavi di vetro/plastica, offre velocità elevatissime, bassa attenuazione, alta affidabilità ma costi d’installazione maggiori.
    
- **FTTH:** Fibra ottica diretta fino a casa/ufficio, offre connessioni molto veloci e affidabili con bassa latenza.
    

## WiFi e protocolli di sicurezza (WEP, WPA1, WPA2, WPA3)

Gli standard WiFi (802.11) regolano la comunicazione wireless con frequenze 2,4 GHz e 5 GHz, evolvendo in velocità e prestazioni.

- _WEP:_ protocollo di sicurezza obsoleto e vulnerabile.
    
- _WPA1, WPA2:_ miglioramenti sostanziali nella sicurezza con WPA2 largamente usato oggi.
    
- _WPA3:_ standard recente (2018) che migliora sicurezza e integrità.
    
- _Altri:_ WPA2/WPA3 supportano autenticazione robusta e crittografia avanzata.

## FTTH (Fiber To The Home)

Tecnologia che porta la fibra ottica direttamente all’edificio, fornendo connessioni molto veloci, affidabili, con bassa latenza, idonee per servizi avanzati come streaming ad alta definizione e gaming online.

## Crittografia

Processo di trasformazione dei dati in forma cifrata per proteggerli da accessi non autorizzati durante la trasmissione o archiviazione.

- **Simmetrica:** stessa chiave per cifrare e decifrare (es. AES, DES).
    
- **Asimmetrica:** chiave pubblica per cifrare, chiave privata per decifrare (es. RSA, DSA).
    
- **Hash:** genera impronta digitale univoca dei dati (es. SHA, MD5) per verifica integrità e password.
    
- **Importanza:** garantisce confidenzialità, integrità, autenticazione e non ripudio.
    
## SSL e TLS

Protocolli crittografici per garantire la sicurezza delle comunicazioni su Internet, soprattutto per HTTPS e email sicure.

- **SSL:** primo protocollo ampiamente utilizzato, oggi obsoleto a causa di vulnerabilità.
    
- **TLS:** evoluzione di SSL, standard IETF, versioni 1.0 a 1.3 con miglioramenti di sicurezza e prestazioni.
    
- **Funzioni principali:** crittografia, autenticazione tramite certificati digitali, integrità dati, forward secrecy.
    
- **Applicazioni:** HTTPS, SMTPS, FTPS e altre comunicazioni sicure.
    
## Cloud Computing

Modello che permette l’accesso a risorse IT (server, storage, software) on-demand via Internet.

- **Caratteristiche:** accesso ubiquo, scalabilità, servizio misurato.
    
- **Modelli di servizio:**
    
    - IaaS: infrastruttura virtuale (server, storage).
        
    - PaaS: piattaforme di sviluppo e gestione app.
        
    - SaaS: software disponibili via browser.
