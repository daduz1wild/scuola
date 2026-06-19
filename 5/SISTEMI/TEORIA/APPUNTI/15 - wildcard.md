## SPIEGAZIONE FINALE

Certo. La **wildcard mask** è uno dei concetti più difficili all’inizio, ma una volta capito bene diventa molto chiaro. Qui ti do una spiegazione unica, ordinata e adatta alla maturità.

---

# Wildcard mask

## COS’È

La **wildcard mask** è una maschera usata per **selezionare**, **filtrare** o **confrontare** indirizzi IP.

nella **wildcard mask** i bit a **0** devono corrispondere esattamente, mentre i bit a **1** vengono ignorati

La wildcard mask **non deve essere contigua**, permettendo di selezionare intervalli di IP non standard o pattern specifici

### Definizione da interrogazione

La wildcard mask viene usata nelle ACL e in alcuni protocolli di routing per stabilire quali bit di un indirizzo IP devono essere controllati e quali no.

---

## A COSA SERVE

Serve soprattutto per:

* **ACL**: filtrare pacchetti in base a IP sorgente o destinazione
* **routing**: per esempio in OSPF, per indicare quali indirizzi devono essere considerati

In pratica, la wildcard dice al router:

> “controlla questi bit, ignora questi altri”

---

## COME FUNZIONA

La regola è semplice:

* **bit 0** → deve combaciare
* **bit 1** → non interessa, può essere 0 oppure 1

Quindi la wildcard non “costruisce” la rete, ma **seleziona** gli indirizzi.

### Confronto con la subnet mask

La subnet mask divide l’IP in:

* parte rete
* parte host

La wildcard mask invece non divide la rete:
serve a dire **quali bit confrontare**.

---


## Wildcard mask

Esempio:

`0.0.0.255`

Binario:

`00000000.00000000.00000000.11111111`

Qui:

* i primi 24 bit devono essere uguali
* gli ultimi 8 possono cambiare

La wildcard mask serve quindi a **filtrare gli indirizzi**.

---

# Perché è l’inverso della subnet mask?

Perché si ottiene facendo:

**255 - subnet mask**

Esempio:

Subnet mask:
`255.255.255.248`

Wildcard mask:
`0.0.0.7`

Perché:

* 255 - 255 = 0
* 255 - 255 = 0
* 255 - 255 = 0
* 255 - 248 = 7

Quindi:

`255.255.255.248` → `0.0.0.7`

Questo è il metodo più rapido da usare negli esercizi.

---

# Perché i bit a 1 “non contano”?

Qui c’è spesso confusione.

Quando un bit della wildcard vale **1**, il router non lo confronta.

Quindi:

* **0** = confronta
* **1** = ignora

Non significa che quel bit sparisce, ma che **non partecipa al confronto**.

---

# Esempio molto chiaro

IP:

`172.16.0.5`

Wildcard:

`0.0.0.7`

L’ultimo ottetto in binario è:

* IP `.5` → `00000101`
* Wildcard `.7` → `00000111`

Questo significa:

* gli ultimi 3 bit possono cambiare
* i primi 5 devono restare uguali

Il range generato è:

`172.16.0.0 → 172.16.0.7`

Perché 7 significa proprio che puoi coprire **8 indirizzi**:

* da 0 a 7

Questa è una regola molto utile:

* wildcard `0.0.0.3` → blocco da 4
* wildcard `0.0.0.7` → blocco da 8
* wildcard `0.0.0.15` → blocco da 16

In generale:
**valore wildcard + 1 = grandezza del blocco**

---

# Esempio ACL classico

Se scrivi:

```bash
access-list 17 deny 172.16.0.0 0.0.0.255
```

stai dicendo:

* confronta i primi 24 bit
* ignora l’ultimo ottetto

Quindi blocchi:

`172.16.0.0 → 172.16.0.255`

Se invece vuoi permettere quell’intervallo:

```bash
access-list 17 permit 172.16.0.0 0.0.0.255
```

---

# Wildcard e subnet: differenza concettuale importante

