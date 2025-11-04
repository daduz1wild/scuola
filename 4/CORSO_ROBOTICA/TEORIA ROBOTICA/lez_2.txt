tasti neri in altro a sinistra servono per aumentare in percentuale la velovita dell'arm

tasti neri in centro sono 6 coppie per il movimento degli assi ogni coppia un asse
atsti in bassp a sinistra  servuono per rotazione della pinza

i tasti a mezza altezza a sinistra(3 coppie) è lo spostamento  rispetto alla terna, quelli a destra sono le rotazioni introrno alla terma di riferimento

quelli a meta altezza e in basso muovono rispetto a me operatore che sto operando  una coppia verso l'alto e basso e gli altri quattro sempre rispetto asll'operratore

quelli neri a mezza altezza e in mezzo sono rispetto alla terna di spigolo, detta UFRAME

tasto reset dopo che hai sistemato il problema che dava l'alert

messaggi rossi alert, errori che è possibile sistemare
messaggi viola c'è da riavviare l'applicazione è più grave

è possibile avere fino a 64 tool in memoria al massimo

4 arm max
arm settings puoi decidere anche la velovità di movimento.

un oggetto terna ha nisgono di 6 assi per specificare la suo posizione negli assi , gli ultimi 3 assi indicano la rotazione attorno ai singoli 3 assi quindi rotazione per ogni asse(x,y,z)

terna tool che è la posizione dell'utensile utilizzato è modificabile
terna uframe e la posizione e orientamento del piano di lavoro anche questa mofiifcabile dall'operatore
posizione operatore(tasti centrali sia in altezza che orizzontalmente) permettono di mofificarew rispetto all'operatore

sia tool che uframe possiamo impostarene 64

andando a prendere la poszione di un oggetto vengono fatti una serie di calcoli cinematici per il movimento

molto importante sapere differnza tra ternew locali o remote: le prime  hanno l'utensile che è montato sulla flangia e il pezzo das lavoprare asterno all'ARM,invece quelle remotye il contrasrio quindi pexzzo da lavorare montato sulla flangia e l'tensile esternoa ll'arm

jointpos sono assoluti(cioè sempre quelli, fissi)specifica la posizione di home, infatti mi serve per far partire dalla posizione di home. il punto del discorso è che la jointpos la devo usare per specificare la posizione di home.

position(relativa)

xtndpos va a muovere tutto il robot, si va ad utilizzare degli assi ausiliari(apertura chiusura della pinza o spostamentoi del robot lungo il nastro trasportatore)

TCP(punto di lavoro) (tool center point) è il putnod i lavorazione dell'utensile.

nel controlller ci sono due tipi di memoria: memoria di lavoro(è una specie di memoria ram) e memoria di tipo residente(è una memoria che rimane residente sul sistem).
per eseguire un programma devo infatti prima mettere il codice in queste 2 memorie.

alerrt page e dove ci sono gli errori

le variabili si dichiarano con VAR e dopo aver inserito i dati che inq eusto caso indicano indirizzi/ posizioni scrivi POSITION(istruzuione: VAR pnt0001J,ind 2,ind 3, ind 4; POSITION)

cheidi bene a chat gpt la differenza tra dato di tipo position e jointposition

importante specificare lo uframe che si utilizza(rispetto a quale riferimento dici una posizione relaiìtiva.)

scopri cosa è ToolFrame.è zona di lavoro del tool.

quale è la differenza tra (move to)=si muove su più assi(indicando la posizione)la si usa quando  non sappiamo il punto di partenza e quindi esso si farà una propria traiettoria per non schivare ostacoli in mezzo  e (move linear to)=si muove in modo lineare dal punto di partenza al punto di destinazione seguendo una traiettoria di tipo lineare

$GEN_OVR= quando la fisso mi vale per tutti i programmi e gli specifico una certa percentuale di velocità per tutti gli ARM, anche di tutti i manipolatori che sto programmando, 100% è il massimo che posso settare
$ARM_OVR= se invece voglio specificare velocità diverse per gli ARM
$PROGRAM_OVR essendo che suu un unico arm possiamo avere più programmi, posso specificare la velocita di un programma  e questa sta sotto alla velocita dell'arm.
$LIN_SP
tutte queste 4 elementi epr la velocità sono variabili già presenti nel sistema non dobbiamo dichiararli
QUINDI AD ESEMPIO SE HO 80% DI VELOCITA PER GEN E 50 NPER ARM ALLORA IL 50 sara il 50% dell'80 e a sua volta se per program ho 30% sarà il 30 del 50 che aveva ARM 

se vuoi portarlo in modalita di calibrazione vai nella pagina della home poi service system execute poi selezioni move arm to scal sis invece programma proprietario non metti nulla, poi avvia e schiacci start.

per importare un oggetto, ad esempio un tavolo vai dove c'è la scena schiacci su ext popoi schiacci sulla vfreccia verde verso l'alto vai su objects e poi selezioni quello che vuoi poi andrai sugli oggetti e metti le varie misure tra cui importante anche la scala.
per importare un utensile al posto di object vai su tools e selezioni l'utensile chde vuoi(che è montato al braccio)

per modificare i dati dei tool vai in data poi tool e per selezionarli per il robot  vai in motion e selezioni il tool interessato e il frame interessato chje e frame0 (frame è il piano di lavoro).