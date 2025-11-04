public class Main{
	public static void main(string[] args){
		system.out.println("hello world");
	}
}

io poterei andare ad eseguire il mio programma da prompt, se io passassi dei parametri durante l'esecuzione andrebbero all'internio dell0'array

il vettore  string args contiene tutti i vari parametri che io vado a passare durante l'esecuzione

public class Main {
    public static void main(string[] args){
        int num;
        float numF;
        boolean m;
    }
}

public class Main {
    public static void main(string[] args){
        system.out.println("ciao alban"); //va a capo
        system.out.print("ciao alban"); //non va a capo
    }
}

int num=5;
system.out.print("ciao alban"+num); //la stringa viene concatenata, puoi anche concatenare piu volte("a"+num+num1) ma lk'importante è che la stringa sia il primo elemento nel parametro

oggetto

scanner input=new Scanner(System.in);//anniamo dichiarato uno scanner che preleva dallo standard input dei dati, scanner offre diverse funzionalità


es 1 dati due numeri in put

public class Main {
    public static void main(string[] args){
        scanner input=new Scanner(System.in);
		int n1,n2,somma;
		system.out.print("Inserisci il primo numero: ");
		n1=input.nextInt();// tramite nextInt indichiamo che il valore che dobbiamo inserirr è un intero, input invece è la funzione di tipo scanner
		system.out.print("Inserisci il secondo numero: ");
		n2=input.nextInt();
		somma=n1+n2;
		system.out.print("Somma: "+somma);
		
    }
}

ctrl+shift freccia giu e su      sposta la riga dim codice
capo sout tab           system.out.println("")
ctrl /   commenta le righe selezionate
ctrl+shift+/  commenta le righe selezionate in blocco

()=flusso dati da cui leggere i dati, in questo caso standard input (system.in)

la new è come la malloc

dichiaro un oggeto input di classe scanner che è provvista di vari metpodi che ci permettono di convertire i valori che arrivano dallo standard input in valori alfanumerici

due tipi di variabili
primitivi          		riferimento
sempre istanziate



public=indica che questo tipo diu funzione e visibile all'interno di tutto il progetto che abbiamo creato

static= significa che posso richiamare questa funzione senza il bisogno di averun oggetto
string[]mè un parametro che contiene tutti i vari parametri che io passo facendo partire l'esecuzione

per Input si usa la classe scanner

i parametri sono solo per valori, non per referenza

il compilatore crea un file oggetto e poi in c viene creato l'eseguibile tramite il file oggetto, quindi se usi macchinew diverse è un casino invece l'interprete  fa si che si abbia portabilità, prò interprete controlla solo riga che vuoi eseguire.Per questo java ha pensato a un altro metodo fa la traduzione direttamnete in bytecodee lo definisce come cadica macchina, poi da qui questo codice macchina manda alle varie ,macchine che hanno il proprio interprete e così fa il controllo dei dati e porta ad eseguibile

il nome che diamo alla classe deve avere lo stesso nome del file in JAVA(il nome della classe è il nome del file) tutti i .classe vengono chiamati tramite l'interprete quindi da quel che ho capito per ogni classe si deve creare un file 