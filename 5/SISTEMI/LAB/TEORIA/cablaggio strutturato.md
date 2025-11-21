Perfetto 👍
Ti preparo una **scheda di studio ordinata e chiara** sui tuoi appunti riguardanti il **cablaggio strutturato secondo lo standard EIA/TIA 568**.
La struttura sarà suddivisa per **argomenti logici**, con punti chiave e spiegazioni sintetiche per favorire la memorizzazione e la comprensione.

---

# 📘 CABLAGGIO STRUTTURATO (EIA/TIA 568)

---

## 🔹 1. Scopo dello standard

Lo **standard EIA/TIA 568** definisce i **requisiti minimi** per la **realizzazione di un sistema di cablaggio strutturato** negli edifici e nei complessi di edifici.

### Limiti di applicazione:

* **Estensione geografica massima:** 3000 m
* **Superficie massima degli edifici:** 1.000.000 m²
* **Popolazione massima servita:** 50.000 persone

---

## 🔹 2. Elementi principali dello standard

Le specifiche riguardano:

* **Topologia:** stellare gerarchica
* **Elementi di cablaggio:** dorsali e orizzontale
* **Tipi di cavi e mezzi trasmissivi**
* **Identificazione e documentazione dei cavi**
* **Connettori, giunzioni e patch panel**

---

## 🔹 3. Struttura gerarchica del sistema

### 🏢 a. MC (Main Cross-connect)

* Cuore del sistema (centro stella principale).
* Collegato agli altri edifici tramite **interbuilding backbone** (dorsale di comprensorio).

### 🏢 b. IC (Intermediate Cross-connect)

* Armadio intermedio tra MC e i TC.
* Collegato al MC tramite **intrabuilding backbone**.

### 🧰 c. TC (Telecommunication Closet o Cabinet)

* Armadio di piano, normalmente **uno per piano**.
* Distribuisce il cablaggio orizzontale ai punti di rete (TO).

### ⚙️ d. TD (Telecommunication Distributor)

* Distribuisce i cavi dal TC alle prese di utente (TO).

### 🏠 e. EF (Entrance Facility)

* Punto di ingresso delle dorsali di comprensorio nell’edificio.
* Contiene componenti passivi che collegano la rete esterna all’edificio.

---

## 🔹 4. Patch Panel e Patch Cord

### 🔌 Patch Panel

* Pannello di permutazione che consente di:

  * **Organizzare** i cavi.
  * **Cambiare mezzo trasmissivo** (es. rame ↔ fibra).
  * **Gestire** le connessioni in modo ordinato e modulare.

### 🔗 Patch Cord

* Cavo corto per collegare porte del patch panel o dispositivi.
* Se in **fibra ottica**, si chiama **bretella ottica**.

---

## 🔹 5. Work Area (Area di lavoro)

* È il **posto di lavoro dell’utente** (es. postazione PC).
* Comprende:

  * **Presa utente (TO – Telecommunications Outlet)** → fino a 2 connettori.
  * **Cavo di collegamento** (max 3 m) tra TO e dispositivo.

---

## 🔹 6. Tipi di cavi ammessi (mezzi trasmissivi)

* **Cavi coassiali da 50 Ω**
* **Fibre ottiche multimodali (MMF) 62,5/125 μm**
* **Cavi UTP (Unshielded Twisted Pair)** a 4 coppie
* **Cavi UTP multicoppia**
* **Cavi STP (Shielded Twisted Pair)**

---

## 🔹 7. Dorsali (Backbone cabling)

Le **dorsali** sono i collegamenti principali che uniscono i diversi armadi o edifici.

### Tipi di dorsali:

1. **Interbuilding backbone:** collega edifici diversi (MC ↔ IC).
2. **Intrabuilding backbone:** collega i vari armadi di piano (IC ↔ TC).

### Distanze massime:

| Collegamento    | Mezzo              | Lunghezza massima |
| --------------- | ------------------ | ----------------- |
| MC ↔ TC         | Fibra singolo modo | 2500 m            |
| MC ↔ IC         | Fibra singolo modo | 2000 m            |
| IC ↔ TC         | Fibra o coassiale  | 50 m              |
| TC ↔ TO         | Rame (UTP/STP)     | 90 m              |
| TO ↔ Postazione | Patch cord         | 3 m               |

---

## 🔹 8. Cablaggio orizzontale

* Collega le **prese utente (TO)** all’**armadio di piano (TC)**.
* Lunghezza massima: **90 m**.

### Deve supportare:

