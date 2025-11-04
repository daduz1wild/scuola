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

public class Main {
    public static void main(String[] args) {
        Gestore g = new Gestore();
        int m;
        do{
            m = Input.lgInt(1,6,"1. Inserimento figura\n2. Stampa dati\n3. Stampa le aree\n4. importa\n5. esporta\n6.termina");
            switch(m){
                case 1: {
                    aggiunta(g);
                    break;
                }
                case 2: {
                    System.out.println(g);
                    break;
                }
                case 3: {
                    System.out.println(g.elencoAree());
                    break;
                }
                case 4:{
                    g.imp();
                    break;
                }
                case 5:{
                    g.esp();
                    break;
                }
            }
        }while(m !=6);
    }

    private static void aggiunta(Gestore g) {
        char c;
        double l1, l2, l3, l4;
        boolean val = false;
        do{
            c = Input.lgChar("quadrilatero o triangolo (q/t)? ");
            if(c == 'q'){
                try{
                    l1 = Input.lgDbl(0, Double.MAX_VALUE, "primo lato: ");
                    l2 = Input.lgDbl(0, Double.MAX_VALUE, "secondo lato: ");
                    l3 = Input.lgDbl(0, Double.MAX_VALUE, "terzo lato: ");
                    l4 = Input.lgDbl(0, Double.MAX_VALUE, "quarto lato: ");
                    g.add(new Quadrilatero(l1, l2, l3, l4));
                    val = true;
                }
                catch(IllegalArgumentException e){
                    System.out.println(e.getMessage());
                }
            }
            else
                if(c == 't'){
                    try{
                        l1 = Input.lgDbl(0, Double.MAX_VALUE, "Inserire primo lato: ");
                        l2 = Input.lgDbl(0, Double.MAX_VALUE, "Inserire secondo lato: ");
                        l3 = Input.lgDbl(0, Double.MAX_VALUE, "Inserire terzo lato: ");
                        g.add(new Triangolo(l1, l2, l3));
                        val = true;
                    }
                    catch(IllegalArgumentException e){
                        System.out.println(e.getMessage());
                    }
                }else
                    System.out.println("Errore, reinserire: ");
        }while(!val);
    }
}
