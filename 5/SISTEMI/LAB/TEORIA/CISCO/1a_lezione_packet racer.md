
1a lezione
zona preference si gestisce un po tutto, sono impostazioni. da cui inizi a modificare la grandezza dei font per migliorare la grafica
CLI command line interface.
? è l'help e se scrivo una lettera prima di ? tipo t? mi ritorna tutti i comandi che iniziano con quella lettera, se tra t e ? metto uno spazio addirittura mi vengono mostrati tutti i parametri di una funzione tipo sh ? (ti mostra i parametri della show).
con en(enable) vai d modalita standard a privilegiata e l'uòtima modalita è quella di configurazione (conf) e inoltre come parametro metti (t)
obbligatorio mettere le cover come interfacce per averle coperte,mentre cambio interfaccia devo spegnere il router.
per entrare in modaliyta di configurazionew di un'interfaccia(interface fastEthernet 0/0)
quanddo configuri su quale interfaccia del router stai configurando allora e poi come parametro inserisci quale è l'interfaccia
di default le interfacce del router sono spente quindi nella configurazione devo poi accenderle 

QUESTA PARTE NON HO CAPITO BENISSIMO A COSA SERVE
PIPPO(config-if)#ip address 192.168.79.254 ?
  A.B.C.D  IP subnet mask
PIPPO(config-if)#ip address 192.168.79.254 255.255.255.0
PIPPO(config-if)#no shutdown

abbiamo visto che che quando si invia un pacchetto per controllare che il collegamento funzioni, anche se il pacchetto viene trasmesso per un solo router il TTL va a 127, perche infatti il packet racer di cisco lo dimezza automaticamente, poi inoltre se attivo solo ICMP come protocollo e vedo bene come viene trasmesso il messaggio.
quando il roputer fa richiesta di time out vuol dire che il TTL è finito.

un router conosce solo le reti collegate ad essa.
cavo incrociato perché i dispositivi sono simili
guardando livello tcp/ip se i dispositivi sono allo stesso livello allora sono della stessa natura e si usa cavo incrociato
 tcp/ip ha 4 livelli ma suddivisione della rete è sempre uguale,   /iso osi è un modello a 7 livelli


 VIDEO 2
 2  router collegati tra loro e che a loro volta ognuno è collegato a una rete di host 
 comando show ip route mostra quali sono le reti che conosce il router.
 se proviamo a comunicare direttamente con torino
 si deve andare col comando iprote dicendogli che milano è collegato a un'altra rete , e ho 2 modi per dirglielo , 1. gli dico quale è il salto successivo del router che conosce, quindi ki  sestti in modalita #configure comando per settare: #ip route 172.10.0.0(next hop,rete verso cui amdare,che non conosceva) 255.255.0.0 200.100.50.2(passando per questo router, quindi quando il router fa una richiesta per questa rete automaticamente il suo messaggio viene mandato all'host della rete collegata ad essa); 
 oppure 2. gli indico quale interfaccia del mio router uscire e la rete verso cui andare.
  ma qua abbiamo un altro problemalo stesso problema vale anche per l'altro router infatti dovremo settare anche esso, perche il router milano non conosce dove si trova l'host collegato alla rete torino e quindi dobbiamo settare come prima

  configurazione statica
  1. conosco esattamente la configurazione di rete
  2. spero che non sia troppo grande

  per configurare i router in modo piu avanzato( operche quando hai tanti router o tanti pc)-> dhcp stessa cisa a livello di router non devo dire io ma uso un instradamento dinamico
  però il controllo RIP-> router comunico a chi mi sta vicino quali sono le mie  reti 
  attivo il RIP 
  router IP 
  version 2 
  network (ip) (subnet masck)

  e questo dice quali sono le reti che conosce : network (ip)
 