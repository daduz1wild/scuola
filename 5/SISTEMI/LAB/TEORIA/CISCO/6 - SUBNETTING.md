
---

# 🔹 PARTE 1 – LE 3 FORMULE IMPORTANTI DEL SUBNETTING

Il tuo prof ha ragione: **le formule fondamentali sono 3**.

---

## 1️⃣ Formula per il numero di HOST

```text
Host utilizzabili = 2^n − 2
```

- `n` = bit per gli host
    
- `−2` → network address + broadcast
    

📌 Usata quando ti chiedono:

- “Quanti host posso avere?”
    
- “Che subnet mask serve per X host?”
    

---

## 2️⃣ Formula per il numero di SUBNET (reti)

```text
Subnet = 2^s
```

- `s` = bit rubati alla parte host
    

📌 Usata quando:

- dividi una rete in più subnet
    
- subnetting classico
    

---

## 3️⃣ Formula per l’INTERVALLO (salto, block size)

```text
Intervallo = 256 − valore della subnet mask
```

📌 Usata per:

- trovare **indirizzi di rete**
    
- capire **dove inizia la subnet successiva**
    
- risolvere **corcette velocemente**
    

---

# 🔹 PARTE 2 – CIFRE FISSE DEI BIT PER LE CLASSI IP

Questa parte è **pura teoria da memorizzare**.

| Classe | Primo byte (binario) | Primo byte (decimale) | Subnet di default |
| ------ | -------------------- | --------------------- | ----------------- |
| A      | `0xxxxxxx`           | 1 – 126               | /8                |
| B      | `10xxxxxx`           | 128 – 191             | /16               |
| C      | `110xxxxx`           | 192 – 223             | /24               |
| D      | `1110xxxx`           | 224 – 239             | Multicast         |
| E      | `1111xxxx`           | 240 – 255             | Riservata         |

👉 **Questo spiega tutte le domande sui bit fissi**

---

# 🔹 PARTE 3 – SPIEGAZIONE DELLE CORCETTE

Ora le risolviamo **una per una**, come in verifica.

---



---

# 🔹 PARTE 1 – LE 3 FORMULE IMPORTANTI DEL SUBNETTING

Il tuo prof ha ragione: **le formule fondamentali sono 3**.

---

## 1️⃣ Formula per il numero di HOST

```text
Host utilizzabili = 2^n − 2
```

- `n` = bit per gli host
    
- `−2` → network address + broadcast
    

📌 Usata quando ti chiedono:

- “Quanti host posso avere?”
    
- “Che subnet mask serve per X host?”
    

---

## 2️⃣ Formula per il numero di SUBNET (reti)

```text
Subnet = 2^s
```

- `s` = bit rubati alla parte host
    

📌 Usata quando:

- dividi una rete in più subnet
    
- subnetting classico
    

---

## 3️⃣ Formula per l’INTERVALLO (salto, block size)

```text
Intervallo = 256 − valore della subnet mask
```

📌 Usata per:

- trovare **indirizzi di rete**
    
- capire **dove inizia la subnet successiva**
    
- risolvere **corcette velocemente**
    

---

# 🔹 PARTE 2 – CIFRE FISSE DEI BIT PER LE CLASSI IP

Questa parte è **pura teoria da memorizzare**.

|Classe|Primo byte (binario)|Primo byte (decimale)|Subnet di default|
|---|---|---|---|
|A|`0xxxxxxx`|1 – 126|/8|
|B|`10xxxxxx`|128 – 191|/16|
|C|`110xxxxx`|192 – 223|/24|
|D|`1110xxxx`|224 – 239|Multicast|
|E|`1111xxxx`|240 – 255|Riservata|

👉 **Questo spiega tutte le domande sui bit fissi**

---

# 🔹 PARTE 3 – SPIEGAZIONE DELLE CORCETTE

Ora le risolviamo **una per una**, come in verifica.

---

## ❓ Domanda 1

**Qual è la rappresentazione binaria del primo byte per gli indirizzi di classe C?**

### Teoria

Gli indirizzi di **classe C** iniziano con:

```text
110xxxxx
```

### Analisi risposte

- ❌ `101*****` → classe B ❌
    
- ❌ `0********` → classe A ❌
    
- ✅ `100*****` → ❌ (classe B)
    
- ❌ `1110****` → classe D
    
- ❌ `10******` → classe B
    

✔️ **Risposta corretta:**  
👉 **110***** (classe C)**

---

## ❓ Domanda 2

**Qual è il numero massimo di reti negli indirizzi di classe B?**

### Teoria

Classe B:

