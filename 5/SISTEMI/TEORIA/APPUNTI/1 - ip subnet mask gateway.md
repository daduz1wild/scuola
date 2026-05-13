
## 1) IP

### COS’È

L’**IP** (Internet Protocol) è l’indirizzo logico di un dispositivo in una rete.  
Serve a identificare un computer, uno smartphone, una stampante, un server, ecc.

### A COSA SERVE

Serve per **sapere dove inviare i dati**.  
Quando un dispositivo manda un pacchetto, l’IP indica il mittente e il destinatario.

### COME FUNZIONA

Ogni dispositivo connesso a una rete ha un indirizzo IP.  
L’IP può essere:

- **IPv4** → esempio: `192.168.1.10`
    
- **IPv6** → esempio: `2001:db8::1`
    

Con IPv4, l’indirizzo è formato da 4 numeri separati da punti.  
L’IP però non basta da solo: bisogna sapere anche **in che rete si trova** quel dispositivo. Per questo serve la subnet mask.

### ESEMPIO

Il tuo PC ha IP `192.168.1.10` e il telefono ha `192.168.1.11`.  
Entrambi sono nella stessa rete locale, quindi possono parlarsi direttamente.

### DIFFERENZE IMPORTANTI

Da non confondere con il **MAC address**:

- **IP** = indirizzo logico, può cambiare
    
- **MAC** = indirizzo fisico della scheda di rete, di solito non cambia
    

### RIASSUNTO FINALE

L’IP è l’indirizzo che identifica un dispositivo nella rete.  
Serve per inviare correttamente i dati.  
Da solo non basta: bisogna capire anche la rete di appartenenza.  
Per questo si usa insieme alla subnet mask.


- concetto chiave: l’IP identifica il dispositivo, la subnet mask dice se il destinatario è nella stessa rete, il gateway serve per uscire dalla rete locale.
    
- errore comune: pensare che il gateway sia sempre “Internet”; in realtà è il passaggio verso un’altra rete.
    
- collegamento utile: questo trio serve per capire subito come funziona la comunicazione di base in una LAN.

Gli indirizzi IP sono suddivisi in **classi** (A, B, C, D, E) in base al loro **primo ottetto** e all'uso previsto. Ti mostrerò i primi e gli ultimi indirizzi di ogni classe.

### **Classe A** (0.0.0.0 - 127.255.255.255)

