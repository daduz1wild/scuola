

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


# DHCP: spiegazione chiara e completa

Il **DHCP** è l’acronimo di **Dynamic Host Configuration Protocol**.  
Serve ad assegnare in modo **automatico e dinamico** i parametri di rete ai dispositivi client, senza che l’utente debba configurarli a mano.

In pratica, quando un PC, un laptop o un altro host si collega alla rete, può ricevere dal DHCP server:

- **indirizzo IP**
    
- **subnet mask**
    
- **default gateway**
    
- **eventuale DNS**
    

Questo evita errori di configurazione e rende più semplice la gestione di reti con molti dispositivi.

---

## 1) Come funziona il DHCP: le 4 fasi fondamentali

Il processo classico si chiama spesso **DORA**:

### 1. Discover

Il client, appena acceso o appena avviata la connessione di rete, **non ha ancora un IP**.  
Allora manda un messaggio di **richiesta in broadcast** per chiedere se in rete c’è un server DHCP disponibile.

### 2. Offer

Il server DHCP risponde con una **offerta**: propone un indirizzo IP e gli altri parametri di rete.

### 3. Request

Il client riceve anche più offerte, se ci sono più server, e **sceglie una sola offerta**.  
Quindi manda una richiesta di conferma al server scelto.

### 4. Acknowledge (ACK)

Il server conferma definitivamente l’assegnazione: quell’indirizzo è riservato a quel client per il tempo stabilito.

---

# 2) Esempio pratico in Cisco Packet Tracer: router come DHCP server

Nel video si usa un **router come server DHCP**.

## Configurazione logica

Il router ha l’interfaccia verso la LAN con indirizzo:

```bash
192.168.10.1 /24
```

Questa sarà la porta del router usata come **default gateway** dai client.

### Comandi corretti

Una configurazione tipica è questa:

```bash
enable
configure terminal

interface fastethernet0/0
 ip address 192.168.10.1 255.255.255.0
 no shutdown
exit

ip dhcp excluded-address 192.168.10.1 192.168.10.10

ip dhcp pool POOLROUTER
 network 192.168.10.0 255.255.255.0
 default-router 192.168.10.1
exit
```


DHCP funziona a livello di trasporto tramite **UDP**.

Le porte usate sono le cosiddette **well-known ports**, cioè porte standard e note del protocollo:

- **porta 67** → server DHCP
    
- **porta 68** → client DHCP
    

Le well-known ports sono le porte da **0 a 1023**, riservate ai servizi più importanti.


# 🔹 COS’È UNA VLAN

Una **VLAN (Virtual LAN)** è una rete logica creata su uno switch.

👉 Serve per:

- separare i dispositivi in gruppi (es. Amministrazione, Vendite…)
    
- migliorare sicurezza e organizzazione
    
- evitare che tutti stiano nella stessa rete
    

💡 Anche se i PC sono collegati allo **stesso switch**, con le VLAN è come se fossero su **reti diverse**.

---

# 🔹 CREAZIONE VLAN (CLI)

Entri in modalità configurazione:

```
enable
configure terminal
```

### Crei le VLAN:

```
vlan 100
name Amministrazione
exit

vlan 200
name Vendite
exit

vlan 300
name Gestione
exit
```

👉 Controllo:

```
show vlan brief
```

---

# 🔹 PORTE ACCESS (per i PC)

Le porte dove colleghi i PC sono in modalità **access**  
👉 Possono appartenere a **una sola VLAN**

Esempio:

```
interface fastEthernet 0/1
switchport mode access
switchport access vlan 100
exit
```

---

# 🔹 COMANDO UTILISSIMO: INTERFACE RANGE

Per configurare più porte insieme:

```
interface range fastEthernet 0/1-8
switchport mode access
switchport access vlan 100
```



PROBLEMA REALE (2 PIANI / 2 SWITCH)

Hai detto una cosa GIUSTISSIMA:

👉 Non puoi usare:

- 3 cavi separati (uno per VLAN)  
    👉 perché **fisicamente impossibile o inefficiente**
    

---

# 🔹 SOLUZIONE: TRUNK

👉 Usi un **solo cavo** tra gli switch  
👉 ma dentro passano **più VLAN**

