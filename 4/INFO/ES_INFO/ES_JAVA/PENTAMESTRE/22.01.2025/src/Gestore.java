/*
Getstire quadrilateri e triangoli come elementi ereditati da classe figura e metodi comuni come stampa, area e perimetro.
Realizzare un programma che gestisce n figure tramite classe GESTORE che possono essere o quadrilateri o triangoli (a scelta dell'utente) sui quali si possano fare
le seguenti operazioni: 1)inserimento,
2)stampa dei dati delle figure inserite (se quadrilatero si stampa "quadrilatero+ lato1+lato2+area=.....+perimetro=...’’", se triangolo si stampa
"triangolo+l1+l2+l3+area=....+perimetro=.....”,
3)elenco delle aree di ogni figura in output si stampa “quadriatero: area=.....” se quadrilatero; “triangolo:area=....” se triangolo.
Produrre classe GESTORE (con metodi add, toString ed elencoAree), la classe Figura e le classi Quadrilatero e TRiangolo. ed il main che realizzata I/O con utente
e classe Gestore.

Caricare un elenco di figure geometriche a partire da un file csv (da descrivere). Ogni riga del file conterrà i dati o di un quadrilatero o di un triangolo
(in base al valore di un item).
Al termine del caricamento il programma stamperà il perimetro di ogni figura iportata (polimorfismo!!).
Classe Gestore: aggiunta di due metodi importazione ed esportazione di fugure geometriche.
Interface FileCsv: da scrivere (metodi toCsv e fromCsv)
Classe Figura: deve implementare l'interface FileCsv.

 */
import java.util.StringTokenizer;
import java.util.LinkedList;
import java.io.*;
public class Gestore {
    private final LinkedList<Figura> lista;
    public Gestore(){
        lista=new LinkedList<>();
    }
    public void add(Figura a){
        if(a!=null)
            lista.add(a);
        else
            throw new NullPointerException("figura non esistente");
    }
    @Override
    public String toString(){
        String s="";
        for(Figura a : lista)
            s=s+a.toString()+"\n";
        return s;
    }
    public String elencoAree(){
        String s="";
        for(Figura a : lista)
            s=s+a.area()+",";
        return s;
    }
    public String elencoP(){
        String s="";
        for(Figura a : lista)
            s=s+a.p()+",";
        return s;
    }
    public void imp() {
        try {
            FileReader f = new FileReader("file.csv");
            BufferedReader fin = new BufferedReader(f);
            String s = fin.readLine();
            while (s != null) {
                try {
                    StringTokenizer toks = new StringTokenizer(s, ";");
                    int nLati = Integer.parseInt(toks.nextToken());
                    Figura figura;
                    if (nLati == 3) {
                        figura = new Triangolo();
                    } else if (nLati == 4) {
                        figura = new Quadrilatero();
                    } else {
                        throw new IllegalArgumentException("figura non riconosciuta");
                    }
                    figura.fromCSV(s);
                    this.add(figura);
                } catch (Exception e) {
                    System.out.println(e.getMessage());
                }
                s = fin.readLine();
            }
            fin.close();
            f.close();
        } catch (IOException e) {
            System.out.println("Errore nella lettura del file: " + e.getMessage());
        }
    }
    public void esp(){
        if(!this.lista.isEmpty()){
            try{
                PrintWriter fin = new PrintWriter(new FileWriter("file.txt"), true);
                for(Figura f : this.lista)
                    fin.println(f.toCSV());
            } catch(IOException exc){
                System.out.println("errore, dettagli:"+ exc.getMessage());
            }
        }else
            throw new IllegalStateException("Nessuna figura importata");
    }
}

