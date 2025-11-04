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

public class Quadrilatero extends Figura{
    public Quadrilatero() {
        this.setNLati(4);
        this.valLati = new LinkedList<>();
        for (int k = 0; k < this.getNLati(); k++) {
            this.setValLati(1, k);
        }
    }
    public Quadrilatero(double l1,double l2,double l3,double l4){
        this.setNLati(3);
        valLati=new LinkedList<>();
        setValLati(l1,1);
        setValLati(l2,2);
        setValLati(l3,3);
        setValLati(l4,4);
    }
    public Quadrilatero(Quadrilatero a){
        this.setNLati(4);
        valLati=new LinkedList<>();
        for (int k = 0; k < this.getNLati(); k++) {
            this.setValLati(a.getValLati(k),k);
        }
    }
    @Override
    protected double area(){
        return (this.getValLati(1) * this.getValLati(2));    }
}