- bit fissi: `10`
    
- bit per rete: **14**
    

Formula:

```text
2^14 = 16.384
```

### Risposta corretta

✅ **16.384**

👉 È una domanda **diretta da formula**

---

## ❓ Domanda 3

**Qual è il valore dell’intervallo tra le subnet valide con una subnet mask di 224?**

### Passaggi

Subnet mask:

```text
255.255.255.224
```

Ultimo byte = **224**

Formula:

```text
256 − 224 = 32
```

### Subnet valide

```text
0, 32, 64, 96, 128, 160, 192, 224
```

### Risposta corretta

✅ **32**

📌 Attenzione: l’opzione **16 è sbagliata**, è un classico trabocchetto

---

## ❓ Domanda 4

**Quali sono i vantaggi principali del subnetting?**

Analizziamole una per una:

### ❌ Riduce il numero di router necessari

→ FALSO

### ❌ Aumenta il numero di indirizzi IP disponibili

→ FALSO (li usa meglio, non li crea)

### ✅ Aumenta la sicurezza della rete

→ VERO (segmentazione)

### ✅ Riduce il traffico di rete

→ VERO (meno broadcast)

### ✅ Riduce il numero di indirizzi sprecati

→ VERO (VLSM)

### ❌ Aumenta la velocità di connessione

→ FALSO (non influisce sulla banda)

### ✔️ Risposte corrette:

- **Aumenta la sicurezza**
    
- **Riduce il traffico**
    
- **Riduce gli indirizzi sprecati**
    

---

# 🔹 PARTE 4 – RIASSUNTO DA IMPARARE A MEMORIA

### 📌 Le 3 formule

1. `Host = 2^n − 2`
    
2. `Subnet = 2^s`
    
3. `Intervallo = 256 − subnetmask`
    

### 📌 Bit fissi classi

- A → `0`
    
- B → `10`
    
- C → `110`
    
- D → `1110`
    
- E → `1111`
    

---

Se vuoi, nel prossimo messaggio posso:

- simularti **una verifica con solo corcette**
    
- farti **un formulario da stampare**
    
- insegnarti **i trucchi per rispondere senza calcoli**
    

Dimmi tu 💪📘📡


Perfetto 👍  
ti propongo **UN SOLO ESERCIZIO COMPLETO**, costruito apposta per **usare TUTTE E 3 le formule**, passo-passo, come farebbe il prof alla lavagna.

---

# 🧠 ESERCIZIO GUIDATO – subnetting completo

## 📌 Testo dell’esercizio

Hai la rete:

```
192.168.10.0/24
```

Il professore chiede:

1. Dividere la rete in **4 subnet uguali**
    
2. Ogni subnet deve supportare **almeno 50 host**
    
3. Trovare:
    
    - subnet mask finale
        
    - numero di host per subnet
        
    - indirizzi di rete
        
    - intervallo (salto)
        

👉 In questo esercizio useremo **tutte e 3 le formule**.

---

# ✏️ PASSO 1 – Quanti host servono? (FORMULA 1)

### Formula host

```
Host = 2^n − 2
```

Ci servono **almeno 50 host**.

Proviamo:

- 2⁵ − 2 = 30 ❌ troppo pochi
    
- 2⁶ − 2 = 62 ✅ va bene
    

👉 servono **6 bit per gli host**

📌 Questo è il **primo uso della formula 1**

---

# ✏️ PASSO 2 – Quanti bit posso “rubare”? (FORMULA 2)

Rete iniziale:

```
/24 → 8 bit host
```

Se ne servono **6 per gli host**, posso rubarne:

```
8 − 6 = 2 bit
```

### Formula subnet

```
Subnet = 2^s
```

```
Subnet = 2² = 4
```

👉 otteniamo **esattamente 4 subnet**, come richiesto

📌 Questo è il **secondo uso: formula 2**

---

# ✏️ PASSO 3 – Subnet mask finale

Bit totali:

```
24 + 2 = /26
```

Subnet mask:

```
255.255.255.192
```

---

# ✏️ PASSO 4 – Calcolo dell’intervallo (FORMULA 3)

Prendiamo **l’ultimo byte** della subnet mask:

```
192
```

### Formula intervallo

```
Intervallo = 256 − 192 = 64
```

📌 Le subnet iniziano ogni **64**

👉 **terzo uso: formula 3**

---

# ✏️ PASSO 5 – Scriviamo TUTTE le subnet (qui il prof mette i rettangoli)

Partiamo da 0 e aggiungiamo l’intervallo:

