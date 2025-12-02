Ecco i tuoi appunti **riscritti, corretti e messi in ordine**, in modo che siano chiari e comprensibili per lo studio.

---

# ✅ **PDU, incapsulamento e livelli OSI**

Quando un’applicazione deve trasmettere dati, ogni livello OSI aggiunge la sua intestazione.
Questo processo si chiama **incapsulamento**.

* **Livello 7–5**: dati dell’applicazione
* **Livello 4**: segmento (TCP) o datagramma (UDP)
* **Livello 3**: pacchetto IP
* **Livello 2**: frame Ethernet
* **Livello 1**: bit sul mezzo

👉 **La PDU finale su rete locale è il *frame Ethernet***, che contiene al suo interno il pacchetto IP, che contiene il segmento, ecc.

---

# ✅ **Pacchetto IP → Frame Ethernet**

* Il **pacchetto IP** da solo non può viaggiare su una rete fisica.
* Deve essere **incapsulato** in un **frame Ethernet**, che richiede:

  * MAC sorgente
  * MAC destinazione (conosciuto tramite ARP)

---

# ✅ **DHCP: processo completo e ruolo dei broadcast**

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
