## SPIEGAZIONE FINALE

Certo. La **wildcard mask** è uno dei concetti più difficili all’inizio, ma una volta capito bene diventa molto chiaro. Qui ti do una spiegazione unica, ordinata e adatta alla maturità.

---

# Wildcard mask

## COS’È

La **wildcard mask** è una maschera usata per **selezionare**, **filtrare** o **confrontare** indirizzi IP.

È l’opposto logico della subnet mask:

* nella **subnet mask** i bit a **1** indicano la parte di rete
* nella **wildcard mask** i bit a **0** devono corrispondere esattamente, mentre i bit a **1** vengono ignorati

Questa è la frase chiave da ricordare.

### Definizione da interrogazione

La wildcard mask è l’inverso logico della subnet mask e viene usata nelle ACL e in alcuni protocolli di routing per stabilire quali bit di un indirizzo IP devono essere controllati e quali no.

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

# Subnet mask e wildcard mask a confronto

## Subnet mask

Esempio:

`255.255.255.0`

Binario:

`11111111.11111111.11111111.00000000`

Qui:

* i primi 24 bit sono rete
* gli ultimi 8 bit sono host

La subnet mask serve quindi a **costruire la rete**.

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



---
---
---


# 🔹 DEFINIZIONE PERFETTA DA VERIFICA

> **La wildcard mask è una maschera utilizzata per selezionare o filtrare un insieme di indirizzi IP.  
> A differenza della subnet mask, funziona in modo inverso:  
> i bit a 0 devono corrispondere esattamente, mentre i bit a 1 vengono ignorati.**

Oppure ancora più tecnica:

> **La wildcard mask è l’inverso logico della subnet mask e viene utilizzata nei meccanismi di filtraggio (ACL) e nei protocolli di routing per specificare quali bit di un indirizzo IP devono essere controllati e quali no.**

Se dici questo in verifica → voto alto.

---

# 🔹 PERCHÉ FUNZIONA AL CONTRARIO DELLA SUBNET MASK?

## 🔹 SUBNET MASK

Scopo: **dividere rete e host**

Logica:

|Bit|Significato|
|---|---|
|1|Parte di rete|
|0|Parte host|

Esempio:

```
255.255.255.0
11111111.11111111.11111111.00000000
```

Qui:

- I primi 24 bit identificano la rete
    
- Gli ultimi 8 sono host
    

La subnet mask **costruisce la rete**.

---

## 🔹 WILDCARD MASK

Scopo: **filtrare indirizzi**

Logica inversa:

|Bit|Significato|
|---|---|
|0|Deve essere uguale|
|1|Non interessa (può variare)|

Esempio:

```
0.0.0.255
00000000.00000000.00000000.11111111
```

Qui:

- I primi 24 bit devono essere identici
    
- Gli ultimi 8 possono essere qualsiasi valore
    

La wildcard mask **non divide rete/host**, ma dice al router cosa controllare.

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

---

# 🔹 ESEMPIO BINARIO (CHIARISSIMO)

IP:

```
172.16.0.5
```

Wildcard:

```
0.0.0.7
```

Ultimo ottetto in binario:

IP:

```
00000101
```

Wildcard:

```
00000111
```

Significa:

- Gli ultimi 3 bit possono cambiare
    
- I primi 5 devono restare uguali
    

Range generato:

```
172.16.0.0 → 172.16.0.7
```

Perché:

```
2^3 = 8 indirizzi
```

---

# 🔹 DIFFERENZA CONCETTUALE IMPORTANTISSIMA

|Subnet Mask|Wildcard Mask|
|---|---|
|Costruisce reti|Seleziona indirizzi|
|1 = rete|0 = confronto|
|0 = host|1 = ignora|
|Serve per subnetting|Serve per ACL e routing|

---

# 🔹 PERCHÉ VIENE USATA NELLE ACL?

Esempio ACL:

```
access-list 17 deny 172.16.0.0 0.0.0.255
```

Significa:

- Controlla che i primi 24 bit siano 172.16.0
    
