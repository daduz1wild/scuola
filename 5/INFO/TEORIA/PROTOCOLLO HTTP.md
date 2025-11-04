HTTP  è il protocollo fondamentale del web che è stato fondato da Tim 
HTTP è un protocollo testuale a livello applicativo(che è di alto livello nella pila ISO OSI,5-6-7 )
HTTP è stateless, cioè non ha memoria , quindi se faccio una richiesta http , questa mia richiesta è indipendente da quella che mando subito dopo, ma lui continua a mandare richieste senza sapere che l'ha già mandata 2 millisecondi prima.
THREE WAY HANDSHAKE
HTTP 1 e 2 per comunicare usano sessioni basate sul TCP( semplicemente quando voglio comunicare con un server, avviene come una stretta di mano, che sono tre passaggi che servono per dire: io client voglio o parlare con un server, il server risponde e dice se accetta e se accetta inizia la comunicazione, ma più specificatamente, il client genera un numero casuale x che manda al server e serve per effettuare una sincronizzazione tra client e server, in modo che aprendo la sessione ci possa essere comunicazione, dopo diche anche il server genera un numero casuale, e inoltre prende il numero del client e gli aggiunge un +1 per fargli sapere che ha ricevuto il numero, quindi ora manda al client sia il numero creato dal client +1 e gli manda anche il suo stesso numero(del server) che poi il client gli rimanderà indietro +1 l'ACK è quello che si somma al numero già creato per fare sapere che il numero è stato ricevuto, invece ancora prima vien utilizzato il SYN che quando è uguale a 1 significa che sta avvenendo una richiesta di comunicazione con l'altro.
DOPO IL THREE WAY HANDSHAKE AVVIENE L'INSTALLAZIONE DI UNA CONNESSIONE SICURA
serve per fare in modo che i messaggi mandati siano crittografati. dopom che è stata creata una connessione sicura puo avvenire la richiesta HTTP e la rispettiva Risposta HTTP( nelle versione moderne di HTTP permettono di fare anche piu richieste e piu risposte).



quando si fuole fare una richiesta http ci sono delle specifiche linee di coduice ch evengoino generate, come prima cosa c'è la request line che :
GET(metodo) /api/users?page=1(percorsoed eventuali parametri) HTTP/2(versione)

header lines:
host: ---
user agent: (browser)
accept: (tipi di dati accettati dal browser)
accept language: lingue accettate
accept encoding: gzip, deflate, br
(parametro con cui dici se mantenere il TCP/contatto aperto perche potrebbero esserci altri messaggi in modo da non dover riaprire la connessione)
quanod faccio uan richiesta di un dato e mi viene fornito in una certa data, dopo un ppo di tempo posso fare una richiesta e chiedere se quel dato dopo quella data è stato aggiornato e in caso posoitivo mi viene mandata la versione nuova

GET vs POST
il gfet l,o utilizziamo quando dobbiamo effetturar edelle ricerche, non stiamo effttuando operazioni che possono modificare il database, azioni sicure da ripetere.
post: se effettuo un pagamento, modifiche dui dati al serve/database, se ogni invio potrebbe produrre risultati diversi ad esempio con una ricerca di prodotti( perche sto aggiungendoi righe al database). quindi ricapitolando è sicuro usar eil get quando facendo la stessa richiesta 1000 voplte mi escono sempre gli stessi risultati.


risposta HTTP
status line: HTTP/2 200 ok( singiifca che è riuscito a trovare quello che è stato richiesto)
header lines: 
date: --
server: apache ì/ 2.4.57
last modified: MON, 15 semptember
content tyope:text/ html; charset_utf-8


---
il problema del tcp è che se va perso un pacchetto devo rinviarli tutti  e anche nell'ordine giusto a differenza del UDP (HTTP 3), se va perso un pacchetto viene semplicemente rimandato quel pacchetto