### Porta in modalità TRUNK:

```
interface fastEthernet 0/24
switchport mode trunk
```

👉 Questo si fa su **entrambi gli switch**

---

# 🔹 COSA FA IL TRUNK

- Trasporta più VLAN sullo stesso cavo
    
- Usa un protocollo di tagging
    

---

# 🔹 PROTOCOLLO DI TAGGING

👉 Si chiama:

**IEEE 802.1Q**

👉 Cosa fa:

- aggiunge un **TAG** al frame Ethernet
    
- dentro c’è scritto il numero VLAN (es. 100, 200…)
    

💡 Quindi:

- il frame cambia leggermente (aggiunta info VLAN)
    
- NON cambia completamente tipo → resta Ethernet con tag
    

---

# 🔹 COME FUNZIONA IL TRAFFICO (IMPORTANTE PER ESAME)

1. Il PC invia una **PDU (frame Ethernet)** senza VLAN
    
2. Lo switch riceve il frame
    
3. Lo switch **aggiunge il TAG VLAN (802.1Q)**
    
4. Il frame passa nel trunk
    
5. Arriva all’altro switch
    
6. Lo switch **rimuove il TAG**
    
7. Invia il frame al PC finale
    

👉 Quindi:

- nel cavo trunk → frame TAGGATO
    
- verso il PC → frame NORMALE
    

---

# 🔹 LIMITARE LE VLAN NEL TRUNK

Se vuoi far passare solo alcune VLAN:

```
switchport trunk allowed vlan 100,200
```

Oppure rimuovere:

```
switchport trunk allowed vlan remove 300

```


# 🔴 SOLUZIONE: ROUTER

Serve un **router** per permettere la comunicazione tra VLAN.

👉 Il router:

- collega reti diverse
    
- permette ai PC di parlarsi tra VLAN

## ✅ Metodo 2 (IMPORTANTE): **Router-on-a-Stick**

👉 1 solo cavo tra switch e router  
👉 ma passano più VLAN (TRUNK)

💡 È quello che stai studiando tu

---

# 🔹 COME FUNZIONA

- Switch → manda traffico VLAN tramite **TRUNK**
    
- Router → divide il traffico usando **sub-interfacce**
    

---

# 🔹 CONFIGURAZIONE ROUTER (FONDAMENTALE)

Entri nel router:

```id="tp1q6u"
enable
configure terminal
```

---

## 🔸 Crei le SUB-INTERFACCE

👉 Ogni VLAN = una sub-interfaccia

---

### VLAN 100

```id="jwbzfc"
interface gigabitEthernet 0/0.100 // crea una **sub-interfaccia** per VLAN 100
encapsulation dot1Q 100 //dice al router: “questa interfaccia gestisce la VLAN 100”
ip address 192.168.100.254 255.255.255.0 //ogni VLAN ha il suo gateway
exit
```

La porta verso il router deve essere **TRUNK**:

```id="5ymv6x"
interface fastEthernet 0/24
switchport mode trunk
```


## 7) Perché il subnetting è utile

Il subnetting serve a dividere una rete grande in sottoreti più piccole.

I vantaggi principali sono:

- **meno spreco di indirizzi**
    
- **meno traffico broadcast**
    
- **migliore organizzazione della rete**
    
- **maggiore sicurezza e separazione tra reparti**
    

Il dominio di broadcast si riduce, quindi un pacchetto broadcast viene ricevuto solo dagli host della sottorete, non da tutta la rete grande.

## 8) Subnetting: idea di base

Se la rete di partenza non basta, si prendono in prestito dei bit dalla parte host.  
Questi bit “rubati” diventano parte della rete.

Più bit prendi in prestito:

- più subnet ottieni
    
- ma meno host hai in ogni subnet
    

---

## 9) Le 3 formule fondamentali

### Formula degli host

```text
Host utilizzabili = 2^n − 2
```

dove `n` è il numero di bit rimasti alla parte host.

### Formula delle subnet

```text
Numero di subnet = 2^s
```
```
Subnet = 2² = 4
```
dove `s` è il numero di bit presi in prestito dalla parte host.

### Formula dell’intervallo

```text
Intervallo = 256 − valore dell’ultimo ottetto della subnet mask
```