- Ignora l’ultimo ottetto
    

Risultato:

```
Blocca 172.16.0.0 → 172.16.0.255
```

Alla fine c’è sempre:

```
deny any (implicito)
```

---

# 🔹 FRASE PERFETTA DA INTERROGAZIONE

Se il prof chiede:

❓ Perché la wildcard è l’inverso della subnet?

Rispondi:

> Perché mentre la subnet mask identifica quali bit appartengono alla rete, la wildcard mask indica quali bit devono essere confrontati e quali ignorati durante un’operazione di filtraggio.

---

# 🔹 CONCETTO FINALE CHE TI SBLOCCA TUTTO

Subnet mask → **crea la rete**  
Wildcard mask → **filtra la rete**

Una costruisce.  
L’altra seleziona.

---

Se vuoi, nel prossimo messaggio ti faccio:

- un esercizio misto subnet + wildcard
    
- oppure ti spiego perché OSPF usa la wildcard invece della subnet mask
    
- oppure simuliamo un’interrogazione vera con domande trabocchetto
    

Dimmi tu. 💪



**Titolo:** Subnet Mask vs Wildcard Mask

**Sottotitolo:** Guida pratica alla segmentazione e al filtraggio delle reti

**Che cos'è la SubnetMask?**

**Obiettivo:** Definire i confini della rete.

- **Definizione:** Una sequenza di 32 bit che separa l'indirizzo IP in due parti: **Network** (Rete) e **Host** (Dispositivo).
    
- **Logica dei bit:**
    
    - **Bit a 1:** Indica la porzione di Rete.
        
    - **Bit a 0:** Indica la porzione di Host.
        
- **Caratteristica:** I bit "1" devono essere sempre **contigui** (es. 255.255.255.0).
    
- **Uso principale:** Configurazione interfacce IP e tabelle di routing.
    

In termini pratici, la subnetmask è lo strumento che permette a un dispositivo di capire se l'interlocutore si trova nel suo stesso "giro di amici" (la rete locale) o se deve chiedere aiuto a un "postino" (il gateway) per spedire il messaggio all'esterno.

### **Il "confine" tra Rete e Host**

Ogni indirizzo IPv4 è composto da 32 bit. La subnetmask serve a tracciare una linea verticale in questi 32 bit:

- Tutto ciò che sta a **sinistra** della linea identifica la **rete**.
    
- Tutto ciò che sta a **destra** identifica lo specifico **dispositivo (host)**.
    

### **L'operazione logica: L'AND Binario**

Quando un computer vuole inviare un pacchetto a un indirizzo IP di destinazione, il sistema operativo esegue un'operazione matematica chiamata **AND bit a bit**.

1. Prende il proprio indirizzo IP e lo confronta con la propria SubnetMask per ottenere l'ID della propria rete.
    
2. Prende l'indirizzo IP di destinazione e lo confronta con la stessa SubnetMask.
    
3. **Confronta i risultati:**
    
    - **Risultati uguali:** La destinazione è **interna** (locale). Il pacchetto viene inviato direttamente tramite l'indirizzo MAC (Layer 2).
        
    - **Risultati diversi:** La destinazione è **esterna** (remota). Il computer non sa come arrivarci, quindi invia il pacchetto al **Default Gateway** (il router), che si occuperà di instradarlo su internet.
        

