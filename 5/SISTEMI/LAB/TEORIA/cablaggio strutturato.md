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
