ARP address resolution protocol, consente alle macchine di trovare il mac address noto un ip

nel pacchetto inviato tramite ping abbiamo dest e source mac/ip i dati, l'ip non è sufficiente per inviare il pacchetto, perche witch capace di fare instradamento solo tramite mac address quindi c'è bisogno che h1 host sorgente aggiunga nel pacchetto le informazioni che permettono l'instradamento, oltre al trailer. ip packet contiene  gli ip e i data, insieme a MAC e trailer è l'ethernet frame.

ovviamente ci deve essere la corrispondenza tra MAC e ip. se il mesaggio deve essere inviato in broadcast allora mac destinatario sara il MAC broadcast fatto da tutti 1.

la arp table è una tabella che sta dentro gli host che contiene la corrsipondenza ip mac

passi:
l'host A conosce l'indirizzo IP di B ma per poter comunicare con esso deve conoscere il suo indirizzo fisico o MAC, A controlla se nella propria ARP cache è presente il MAC ADDRESS corrispondente all'ip destinatario e quindi vien mandata una richiesta mandata a tutti(ARP REQUEST),tutti gli host controllano se indirizzo ip destinatario corrisponde col loro e poi in caso, host B prima cosa aggiunge la corrispondenza dell'ip e MAC della macchina A, nella propria arp cache e poi fa l'arp reply in cui risponde col proprio MAC della macchina B che puo aggiungere la corrispondenza nella propria ARP table

i dati arp rimangono in memoria solo per 5 minuti

il protocollo ARP risolve l'indirizzo IP con il relativo MAC address


CSMA CD(CARRIER SEnSE MULTIPLE ACCESS COLLSION DETECTION) rileva portante accsso multiplo e rileva collisioni. rete in cui abbiamo dispositivi collgati da un hub(lavora a livello 1 e ritrasmette il messaggio che gli arrriva su tutte le altre porte.)nelk caso in cui ci sono piu macchine che vogliono accedere al canale allo stesso tempo:
supponiamo che macchina A ed E vogliono comunicare.
1. fortuna=A verifica se qualcuno sta trasmettendo(carrier sense), in questo caso nessuno sta usando il canale, allora A trasmette il proprio messaggio, se un altro host vuole trasmettere allora deve aspettare che A finisca la trasmissione.
2. caso meno fortunato se 2 host analizzano l'occupazionen del canale allo stesso tempo, ed è vuoto essi inizieranno a trasmettere allo stesso tempo e quindi avviene una collisione; pero ce un meccanismo che permette di rilevare la collsione e uindi interrompono la condivisione.oltre a questo c'è il segnale di jamming che indica agli altri host che sta avvenendo una trasmissione, a questo punto si avvia u  meccanismo semicasuale, tempo casuale scelto in un range di tempo, piu volte avviene la collisione e piu il range diventa grande, dopo 16 prove se continuano a esserci collisioni il sistema termina la comunicazione tra gli host perche il canale è considerato troppo trafficato.
oggi l'HUB è stato sostituito da switch che lavora a livello 2 che permette di inviare messaggio solo sulla porta a cui è collegato il destinatario, evitando la possibilita che avvengano collisioni.


# DNS 
il nostro computer ha bisogno di indirizzi ip epr fare la ricerca sul web, e allora comee è che noi scriviamo una stringa? grazie al DNS che ci permette di farlo. un server DNS è una enorme lista che viene continuamente aggiornata con indirizzi ip e relative pagine web.

io riesco a pingare e conoscere l'indirizzo di morropc, perche il server dns(spesso switch di casa) e risolve i nomi di pc o server.
su ogni computer posso impostare manualmente 

# DHCP Dynamic host configuration Protocol
in una rete gli hsot non hanno un indirizzo statico, ma gli si dice che lo otterranno tramite dhcp, quindi la macchina al boot richiede in broadcast se qualcuno puo assegnarli un indirizzo, con dhcodiscovery, poi questa macchina gli risponde con configurazione IP(i parametri che gli offre)(dhcp offer),poi con dhcp requst l'host afferma che accetta quella richiesta, e come ultima cosa il dhcp risponde e dice a tutti che  l'host ha ottenuto l'indirizzo. DHACP ACK 
MODALITà di assegnazione IP:
DINAMICA: il server DHCP assegna un IP, alla scadenza del periodo di lease, l'IP viene assegnato ad altri host che fanno richiesta
AUTOMATICa: il server DHCP assegna un IP ad anche se il periodo di lease scade, riassegnerà all'host lo stesso IP quando questo en farà nuovamente richiesta
STATICA: niente periodo di lease, l'IP è assegnato all'host in modo permanente( es. stampanti )
minimi sono indirizzo IP e subnet mask

porta 67-68 sono porte client server




 
