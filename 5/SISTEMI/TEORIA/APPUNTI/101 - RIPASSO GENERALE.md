# Riassunto Completo di Sistemi e Reti per Maturità

## DMZ (Demilitarized Zone)

La DMZ è una rete separata posta tra la rete interna privata e Internet, isolata da due firewall per proteggere la rete interna dagli attacchi. Consente l’accesso ai servizi pubblici come web, mail e FTP, limitando il contatto diretto tra rete pubblica e privata.

- **Vantaggi:** migliora la sicurezza, controllo del traffico e isolamento dei servizi.
    
- **Svantaggi:** maggiore complessità configurativa e costi superiori.
    

## RADIUS (Remote Authentication Dial-In User Service)

Protocollo e sistema per la gestione centralizzata dell'autenticazione, autorizzazione e contabilizzazione degli utenti in rete, usato in ambienti aziendali e ISP.

- _Autenticazione:_ verifica credenziali (username, password, certificati).
    
- _Autorizzazione:_ definisce i permessi e limiti accesso.
    
- _Contabilizzazione:_ traccia attività e durata sessioni.
    

**Processo:** il client invia richiesta al server, che verifica e autorizza o rifiuta l’accesso; registra attività per contabilizzazione.

## Proxy

Server intermedio che riceve richieste dai client e le inoltra ai server di destinazione, migliorando sicurezza, anonimato e prestazioni tramite caching.

- **Tipi:** HTTP, HTTPS, SOCKS, FTP, Proxy inverso.
    
- **Funzioni:** filtraggio contenuti, mascheramento IP, bilanciamento carico, controllo accessi.
    
- **Vantaggi:** miglioramento prestazioni, sicurezza e privacy.
    
- **Svantaggi:** possibili rallentamenti e rischi se mal configurato.
    

## SMTP (Simple Mail Transfer Protocol)

Protocollo standard per l’invio e il trasferimento delle email tra client e server SMTP e tra server SMTP di domini diversi.

- _Comandi fondamentali:_ MAIL FROM, RCPT TO, DATA, QUIT.
    
- _Porte:_ 25 (non cifrate), 587 (auth+tls), 465 (SMTPS).
    
- _Sicurezza:_ STARTTLS per cifrare connessioni e prevenire intercettazioni.
    

**Vantaggi:** protocollo universale, compatibilità e semplicità. **Svantaggi:** vulnerabilità se non cifrato e problemi di spam.

## DHCP (Dynamic Host Configuration Protocol)

Protocollo che assegna automaticamente indirizzi IP e parametri di rete ai dispositivi sulla rete, semplificando la configurazione.

1. Discovery: il client cerca server DHCP.
    
2. Offer: il server propone indirizzo IP.
    
3. Request: il client accetta l’offerta.
    
4. Acknowledgment: conferma dell’assegnazione.
    
5. Rinnovo: richiesta estensione lease IP.
    

**Vantaggi:** automazione e gestione semplificata. **Svantaggi:** dipendenza dal server e rischi di sicurezza (falsi server, accesso non autorizzato).

## DNS (Domain Name System)

Sistema che traduce nomi di dominio leggibili in indirizzi IP numerici per facilitare l’accesso ai servizi Internet.

- _Componenti:_ server radice, TLD, autoritativi e resolver DNS.
    
- _Record comuni:_ A (IPv4), AAAA (IPv6), CNAME (alias), MX (posta), TXT, NS.
    
- _Cache:_ per migliorare velocità e ridurre carico server.
    

**Vantaggi:** facilità, scalabilità e flessibilità. **Svantaggi:** vulnerabilità a spoofing e problemi di privacy.

## Database

I database memorizzano e gestiscono grandi quantità di dati in modo organizzato, tipicamente tramite modelli relazionali (es. MySQL) e accessibili mediante linguaggi come SQL e strumenti web come PHP per la gestione dinamica dei dati.

## Firewall

Dispositivi o software che monitorano e filtrano il traffico di rete in entrata e uscita secondo politiche di sicurezza per proteggere la rete da accessi non autorizzati e attacchi.

- _Funzioni:_ controllo accessi, protezione malware, NAT, VPN, logging.
    
- _Tipi:_ personal (per singolo PC), network (tra LAN e Internet), router, circuit gateway, proxy.
    
- **Vantaggi:** sicurezza e monitoraggio rete.
    
- **Svantaggi:** costi, complessità e possibili rallentamenti.
    

## DSL, ADSL e Fibra Ottica

- **DSL/ADSL:** connessioni Internet via linea telefonica in rame. ADSL offre velocità asimmetriche (più veloce in download) sfruttando frequenze diverse per upload e download. Costi contenuti ma dipendenza da distanza centrale e interferenze.
    
- **Fibra Ottica:** trasmissione dati tramite impulsi luminosi in cavi di vetro/plastica, offre velocità elevatissime, bassa attenuazione, alta affidabilità ma costi d’installazione maggiori.
    
- **FTTH:** Fibra ottica diretta fino a casa/ufficio, offre connessioni molto veloci e affidabili con bassa latenza.
    

## WiFi e protocolli di sicurezza (WEP, WPA1, WPA2, WPA3)

Gli standard WiFi (802.11) regolano la comunicazione wireless con frequenze 2,4 GHz e 5 GHz, evolvendo in velocità e prestazioni.

- _WEP:_ protocollo di sicurezza obsoleto e vulnerabile.
    
- _WPA1, WPA2:_ miglioramenti sostanziali nella sicurezza con WPA2 largamente usato oggi.
    
