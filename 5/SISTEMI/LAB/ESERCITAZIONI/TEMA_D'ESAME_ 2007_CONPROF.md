si analizza subito il testo evidenziando, , ho una sede centrale e ho i vari punti vendita per questo ho bisogno di una vpn per permettere che i dati vengano inviati da essi tramite un tunnelper accedere alla lan privata. c'è da descrivere come si gestisce i server.
usa cavi categoria 6 nella LAN, FTTH. un primo 





# Gestione informatica di una catena di supermercati: rete, servizi web e sicurezza

## Traccia d’esame

Il proprietario di una catena di supermercati intende aprire dieci nuovi punti vendita. La sede centrale comprende uffici e due magazzini collegati mediante una rete locale. Ciascun punto vendita dovrà disporre di un magazzino attiguo per lo stoccaggio delle merci; l’approvvigionamento verrà effettuato con richieste dirette alla sede centrale. Gli uffici si occupano dei rapporti con i punti vendita e con i magazzini, della verifica delle giacenze e dell’evasione degli ordini. La base di dati deve memorizzare le informazioni relative alle vendite e agli ordini dei prodotti dei vari punti vendita, che devono potersi interfacciare con la sede centrale; inoltre i clienti devono poter visualizzare i cataloghi dei prodotti e i corrispondenti listini per poter eventualmente acquistare via Web.

Il candidato, fatte le opportune ipotesi aggiuntive, progetti un sistema informatico adatto al caso descritto, illustrando la rete, l’architettura dei servizi, la gestione dei dati, la sicurezza e una possibile soluzione Web.

---

## Svolgimento

L’esigenza descritta è tipica di un’azienda che deve coordinare più sedi distribuite sul territorio mantenendo però un controllo centralizzato sulle scorte, sugli ordini e sulle vendite. In un contesto di questo tipo è fondamentale che il sistema informatico sia affidabile, sicuro e facilmente espandibile, perché il numero di punti vendita può aumentare nel tempo e le informazioni devono essere sempre aggiornate.

La soluzione più adatta è quella di adottare un’architettura centralizzata di tipo **client-server**, nella quale la sede centrale ospita i server principali, mentre i punti vendita funzionano come client remoti che inviano richieste e ricevono risposte. In questo modo la gestione dei dati rimane unificata e si evita la duplicazione delle informazioni, riducendo il rischio di incoerenze tra le sedi.

Dal punto di vista della rete, all’interno della sede centrale è opportuno utilizzare una **LAN** ad alta velocità per collegare uffici, server e magazzini. Nei punti vendita, invece, ogni sede avrà una propria LAN locale per collegare terminali di cassa, postazioni amministrative, stampanti di rete e dispositivi del magazzino. Poiché la sede centrale e i punti vendita si trovano in luoghi diversi, il collegamento tra le varie LAN avverrà tramite **WAN**, cioè attraverso la rete geografica, generalmente usando Internet come infrastruttura di trasporto.

Per garantire la sicurezza delle comunicazioni tra le sedi, la soluzione più corretta è l’utilizzo di una **VPN**. La VPN crea un tunnel cifrato sopra Internet, in modo che i dati trasmessi tra punti vendita e sede centrale non possano essere facilmente intercettati o modificati. Questa scelta è particolarmente importante perché le informazioni trattate includono ordini, giacenze, dati commerciali e potenzialmente anche dati personali dei clienti.

### Riferimento ai modelli ISO/OSI e TCP/IP

Il funzionamento della rete può essere spiegato con il modello **ISO/OSI**, che suddivide la comunicazione in sette livelli. I livelli più importanti, nel caso in esame, sono:

- il livello **fisico** e il livello **data link**, che riguardano il mezzo trasmissivo e il collegamento tra dispositivi nella LAN;
    
- il livello **rete**, in cui opera il protocollo **IP**, responsabile dell’instradamento dei pacchetti;
    
- il livello **trasporto**, in cui opera soprattutto **TCP**, che garantisce una comunicazione affidabile;
    
- il livello **applicazione**, dove si trovano i protocolli usati dai servizi, come **HTTP** e **DNS**.
    

Il modello **TCP/IP** è quello effettivamente usato nelle reti moderne e può essere visto come una semplificazione pratica dell’OSI. In esso troviamo il livello di accesso alla rete, il livello Internet, il livello di trasporto e il livello applicativo. In questo scenario, i terminali dei punti vendita useranno il protocollo IP per raggiungere i server della sede centrale, TCP per avere una trasmissione affidabile, e HTTP o HTTPS per le applicazioni Web.

### Protocolli principali