| Subnet | Network        | Host iniziale | Host finale | Broadcast |
| ------ | -------------- | ------------- | ----------- | --------- |
| 1      | 192.168.10.0   | .1            | .62         | .63       |
| 2      | 192.168.10.64  | .65           | .126        | .127      |
| 3      | 192.168.10.128 | .129          | .190        | .191      |
| 4      | 192.168.10.192 | .193          | .254        | .255      |

---

# 📦 RIASSUNTO VISIVO (come alla lavagna)

```
192.168.10.0/24
│
├── /26 → 0 – 63
├── /26 → 64 – 127
├── /26 → 128 – 191
└── /26 → 192 – 255
```

Ogni “taglio”:

- aggiunge **1 bit alla mask**
    
- dimezza lo spazio
    
- è esattamente il metodo dei **rettangoli**
    

---

# 🧾 RIASSUNTO FINALE DELLE 3 FORMULE (applicate)

1️⃣ **Host**

```
2^6 − 2 = 62 host
```

2️⃣ **Subnet**

```
2^2 = 4 subnet
```

3️⃣ **Intervallo**

```
256 − 192 = 64
```

---

Se vuoi, nel prossimo messaggio posso:

- rifare **lo stesso esercizio ma in versione corcette**
    
- fartene uno **ancora più difficile**
    
- oppure **fingere un’interrogazione orale**
    

Dimmi tu 💪📡📘


Ottima domanda — **questa è una confusione NORMALISSIMA** ed è proprio qui che molti studenti sbagliano 👍  
Adesso te la chiarisco **definitivamente**, passo-passo, senza dare nulla per scontato.

---

# 🔹 PERCHÉ CLASSE B HA 16 BIT DI RETE… MA SOLO 14 VARIABILI?

Hai detto:

> “se la parte di rete degli indirizzi di classe B ha i primi 2 byte, quindi non dovrebbe averne 16?”

👉 **SÌ**, la **parte di rete è lunga 16 bit**  
👉 **MA NO**, **non tutti e 16 i bit servono a numerare le reti**

Vediamo **perché**.

---

## 1️⃣ Struttura reale di un indirizzo di CLASSE B

Un indirizzo IPv4 ha **32 bit** totali.

Negli indirizzi di **classe B**:

```
[ Rete ][ Rete ][ Host ][ Host ]   8       8        8        8
```

👉 quindi:

- **16 bit di rete**
- **16 bit di host**

Fin qui **hai perfettamente ragione**.

---

## 2️⃣ Il punto chiave: i BIT FISSI (quelli che “non contano”)

Negli indirizzi di **classe B**, i **primi 2 bit del primo byte sono FISSI**:

```
10xxxxxx.xxxxxxxx.xxxxxxxx.xxxxxxxx
```

Questo serve a dire:

> “questo indirizzo appartiene alla classe B”

📌 **Bit fissi = NON variabili = NON contano per il numero di reti**

---

## 3️⃣ Quanti bit restano davvero per numerare le reti?

Vediamolo con calma.

### Primo byte (8 bit)

```
10xxxxxx
```

- `10` → fissi ❌
- `xxxxxx` → 6 bit variabili ✅

### Secondo byte (8 bit)

```
xxxxxxxx
```

- tutti variabili ✅

---

## 4️⃣ Conteggio corretto dei bit di rete UTILIZZABILI

|Byte|Bit totali|Bit fissi|Bit utilizzabili|
|---|---|---|---|
|1° byte|8|2|6|
|2° byte|8|0|8|
|**Totale**|**16**|**2**|**14**|

👉 **Ecco da dove vengono i 14 bit**

---

## 5️⃣ Formula applicata correttamente

Numero massimo di reti:

```
2^14 = 16.384
```

✔️ **Risposta giusta**  
✔️ **Teoricamente corretta**  
✔️ **Esattamente quella che vuole il prof**

---

## 6️⃣ Confronto rapido con le altre classi (per fissare bene)

|Classe|Bit di rete|Bit fissi|Bit variabili|Numero reti|
|---|---|---|---|---|
|A|8|1 (`0`)|7|2⁷ = 128|
|B|16|2 (`10`)|14|2¹⁴ = 16.384|
|C|24|3 (`110`)|21|2²¹ = 2.097.152|

👉 **Più bit fissi = meno reti possibili**

---

## 7️⃣ Frase “da interrogazione” (usala così)

Se il prof te lo chiede, rispondi così:

> “Negli indirizzi di classe B la parte di rete è lunga 16 bit, ma i primi 2 bit sono fissi per identificare la classe.  
> Quindi solo 14 bit sono utilizzabili per numerare le reti, e il numero massimo di reti è 2¹⁴ = 16.384.”

