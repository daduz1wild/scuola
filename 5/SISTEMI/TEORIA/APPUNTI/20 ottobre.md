### 🔹 1. Interfaccia a riga di comando (CLI) e interfaccia grafica (GUI)

- **CLI (Command Line Interface)** → è l’interfaccia **testuale** in cui scrivi comandi per configurare o controllare un dispositivo.  
    🔸 Esempio: su un router Cisco scrivi comandi come
    
    `ip dhcp pool LAN network 192.168.1.0 255.255.255.0 default-router 192.168.1.1`
    
    per configurare il DHCP.
    
- **GUI (Graphical User Interface)** → è l’interfaccia **grafica**, cioè quella con finestre, pulsanti e menu.  
    🔸 Esempio: quando accedi al router da browser (192.168.1.1) e clicchi su “Impostazioni DHCP” invece di scrivere comandi.
    

➡️ In breve:

- CLI = scrivi comandi
    
- GUI = usi un’interfaccia grafica con il mouse
    





---

### 🔹 2. Pool = insieme

- Un **pool DHCP** è un **insieme di indirizzi IP** che il server DHCP può assegnare ai dispositivi (client) della rete.  
    🔸 Esempio:  
    se la tua rete è `192.168.1.0/24`, puoi creare un pool da `192.168.1.100` a `192.168.1.200`.  
    Così il DHCP assegnerà IP solo in quel range.
    

---

### 🔹 3. Creazione di un pool DHCP (passaggi logici)

1. **Dai un nome al pool** (cioè al gruppo di indirizzi).  
    Esempio:
    
    `ip dhcp pool LAN`
    
2. **Specifica la rete** e la **maschera di sottorete**:
    
    `network 192.168.1.0 255.255.255.0`
    
3. **Specifica il default gateway**, cioè il router:
    
    `default-router 192.168.1.1`
    
4. (Opzionale) Puoi **escludere** certi indirizzi IP che **non vuoi** che il DHCP assegni:
    
    `ip dhcp excluded-address 192.168.1.1 192.168.1.10`
    
    In questo modo, gli IP da 1 a 10 non verranno mai assegnati dal DHCP.
    

---

### 🔹 4. Default gateway

- È l’**indirizzo IP del router** (lo “scatolotto” che collega la rete interna a Internet).
    
- Tutti i dispositivi della rete usano questo indirizzo per “uscire” dalla LAN verso altre reti.
    
- In molti casi, **DHCP e router** si trovano nello stesso dispositivo (quindi il gateway e il server DHCP coincidono).
    

---

### 🔹 5. Richiesta DHCP in broadcast

Quando un computer si connette alla rete e non ha ancora un IP, fa così:

1. Manda una **richiesta DHCP in broadcast** (cioè a tutti i dispositivi della rete) per dire:
    
    > “C’è un server DHCP che può darmi un IP?”
    
2. Se ci sono più server DHCP, **il client sceglie uno** tra quelli che rispondono più velocemente.
    

---

### 🔹 6. Esclusione di indirizzi

- Come detto, puoi dire al router:  
    “Non dare certi indirizzi IP a nessun dispositivo”.
    
- Lo fai con il comando `ip dhcp excluded-address`.  
    Esempio:
    
    `ip dhcp excluded-address 192.168.1.1 192.168.1.10`
    
    → Quegli indirizzi restano riservati (magari per stampanti, server, o il router stesso).
    

---

### 🔹 7. Riassunto visivo

|Concetto|Significato|
|---|---|
|**CLI**|Interfaccia testuale a comandi|
|**GUI**|Interfaccia grafica con mouse|
|**Pool DHCP**|Gruppo di indirizzi IP che il server può assegnare|
|**Default gateway**|IP del router|
|**Broadcast DHCP**|Richiesta inviata a tutti per cercare un server DHCP|
|**Excluded address**|Indirizzi che non devono essere assegnati|



dhp sicovery a discovery ack.
il leasse dtime determina per quanto tempo un certo indririzzo ip puo essere assegnato a un host, esso puo essere rinnovato e quindi mantenuto dalla macchina.

NTP= sincronizzza tutte le macchine con lo stesso orario mondiale.

stampante non ha bisogno di lease time

l