Tra i protocolli richiesti dal sistema, **DNS** ha il compito di tradurre i nomi simbolici dei server, ad esempio `www.azienda.it`, negli indirizzi IP necessari alla comunicazione. Questo evita di dover memorizzare indirizzi numerici e rende più semplice la gestione del sistema.

**HTTP** è il protocollo usato per la navigazione Web e per l’interazione tra client e server. Tuttavia, poiché il sistema tratta dati sensibili e transazioni commerciali, è preferibile utilizzare **HTTPS**, cioè HTTP protetto da **TLS**. In questo modo le informazioni scambiate risultano cifrate e protette da intercettazioni.

**TCP** garantisce l’affidabilità della comunicazione, perché controlla la correttezza dell’invio dei segmenti, il loro ordine e l’eventuale ritrasmissione in caso di errore. **IP** invece si occupa dell’inoltro dei pacchetti da una rete all’altra, rendendo possibile il collegamento tra le diverse sedi sparse sul territorio.

### Architettura proposta del sistema

Una possibile architettura è composta da tre componenti principali:

1. **Sede centrale**
    
    - server applicativi;
        
    - server database;
        
    - server Web per l’area pubblica;
        
    - firewall perimetrale;
        
    - eventuale server di autenticazione.
        
2. **Punti vendita**
    
    - postazioni di lavoro per casse e amministrazione;
        
    - dispositivi del magazzino;
        
    - router con connessione Internet e VPN;
        
    - firewall locale o funzione di filtraggio integrata.
        
3. **Infrastruttura cloud di supporto**
    
    - backup remoti;
        
    - replica dei dati;
        
    - servizi Web scalabili per il catalogo clienti;
        
    - eventuale disaster recovery.
        

Questa struttura è di tipo **ibrido**: la parte gestionale può restare in sede, mentre alcuni servizi pubblici o di backup possono essere affidati al **cloud computing**. Il cloud è utile perché permette di aumentare la disponibilità del servizio, distribuire il carico e semplificare l’accesso da più sedi. Inoltre offre vantaggi di scalabilità, perché in caso di apertura di nuovi punti vendita il sistema può crescere senza dover riprogettare tutto da zero.

### Sicurezza informatica

In un sistema aziendale come questo la sicurezza è un requisito fondamentale. Le principali misure da adottare sono:

- **crittografia simmetrica**, usata per cifrare rapidamente grandi quantità di dati durante la comunicazione;
    
- **crittografia asimmetrica**, usata per lo scambio sicuro delle chiavi e per l’autenticazione;
    
- **certificati digitali**, utili per verificare l’identità del server e garantire che il client stia comunicando con il sito corretto;
    
- **firewall**, per filtrare il traffico in ingresso e in uscita;
    
- **VPN**, per proteggere le connessioni tra le sedi;
    
- autenticazione con credenziali robuste e, se possibile, con secondo fattore.
    

La crittografia asimmetrica è essenziale all’inizio della connessione sicura, perché permette di stabilire una chiave di sessione senza trasmetterla in chiaro. Successivamente, per motivi di efficienza, la comunicazione vera e propria avviene con crittografia simmetrica. Questo è il principio usato da HTTPS/TLS: la parte iniziale usa meccanismi asimmetrici e certificati, mentre il trasferimento dei dati avviene poi con algoritmi simmetrici più veloci.

Il **firewall** svolge una funzione di filtro e controllo del traffico. Nella sede centrale è consigliabile una configurazione con più zone: una rete interna riservata agli uffici, una rete per i server e una **DMZ** per i servizi Web pubblici. In questo modo l’eventuale attacco al sito Internet non compromette direttamente i dati interni.

---

## Parte applicativa o progettuale

### Progetto della rete aziendale

Per la sede centrale propongo una **topologia a stella**, con uno switch centrale a cui collegare i server, le postazioni degli uffici e i dispositivi dei magazzini. Questa scelta è semplice da gestire, facile da espandere e adatta a un ambiente aziendale.

Ogni punto vendita avrà una LAN interna con:

- terminali di cassa;
    
- computer dell’amministrazione;
    
- stampanti di rete;
    
- dispositivi del magazzino;
    
- access point Wi-Fi solo per servizi interni autorizzati.
    

Ogni sede periferica si collegherà alla sede centrale tramite Internet usando un tunnel VPN. Gli indirizzi IP possono essere assegnati in modo organizzato, per esempio con subnet diverse per ogni punto vendita, così da semplificare la manutenzione e l’individuazione dei problemi.

### Progetto del database

Il database della sede centrale deve memorizzare almeno le seguenti informazioni:

- punti vendita;
    
- magazzini;
    