💥 **Risposta perfetta, voto alto**

---

Se vuoi, nel prossimo messaggio posso:

- farti **un disegno ASCII come alla lavagna**
- confrontare **classful vs classless**
- oppure allenarti con **domande-trabocchetto da verifica**

Dimmi tu 💪📘📡

Perfetto, ora spieghiamo **DAVVERO** come funziona **questa formula**, non “da ricordare a memoria”, ma **da capire**, così **non la dimentichi più**.

La formula è:

```text
Intervallo = 256 − valore della subnet mask
```

Nel tuo esempio:

```text
256 − 192 = 64
```

Vediamo **perché funziona**, partendo da zero.

---

# 🔹 1️⃣ Perché compare proprio il numero **256**?

Un **byte** è fatto da **8 bit**.

Ogni byte può rappresentare:

```text
2⁸ = 256 valori
```

Che vanno da:

```text
0 → 255
```

👉 quindi **un byte “riparte” ogni 256 numeri**  
👉 per questo la formula parte sempre da **256**

---

# 🔹 2️⃣ Cosa rappresenta il valore della subnet mask (es. 192)?

Prendiamo la subnet mask:

```text
255.255.255.192
```

Guardiamo **solo l’ultimo byte**, perché è lì che stiamo subnettando.

### 192 in binario

```text
11000000
```

Significa:

- **2 bit di rete**
    
- **6 bit di host**
    

👉 questi **2 bit di rete** “tagliano” il byte in blocchi uguali.

---

# 🔹 3️⃣ Cosa sono i “blocchi” (qui c’è la chiave)

I **bit di rete** nel byte determinano **la dimensione del blocco**.

Con:

```text
11000000
```

stai dicendo:

> “le subnet cambiano solo quando quei bit cambiano”

I restanti **6 bit di host** possono variare:

```text
2⁶ = 64 valori
```

💡 **ECCO L’INTERVALLO!**

👉 l’intervallo **non è altro che il numero di combinazioni dei bit host rimasti**

---

# 🔹 4️⃣ Quindi la formula è solo una scorciatoia

In realtà stai facendo:

```text
Intervallo = 2^(numero di bit host nel byte)
```

Nel nostro caso:

```text
2⁶ = 64
```

Ma siccome:

- 192 = 256 − 64
    

si può scrivere più velocemente:

```text
256 − 192 = 64
```

📌 **È la stessa identica cosa**, solo più rapida.

---

# 🔹 5️⃣ Dimostrazione pratica (come alla lavagna)

Con intervallo = 64, le subnet partono da:

```text
0
64
128
192
```

E finiscono appena prima della successiva:

- 0–63
    
- 64–127
    
- 128–191
    
- 192–255
    

👉 ogni subnet ha **64 indirizzi totali**

---

# 🔹 6️⃣ Perché funziona SEMPRE?

Perché:

- la subnet mask è sempre fatta da **1 consecutivi**
    
- i bit host sono sempre **a destra**
    
- le combinazioni possibili dei bit host sono sempre una potenza di 2
    

Quindi:

```text
256 − subnetmask = 2^(bit host)
```

---

# 🔹 7️⃣ Schema mentale da ricordare

Quando vedi:

```text
255.255.255.X
```

pensa:

1. X dice **quanti bit sono di rete**
    
2. i bit rimanenti → **dimensione del blocco**
    
3. dimensione del blocco = **intervallo**
    

---

# 🔹 8️⃣ Mini-tabella utilissima (imparala)

|Subnet mask (ultimo byte)|Bit host|Intervallo|
|---|---|---|
|128|7|128|
|192|6|64|
|224|5|32|
|240|4|16|
|248|3|8|
|252|2|4|
|254|1|2|

---

# 🔹 FRASE “DA INTERROGAZIONE”

Se il prof ti chiede:

> “Perché l’intervallo si calcola con 256 meno la subnet mask?”

Rispondi:

> “Perché un byte ha 256 valori possibili e l’intervallo corrisponde al numero di combinazioni dei bit host rimasti nell’ultimo byte.”

💥 **Perfetta.**

---

Se vuoi, nel prossimo messaggio posso:

- farti **un esempio senza usare la formula**
    
- spiegarti **come riconoscere l’intervallo a colpo d’occhio**
    
- oppure farti **domande-trabocchetto su questa formula**
    

Dimmi tu 💪📘📡


Domanda **perfetta**.  
Questa è proprio la differenza tra **capire il subnetting** e **fare i conti a memoria**.  
Andiamo **con ordine**, senza saltare passaggi.

