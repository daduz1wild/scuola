
IN CISCO
ip dhcp pool poolRouter
network 192.168.10.0 255.255.255.0in questo modo ho definito l'insieme degli indirizzi
default-router 192.168.10.1 indica router di default
ip dhcp exclude 192.168.10.1 192.168.10.10 qua invece escludo una parte di host4


enable configure terminal vlan 100 
?
no ?
name Amministrazione
ex
vlan 200
name Vendite
ex
vlan 300
name Gestione
ex
show vlan brief
switch port

switchport mode access

non si posso usare le vlan riservate di default 
switchport access vlan 100
ex

show vlan brief

vlan 100

interface fastEthernet ?
comando utilissimo interface range(lavora su piu interfacce ):
inerface range fastEthernet 0/1-8
switchport mode naccess vlan 100 
e cosi posso fare anche tutte le altre



esercizio 
da 1-8 amministrazione vlan 100
9-16 vendita vlan 200
17-24 gestionale 300


o prendo i vari cavi e fisicamente vado a collegare i pc del piano superiore e logicamente faccio 2 switch separati ma fisicamente non è possibile. su quel cavo dovranno passare piu vlan, non solo una vlan
il cavo che collega i 2 switch gli dico che su questo cavo dovranno passare piu vlan. Per far capire a tutti, al posto di prendere 3 cavi separati, quindi una giga per una vlan e altre 2 per gli altri 2, inq uesto caso sullo stesso cavo possono passare piu vlan. per fare questo la modalita della porta non è access mode ma in trunk

la modalita trunk in questo caso viene utilizzata tra uno switch e l'altro .
riseptto al caso precedente abbiamo voluto non utilizzarr lo stesso indirizzo di rete ma utilizzare reti diverse.

si collega 1° piano con il 2° e i cavi tra i 2 switch che collegano i 2 piani avranno un cavo con vlan diverse
protocollo di tagging 
 IEEEE 802.1Q
aggiungere e rimuovere con trunk
di norma quando abilitiamo una porta essa è abilitata a trunk.
se devo abilitare solo la 10 e la 20 e le ho configurate tutte andro a rimuovere quelle che non mi interessano con switchport  trunk allowed remove ..
inoltro 
cambia il nome del frame ethernet quando mettiamo in una vlan percheviene messo la vlan in esadecimale che modifica penso il nome
1. la pdu arriva con un frame ethernet
2. ...
3. ...
4. alla fine verera mandata indietro una PDU senza tag

noi per il compito proviamo la stessa configurazione di prima ma con 2 switch e differentemente dal video tutto nella stessa rete
alla fine della spiegazione evidenzia gli esercizi