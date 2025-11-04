ogni dispositivo di rete è identificato in modo univoco in tutto ilk mondo, dal MAC che non cambi mai. le prime 6 cifre individuano il produttore dell'interfaccia(SI, System Identifier) di rete le successive 6 corrispondo al numero di serie della scheda stessa 
00-16-D4-37-0C-18

la shell dei comandi p+è un programma software che permette di stabilire una connessione dirette fra utente e sistema operativo
 
 ipconfig

dns è dentro la mia rete locale  come mai DNS e DHCP potrebbero avere lo stesso indirizzo
Ottima domanda! DNS e DHCP **possono avere lo stesso indirizzo IP** perché **non sono la stessa cosa, ma possono convivere sullo stesso server**.

DHCP si trova nella stessa rete, DNS non sempre

Ecco perché:

---

### 🔧 **Funzioni diverse:**

- **DHCP (Dynamic Host Configuration Protocol)**: assegna automaticamente gli indirizzi IP ai dispositivi nella rete.
    
- **DNS (Domain Name System)**: traduce i nomi di dominio (es. `google.com`) in indirizzi IP.
    

---

### 🧠 **Perché possono avere lo stesso IP:**

Entrambi i servizi possono essere **installati sullo stesso dispositivo/server** nella rete locale. Ad esempio:

- Un **router** o un **server centrale** può avere:
    
    - il servizio **DHCP attivo** per assegnare IP ai dispositivi.
        
    - e **DNS attivo o configurato** per risolvere i nomi.
        

Quindi, quando un computer chiede un IP (DHCP), contatta quel server. E quando deve risolvere un nome (DNS), può contattare **lo stesso indirizzo IP**, che instrada la richiesta al servizio DNS interno o lo inoltra a server esterni (es. Google DNS).

MAC regola l'accesso alla rete/ ai canali della rete:
CSMA(se non abbiamo una rete in cui più risorse potrebbero accedere al modem allo stesso tempo, ad esempio architettura a stella in cui ogni nodo ha un proprio canale allora non ci serve), CD è un miglioramento del CSMA perché si occupa di gestire le collisioni

hub=lavora a livello 1, riceve un messaggio e lo manda a tutte le macchine collegate ad esso in quel momento

topologia= tipo di architettura/struttura(BUS,STELLA)
tipologia=grandezza(LAN,GAN)

la prima cosa che viene fatta dal CSMA è controllare se la linea è occupata(architettura a Bus),se occupata allora il nodo viene messo in standby e poi quando sarà liberata allora sara autorizzata a trasmettere
se rilevano la linea allo stesso tempo due host vedono che la linea è libera e allora accedono allo stesso tempo, sovrapponendodsi e quindi avendo una collisione, a questo punto esiste un meccanismo che permette agli host di vedere che essi hanno avuto una collisione quindi interrompono la trasmissione
segnale di geming= serve per segnalare a tutti gli host che c'è una trasmissione in corso e che quindi tutti gli host devono attendere prima di trasmettere dati.
il meccanismo che avviene dopo che c'è stata una collisione per riaccedere alla rete è un'attesa casuale di tempo potrebbe accadere che attendono lo stesso tempo e che quindi c'è di nuovo una collisione , le macchine ritentano massimo 16 volte.

l'hub non è piu cosi tanto usato perche aumenta il traffico di rete(va sempre in broadcast) quindi viene usato lo switch .



video: warrior of the net