---

# 🔹 PERCHÉ HO USATO **/26** E NON **/25**

Partiamo dall’esercizio che avevamo fatto:

- rete iniziale: `192.168.10.0/24`
    
- richiesta: **4 reti**
    
- richiesta: **almeno 50 host per rete**
    

---

## 1️⃣ Vincolo 1: quanti host servono davvero?

Formula:

```text
Host = 2^n − 2
```

- /27 → 30 host ❌
    
- **/26 → 62 host ✅**
    
- /25 → 126 host ✅
    

👉 **/26 è la subnet PIÙ PICCOLA che soddisfa i 50 host**

📌 Regola fondamentale:

> **Si sceglie sempre la subnet più piccola che soddisfa i requisiti**, per non sprecare indirizzi.

---

## 2️⃣ Vincolo 2: quante reti devo ottenere?

Da `/24`:

- `/25` → 2 reti ❌
    
- **/26 → 4 reti ✅**
    
- `/27` → 8 reti (sarebbero troppe)
    

👉 `/26` è **l’unica** che:

- fornisce **abbastanza host**
    
- produce **esattamente 4 subnet**
    

Per questo **non ha senso usare /25** in quell’esercizio.

---

## 3️⃣ Quindi /25 è “sbagliata”?

❌ No.  
È **corretta matematicamente**, ma **non è ottimale** per la richiesta.

Con `/25` avresti:

- solo **2 reti**
    
- 126 host per rete
    
- spreco enorme di indirizzi
    

Il prof vuole che tu scelga:

> **la soluzione più efficiente**, non “una qualsiasi che funziona”.

---

# 🔹 ORA LA TUA DOMANDA CHIAVE

## “Se mi avessi chiesto 5 reti da 40 host, sarebbe stato diverso?”

👉 **SÌ, COMPLETAMENTE DIVERSO.**

Vediamolo.

---

## 📌 Nuova richiesta

- **5 reti**
    
- **40 host per rete**
    
- rete di partenza: `192.168.10.0/24`
    

---

## 1️⃣ Vincolo host

- /27 → 30 host ❌
    
- **/26 → 62 host ✅**
    
- /25 → 126 host ✅
    

👉 minima possibile: **/26**

---

## 2️⃣ Vincolo numero di reti

Da `/24`:

- `/26` → **4 reti ❌**
    
- `/27` → **8 reti ✅**
    

👉 ma `/27` ha **solo 30 host**, quindi **non va bene**

---

## 3️⃣ Conclusione importante (qui casca l’asino)

👉 **NON È POSSIBILE** ottenere:

- 5 reti
    
- da almeno 40 host
    
- partendo da una `/24`
    

### Perché?

- per avere ≥40 host serve almeno `/26`
    
- `/26` produce solo **4 reti**
    
- per avere ≥5 reti servirebbe `/27`
    
- ma `/27` non ha abbastanza host
    

📌 **Il problema è impossibile**, e il prof _potrebbe farlo apposta_.

---

# 🔹 RISPOSTA “DA INTERROGAZIONE”

Se il prof ti chiede:

> “Perché hai scelto /26 e non /25?”

Rispondi:

> “Perché /26 è la subnet più piccola che soddisfa sia il numero minimo di host richiesto sia il numero di reti richieste. Usare /25 produrrebbe meno subnet e sprecherebbe indirizzi.”

E se ti chiede:

> “E se volessi 5 reti da 40 host?”

Rispondi:

> “Non è possibile partendo da una /24, perché la subnet minima per 40 host è /26, che produce solo 4 reti.”

💥 **Risposta perfetta, da 8–9 in interrogazione.**

---

# 🔹 REGOLA D’ORO (SCRIVILA SUL QUADERNO)

> **Prima soddisfi gli host, poi verifichi le reti.  
> Se una delle due condizioni fallisce, la subnet non va bene.**

---

Se vuoi, nel prossimo messaggio posso:

- farti **esercizi “possibile / impossibile” come in verifica**
    
- insegnarti **a capire subito quando il prof ti sta fregando**
    
- oppure confrontare **/25, /26, /27 con disegni visivi**
    

Dimmi tu 💪📘📡



---

# 🔹 PARTE 1 – TEORIA DEL SUBNETTING (senza esercizi)

## 1️⃣ Cos’è il subnetting (idea chiave)

Il **subnetting** serve a:

👉 **dividere una rete grande in più reti più piccole (sottoreti)**  
👉 **assegnare IP in modo efficiente**, senza sprechi  
👉 **separare logicamente le reti**

