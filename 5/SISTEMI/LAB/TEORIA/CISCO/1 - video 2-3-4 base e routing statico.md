Perfetto, questa è proprio la **base fondamentale di Packet Tracer + router Cisco**.  
Te la riscrivo in modo **chiaro, ordinato e da interrogazione**, spiegando anche bene le parti che non hai capito 👇

---

# 🔹 1️⃣ PACKET TRACER – BASE (PREFERENCES)

👉 In Cisco Packet Tracer trovi:

- **Options → Preferences**
    

Qui puoi:

- cambiare grandezza font
    
- migliorare grafica
    
- velocità simulazione
    

💡 Serve solo per lavorare meglio, NON per la rete.

---

# 🔹 2️⃣ CLI (Command Line Interface)

👉 È la **riga di comando** dei dispositivi (router, switch)

---

## 🔸 HELP (fondamentale)

### `?`

Mostra tutti i comandi disponibili

### `t?`

👉 mostra comandi che iniziano con "t"

### `show ?`

👉 mostra tutti i parametri del comando `show`

💡 Questo è IMPORTANTISSIMO all’esame

---

# 🔹 3️⃣ MODALITÀ DEL ROUTER

Ci sono 3 modalità principali:

---

## 🔸 1. User Mode

```id="g93wsk"
Router>
```

👉 modalità base

---

## 🔸 2. Privileged Mode

```id="ffk9rt"
enable
```

Diventa:

```id="rxy4cd"
Router#
```

👉 puoi vedere configurazioni

---

## 🔸 3. Configuration Mode

```id="l6m7dj"
configure terminal
```

Diventa:

```id="xqmf1s"
Router(config)#
```

👉 puoi configurare il router

---

# 🔹 4️⃣ CONFIGURAZIONE INTERFACCE

Per configurare una porta:

```id="4m4d9z"
interface fastEthernet 0/0
```

👉 ora sei dentro:

```id="p9q1rf"
Router(config-if)#
```

---

## ⚠️ IMPORTANTISSIMO

👉 Le interfacce del router sono **spente di default**

---

# 🔴 PARTE CHE NON HAI CAPITO (TE LA SPIEGO BENE)

```id="z2l93o"
ip address 192.168.79.254 255.255.255.0
no shutdown
```

### 🔸 COSA FA?

👉 `ip address ...`

- assegna un **indirizzo IP alla porta del router**
    
- è come dire: "questa porta appartiene a questa rete"
    

👉 `255.255.255.0`

- è la **subnet mask**
    
- definisce la rete (es. 192.168.79.0)
    

---

👉 `no shutdown`

- ACCENDE la porta
    

💡 Senza questo comando → la porta NON funziona

---

### ✅ IN PRATICA

Stai dicendo:

👉 “Questa interfaccia è nella rete 192.168.79.0 e può comunicare”

---

# 🔹 5️⃣ TTL (Time To Live)

👉 Serve per evitare loop infiniti

- ogni router → diminuisce TTL di 1
    
- quando arriva a 0 → pacchetto scartato
    

---

💡 In Packet Tracer:

- parte da **128**
    
- dopo 1 router → diventa **127**
    

---

👉 Se vedi **timeout**:  
➡️ TTL finito o problema di rete

---

# 🔹 6️⃣ ICMP

👉 Protocollo usato dal comando:

```id="npxx3y"
ping
```

Serve per:

- testare la connessione
    

---

# 🔹 7️⃣ CAVI (IMPORTANTISSIMO)

👉 Regola:

- dispositivi UGUALI → **cavo incrociato**
    
- dispositivi DIVERSI → **cavo dritto**
    

---

## 🔸 Esempi:

- PC ↔ PC → incrociato
    
- Switch ↔ Switch → incrociato
    
- Router ↔ Router → incrociato
    
- PC ↔ Switch → dritto
    

---

# 🔹 8️⃣ MODELLI DI RETE

## 🔸 TCP/IP

- 4 livelli
    

## 🔸 OSI

- 7 livelli
    

👉 Sono modelli teorici, ma la rete funziona uguale

---