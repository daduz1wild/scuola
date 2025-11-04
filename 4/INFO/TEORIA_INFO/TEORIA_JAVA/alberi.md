gli alberi sono strutture a grafi, composti da nodi i cui ognuno rappresenta uno stato diverso di un oggetto dell'albero/grafo.
un esempio di grafo puo essere  la struttura della metro con le varie fermate.
 i grafi possono essere connessi o non connessi:
 connesso=non esistono nodi isolati (che non hanno collegamenti).
 non connessi= i nodi sono isolati(non hanno collegamenti)
 il percorso è l'insieme degli archi, che io percorro per arrivare al nodo destinatario.
 molti grafi permettono un percorso ciclico(partire da un nodo e tornare allo stesso nodo)che possono avere una sola direzione o anche tutte e due.
 Un albero è un grafo molto particolare che è sempre connesso ed è senza cicli( non è possibile partire da un nodo e tornare a uno stesso nodo).
 l'albero viene parsagonato all'albero botanico, preso al contrario . infatti il primo nodo parte dalla radice e poi i nodi che non hanno più collegamenti sono le foglie.
 i nodi di un albero non hanno una limitazione di figli. i nodi di solito si rappresentano per livello, radice, 1° figlio, 2° figlio.( infatti il numero dei livelli è detto profondita dell'albero).
ogni nodo puo avere un numero di figli da 0 ad n.
la struttura ad albero che facciamo a noi è una struttura ricorsiva(albero binario) ed è un albero che limita il numero dei figli( ogni nodo ha max 2 figli(nodo di destra e nodo di sinistra)),possono esserci anche nodi senza figli e le foglie possono essere a livelli diversi(nodo senza figli è una foglia).
la logica con cui memorizziamo i dati, è una struttura dati in cui si usa una struttura dati binaria ma particolare.
il figlio di sinistra ha valori più piccoli rispetto alla sua  radice(nodo prima di lui/padre, invece il nodo di destra ha valori piu grandi della sua radice(il padre). questa cosa vale ricorsivamente quindi ogni figlio a sua volta avra questa volta quindi sx<x<dx /.
questo serve per avere una logica della ricerca binaria però incluso in una struttura ad albero.
questo è potente se i nodi da cui cerchiamo hanno lo stesso numero di sottonodi.
La cancellazione e molto complicata negli alberi, quindi quando si vuole cancellare un nodo, lo si fa logicaente usando una variabile booleana che indica, se si deve tenere conto di quell'elemento.
quindi i nodi eliminati logicamente useranno memoria, ma non si terra conto di essi durante le varie operazioni.

 