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