/*
Realizzare il programma che ,usando la classe Coda, implementi
la coda di uno sportello all'ufficio postale:
a) arrivo di una nuova persona (nuovo ticket, numero da determinare)
b) accesso di una persona allo sportello (visualizzare numero ticket)
Postare il tutto su OneNote.
 */
public class Main{
    public static void main(String[] args) {
        int m,nmax;
        Coda coda;
        nmax=Leggi.leggiInt("inserisci numero massimo ticket",1,100);
        coda=new Coda(nmax);
        do{
            m=Leggi.leggiInt("Inserisci:\n1.nuovo ticket\n2.visualizza numero ticket\n3.termina\n",1,3);
            switch(m){
                case 1:
                    coda.push();
                    break;
                case 2:
                    System.out.println("il tuo ticket è il numero " + coda.pop().getNum());
                    break;
            }
        }while(m!=3);
    }
}