Serve per trovare rapidamente il salto tra le subnet.

Esempio:

- mask `255.255.255.192`
    
- intervallo = `256 − 192 = 64`
    

Le subnet saranno:

```text
.0
.64
.128
.192
```


11) Esempio rapido

Rete:

```text
192.168.10.0/24
```

Serve almeno **50 host** per subnet.

Cerco il minimo numero di bit host:

- `2^5 − 2 = 30` → non basta
    
- `2^6 − 2 = 62` → va bene
    

Quindi servono **6 bit per gli host**.

Da `/24` ho 8 bit host, quindi ne prendo in prestito:

```text
8 − 6 = 2 bit
```

Numero di subnet:

```text
2^2 = 4 subnet
```

La nuova mask è:

```text
/26 = 255.255.255.192
```

Intervallo:

```text
256 − 192 = 64
```

Subnet:

- `192.168.10.0/26`
    
- `192.168.10.64/26`
    
- `192.168.10.128/26`
    
- `192.168.10.192/26`
    

Ogni subnet ha 62 host utilizzabili.

Questa parte è **pura teoria da memorizzare**.

| Classe | Primo byte (binario) | Primo byte (decimale) | Subnet di default |
| ------ | -------------------- | --------------------- | ----------------- |
| A      | `0xxxxxxx`           | 1 – 126               | /8                |
| B      | `10xxxxxx`           | 128 – 191             | /16               |
| C      | `110xxxxx`           | 192 – 223             | /24               |
| D      | `1110xxxx`           | 224 – 239             | Multicast         |
| E      | `1111xxxx`           | 240 – 255             | Riservata         |

👉 **Questo spiega tutte le domande sui bit fissi**


 **Prima soddisfi gli host, poi verifichi le reti.  
> Se una delle due condizioni fallisce, la subnet non va bene.**


# 1) ACL e firewall

## COS’È

Una **ACL** (*Access Control List*) è una lista ordinata di regole usata per decidere se un pacchetto di rete deve essere **permesso** o **negato**.

Il **firewall** è il sistema che controlla il traffico che attraversa un punto di rete e applica queste regole.

In pratica:

* il firewall **osserva il traffico**
* le ACL **decidono cosa fare** con quel traffico

## A COSA SERVE

Serve per:

* bloccare traffico non desiderato
* permettere solo alcune comunicazioni
* proteggere reti interne
* limitare accessi a servizi o indirizzi specifici

## COME FUNZIONA

Ogni regola ACL ha due parti:

* **pattern** → a quali pacchetti si applica la regola
* **azione** → cosa fare con quei pacchetti

  * `permit` = consenti
  * `deny` = nega

Le regole vengono controllate **in sequenza**:

1. prima regola
2. seconda regola
3. terza regola
4. ecc.

Appena un pacchetto corrisponde a una regola, si applica subito l’azione e **non si controllano più le regole successive**.

Se nessuna regola corrisponde, entra in gioco la policy finale.

### Firewall inclusivo ed esclusivo

Qui ci sono due modi di ragionare:

* **firewall inclusivo** → blocca tutto ciò che non è esplicitamente permesso
  È il modello più sicuro.
  In Cisco questo corrisponde alla logica del **deny implicito finale**.(black hole, rischia di bloccare anche cio che non dovrebbe essere bloccato se manca una regola2)

* **firewall esclusivo** → permette tutto, tranne ciò che è esplicitamente bloccato
  È più comodo, ma meno sicuro.

### Correzione importante

In Cisco ACL c’è sempre un **deny implicito finale**: se un pacchetto non matcha nessuna regola, viene scartato.
Per rendere il comportamento “permetti tutto il resto”, bisogna inserire una regola tipo:

```bash
permit any
```

---

## ESEMPIO

Vuoi bloccare un solo host nella rete:

```bash
access-list 1 deny host 192.168.2.3
access-list 1 permit any
```

Qui:

* la prima regola blocca quel PC specifico
* la seconda permette tutto il resto

---

## DIFFERENZE IMPORTANTI

* **ACL** = insieme di regole
* **firewall** = il sistema che applica il controllo del traffico
* **router** = il dispositivo su cui spesso si configurano le ACL