- prodotti;
    
- listini;
    
- giacenze;
    
- ordini;
    
- vendite;
    
- clienti, se è previsto l’acquisto online;
    
- utenti autorizzati e ruoli.
    

Dal punto di vista concettuale, le entità principali possono essere:

- **Prodotto**;
    
- **PuntoVendita**;
    
- **Magazzino**;
    
- **Ordine**;
    
- **Vendita**;
    
- **Cliente**;
    
- **Listino**.
    

Le relazioni fondamentali sono:

- un punto vendita effettua molti ordini;
    
- un ordine riguarda uno o più prodotti;
    
- un magazzino contiene le giacenze dei prodotti;
    
- una vendita è associata a un punto vendita e, se previsto, a un cliente;
    
- un listino associa un prezzo a ciascun prodotto.
    

Lo schema logico potrebbe quindi includere tabelle come `Prodotti`, `PuntiVendita`, `Magazzini`, `Giacenze`, `Ordini`, `DettaglioOrdini`, `Vendite`, `DettaglioVendite`, `Clienti` e `Listini`. Le chiavi primarie garantiscono l’univocità dei record, mentre le chiavi esterne realizzano i collegamenti tra le tabelle. È importante normalizzare il database per evitare ridondanze e anomalie di aggiornamento.

### Soluzione Web

Per l’interfaccia con i punti vendita e, eventualmente, con i clienti, si può realizzare un sito Web con accesso tramite **HTTPS**. L’area riservata ai punti vendita consentirebbe di:

- controllare le giacenze;
    
- inviare ordini alla sede centrale;
    
- consultare lo stato delle richieste;
    
- registrare vendite e movimenti di magazzino.
    

L’area pubblica, invece, permetterebbe ai clienti di:

- consultare il catalogo prodotti;
    
- visualizzare i prezzi aggiornati;
    
- effettuare eventualmente ordini online.
    

In questo caso è opportuno separare chiaramente i ruoli: i clienti devono vedere solo i dati necessari, mentre gli operatori interni devono avere funzioni aggiuntive di gestione. Questa separazione migliora sia la sicurezza sia la semplicità d’uso.

---

## Collaudo e verifiche

Il collaudo di un sistema di questo tipo deve essere eseguito su più livelli. Prima di tutto si verifica il funzionamento della rete: collegamenti fisici, indirizzamento IP, raggiungibilità dei server e corretto funzionamento della VPN. Successivamente si controllano i servizi applicativi, cioè login, consultazione del catalogo, invio degli ordini e aggiornamento delle giacenze.

Anche il database deve essere testato con attenzione, verificando:

- correttezza delle relazioni;
    
- assenza di dati duplicati;
    
- coerenza dei vincoli di integrità;
    
- velocità delle interrogazioni principali.
    

Infine si eseguono test di sicurezza, per esempio tentando accessi non autorizzati o verificando il corretto comportamento del firewall. Il collaudo non deve controllare solo il funzionamento normale, ma anche la risposta agli errori e ai guasti, perché un sistema aziendale deve rimanere affidabile nel tempo.

---

## Analisi massima dei costi

Un’analisi di massima dei costi deve considerare:

- acquisto dei server centrali;
    
- switch, router e firewall;
    
- licenze software, se non si usano soluzioni open source;
    
- connessioni Internet per le sedi;
    
- eventuali servizi cloud per backup e hosting;
    
- manutenzione periodica;
    
- formazione del personale.
    

Una parte dei costi iniziali riguarda l’infrastruttura hardware, mentre i costi ricorrenti dipendono soprattutto dalla connettività, dal supporto tecnico e dalla manutenzione. L’uso del cloud può ridurre alcuni costi di partenza, ma introduce canoni periodici. Per questo è importante trovare un equilibrio tra risorse locali e servizi esterni.

---

## Conclusione

Il caso proposto mostra chiaramente come l’informatica sia indispensabile per coordinare in modo efficiente un’azienda commerciale distribuita. Una rete ben progettata, un database centralizzato, servizi Web sicuri e collegamenti protetti tramite VPN permettono di migliorare il controllo delle scorte, la gestione degli ordini e la qualità del servizio al cliente.

La soluzione più adatta è un sistema client-server distribuito, supportato da tecnologie di rete moderne, protocolli affidabili come TCP/IP, servizi Web protetti con HTTPS e adeguate misure di sicurezza. L’eventuale integrazione con il cloud rende il sistema più flessibile e scalabile. In conclusione, un progetto di questo tipo risponde bene alle esigenze di una catena di supermercati moderna, perché unisce efficienza operativa, sicurezza e possibilità di crescita futura.