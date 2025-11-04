user thread = thread riferiti all'applicazione scritta dall'applicazione(applicativo creato dal programmatore). non sono vincolati dalla java virtual machine, priorita piu alta
daemon thread=agiscono in background, priorita minore e sono strettamente legati alla JVM.

2 metodi per creare un thread, tramute classe thread(ereditarietà), oppure implementando l'interface runnable .in tutti e due i casi si deve overrididare il emtodo public void run(){}
che viene richianato dal metodo t1.start();però se usi l'interface runnable non hai direttamente l'oggetto con tutti i metodi della classe thread come con l'ereditarietà, quindi per farlo creo ad esempio l'oggetto pizzaiolo e poi creo l'oggetto thread e nel suo costruttore metto l'oggetto pizzaiolo.

la join() fa in modo che 

posso cambiare tipo di thread prima di effettuare la start()

setName serve per cambiare il nome del thread
setPriority serve per settare la priorita, di default è a 5

quando un thread lancia un'eccezzione posso gestirla conj un handler che si preocupera di gestirla e nei suoi prarmetri vuole quei due prametri, subito dopo averla chiamata crei il suo metodo override in cui scrivi il codice che vuoi che venga eseguito quando esso viene richiamato t.setUncaughtExceptionHandler(new Thread,UncaughtExceptionHandler);
@Override
public void set...(Thread,UncaughtExceptionHandler){
...
}


puoi fare delle variabili  che usano solamente i singoli thrrad dichiarando all'interno del run e non come attributo

la risorsa è una spazio di memoria a cui i thread cercano di accedere e per farlo c'è bisognoi di sincronizzare la risorsa condivisa, per farlo ci sono diverse possibilita:
per farlo devo verificare quali sono le istruzioni che accedono alla risorsa condivisa lo rendo 
1.
sinchronized
sinchronized(risorsa){
// tutto il codice del run 
}
2.
se voglio sincronizzare direttamente tutto il metodo è mettere come tipo di metodo sinchronized ad esempio public sincrnized setContenuto


Thread.currentThread().getName()
	prende il thread attuale | prende il nome del thread


la parte grafica in java fx puo essere modificata solo ai thread dedicati a javaFX quindi per questo si deve sfruttare il controller (siccome dobbiamo accedere all'interfaccia grafica).
quindi nel run chiamo un metodo che ho nel controller(in cui avrò dichiarato il mio thread(ad es printer)) ad esempio stampaContenuto nella quale avro dichiarato il metodo runLater che serve per javaFX in modo che sara un thread dedicato per la modifica dell'interfaccia grafica a modificare