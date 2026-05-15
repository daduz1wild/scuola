# Guida ai Sistemi e Reti per l’Esame di Stato ITIS Informatica e Telecomunicazioni

## Introduzione alle Reti

Le reti informatiche consentono la comunicazione e lo scambio di dati tra dispositivi collegati. Sono classificate secondo la loro estensione geografica:

- **LAN** (Local Area Network): rete locale di piccole dimensioni.
    
- **MAN** (Metropolitan Area Network): rete a copertura cittadina.
    
- **WAN** (Wide Area Network): rete geografica estesa.
    
- **WLAN** (Wireless LAN): rete locale wireless.
    
- **PAN** (Personal Area Network): rete personale per dispositivi vicini.
    

Topologie fisiche principali:

- **Stella**: dispositivi collegati tramite un punto centrale (hub o switch).
    
- **Maglia**: ogni dispositivo è collegato con più nodi.
    
- **Albero**: disposizione gerarchica simile a una struttura ad albero.
    

## Protocolli e Servizi di Rete

- **TCP (Transmission Control Protocol)**: protocollo di trasporto orientato alla connessione che assicura la consegna affidabile dei dati tramite un _handshake_ a tre fasi (SYN, SYN-ACK, ACK).
    
- **UDP (User Datagram Protocol)**: protocollo di trasporto senza connessione, non garantisce l’affidabilità; usato per trasmissioni rapide come audio, video, DNS.
    
- **DHCP (Dynamic Host Configuration Protocol)**: assegna dinamicamente indirizzi IP e parametri di rete agli host tramite un processo in 4 messaggi (DISCOVER, OFFER, REQUEST, ACK).
    
- **ARP (Address Resolution Protocol)**: risolve indirizzi IP in indirizzi MAC all’interno di una rete locale; vulnerabile ad attacchi di spoofing.
    
- **NAT (Network Address Translation)**: trasforma indirizzi IP privati in un indirizzo pubblico per permettere la comunicazione esterna, aumentando la sicurezza e limitando l’uso di indirizzi pubblici.
    
- **ICMP (Internet Control Message Protocol)**: protocollo di controllo usato per messaggi di errore e diagnostici, come il comando `ping`. Vulnerabile ad attacchi DoS come il Ping of Death.
    
- **DNS (Domain Name System)**: sistema gerarchico per la traduzione di nomi di dominio leggibili in indirizzi IP numerici. Strutturato come un albero con root, domini di primo livello (TLD) e sottodomini.
    
- **POP3 (Post Office Protocol 3)**: protocollo per ricevere email scaricandole dal server al client (porta 110, non cifrato di base).
    
- **IMAP (Internet Message Access Protocol)**: protocollo per consultare email direttamente sul server senza scaricarle (porta 143, non cifrato di base).
    
- **SMTP (Simple Mail Transfer Protocol)**: protocollo per l’invio di email (porta 25, con ulteriori modalità cifrate).
    
- **TLS/SSL (Transport Layer Security / Secure Sockets Layer)**: protocolli per cifrare e autenticare connessioni sulla rete, proteggendo i dati durante il trasferimento.
    

## Subnetting

Consiste nella creazione di sottoreti mediante la suddivisione di una rete più grande grazie all'uso della _subnet mask_. La subnet mask è un indirizzo di 32 bit con bit a 1 che identificano la porzione di rete e bit a 0 per gli host.

- Permette di migliorare la gestione e sicurezza delle reti.
    
- Con la tecnica **VLSM** (Variable Length Subnet Mask) si usano maschere di lunghezza diversa all’interno della stessa rete.
    
- Nel **CIDR** (Classless Inter-Domain Routing) si usa una notazione compact come `192.168.1.0/24` per indicare la rete e la lunghezza della subnet mask.
    

## Routing

Il routing è il processo di instradamento dei pacchetti da una rete all'altra tramite i router.

- **Routing statico**: tabella di routing impostata manualmente; semplice ma poco scalabile e non tollerante ai guasti.
    
