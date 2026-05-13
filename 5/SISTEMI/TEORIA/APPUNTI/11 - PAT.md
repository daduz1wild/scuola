Certo. Qui serve una spiegazione molto chiara perché il **PAT** è uno degli argomenti più importanti di NAT ed è spesso chiesto all’orale.

---

# PAT (Port Address Translation)

## COS’È

Il **PAT** (*Port Address Translation*), chiamato anche **NAT Overload**, è una forma di traduzione degli indirizzi in cui **più host privati condividono un solo indirizzo IP pubblico** usando **numeri di porta diversi**.

In pratica:

* tanti PC interni
* un solo IP pubblico esterno
* differenza tra le connessioni gestita tramite le **porte**

---

## A COSA SERVE

Serve quando una rete privata ha molti dispositivi, ma ha a disposizione **un solo indirizzo pubblico** o comunque pochi indirizzi pubblici.

È utilissimo perché permette:

* a molti host di uscire su Internet
* di risparmiare indirizzi pubblici
* di distinguere le connessioni anche se usano lo stesso IP pubblico

---

## COME FUNZIONA

Il PAT non tiene conto solo dell’IP, ma anche della **porta sorgente**.

Questa è l’idea fondamentale:

* ogni host privato, quando esce, usa una certa porta sorgente
* il router traduce l’IP privato in un **unico IP pubblico**
* però associa a ciascuna connessione una **porta diversa**
* così il router riesce a distinguere connessioni diverse anche se arrivano dallo stesso indirizzo pubblico

### Esempio semplice

Immagina:

* PC1: `10.0.0.2:1500`
* PC2: `10.0.0.3:1500`

Entrambi vogliono uscire con lo stesso IP pubblico.

Il router allora può tradurre così:

* `10.0.0.2:1500` → `40.30.20.10:30001`
* `10.0.0.3:1500` → `40.30.20.10:30002`

Quindi:

* l’IP pubblico è lo stesso
* la porta cambia
* grazie alla porta il router capisce a chi restituire le risposte

---

## DIFFERENZE IMPORTANTI

### NAT statico

* traduzione **1:1**
* un host privato corrisponde sempre allo stesso IP pubblico

### NAT dinamico

* traduzione **temporanea**
* ogni host usa un IP preso da un pool

### PAT

* tanti host privati → **un solo IP pubblico**
* la distinzione avviene con le **porte**

Questa è la differenza più importante da ricordare.

---

# LE PORTE NEL PAT

Le porte sono numeri logici associati ai servizi e alle applicazioni.

Le porte sono divise in tre gruppi:

* **well-known ports**: `0–1023`
* **registered ports**: `1024–49151`
* **dynamic/private ports**: `49152–65535`

Nel PAT il router usa le porte per distinguere le varie connessioni.

### Correzione importante

Nei tuoi appunti dici che se la porta sorgente non è disponibile il PAT cerca un’altra porta: l’idea è giusta, ma più precisamente il router assegna una **porta esterna disponibile** per mantenere univoca la traduzione.

---

# CONFIGURAZIONE DEL PAT

La configurazione si fa sul **router di confine**, cioè il router tra rete privata e Internet.

---

## 1) Definisco chi può essere tradotto

Prima bisogna creare l’ACL che dice quali host interni possono usare il PAT.

Per esempio:

```bash id="3jv2xq"
access-list 10 permit 10.0.0.0 0.0.0.255
```

### Correzione importante

La wildcard mask corretta non è `255.255.255.0` ma:

`0.0.0.255`

Perché nelle ACL Cisco si usa la **wildcard mask**, non la subnet mask classica.

Questa ACL significa:

* permetto agli host della rete `10.0.0.0/24`
* di essere tradotti tramite PAT

---

## 2) Definisco la traduzione con overload

Poi si usa il comando:

```bash id="x8r2qf"
ip nat inside source list 10 interface Se0/1/0 overload
```

### Significato

* `ip nat inside source` → traduco gli indirizzi sorgente interni
* `list 10` → uso gli host autorizzati dalla ACL 10
* `interface Se0/1/0` → l’IP pubblico è quello dell’interfaccia esterna del router
* `overload` → più host condividono lo stesso IP pubblico grazie alle porte

Questa è proprio la parte che trasforma il NAT in **PAT**.

---

## 3) Dichiaro le interfacce inside e outside

Come per NAT statico e dinamico, devo dire quali interfacce sono interne e quali esterne.

Esempio:

```bash id="f1m9zr"
interface fastethernet0/0
 ip nat inside

interface serial0/1/0
 ip nat outside
```

### Significato

* `inside` → verso la rete privata
* `outside` → verso Internet o rete pubblica

---

# ESEMPIO COMPLETO

Supponiamo:

* rete interna: `10.0.0.0/24`
* router con un solo IP pubblico sull’interfaccia esterna

