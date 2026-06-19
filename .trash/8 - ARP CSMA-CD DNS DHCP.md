Sì: nei tuoi appunti ci sono **alcuni punti importanti da aggiungere** e **due correzioni da fare**. Ti lascio una versione pulita, integrata e più adatta all’orale.

---

# 1) ARP, MAC, IP e comunicazioni di rete

## COS’È

**ARP** (_Address Resolution Protocol_) serve a trovare il **MAC address** partendo da un **indirizzo IP**.

## A COSA SERVE

Serve perché, nella rete locale, l’IP da solo non basta: per inviare davvero un frame Ethernet bisogna conoscere il MAC del destinatario.

## COME FUNZIONA

Quando un host vuole parlare con un altro host della LAN:

1. controlla la propria **ARP cache** / **ARP table**;
    
2. se non trova l’associazione, invia una **ARP Request** in **broadcast**;
    
3. il broadcast usa come MAC di destinazione:  
    `FF:FF:FF:FF:FF:FF`
    
4. tutti ricevono la richiesta, ma risponde solo l’host che ha quell’IP;
    
5. quel host invia una **ARP Reply** con il proprio MAC;
    
6. entrambi possono salvare l’associazione nella propria cache ARP.
    

Mini schema:

`IP noto → MAC sconosciuto → ARP Request broadcast → ARP Reply → salvo IP/MAC`

## ESEMPIO

Se A conosce l’IP di B ma non il suo MAC, manda una richiesta ARP a tutta la LAN.  
B risponde con il suo MAC, e A può inviare i dati.

## DIFFERENZE IMPORTANTI

ARP:

- risolve **IP → MAC**
    
- lavora nella rete locale
    
- non fa il contrario, quindi non risolve MAC → IP
    

### Correzione importante

Nella rete locale, lo **switch** non fa instradamento come un router.  
Lo switch inoltra i **frame** usando il **MAC address** e la sua tabella CAM.

---

# 2) Frame Ethernet, pacchetto IP e ping

## COS’È

Un dato che viaggia in rete viene incapsulato a più livelli.

## A COSA SERVE

Serve per permettere al messaggio di viaggiare correttamente nella rete.

## COME FUNZIONA

Nel caso del ping:

- il **payload** applicativo è il messaggio ICMP
    
- tutto viene inserito in un **pacchetto IP**
    
- il pacchetto IP viene inserito in un **frame Ethernet**
    

Quindi:

- **IP packet** = contiene IP sorgente, IP destinazione e dati
    
- **Ethernet frame** = contiene MAC sorgente, MAC destinazione, il pacchetto IP e il trailer
    

### Correzione importante

L’IP **da solo non basta** per inviare il pacchetto su una LAN.  
Per la consegna a livello locale servono anche i **MAC address**.

Se il destinatario è fuori rete, il frame non va al MAC del destinatario finale, ma al **MAC del gateway/router**.

## ESEMPIO

Quando fai ping a un altro PC della rete, il pacchetto IP viene trasportato dentro un frame Ethernet con i MAC corretti.

## DIFFERENZE IMPORTANTI

- **IP packet** = livello rete
    
- **Ethernet frame** = livello collegamento dati
    
- **broadcast MAC** = `FF:FF:FF:FF:FF:FF`
    

## RIASSUNTO FINALE

Il pacchetto IP contiene gli indirizzi IP e i dati.  
Il frame Ethernet aggiunge i MAC e il trailer.  
Sulla rete locale, senza MAC il pacchetto non può essere consegnato correttamente.

---

# 3) Tabella ARP

## COS’È

La tabella ARP è una memoria temporanea negli host che contiene le corrispondenze **IP ↔ MAC**.

## A COSA SERVE

Serve a evitare di rifare ogni volta la richiesta ARP.

## COME FUNZIONA

Quando un host scopre un’associazione IP/MAC, la salva nella propria ARP cache.  
Le entry restano per un tempo limitato e poi scadono.

### Correzione importante

Dire “rimangono in memoria solo per 5 minuti” va bene come idea generale, ma il tempo **non è uguale in tutti i sistemi**.  
Meglio dire che sono **temporanee** e scadono dopo un certo tempo.

Comando utile:  
`arp -a`

## RIASSUNTO FINALE

La tabella ARP conserva le corrispondenze IP/MAC già scoperte.  
È temporanea e viene aggiornata durante la comunicazione.  
È molto utile per evitare richieste ARP continue.

---

