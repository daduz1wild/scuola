# Firewall e ACL: Sicurezza nelle Reti e Sistemi di Networking

## 1. Il Funzionamento del Firewall

Il firewall è una linea di difesa cruciale per proteggere un computer o una rete da intrusioni esterne. Agisce come una guardia posta alla "porta" di collegamento tra il sistema interno e una rete esterna, filtrando tutti i pacchetti dati che entrano o escono, secondo regole predefinite. Queste regole stabiliscono quali programmi o host possono accedere a Internet o ad altre reti, garantendo così un controllo rigoroso sulle comunicazioni di rete.

I firewall possono essere implementati tramite software su computer o router, oppure tramite hardware dedicato specifico. Inoltre, sono configurabili dinamicamente: i filtri possono essere aggiunti, modificati o rimossi a seconda delle esigenze di sicurezza della rete.

## 2. Tipologie di Firewall

I firewall si distinguono principalmente in tre categorie, in base al livello in cui operano nel modello ISO/OSI:

### 2.1 Application Level Firewall

- Opera a livello applicativo, intercettando le trasmissioni riguardanti specifiche applicazioni.
    
- Analizza il contenuto applicativo dei pacchetti, ad esempio riconoscendo e bloccando virus o worm all'interno di sessioni HTTP o SMTP.
    
- Un esempio tipico sono i proxy server, che fungono da intermediari tra la rete privata e la rete pubblica.
    
- Garantiscono un alto livello di protezione, perché limitano le applicazioni che possono accedere a Internet, ma questa sicurezza comporta una riduzione della velocità di rete.
    

### 2.2 Packet Filter Firewall

- Lavora ai livelli Network e Transport, focalizzandosi sui dati di header dei pacchetti.
    
- Non analizza il contenuto del pacchetto, quindi non può filtrare informazioni interne ma permette un controllo rapido e un minore impatto sulle prestazioni della rete.
    
- I parametri controllati includono:
    
    - Indirizzi IP di sorgente e destinazione
        
    - Numeri di porta di origine e destinazione
        
    - Protocollo di livello superiore (ad esempio TCP o UDP)
        
- Può essere posizionato nel router di collegamento a Internet e quindi agire su tutta la LAN.
    

### 2.3 Stateful Packet Inspection Firewall

- Lavora a livello Transport, unendo il controllo degli header con l’analisi dello stato della connessione TCP.
    
- Memorizza le informazioni sulle connessioni attive in una tabella di stato, permettendo di applicare regole più dinamiche basate sulla storia dei pacchetti.
    
- Combina i vantaggi di filtro dei pacchetti con un'analisi più accurata, con qualche compromesso in termini di velocità rispetto al semplice Packet Filter.
    

## 3. Il Ruolo e l’Importanza delle ACL (Access Control List)

Le ACL sono liste di istruzioni inserite nelle interfacce dei router per controllare e filtrare il traffico di rete, sia in ingresso che in uscita. Queste regole sono fondamentali per:

- Garantire un livello base di sicurezza, restringendo accessi a determinate reti o limitando alcuni tipi di traffico.
    
- Migliorare la performance della rete, controllando quali pacchetti vengono processati e quali no (ad esempio consentendo le email ma bloccando Telnet).
    

L'elaborazione delle ACL è sequenziale: appena un pacchetto soddisfa una condizione, l'elaborazione si interrompe. Se nessuna regola viene soddisfatta, il pacchetto viene scartato (perché l’ultima regola implicita è _deny any_).

È importante inserire le regole più restrittive per prime, per evitare che regole generiche blocchino o consentano pacchetti prima che si applichino restrizioni specifiche.

### Tipi di ACL

- **Standard ACL:** Limitano i pacchetti in base al solo indirizzo IP della sorgente e devono essere posizionate vicino alla destinazione per ridurre impatti indesiderati sul traffico.
    
- **Extended ACL:** Offrono un filtraggio più dettagliato, basandosi su protocollo, indirizzi di sorgente e destinazione e numeri di porta del pacchetto.
    

## 4. Il Funzionamento dei Proxy Server

Un proxy server è un intermediario tra client e server. Il client si connette al proxy invece che direttamente al server di destinazione, e il proxy gestisce la richiesta inoltrandola al server e ritrasmettendo la risposta al client.

