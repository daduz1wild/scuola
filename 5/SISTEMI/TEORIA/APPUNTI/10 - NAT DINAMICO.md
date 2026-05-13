Certo. Qui hai la spiegazione del **NAT dinamico**, costruita bene per la maturità e collegata al NAT statico.

---

# NAT dinamico

## COS’È

Il **NAT dinamico** è una traduzione tra indirizzi **privati** e **pubblici** che avviene in modo **automatico e temporaneo**, usando un **pool di indirizzi pubblici**.

A differenza del NAT statico, qui non c’è una corrispondenza fissa 1:1 tra un host interno e un indirizzo pubblico specifico.

## A COSA SERVE

Serve quando una rete privata ha molti host, ma non abbastanza indirizzi pubblici per assegnarne uno fisso a tutti.

È utile perché:

- riduce il numero di IP pubblici necessari
    
- permette agli host interni di uscire su Internet
    
- assegna un IP pubblico solo quando serve davvero
    

## COME FUNZIONA

L’idea è questa:

- molti host privati devono uscire su Internet
    
- il router ha a disposizione un **pool** di indirizzi pubblici
    
- quando un host interno deve comunicare fuori, il router gli assegna temporaneamente uno degli IP del pool
    
- finita la comunicazione, quell’indirizzo torna disponibile
    

Quindi il NAT dinamico fa una traduzione **non permanente**.

### Esempio logico

Se hai:

- rete privata: `10.0.0.0/24`
    
- pool pubblico: `40.30.20.10` → `40.30.20.15`
    

allora gli host della rete privata, quando escono, vengono tradotti usando uno di questi IP pubblici disponibili.

### Correzione importante

Non è corretto dire che con una rete privata da 1000 macchine servirebbero sempre 1000 IP pubblici.  
Con il NAT dinamico, ti basta un **pool più piccolo**, ma solo fino al numero massimo di connessioni/host che riesci a servire contemporaneamente con quel pool.

Quindi:

- se 5 IP pubblici sono sufficienti per 5 host attivi contemporaneamente, va bene
    
- se gli host attivi superano il pool, alcuni dovranno aspettare
    

---

## DIFFERENZE IMPORTANTI

### NAT dinamico vs NAT statico

- **NAT statico** = associazione fissa 1:1
    
- **NAT dinamico** = associazione temporanea presa da un pool
    

### NAT dinamico vs PAT

- **NAT dinamico** = un host usa uno degli IP del pool
    
- **PAT** = tanti host condividono un solo IP pubblico usando porte diverse
    

Questa distinzione è molto importante all’orale.

---

## COME SI CONFIGURA SUL ROUTER

Hai scritto bene l’idea generale: bisogna fare tre cose.

### 1. Definire il pool di indirizzi pubblici

```bash
ip nat pool test 40.30.20.10 40.30.20.15 netmask 255.255.255.0
```

Questo comando crea il pool chiamato `test`.

### 2. Definire chi può usare quel pool

Per fare questo si usa una **access list**:

```bash
access-list 10 permit 10.0.0.0 0.0.0.255
```

Qui stai dicendo quali host interni possono essere tradotti dal NAT dinamico.

### 3. Dire quali interfacce sono inside e outside

Esempio:

```bash
interface fastethernet0/0
 ip nat inside

interface fastethernet0/1
 ip nat outside
```

Poi si collega l’access list al pool:

```bash
ip nat inside source list 10 pool test
```

Questo significa:

- gli host autorizzati dalla lista 10
    
- quando escono dalla rete interna
    
- useranno gli indirizzi del pool `test`
    

---

## ESEMPIO COMPLETO

Supponiamo:

- rete interna: `10.0.0.0/24`
    
- pool pubblico: `40.30.20.10 - 40.30.20.15`
    

Quando il PC `10.0.0.25` esce su Internet:

- il router cerca un IP libero nel pool
    
- gli assegna temporaneamente, per esempio, `40.30.20.12`
    
- verso l’esterno, quel PC apparirà come `40.30.20.12`
    

