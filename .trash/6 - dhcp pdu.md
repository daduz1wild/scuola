

---


Perfetto. Qui stai parlando del funzionamento del **DHCP**, soprattutto delle fasi iniziali del processo chiamato spesso **DORA**:

- Discover
    
- Offer
    
- Request
    
- Acknowledge
    

Ti rispiego i tuoi appunti in modo ordinato e corretto.

---

# DHCP – Fasi Discover, Offer e Request

# 1) DHCP Discover

## COS’È

È la prima fase del DHCP.  
Il client cerca un server DHCP nella rete.

## A COSA SERVE

Serve per dire:

> “C’è un server DHCP disponibile?”

Il client ancora non ha un indirizzo IP valido, quindi deve usare il broadcast.

## COME FUNZIONA

Il client invia un messaggio:

- in **broadcast**
    
- verso tutti i dispositivi della rete locale
    

Dato che il client non conosce ancora il server DHCP:

- usa come IP sorgente `0.0.0.0`
    
- usa come IP destinazione `255.255.255.255`
    

A livello MAC usa:

- MAC destinazione:  
    `FF:FF:FF:FF:FF:FF`
    

Questo è il MAC broadcast Ethernet.

Quindi il frame viene ricevuto da tutti gli host della LAN.

### Correzione importante

Nei tuoi appunti c’è:

> “FF.FF.FF:FF”

La forma corretta è:

`FF:FF:FF:FF:FF:FF`

## ESEMPIO

Quando colleghi il telefono al Wi-Fi:

1. il telefono non ha ancora un IP;
    
2. manda un DHCP Discover in broadcast;
    
3. il router DHCP riceve la richiesta.
    

## DIFFERENZE IMPORTANTI

Broadcast significa:

- tutti ricevono il messaggio;
    
- ma solo il server DHCP risponde in modo utile.
    

## RIASSUNTO FINALE

Nel DHCP Discover il client cerca un server DHCP tramite broadcast.  
Usa indirizzi speciali perché non possiede ancora un IP valido.  
Il messaggio arriva a tutta la rete locale.

---

# 2) DHCP Offer

## COS’È

È la risposta del server DHCP al client.

## A COSA SERVE

Serve a proporre al client:

- un indirizzo IP
    
- subnet mask
    
- gateway
    
- DNS
    
- altri parametri di rete
    

## COME FUNZIONA

Il server DHCP riceve il Discover e prepara un messaggio DHCP Offer.

Qui entra il concetto di **incapsulamento**.

Il messaggio viene inserito dentro vari livelli:

- dati DHCP
    
- segmento UDP
    
- pacchetto IP
    
- frame Ethernet
    

Nel frame Ethernet viene inserito il **MAC del client destinatario**.

Quindi:

- tutti possono ricevere fisicamente il frame se è broadcast;
    
- ma solo il client con quel MAC lo riconosce come proprio e lo elabora davvero.
    

### Correzione importante

Non è corretto dire semplicemente:

> “solo il client col MAC giusto apre il pacchetto”

Più precisamente:

- la scheda di rete controlla il MAC destinazione;
    
- il sistema operativo elabora il frame solo se il MAC coincide oppure se è broadcast.
    

## ESEMPIO

Il router DHCP propone:

- IP: `192.168.1.20`
    
- mask: `255.255.255.0`
    
- gateway: `192.168.1.1`
    

Il client riceve l’offerta e decide se accettarla.

## DIFFERENZE IMPORTANTI

- **Discover** = il client cerca un DHCP
    
- **Offer** = il server propone una configurazione
    

## RIASSUNTO FINALE

Nel DHCP Offer il server propone la configurazione di rete al client.  
Il messaggio sfrutta l’incapsulamento e contiene il MAC del destinatario.  
Il client riconosce che l’offerta è destinata a lui.

---

# 3) DHCP Request

## COS’È

È la fase in cui il client comunica quale offerta DHCP ha scelto.

## A COSA SERVE

Serve a dire:

> “Accetto questa configurazione IP.”

## COME FUNZIONA

Il client invia un messaggio DHCP Request.

Anche questa fase avviene spesso in **broadcast**, perché:

- il client non è ancora completamente configurato;
    
- altri server DHCP potrebbero aver inviato offerte.
    

Il broadcast permette a tutti i server DHCP di sapere:

- quale offerta è stata accettata;
    
- quali offerte devono essere annullate.
    

### Punto molto importante

Il client:

- sceglie un server DHCP;
    
- comunica pubblicamente la scelta tramite broadcast.
    

## ESEMPIO

Due server DHCP rispondono al client.

Il client sceglie il primo e manda:

- DHCP Request in broadcast
    

Così:

- il server scelto conferma;
    
- l’altro capisce che la sua offerta è stata rifiutata.
    

## DIFFERENZE IMPORTANTI

- **Offer** = proposta del server
    
- **Request** = accettazione del client
    

## RIASSUNTO FINALE

Nel DHCP Request il client accetta un’offerta DHCP.  
Il messaggio è spesso in broadcast per informare tutti i server DHCP presenti nella rete.  
Serve a completare l’assegnazione dell’indirizzo IP.

---

# Collegamento generale DHCP (DORA)

Sequenza completa:

1. **Discover** → il client cerca un server DHCP
    
2. **Offer** → il server propone configurazione IP
    
3. **Request** → il client accetta l’offerta
    
4. **Acknowledge (ACK)** → il server conferma definitivamente
    

Questo schema è molto chiesto all’orale.

---

## Domande possibili da maturità

- Perché il DHCP Discover usa il broadcast?
    
- Perché il client non può usare subito un IP normale?
    
- Che ruolo ha il MAC nella fase DHCP Offer?
    
- Che cos’è il processo DORA?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: DHCP Discover in broadcast, uso del MAC broadcast, DHCP Offer come proposta del server, DHCP Request come scelta del client, uso dell’incapsulamento.
    
- ⚠ Correzioni: il MAC broadcast corretto è `FF:FF:FF:FF:FF:FF`; non è il “pacchetto DHCP” ad avere direttamente il MAC ma il frame Ethernet che lo incapsula; il client non “apre” il pacchetto manualmente ma la scheda di rete e il sistema operativo verificano il MAC destinazione.
    
- ➕ Integrazioni utili: indirizzi IP speciali `0.0.0.0` e `255.255.255.255`, spiegazione del motivo del broadcast nel Request, collegamento con il processo DORA.
    
- ❌ Non trattato: DHCP ACK/NACK, lease time, rinnovo dell’indirizzo IP, relay DHCP.
    

[DA RICORDARE]

- concetto chiave: il client DHCP inizialmente non ha un IP, quindi usa il broadcast per trovare il server DHCP.
    
- errore comune: confondere MAC broadcast e IP broadcast oppure pensare che il DHCP lavori solo con IP normali fin dall’inizio.
    
- collegamento utile: DHCP usa broadcast, MAC address e incapsulamento per permettere a un dispositivo senza IP di entrare correttamente nella rete.