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

---

## 🔸 COS’È

👉 I router si scambiano automaticamente le reti

---

## 🔸 CONFIGURAZIONE

```bash
router rip
version 2
network 192.168.0.0
network 200.100.50.0
```

---

## 🔸 SPIEGAZIONE

👉 `network ...`

Significa:

- “annuncio questa rete agli altri router”
    

---

# 🔹 DEBUG RIP (PARTE CHE NON HAI CAPITO)

```bash
debug ip rip
```

👉 Serve per vedere **in tempo reale**:

- aggiornamenti RIP
    
- scambio di rotte tra router
    

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
    

---

# 🔴 ESERCIZI (IMPORTANTI)

---

### ✅ ESERCIZIO 1

Configura router:

- nome
    
- interfaccia
    
- IP
    
- no shutdown
    

---

### ✅ ESERCIZIO 2

Collega 2 router:

- assegna IP
    
- prova ping
    

---

### ✅ ESERCIZIO 3

Aggiungi route statica:

- next hop
    

---

### ✅ ESERCIZIO 4

Attiva RIP:

- version 2
    
- network
    

---

Se vuoi al prossimo passo ti faccio:  
✅ un **mega schema unico (base + VLAN + routing)**  
oppure  
✅ una **verifica completa come quella che ti darà il prof**





# 🔹 1️⃣ CONFIGURAZIONE BASE DEL ROUTER – COSA STAI FACENDO DAVVERO

## Modalità

```bash
enable
configure terminal
```