Da non confondere anche con:

* **antivirus** = protegge da malware sui file e sui processi
* **firewall** = filtra il traffico di rete

Una **ACL standard** filtra il traffico usando solo l’**indirizzo IP sorgente**.


### Wildcard mask

Nelle ACL Cisco non si usa la subnet mask normale, ma la **wildcard mask**.

Esempio:

```bash
access-list 1 deny 192.168.2.3 0.0.0.0
access-list 1 permit any
```

La wildcard `0.0.0.0` significa:
“devi combaciare esattamente con quell’IP”.

Equivale a scrivere:

```bash
access-list 1 deny host 192.168.2.3
```

```bash
show access-lists
```

# ACL estese

## COS’È

Una **ACL estesa** (*Extended Access Control List*) è una lista di regole che filtra il traffico di rete in modo più preciso rispetto a una ACL standard.

Può controllare:

* **protocollo**
* **IP sorgente**
* **IP destinazione**
* **porte** del servizio

Questa è la differenza fondamentale:
la ACL standard guarda solo la sorgente, mentre la ACL estesa può guardare anche la destinazione e il servizio usato.

---

## A COSA SERVE

Serve quando vuoi fare un filtro più fine, per esempio:

* bloccare un host verso una certa rete, ma non verso altre
* consentire solo un certo servizio, come HTTP
* bloccare altri servizi anche se la destinazione è la stessa

Questa maggiore precisione è il motivo per cui le ACL estese sono molto importanti.

---

## COME FUNZIONA

La sintassi base, nel tuo corso, è questa:

```bash
access-list 100-199 permit/deny protocollo ip_sorgente wildcard_sorgente ip_destinazione wildcard_destinazione
```

Le ACL estese numerate usano, nei tuoi esempi, l’intervallo **100-199**.

## 1. Creo la ACL estesa
```bash
Router(config)# access-list 100 permit tcp 192.168.2.0 0.0.0.255 192.168.1.4 0.0.0.0 eq 80
Router(config)# access-list 100 permit ip 192.168.2.0 0.0.0.255 192.168.3.0 0.0.0.255
```
### 2. Applico la ACL all’interfaccia

```bash
Router(config)# interface Gig0/0
Router(config-if)# ip access-group 100 in
```

Questa regola significa:

* **permit** → consenti
* **tcp** → il protocollo deve essere TCP
* **192.168.2.0 0.0.0.255** → tutta la rete rosa
* **192.168.1.4 0.0.0.0** → solo il server verde
* **eq 80** → solo la porta 80, cioè HTTP

# 4) Perché si mette vicino alla sorgente

Questo è un altro punto molto importante.

Le ACL estese si mettono **vicino alla sorgente**, perché sono precise.

### Vantaggio

Blocchi il traffico indesiderato subito, senza farlo viaggiare inutilmente nella rete.

### Esempio

Se un host deve essere bloccato verso certi servizi, è inutile farlo arrivare fino alla rete di destinazione per poi rifiutarlo lì.

# 6) Porta 80 e servizio HTTP

Nel video 18 compare:

```bash
eq 80
```

Questo significa:

* controlla la porta 80
* quindi il servizio HTTP

### Importante da ricordare

L’ACL estesa non blocca solo indirizzi: può bloccare anche **servizi specifici**.

Questa è una delle sue funzioni più importanti.


# 1) DMZ

## COS’È

La **DMZ** (_Demilitarized Zone_) è una zona di rete separata, posta tra Internet e la LAN aziendale.

Dentro la DMZ si mettono i servizi che devono essere accessibili dall’esterno, per esempio:

- un **server web**
    
- un server email
    
- un servizio pubblico
    

L’idea è questa: il server deve essere visibile da Internet, ma la **LAN interna** deve restare protetta.

## A COSA SERVE

Serve per pubblicare un servizio su Internet senza esporre tutta la rete aziendale.

Quindi:

- dall’esterno posso raggiungere il server della DMZ
    
- dall’esterno **non** posso entrare liberamente nella LAN
    
- se il server viene compromesso, il danno resta più limitato
    

## COME FUNZIONA

La rete aziendale viene divisa in almeno tre parti:

- **Internet / rete esterna**
    
- **DMZ**
    