| Subnet Mask        | Wildcard Mask                |
| ------------------ | ---------------------------- |
| costruisce la rete | seleziona indirizzi          |
| 1 = rete           | 0 = confronta                |
| 0 = host           | 1 = ignora                   |
| bit contigui       | può anche essere discontinua |

Questa ultima cosa è importante:

* la **subnet mask** deve avere bit contigui
* la **wildcard mask** può anche essere **discontinua**

Quindi una wildcard come `0.0.255.3` è legale nelle ACL, anche se non corrisponde a una subnet classica.

---

# Esempio con wildcard discontinua

## Wildcard: `0.0.255.3`

Questa wildcard dice:

* i primi due ottetti devono combaciare
* il terzo ottetto non importa
* nel quarto ottetto contano solo alcuni bit

Quindi può selezionare indirizzi come:

`172.16.x.4 → 172.16.x.7`

dove `x` può essere qualsiasi valore del terzo ottetto.

### Significato pratico

Puoi usare una wildcard del genere per prendere, per esempio, **tutti i dispositivi con IP che finiscono in .4, .5, .6, .7 in tutte le sottoreti**.

Questo è molto utile nelle ACL avanzate.

---

# Come si capisce il range

Ci sono due modi.

## Metodo 1: ragionamento veloce

Se la wildcard nell’ultimo ottetto è `7`, il blocco è di 8 indirizzi:

* 0-7
* 8-15
* 16-23
* ecc.

Quindi un IP come `.5` cade nel blocco:

`0-7`

---

## Metodo 2: calcolo con AND / OR

Per capire il range:

* **inizio** = IP AND NOT wildcard
* **fine** = IP OR wildcard

Esempio:

IP `.5` = `00000101`
Wildcard `.7` = `00000111`

Inizio:

* `00000101 AND 11111000 = 00000000`

Fine:

* `00000101 OR 00000111 = 00000111`

Quindi il range è:

`0 → 7`

---

# Perché è importante nelle ACL

Le ACL usano la wildcard per scrivere regole molto precise.

Per esempio:

```bash
access-list 17 permit 172.16.0.4 0.0.255.3
```

Questa regola permette:

* solo gli host che rientrano nel pattern indicato dalla wildcard
* tutti gli altri vengono gestiti dalle regole successive o dal deny implicito finale

Qui la wildcard non sta dicendo “questa è una rete”, ma:

> “questi bit devono combaciare, questi altri no”

---

# OSPF e wildcard

La wildcard si usa anche in alcuni protocolli di routing, per esempio **OSPF**, quando bisogna indicare quali indirizzi includere in un’area o in una configurazione.

Quindi non è solo un concetto da ACL: è più generale.

---

# RIASSUNTO FINALE

La wildcard mask è il contrario logico della subnet mask.
Nella wildcard, 0 significa “controlla” e 1 significa “ignora”.
Si usa soprattutto nelle ACL e in alcuni protocolli di routing.
Si calcola spesso con `255 - subnet mask`.
A differenza della subnet mask, può anche essere discontinua.

---

# DOMANDE POSSIBILI DA MATURITÀ

* Che differenza c’è tra **subnet mask e wildcard mask**?
* Come si calcola una wildcard mask partendo dalla subnet mask?
* Perché la wildcard mask è utile nelle **ACL**?
* Cosa significa che nella wildcard un bit a 1 viene ignorato?
* Perché la wildcard può essere discontinua mentre la subnet mask no?

---

[CONTROLLO STUDIO]

* ✔ Corretto: wildcard come maschera di selezione, bit 0 confronta e bit 1 ignora, inverso della subnet mask, formula `255 - subnet mask`, uso in ACL e routing, possibilità di wildcard discontinua.
* ⚠ Correzioni: la wildcard non divide rete e host come la subnet mask; non è vero che i bit a 1 “non esistono”, semplicemente non vengono confrontati; la subnet mask deve essere contigua, la wildcard no.
* ➕ Integrazioni utili: metodo rapido del blocco (`n+1`), calcolo range con AND/OR, esempio con `0.0.255.3`, collegamento con ACL e OSPF.
* ❌ Non trattato: configurazioni OSPF complete, esercizi con wildcard su più sottoreti, casi avanzati di ACL named.