Immagina una **pizza grande (rete)** che devi dividere in **fette (sottoreti)** di dimensioni diverse.

---

## 2️⃣ IP e maschera: cosa contano davvero

Un indirizzo IP è fatto così:

```
192.168.1.0
```

È composto da:

- **parte di rete**
    
- **parte di host**
    

La **subnet mask** dice **dove finisce la rete e iniziano gli host**.

Esempio:

```
/24  →  255.255.255.0
```

Significa:

- 24 bit per la rete
    
- 8 bit per gli host
    

---

## 3️⃣ Formula FONDAMENTALE (da sapere a memoria)

Per sapere **quanti host puoi avere in una subnet**:

```
Host = 2^n − 2
```

Dove:

- `n` = numero di bit per gli host
    
- `-2` perché:
    
    - 1 IP = network address
        
    - 1 IP = broadcast
        

### Tabella IMPORTANTISSIMA

|Bit host|IP totali|Host utilizzabili|
|---|---|---|
|5|32|30|
|6|64|62|
|7|128|126|
|8|256|254|

👉 **Questa tabella è la chiave del subnetting**

---

## 4️⃣ Subnetting classico vs VLSM

### ❌ Subnetting classico

- Tutte le subnet **uguali**
    
- Spreco enorme di IP
    

### ✅ VLSM (quello che vuole il prof)

- **Subnet di dimensioni diverse**
    
- Ogni rete ha **solo gli IP che servono**
    
- Metodo usato nella realtà
    

---

# 🔹 PARTE 2 – METODO DEI “RETTANGOLI” (come lo spiegano a scuola)

Immagina **un grande rettangolo** che rappresenta la rete iniziale.

Ogni volta che **dividi il rettangolo a metà**, stai:

- aggiungendo **1 bit alla maschera**
    
- dimezzando il numero di host
    

Esempio:

```
/24 → /25 → /26 → /27 → /28
```

Ogni divisione:

- dimezza IP
    
- dimezza host
    

---

# 🔹 PARTE 3 – ESERCIZIO COMPLETO (30, 40, 70 host)

## 📌 Dati del problema

Hai **3 reti** che richiedono:

- Rete A → **70 host**
    
- Rete B → **40 host**
    
- Rete C → **30 host**
    

Rete di partenza:

```
192.168.1.0/24
```

Totale IP disponibili:

```
256
```

---

## 1️⃣ ORDINE CORRETTO (regola d’oro)

👉 **Si parte SEMPRE dalla rete più grande**

Ordiniamo:

1. 70 host
    
2. 40 host
    
3. 30 host
    

---

## 2️⃣ Calcolo subnet per ogni rete

### 🔹 Rete da 70 host

Serve:

```
2^7 − 2 = 126 host
```

👉 subnet:

```
/25
```

👉 IP totali: 128

---

### 🔹 Rete da 40 host

Serve:

```
2^6 − 2 = 62 host
```

👉 subnet:

```
/26
```

👉 IP totali: 64

---

### 🔹 Rete da 30 host

Serve:

```
2^5 − 2 = 30 host
```

👉 subnet:

```
/27
```

👉 IP totali: 32

---

## 3️⃣ Metodo del RETTANGOLO (visuale)

### 🔲 Rettangolo iniziale

```
192.168.1.0/24
```

### ✂️ Prima divisione → /25

```
192.168.1.0/25   ← 70 host
192.168.1.128/25
```

---

### ✂️ Seconda divisione → /26

Dividiamo la **parte rimasta**

```
192.168.1.128/26  ← 40 host
192.168.1.192/26
```

---

### ✂️ Terza divisione → /27

Dividiamo ancora

```
192.168.1.192/27  ← 30 host
192.168.1.224/27  (libera)
```

---

## 4️⃣ RISULTATO FINALE (perfetto)

|Rete|Subnet|Network|Host utilizzabili|Broadcast|
|---|---|---|---|---|
|70 host|/25|192.168.1.0|.1 – .126|.127|
|40 host|/26|192.168.1.128|.129 – .190|.191|
|30 host|/27|192.168.1.192|.193 – .222|.223|

👉 **Subnetting ottimizzato**  
👉 **Nessuno spreco**  
👉 **Metodo identico a quello del prof**

---

# 🔹 PARTE 4 – RIASSUNTO DA MEMORIZZARE

### ✔️ Regole d’oro

1. Ordina le reti **dalla più grande alla più piccola**
    
2. Usa **2^n − 2**
    
3. Dividi **sempre a metà**
    
4. Ogni divisione → **+1 nella subnet mask**
    

---

