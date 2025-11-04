terna mondo
terna di base del robot(UFRAME),si fa coincidere con terna mondo solitamente
TOOL 0=situata al centro della frangia del nostro robot e ha l'asse z uscente 
Terna di tool=per calcolarla si utilizza il tool master che prevdede l'utilizzo di un tool master tarato.
calcolo del tool= serve per mantenere un punto fisso al tool nel caso in ci il tool viene calcolato male  allora il punto fisso cambia
in base al peso del tool cambia anche il tipo del calcolo che si fa per trovare la poszione della terna di tool.
se abbiamo 3 robot che fanno lo stesso compito 

calcolo tool
calcolo payload
calcolo uframe

Il linguaggio PDL2 èil linguaggio usato per programmare le macchine, molto simile al PASCAL
per andare dal punto a al punto si possono fare traiettorie lineari(senza ostacoli, move linear) che libere(con ostacoli in mezzo, MOVEJ
la programmazione solitamente ha un programma che richiama dei sottoprogrammi che contengono le varie funzioni.
HOLDable(è un programma che può essere fermato, e che quindi ha dei movimenti da bloccare)
noHOLDable(programmi in cui non ci sono movimenti e nulla viene settato, non hanno start e stop perche tutte le operazioni vengono eseguite in un momento ad es.assegnazioni)

variabili di sistema sono caratterizzate dal simbolo SIS$
var di velocita sulle asse delle ordinate abbiamo la velocità e sull'altro accelerazione

quando sposto la posizione dell'arm in un punto posso farlo con diverse precisioni usando FINE per avere la massim aprecisione e poi altre in cui mi serve meno precisione.
MOVEFLY è un movimento continuo in cui vengono raggiunti più punti, è un lavoro di poca precisione,infatti per usare MOVEFLY non devo aver bisogno di precisione, perchè nel momento in cui l'arm si avvicina a uno fra i punti indicati esso non ci arriva precisamente ma ha un percorso che quando si avvicina al punto c'è un raccordo fra i due segmenti collegati col punto  indicato, questo metodo di movimento è più veloce rispetto a uno più preciso

il tipo di nodo da selezionare ogni volta di431_005