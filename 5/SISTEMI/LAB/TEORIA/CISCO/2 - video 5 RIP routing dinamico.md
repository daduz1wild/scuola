Certo. Qui ti faccio una spiegazione **chiara, completa e molto utile per la maturità** sul **RIP dinamico**, usando i tuoi appunti ma sistemando bene i punti teorici e pratici.

---

# RIP dinamico

## COS’È

**RIP** (*Routing Information Protocol*) è un **protocollo di routing dinamico** di tipo **distance vector**.

Significa che i router non ricevono tutto “a mano” dall’amministratore, ma **si scambiano automaticamente le informazioni di routing**.

In pratica:

* ogni router conosce le reti direttamente collegate
* poi invia ai router vicini la propria tabella di routing
* gli altri router imparano nuove rotte in modo automatico

---

## A COSA SERVE

Serve per far sì che i router:

* scoprano da soli i percorsi verso le reti remote
* aggiornino automaticamente la tabella di routing
* si adattino ai cambiamenti della rete senza configurazioni manuali continue

È molto utile quando la rete cambia o quando ci sono più router che devono comunicare tra loro.

---

## COME FUNZIONA

RIP appartiene alla famiglia dei **distance vector**.

### Idea base

Ogni router invia periodicamente ai router vicini una copia della propria **routing table**.

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

### Aggiornamenti periodici

RIP invia aggiornamenti regolari, tipicamente ogni **30 secondi**.
Questo permette ai router di rilevare cambiamenti nella topologia.

---

## ESEMPIO LOGICO

Hai tre router:

* Torino
* Milano
* Venezia

Ognuno conosce le proprie reti direttamente connesse.

Poi:

* Torino manda la sua tabella a Milano
* Milano la manda a Torino e Venezia
* Venezia fa lo stesso

Così ogni router impara le reti lontane senza configurarle una per una.

---

# RIP v2

## COS’È

**RIP v2** è la versione usata nei tuoi appunti.

## PERCHÉ SI USA LA VERSIONE 2

RIP v2 è importante perché supporta le **maschere di lunghezza variabile**:

* quindi supporta **VLSM**
* è più flessibile della versione 1

Questo è un punto da ricordare bene all’orale.

---

# CONFIGURAZIONE PRATICA

La configurazione si fa su ogni router.

## 1) Attivo RIP

```bash id="r1rip1"
router rip
```

## 2) Imposto la versione

```bash id="r1rip2"
version 2
```

## 3) Indico le reti da annunciare

```bash id="r1rip3"
network 192.168.1.0
network 200.100.50.0
```

---

# SIGNIFICATO DEL COMANDO `network`

Questo comando non “crea” la rete.
Serve a dire al router:

> “Questa rete è direttamente collegata a te, quindi le sue informazioni devono essere annunciate tramite RIP.”

Quindi il router:

* attiva RIP sulle interfacce appartenenti a quelle reti
* inserisce nella tabella RIP le reti collegate
* le pubblica ai router vicini

---

# APPLICAZIONE AI TRE ROUTER

## Router Torino

Nel tuo esempio Torino annuncia:

* la rete locale `192.168.1.0`
* la rete seriale di collegamento verso gli altri router `200.100.50.0`

Comandi:

```bash id="rtor1"
router rip
version 2
network 192.168.1.0
network 200.100.50.0
```

## Router Milano

Milano annuncia le reti direttamente collegate a lui, cioè le sue interfacce di collegamento con gli altri router.

```bash id="rmi1"
router rip
version 2
network 200.100.50.0
network 200.100.54.0
```

## Router Venezia

Venezia annuncia:

* la rete seriale
* la propria rete locale

```bash id="rven1"
router rip
version 2
network 200.100.54.0
network 192.168.2.0
```

---

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

---

# DEBUG DI RIP

Per vedere i messaggi RIP che viaggiano tra i router puoi usare:

```bash id="debugrip1"
debug ip rip
```

Con questo comando il router mostra gli aggiornamenti RIP ricevuti e inviati.

### Cosa vedi

* **sending updates** → il router sta inviando aggiornamenti
* **received** → il router ha ricevuto informazioni da un vicino

È utile per capire come si propaga la tabella di routing.

---

# DIFFERENZE IMPORTANTI

## RIP vs routing statico

* **routing statico** = rotte scritte manualmente dall’amministratore
* **RIP** = rotte apprese automaticamente

## RIP vs altri protocolli dinamici

RIP è uno dei protocolli più semplici.
È facile da capire, ma meno evoluto di altri protocolli più moderni.

## RIP v1 vs RIP v2

* **RIP v1** = classful, non supporta bene le subnet variabili
* **RIP v2** = classless, supporta VLSM

---

# RIASSUNTO FINALE

RIP è un protocollo di routing dinamico di tipo distance vector.
I router si scambiano automaticamente le loro tabelle e imparano le reti remote.
La metrica usata è il numero di hop, con limite massimo 15.
Con RIP v2 si supportano maschere variabili e la configurazione si fa con `router rip`, `version 2` e `network`.

---

# DOMANDE POSSIBILI DA MATURITÀ

* Che cos’è il **RIP** e perché è un protocollo di routing dinamico?
* Qual è la differenza tra **routing statico e routing dinamico**?
* Cosa significa che RIP è un protocollo **distance vector**?
* Che cosa fa il comando `network` nella configurazione di RIP?
* Perché si usa **RIP v2** invece di RIP v1?

---

[CONTROLLO STUDIO]

* ✔ Corretto: RIP come routing dinamico, tipo distance vector, scambio automatico delle tabelle, hop count come metrica, limite 15 hop, uso di RIP v2 e comando `network`.
* ⚠ Correzioni: gli aggiornamenti RIP sono periodici, tipicamente ogni 30 secondi; RIP usa multicast in IPv4 verso 224.0.0.9 con RIPv2; il comando `network` attiva RIP sulle interfacce appartenenti a quella rete, non “manda la tabella” direttamente.
* ➕ Integrazioni utili: differenza RIP v1/RIP v2, significato della lettera R nella routing table, uso di `show ip route` e `debug ip rip`.
* ❌ Non trattato: split horizon, poison reverse, hold-down timer, confronto con OSPF in dettaglio.

[DA RICORDARE]

* concetto chiave: RIP impara automaticamente le rotte e usa il numero di hop per scegliere il percorso.
* errore comune: confondere il comando `network` con la creazione della rete; in realtà serve ad attivare RIP su quella rete.
* collegamento utile: RIP è il primo passo per capire il routing dinamico prima di passare a protocolli più evoluti.






**PT_05 RIP v2**

comandi:
router rip
version 2
network 192.168.1.0 
network 200.100.50.0 (reti a cui il router torino invia la propria tabella di routing)

lo stesso lo si fa anche con gli altri router 


  