Se vuoi, nel prossimo messaggio posso:

- farti **un altro esercizio**
    
- spiegarti **come riconoscere subito la subnet giusta senza calcoli**
    
- oppure **simulare una verifica scritta/orale**
    

Dimmi tu 💪📡


Perfetto 👍  
ti propongo **UN SOLO ESERCIZIO COMPLETO**, costruito apposta per **usare TUTTE E 3 le formule**, passo-passo, come farebbe il prof alla lavagna.

---

# 🧠 ESERCIZIO GUIDATO – subnetting completo

## 📌 Testo dell’esercizio

Hai la rete:

```
192.168.10.0/24
```

Il professore chiede:

1. Dividere la rete in **4 subnet uguali**
    
2. Ogni subnet deve supportare **almeno 50 host**
    
3. Trovare:
    
    - subnet mask finale
        
    - numero di host per subnet
        
    - indirizzi di rete
        
    - intervallo (salto)
        

👉 In questo esercizio useremo **tutte e 3 le formule**.

---

# ✏️ PASSO 1 – Quanti host servono? (FORMULA 1)

### Formula host

```
Host = 2^n − 2
```

Ci servono **almeno 50 host**.

Proviamo:

- 2⁵ − 2 = 30 ❌ troppo pochi
    
- 2⁶ − 2 = 62 ✅ va bene
    

👉 servono **6 bit per gli host**

📌 Questo è il **primo uso della formula 1**

---

# ✏️ PASSO 2 – Quanti bit posso “rubare”? (FORMULA 2)

Rete iniziale:

```
/24 → 8 bit host
```

Se ne servono **6 per gli host**, posso rubarne:

```
8 − 6 = 2 bit
```

### Formula subnet

```
Subnet = 2^s
```

```
Subnet = 2² = 4
```

👉 otteniamo **esattamente 4 subnet**, come richiesto

📌 Questo è il **secondo uso: formula 2**

---

# ✏️ PASSO 3 – Subnet mask finale

Bit totali:

```
24 + 2 = /26
```

Subnet mask:

```
255.255.255.192
```

---

# ✏️ PASSO 4 – Calcolo dell’intervallo (FORMULA 3)

Prendiamo **l’ultimo byte** della subnet mask:

```
192
```

### Formula intervallo

```
Intervallo = 256 − 192 = 64
```

📌 Le subnet iniziano ogni **64**

👉 **terzo uso: formula 3**

---

# ✏️ PASSO 5 – Scriviamo TUTTE le subnet (qui il prof mette i rettangoli)

Partiamo da 0 e aggiungiamo l’intervallo:

|Subnet|Network|Host iniziale|Host finale|Broadcast|
|---|---|---|---|---|
|1|192.168.10.0|.1|.62|.63|
|2|192.168.10.64|.65|.126|.127|
|3|192.168.10.128|.129|.190|.191|
|4|192.168.10.192|.193|.254|.255|

---

# 📦 RIASSUNTO VISIVO (come alla lavagna)

```
192.168.10.0/24
│
├── /26 → 0 – 63
├── /26 → 64 – 127
├── /26 → 128 – 191
└── /26 → 192 – 255
```

Ogni “taglio”:

- aggiunge **1 bit alla mask**
    
- dimezza lo spazio
    
- è esattamente il metodo dei **rettangoli**
    

---

# 🧾 RIASSUNTO FINALE DELLE 3 FORMULE (applicate)

1️⃣ **Host**

```
2^6 − 2 = 62 host
```

2️⃣ **Subnet**

```
2^2 = 4 subnet
```

3️⃣ **Intervallo**

```
256 − 192 = 64
```

---

Se vuoi, nel prossimo messaggio posso:

- rifare **lo stesso esercizio ma in versione corcette**
    
- fartene uno **ancora più difficile**
    
- oppure **fingere un’interrogazione orale**
    

Dimmi tu 💪📡📘



# 🔹 8️⃣ Mini-tabella utilissima (imparala)

|Subnet mask (ultimo byte)|Bit host|Intervallo|
|---|---|---|
|128|7|128|
|192|6|64|
|224|5|32|
|240|4|16|
|248|3|8|
|252|2|4|
|254|1|2|

---

# 🔹 FRASE “DA INTERROGAZIONE”

Se il prof ti chiede:

> “Perché l’intervallo si calcola con 256 meno la subnet mask?”

Rispondi:

> “Perché un byte ha 256 valori possibili e l’intervallo corrisponde al numero di combinazioni dei bit host rimasti nell’ultimo byte.”

💥 **Perfetta.**

---

Se vuoi, nel prossimo messaggio posso:

