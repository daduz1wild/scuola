/*

Realizzare un’applicazione in grado di gestire la vostra scheda SIM.
La SIM è caratterizzata da:
Nome intestatario
ICCID
Numero di telefono
Credito residuo
Minuti di chiamate effettuate sulla SIM
SIM attiva(boolean)
Realizzare i seguenti metodi:
Costruttori (ogni SIM creata deve essere disattiva)
Getters e Setters
Metodo toString
Metodo compareTo
Metodo che riceve un valore in euro ed effettua la ricarica della SIM.
Metodo che, dato un tempo in minuti, permetta di effettuare una chiamata. (La tariffa per le chiamate è pari a 0,32€/min – nel caso in cui il credito non sia sufficiente?)
Metodo DISATTIVA SIM con cui si potrà disattivare la SIM
Metodo che converte i minuti di chiamate nel formato: hh:mm

Realizzare un main di prova contenente il seguente menu:
Attiva SIM
Stampa dati SIM
Ricarica SIM (tagli ricarica: 5€, 10€, 20€)
Effettua telefonata
Visulizza hh:mm totale di chiamate
Disattiva SIM
 */
public class Main{
    public static void main(String[] args){
        int m;
        String nom, cogn;
        nom=Leggi.leggiStr("inserisci nome");
        cogn=Leggi.leggiStr("inserisci cognome");
        Sim sim=new Sim(nom,cogn);
        do{
            m=Leggi.leggiInt("Inserisci:\n1.attiva sim\n2.stampa dati sim\n3.Ricarica SIM (tagli ricarica: 5€, 10€, 20€)\n4.Effettua telefonata\n5.Visulizza hh:mm totale di chiamate\n6.Disattiva SIM\n7.termina",1,7);
            switch(m){
                case 1:
                    attivaSim(sim);
                    break;
                case 2:
                    stampaDati(sim);
                    break;
                case 3:
                    ricaricaSim(sim);
                    break;
                case 4:
                    chiama(sim);
                    break;
                case 5:
                    visTempo(sim);
                    break;
                case 6:
                    disSim(sim);
                    break;
            }
        }while(m!=7);
    }
    public static void attivaSim(Sim sim){
        if(sim!=null) {
            if (!sim.getAttiva()) {
                sim.setAttiva(true);
                System.out.println("la sim è stata attivata");
            } else
                System.out.println("la sim è già attiva");
        }else
            System.out.println("la sim non esiste");
    }
    public static void stampaDati(Sim sim){
        if(sim!=null)
            System.out.println(sim);
        else
            System.out.printf("la sim non esiste");
    }
    public static void ricaricaSim(Sim sim){
        double val;
        if(sim!=null) {
            do {
                val = Leggi.leggiDouble("inserisci valore da accreditare(5,10 o 15)", 5, 20);
            } while (val != 5 && val != 10 && val != 20);
            sim.ricarica(val);
        }else
            System.out.println("la sim non esiste");
    }
    public static void chiama(Sim sim){
        if(sim!=null){
            int min;
            min=Leggi.leggiInt("quanti minuti di chiamata?",1,100);
            if(sim.chiamata(min))
                System.out.println("chiamata in corso");
            else
                System.out.println("credito non sufficiente");
        }else
                System.out.println("sim non esistente");
    }
    public static void visTempo(Sim sim){
        if(sim!=null)
            System.out.println(sim.convMin());
        else
            System.out.println("sim non esistente");
    }
    public static void disSim(Sim sim){
        if(sim.getAttiva()) {
            sim.setAttiva(false);
            System.out.println("la sim è stata disattivata");
        }else
            System.out.println("la sim è già disattiva");
    }
}