[DA RICORDARE]

* concetto chiave: wildcard mask = filtro; subnet mask = costruzione della rete.
* errore comune: confondere wildcard e subnet mask o usare una mask normale al posto della wildcard nelle ACL.
* collegamento utile: capire bene la wildcard è fondamentale per non sbagliare le ACL standard ed estese.

Sì, c’è una regola precisa: **conta quali bit possono cambiare e quali no nell’IP BASE**.

La cosa che ti sta confondendo è questa:

- con `0.0.0.7` l’IP `.5` “cade” nel blocco `0-7`
    
- con `0.0.255.3` l’IP `.4` “cade” nel blocco `4-7`
    

Vediamolo bene.

---

# Regola fondamentale

La wildcard NON dice “parti da questo numero”.

Dice:

> “Questi bit possono cambiare.”

Il risultato dipende quindi dai bit fissi dell’IP base.

---

# CASO 1 — wildcard `.7`

Hai:

```text
IP:       .5  = 00000101
Wildcard: .7  = 00000111
```

La wildcard permette di cambiare gli ultimi 3 bit:

```text
00000 xxx
```

Ma i primi 5 bit devono restare uguali:

```text
00000
```

Ora guarda bene:

```text
00000101
^^^^^
```

I primi 5 bit sono:

```text
00000
```

Quindi puoi generare:

```text
00000000 = 0
00000001 = 1
00000010 = 2
...
00000111 = 7
```

Perciò:

```text
range = 0 → 7
```

---

# CASO 2 — wildcard `.3`

Hai:

```text
IP:       .4 = 00000100
Wildcard: .3 = 00000011
```

La wildcard permette di cambiare SOLO gli ultimi 2 bit:

```text
000001 xx
```

I primi 6 bit devono restare uguali:

```text
000001
```

Quindi ottieni:

```text
00000100 = 4
00000101 = 5
00000110 = 6
00000111 = 7
```

Perciò:

```text
range = 4 → 7
```

---

# La vera regola matematica

Il blocco è:

```text
wildcard + 1
```

MA il punto di partenza dipende dai bit fissi dell’IP.

In pratica:

```text
inizio = IP con i bit wildcard messi a 0
fine    = IP con i bit wildcard messi a 1
```

---

# Applichiamola

## Esempio `.5` con wildcard `.7`

```text
IP        00000101
Wildcard  00000111
```

Metti i bit wildcard a 0:

```text
00000000 = 0
```

Metti i bit wildcard a 1:

```text
00000111 = 7
```

→ `0-7`

---

## Esempio `.4` con wildcard `.3`

```text
IP        00000100
Wildcard  00000011
```

Bit wildcard a 0:

```text
00000100 = 4
```

Bit wildcard a 1:

```text
00000111 = 7
```

→ `4-7`

---

# Metodo veloce da usare agli esami

1. Trasforma in binario
    
2. Dove la wildcard ha `1`:
    
    - puoi cambiare i bit
        
3. Per trovare l’inizio:
    
    - metti quei bit a `0`
        
4. Per trovare la fine:
    
    - metti quei bit a `1`
        

Questa è la regola esatta.

---
---
---


# 🔹 DEFINIZIONE PERFETTA DA VERIFICA

> **La wildcard mask è una maschera utilizzata per selezionare o filtrare un insieme di indirizzi IP. 
> i bit a 0 devono corrispondere esattamente, mentre i bit a 1 vengono ignorati.**

Oppure ancora più tecnica:

> **La wildcard mask viene utilizzata nei meccanismi di filtraggio (ACL) e nei protocolli di routing per specificare quali bit di un indirizzo IP devono essere controllati e quali no.**

Se dici questo in verifica → voto alto.

---

# 🔹 PERCHÉ SI CALCOLA CON 255 − SUBNET MASK?

Perché è il **complemento bit a bit**.

Esempio:

Subnet:

```
255.255.255.248
11111111.11111111.11111111.11111000
```

Wildcard:

