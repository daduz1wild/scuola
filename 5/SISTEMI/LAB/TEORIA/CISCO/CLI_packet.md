1° video vai in modalita enable e poi configure terminal, poi per settare il nome del roouter, comando hostname torino, per settare l'interfaccia invece invece fai comando 
"interface fastEthernet 0/0 e dopodiche puoi settare l'indirizzo ip dell'interfaccia tramite il comando "ip address 192.168.0.1 255.255.255.0" ricorda che quando inserisci indirizzo ip nuovo  in riga di comando ti fa mettere sempre subnet mask.
con il comando "no shutdown" accendi il router (on). comando "show ip interface brief" uscendo dall modalita config con exit ma rimanendo in enable(#) ti mostra se le reti sono up o down.
ip config ti mostra i parametri di rete, "ping" manda pacchetto a indirizzo ip.
"show ip route" ti dice i dispositivi che un router vede e che se non sono sttai modificati sono solo quelli strettamente legati a esso.
usi routing statico per aggiungere una rete tra quelle a cui un router puà arrivare dobbiamo usare il comando " ip route rete sconosciuta subnet mask next hop (il prossimo piu vicino da dove mandiamo il pacchetto. piu modi per indicarlo, o tramite interfaccia da cui uscire o indirizzo ip next hop)"
modalitta rip: comando per entrarci "router rip" \n "version 2" e poi "network e inserisco l'ip  a cui inviare i parametri delle reti che conosco"
debug ip rip ci permette di...