### Compiti principali del proxy

- **Connettività:** consente a una rete privata di accedere a Internet tramite un singolo punto.
    
- **Privacy:** maschera l'indirizzo IP reale del client, nascondendo l'identità del mittente al server remoto.
    
- **Caching:** memorizza le risposte a richieste frequenti, migliorando la velocità per richieste successive simili.
    
- **Monitoraggio:** tiene traccia delle attività client, permettendo la generazione di statistiche e analisi.
    
- **Amministrazione:** applica regole per autorizzare o negare richieste, limitare la banda o filtrare contenuti.
    
- **Filtraggio:** agisce come firewall a livello applicativo, garantendo una protezione elevata a scapito della velocità.
    
- **Restrizioni:** può creare una zona controllata (DMZ) per limitare l’accesso a certi servizi.
    

### Tipologie di architettura proxy

- **Single Proxy Topology:** Un solo server proxy per la rete, adatto a pochi client.
    
- **Multiple Proxy Vertically Topology:** Più proxy distribuiti su diverse subnet, con un proxy primario che coordina quelli secondari.
    
- **Multiple Proxy Horizontally Topology:** Distribuisce il carico tra più proxy server, aumentando la scalabilità ma richiedendo sincronizzazione del repository tra i proxy.
    

## 5. Tecniche NAT e PAT

La tecnica NAT (Network Address Translation) è utilizzata dai router per sostituire l’indirizzo IP di un pacchetto con un altro indirizzo, nascondendo così gli host interni di una rete locale agli indirizzi esterni e facilitando la condivisione di un solo indirizzo IP pubblico.

### Funzionamento NAT

- Quando un client interno invia una richiesta verso Internet, il router NAT sostituisce l'indirizzo IP e la porta del client con i suoi propri, assegnando una nuova porta registrata in una tabella di mappatura.
    
- Quando la risposta arriva dal server esterno, il router verifica la tabella di mappatura per identificare il client interno destinatario e traduce nuovamente l’indirizzo e la porta, inviando la risposta a quest'ultimo.
    
- Tutte le comunicazioni non registrate nella tabella vengono scartate, aumentando la sicurezza.
    

### Limitazioni di NAT e vantaggi

- Il NAT tradizionale può gestire solo una connessione per indirizzo IP per volta, creando problemi se più client comunicano con lo stesso server esterno.
    
- Vantaggi del NAT includono:
    
    - Riduzione del numero di indirizzi IP pubblici necessari.
        
    - Mantenimento della configurazione interna della rete.
        
    - Maggiore sicurezza nascondendo gli indirizzi IP privati.
        
    - Economia sui costi di accesso a Internet.
        

### Tecnica PAT (Port Address Translation)

PAT è un’evoluzione di NAT che consente di tradurre simultaneamente molteplici indirizzi IP privati con un solo indirizzo IP pubblico, differenziando i flussi tramite le porte TCP/UDP. Si ha così un rapporto 1:N tra indirizzo IP del client e quello pubblico usato per la comunicazione esterna, superando il limite di NAT tradizionale.

## 6. DMZ: Struttura e Funzioni

La **DMZ (Demilitarized Zone)** è una zona separata nella rete utilizzata per aumentare la sicurezza, creando un'area controllata e limitata tra la rete interna (LAN) e la rete esterna (WAN). I server che offrono servizi accessibili dall’esterno, come web server o mail server, vengono posizionati in DMZ per evitare che un eventuale attacco comprometta la rete interna.

### Tipi di DMZ

- **Vicolo cieco:** utilizza un firewall con tre interfacce separate per LAN, DMZ e WAN. Gli utenti possono accedere ai servizi nella DMZ, ma non danneggiare la LAN.
    
- **Zona cuscinetto:** impiega due firewall distinti: uno tra WAN e DMZ, e uno tra DMZ e LAN, aumentando la sicurezza interna. Per attaccare la rete LAN, un aggressore deve superare entrambi i firewall.
    

La gestione della DMZ permette un notevole miglioramento della sicurezza, separando la rete interna più sensibile dagli accessi esterni diretti, limitando così i rischi di compromissione.