Configurazione:

```bash id="u2p4an"
access-list 10 permit 10.0.0.0 0.0.0.255
ip nat inside source list 10 interface Se0/1/0 overload

interface fastethernet0/0
 ip nat inside

interface serial0/1/0
 ip nat outside
```

### Cosa succede

* tutti gli host della rete privata possono uscire
* il router usa un solo IP pubblico
* ogni connessione viene distinta tramite una porta diversa

---

# COME VIENE GESTITA UNA CONNESSIONE

Quando un host interno apre una connessione:

1. il router legge IP e porta sorgente
2. traduce l’IP privato con l’IP pubblico dell’interfaccia esterna
3. cambia la porta, se serve
4. salva la corrispondenza nella tabella NAT

Questa tabella serve per far tornare le risposte al giusto host interno.

---

# DIFFERENZE IMPORTANTI DA NON CONFONDERE

## PAT vs NAT dinamico

* **NAT dinamico** = usa un pool di IP pubblici
* **PAT** = usa un solo IP pubblico e distingue gli host con le porte

## PAT vs NAT statico

* **NAT statico** = associazione fissa tra privato e pubblico
* **PAT** = traduzione multipla su un solo IP pubblico

## PAT e porte

Il PAT non guarda solo chi è il mittente, ma anche la **porta sorgente**.
Questa è la chiave per far funzionare tante connessioni contemporanee.

---

# RIASSUNTO FINALE

Il PAT, o NAT Overload, permette a molti host privati di condividere un solo IP pubblico.
La distinzione tra le connessioni avviene tramite le porte.
Sul router si configura con una ACL, con l’interfaccia inside/outside e con il comando `overload`.
È la soluzione più usata quando gli IP pubblici sono pochi.

---

# DOMANDE POSSIBILI DA MATURITÀ

* Che cos’è il **PAT** e perché si usa?
* Qual è la differenza tra **PAT, NAT statico e NAT dinamico**?
* Perché nel PAT servono le **porte**?
* Come si configura il PAT su un router Cisco?

---

[CONTROLLO STUDIO]

* ✔ Corretto: PAT come NAT overload, condivisione di un solo IP pubblico, uso delle porte per distinguere gli host, configurazione con ACL e `overload`, dichiarazione delle interfacce inside/outside.
* ⚠ Correzioni: nella ACL si usa la wildcard mask `0.0.0.255`, non la subnet mask `255.255.255.0`; il PAT non “mappa gli indirizzi usando solo la porta”, ma traduce IP e porta insieme.
* ➕ Integrazioni utili: distinzione tra well-known/registered/dynamic ports, ruolo della tabella NAT nel ritorno delle risposte, esempio di due host con la stessa porta sorgente.
* ❌ Non trattato: port forwarding, PAT in ingresso, NAT statico con servizi pubblicati dall’esterno.

[DA RICORDARE]

* concetto chiave: il PAT permette a molti host privati di uscire con un solo IP pubblico usando porte diverse.
* errore comune: confondere PAT con NAT dinamico o scrivere la subnet mask al posto della wildcard mask.
* collegamento utile: il PAT è la soluzione pratica più comune quando la rete privata ha molti dispositivi ma pochi indirizzi pubblici.






Port Address Translation , visto come NAT Overload, il PAT si usa quando si ha un arete interna composta da atnte macchine e un solo indirizzo pubblico esterno.
se piu macchien vogliono uscire all'esterno non potrano farlo contemporanemìamente se utilizziamo solamente l'indirizzo pubblico, per questo ci vien in aiuto il PAT che prevde l'utilizzo della porta, vengono mappati piu indirizzi pirvati con un solo indirizzo pubblico utilizzando l'opportuno numero di porta. le porte disponibili appatrtengono a 3 gruppi. Il pat tien conto della porta sorgente, ricordiamo che la porta è quel numero che viene associato a un particolare applicativo su una macch9ina.
se la porta sorgente non è disponibile sul router perché già usata per una richiesta allora il PAT inizia una ricerca a partire da uno degli intervalli di porte definite.
se una macchina della rete privata esce con un indirizzo di porta 1500 ma se pc3 contemporaneamente una ltro pc esce con la stessa porta, allora R1 anddra a cercare la prima porta disponibile e gli dara un'altra in modo da differenziarli.
la configurazione viene fatta al router da confine.

inanzitutto dobbiamo andare a definire l'acl( chi è permesso accedere ad internet) :
access-list 10 permit 10.0.0.0 255.255.255.0(permetto a questi host di essere tradotti)

dobbiamo darre il comando per abilitare la traduzione degli indirizzi:
ip nat inside source list 10 interface Se0/1/0 overload (tutte le macchine della lista 10 

come al solito comandi in cui assegno all'interfaccia