- **LAN interna**
    

Il traffico dall’esterno può arrivare al server della DMZ, ma non deve poter passare liberamente verso la LAN.

Questa è la differenza fondamentale rispetto a una rete senza DMZ: qui il server pubblico non sta nella LAN privata, ma in una zona separata e più controllata.

---

# 2) ACL estesa nella DMZ

## COS’È

In questo caso la **ACL estesa** serve a filtrare il traffico in modo preciso:

- per **protocollo**
    
- per **IP sorgente**
    
- per **IP destinazione**
    
- per **porta**
    

## A COSA SERVE

Serve per dire, per esempio:

- chi dall’esterno può raggiungere il server pubblico
    
- quali servizi sono permessi
    
- quali risposte TCP possono tornare nella LAN
    
- quali accessi alla LAN devono essere bloccati
    

## COME FUNZIONA

Qui la logica è diversa rispetto ai casi precedenti.

Nei video precedenti tu eri nella LAN e potevi ragionare “vicino alla sorgente” oppure “vicino alla destinazione”.  
Con la DMZ il punto importante è un altro:

> non posso andare a configurare i router di Internet uno per uno.  
> Posso agire solo sul **router di confine** della mia azienda.

Quindi la ACL si mette sull’interfaccia del router che guarda verso l’esterno, cioè verso Internet, e si applica **in inbound**.

Questo è molto importante:

- il traffico entra nel router dalla rete esterna
    
- quindi la ACL controlla i pacchetti **in ingresso**
    
- non ha senso provare a filtrare sui router del web, perché non li gestisco io
    

---

# 3) Caso del server pubblico in DMZ

## OBIETTIVO

Permettere:

- accesso al server web in DMZ solo sul servizio HTTP
    

Bloccare:

- accessi non autorizzati
    
- tentativi di entrare nella LAN interna
    

### Comando

```bash
access-list 100 permit tcp any 192.168.3.2 0.0.0.0 eq 80
```

Oppure in forma equivalente:

```bash
access-list 100 permit tcp any host 192.168.3.2 eq 80
```

---
# 4) Accesso verso la LAN: traffico di risposta TCP

Nel tuo video c’è un punto molto importante: la LAN deve poter ricevere le **risposte** di una connessione già avviata.

Per esempio:

- un client della LAN apre un sito web nella DMZ o su Internet
    
- il server risponde
    
- la risposta deve tornare indietro
    

Per consentire questo, si usa:

```bash
access-list 100 permit tcp any 192.168.1.0 0.0.0.255 established
```

## COSA SIGNIFICA

Questa regola permette il traffico TCP verso la rete verde **solo se la connessione è già stata stabilita**.

### `established`

`established` non significa “connessione perfetta” in senso generico.  
Significa che il pacchetto TCP ha i flag necessari, in pratica quelli usati per indicare una sessione già avviata, tipicamente **ACK** o **RST**.

Questa regola serve a dire:

> accetta solo le risposte di connessioni già iniziate dall’interno

Quindi:

- una richiesta nuova dall’esterno verso la LAN viene bloccata
    
- una risposta a una sessione già iniziata può passare

# NAT statico

## COS’È

Il **NAT** (_Network Address Translation_) è il meccanismo che traduce gli indirizzi IP tra rete privata e rete pubblica.

Il **NAT statico** è una traduzione **uno a uno**:

- a un **indirizzo IP privato** corrisponde sempre lo **stesso indirizzo IP pubblico**
    
- e viceversa
    

Questa associazione è fissa, non cambia nel tempo.

## A COSA SERVE

Serve quando vogliamo che un dispositivo della rete privata sia raggiungibile dall’esterno tramite un indirizzo pubblico stabile.

È utile soprattutto per:

- server interni
    
- servizi che devono essere accessibili da Internet
    
- configurazioni in cui serve una corrispondenza fissa tra interno ed esterno
    

## COME FUNZIONA

In una rete privata, gli host usano indirizzi **privati**, che non sono instradabili su Internet.  
Gli indirizzi privati, infatti, non sono visibili direttamente sulla rete pubblica.

Quindi il router di confine, cioè il router tra:

- **rete interna privata**
    
- **rete esterna pubblica**
    

