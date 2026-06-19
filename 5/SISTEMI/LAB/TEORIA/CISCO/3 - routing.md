Perfetto, continuiamo e facciamo una spiegazione **pulita, completa e da interrogazione**, sistemando bene i tuoi appunti 👇

---

# 🔹 CONFIGURAZIONE BASE ROUTER (PASSO PER PASSO)

---

## 🔸 1. ENTRARE NEL ROUTER

```bash
enable
configure terminal
```

👉 Ora sei in modalità configurazione:

```
Router(config)#
```

---

## 🔸 2. CAMBIARE NOME AL ROUTER

```bash
hostname Torino
```

👉 Risultato:

```
Torino(config)#
```

💡 Serve per identificare il router nella rete

---

# 🔹 CONFIGURAZIONE INTERFACCIA

---

## 🔸 3. ENTRARE IN UNA PORTA

```bash
interface fastEthernet 0/0
```

👉 Ora sei qui:

```
Torino(config-if)#
```

---

## 🔸 4. ASSEGNARE INDIRIZZO IP

```bash
ip address 192.168.0.1 255.255.255.0
```

👉 IMPORTANTE:

- l’IP identifica il router nella rete
    
- la subnet mask definisce la rete
    

---

## 🔸 5. ACCENDERE L’INTERFACCIA

```bash
no shutdown
```

👉 Senza questo comando:  
❌ la porta resta SPENTA

---

# 🔹 CONTROLLO CONFIGURAZIONE

---

## 🔸 VEDERE STATO INTERFACCE

```bash
show ip interface brief
```

👉 Output importante:

- **up/up** → tutto funziona ✅
    
- **administratively down** → manca `no shutdown` ❌
    
- **down** → problema di collegamento ❌
    

---

# 🔹 COMANDI UTILI

---

## 🔸 ipconfig (nei PC)

```bash
ipconfig
```

👉 Mostra:

- IP
    
- subnet mask
    
- gateway
    

---

## 🔸 ping

```bash
ping 192.168.0.2
```

👉 Serve per:

- testare la connessione (usa **ICMP**)
    

---

# 🔹 ROUTER E RETI

---

## 🔸 COSA VEDE UN ROUTER

```bash
show ip route
```

👉 Mostra:

- reti conosciute
    

💡 Di default:  
👉 SOLO quelle direttamente collegate

---

# 🔴 PROBLEMA

👉 Il router NON conosce altre reti

---

# 🔹 ROUTING STATICO

Serve per dire al router:

👉 “Se devi andare in questa rete, passa da lì”

---

## 🔸 COMANDO

```bash
ip route 172.16.0.0 255.255.0.0 192.168.1.2
```

---

## 🔸 SPIEGAZIONE

- `172.16.0.0` → rete destinazione
    
- `255.255.0.0` → subnet
    
- `192.168.1.2` → **next hop** (router successivo)
    

---

## 🔸 ALTERNATIVA (INTERFACCIA)

```bash
ip route 172.16.0.0 255.255.0.0 fastEthernet 0/0
```

👉 Usa la porta di uscita

---

# 🔴 ATTENZIONE

👉 Devi configurare anche il router dall’altro lato

💡 Se no:

- andata OK
    
- ritorno NO
    

---

# 🔹 ROUTING DINAMICO (RIP)

RIP è un protocollo di routing dinamico di tipo distance vector.
I router si scambiano automaticamente le loro tabelle e imparano le reti remote.
La metrica usata è il numero di hop, con limite massimo 15.
Con RIP v2 si supportano maschere variabili e la configurazione si fa con `router rip`, `version 2` e `network`.

👉 I router si scambiano automaticamente le reti

### 1. Cosa inserisci nel comando `network`

Il comando richiede l'**indirizzo di rete** (spesso indicato come "network address" o "subnet address"), non il singolo indirizzo IP dell'interfaccia. 

### 1. Il comando è "Egoista" (Locale)

Quando scrivi `network 192.168.0.0` sul **Router A**:

- Il Router A guarda **solo le proprie interfacce**. 
    
- Si chiede: "Ho qualche mia interfaccia con un IP che inizia per 192.168.0.x?"
    
- Se la risposta è **SÌ**: Attiva RIP su quella specifica interfaccia del Router A.
    
