iOttima iniziativa! La **maturità** richiede non solo la conoscenza teorica, ma anche la capacità di contestualizzare le scelte tecnologiche in scenari reali (il cosiddetto "perché si fa così").

Iniziamo con il primo documento: **01_UA5_LEZ01.pdf - La connessione con i cavi in rame**.

---

### Analisi Documento 1: Connessione con cavi in rame

Questo modulo introduce i fondamenti fisici e standardizzati del cablaggio strutturato, concentrandosi sul rame come mezzo trasmissivo.

#### 1. Mappa Concettuale e Mezzi Trasmissivi (Slide 4-5)

La lezione classifica i mezzi trasmissivi in tre nature: **elettrica** (rame), **ottica** (fibra) ed **elettromagnetica** (wireless) .

* **Approfondimento Maturità:** All'esame è fondamentale saper distinguere tra "mezzo guidato" (cavi) e "mezzo non guidato" (wireless). Il rame è il mezzo d'elezione per il **cablaggio orizzontale** (tra il piano e la postazione) perché è economico e facile da installare rispetto alla fibra.


* **Lato Pratico:** Si sceglie il rame (UTP) per distanze entro i 100 metri. Oltre questa soglia, l'attenuazione del segnale elettrico diventa critica e si deve passare alla fibra ottica o utilizzare dei ripetitori (switch).



#### 2. Fisica della Trasmissione: Impedenza (Slide 6-8)

Viene introdotto il concetto di **impedenza (Z)**, composta da resistenza, reattanza induttiva e capacitiva .

* **Approfondimento Maturità:** In una rete dati, è cruciale l'**adattamento di impedenza**. Se il cavo ha un'impedenza diversa dai connettori o dalle interfacce, parte del segnale viene riflesso verso la sorgente (Return Loss), causando errori di bit.
* **Lato Pratico:** Ecco perché non si possono fare "giunte" artigianali ai cavi di rete come si farebbe con i fili elettrici: ogni giunta altera l'impedenza del mezzo.

#### 3. Tipologie di Cavo: Coassiale vs Doppino (Slide 9-15)

Il documento analizza il passaggio storico dal cavo coassiale al **Twisted Pair** (doppino) .

* 
**Perché l'intreccio?** I fili sono attorcigliati a coppie per annullare i campi magnetici opposti, riducendo le interferenze (diafonia) .


* **Schermatura (UTP, FTP, STP):**
* **UTP (Unshielded):** Il più comune, flessibile ed economico. Adatto a uffici standard.


* 
**STP/FTP (Shielded/Foiled):** Hanno una calza metallica per proteggere dai disturbi elettromagnetici esterni .


* **Lato Pratico:** Se devi far passare un cavo dati vicino a cavi elettrici ad alta tensione o in un'officina con motori, *devi* usare un cavo schermato (STP) per evitare che i "rumori" elettrici corrompano i dati.



#### 4. Categorie di Cavi (Slide 16-18)

Le categorie (Cat 5, 6, 7) definiscono la banda passante e la velocità massima .

* 
**Cat 5e:** Fino a 100 Mbps/1 Gbps (standard minimo ormai superato) .


* 
**Cat 6/6a:** Fino a 1 Gbps/10 Gbps (lo standard attuale per il cablaggio strutturato moderno).


* 
**Cat 7:** Fino a 10 Gbps con frequenze molto alte (600 MHz), richiede connettori speciali.


* **Approfondimento Maturità:** La velocità dipende dalla frequenza fondamentale supportata dal cavo. Più alta è la categoria, maggiore è il numero di intrecci per metro (twist rate) e migliore è l'isolamento tra le coppie.

#### 5. Schemi di Collegamento: Straight, Cross e Rollover (Slide 19-23)

Qui si entra nel cuore della configurazione fisica .

* **Straight-through (Diretto):** Collega dispositivi diversi (PC a Switch). I pin 1,2,3,6 da un lato vanno ai corrispettivi 1,2,3,6 dall'altro.


* **Cross-over (Incrociato):** Collega dispositivi simili (PC a PC, Switch a Switch). Incrocia le coppie di trasmissione (TX) con quelle di ricezione (RX).


* 
**Rollover:** Serve esclusivamente per la configurazione (porta Console) dei dispositivi Cisco/professionali dal PC.


* **Lato Pratico e Maturità:** Oggi quasi tutti gli switch moderni supportano l'**Auto-MDIX**, una funzione che rileva automaticamente il tipo di cavo e "incrocia" elettronicamente i pin se necessario. Tuttavia, all'esame devi conoscere la differenza teorica perché l'Auto-MDIX potrebbe non essere disponibile su dispositivi datati.

---

### Consigli per la Maturità su questo file:

Se ti chiedono di progettare una piccola LAN:

1. Scegli sempre **Cat 6** o superiore per garantire scalabilità a 10Gbps.
2. Specifica che userai cavi **UTP** per la facilità di posa, a meno di forti interferenze ambientali.
3. Menziona lo standard **TIA/EIA 568B** (il più usato in Europa) per la piedinatura dei connettori RJ45.



**Quando sei pronto, passiamo al file 02 (Le misure sui cavi).** Dimmi pure se vuoi approfondire qualche slide specifica di questo primo blocco!



Passiamo al secondo documento: **02_UA5_LEZ02.pdf - Le misure sui cavi in rame**.

Questa lezione è fondamentale per la Maturità perché si sposta dalla teoria della costruzione del cavo alla **certificazione**. Quando si realizza un impianto, non basta collegare i fili; bisogna testarli con uno strumento (certificatore) per garantire che la rete funzioni alle velocità dichiarate.

---

### 1. Attenuazione (Slide 15)

L'attenuazione è la perdita di potenza del segnale mentre attraversa il cavo, misurata in **decibel (dB)**.

- **Spiegazione Grafica:** Immagina un'onda che parte alta e forte all'inizio del cavo e diventa sempre più piccola e "piatta" man mano che si avvicina alla fine.
    
- **Lato Pratico:** È il motivo per cui il limite del cablaggio orizzontale è **90 metri** (più 10m di patch). Oltre questa distanza, il segnale diventa così debole che il ricevitore non riesce più a distinguere gli "0" dagli "1" dal rumore di fondo.
    
- **Per l'esame:** Ricorda che l'attenuazione aumenta con l'aumentare della **frequenza** e della **temperatura**. Un cavo che passa vicino a una fonte di calore perderà più segnale.
    

---

### 2. Paradiafonia e Telediafonia (Slide 16-17)

