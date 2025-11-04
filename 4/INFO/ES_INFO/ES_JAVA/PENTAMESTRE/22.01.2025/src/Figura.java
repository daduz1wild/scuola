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
import java.util.LinkedList;
import java.util.StringTokenizer;

public class Figura implements FileCSV{
    protected int nLati;
    protected LinkedList<Double> valLati;
    @Override
    public String toString() {
        return this.valLati.toString();
    }
    protected double area(){
        return 0;
    }
    protected double p(){
        try {
            double p = 0;
            for (Double lato : valLati) {
                p += lato;
            }
            return p;
        } catch (NullPointerException e) {
            throw new NullPointerException("errore");
        }
    }

    public int getNLati() {
        return nLati;
    }

    public Double getValLati(int n) {
        if (n - 1 >= 0 && n - 1 <= valLati.size())
            return valLati.get(n - 1);
        else
            throw new IndexOutOfBoundsException("num lato non valido");
    }
    public void setNLati(int nLati){
        if(nLati>0 && nLati<=4)
            this.nLati=nLati;
        else
            throw new IllegalArgumentException("valore non accettato");
    }
    public void setValLati(double valLato,int n){
        if(n-1>=0 && n-1<=valLati.size()){
            if(valLato>0) {
                if (n == valLati.size())
                    valLati.addLast(valLato);
                else
                    valLati.add(valLato);
            }else
                throw new IllegalArgumentException("valore lato errato");
        }else
            throw new IllegalArgumentException("valore numero lato errato");
    }
    public String toCSV(){
        String s = "";
        s = s.concat(this.getNLati() + ";");
        for(int k = 0; k < this.getNLati(); k++)
            s =  s.concat(this.getValLati(k) + ";");
        return s;
    }
    public void fromCSV(String s) {
        if (s != null) {
            if (!s.isEmpty()) {
                StringTokenizer toks = new StringTokenizer(s, ";");
                for (int k = 0; k < this.getNLati(); k++)
                    this.setValLati(Double.parseDouble(toks.nextToken()), k);
            } else
                throw new IllegalArgumentException("Stringa vuota");
        } else
            throw new NullPointerException("Puntatore a NULL non consentito");
    }
}