deve tradurre gli indirizzi.

Con il NAT statico:

- dall’interno, un host privato viene visto all’esterno con un certo indirizzo pubblico fisso
    
- dall’esterno, chi contatta quell’indirizzo pubblico viene indirizzato verso il corrispondente host interno privato
    

Sul router di confine bisogna dire quali interfacce sono:

- **inside** → verso la rete interna
    
- **outside** → verso la rete esterna
    

Esempio:

```bash
interface fastethernet0/0
 ip nat inside

interface fastethernet0/1
 ip nat outside
```

Poi si crea la traduzione statica:

```bash
ip nat inside source static <indirizzo_privato> <indirizzo_pubblico>
```

Esempio concreto:

```bash
ip nat inside source static 192.168.1.10 203.0.113.10


```bash
show ip nat translations
```

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


* **well-known ports**: `0–1023`
* **registered ports**: `1024–49151`
* **dynamic/private ports**: `49152–65535`

Nel PAT il router usa le porte per distinguere le varie connessioni.

## 1) Definisco chi può essere tradotto

Prima bisogna creare l’ACL che dice quali host interni possono usare il PAT.

Per esempio:

```bash id="3jv2xq"
access-list 10 permit 10.0.0.0 0.0.0.255
```

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
# Wildcard mask

## COS’È

La **wildcard mask** è una maschera usata per **selezionare**, **filtrare** o **confrontare** indirizzi IP.

È l’opposto logico della subnet mask:

* nella **subnet mask** i bit a **1** indicano la parte di rete
* nella **wildcard mask** i bit a **0** devono corrispondere esattamente, mentre i bit a **1** vengono ignorati

Questa è la frase chiave da ricordare.


# VPN

## COS’È

La **VPN** (*Virtual Private Network*) è una tecnologia che crea una **connessione privata e sicura** sopra una rete pubblica, come Internet.

In pratica, il tuo computer si collega a un **server VPN** e da lì il traffico viene inoltrato verso la destinazione finale attraverso un **tunnel virtuale cifrato**.

---

## A COSA SERVE

Serve per:

* aumentare la **sicurezza** della comunicazione su reti pubbliche
* proteggere i dati da intercettazioni
* collegarsi a reti aziendali da remoto
* nascondere l’IP reale dell’utente verso i siti visitati
* accedere a contenuti che in certi paesi possono essere limitati

È molto usata nel lavoro da remoto, perché permette di collegarsi alla rete aziendale in modo protetto.

---

## COME FUNZIONA

Il funzionamento base è questo:

1. il computer crea normalmente una richiesta di rete
2. invece di mandarla direttamente al sito finale, la invia al **server VPN**
3. il software VPN **incapsula** i dati in un altro pacchetto
4. i dati vengono **cifrati**
5. il pacchetto attraversa Internet fino al server VPN
6. il server VPN lo apre, decifra i dati e inoltra la richiesta alla destinazione
7. la risposta segue il percorso inverso

### Mini schema

`PC → VPN tunnel cifrato → server VPN → server finale`

Il server finale vede come mittente il **server VPN**, non il tuo computer.

---

## ESEMPIO

Se ti colleghi a un sito tramite VPN:

* il tuo PC manda i dati al server VPN
* il server VPN li inoltra al sito richiesto, per esempio YouTube
* YouTube risponde al server VPN
* il server VPN rimanda la risposta al tuo PC

Così il sito finale non vede direttamente il tuo IP reale.

---

## DIFFERENZE IMPORTANTI

### VPN vs connessione normale

* **connessione normale** → il traffico va direttamente al sito
* **VPN** → il traffico passa prima dal server VPN

### VPN vs proxy

* **proxy** = intermediario soprattutto a livello applicativo
* **VPN** = crea un tunnel cifrato per tutto il traffico o per gran parte del traffico di rete

### VPN vs firewall

* **VPN** = protegge il canale di comunicazione
* **firewall** = filtra il traffico secondo regole di accesso

### Correzione importante

Nei tuoi appunti compare l’idea di un “firewall dentro la VPN”.
Meglio dirlo così: alcune soluzioni VPN possono integrare anche funzioni di filtro o sicurezza, ma il **firewall non è la definizione della VPN**.
