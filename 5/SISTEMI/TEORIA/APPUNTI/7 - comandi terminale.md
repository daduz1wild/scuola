Ecco una versione **più chiara, ordinata e corretta** dei tuoi appunti di Sistemi e Reti. Ho mantenuto tutti i contenuti, migliorandoli e spiegandoli meglio.

---

## **ipconfig**

Il comando **ipconfig** (su Windows) mostra le **informazioni principali della tua interfaccia di rete**, tra cui:

* **Indirizzo IP** del dispositivo
* **Subnet mask**
* **Gateway predefinito** (il router)
* **MAC address** della scheda di rete
* **DNS** configurati

Serve per controllare rapidamente la configurazione e lo stato della connessione.

---

## **Ping**

La funzione **ping** serve a:

* **Verificare se un dispositivo è raggiungibile** sulla rete
* Misurare il **tempo di risposta** (latenza)
* Controllare **eventuali perdite di pacchetti**

Ping utilizza il protocollo **ICMP**: invia un “echo request” e attende un “echo reply”.
Se ricevi risposta → il dispositivo è attivo e raggiungibile.
Se non ricevi risposta → può esserci un problema di rete, firewall, indirizzo errato ecc.

---

## **Differenza tra indirizzo MAC e indirizzo IP**

### **MAC address**

* Identificativo **fisico** e **unico** della scheda di rete
* Fornito dal produttore
* Lavora a **livello 2** (Data Link) del modello OSI
* Non cambia (a meno di modifiche manuali)

### **Indirizzo IP**

* Indirizzo **logico** assegnato alla macchina sulla rete
* Può cambiare (DHCP, cambio rete, ecc.)
* Lavora a **livello 3** (Network)
* Serve per instradare i pacchetti tra reti diverse

**In breve:**
➡️ Il **MAC** identifica *la scheda*
➡️ L’**IP** identifica *il dispositivo sulla rete*

---





o **`ipconfig /displaydns`**; questo elenca le voci memorizzate, inclusi i record di risorse recenti e le voci del file Hosts locale. 

Per cancellare (svuotare) la cache DNS e forzare il sistema a effettuare nuove query ai server DNS, esegui sempre da Prompt dei comandi con privilegi di amministratore il comando **`ipconfig /flushdns`**


Il **TLS** (Transport Layer Security) è l'evoluzione del protocollo **SSL** (Secure Sockets Layer), sviluppato originariamente da Netscape; le versioni SSL sono oggi obsolete e sostituite da TLS, che offre maggiore sicurezza ed efficienza. 

Il **proxy** agisce come intermediario tra client e server, gestendo le connessioni e spesso terminando o ispezionando il traffico crittografato TLS per applicare policy di sicurezza, controllo accessi e prevenzione delle perdite di dati. 

### Differenze chiave tra SSL e TLS

- **Status**: SSL è considerato obsoleto e insicuro; TLS è lo standard attuale (attualmente 1.2 e 1.3). 
    
- **Sicurezza**: TLS corregge le vulnerabilità di SSL e utilizza algoritmi di autenticazione e cifratura più avanzati (es. HMAC invece di MAC semplice). 
    
- **Prestazioni**: L'handshake TLS è più veloce e richiede meno round-trip rispetto a quello SSL, riducendo la latenza. 
    

### Ruolo del Proxy con TLS

- **Terminazione SSL/TLS**: Il proxy decrittifica il traffico in arrivo, lo analizza (per firewall, antivirus, DLP) e lo ricrittifica per il server backend. 
    
- **Gestione Accessi**: Consente di controllare quali client possono connettersi, verificando certificati o applicando regole basate sul contenuto decrittografato. 
    
- **Autenticazione**: Garantisce l'identità delle parti coinvolte nella comunicazione, spesso attraverso certificati digitali rilasciati da autorità di certificazione.