Quando la connessione finisce:

- l’IP pubblico torna libero
    
- può essere riutilizzato da un altro host
    

---

## VERIFICA DELLE TRADUZIONI

Per controllare le traduzioni attive si usa:

```bash
show ip nat translations
```

Questo comando mostra quali indirizzi interni sono stati tradotti e con quale indirizzo pubblico.

---

## RIASSUNTO FINALE

Il NAT dinamico traduce gli IP privati in IP pubblici presi da un pool, ma solo quando serve.  
È una soluzione più flessibile del NAT statico e permette a molti host di condividere un numero minore di IP pubblici.  
Sul router bisogna configurare il pool, la access list e le interfacce inside/outside.  
La verifica si fa con `show ip nat translations`.

---

## DOMANDE POSSIBILI DA MATURITÀ

- Che differenza c’è tra **NAT statico e NAT dinamico**?
    
- Perché il NAT dinamico è più efficiente del NAT statico in una rete grande?
    
- Come si configura un NAT dinamico su un router Cisco?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: uso del pool di indirizzi pubblici, associazione temporanea, ruolo della access list, configurazione inside/outside, comando `show ip nat translations`.
    
- ⚠ Correzioni: il NAT dinamico non garantisce un IP pubblico fisso a ogni host; non è il provider che “mappa” nel router di casa, ma il router stesso che fa la traduzione; il problema non è solo il numero totale di host, ma soprattutto le connessioni contemporanee.
    
- ➕ Integrazioni utili: differenza tra NAT dinamico e PAT, significato del pool, relazione con la disponibilità limitata di IP pubblici.
    
- ❌ Non trattato: NAT overload/PAT in dettaglio, port forwarding, esempi con più reti interne.
    

[DA RICORDARE]

- concetto chiave: il NAT dinamico assegna agli host interni un IP pubblico preso da un pool, solo quando serve.
    
- errore comune: confonderlo con il NAT statico o pensare che ogni host abbia sempre lo stesso IP pubblico.
    
- collegamento utile: il NAT dinamico è la soluzione pratica quando una rete privata ha molti host ma pochi indirizzi pubblici disponibili.




il nat dinamico elimina la necessita di avere lo stesso numero di indirizzi interni ed esterni, se abbiamo una rete privata con 1000 macchine , usando il nat avremmo bisogno di 1000 indirizzi pubblici, ma non ha senso perche ogni tanto queste macchine navigheranno altre no. per questo utilizziamo un nat dinamico, quindi utilizziamo un indirizzo di pool piui piccoli, ad esempio da 40.30.30.10 al 15(5 indirizzi) per tutta la rete 10.0.0.0/24 quando esce cerca uno di questi indirizzi e fa l'ccesso alla rete pubblica per il tempo che il serve. di solito il natD è utilizzando insieme a natS, si tiene un pool di indirizzi da allocare dinamicamenet, e un pool di indirizzi che viene allocato staticamente al server che dovesse mai essere acceduto dall'esterno.
il provider ci mappa dinamicamnete.
bisogna fare 3 operazioni per settare nat dinamico:
 quale il pool di indirizzo pubblico che ho a disposizione(quello con cui le macchine usciranno da qua?)
chi puo usufruire di questi indirizzi?
e come al solito definire quali sono le interfacce private e quelle pubbliche e fare le varie associazioni delle porte con le varie access list
tutto cio va fatto sul router:
enable
conf t
ip nat pool test 40.30.20.10 40.30.20.15 netmask 255.255.255.0

access-list 10 permit 10.0.0.0 0.0.0.255(definiamo access list(quali sono le macchine che potranno essere mappate con questi indirizzi))

interface fastethernet0/0
ip nat inside (stabilisco se le varie interfacce sono dentro o fuori)
ip nat inside source list 10 pool test( diciamo che quel gruppo di host quando vogliono entrare nella rete pubblica satranno assegnati con gli indirizzi pubblici decisi del pool col nome test)

show ip nat translation
 