* Trasmissione **fonia**
* **Dati seriali**
* **Reti locali (LAN)**
* **Segnali di controllo** per dispositivi interni all’edificio

> ⚠️ Nota: **non si collega direttamente un PC in fibra ottica**, perché servirebbero adattatori costosi e delicati.

---

## 🔹 9. Identificazione e documentazione dei cavi

### Ogni cavo di dorsale deve riportare:

* Identificativo univoco del cavo
* Numero di coppie (rame) o fibre (fibra ottica)

### Ogni postazione di lavoro:

* È identificata da una **targhetta di 8–10 caratteri**.

### Codice identificativo comprende:

1. **Riferimento al piano** dell’edificio
2. **Riferimento all’armadio di piano (TC)**
3. **Codice del posto di lavoro**

### Esempio:

`PD02109A`

| Campo | Significato        |
| ----- | ------------------ |
| PD    | Palazzo Dante      |
| 02    | Piano 2            |
| 109   | Postazione n. 109  |
| A     | Armadio di piano A |

---

## 🔹 10. Riassunto visuale (schema logico)

```
EF (Linea esterna)
│
▼
MC ── Interbuilding backbone ──► IC
│
▼
Intrabuilding backbone
│
▼
TC (Armadio di piano)
│
▼
Cablaggio orizzontale
│
▼
TO (Presa utente)
│
▼
Postazione di lavoro (Work Area)
```

---

Vuoi che ti prepari anche **una mappa concettuale visiva** (diagramma riassuntivo) o **una scheda quiz** per ripassare i punti chiave?
Posso farlo in formato **immagine** o **PDF** da stampare per lo studio.


Ecco una **spiegazione chiara e ordinata** del testo che hai fornito, così da capire bene **come sono strutturati gli armadi di rete (MC e TCx)** e **come funziona la permuta dei cablaggi**.

---

# 📌 **Struttura dell’armadio MC (Main Cabinet — Armadio principale)**

L’armadio **MC** è il punto di concentrazione principale della rete. Qui arrivano le dorsali principali e da qui parte la distribuzione verso gli altri armadi (**TC1, TC2, TC3**).

### Componenti presenti nell’MC

### **1. MODEM**

- Non è ancora installato.
    
- Va aggiunto quando si fa la cablatura dell’espositore.
    
- Serve a fornire la connettività a Internet (o al servizio che deve essere attivato).
    

---

### **2. FO-LINK (adattatori in fibra ottica)**

- Convertiscono il segnale ottico proveniente dalle dorsali in un segnale utilizzabile dagli switch.
    
- Sono collegati al **Patch Panel** (PP), dove si attestano le fibre.
    

---

### **3. SW-CS (Switch di Centro Stella)**

- È lo switch principale della rete locale.
    
- Tutti gli altri switch (nei TC) fanno uplink verso questo dispositivo.
    
- Gestisce il traffico dell’intero impianto.
    

---

### **4. SW-SP (Switch di Distribuzione)**

- È uno switch utilizzato per distribuire la rete nella prima parte della **Sala del Podestà** e per altri servizi.
    

---

### **5. PP (Patch Panel)**

- Qui arrivano:
    
    - Le **dorsali** in fibra (tramite FO-LINK)
        
    - I **cablaggi orizzontali** della prima parte della Sala del Podestà
        
    - I **cablaggi dei servizi** locali
        
- I cavi attestati sul PP **devono essere permutati**, cioè collegati tramite patch cord alle porte dello SW-SP o dello SW-CS a seconda delle necessità.
    

---

### **Funzionamento complessivo dell’MC**

- Le fibre delle dorsali arrivano al PP → passano attraverso gli adattatori FO-LINK.
    
- Lo switch di centro stella (SW-CS) gestisce l’uplink globale.
    
- Lo switch di distribuzione (SW-SP) serve una parte specifica della struttura.
    
- Tutti i cablaggi che necessitano rete devono essere **collegati (permutati)** tra PP e switch.
    

---

# 📌 **Struttura degli armadi TC1 / TC2 / TC3 (Telecommunication Cabinets)**

Gli armadi **TC** sono armadi secondari, collegati in dorsale all’MC.  
Hanno quasi tutti la stessa struttura.

### Componenti dei TC

### **1. FO-LINK (Adattatori in fibra)**

- Ricevono le fibre di dorsale provenienti dal MC.
    
- Le fibre vengono terminate sul **Patch Panel**.
    

---

### **2. SW-x (Switch locale)**

- È lo switch di distribuzione locale del TC.
    