```
00000000.00000000.00000000.00000111
= 0.0.0.7
```

Ogni bit viene invertito:

- Dove la subnet ha 1 → wildcard ha 0
    
- Dove la subnet ha 0 → wildcard ha 1
    

Per questo si dice che è “inversa”.

---

# 🔹 PERCHÉ I BIT A 1 “NON CONTANO”?

Questa è la parte che crea confusione.

Quando la wildcard ha un bit a 1 significa:

> “Non confrontare questo bit.”

Tecnicamente il router fa questo controllo:

```
(IP address) AND (NOT wildcard)
```

Oppure più intuitivo:

- Se wildcard = 0 → il bit deve coincidere
    
- Se wildcard = 1 → quel bit viene ignorato
    

Non è che “non contano” matematicamente.

È che:  
👉 **non partecipano al confronto**


## Calcolo per 172.16.0.5 con Wildcard 0.0.255.3

## N.B "Non esiste una Subnet Mask valida per questa Wildcard, poiché la Wildcard in questione è discontinua e le Subnet Mask devono per definizione essere composte da bit contigui."

## La Wildcard 0.0.255.3 è perfettamente legale in una Access List. Serve a dire al router: "Controlla i primi due ottetti, ignora tutto il terzo ottetto, e controlla solo gli ultimi bit del quarto".

## Comunque calcoliamo ugualmente, per vedere come sarebbe, la Subnet Mask con Wild Card 0.0.0.3

## Sottraiamo ogni ottetto della Wildcard da 255:

1. ## 255 - 0 = 255
    
2. ## 255 - 0 = 255
    
3. ## 255 - 255 = 0
    
4. ## 255 - 3 = 252
    

## Risultato: La Subnet Mask è 255.255.0.252.

La Wildcard Mask funziona al contrario della SubnetMask:

- **Bit a 0:** "Deve corrispondere" (bloccato).
    
- **Bit a 1:** "Non mi interessa" (variabile).
    

### **1. Trasformazione in Binario (ultimi due ottetti)**

Analizziamo il terzo e il quarto ottetto, dove la wildcard agisce:

- **IP (.0.5):** 00000000 . 00000101
    
- **Wildcard (.255.3):** 11111111 . **000000**11 ("Wildcard discontinua")
    

**Nota:** Il terzo ottetto della wildcard ha tutti 1 (255), quindi l'intero terzo numero dell'IP è variabile. Nel quarto ottetto, solo gli ultimi due bit sono variabili.

  
  

### **2. Calcolo dell'Inizio Range (L'indirizzo base)**

Si usa l'operazione: **IP AND (NOT Wildcard)**.

_Il "NOT Wildcard" trasforma la wildcard in una maschera normale (255.255.0.252)._

   
|**Descrizione**|**Ottetto 3**|**Ottetto 4**|**Decimale**|
|---|---|---|---|
|**IP originale**|00000000|00000101|.0.5|
|**NOT Wildcard**|00000000|11111100|.0.252|
|**RISULTATO (AND)**|00000000|00000100|**.0.4**|

**Inizio del range:**172.16.x.4 (dove x vale : 0,1,2,3….,255)

  
  

### **3. Calcolo della Fine Range**

  
  

Si usa l'operazione: **IP OR Wildcard**.