- **Primo indirizzo**: `0.0.0.0` (riservato, non utilizzabile)
- **Primo indirizzo utilizzabile**: `1.0.0.0`
- **Ultimo indirizzo**: `127.255.255.255` (127.x.x.x è riservato per il loopback, quindi l'ultimo reale è `126.255.255.255`)

### **Classe B** (128.0.0.0 - 191.255.255.255)

- **Primo indirizzo**: `128.0.0.0`
- **Ultimo indirizzo**: `191.255.255.255`

### **Classe C** (192.0.0.0 - 223.255.255.255)

- **Primo indirizzo**: `192.0.0.0`
- **Ultimo indirizzo**: `223.255.255.255`

### **Classe D (Multicast)** (224.0.0.0 - 239.255.255.255)

- **Primo indirizzo**: `224.0.0.0`
- **Ultimo indirizzo**: `239.255.255.255`
- (Questi indirizzi non sono utilizzabili per host normali, servono per il multicast)

### **Classe E (Riservata)** (240.0.0.0 - 255.255.255.255)

- **Primo indirizzo**: `240.0.0.0`
- **Ultimo indirizzo**: `255.255.255.255`
- (Questa classe è riservata per usi futuri o sperimentali)

Se vuoi approfondire le subnet o altri dettagli sugli indirizzi IP, chiedi pure! 😊

![[ReS1.08 INDIRIZZI IP.pdf]]

Gli **indirizzi IP privati** sono riservati per le reti locali (LAN) e non sono instradabili su Internet. Esistono diverse classi di indirizzi IP privati, e per ciascuna ti indico il **primo e l'ultimo indirizzo disponibile**.

---

### **🔹 Classe A (10.0.0.0/8)**

- **Primo indirizzo**: `10.0.0.0` (identifica la rete, non assegnabile a un dispositivo)
- **Primo indirizzo assegnabile**: `10.0.0.1`
- **Ultimo indirizzo assegnabile**: `10.255.255.254`
- **Ultimo indirizzo**: `10.255.255.255` (broadcast della rete)

---

### **🔹 Classe B (172.16.0.0/12)**

- **Primo indirizzo**: `172.16.0.0`
- **Primo indirizzo assegnabile**: `172.16.0.1`
- **Ultimo indirizzo assegnabile**: `172.31.255.254`
- **Ultimo indirizzo**: `172.31.255.255`

---

### **🔹 Classe C (192.168.0.0/16)**

- **Primo indirizzo**: `192.168.0.0`
- **Primo indirizzo assegnabile**: `192.168.0.1`
- **Ultimo indirizzo assegnabile**: `192.168.255.254`
- **Ultimo indirizzo**: `192.168.255.255`

---

### **🔹 Riepilogo**

|Classe|Primo indirizzo privato|Primo assegnabile|Ultimo assegnabile|Ultimo indirizzo|
|---|---|---|---|---|
|**A**|`10.0.0.0`|`10.0.0.1`|`10.255.255.254`|`10.255.255.255`|
|**B**|`172.16.0.0`|`172.16.0.1`|`172.31.255.254`|`172.31.255.255`|
|**C**|`192.168.0.0`|`192.168.0.1`|`192.168.255.254`|`192.168.255.255`|

Gli indirizzi di rete (`.0`) e di **broadcast** (`.255` in subnet complete) **non sono assegnabili ai dispositivi**.

Se hai dubbi su subnetting o calcolo IP, chiedimi! 🚀




---

## 2) Subnet mask

### COS’È

La **subnet mask** dice quale parte dell’IP identifica la **rete** e quale parte identifica il **singolo dispositivo**.

### A COSA SERVE

Serve a capire:

- se due dispositivi sono nella **stessa rete**
    
- quanta parte dell’indirizzo è dedicata alla rete e quanta agli host
    

### COME FUNZIONA

La subnet mask “divide” l’indirizzo IP in due parti:

- **parte rete**
    
- **parte host**
    

Esempio classico:

- IP: `192.168.1.10`
    
- Subnet mask: `255.255.255.0`
    

Qui i primi tre numeri identificano la rete, l’ultimo il dispositivo.

Quindi:

- `192.168.1.10`
    
- `192.168.1.11`
    

sono nella stessa rete, mentre:

- `192.168.2.10`
    

è in una rete diversa.

### ESEMPIO

Se il PC ha:

- IP `192.168.1.10`
    
- mask `255.255.255.0`
    

allora tutti gli indirizzi `192.168.1.x` fanno parte della stessa rete locale.

### DIFFERENZE IMPORTANTI

Non è un indirizzo e non identifica un dispositivo.  
Serve solo a **interpretare l’IP**.

### RIASSUNTO FINALE

La subnet mask divide l’IP in parte di rete e parte di host.  
Serve per capire quali dispositivi sono nella stessa rete.  
È fondamentale per stabilire se un messaggio resta in LAN o deve uscire fuori.

---

## 3) Gateway

### COS’È

Il **gateway** è il punto di uscita dalla rete locale verso altre reti, di solito Internet.

### A COSA SERVE

Serve quando un dispositivo deve comunicare con un indirizzo che **non è nella sua rete locale**.

### COME FUNZIONA

Se il computer capisce, grazie alla subnet mask, che il destinatario è in un’altra rete, non invia il pacchetto direttamente al destinatario.  
Lo manda al **gateway**, che spesso è il **router**.

Il router poi si occupa di inoltrare il pacchetto verso la rete giusta.

Mini schema:

- stesso network → comunicazione diretta
    
- network diverso → passa dal gateway
    

### ESEMPIO

Il tuo PC vuole aprire un sito web.  
Il server del sito non è nella tua rete domestica, quindi il PC invia i dati al router, cioè al gateway, che li porta verso Internet.

### DIFFERENZE IMPORTANTI

- **Gateway** = indirizzo o dispositivo di uscita dalla rete
    
- **Router** = apparato che instrada i pacchetti tra reti diverse
    

Spesso, nella rete domestica, il gateway coincide con il router.

### RIASSUNTO FINALE

Il gateway è la porta d’uscita della rete locale.  
Serve per raggiungere dispositivi fuori dalla LAN.  
Di solito coincide con il router.

---

## Collegamento tra i tre

Schema molto importante:

1. il dispositivo ha un **IP**
    
2. la **subnet mask** dice se il destinatario è nella stessa rete
    
3. se il destinatario è fuori rete, si usa il **gateway**
    

Questo è uno dei punti più chiesti all’orale.

---

## Esempio completo

PC:

- IP `192.168.1.10`
    
- Mask `255.255.255.0`
    
- Gateway `192.168.1.1`
    

Caso 1: vuole parlare con `192.168.1.20`  
→ stessa rete, comunicazione diretta

Caso 2: vuole aprire `8.8.8.8`  
→ rete diversa, passa dal gateway `192.168.1.1`

---

## Domande possibili da maturità

- Che differenza c’è tra **IP, subnet mask e gateway**?
    
- Come fai a capire se due dispositivi sono nella stessa rete?
    
- Perché un computer usa il gateway per andare su Internet?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: IP come indirizzo logico, subnet mask come divisione rete/host, gateway come uscita verso altre reti.
    
- ⚠ Correzioni: non confondere gateway e router; spesso coincidono, ma il gateway è il ruolo/logica di uscita.
    
- ➕ Integrazioni utili: distinzione tra comunicazione nella stessa rete e fuori rete, esempio con IP domestico.
    
- ❌ Non trattato: DNS, DHCP, MAC address, router, switch, TCP/UDP, porte, HTTP/HTTPS, ISO/OSI, TCP/IP.
    

[DA RICORDARE]