- Da qui vengono servite le prese e i dispositivi nella stanza/sala di riferimento.
    

---

### **3. PP (Patch Panel)**

- Qui si attestano i **cablaggi orizzontali** delle varie aree dell’edificio.
    
- Le porte del PP devono essere **permutate** verso lo switch del TC (SW-x) tramite patch cord.
    

---

# 📌 Dettaglio per ogni TC

### **TC1**

- Sul patch panel arrivano i cablaggi orizzontali della **seconda parte della Sala del Podestà**.
    
- Questi cablaggi devono essere permutati verso **SW-1** (lo switch del TC1).
    

---

### **TC2**

- Il patch panel riceve i cablaggi orizzontali della **Sala del Trecento**.
    
- Questi cablaggi devono essere permutati verso **SW-2** (lo switch del TC2).
    

---

### **TC3**

- Anche qui arrivano cablaggi orizzontali della **Sala del Trecento**, probabilmente un’altra zona o piano.
    
- Devono essere permutati verso **SW-3** (lo switch del TC3).
    

---

# 📌 In sintesi semplice

### **MC (Armadio principale)**

- Riceve dorsali → distribuisce verso tutti i TC.
    
- Contiene switch principali (centro stella e distribuzione).
    
- Il modem deve essere aggiunto.
    
- I cablaggi della prima parte della Sala del Podestà vengono qui permutati.
    

### **TCx (Armadi secondari)**

- Ricevono dorsale dal MC.
    
- Hanno uno switch locale (SW-x).
    
- I cablaggi interni delle varie sale si attestano sul PP e devono essere permutati verso lo switch.
    

---

# 📌 Vuoi una versione schematica visiva (diagramma) dell'impianto?

Se ti serve, posso prepararti un diagramma a blocchi per vedere chiaramente i collegamenti tra MC, TC e sale servite.

Certo! Ti spiego **molto meglio** cosa significa quella frase **e cos’è il PP (Patch Panel)** in modo semplice e pratico.

---

# 🟦 **Cos’è il PP (Patch Panel)**

Il **Patch Panel (abbreviato PP)** è un pannello con tante **porte numerate**, dove terminano (si “attestano”) i cavi fissi dell’impianto.

Puoi immaginarlo così:

👉 I **cavi che arrivano dalle stanze, dalle sale o dai TO** (le prese a muro) **arrivano dietro al Patch Panel** e si collegano in modo permanente.  
👉 Ogni porta del PP rappresenta una presa o un punto rete in un’altra parte dell'edificio.

**IMPORTANTE:**  
Il PP **non fa rete da solo** — è solo un punto di terminazione ordinato dei cavi.

---

# 🟦 Perché serve la “permuta” sul PP?

Il Patch Panel ha solo terminazioni fisse.  
Per dare realmente **connessione** a una di queste terminazioni, devi **collegarla allo switch**.

Questo si fa con una **patch cord**, cioè un cavetto corto da armadio.

### ⭐ **Permutare = Collegare una porta del Patch Panel a una porta dello switch con una patch cord**

Esempio concretissimo:

- Sul PP la porta **12** corrisponde alla presa a muro **A12** nella Sala del Podestà.
    
- Se vuoi dare rete alla presa A12:  
    👉 prendi una patch cord  
    👉 colleghi **PP porta 12** → **Switch porta 5**
    

Hai “permutato” il cavo.

---

# 🟦 Spiegazione migliorata della frase

> **I cavi attestati sul PP devono essere permutati, cioè collegati tramite patch cord alle porte dello SW-SP o dello SW-CS a seconda delle necessità.**

Significa:

1. Sul Patch Panel arrivano i cavi dalla Sala del Podestà e dai servizi.
    
2. Da soli, quei cavi **non hanno connessione**.
    
3. Per dare connessione:
    
    - li devi **collegare con una patch cord** allo **switch di distribuzione (SW-SP)**
        
    - oppure allo **switch di centro stella (SW-CS)**
        
    - dipende da quale switch deve servire quel punto rete.
        

### In altre parole:

Il PP è il “piano di smistamento”, ma la rete la attiva **solo** lo switch → e collegamenti PP↔Switch vanno fatti **manuali**.
# 🟦 Riepilogo molto breve

- **PP = Patch Panel** → dove arrivano i cavi delle prese.
    
- **Permutare** = collegare una porta del PP a una porta dello switch con una patch cord.
    
- Senza permuta, le prese in sala **non funzionano**.
    
- La permuta decide **quale switch** e **quale rete** servirà quel punto.
    