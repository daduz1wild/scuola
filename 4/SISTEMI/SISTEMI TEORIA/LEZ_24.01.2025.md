switch: collega pc/nodi di una stessa rete.
TTl(time to leave):tempondi vita di un pacchetto in una rete.
 comando PING:verifica il collegamento tra 2 macchine inviando un pacchetto di dati e aspettando una risposta.
 quindi se vogliamo collegare nodi di rete diverse dobbiamo avere 2 switch(collegati ai pc della rispettiva rete) che sono collegati a un router che serve per collegare reti diverse(2 ip diversi).
 i vari pc per sapere che devono inviare pacchetti anche a una rete che ha un'altro indirizzo ip(facendogli sapere a quale rete deve inviarlo), con che procedura?
devo fare la procedura Anding che sfrutta la subnet mask

**procedura di "ANDing"** (in italiano "mascheramento logico con AND") che utilizza la **subnet mask** per determinare se due dispositivi si trovano nella stessa rete. È un'operazione fondamentale per l'instradamento dei pacchetti IP.

Vediamo come funziona passo per passo:

---

### **Procedura di ANDing con la Subnet Mask**

1. **Cosa fa l'ANDing?** L'operazione di ANDing confronta l'**indirizzo IP del dispositivo** e l'**indirizzo IP di destinazione** con la **subnet mask**. Questo serve per determinare:
    
    - Se il dispositivo di destinazione si trova **nella stessa rete locale**.
    - Oppure, se il pacchetto deve essere inviato al **gateway (router)** per essere inoltrato a un'altra rete.
2. **Formula di base:** L'operazione di ANDing si applica bit a bit agli indirizzi IP e alla subnet mask.  
    Ogni bit viene confrontato con questa regola:
    
    - `1 AND 1 = 1`
    - `1 AND 0 = 0`
    - `0 AND 0 = 0`
    
    L'AND logico viene eseguito sia per l'indirizzo del dispositivo che per quello di destinazione.
    

---

### **Esempio pratico**

Supponiamo che un PC con **IP: 192.168.1.10** e **Subnet Mask: 255.255.255.0** voglia comunicare con un dispositivo con **IP: 192.168.2.20**.

1. **Convertiamo gli indirizzi in binario:**
    
    - IP del dispositivo: `192.168.1.10` → `11000000.10101000.00000001.00001010`
    - IP di destinazione: `192.168.2.20` → `11000000.10101000.00000010.00010100`
    - Subnet mask: `255.255.255.0` → `11111111.11111111.11111111.00000000`
2. **Eseguiamo l'AND logico:**
    
    - AND sull'IP del dispositivo:
        
        scss
        
        CopiaModifica
        
        `11000000.10101000.00000001.00001010 AND 11111111.11111111.11111111.00000000 = 11000000.10101000.00000001.00000000 (192.168.1.0)`
        
    - AND sull'IP di destinazione:
        
        scss
        
        CopiaModifica
        
        `11000000.10101000.00000010.00010100 AND 11111111.11111111.11111111.00000000 = 11000000.10101000.00000010.00000000 (192.168.2.0)`
        
3. **Confronto dei risultati:**
    
    - La rete del dispositivo è: **192.168.1.0**
    - La rete del destinatario è: **192.168.2.0**
    
    Poiché i risultati sono **diversi**, il dispositivo sa che l'IP di destinazione **non è nella stessa rete locale**.
    
4. **Inoltro al gateway:**  
    Il pacchetto viene inviato al **gateway predefinito** (ad esempio, `192.168.1.1`), che lo instraderà verso la rete corretta.
    

---

### **Riassunto del Flusso**

1. Il PC usa la subnet mask per fare l'AND logico con l'indirizzo IP locale e quello di destinazione.
2. Confronta i risultati:
    - **Stessa rete:** Il pacchetto viene inviato direttamente al destinatario.
    - **Reti diverse:** Il pacchetto viene inoltrato al gateway/router.

---

### **Perché è importante?**

- Permette di determinare **quando comunicare direttamente** con un altro dispositivo e **quando inoltrare i pacchetti** a un router.
- Riduce il traffico non necessario sulla rete.
- È una delle basi fondamentali del routing IP.

Se hai bisogno di chiarimenti o vuoi altri esempi, fammi sapere! 😊


router serve per collegare reti diverse(si deve prima impostare il gateway del router nelle macchine).
il router ha diversi indirizi ip e se vogliop inviare un messaggio da una rete ad un'altra rete imposto nel gateway indrizzo ip del router dalla parte dell'altra rete(ind. pubblico)

lease: tempo di vitya di un indirizzo ip
serve ntp: permette alle macchine di sincronizzare gli orari in base al fuso del luogo in cui ci si trova