- _WPA3:_ standard recente (2018) che migliora sicurezza e integrità.
    
- _Altri:_ WPA2/WPA3 supportano autenticazione robusta e crittografia avanzata.
    

## Modello TCP/IP

Modello a quattro livelli per la comunicazione dati su Internet e reti:

1. **Applicazione:** protocollo HTTP, FTP, SMTP, DNS, ecc.
    
2. **Trasporto:** TCP (affidabile, controllo errori) e UDP (brevi ritardi, non affidabile).
    
3. **Internet:** protocollo IP per instradamento pacchetti IPv4 e IPv6.
    
4. **Accesso alla rete:** trasmissione fisica dati (Ethernet, WiFi, DSL, fibra).
    

L'incapsulamento stratificato permette l’invio e ricezione dati efficienti e strutturati.

## HTTP e HTTPS

- **HTTP:** protocollo base per trasferimento di pagine web senza cifratura.
    
- **HTTPS:** versione sicura grazie all’utilizzo di SSL/TLS che cifra la connessione, garantendo riservatezza e integrità dei dati, utilizzando certificati digitali per autenticazione.
    
- **Porta:** HTTP usa porta 80; HTTPS usa porta 443.
    
- **Utilizzo:** HTTPS è obbligatorio per dati sensibili e transazioni online.
    

## FTTH (Fiber To The Home)

Tecnologia che porta la fibra ottica direttamente all’edificio, fornendo connessioni molto veloci, affidabili, con bassa latenza, idonee per servizi avanzati come streaming ad alta definizione e gaming online.

## Crittografia

Processo di trasformazione dei dati in forma cifrata per proteggerli da accessi non autorizzati durante la trasmissione o archiviazione.

- **Simmetrica:** stessa chiave per cifrare e decifrare (es. AES, DES).
    
- **Asimmetrica:** chiave pubblica per cifrare, chiave privata per decifrare (es. RSA, DSA).
    
- **Hash:** genera impronta digitale univoca dei dati (es. SHA, MD5) per verifica integrità e password.
    
- **Importanza:** garantisce confidenzialità, integrità, autenticazione e non ripudio.
    

## VPN (Virtual Private Network)

Tecnologia che crea un tunnel sicuro e crittografato tra dispositivo e rete privata via Internet, per proteggere la privacy e l’integrità delle comunicazioni.

- **Funzionamento:** tunneling, autenticazione, crittografia.
    
- **Protocolli comuni:** IPSec, OpenVPN, PPTP, SSTP.
    
- **Vantaggi:** sicurezza su reti pubbliche, anonimato, accesso remoto sicuro, bypass restrizioni geografiche.
    
- **Tipologie:** Trusted VPN, Secure VPN, Hybrid VPN.
    

## ACL (Access Control List)

Liste di regole su dispositivi di rete (router, firewall, switch) per consentire o bloccare traffico in base a indirizzi IP, porte, protocolli.

- **Tipi:** standard (basate su IP sorgente) ed estese (includono IP destinazione, porte, protocolli).
    
- **Uso:** controllo accessi, sicurezza, gestione routing.
    

## VLAN (Virtual Local Area Network)

Segmentazione logica di una rete fisica in gruppi isolati tramite switch, identificati da ID VLAN, migliorando sicurezza e gestione del traffico.

- **Tipi:** basate su porta, protocollo, subnet, MAC address.
    
- **Vantaggi:** isolamento sicurezza, riduzione broadcast, gestione centralizzata e flessibilità.
    
- **Applicazioni:** separazione reparti, reti ospiti, ottimizzazione traffico VoIP.
    

## Cloud Computing

Modello che permette l’accesso a risorse IT (server, storage, software) on-demand via Internet.

- **Caratteristiche:** accesso ubiquo, scalabilità, servizio misurato.
    
- **Modelli di servizio:**
    
    - IaaS: infrastruttura virtuale (server, storage).
        
    - PaaS: piattaforme di sviluppo e gestione app.
        
    - SaaS: software disponibili via browser.
        
- **Benefici:** riduzione costi, flessibilità, sicurezza, collaborazione globale.
    
- **Esempi:** AWS, Microsoft Azure, Google Cloud Platform.
    

## IPv4 e IPv6

Protocolli Internet per indirizzamento e instradamento pacchetti dati.

- **IPv4:** indirizzi 32 bit (es. 192.168.1.1), circa 4 miliardi di indirizzi, usa NAT per gestione scarsità, limitazioni sullo spazio indirizzi.
    
- **IPv6:** indirizzi 128 bit (es. 2001:0db8::), spazio praticamente illimitato, sicurezza integrata (IPSec), autoconfigurazione migliorata, lenta adozione.
    
- **Transizione:** dual stack, tunneling 6to4/Teredo per coesistenza IPv4/IPv6.
    

## SSL e TLS

Protocolli crittografici per garantire la sicurezza delle comunicazioni su Internet, soprattutto per HTTPS e email sicure.

- **SSL:** primo protocollo ampiamente utilizzato, oggi obsoleto a causa di vulnerabilità.
    
- **TLS:** evoluzione di SSL, standard IETF, versioni 1.0 a 1.3 con miglioramenti di sicurezza e prestazioni.
    
- **Funzioni principali:** crittografia, autenticazione tramite certificati digitali, integrità dati, forward secrecy.
    
- **Applicazioni:** HTTPS, SMTPS, FTPS e altre comunicazioni sicure.