- `enable` → entri in **privileged mode (#)**
    
- `configure terminal` → entri in **configurazione globale**
    

Qui stai modificando la **running-config**, cioè la configurazione attiva in RAM.

---

## Cambiare nome al router

```bash
hostname Torino
```

Cambia solo l’identificativo del dispositivo.

---

## Configurare un’interfaccia

```bash
interface fastEthernet 0/0
ip address 192.168.0.1 255.255.255.0
no shutdown
```

### Cosa succede tecnicamente:

1. Assegni un IP alla porta fisica.
    
2. Il router crea automaticamente una **rete direttamente connessa**.
    
3. Inserisce quella rete nella **tabella di routing**.
    

Se fai:

```bash
show ip route
```

Vedrai:

```
C 192.168.0.0/24 is directly connected, FastEthernet0/0
```

👉 La C significa **Connected**.

Il router conosce automaticamente SOLO le reti direttamente collegate.

---

# 🔹 2️⃣ ROUTING STATICO – COSA SIGNIFICA DAVVERO

Quando fai:

```bash
ip route 192.168.2.0 255.255.255.0 192.168.1.2
```

## 🔴 PRIMO PARAMETRO: 192.168.2.0

👉 È l’**indirizzo di rete di destinazione**, NON un host.

Devi sempre inserire:

```
rete di destinazione
subnet mask
next hop
```

### Struttura completa:

```bash
ip route [rete_destinazione] [subnet_mask] [next_hop o interfaccia]
```

---

## 🔹 COSA FA DAVVERO IL ROUTER

Quando arriva un pacchetto:

1. Guarda l’IP di destinazione
    
2. Controlla la tabella di routing
    
3. Se trova corrispondenza:
    
    - inoltra verso il **next hop**
        
4. Se non trova nulla:
    
    - scarta il pacchetto
        

---

## 🔹 NEXT HOP: cosa significa?

È **l’indirizzo del router più vicino** verso la destinazione.

Non è l’indirizzo finale.  
È il **prossimo passo**.

Puoi indicarlo in due modi:

✔ tramite IP:

```bash
ip route 192.168.2.0 255.255.255.0 192.168.1.2
```

✔ tramite interfaccia:

```bash
ip route 192.168.2.0 255.255.255.0 fastEthernet0/1
```

---

# 🔹 3️⃣ DIFFERENZA TRA ROUTING STATICO E DINAMICO

|Statico|Dinamico|
|---|---|
|Inserito manualmente|Si aggiorna automaticamente|
|Non cambia da solo|Si adatta alla rete|
|Più sicuro|Più flessibile|

---

# 🔹 4️⃣ RIP – COSA FA DAVVERO

RIP = Routing Information Protocol  
È un protocollo dinamico di tipo **distance vector**.

---

## Attivazione

```bash
router rip
version 2
network 192.168.1.0
```

---

## 🔴 COSA FA IL COMANDO `network`?

Questa è la parte che molti sbagliano.

Quando scrivi:

```bash
network 192.168.1.0
```

NON stai dicendo:

> “manda i pacchetti a questa rete”

Stai dicendo:

> “Attiva RIP sulle interfacce che appartengono a questa rete e pubblicizza quella rete agli altri router.”

---

## 🔹 COSA SUCCEDE DIETRO

1. Il router controlla le sue interfacce.
    
2. Se trova un’interfaccia con IP dentro quella rete:
    
    - attiva RIP su quella porta.
        
3. Inizia a inviare aggiornamenti ogni 30 secondi.
    
4. Condivide la sua tabella di routing con i router vicini.
    

---

## 🔹 COME FUNZIONA RIP

- Usa numero di **hop** (salti)
    
- Massimo 15 hop
    
- Se una rete supera 15 hop → irraggiungibile
    

La metrica è:

```
numero di router attraversati
```

---

# 🔹 5️⃣ COSA FA `debug ip rip`

```bash
debug ip rip
```

Ti mostra in tempo reale:

- pacchetti RIP inviati
    
- pacchetti RIP ricevuti
    
- aggiornamenti della tabella
    

È uno strumento di **diagnostica**.

Esempio di output:

```
RIP: sending v2 update to 224.0.0.9
RIP: received update from 192.168.1.2
```

Serve per capire:

- se RIP sta funzionando
    
- se i router si stanno scambiando rotte
    

---

# 🔹 6️⃣ ESEMPIO COMPLETO – COSA SUCCEDE IN UNA RETE A 2 ROUTER

Immagina:

R1 — R2

R1 conosce:

```
192.168.1.0
```

R2 conosce:

```
192.168.2.0
```

Con RIP attivo:

- R1 dice a R2: “conosco 192.168.1.0”
    
- R2 dice a R1: “conosco 192.168.2.0”
    

Dopo l’aggiornamento:

R1 conosce:

```
C 192.168.1.0
R 192.168.2.0
```

R2 conosce:

```
C 192.168.2.0
R 192.168.1.0
```

R = appreso tramite RIP.

---

# 🔹 7️⃣ RISPOSTA PERFETTA DA VERIFICA

Se il prof ti chiede:

### ❓ “Qual è il primo parametro nel routing statico?”

Rispondi:

> È l’indirizzo di rete di destinazione, cioè la rete che il router non conosce direttamente e verso cui deve inoltrare i pacchetti.

---

### ❓ “Cosa fa il comando network in RIP?”

Risposta perfetta:

> Il comando network attiva il protocollo RIP sulle interfacce appartenenti a quella rete e permette al router di pubblicizzare quella rete agli altri router.

---

### ❓ “Cosa fa debug ip rip?”

> Mostra in tempo reale gli aggiornamenti RIP inviati e ricevuti, utile per verificare il funzionamento del protocollo.

---

# 🔹 CONCETTO CHIAVE FINALE

Il router funziona così:

1. Riceve pacchetto
    
2. Legge IP destinazione
    
3. Consulta tabella di routing
    
4. Trova rete migliore
    
5. Inoltra al next hop
    

Statico → tabella scritta a mano  
RIP → tabella aggiornata automaticamente

---

Se vuoi, nel prossimo messaggio posso:

- farti una **simulazione di verifica orale**
    
- prepararti uno **schema riassuntivo stampabile**
    
- oppure spiegarti la differenza tra RIP, OSPF ed EIGRP
    

Dimmi tu 💪