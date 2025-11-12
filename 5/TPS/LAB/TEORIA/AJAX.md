AJAX si utilizza molto, tutte le pagine hanno all'interno tecnologie AJAX.
In gooogle man mano che scrivo nella barra di ricera si vanno a mostrare i relativi risultati, e non riaggiornando la pagina ma viene aggiornata una solapiccola sezione, 
qusto è possibile grazie alll'utilizzo AJAX, che non è un linguaggio di programmaz. infatti è un insieme di tecniche o tecnologie che noi andiamo a implementare in una pagina per farla diventare dinamica.
AJAX(Asynchronous Javascript And XML) 1. nella comunicazione asincorna io clent elaboro la richiesta la invio al server, e poi il client non si mette in attesa della risposta del serve rma continua  l'esecuzione, e nel momento in cuiil server risponde il client si 
svincola e ostra  la risposta, quindi tempo di risposta vincolato al server. 2. Javascript perche le tecniche che andiamo a implemetare nelle nostre pagine le andremo a implementare con java tipo oggetti da Java.
3. XML linguaggio di marcatura andiamo a mostrare il formato dei dati, useremo JSON linguaggio che rappresenta lo scambio dei dati.
quello che scambiano client e server con http scambiano solo stringhe di testo.
ma io posso comunque usare HTTP grazie a JSON e grazie  a funzioni sue, possiam prendere un array convertirlo in una stringa e spedirla al server, che prende quella stringa e la riconverte in un array e lo utilizza a suo piacere.
file XML sono estendibili, cioe posso creare tag miei sulla base di sottoentita create il testo che io scrivo i programamzione viene convertito in array e mandato al server.
per gestire la parte di ajax utilizzeremo la classe const xhttp= new XMLHttpRequest() all'interno di una funzione, primo metodo da utilizzare di questa classe è onload a cui viene associata una funzione che verra elaborata nel momento in cui c'è una risposta del server.tutte le cose effettuate nel mentre che il server risponde soo proprio dentro alla funzione assegnata nell'onloa(xhttp.onload=function(){}
nella stra grande dei casi come risposta ci verra data la pagina php server, la classe il cui oggetto è stato dichiarato all'inizo puo gestire sia classe sincrone che asincrone, se nel parametro della funzioe open mettiamo true come terzo parametro useremo asincrono.
pen permette di stabilire la connessione con il server , per inviare i dati utilizziamo il metodo dell classe dichiarata inzialmente send(method(GET POST),url( es. SERVER:PHP?home=hshh  quindi i dati vengono inviati nel body della richiesta http nel caso in cui usiamo il get altrimenti li devi inseire nel parametro dell metodo send in modo che i dati si rovano nel body e quindi non sono visualizzabili), true(per dire asincrono).

#ALCUNE PRPRIETA CHE CI INTERESSANO: onreadystatechange(viene eseguia ogni volta che c'è un cambio nello statodi prontezza quindi noi utilizzeremo onload() solitamente(che viene eseguito quando il ready state è a 4)(definisc una funzione richiamta al cambio della propreta ready state) quindi in general e per vedere se il server è pronto con le funzioni respondeXML o responseTEXT prendo la risaposta del server.


# JSON
Javascript Object Notation
per scambio di dati client-server. è un formato che può essere utilizzato tramite classi di javascript.
nato per rendere molto più semplice gestione di dati in lato web.
dati che sopporta
Booleani
Interi e numeri di virgola
stringhe
Array
Array associativi
Null
formato
{
	"nomeDelCampo" : "valoreDellaVariabile",
	"nome" : "Mario",
	"oggetto" : {
		"campo" : "dato",
		"giorno" : 1
	},
	"array" : [ "el1", "el2" ],
	"lingue" : [ "it", "en" ]
}
semplice uso →
JSON.parse();
mi restituisce un oggetto javascript che poi da li posso prendere i campi
 
json_encode(var);
 