Il fenomeno della diafonia (**Crosstalk**) si verifica quando il segnale elettrico in una coppia di fili genera un disturbo elettromagnetico in una coppia adiacente.

- **NEXT (Near-End Crosstalk - Paradiafonia):** È il disturbo misurato dallo stesso lato in cui si trova il trasmettitore. È il parametro più critico.
    
- **FEXT (Far-End Crosstalk - Telediafonia):** È il disturbo misurato all'estremità opposta del cavo.
    
- **Lato Pratico:** Se durante un test il NEXT è troppo alto, spesso il problema è nel **connettore RJ45**. Se i fili sono stati "sbinati" (svolti) troppo per crimparli, perdono la protezione data dall'intreccio e iniziano a disturbarsi a vicenda proprio vicino alla presa.
    
- **Per l'esame:** Per ridurre la diafonia si agisce sulla geometria del cavo (aumentando i giri di intreccio per metro o inserendo un separatore a croce in plastica all'interno del cavo Cat6).
    

---

### 3. Riflessione e Return Loss (Slide 18-19)

Quando il segnale incontra una variazione di impedenza (es. una giunta fatta male o un cavo schiacciato), parte dell'energia "rimbalza" e torna indietro verso la sorgente. Questo si chiama **Return Loss**.

- **Spiegazione Grafica:** Pensa a un'onda d'acqua che colpisce un muro e torna indietro, scontrandosi con le nuove onde che arrivano e creando caos.
    
- **Lato Pratico:** Il Return Loss è causato da danni fisici al cavo (curve troppo strette, schiacciamenti con le fascette stringicavo) o connettori di scarsa qualità.
    

---

### 4. La Mappa dei Cavi (Wire Map) (Slide 20)

È il primo test che si fa. Verifica che tutti gli 8 pin siano collegati correttamente da entrambi i lati.

- **Errori comuni da citare all'esame:**
    
    1. **Cavo Aperto (Open):** Un filo non tocca il pin.
        
    2. **Corto Circuito (Short):** Due fili si toccano.
        
    3. **Coppie Invertite (Reversed Pair):** I fili di una coppia sono scambiati.
        
    4. **Coppie Incrociate (Crossed Pairs):** Due coppie intere sono scambiate.
        
    5. **Coppie Splittate (Split Pairs):** È l'errore più insidioso. I fili sono collegati ai pin giusti (1-2, 3-6 ecc.), ma i colori sono mischiati tra coppie diverse. Il test di continuità passa, ma il cavo fallirà i test di diafonia perché i fili non sono intrecciati con i loro rispettivi compagni.
        

---

### Sintesi per la Maturità (Perché scegliere i test di certificazione?)

In fase d'esame, se ti chiedono come garantire la qualità di un'installazione, devi rispondere che si esegue la **Certificazione secondo lo standard EIA/TIA 568B**.

Scegliere di certificare serve a:

1. **Legalità:** Dimostrare che il lavoro è a regola d'arte.
    
2. **Prestazioni:** Garantire che la rete regga i 1000 Mbps (Gigabit) senza errori di trasmissione che rallenterebbero tutto a causa delle ritrasmissioni dei pacchetti.
    
3. **Manutenzione:** Identificare il punto esatto di una rottura grazie a strumenti che misurano la lunghezza del cavo tramite il tempo di riflessione del segnale (TDR - Time Domain Reflectometry).
    

**Pronto per il file 03 (Il cablaggio strutturato negli edifici)?** Questo è il cuore del layout fisico!



Il terzo documento, **03_UA5_LEZ05.pdf - Il cablaggio strutturato degli edifici**, è forse il più importante per la parte di progettazione della prova scritta o del colloquio orale. Qui impariamo come si organizza fisicamente la rete in un intero palazzo.

---

### 1. Terminologia e Gerarchia (Slide 15-17)

Il cablaggio strutturato non è casuale, ma segue una struttura a **stella gerarchica**. Immagina un albero: il tronco è la dorsale, i rami sono i collegamenti ai piani e le foglie sono i PC.

- **MC (Main Cross-connect):** Il centro stella principale dell'intero edificio (spesso nel seminterrato o in una sala server dedicata).
    
- **IC (Intermediate Cross-connect):** Un punto di smistamento intermedio (opzionale, usato in edifici molto grandi).
    
- **TC (Telecommunications Closet):** L'armadio di piano (Rack). È il "cuore" del piano dove arrivano tutti i cavi delle stanze.
    
- **Lato Pratico:** Perché una stella? Se un cavo verso una stanza si rompe, solo quella postazione smette di funzionare. Se avessimo una struttura a bus o anello, un guasto potrebbe fermare l'intero piano.
    

---

### 2. Il Posto di Lavoro e la TO (Slide 18-19)

La **WA (Work Area)** è la scrivania dell'utente. Qui troviamo la **TO (Telecommunications Outlet)**, ovvero la presa a muro.

- **La regola delle due prese:** Lo standard prevede almeno due prese per postazione (una per i dati e una per il telefono/fonia IP).
    
- **Cablaggio orizzontale:** È il cavo che va dalla presa a muro (TO) fino all'armadio di piano (TC).
    

---

### 3. La "Regola d'oro" dei 100 Metri (Slide 20-21)

Questa è una delle domande preferite dai prof all'esame: **Quanto può essere lungo il cavo?**

Il limite totale è **100 metri**, così suddivisi:

1. **90 metri** di cavo "solido" (monofilare) dentro le canaline, tra l'armadio di piano e la presa a muro.
    
2. **10 metri** totali per i cavi flessibili (Patch Cords): massimo 5m nell'armadio rack e 5m per collegare il PC alla presa a muro.
    

- **Lato Pratico:** Perché il cavo nel muro è diverso dal cavo patch? Quello nel muro è a "conduttore unico" (rigido) per trasmettere meglio il segnale sulle lunghe distanze; quello patch è "multifilare" (tanti filini di rame intrecciati) per essere flessibile e non rompersi quando muovi il PC o apri il rack.
    

---

### 4. Permutatori e Patch Panel (Slide 22-25)

Nell'armadio di piano (TC), i cavi che arrivano dai muri non finiscono direttamente in uno switch, ma vengono attestati su un **Patch Panel**.

- **Spiegazione Grafica:** Immagina una fila di prese "femmina" sul davanti del rack. Sul retro, i cavi rigidi provenienti dalle stanze sono collegati in modo permanente. Per dare "linea" a una stanza, usi un cavetto corto (patch cord) dal pannello allo switch.
    