- **Routing dinamico**: utilizza protocolli per aggiornare automaticamente le tabelle di instradamento. Principali protocolli:
    
    - _Link State_: invio di pacchetti contenenti lo stato dei collegamenti, utilizza l’algoritmo di Dijkstra (percorso più breve).
        
    - _Distance Vector_: condivisione delle tabelle di routing tra router vicini, usa l’algoritmo di Bellman-Ford; problemi come il loop routing vengono attenuati da tecniche come route poisoning e split horizon.
        
    - **IGRP**: un protocollo proprietario Cisco di tipo Distance Vector con funzionalità avanzate.
        
- **Routing gerarchico**: Internet è strutturato in Autonomous Systems (AS) con protocolli Interior Gateway (IGP) e Exterior Gateway (EGP) per ottimizzare dimensioni e gestione delle reti.
    

## VLAN (Virtual LAN)

Le VLAN permettono la segmentazione logica di una rete fisicamente unica:

- Condividono infrastruttura fisica ma creano domini di broadcast separati.
    
- Tipologie:
    
    - _Port VLAN_: assegnazione statica di porte switch alle VLAN.
        
    - _Tagged VLAN_: i frame Ethernet sono “taggati” col VID per essere instradati su porte trunk, possono supportare fino a 4096 VLAN.
        
- Lo switching L3 (Layer 3) consente il routing tra VLAN diverse, tramite gateway dedicati.
    

## P2P (Peer-to-Peer)

Modello di rete dove ogni nodo agisce sia da client che da server senza gerarchia fissa.

- Tipologie di P2P:
    
    - _Puro_: nessun server centrale, i nodi si connettono direttamente.
        
    - _Discovery Server_: si appoggia a un server centrale per trovare i peer.
        
    - _Discovery Lookup Server_: i nodi inviano periodicamente liste di contenuti a un server.
        
    - _P2P strutturato_: topologia controllata, garantisce ricerca efficiente tramite codice identificativo (es. DHT).
        
    - _P2P non strutturato_: collegamenti casuali tra nodi.
        
- Attenzione a aspetti di sicurezza e legalità, specie nel file sharing.
    

## WiFi

- Basato su standard IEEE 802.11, opera su frequenze a 2,4 GHz e 5 GHz.
    
- **Canali:**
    
    - 2,4 GHz: 14 canali di cui solo 1, 6 e 11 non si sovrappongono.
        
    - 5 GHz: circa 23 canali, con 8 non sovrapposti disponibili in Europa.
        
    - Interferenze e sovrapposizioni possono degradare la qualità della rete.
        
- **Sicurezza:**
    
    - **WEP**: obsoleto e insicuro, facilmente violabile.
        
    - **WPS**: facilitava la configurazione ma vulnerabile ad attacchi di forza bruta, si consiglia di disabilitarlo.
        
    - **RADIUS**: protocollo per autenticazione centralizzata in reti protette.
        
    - **Hotspot**: punti di accesso WiFi pubblici.
        
    - **WDS**: sistema per estendere la copertura WiFi tramite AP multipli con perdita prestazioni.
        

## Crittografia

- **Crittografia simmetrica:** stessa chiave per cifrare e decifrare; veloce ma problema dello scambio sicuro della chiave.
    
- **Crittografia asimmetrica:** coppia di chiavi (pubblica e privata) diverse per cifrare e decifrare; più lenta ma supera il problema dello scambio chiavi.
    
- **TLS/SSL:** protocolli ibridi usati per garantire la sicurezza delle comunicazioni su internet implementando la crittografia asimmetrica per lo scambio della chiave simmetrica e cifrando la comunicazione.
    
- Concetti importanti: integrità, autenticazione, non ripudio, e principio di Kerckhoffs (sicurezza deve basarsi sulla segretezza della chiave, non sull’algoritmo).
    

## Firewall

- **Tipologie:**
    
    - _Personal firewall_: software locale su macchina individuale.
        
    - _Packet filter firewall_: filtra pacchetti in base a header (livelli 1-3), rapido ma vulnerabile a spoofing.
        
    - _Stateful Inspection firewall_: analizza lo stato delle connessioni (fino al livello 4), più sicuro e in grado di prevenire DoS.
        
    - _Application firewall_: interagisce con applicazioni (livello 7), offre elevata sicurezza ma può rallentare la rete.
        
