## ALBERI 
Gli alberi sono dei particolari tipi di grafi SENZA CICLI e SEMPRE CONNESSI
Il nodo iniziale viene chiamato RADICE dell'albero.
Quelli finali, ossia quelli che non hanno figli, vengono chiamati FOGLIE, ed essi non sono vincolati dal livello.
Si possono avere foglie a qualsiasi livello.
Non esiste un vincolo al numero di figli che ogni nodo puo' avere.

L'albero si puo' definire come una struttura RICORSIVA, dato che al suo interno si possono individuare dei SOTTOalberi


ALBERI BINARI
Un albero binario e' un tipo particolare di albero che limita il numero di figli per nodo a 2: vengono definiti nodo di SX e di DX


ALBERI BINARI DI RICERCA (ABR)
In questo tipo di albero i dati vengono inseriti secondo la logica:
		---------------------------
		| ValSX < ValROOT < ValDX |
		---------------------------
	Applicata RICORSIVAMENTE SU OGNI SOTTOALBERO
Si suggerisce l'implementazione dell'interface Comparable per confrontare gli oggetti da inserire


S: left
D: right
R: root
Percorrimento ABR    -->    POSTorder - sdR
	|	 \
	|    PREorder - Rsd
	|
  INorder - sRd


private String stampaInOrder(Nodo n){
	if(n != null){
		String s = "";
		s = s.concat(stampaInOrder(n.getLeft()));
		s = s.concat(n.toString());
		s = s.concat(stampaInOrder(n.getRight()));
	}
}



Un grafo e' una struttura che prevede che ogni nodo possa avere una connessione con un qualsiasi altro nodo

I grafi possono essere:
 - Connesso;
 - Non connesso (esistono loose ends);

Solitamente esiste un nodo di partenza (il first della lista)



## HASHTABLE
Le hashtable memorizzano i dati tramite coppie "key - value"
La key deve essere univoca.
Tramite delle funzioni matematiche (dette funzioni di hash), la key verra' trasformata nel valore relativo.
Una collisione e' quando la funzione di hash assegna lo stesso indirizzo a due (o piu') chiavi diverse.

Class Hashtable<K,V>	// Doppio tipo generico NON primitivo

private Hashtable<String, Macchina> elenco;	// Struttura dati COMPLETAMENTE in memoria

private Hashtable<String, Long> elenco;		// Solo la table e' contenuta in memoria, il Long indica la posizione nel RAF