- **Lato Pratico:** Perché non collegare direttamente il cavo al rack allo switch?
    
    1. **Protezione:** Lo switch ha porte delicate. Se scolleghi e colleghi spesso, rischi di romperlo. Rompere una porta del patch panel costa 1 euro, rompere una porta di uno switch professionale costa molto di più.
        
    2. **Ordine:** Permette di riorganizzare la rete (spostare un utente da una VLAN all'altra) semplicemente cambiando un cavetto nel rack, senza toccare i cavi nei muri.
        

---

### 5. La Dorsale (Backbone) (Slide 16)

È il collegamento che unisce i vari armadi di piano (TC) al centro stella principale (MC).

- **Lato Pratico:** Mentre per il cablaggio orizzontale (piani) usiamo quasi sempre il **Rame (Cat 6)**, per la dorsale (verticale tra i piani) si sceglie quasi sempre la **Fibra Ottica**.
    
- **Perché?**
    
    1. **Distanza:** La fibra supera i 100 metri senza problemi.
        
    2. **Velocità:** La dorsale deve trasportare il traffico di _tutto_ il piano, quindi serve molta più banda.
        
    3. **Interferenze:** Essendo la dorsale verticale, passa spesso vicino a ascensori o quadri elettrici che generano forti disturbi; la fibra, essendo di vetro, è immune ai disturbi elettromagnetici.
        

---

### Sintesi per la Maturità:

Se nel progetto dell'esame devi cablare un edificio di 3 piani:

1. Posiziona un **MC** al piano terra (o interrato).
    
2. Posiziona un **TC** (armadio rack) ad ogni piano in posizione baricentrica (per non superare i 90m di raggio).
    
3. Prevedi una **dorsale in fibra ottica** tra MC e TC.
    
4. Specifica che il cablaggio orizzontale sarà in **Cat 6 UTP** terminato su **Patch Panel**.
    

**Pronto per il documento 04 (Dispositivi di livello 2 - Switch e Bridge)?** Cominciamo a vedere la parte "attiva" della rete!



Il quarto documento, **04_UA6_LEZ04.pdf - Dispositivi di rete a livello 2**, segna il passaggio dal "cavo passivo" all' "apparato attivo". Per la Maturità, questo capitolo è fondamentale per spiegare come viene gestito il traffico dati e come si ottimizzano le prestazioni di una rete.

---

### 1. Il Concetto di Dominio di Collisione (Slide 3-7)

Prima di capire gli apparati, bisogna capire il problema: la **collisione**. In una rete Ethernet condivisa, se due computer trasmettono contemporaneamente, i segnali si sovrappongono e diventano illeggibili.

- **Dominio di Collisione:** È l'area logica della rete in cui i pacchetti possono scontrarsi.
    
- **Spiegazione Grafica:** Immagina una strada a corsia unica dove le auto (i dati) viaggiano in entrambe le direzioni. Se due auto si incontrano, c'è un incidente (collisione).
    

---

### 2. Hub vs Bridge: L'evoluzione (Slide 8-12)

- **Hub (Livello 1 - Fisico):** È un semplice ripetitore. Quando riceve un segnale su una porta, lo copia su _tutte_ le altre. Crea un unico grande dominio di collisione.
    
- **Bridge (Livello 2 - Data Link):** È un dispositivo "intelligente". Legge l'indirizzo **MAC** di destinazione e decide se far passare il pacchetto o bloccarlo.
    
- **Vantaggio del Bridge:** Divide la rete in due segmenti. Le collisioni che avvengono nel Segmento A non disturbano il Segmento B.
    
- **Lato Pratico:** Oggi i bridge "puri" non si usano quasi più, ma la loro logica è stata assorbita dagli switch.
    

---

### 3. Lo Switch: Il "Bridge Multiporta" (Slide 13-17)

Lo switch è l'evoluzione finale. Invece di avere solo due porte come i vecchi bridge, ne ha decine.

- **Funzionamento:** Lo switch crea una connessione virtuale diretta (punto-punto) tra il mittente e il destinatario.
    
- **Spiegazione Grafica:** Se l'Hub è un "megafo" (tutti sentono tutto), lo Switch è un "centralino telefonico" privato: mette in contatto solo le due persone che devono parlare, lasciando le altre linee libere.
    
- **Micro-segmentazione:** Ogni singola porta dello switch è un dominio di collisione a sé stante. Questo significa che, teoricamente, le collisioni in una rete fatta solo di switch sono pari a **zero**.
    

---

### 4. Analisi delle Prestazioni (Slide 16-18)

Questo è un punto tecnico molto amato dai professori per i calcoli di rete:

- **Scenario con Hub:** Se hai un Hub a 10 Mbps e 10 computer collegati, la banda è _condivisa_. Se tutti trasmettono, ognuno ha in media 1 Mbps.
    
- **Scenario con Switch:** Se hai uno Switch a 10 Mbps, ogni coppia di computer può comunicare a 10 Mbps _contemporaneamente_ senza disturbare gli altri.
    
- **Lato Pratico:** Se in un laboratorio scolastico (come nell'esempio della Slide 16) sostituisci i vecchi hub con uno switch, la velocità percepita dagli utenti aumenta drasticamente non perché i cavi siano più veloci, ma perché elimini le attese causate dalle collisioni.
    

---

### 5. Metodi di Commutazione (Store-and-Forward) (Slide 10)

Lo switch può gestire i dati in diversi modi. Il documento cita lo **Store-and-Forward**:

1. Lo switch riceve l'intero pacchetto.
    
2. Controlla se ci sono errori (tramite il CRC).
    
3. Se è integro, lo spedisce al destinatario.
    

- **Lato Pratico:** Questo metodo è il più sicuro perché impedisce ai pacchetti corrotti di circolare nella rete, ma introduce un piccolissimo ritardo (latenza). Esistono metodi più veloci (_Cut-through_) che spediscono il pacchetto appena leggono l'indirizzo, ma non controllano gli errori.
    

---

### Sintesi per la Maturità:

Se ti chiedono di giustificare la scelta degli apparati in un progetto:

1. **Mai usare Hub:** Sono obsoleti e inefficienti.
    
2. **Usare Switch Layer 2:** Per collegare i PC all'interno di un piano (TC - Telecommunications Closet).
    
3. **Spiegare il throughput:** Specificare che lo switch aumenta la banda totale della rete dividendo i domini di collisione.
    
4. **Full Duplex:** Menziona che con gli switch le schede di rete possono lavorare in _Full Duplex_ (trasmettere e ricevere contemporaneamente), raddoppiando di fatto la velocità potenziale.
    

**Pronto per il documento 05 (Cablaggio Layout)?** Lì vedremo come mettere insieme tutto quello che abbiamo imparato finora in scenari reali!




Il quinto documento, **05_CablaggioLayout.pdf - Layout e Cablaggio Strutturato**, è fondamentale perché unisce i concetti tecnici visti finora in un quadro normativo e progettuale completo. È il documento che ti insegna a "disegnare" la rete secondo lo standard **TIA/EIA 568**.

---

### 1. Definizione e Standard TIA/EIA 568 (Pag. 1)

Il cablaggio strutturato è l'insieme dei componenti passivi (cavi, prese, permutatori) installati per connettere apparati attivi.

- **Lo Standard:** Il TIA/EIA 568 definisce i requisiti minimi per edifici commerciali e comprensori (campus) fino a 3000m di estensione.
    
- **Topologia a Stella Gerarchica:** Questo è il dogma della maturità. Non sono ammessi bus o anelli; tutto deve convergere verso centri stella.
    
    - **Spiegazione Grafica:** Immagina una piramide. In cima c'è il centro stella principale (MC), che si dirama verso centri intermedi (IC), i quali a loro volta servono gli armadi di piano (TC).
        
    - **Lato Pratico:** Si usa la stella perché è più facile da gestire (manutenzione) e se un ramo si guasta, il resto della rete continua a funzionare.
        

---

### 2. I "Centri Stella" e la Gerarchia (Pag. 2)

Qui il documento definisce i vari livelli di concentrazione del segnale:

- **EF (Entrance Facility):** Il punto dove i cavi dell'operatore esterno entrano nell'edificio (la "borchia").
    
- **MC (Main Crossconnect):** Il centro stella di comprensorio (il "capo" di tutto). Gestisce le dorsali verso gli altri edifici.
    
- **IC (Intermediate Crossconnect):** Il centro stella di edificio. Smista il segnale ai vari piani.
    
- **TC (Telecommunication Closet):** L'armadio di piano. Da qui partono i cavi orizzontali verso le scrivanie degli utenti.
    
- **Lato Pratico:** In un esame, se l'edificio è piccolo, MC e IC possono coincidere nello stesso armadio rack.
    

---

### 3. Permutatori e Posto di Lavoro (Pag. 3)

- **Patch Panel:** È il pannello dove arrivano i cavi dai muri. Può essere per rame (RJ45) o per fibra (bussole).
    
- **Patch Cord:** I cavetti flessibili che "permutano" il segnale dal pannello allo switch.
    
- **TO (Telecommunication Outlet):** La presa a muro dell'utente. Deve avere almeno due connettori.
    
- **Lato Pratico:** Perché due prese? Una è tipicamente dedicata ai dati (PC) e una alla fonia (Telefono IP), garantendo ridondanza e pulizia nel cablaggio.
    

---

### 4. Mezzi Trasmissivi e Distanze Critiche (Pag. 4)

Questa slide è una "tabella della verità" per la progettazione:

- **Dorsale di Comprensorio (MC-IC):** Si preferisce la **Fibra Monomodale (SMF)** perché arriva fino a 3000m.
    
- **Dorsale di Edificio (IC-TC):** Spesso si usa la **Fibra Multimodale (MMF)** per distanze fino a 500m.
    
- **Cablaggio Orizzontale (TC-TO):** Il limite invalicabile è **90 metri** di cavo rigido (tipicamente UTP Cat 6).
    
    - **Spiegazione Grafica:** Visualizza un raggio di 90 metri che parte dall'armadio di piano; se una scrivania è fuori da quel raggio, devi aggiungere un altro armadio (TC).
        

---

### 5. Identificazione e Documentazione (Pag. 5)

Un errore comune alla maturità è dimenticare la "gestione".

- **Identificazione:** Ogni cavo e presa deve avere un codice univoco (es. "PD02109A") che indichi edificio, piano, postazione e armadio.
    
- **Documentazione:** Devono esserci tabelle che dicano esattamente dove va ogni cavo.
    
- **Lato Pratico:** Senza etichette, in una sala server con 500 cavi, identificare un guasto fisico diventa impossibile. All'esame, citare l'importanza dell'etichettatura dimostra una mentalità professionale.
    

---

### 6. Il Concetto di Layout (Pag. 6)

Il documento conclude spiegando che la progettazione parte sempre dalla planimetria (**Layout**).

- Le soluzioni cambiano in base allo scenario:
    
    1. **Stanza singola/Appartamento:** Cablaggio semplice o wireless.
        
    2. **Edificio unico:** Uno o più TC collegati a un IC.
        
    3. **Comprensorio (Campus):** Più edifici collegati via dorsale in fibra a un MC.
        

---

### Sintesi per la Maturità:

Se ti chiedono di progettare la rete di una scuola o di un'azienda:

1. **Topologia:** Dichiara subito: "Seguirò lo standard **TIA/EIA 568** con topologia a stella gerarchica".
    
2. **Mezzi:** Usa la **Fibra Ottica** per le dorsali (immunità ai disturbi, velocità, distanza) e il **Rame UTP Cat 6/6a** per le postazioni di lavoro (economico, flessibile).
    
3. **Distanze:** Rispetta i **90 metri** per il cablaggio orizzontale.
    
4. **Gestione:** Inserisci sempre un **Patch Panel** in ogni armadio per rendere la rete flessibile e facile da manutenere.
    

**Siamo pronti per i file 06, 07 e 08, che applicano questi concetti a casi reali (Stanza, Edificio, Campus). Da quale iniziamo?**



Il sesto documento, **06_SistemaInUnaStanza.pdf - Sistema contenuto in una unica stanza/appartamento**, analizza il caso più semplice di layout: l'utenza residenziale o il piccolo ufficio (_Small Business_ o _Telelavoro_).

In questo scenario, la sfida non è la distanza (solitamente entro i 10 metri), ma la **flessibilità** e l'**estetica** dell'installazione.

---

### 1. Analisi del Layout (Pag. 1)

Il documento presenta la pianta di un tipico appartamento dove il punto di ingresso della linea (borchia/EF) è vicino all'ingresso.

- **Il dilemma progettuale:** Partendo dall'ingresso, come portiamo la connessione nello studio o nelle camere?
    
- **Soluzioni proposte:** Cablaggio fisico (filo) o Wireless.
    

---

### 2. Soluzione 1: Cablaggio Strutturato a Filo (Pag. 2)

Viene applicata la topologia a stella anche in casa.

- **MC (Centro Stella):** Si installa un piccolo armadietto o scatola di derivazione vicino all'ingresso che contiene il router e un eventuale piccolo switch.
    
- **Distribuzione:** Da questo punto partono tubazioni sottotraccia che raggiungono le varie stanze (Cucina, Studio, Camere).
    
- **Identificazione dei cavi:** Il documento mostra una tabella di identificazione (es. "ST-1" per lo Studio).
    
- **Lato Pratico:** Anche in un appartamento, è bene usare cavi **Cat 5e o Cat 6**.
    
- **Per l'esame:** Sottolinea che il cablaggio fisico garantisce che la velocità acquistata dal fornitore (es. Fibra 1Gbps) arrivi effettivamente al PC senza perdite dovute a muri o interferenze.
    

---

### 3. Soluzione 2: Cablaggio Wireless (Pag. 3)

Data la superficie limitata (~100 mq), un singolo **Access Point (AP)** posto all'ingresso può coprire l'intera area.

- **Posizionamento:** Sebbene non sia baricentrico (centrale), in un appartamento moderno i segnali WiFi a 2.4GHz o 5GHz riescono solitamente a superare 1-2 pareti divisorie.
    

---

### 4. Confronto e Scelte Pratiche (Pag. 3)

Questo è il punto "caldo" per l'orale di Maturità. Perché scegliere uno o l'altro?

|**Caratteristica**|**Soluzione 1: Cablaggio Fisico**|**Soluzione 2: Wireless**|
|---|---|---|
|**Banda (Velocità)**|**Massima e Garantita:** Ideale per streaming 4K, Gaming, NAS e Server domestici.|**Variabile:** Cala allontanandosi dall'AP o se ci sono interferenze di altri WiFi vicini.|
|**Sicurezza**|**Alta:** I dati viaggiano dentro il rame. Bisogna collegarsi fisicamente per "ascoltare".|**Media:** Il segnale esce dalle pareti di casa. Serve una cifratura robusta (WPA3).|
|**Affidabilità**|**Ottima:** Non risente di interferenze da forni a microonde o telefoni cordless.|**Soggetta a disturbi:** Altri dispositivi elettronici possono causare micro-disconnessioni.|
|**Costi/Posa**|**Elevati:** Richiede opere murarie o canaline esterne antiestetiche.|**Bassi:** Basta accendere il router. Massima mobilità per smartphone e tablet.|

---

### Sintesi Strategica per la Maturità:

Se nel progetto ti viene chiesto di gestire un appartamento o un piccolo studio professionale (es. avvocato):

1. **Proponi una soluzione IBRIDA:** Cablaggio fisico per le postazioni fisse (PC dello studio, Smart TV, Console) per garantire stabilità, e Wireless per la mobilità (clienti, smartphone).
    
2. **Menziona l'estetica:** In ambito residenziale, il cablaggio strutturato deve essere "invisibile" (sottotraccia) per non rovinare l'arredo.
    
3. **Identificazione:** Anche se sono solo 4-5 cavi, etichettarli nel piccolo centro stella permette all'utente di sapere quale cavo va in quale stanza senza doverli testare tutti.
    

**Passiamo al documento 07? Lì vedremo come le cose si complicano quando l'edificio diventa intero e su più piani.**




Il settimo documento, **07_SistemaInUnUnicoEdificio.pdf - Il sistema è contenuto in un unico edificio**, analizza la complessità di una rete che si sviluppa su più piani o grandi superfici (PMI, scuole, enti pubblici). Qui entra in gioco il concetto di **settorializzazione** e l'uso di più centri stella.

---

### 1. Caratteristiche del Layout (Pag. 1-2)

A differenza dell'appartamento, un edificio intero presenta:

- **Sviluppo verticale:** Più piani che richiedono collegamenti "verticali" (dorsali).
    
- **Aree funzionali:** Uffici, sale conferenze, laboratori, ognuno con esigenze di banda diverse.
    
- **Esempio Reale:** Il documento cita il **Palazzo Re Enzo di Bologna**, dove gli spazi sono usati per scopi espositivi e congressuali.
    

---

### 2. Struttura del Cablaggio (Pag. 3-4)

Per gestire un intero edificio, la topologia a stella si evolve in **Stella Gerarchica**:

- **MC (Main Cross-connect):** Solitamente posto nel locale tecnico principale (seminterrato o piano terra). Qui arriva la fibra dall'esterno.
    
- **TC (Telecommunications Closet):** Armadi rack di piano. Ogni piano ha il suo armadio per non superare i 90 metri di raggio verso le prese.
    
- **Dorsale di Edificio:** Il collegamento tra MC e i vari TC.
    
- **Lato Pratico:** Se l'edificio è molto alto o i disturbi elettromagnetici (ascensori, motori) sono forti, la dorsale DEVE essere in **Fibra Ottica**. Se l'edificio è piccolo, si può usare il rame (Cat 6a/7), ma la fibra garantisce l'espandibilità futura (Scalabilità).
    

---

### 3. Gestione di Grandi Numeri: Sala del Podestà e Sala del 300 (Pag. 5)

Il documento mostra casi critici dove il numero di postazioni supera quello previsto inizialmente (es. mostre o congressi).

- **Il Problema:** Hai 50 nodi da collegare ma solo poche prese a muro (TO) disponibili.
    
- **La Soluzione "Uplink":** Si utilizzano **Switch intermedi** posizionati nella sala, collegati tramite una "presa master" (Uplink) al centro stella di piano (TC).
    
- **Integrazione Wireless:** Per le aree centrali di grandi sale (dove i cavi a pavimento sarebbero d'intralcio), si installano **Access Point (AP)** collegati direttamente al rack di piano (TC2 nell'esempio).
    

---

### 4. Scelte Tecniche e Pratiche (Per la Maturità)

In questo scenario, devi giustificare le scelte in base al carico di lavoro:

|**Area**|**Mezzo Consigliato**|**Motivo Pratico**|
|---|---|---|
|**Dorsale (MC-TC)**|**Fibra Ottica (MMF)**|Immunità ai disturbi degli ascensori e banda elevata per tutto il piano.|
|**Uffici Standard**|**Rame UTP Cat 6**|Ottimo rapporto prestazioni/prezzo per distanze < 90m.|
|**Sale Conferenze**|**WiFi 6 + Switch Uplink**|Flessibilità per molti utenti contemporanei e dispositivi mobili.|

---

### Spiegazione Grafica della Gerarchia:

Immagina l'edificio come un corpo umano:

1. **MC (Cervello):** Nel seminterrato, decide dove vanno i dati.
    
2. **Dorsale (Midollo Spinale):** Il fascio di fibre che sale lungo i piani.
    
3. **TC (Nervi principali):** Gli armadi rack ad ogni piano che smistano i segnali.
    
4. **TO e Patch Cords (Terminazioni nervose):** Le prese e i cavetti che arrivano ai singoli PC.
    

### Lato Pratico per l'Esame:

Se nel tema d'esame ti chiedono di cablare una scuola:

1. Metti l'**MC** in segreteria o nel laboratorio principale.
    
2. Prevedi un **armadio rack (TC)** per ogni piano.
    
3. Unisci i rack con **fibra ottica** (per evitare che i fulmini o sbalzi di tensione tra piani brucino gli switch, essendo la fibra isolante).
    
4. Usa il **rame** per collegare i PC nelle aule.
    

**Pronto per l'ultimo documento (08), che riguarda il Comprensorio/Campus?** Lì vedremo come collegare più edifici tra loro!





L'ultimo documento, **08_SistemaInUnInsemeDiEdifici.pdf**, affronta il caso più esteso e complesso: il **Comprensorio o Campus**. Qui non si parla più solo di collegare stanze o piani, ma di connettere interi edifici distanti centinaia di metri o sedi distanti chilometri (WAN).

---

### 1. Definizione di Comprensorio (Campus) (Pag. 1)

Un campus è un'area privata (aziendale, universitaria o ospedaliera) che comprende più edifici.

- **Caratteristiche:** Estensione vasta (> 400m), alta densità di utenti, necessità di dorsali esterne.
    
- **Esempio del documento:** Un'area di 100.000 mq con 4 blocchi (A, B1, B2, C) destinati a uffici, aule e laboratori.
    

---

### 2. La Dorsale di Comprensorio (CD - Campus Distributor)

Per unire gli edifici tra loro, lo standard impone una gerarchia precisa:

- **CD (Campus Distributor) o MC (Main Cross-connect):** È il centro stella di tutto il campus, situato solitamente nell'edificio principale.
    
- **Dorsale Esterna:** I cavi che collegano il CD ai vari edifici (IC).
    
- **Lato Pratico:** Nelle dorsali esterne è **obbligatorio l'uso della Fibra Ottica**.
    
    - **Perché?** Il rame tra edifici diversi è pericoloso a causa delle "differenze di potenziale di terra" (che possono bruciare gli apparati) e dei fulmini. La fibra, essendo vetro, non conduce elettricità e protegge la rete.
        

---

### 3. Struttura del Blocco A (Esempio Multi-piano)

Il documento analizza il Blocco A (3 piani):

- **Piano Terra (Servizi):** Ospita l'**IC** (Intermediate Cross-connect) dell'edificio, che riceve la fibra dal Campus Distributor (CD).
    
- **Piani Superiori:** Ospitano i **TC** (armadi di piano).
    
- **Topologia:** Si replica la stella. CD (Campus) $\rightarrow$ IC (Edificio) $\rightarrow$ TC (Piano) $\rightarrow$ TO (Presa utente).
    

---

### 4. Collegamenti a Lunga Distanza (MAN e WAN) (Pag. 2)

Il documento si spinge oltre il campus, parlando di collegamenti tra sedi in città diverse o distanti km:

- **Ambito Cittadino (MAN):** Esempio dei tre ospedali di Bologna. Si usano fibre ottiche dedicate fornite da provider locali.
    
- **Ambito Geografico (WAN):** Sedi distanti centinaia di km (es. Torino, Bologna, Trieste).
    
- **Soluzioni Pratiche per la Maturità:**
    
    1. **Linee Dedicate:** Molto costose, ma con banda garantita e massima sicurezza.
        
    2. **VPN (Virtual Private Network):** Si usa la rete Internet pubblica creando un "tunnel" cifrato sicuro. È la scelta più comune oggi per il rapporto costo/prestazioni.
        

---

### 5. Riassunto Finale per la Progettazione (Schema per l'esame)

|**Livello**|**Dispositivo**|**Mezzo Trasmissivo**|**Lunghezza Max**|
|---|---|---|---|
|**Comprensorio**|MC / CD|Fibra Ottica (SMF/MMF)|Fino a 2000-3000m|
|**Dorsale Edificio**|IC $\rightarrow$ TC|Fibra Ottica (MMF)|500m|
|**Cablaggio Orizzontale**|TC $\rightarrow$ TO|Rame (Cat 6/6a UTP)|90m + 10m patch|

---

### Conclusione del Percorso di Studio

Abbiamo visto come il cablaggio si adatti alla scala del problema:

1. **Stanza:** Semplicità e flessibilità (WiFi o un unico piccolo centro stella).
    
2. **Edificio:** Rigore gerarchico, gestione dei rack di piano e separazione dei domini di collisione tramite **Switch**.
    
3. **Campus:** Uso massiccio della **Fibra Ottica** per isolamento galvanico e velocità, e gestione delle connessioni **WAN/VPN** per le sedi remote.
    

**Consiglio per la Maturità:** Se nella traccia ti viene chiesto di collegare due edifici, giustifica sempre l'uso della fibra ottica citando la protezione contro le scariche atmosferiche e l'immunità ai disturbi elettromagnetici esterni.

**Vuoi fare un ripasso generale o simulare una domanda d'esame su questi documenti?**



Certamente! Per affrontare la progettazione del cablaggio strutturato alla maturità o in un contesto professionale, è fondamentale avere una **strategia decisionale** basata sulle dimensioni del sistema e sulle normative (TIA/EIA 568).

Ecco una guida strutturata che puoi usare come "schema mentale" o base per la tua relazione tecnica.

---

### 1. Definizione della Gerarchia (Dove mettere gli armadi?)

La prima scelta riguarda la topologia a **stella gerarchica**. Devi decidere quanti e quali centri stella servono.

- **MC (Main Cross-connect) / CD (Campus Distributor):**
    
    - **Quando:** Sempre. È il centro principale.
        
    - **Scelta:** Va posizionato nel locale tecnico principale (centro stella di edificio o comprensorio). Qui arriva la linea dell'operatore esterno (EF).
        
- **IC (Intermediate Cross-connect):**
    
    - **Quando:** Se hai più edifici (Campus) o un edificio estremamente grande con più ali.
        
    - **Scelta:** Fa da ponte tra l'MC e gli armadi di piano (TC).
        
- **TC (Telecommunications Closet / Armadio di Piano):**
    
    - **Quando:** Uno per ogni piano dell'edificio.
        
    - **Scelta pratica:** Se il piano è molto lungo, ricorda la **regola dei 90 metri**. Se una postazione dista più di 90m dall'armadio, devi aggiungere un secondo TC su quel piano.
        

---

### 2. Scelta dei Mezzi Trasmissivi (Quali cavi usare?)

Questa è la parte core della tua progettazione. La scelta dipende dalla tratta:

#### A. Cablaggio Orizzontale (Dal TC alla scrivania TO)

- **Scelta:** **Rame UTP/FTP di Categoria 6 o 6A.**
    
- **Motivo pratico:** Il rame è economico e facile da installare. La Cat6 garantisce 1Gbps, la Cat6A arriva a 10Gbps (ideale per il futuro).
    
- **Schermato o No?** Usa **UTP** (non schermato) nella maggior parte dei casi. Usa **STP/FTP** (schermato) solo se i cavi passano vicino a motori industriali o grossi quadri elettrici per evitare interferenze (EMI).
    

#### B. Dorsale di Edificio (Backbone Verticale tra i piani)

- **Scelta:** **Fibra Ottica Multimodale (MMF) - OM3 o OM4.**
    
- **Motivo pratico:** La fibra è immune ai disturbi elettromagnetici (fondamentale vicino agli ascensori), offre altissima banda e garantisce l'**isolamento galvanico** (se un fulmine colpisce un piano, non si propaga agli altri attraverso i cavi).
    
- **Distanza:** Ottima per tratte fino a 500m.
    

#### C. Dorsale di Comprensorio (Tra edifici diversi)

- **Scelta:** **Fibra Ottica Monomodale (SMF) - OS2.**
    
- **Motivo pratico:** Per distanze oltre i 500-1000m o per collegamenti esterni tra edifici, la monomodale ha meno attenuazione.
    

---

### 3. Scelta degli Apparati Attivi (Cosa mettere dentro i rack?)

- **Nel TC (Armadio di piano):**
    
    - **Switch Layer 2:** Per collegare i PC degli utenti.
        
    - **PoE (Power over Ethernet):** Scegli switch PoE se devi alimentare telefoni VoIP, telecamere IP o Access Point Wi-Fi direttamente dal cavo di rete.
        
- **Nel MC (Centro stella principale):**
    
    - **Switch Core / Layer 3:** Uno switch più potente che gestisce il traffico tra i vari piani (inter-VLAN routing). Deve avere porte **SFP+** per ricevere i moduli in fibra dalle dorsali.
        
    - **Router/Firewall:** Per la connessione verso Internet e la sicurezza della rete.
        

---

### 4. Layout Fisico e Gestione (La "regola d'arte")

Per un progetto perfetto, devi includere questi elementi nel testo:

1. **Patch Panel:** Obbligatori in ogni rack. I cavi provenienti dai muri si attestano qui. Non collegare mai i cavi rigidi direttamente allo switch!
    
2. **Permutazione (Patch Cords):** Usa cavetti flessibili tra Patch Panel e Switch.
    
3. **Etichettatura:** Specifica che ogni presa (TO) avrà una sigla (es. _Piano1-Presa05_) corrispondente sul pannello nel rack.
    
4. **Ridondanza:** Se il sistema è critico (es. ospedale), progetta una doppia dorsale (due cavi in fibra su percorsi diversi).
    

---

### Sintesi Decisionale (Tabella Rapida)

|**Scenario**|**Gerarchia**|**Cavo Consigliato**|**Apparato**|
|---|---|---|---|
|**Ufficio/Aula**|TO (Presa)|Rame Cat 6 UTP|PC / Printer|
|**Piani Edificio**|TC (Rack)|Rame verso utenti / Fibra verso MC|Switch L2 PoE|
|**Tra i Piani**|Dorsale Edificio|Fibra Multimodale|Switch Uplink 10Gbps|
|**Tra Edifici**|Dorsale Campus|Fibra Monomodale|Switch Core L3|

**Ti sembra chiaro come impostare il testo o vuoi che simuliamo un caso specifico (es. "Progetta il cablaggio per una scuola di 2 piani con laboratorio")?**



Questa è un'ottima sfida progettuale, tipica di un caso di studio della **Maturità**. Immaginiamo di dover progettare la rete per una **nuova sede aziendale o un plesso scolastico** che deve ospitare:

1. **Uffici Amministrativi** (30 postazioni).
    
2. **Laboratori Tecnici** (60 postazioni).
    
3. **Magazzino/Logistica** (10 postazioni).
    

Abbiamo due opzioni di layout fisico. Analizziamole per capire quale scegliere.

---

### Ipotesi A: Tre edifici separati (singolo piano)

Ogni funzione ha il suo edificio indipendente: Edificio 1 (Uffici), Edificio 2 (Laboratori), Edificio 3 (Magazzino).

- **Gerarchia:** Avresti un **CD (Campus Distributor)** nell'edificio principale e due **IC (Intermediate Cross-connect)** negli altri due.
    
- **Cablaggio:** Dovresti scavare e posare **tre dorsali esterne in fibra ottica** per collegare tutto al centro stella del campus.
    
- **Costi:** Alti. Più scavi, più cavi in fibra da esterno, più apparati attivi (uno switch "core" nell'edificio A e switch di distribuzione negli altri).
    

---

### Ipotesi B: Due edifici (uno dei quali a due piani)

- **Edificio 1 (2 piani):** Piano Terra per i **Laboratori** (alta densità), Primo Piano per gli **Uffici** (media densità).
    
- **Edificio 2 (1 piano):** Solo **Magazzino**.
    

---

### La Scelta Strategica: Perché l'Ipotesi B è quasi sempre la migliore?

Dal punto di vista del **Sistemi e Reti**, l'Ipotesi B vince per tre motivi fondamentali:

#### 1. Ottimizzazione della Gerarchia (MC e TC)

Nell'Edificio 1 (due piani), puoi posizionare l'**MC (Main Cross-connect)** al piano terra.

- Il piano terra (Laboratori) viene cablato direttamente dall'MC.
    
- Per il primo piano (Uffici), basta portare una **dorsale verticale** (pochi metri di fibra o rame Cat 7) verso un **TC (Armadio di piano)**.
    
- **Vantaggio:** Risparmi un intero IC (Intermediate Cross-connect) e la relativa manutenzione. È molto più economico e veloce collegare due piani dello stesso edificio che due edifici distanti tra loro.
    

#### 2. Riduzione dei costi di infrastruttura esterna

Le tratte esterne (scavi e condutture interrate) sono la parte più costosa e fragile di un cablaggio.

- Nell'Ipotesi B, devi gestire **una sola dorsale esterna** verso l'edificio del Magazzino.
    
- **Lato pratico:** Meno fibra ottica da esterno da comprare e meno rischi che un escavatore rompa i cavi durante lavori in giardino/cortile.
    

#### 3. Prestazioni e Banda (Throughput)

Collegando i Laboratori e gli Uffici nello stesso edificio, la latenza è minore e la banda è maggiore.

- Se i Laboratori devono accedere a un server posto negli Uffici, il segnale viaggia su una dorsale verticale interna, solitamente molto più veloce (10Gbps garantiti) e meno soggetta a interferenze ambientali rispetto a una tratta che passa sotto terra tra edifici diversi.
    

---

### Quando invece sceglieresti i 3 edifici (Ipotesi A)?

Sceglieresti i tre edifici solo se:

- **Sicurezza antincendio/esplosione:** I laboratori trattano materiali pericolosi che devono stare isolati dagli uffici.
    
- **Interferenze elettromagnetiche (EMI):** I laboratori usano macchinari industriali così pesanti che disturberebbero i PC degli uffici anche attraverso i muri.
    
- **Limiti di distanza:** L'edificio unico diventerebbe così grande da superare i **90 metri** di raggio dall'armadio rack per raggiungere le prese più lontane.
    

### Conclusione per la tua relazione:

"Per il caso in esame, si sceglie l'**Ipotesi B (due edifici)**. Questa soluzione permette di centralizzare gli apparati attivi principali nell'edificio a due piani, riducendo il numero di IC necessari e minimizzando i costi di scavo per le dorsali esterne. La comunicazione tra Uffici e Laboratori avverrà tramite una **dorsale verticale in fibra ottica**, garantendo massima velocità e immunità ai disturbi, rispettando pienamente lo standard **TIA/EIA 568**."

**Ti è chiaro questo ragionamento? Se vuoi, possiamo provare a scrivere i componenti specifici (quanti switch, quali cavi) per l'Ipotesi B.**




Ottimo! Facciamo un **ripasso generale strutturato** che riassume l'intero percorso, dai singoli cavi alla progettazione di un intero campus. Questo schema ti servirà per avere una visione d'insieme chiara durante l'esame.

---

### 1. I Componenti Fisici (Documenti 1 e 2)

Il cuore della rete locale è il cavo in **rame (Twisted Pair)**.

- **Perché l'intreccio?** Per cancellare le interferenze (diafonia).
    
- **Le Categorie:** Ricorda che la **Cat 6** è lo standard attuale (1 Gbps fino a 100m). La **Cat 6A** e la **Cat 7** sono per i 10 Gbps.
    
- **I Test (Certificazione):** Non basta che il cavo "funzioni". Deve superare i test di:
    
    - **Wire Map:** Corrispondenza dei pin.
        
    - **Attenuazione:** Perdita di segnale (dB).
        
    - **NEXT (Paradiafonia):** Disturbo tra coppie vicine al trasmettitore.
        
    - **Return Loss:** Segnale che rimbalza per variazioni di impedenza.
        

---

### 2. Gli Apparati di Rete (Documento 4)

Passiamo dallo strato fisico (cavi) a quello logico (**Livello 2 - Data Link**).

- **Hub vs Switch:** L'Hub è un ripetitore "stupido" (un solo dominio di collisione). Lo **Switch** è "intelligente": usa la **Tabella dei MAC Address** per inviare i dati solo alla porta corretta.
    
- **Micro-segmentazione:** Ogni porta dello switch è un dominio di collisione separato. Questo elimina le collisioni e aumenta il **Throughput** (la banda effettiva).
    

---

### 3. La Struttura dell'Impianto (Documenti 3 e 5)

Il cablaggio deve essere **strutturato**, ovvero seguire lo standard **TIA/EIA 568**.

- **Topologia:** Sempre a **stella gerarchica**.
    
- **Cablaggio Orizzontale (90 metri):** Dalla presa a muro (**TO**) all'armadio di piano (**TC**). Si usa il rame.
    
- **Patch Panel:** È fondamentale per la flessibilità; permette di spostare una postazione da uno switch all'altro senza toccare i cavi nei muri.
    

---

### 4. La Progettazione per Scenari (Documenti 6, 7 e 8)

#### A. La Stanza/Appartamento

- **Scelta:** Singolo centro stella (Router/Switch) o Wi-Fi.
    
- **Punto chiave:** La stabilità del cavo vs la mobilità del wireless.
    

#### B. L'Edificio Unico (Scuola o Azienda)

- **Gerarchia:** Un **MC** (Main Cross-connect) principale e vari **TC** (uno per piano).
    
- **Dorsale Verticale:** Collega i TC all'MC. Si sceglie la **Fibra Ottica** per evitare interferenze dai motori degli ascensori e garantire velocità (10Gbps).
    

#### C. Il Campus (Insieme di Edifici)

- **Gerarchia:** Si aggiunge il **CD (Campus Distributor)**.
    
- **Dorsale Esterna:** Solo **Fibra Ottica** (solitamente monomodale).
    
- **Motivo:** La fibra protegge dai fulmini e dalle differenze di potenziale elettrico tra edifici diversi.
    

---

### 5. Check-list Mentale per il Progetto di Maturità

Se devi progettare una rete da zero, segui questi passaggi:

1. **Analisi del Layout:** Quanti piani? Quanti edifici?
    
2. **Posizionamento Rack:** Uno per piano (TC), uno principale (MC) in un locale sicuro e ventilato.
    
3. **Verifica Distanze:** Tutte le prese sono entro i 90 metri dal rack? Se no, aggiungi un rack.
    
4. **Scelta Cavi:** Rame Cat 6 per le scrivanie, Fibra Ottica per le dorsali (tra rack).
    
5. **Scelta Apparati:** Switch Layer 2 per gli utenti, Switch Layer 3 (Core) per il centro stella, Firewall per Internet.
    
6. **Connessioni Remote:** Se ci sono più sedi distanti, cita l'uso di una **VPN** su linea pubblica o una linea dedicata.
    

### Consiglio Finale:

All'esame, giustifica sempre le tue scelte con la frase: **"Secondo lo standard TIA/EIA 568, ho optato per una topologia a stella gerarchica per garantire scalabilità e facilità di manutenzione."** Questo fa capire subito che sai di cosa parli.

**C'è un argomento specifico di questi 5 punti che vuoi approfondire ancora, o ti senti pronto?**