- farti **un esempio senza usare la formula**
    
- spiegarti **come riconoscere l’intervallo a colpo d’occhio**
    
- oppure farti **domande-trabocchetto su questa formula**
    

Dimmi tu 💪📘📡


Domanda **perfetta**.  
Questa è proprio la differenza tra **capire il subnetting** e **fare i conti a memoria**.  
Andiamo **con ordine**, senza saltare passaggi.

---

# 🔹 PERCHÉ HO USATO **/26** E NON **/25**

Partiamo dall’esercizio che avevamo fatto:

- rete iniziale: `192.168.10.0/24`
    
- richiesta: **4 reti**
    
- richiesta: **almeno 50 host per rete**
    

---

## 1️⃣ Vincolo 1: quanti host servono davvero?

Formula:

```text
Host = 2^n − 2
```

- /27 → 30 host ❌
    
- **/26 → 62 host ✅**
    
- /25 → 126 host ✅
    

👉 **/26 è la subnet PIÙ PICCOLA che soddisfa i 50 host**

📌 Regola fondamentale:

> **Si sceglie sempre la subnet più piccola che soddisfa i requisiti**, per non sprecare indirizzi.

---

## 2️⃣ Vincolo 2: quante reti devo ottenere?

Da `/24`:

- `/25` → 2 reti ❌
    
- **/26 → 4 reti ✅**
    
- `/27` → 8 reti (sarebbero troppe)
    

👉 `/26` è **l’unica** che:

- fornisce **abbastanza host**
    
- produce **esattamente 4 subnet**
    

Per questo **non ha senso usare /25** in quell’esercizio.

---

## 3️⃣ Quindi /25 è “sbagliata”?

❌ No.  
È **corretta matematicamente**, ma **non è ottimale** per la richiesta.

Con `/25` avresti:

- solo **2 reti**
    
- 126 host per rete
    
- spreco enorme di indirizzi
    

Il prof vuole che tu scelga:

> **la soluzione più efficiente**, non “una qualsiasi che funziona”.

---

# 🔹 ORA LA TUA DOMANDA CHIAVE

## “Se mi avessi chiesto 5 reti da 40 host, sarebbe stato diverso?”

👉 **SÌ, COMPLETAMENTE DIVERSO.**

Vediamolo.

---

## 📌 Nuova richiesta

- **5 reti**
    
- **40 host per rete**
    
- rete di partenza: `192.168.10.0/24`
    

---

## 1️⃣ Vincolo host

- /27 → 30 host ❌
    
- **/26 → 62 host ✅**
    
- /25 → 126 host ✅
    

👉 minima possibile: **/26**

---

## 2️⃣ Vincolo numero di reti

Da `/24`:

- `/26` → **4 reti ❌**
    
- `/27` → **8 reti ✅**
    

👉 ma `/27` ha **solo 30 host**, quindi **non va bene**

---

## 3️⃣ Conclusione importante (qui casca l’asino)

👉 **NON È POSSIBILE** ottenere:

- 5 reti
    
- da almeno 40 host
    
- partendo da una `/24`
    

### Perché?

- per avere ≥40 host serve almeno `/26`
    
- `/26` produce solo **4 reti**
    
- per avere ≥5 reti servirebbe `/27`
    
- ma `/27` non ha abbastanza host
    

📌 **Il problema è impossibile**, e il prof _potrebbe farlo apposta_.

---

# 🔹 RISPOSTA “DA INTERROGAZIONE”

Se il prof ti chiede:

> “Perché hai scelto /26 e non /25?”

Rispondi:

> “Perché /26 è la subnet più piccola che soddisfa sia il numero minimo di host richiesto sia il numero di reti richieste. Usare /25 produrrebbe meno subnet e sprecherebbe indirizzi.”

E se ti chiede:

> “E se volessi 5 reti da 40 host?”

Rispondi:

> “Non è possibile partendo da una /24, perché la subnet minima per 40 host è /26, che produce solo 4 reti.”

💥 **Risposta perfetta, da 8–9 in interrogazione.**

---

# 🔹 REGOLA D’ORO (SCRIVILA SUL QUADERNO)

> **Prima soddisfi gli host, poi verifichi le reti.  
> Se una delle due condizioni fallisce, la subnet non va bene.**

---

Se vuoi, nel prossimo messaggio posso:

- farti **esercizi “possibile / impossibile” come in verifica**
    
- insegnarti **a capire subito quando il prof ti sta fregando**
    
- oppure confrontare **/25, /26, /27 con disegni visivi**
    

Dimmi tu 💪📘📡