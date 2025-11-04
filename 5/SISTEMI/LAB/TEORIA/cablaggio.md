## 📡 Reti Ethernet e Strato di Collegamento (Livello 1 e 2 ISO/OSI)

### 🔹 Dispositivi di rete principali

- **Livello 1:** Hub
    
- **Livello 2:** Bridge, Switch
    

---

### 🧩 HUB

- Sono i **primi concentratori** utilizzati nelle reti Ethernet.
    
- Funzionano come **ripetitori di bit**: i bit ricevuti da una porta vengono **replicati su tutte le altre interfacce**.
    
- **Livello ISO/OSI:** 1
    
- **Distanza massima** tra un nodo e un hub: **100 m**
    
- In caso di **malfunzionamento di un adattatore**, l’hub può **rilevarlo e disconnetterlo**.
    
- Si possono collegare più hub tra loro in **modo gerarchico**:
    
    - un **backbone hub** (hub principale) collega altri hub;
        
    - ogni LAN collegata rappresenta un **segmento di rete**.
        
- La creazione di una **rete multilivello di hub** **non aumenta il throughput** (capacità di trasmissione dei dati).
    
- Buona **tolleranza ai guasti**: la rete può continuare a funzionare anche se un hub si guasta, grazie a segmenti piccoli o connessioni ridondanti.
    
- Tuttavia, tutti gli host collegati allo stesso hub **condividono lo stesso dominio di collisione**, riducendo le prestazioni complessive.
    

---

### 🔹 BRIDGE

- **Livello ISO/OSI:** 2
    
- Ricevono i **frame**, li **memorizzano in buffer**, leggono le **intestazioni** e individuano l’**host di destinazione** tramite il **MAC address**.
    
- **MAC Address:** identificatore unico della scheda di rete, composto da **6 coppie di cifre esadecimali** (48 bit in totale).
    
- Trasmettono i frame **solo sul collegamento corretto (link di uscita)**.
    
- **Applicano un filtro sui pacchetti:**
    
    - **bloccano** i frame destinati allo **stesso segmento**;
        
    - **inoltrano** solo quelli diretti ad altri segmenti della LAN.
        
- Utilizzano il **protocollo CSMA/CD** sul segmento di uscita (**store & forward**), verificando che la linea sia libera prima di trasmettere.
    
- **Vantaggi dei bridge:**
    
    - **Isolano i domini di collisione**, aumentando il throughput complessivo;
        
    - **Nessuna limitazione** sul numero massimo di stazioni o sull’estensione geografica;
        
    - **Nessuna modifica** richiesta agli adattatori dei computer per l’installazione;
        
    - Permettono di **separare la rete in più sottoreti** per migliorare l’efficienza.
        

---

### 🔹 SWITCH

- **Livello ISO/OSI:** 2
    
- Dispositivo che **sostituisce sia l’hub che il bridge** → è un **commutatore**.
    
- In sostanza, è un **bridge ad alte prestazioni** con **molte più interfacce** (mentre un bridge ne ha tipicamente 3-4).
    
- Utilizza **memorie CAM (Content Addressable Memory)** ad **accesso molto veloce** per individuare la porta corretta a cui inoltrare ogni frame.
    
- **Garantisce una banda dedicata per ogni stazione** collegata a una porta.
    
- Supporta la **trasmissione full duplex**, cioè **invio e ricezione simultanei** sulla stessa interfaccia.
    
- Ogni **porta dello switch** rappresenta un **dominio di collisione separato**, aumentando notevolmente l’efficienza.
    
- In reti miste (switch + hub), ogni porta dello switch costituisce un dominio separato, ma la **banda effettiva** in un segmento connesso a un hub **dipende dal numero di stazioni** collegate a quell’hub.
    

---

### 🔸 Riassunto generale

|Dispositivo|Livello ISO/OSI|Funzione principale|Vantaggi principali|Limiti principali|
|---|---|---|---|---|
|**Hub**|1|Ripete i bit su tutte le porte|Semplice, economico, tollerante ai guasti|Unico dominio di collisione, nessun aumento di throughput|
|**Bridge**|2|Smista i frame in base al MAC address|Isola i domini di collisione, aumenta throughput|Limitato numero di porte, store & forward|
|**Switch**|2|Commutazione veloce tra più porte (bridge evoluto)|Banda dedicata, full duplex, CAM veloce|Costo più alto rispetto a hub|

---