_(Qui NON devi usare l'inverso, ma la wildcard pura)._

   
|**Descrizione**|**Ottetto 3**|**Ottetto 4**|**Decimale**|
|---|---|---|---|
|**IP originale**|00000000|00000101|.0.5|
|**Wildcard Mask**|11111111|00000011|.255.3|
|**RISULTATO (OR)**|11111111|00000111|**.255.7**|

**Fine del range:**172.16.x.7 (dove x vale : 0,1,2,3….,255)

### **4. Il Risultato Finale (La correzione)**

Con la combinazione 172.16.0.5 e wildcard 0.0.255.3, si e’ selezionato un range che va da **172.16.0.4** a **172.16.255.7**.

A questo range appartengono pero’ solo i seguenti indirizzi :

1. 172.16.0.4 fino a 172.16.0.7 (4 indirizzi)
    
2. 172.16.1.4 fino a 172.16.1.7 (altri 4 indirizzi)
    
3. ... e così via per tutti i 256 valori possibili del terzo ottetto.
    

**Totale indirizzi selezionati:** 256 * 4 = 1024.

Cioe’ : 172.16.XXX.4-7

**Utilità Pratica**

Wildcard : 0.0.255.3

- **Esempio Reale:** Se in una azienda ogni sottorete (172.16.**1**.x, 172.16.**2**.x, ecc.) ha la stessa struttura e gli indirizzi **.4, .5, .6, .7** sono sempre assegnati ai **controller delle stampanti**, con questa singola riga di comando, si puo’ applicare una regola di sicurezza a **tutte le stampanti di tutti i reparti** in un colpo solo, ignorando i PC e i server che hanno altri IP, oppure per permettere solo a quei dispositivi di navigare, in questo caso i comandi sarebbero:
    

Entrare in configurazione

**configure terminal**

Creazione dell'ACL 17

N.B.: controlla solo la SORGENTE. La destinazione è automaticamente "any"

**access-list 17 permit 172.16.0.4 0.0.255.3**

  

**ANY = Destinazione: Qualsiasi indirizzo IP nel mondo (Internet, altri server, altre reti).**

Applicazione all'interfaccia core

**interface GigabitEthernet 0/1**

**ip access-group 17 in (in: Il router controlla i pacchetti mentre entrano nell'interfaccia prima di decidere dove mandarli).**




## ESERCIZI WILDCARD

**Regole da ricordare prima di iniziare:**

- **Bit 0 (Zero):** Il router deve controllare che il bit sia identico.
    
- **Bit 1 (Uno):** Al router non importa cosa c'è sotto, lo ignora.
    
- **Wildcard = 255 - Subnet Mask.**
    

  

**SFIDA 1: "Isolamento"**

- **Problema:** Lo studente dell'IP 192.168.10.45 sta lanciando un attacco **DDoS**(**L'obiettivo:** Mandare in tilt un server, un sito web o una rete inondandoli di traffico inutile.
    

**Il metodo:** L'attacco non parte da un solo computer, ma da migliaia di dispositivi infetti (chiamati **Botnet** o "computer zombie") sparsi per il mondo.

**Il risultato:** Le risorse del bersaglio (CPU, memoria o banda larga) si esauriscono, rendendo il servizio **irraggiungibile** per gli utenti legittimi

È un attacco di "forza bruta" che punta a bloccare l'operatività, non necessariamente a rubare dati.)

contro il server della scuola. Devi "bannare" solo lui all'istante, senza disturbare il resto della classe.

  

  

  

  

  

  

  

  

**SFIDA 2: "Il Laboratorio VIP"**

**Problema:** Il Preside vuole creare un laboratorio "VIP" per i primi 8 indirizzi della rete 10.0.0.0. Solo loro possono accedere alla rete dei professori.

  

  

  

  

  

  

  

  

  

  

**SFIDA 3: "Il Filtro"**

**Problema:** In azienda ci sono due piani.

- Piano 1: 172.16.1.x
    
- Piano 2: 172.16.2.x
    

Vogliamo creare una regola che colpisca contemporaneamente **solo gli IP .10** di entrambi i piani (es. le stampanti di rete che sono state configurate tutte con lo stesso finale).

  

  

  

  

  

  

  

**Regole da ricordare prima di iniziare:**

- **Bit 0 (Zero):** Il router deve controllare che il bit sia identico.
    
- **Bit 1 (Uno):** Al router non importa cosa c'è sotto, lo ignora.
    
- **Wildcard = 255 - Subnet Mask.**
    

**SFIDA 1: "Isolamento"**

- **Problema:** Lo studente dell'IP 192.168.10.45 sta lanciando un attacco **DDoS**(**L'obiettivo:** Mandare in tilt un server, un sito web o una rete inondandoli di traffico inutile.
    

**Il metodo:** L'attacco non parte da un solo computer, ma da migliaia di dispositivi infetti (chiamati **Botnet** o "computer zombie") sparsi per il mondo.

**Il risultato:** Le risorse del bersaglio (CPU, memoria o banda larga) si esauriscono, rendendo il servizio **irraggiungibile** per gli utenti legittimi

È un attacco di "forza bruta" che punta a bloccare l'operatività, non necessariamente a rubare dati.)

contro il server della scuola. Devi "bannare" solo lui all'istante, senza disturbare il resto della classe.

  

  

  

- **La Logica:** Dobbiamo dire al router di controllare ogni singolo bit dell'indirizzo. Non deve esserci spazio per l'immaginazione.
    
- **La Maschera:** Usiamo la **Wildcard 0.0.0.0** (nota anche come maschera di host).
    
- **Wildcard 0.0.0.0(**Significa "tutti i bit devono corrispondere esattamente". Il router non può ignorare nemmeno un numero.) = Subnet**255.255.255.255** Indica un unico, singolo indirizzo IP. Non c'è spazio per altri host, è solo "quel" computer specifico.
    
- **Wildcard 255.255.255.255** = Subnet **0.0.0.0** (Tutto il mondo, ovvero any).
    
- **Il Comando:**
    

  

access-list 10 deny 192.168.10.45 0.0.0.0

access-list 10 permit any

(Permette a tutti gli altri di accedere (altrimenti si bloccherebbe tutto il router!)  in poche parole quando arriva un pacchetto da un altro IP (es. 192.168.10.50), la prima riga non corrisponde. Il router passa alla seconda, vede **permit any** e lo lascia passare.)

- **Perché funziona?** Ogni 0 nella wildcard dice: "Questo ottetto deve corrispondere esattamente". 0.0.0.0 significa: "Tutti i 32 bit devono essere UGUALI a quelli che ho scritto".
    

**SFIDA 2: "Il Laboratorio VIP"**

**Problema:** Il Preside vuole creare un laboratorio "VIP" per i primi 8 indirizzi della rete 10.0.0.0. Solo loro possono accedere alla rete dei professori.

  

  

- **Il Calcolo (Metodo Smart):** Un blocco da 8 indirizzi?
    
    1. Prendi la dimensione del blocco (8).
        
    2. Sottrai 1 (perché contiamo anche lo zero): 8 - 1 = 7.
        
    3. La tua Wildcard finale è **0.0.0.7**.
        
- **La Logica Binaria:** .7 in binario è 00000111. Gli ultimi 3 bit sono variabili (permettono di contare da 0 a 7), i primi 29 sono bloccati.
    
- **Il Comando:**
    

  

access-list 20 permit 10.0.0.0 0.0.0.7

- **Cosa vede il router?** Accetterà gli IP da 10.0.0.0 a 10.0.0.7. L'IP 10.0.0.8 verrà già bloccato perché non rientra nel "permesso" dei primi 3 bit variabili.
    

  

  

**SFIDA 3: "Il Filtro"**

**Problema:** In azienda ci sono due piani.

- Piano 1: 172.16.1.x
    
- Piano 2: 172.16.2.x
    

Vogliamo creare una regola che colpisca contemporaneamente **solo gli IP .10** di entrambi i piani (es. le stampanti di rete che sono state configurate tutte con lo stesso finale).

  

  

- **La Logica:** Dobbiamo "bloccare" il primo, il secondo e il quarto ottetto, ma lasciare che il terzo (quello dei piani) sia variabile.
    
- **La Maschera:**
    
    - 172 (fisso) 0
        
    - 16 (fisso) 0
        
    - Piano (variabile) **255**
        
    - .10 (fisso) 0
        
    - **Risultato:** 

- **Il Comando:**
    

access-list 30 permit 172.16.0.10 0.0.255.0

- **Il Risultato Finale:** Questa riga "pesca" il .10 da 172.16.1.10, 172.16.2.10, 172.16.3.10... fino a 255.10! Abbiamo creato un filtro "verticale" che attraversa tutte le sottoreti.
    

  

  

_Con una Wildcard 0.0.0.255, sto filtrando un singolo PC, una sottorete o l'intera WAN?"_

Ovviamente "una sottorete"