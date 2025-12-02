Ecco i tuoi appunti **riscritti in modo chiaro, corretto e ordinato**, senza perdere nessuna informazione che hai scritto. Ho organizzato tutto per argomenti, corretto gli errori tecnici e aggiunto dove serviva per rendere i concetti comprensibili.

---

<<<<<<< HEAD
# ✅ **ARP, MAC, IP e comunicazioni di rete**
=======
nella tabella arp si vede anche gli indirizzi di tutte le macchine con cui il proprio pc ha comunicato
la tabella è vuota e il pc non ha comunicato con altri
arp asalva MAC address
>>>>>>> 18d9c38d4b4d287e0192e704082a071990d3d0c3

### **ARP: cos’è e a cosa serve**

* **ARP (Address Resolution Protocol)** serve a **mappare un indirizzo IP** con il relativo **indirizzo fisico (MAC)** di un host.
* Lavora a **livello 2/3** (confine tra Data Link e Network).
* La tabella ARP contiene le coppie:
  **IP → MAC**
* Per visualizzarla si usa:

  ```cmd
  arp -a
  ```
* La tabella ARP è **vuota finché il PC non comunica con altri dispositivi**.
* Le associazioni ARP vengono **cancellate automaticamente ogni ~5 minuti** (timeout) per evitare voci obsolete.

### **Come funziona ARP**

1. L’host vuole inviare a un IP che non conosce.
2. Invia un **messaggio ARP in broadcast** sulla rete locale.
3. Tutti gli host lo ricevono; solo quello con l’IP richiesto risponde con il proprio **MAC address**.
4. Lo switch usa la **tabella CAM (Content Addressable Memory)** per associare MAC → porta fisica.
5. L’host salva nella tabella ARP la coppia IP/MAC.

👉 **ARP trova MAC a partire da un IP. Non trova IP partendo dal MAC.**

---

# ✅ **Switch, Hub, CSMA/CD e collisioni**

### **Hub**

* Lavora a **livello 1 (Fisico)**.
* Non usa IP o MAC.
* Tutto ciò che riceve su una porta lo **replica in broadcast** su tutte le altre.
* Tutte le macchine collegate a un hub sono nello stesso **dominio di collisione**.
* Necessita del protocollo **CSMA/CD** per gestire le collisioni.

### **CSMA/CD**

* Usato in Ethernet tradizionale (con hub).
* Se due host trasmettono insieme → **collisione**.
* Viene inviato un **jamming signal** per informare tutti della collisione.
* Il tempo minimo per individuare una collisione è di circa **104 ms** (dipende dalla rete).

### **Switch**

* Lavora a **livello 2 (Data Link)**.
* Ogni porta è un **dominio di collisione separato** → niente CSMA/CD.
* Inoltra frame **solo alla porta corretta**, grazie alla tabella **CAM** (MAC → Porta).
* Rende la rete più veloce e senza collisioni.

👉 *Con uno switch non serve CSMA/CD perché lo switch sa già su che porta inoltrare il frame.*

---

# ✅ **Porte, Socket e protocolli**

### **Perché massimo 2¹⁶ porte?**

* Le porte sono identificate da un numero a **16 bit** →
  **2¹⁶ = 65536 porte** totali (0–65535).

### **Tipi di porte**

* **0–1023 → Well Known Ports** (HTTP 80, HTTPS 443, SSH 22, SMTP 25, DNS 53, DHCP 67/68…)
* Le porte sono **virtuali**, gestite dal sistema operativo.

### **Socket**

Un **socket** identifica un canale univoco di comunicazione composto da:

```
IP sorgente + Porta sorgente + IP destinazione + Porta destinazione
```

Serve a creare un “tunnel logico” per una trasmissione.

---

# ✅ **Protocolli e livelli**

* **UDP/TCP → Livello 4 (Trasporto)**
* **DHCP → Livello 7 (Applicazione)**
* **DNS → Livello 7 (Applicazione)**

  * Lavora con IP, ma anche con **stringhe** (nomi di dominio)
* **ARP → Livello 2/3**
* **CSMA/CD → Livello 2 (Accesso al mezzo)**
* **HTTP/HTTPS → Livello 7**
* **SSH, SMTP, POP3 → Livello 7**

---

# ✅ **Hub e dominio di collisione**

* Con un hub → **unico canale condiviso**
  → necessità di CSMA/CD
  → tutto avviene in broadcast.

---

# ✅ **Browser**

* Lavora a **livello 7 (Applicazione)**.
* È composto da:

  * **Client** (sul tuo PC)
  * **Server** (web server che risponde alla richiesta)

---

# Vuoi che trasformi questi appunti in una **mappa concettuale**, una **scheda per interrogazione**, o un **riassunto breve**?
