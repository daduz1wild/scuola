il firewall va a prendere tutto il traffico che passa in un certo punto.
per decidere se un pacchetto può essere accettato rifiutato si usa un alista di regole, ogni regola di questa lista ha un formato, (pattern( a quali pacchetti si andra a far valere la regola) ed azione(in che casi deve essere accettato rifiutato)), vengono utilizzate le ACL, la regole vengono verificate in sequenza(1° caso, 2° ecc.) fino a che un patternt soddisfa il formato del pacchetto oppure la lista è terminata.
Nel primo caso si applica l'azione specificata dalla regola corrispondente al pattern.
se  nessuna regola è soddisfata ci sono 2 casi:
firewall inclusivo: blocca tutto il traffico che non sopddisfa le regole. corrisponde ad avere come ultima regola blocca tutto. è sicuro ma scomodo perche senza definire le regole non si può accedere all'esterno.(sarebbe deny any)
firewall esclusivo:come ultima regola accetta tutto, quindi le regole precedenti sono quelle che vanno a bloccare, è all'oppostondi firewall inclusivo.

in ogni interfaccia quando andiamo ad applicare un acl abbiamo una parte inbound e una parte outbound, se l'acl fosse messa da una parte dell'interfaccia del router, allora se io sono il router, il traffico va verso il roputer o esce dal router. se L'acl è posizionata dalla parte privata, allora vuol dire che i dati le stanno arrivando per poi passare al router e poter uscire, quindi il traffico arriva inbound all'acl.
devo vedere come viaggia tra router e acl, se viaggia verso acl  poi c'è il router con il firewall dopo.
in base al contesto è importante a capire dove piazzare ACL e da che parte arriva il traffico







Una Access Control List (ACL) è un elenco di regole strutturate che i dispositivi di rete (come router, firewall e switch) utilizzano per filtrare il traffico in entrata e in uscita, decidendo se permettere o negare l'accesso a risorse specifiche in base a criteri come indirizzi IP, protocolli o porte. 

Le ACL funzionano come guardiani digitali che analizzano i pacchetti in transito confrontandoli con una sequenza di istruzioni; la valutazione avviene in modo sequenziale e, non appena un pacchetto soddisfa una condizione, viene applicata l'istruzione corrispondente (permit o deny), ignorando le regole successive.  Se un pacchetto non soddisfa alcuna condizione esplicita, viene scartato per un'istruzione implicita finale di "deny any" (nega tutto). 

Le ACL possono essere classificate in due categorie principali in base alla granularità del filtro:

ACL Standard: filtrano il traffico basandosi esclusivamente sull'indirizzo IP di origine, sono più semplici e dovrebbero essere posizionate vicino alla destinazione. 
ACL Estese: offrono un controllo più granulare permettendo il filtraggio in base a indirizzo sorgente, indirizzo di destinazione, protocollo e numero di porta, e dovrebbero essere posizionate vicino alla sorgente. 
Oltre al controllo del traffico di rete, le ACL sono uno strumento fondamentale per la sicurezza, consentendo di:

Fornire un livello base di protezione restringendo l'accesso a determinate reti o sottoreti.
Limitare il traffico per aumentare le prestazioni della rete e gestire la coda dei pacchetti. 
Definire quali tipi di traffico (es. email, Telnet, FTP) possono essere trasmessi, bloccando servizi non desiderati.
Mantenere tracce per gli audit registrando chi ha avuto accesso a cosa e quando. 


//CREO ACL
PER creare un acl access-list 1 deny 192.168.2.3 0.0.0.0 (wildcard mask)
access-list 1 permit any


APPLICO ALL'INTERFACCIA
interface Gig0/0
ip access-group 1 out

in questo caso la wildcard tutta a 0 può essere sostituita nella sintassi mettendo host
access-list 1 deny host 192.168.2.3
access-list 1 permit any

show access-lists

quando si parla di acl-standard la regola è che vada messa più vicino possibie alla rete di destinazione 

se io sono all'interno del router il traffico che esce dalla rete dalla parte dell'acl è il traffico in  uscita(viene dall'interno)(quello che viene dalla nostra rete verso il router viene da dentro quindi inbound) .essendo che mettiamo regole sia sull'origine che sulla destinazione lo mettiamo piu vicino possibile a noi stessi essendo che inviamo messaggi.  invece se al contrario il traffico viene da fuori alla destinazione  esso è esterno , in entrata (viene da fuori outbound).


in cisco, di standard è inclusivo, il pacchetto non passa se non soddisfa neanche una regola.

come compito devi creare la struttura del video


APPUNTI VIDEO 15 ACL STANDARD
controlla solo ip, è la piu semplice

APPUNTI VIDEO 16 ACL estese (nuova struttura)
la cosa principale che cambia è che andiamo a specificare  la regola che consente l'accesso
la rete rosa non deve accedere alla rete verde, tranne che al server Verde.
l'accesso alla rete azzurra deve essere consentito

access-list 100-199 permit/deny protocollo IP_origine 
1.creazione acl estesa
access-list 100 deny ip 192.168.2.3 0.0.0.0 192.168.1.0 0.0.0.255
access-list 100 permit ip any any

la wildkard che mi permette di accedere a un ip

2.applico all'interfaccia
interface Gig0/0
ip access-group 100 in

le acl estese di default sono inclusive, ci basta specificare chi puo passare, la regola deny dopo si potrebbe anche non mettere .

out = outbound perché quello che arriva a fe0/0 dalla rete arancione è il traffico esterno