- **ACL (Access Control List):** elenchi di regole sequenziali che determinano l’accesso alle risorse di rete, con criteri _permit_ (consenso) o _deny_ (blocco), e uso di wildcard per definire intervalli IP.
    

## VPN (Virtual Private Network)

- Servizio di comunicazione sicuro e affidabile che crea un canale crittografato su una rete pubblica.
    
- **Tunneling**: incapsulamento di pacchetti all’interno di altri per trasmetterli in sicurezza.
    
- Tipologie:
    
    - _Remote VPN_: accesso sicuro da postazioni remote tramite client.
        
    - _Site-to-site VPN_: collega due o più sedi geograficamente distanti mediante tunnel permanenti, può essere _Extranet_ o _Intranet_.
        
    - _Trusted VPN_: basate su reti private di livello 2, senza crittografia.
        
    - _Secure VPN_: basate su protocolli di crittografia sicuri (es. IPsec).
        
    - _Hybrid VPN_: combinazione di tecniche.
        

## Ambienti Distribuiti

- Sistemi software eseguiti su più macchine, che appaiono come un’unica entità.
    
- Caratteristiche: condivisione risorse, distribuzione del carico, scalabilità e tolleranza ai guasti.
    
- Middleware gestisce comunicazioni tra sistemi diversi.
    
- Kerberos: sistema di autenticazione distribuita basato su ticket e chiavi crittografate, supporta comunicazioni sicure client-server.
    
- Active Directory (Microsoft): servizi di directory per gestione centralizzata di utenti, risorse e autorizzazioni, con database gerarchico e Single Sign-On.
    

## Virtualizzazione

- Tecnica per eseguire sistemi operativi e applicazioni su hardware astratto, creando macchine virtuali (VM).
    
- Tipologie di virtualizzazione:
    
    - **Virtualizzazione completa:** replica completa dell’hardware.
        
    - **Emulazione:** esecuzione di codice di un sistema diverso da quello fisico.
        
    - **Paravirtualizzazione:** sistema operativo guest comunica direttamente con hardware tramite API specifiche.
        
    - **Virtualizzazione a livello di OS (container):** isolamento di processi senza VM complete (es. Docker).
        
    - **Virtualizzazione a livello di applicazione:** ambiente di esecuzione astratto per software indipendentemente dall’hardware (es. Java VM).
        
- Tipi di hypervisor: tipo 1 (bare-metal) e tipo 2 (hosted).
    

## Sicurezza Informatica

- **Tipi di attacchi:**
    
    - _Attacchi attivi:_ alterano o bloccano sistemi, es. DoS, DDoS, spoofing, MITM.
        
    - _Attacchi passivi:_ intercettano dati senza modificarli, es. sniffing.
        
- **Tecniche di ingegneria sociale:** sottrazione di informazioni sfruttando la fiducia umana.
    
- **Malware:** software dannoso (virus, ransomware, rootkit, ecc.).
    
- **Penetration test:** valutazione della sicurezza mediante simulazione di attacchi.
    

## Sicurezza Nazionale vs Privacy

La sicurezza nazionale ha portato a sviluppi di sorveglianza globale, spesso a discapito della privacy individuale. Programmi di intelligence monitorano grandi quantità di dati con tecniche avanzate di analisi. Le rivelazioni di Edward Snowden (2013) hanno evidenziato operazioni massive di sorveglianza da parte di agenzie come NSA e CIA, scatenando dibattiti etici su confine tra sicurezza e tutela della privacy.

## Esempi Storici di Virus e Ransomware

- **Chernobyl (1998):** virus diffusosi globalmente che causava malfunzionamenti e danneggiava hardware, attivandosi in determinate date.
    
- **EternalBlue/WannaCry (2017):** ransomware che ha sfruttato una vulnerabilità di Windows non patchata, causò infezioni rapide colpendo aziende e enti pubblici, provocando ingenti danni economici.
    
- Gli attacchi ransomware sono pericolosi perché bloccano i dati crittografandoli e chiedono un riscatto per la loro liberazione, spesso veicolati tramite ingegneria sociale.