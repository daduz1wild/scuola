Certo. Qui trovi una spiegazione **chiara, precisa e adatta alla maturità** sul **NAT statico**, con i tuoi appunti corretti e integrati.

---

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
    

Mini schema:

`IP privato ↔ IP pubblico`

### Punto importante

Il NAT statico è una traduzione **1:1**, quindi:

- un host privato ha un solo indirizzo pubblico associato
    
- quell’indirizzo pubblico non viene condiviso con altri host
    

---

## ESEMPIO

Supponiamo che nella rete privata ci sia un server con:

- IP privato: `192.168.1.10`
    

e che lo vogliamo rendere raggiungibile da Internet tramite:

- IP pubblico: `203.0.113.10`
    

Allora il router traduce sempre:

`192.168.1.10 ↔ 203.0.113.10`

Così:

- se un client interno comunica verso l’esterno, il suo indirizzo privato viene tradotto nel pubblico
    
- se un client esterno contatta `203.0.113.10`, il router inoltra la richiesta al server interno `192.168.1.10`
    

---

## DIFFERENZE IMPORTANTI

### NAT statico vs NAT dinamico

- **NAT statico** = associazione fissa 1:1
    
- **NAT dinamico** = l’indirizzo pubblico viene scelto da un pool e può cambiare
    

### NAT statico vs PAT

- **NAT statico** = un IP privato ↔ un IP pubblico
    
- **PAT** = tanti IP privati condividono un solo IP pubblico usando porte diverse
    

Questa è una distinzione molto importante all’orale.

---

## CONFIGURAZIONE SUL ROUTER

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
```

### Correzione importante

La forma corretta del comando è:

- **inside local** = indirizzo privato interno
    
- **inside global** = indirizzo pubblico con cui l’host è visto dall’esterno
    

Quindi il senso corretto è:

```bash
ip nat inside source static inside-local inside-global
```

---

## VERIFICA DELLE TRADUZIONI

Per controllare le traduzioni attive si usa:

```bash
show ip nat translations
```

Questo comando mostra le corrispondenze NAT configurate e in uso.

---

## RIASSUNTO FINALE

Il NAT statico traduce in modo fisso un indirizzo privato in un indirizzo pubblico.  
È una traduzione 1:1, utile soprattutto per rendere raggiungibili dall’esterno server interni.  
Sul router si configurano le interfacce inside e outside e si definisce la mappatura statica.  
Il comando `show ip nat translations` permette di controllare le traduzioni attive.

---

## DOMANDE POSSIBILI DA MATURITÀ

- Che cos’è il **NAT statico** e in cosa si differenzia dal NAT dinamico?
    
- Perché un host della rete privata non può essere raggiunto direttamente da Internet?
    
- Come si configura il NAT statico su un router?
    

---

[CONTROLLO STUDIO]

- ✔ Corretto: NAT come traduzione tra rete privata e pubblica, NAT statico come mapping 1:1, necessità del router di confine, configurazione inside/outside, comando di verifica delle traduzioni.
    
- ⚠ Correzioni: non dire che “il server non può rispondere a un indirizzo privato” in senso assoluto; il punto corretto è che gli indirizzi privati non sono instradabili su Internet. Il comando va interpretato come `inside-local` ↔ `inside-global`.
    
- ➕ Integrazioni utili: distinzione NAT statico/PAT, significato di inside local e inside global, esempio concreto di server interno pubblicato con IP pubblico fisso.
    
- ❌ Non trattato: NAT dinamico e PAT in dettaglio, port forwarding, IPv6 e sua relazione con NAT.
    

[DA RICORDARE]

- concetto chiave: il NAT statico crea una corrispondenza fissa 1:1 tra IP privato e IP pubblico.
    
- errore comune: confondere NAT statico con PAT o pensare che il NAT serva solo a “nascondere” i PC.
    
- collegamento utile: il NAT statico è fondamentale quando un server interno deve essere raggiungibile dall’esterno con un indirizzo pubblico stabile.