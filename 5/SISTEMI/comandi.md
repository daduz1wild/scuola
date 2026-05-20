interface fastEthernet 0/0
ip address 192.168.0.1 255.255.255.0
no shutdown

show ip interface brief
ipconfig
ping 192.168.0.2

# routing
show ip route
ip route 172.16.0.0 255.255.0.0 192.168.1.2

# rip
router rip
version 2
network 192.168.0.0
network 200.100.50.0

debug ip rip


# dhcp
enable
configure terminal

interface fastethernet0/0
 ip address 192.168.10.1 255.255.255.0
 no shutdown
exit

ip dhcp excluded-address 192.168.10.1 192.168.10.10

ip dhcp pool POOLROUTER
 network 192.168.10.0 255.255.255.0
 default-router 192.168.10.1
exit


### Crei le VLAN:

```
vlan 100
name Amministrazione
exit

vlan 200
name Vendite
exit

vlan 300
name Gestione
exit
```

👉 Controllo:

```
show vlan brief
```

---

# 🔹 PORTE ACCESS (per i PC)

Le porte dove colleghi i PC sono in modalità **access**  
👉 Possono appartenere a **una sola VLAN**

Esempio:

```
interface fastEthernet 0/1
switchport mode access
switchport access vlan 100
exit
```

---

# 🔹 COMANDO UTILISSIMO: INTERFACE RANGE

Per configurare più porte insieme:

```
interface range fastEthernet 0/1-8
switchport mode access
switchport access vlan 100
```



# TRUNKING

interface gigabitEthernet 0/0.100
encapsulation dot1Q 100
ip address 192.168.100.254 255.255.255.0 ( è il **GATEWAY dei PC**)
exit

# ACL
access-list numero permit/deny IP_sorgente wildcard

### Punto fondamentale

Se nessuna regola corrisponde, vale il comportamento implicito finale del Cisco IOS:

* **deny implicito finale** → tutto ciò che non è stato permesso esplicitamente viene bloccato

Quindi, se vuoi consentire il resto del traffico, devi aggiungere una regola finale come:

```bash
access-list 1 permit any
```

estesa
access-list 100-199 permit/deny protocollo ip_sorgente wildcard_sorgente ip_destinazione wildcard_destinazione

Router(config)# access-list 100 deny ip 192.168.2.3 0.0.0.0 192.168.1.0 0.0.0.255
Router(config)# access-list 100 permit ip any any

altro esempio:

Router(config)# access-list 100 permit tcp 192.168.2.0 0.0.0.255 192.168.1.4 0.0.0.0 eq 80
Router(config)# access-list 100 permit ip 192.168.2.0 0.0.0.255 192.168.3.0 0.0.0.255