- Se la risposta è **NO**: Non fa nulla su nessuna interfaccia. 
    
- **Non tocca, non configura e non attiva nulla sul Router B**
---
Quando digiti `network <indirizzo_rete>`:

1. Il router controlla tutte le sue interfacce.
    
2. Se un'interfaccia ha un indirizzo IP che cade dentro quel range di rete, **abilita RIP su quella specifica interfaccia**. 
    
3. Il router inizierà a **inviare e ricevere** aggiornamenti RIP su quella porta. 
    
4. La rete associata a quell'interfaccia verrà annunciata agli altri router.
## 🔸 CONFIGURAZIONE

```bash
router rip
version 2
network 192.168.0.0
network 200.100.50.0
```


---
## 🔹 COSA SUCCEDE DIETRO

1. Il router controlla le sue interfacce.
    
2. Se trova un’interfaccia con IP dentro quella rete:
    
    - attiva RIP su quella porta.
        
3. Inizia a inviare aggiornamenti ogni 30 secondi.
    
4. Condivide la sua tabella di routing con i router vicini.

Quando un router riceve una rotta:

* la memorizza
* aggiunge **1 hop** alla metrica
* poi la può inoltrare agli altri

### Hop count

In RIP la metrica è il **numero di hop**:

* più hop = percorso meno vicino
* meno hop = percorso migliore

### Limite importante

RIP considera una rete **irraggiungibile** se servono più di **15 hop**.
Il valore **16** indica rete non raggiungibile.
    


# COSA SUCCEDE DOPO LA CONFIGURAZIONE

Dopo aver configurato RIP su tutti i router:

1. ogni router invia la propria tabella ai vicini
2. ogni router riceve nuove rotte
3. aggiunge le reti remote alla routing table
4. le reti diventano raggiungibili automaticamente

Questa è la parte più bella del routing dinamico: non devi inserire rotte una per una.

---

# TABELLA DI ROUTING

## COS’È

La tabella di routing è la lista dei percorsi che il router conosce.

## COME SI AGGIORNA

Con RIP, nella tabella compaiono rotte apprese dinamicamente.

Nei tuoi appunti hai visto la lettera **R**:

* significa che la rotta è stata appresa tramite **RIP**

---

# ESEMPIO DEL TUO VIDEO

Quando Venezia fa:

```bash id="showrip1"
show ip route
```

può vedere già le reti apprese da altri router.

Questo significa che:

* non è necessario configurare tutto manualmente
* il routing dinamico ha già distribuito le informazioni

E se Venezia fa ping verso Torino, funziona perché la rete è stata appresa automaticamente.
# 🔹 DEBUG RIP (PARTE CHE NON HAI CAPITO)

```bash
debug ip rip
```

👉 Serve per vedere **in tempo reale**:

- aggiornamenti RIP
    
- scambio di rotte tra router
    

---


Dire che un protocollo è **Distance Vector** significa che i router prendono decisioni di instradamento basandosi esclusivamente su due informazioni fondamentali fornite dai router vicini:

1. **Distance (Distanza):** Quanto costa raggiungere una destinazione (la metrica, spesso contata in _hop_, ovvero numero di router da attraversare). 
    
2. **Vector (Vettore):** In che direzione andare, ovvero quale interfaccia o quale router vicino (next-hop) usare per raggiungere quella destinazione.

---
### 💡 IN PRATICA

Ti mostra cose tipo:

- invio tabelle di routing
    
- ricezione aggiornamenti
    

👉 Serve per:

- capire se RIP funziona
    
- trovare errori
    

---

# 🔴 ATTENZIONE

Per fermarlo:

```bash
undebug all
```

---

## PERCHÉ SI USA LA VERSIONE 2

RIP v2 è importante perché supporta le **maschere di lunghezza variabile**:

* quindi supporta **VLSM**
* è più flessibile della versione 1

# 🔹 RIASSUNTO FINALE

- `enable` → modalità privilegiata
    
- `conf t` → configurazione
    
- `hostname` → nome router
    
- `interface` → scegli porta
    
- `ip address` → assegna IP
    
- `no shutdown` → accendi porta
    
- `show ip interface brief` → stato porte
    
- `show ip route` → reti conosciute
    
- `ip route` → routing statico
    
- `router rip` → routing dinamico
    
- `debug ip rip` → controllo traffico RIP
    