Il **Sistema Operativo** (nello specifico, il "TCP/IP Stack" all'interno del kernel) sioccupa di questi calcoli

  
  

### **Un esempio pratico**

Immaginiamo che il tuo computer abbia l'IP 192.168.1.5 con mask255.255.255.0

|   |   |   |   |
|---|---|---|---|
   
|**Destinazione**|**Calcolo con Mask**|**Risultato**|**Destinazione**|
|**192.168.1.20(mittente)**|192.168.1.20 AND 255.255.255.0|192.168.1.0|**Interna** (Stessa rete)|
|**8.8.8.8 (destintario)**|8.8.8.8 AND 255.255.255.0|8.8.8.0|**Esterna** (Vai al Gateway)|

**Nota:** Senza la subnetmask, il computer non saprebbe dove finisce il "nome della via" e dove inizia il "numero civico", rendendo impossibile capire se il destinatario è un vicino di casa o qualcuno che vive in un'altra città.

### **Le funzioni del Sistema Operativo**

Fasi operative per l’ esempio visto :

Quando il mio pc 192.168.1.20/24 vuole accedere al DNS di google (8.8.8.8) il Sistema Operativo fa questo:

1. **Controlla la maschera:** Esegue l'operazione di AND (come abbiamo visto prima) e capisce che l'IP di Google è fuori dalla LAN.
    
2. **Consulta la Tabella di Routing:** Cerca il "Default Gateway" (l'indirizzo del router).
    
3. **Risoluzione ARP:** Se non lo ha già in memoria cache, il PC chiede: _"Chi ha l'IP del router? Mi serve il suo indirizzo fisico (MAC)!"_.
    

**Anatomia del pacchetto (Il trucco del "doppio indirizzo")**

Quando il pacchetto deve uscire dalla LAN, gli indirizzi vengono gestiti a due livelli diversi:

#### **Livello 3 (Network) - L'indirizzo IP**

L'indirizzo IP di destinazione **non cambia mai** (fino a destinazione). Indica la meta finale.

- **Source IP:** Il tuo PC (es. 192.168.1.5)
    
- **Destination IP:** Il server remoto (es. 8.8.8.8)
    

#### **Livello 2 (Data Link) - L'indirizzo MAC**

L'indirizzo MAC indica chi deve ricevere fisicamente il pacchetto nel **prossimo salto**.

- **Source MAC:** La tua scheda di rete (es. AA:BB:CC...)
    
- **Destination MAC:** La scheda di rete del **ROUTER** (es. 11:22:33...)
    

|   |   |   |
|---|---|---|
  
|**Strato**|**Intestazione**|**Valore**|
|**Frame (L2)**|**MAC Mittente**|**MAC del Router** (Gateway)|
|**Pacchetto (L3)**|**IP Mittente**|**IP del Server Remoto**(indirizzo iniziale)|

  
  

### **Cosa succede quando il router riceve il pacchetto?**

Il router riceve il frame perché ha visto il suo indirizzo MAC. Lo "scarta" (come se aprisse una scatola), guarda l'IP di destinazione finale e dice: _"Ah, questo non è per me, è per Google!"_.

A quel punto il router:

1. **Cambia il MAC di origine** con il proprio.
    
2. **Cambia il MAC di destinazione** con quello del prossimo router (hop) sulla via per Google.
    
3. **Lascia invariato l'IP di destinazione** (8.8.8.8).
    

Poiche’ il MAC address serve **solo** per la consegna "porta a porta" dentro lo stesso segmento di rete. Un MAC address non può viaggiare oltre il router.

Quindi quando il pacchetto arriva al router:

1. **Ricezione:** Il router riceve il frame Ethernet perché il MAC di destinazione era il suo.
    
2. **Sballaggio (Decapsulamento):** Il router "strappa via" l'intestazione Ethernet (Livello 2). Adesso ha in mano solo il pacchetto IP.
    
3. **Controllo IP:** Guarda l'IP di destinazione. Dice: _"Ok, devo mandarlo a Google"_.
    
4. **Re-impacchettamento (Encapsulamento):**per mandare il pacchetto verso il prossimo router (quello del tuo fornitore internet), il router deve creare un **nuovo frame Ethernet**.
    
    - Il **MAC di origine** diventa quello della porta "esterna" del router.
        
    - Il **MAC di destinazione** diventa quello del router dell'ISP (ottenuto di nuovo tramite ARP).
        

**In sintesi:** Per uscire dalla LAN, il PC "traveste" il pacchetto indirizzandolo fisicamente al router (MAC), ma mantenendo l'indirizzo logico finale (IP) del destinatario remoto.

**Che cos'è la Wildcard Mask?**

**Obiettivo:** Agisce come un filtro (Filtro "Inverso").

- **Definizione:** Utilizzata per selezionare un intervallo di indirizzi IP (spesso usata in ACL (Access Control List) e negli algoritmi di routing ad es.OSPF (Open Shortest Path First) è uno dei protocolli di routing più utilizzati al mondo, specialmente all'interno di reti aziendali di grandi dimensioni).
    
- **Logica dei bit (Inversa):**
    
    - **Bit a 0 (Match):** Il bit dell'IP deve corrispondere esattamente.
        
    - **Bit a 1 (Ignore):** Il bit dell'IP può essere qualsiasi cosa (0 o 1).
        
- **Flessibilità:** Non deve necessariamente avere bit contigui (anche se lo è nel 99% dei casi).
    

**Confronto Rapido**

|   |   |   |
|---|---|---|
  
|**Caratteristica**|**SubnetMask**|**Wildcard Mask**|
|**Scopo**|Identifica la rete|Filtra/Seleziona traffico|
|**Bit 1**|Identifica la Rete|"Non interessa" (Ignora)|

  
  

  
  

**Esempio Pratico 1 (Rete 192.168.1.x)**

**Scenario:** Applichiamo la maschera 0.0.0.255 all'IP 192.168.1.9

1. **Analisi Maschera:** I primi 3 ottetti sono 0, l'ultimo è 255.
    
2. **Azione:** Il router controlla che l'IP inizi con 192.168.1. L'ultimo numero (.9) viene ignorato.
    
3. **Risultato:** La regola colpisce **tutti** gli indirizzi da 192.168.1.0 a 192.168.1.255.
    
4. **Conclusione:** Il valore originale .9 viene "sovrascritto" dalla libertà concessa dal 255.
    

**Esempio Pratico 2 (Rete 172.16.0.x)**

**Scenario:** Applichiamo la maschera 0.0.0.255 all'IP 172.16.0.5 con subnet 255.255.255.0

### **Il Calcolo "Bit a Bit"**

- **172**-- > Wildcard **0**: Deve essere esattamente **172**.
    
- **16**-- > Wildcard **0**: Deve essere esattamente **16**.
    
- **0**-- > Wildcard **0**: Deve essere esattamente **0**.
    
- **5**-- > Wildcard **255**: **IGNORA**. Può essere qualsiasi numero da 0 a 255.
    

### **Il Risultato (Il Range)**

Applicando questa maschera, il sistema "accetta" tutti gli indirizzi che iniziano con **172.16.0.0**, indipendentemente da cosa succede nell’ ultimo blocco.

- **IP Sorgente:** 172.16.0.5
    
- **Wildcard:** 0.0.0.255
    
- **Cosa vede il router:** 172.16.0.[QUALSIASI COSA]
    
- **Primo IP utile:**172.16.0.0
    
- **Ultimo IP utile:**172.16.0.255
    
- **Totale indirizzi selezionati:**256 indirizzi IP.
    

1. **Analisi Maschera:** Stessa logica, i primi tre pezzi devono essere identici.
    
2. **Azione:** Il router cerca corrispondenza per 172.16.0. L’ ultimo numero (.5) viene ignorato
    
3. **Risultato:** Viene selezionato l'intero range 172.16.0.0 - 172.16.0.255
    
4. **Utilità:** Utile per bloccare o permettere un intero ufficio con un'unica riga di comando.
    
    1. **Bloccare la navigazione all'ufficio (deny)**
        

Entrare in configurazione

**configure terminal**

Creare una lista di accesso (es. numero 17) (Sorgente: 172.16.0.0/24)

**access-list 17 deny 172.16.0.0 0.0.0.255**

Permettere tutto il resto (altrimenti bloccheresti tutto il router!)

**access-list 17 permit any**

**2. Permettere la navigazione all'ufficio (permit)**

Entra in configurazione

**configure terminal**

  

Crea la lista di accesso

**access-list 17 permit 172.16.0.0 0.0.0.255**

  

**N.B. alla fine di ogni ACL c'è un "deny any" invisibile.** **ANY = Destinazione: Qualsiasi indirizzo IP nel mondo (Internet, altri server, altre reti).**

**Se si crea una lista per permettere solo l'ufficio, tutto il resto del mondo sarà bloccato automaticamente finché non aggiungi un permit any alla fine.**

**Come calcolarla velocemente?**

**La regola del 255:**

Per trovare la Wildcard Mask partendo dalla SubnetMask, basta sottrarre ogni ottetto da 255.

**Esempio:**

- SubnetMask: 255.255.255.248 (/29)
    
- Calcolo: (255-255) . (255-255) . (255-255) . (255-248)
    
- **Wildcard Mask:** 0.0.0.7
    

**Conclusioni**

- La **SubnetMask** serve a "costruire" la rete.
    
- La **Wildcard Mask** serve a "gestire" il traffico (chi passa e chi no).
    
- **0 = Uguale, 255 = Qualunque**.
    

### **Il Calcolo per 172.16.0.5 con Wildcard 0.0.0.7 e Subnetmask 255.255.255.248**

Per capire il risultato, dobbiamo guardare l’ ultimo numero (**.5**) in codice binario, perché la Wildcard agisce sui singoli bit.

**Trasformazione in Binario**

- **Ultimo ottetto IP (.5):** 00000101
    
- **Wildcard Mask (.7):** 00000111 (Gli ultimi due bit sono "1", quindi "non mi interessa cosa c'è lì")
    

### _**Il trucco per i conti rapidi**_

Se vuoi sapere l'inizio e la fine dell'intervallo matematicamente:

- **Inizio:** IP originale AND (Inverso della Wildcard).
    
- **Fine:** IP originale OR Wildcard.
    

#### **Calcolo dell'Inizio Range (AND NOT)**

Per trovare l'inizio, dobbiamo invertire i bit indicati dalla wildcard:

.00000101 (IP .5)

AND .11111000 (Inverso della Wildcard .7)

-----------

.00000000 (Risultato: .0)

**Inizio del range: 172.16.0.0**

#### **Calcolo del Fine Range (OR)**

Facciamo l'operazione logica **OR** tra l'IP e la Wildcard:

.00000101 (IP.5)

OR .00000111 (.7)

-----------

.00000111 (Risultato: .7)

**Fine del range: 172.16.0.7**

  
  

### _**Il Risultato Finale**_

Con la combinazione 172.16.0.5 e wildcard 0.0.0.7, abbiamo selezionato un "pacchetto" di **8 indirizzi**:

1. **172.16.0.0 (rete)**
    
2. **172.16.0.1**
    
3. **172.16.0.2**
    
4. **172.16.0.3**
    
5. **172.16.0.4**
    
6. **172.16.0.5** (Quello da cui siamo partito)
    
7. **172.16.0.6**
    
8. **172.16.0.7(broadcast)**
    

### **A cosa serve una maschera così piccola?**

In rete, una wildcard 0.0.0.7 corrisponde a una SubnetMask/29 ( 255.255.255.248). Si usa principalmente per:

- **Gestire un** **piccolo gruppo di server**
    
- **Gestire una zona DMZ** dove ci sono, ad esempio, un firewall, un router e un paio di server pubblici.
    

### **La regola del "Blocco"**

Un trucco rapido senza fare i binari:

La Wildcard ti dice quanto è grande il blocco.

- 0.0.0.3 significa: **Blocco di 4**( 3 + 1 ).
    
- 0.0.0.7 significa: **Blocco di 8**( 7 + 1 ).
    
- 0.0.0.15 significa: **Blocco di 16**( 15 + 1 ).
    

Il router prenderà l'IP che gli hai dato e cercherà il "blocco da 8" in cui quell'IP è contenuto. Siccome i blocchi da 8 nella rete vanno di 8 in 8 (0-7, 8-15, 16-23...), l’ IP .5 cade nel blocco **0-7**.

  
  

[https://www.youtube.com/watch?v=GleVTAg51xM](https://www.youtube.com/watch?v=GleVTAg51xM)

  
  

  
  

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