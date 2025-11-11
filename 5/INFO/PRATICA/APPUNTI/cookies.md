# COOKIES
http è un protocollo stateless, quindi ogni coppia client-request server-response è indipendetnte dalle altre. Questa cosa ovviamente non è gradita, ad esempio se faccio il login nel non devo rifare ogni volta il login, per questo si deve mantenere lo stato e sono disponibili i cookie le sessioni
Un cookie è un'informazione salvata dal browser in un piccolo file di testo(lato client) i cui dati vengono passati nell'header della richiesta o risposta ,-contiene coppia chiave valore
cookie viene costruito dal server e il browser lo tiene da parte.
un cookie è come se fosse un arrai associativo che contiene coppie chiave valore. l'interazione: client invia una richiesta il server memorizza i dati su una sorta di fogliettino e quel foglirettino viene dato al client nell'header con la response. che poi nelle request verra sempre inviato all'interno dell'header.

se vado su ispeziona poi network e trovo il file della aprola che ho ricercato in un sito con i cookie e vado su headers allora trovero cio che viene salvato tranne quello che ho appena ricercato e che quindi verra salvato dopo.

quando il browser contatta il server allega il codice che era stato ricevuto prima del server.

creazione cookie in php:
setcookie()quando sto programmando in pho devo essere consapevole che sto faceendo il cookie che dsara inviato al client, invece quello che ricevo  è quello precedente.

tutte le voltr che il client dovra parlar econ server alleghera il cookie, e il cookie che è stato inviato lo trovo nel server in $_COOKIE il tempo lo decidi facendoti dare time()(tempi trascorsi dal 1960 o 70 fino ad ora e ci aggiungo il tempo che voglio che duri).il cookie svanira alla fine della sessione in questo caso altrimenti se non metto niente svale solo finche la pagina è aperta.
setcookie vuoele il nome ,il valore, la scadenza, il percorso, secure,http only i primi 2 praticamnete obbligatori altrimenti non ha senso.
una volta che sonom arrivato al server il parametro chiamato $path serve per capire in quale pagine del nostro sito verra inviato il cookie, se voglio inviarlo a tutte="/" se settato a /foo/ allora viene inviato a quella pagina e alle relative sottopagine.secure se impostato a true il collegamento verra  impostato solo con una connessione sicura(https).http only true questo cookie non puoi utilizzarlo lato client con javascript
per modificare un cookie è sufficiente ricrearlo
la funzione setccokie deve essere richiamata priam di tutto(dentro php)
per eliminare un cookie si imposta la data di scadenza in un istante passato quindi faccio tutto modificando i parametri della setcokie

i cookie (re)inviati sono memorizzati nella variabile globale $_COOKIE 
il codice che ho creato su una riga non lo ho nella riga successiva ma solo nella successiva interazione,

isset è utilizzato per vedere se il cookie è presente o no

non ci deve essere nessun tipo di output prima della setcookie

esercizio 1
crea un sito composto da 3 pgine web navigabili tra loro tramite link o menu . nella prima pagina utente sceglie colore. colore scelto deve essere salvato nel cookie, tutte le pagine del sito devono usare colore sfondo scelto se presente

