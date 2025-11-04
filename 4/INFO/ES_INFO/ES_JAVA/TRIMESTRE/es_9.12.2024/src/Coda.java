/*
Realizzare la classe Coda di oggetti di tipo Ticket(come esercizio di allenamento sull'uso di arrayList o
LinkedList, decidete voi quale è meglio) che esponga i seguenti metodi: pop, push, isEmpty, isFull, getLast.
Produrre anche l'UML associato. Postare il tutto su OneNote.
*/

import java.util.LinkedList;
public class Coda {
    private LinkedList<Ticket> coda;
    private int nmax;
    public Coda(){
        this.coda = new LinkedList<>();
        this.setNmax(30);
    }
    public Coda(int nmax){
        this.coda = new LinkedList<>();
        this.setNmax(nmax);
    }
    public int getNmax() {
        return nmax;
    }

    public void setNmax(int nmax) {
        this.nmax = nmax;
    }
    public Ticket pop(){
        if(!this.isEmpty())
            return this.coda.removeFirst();
        else
            return null;
    }
    public void push(){
        if(this.coda.isEmpty())
            this.coda.addLast(new Ticket(1));
        else
            this.coda.addLast(new Ticket(this.numPrec() + 1));
    }
    public boolean isEmpty(){
        return this.coda.isEmpty();
    }
    public boolean isFull(){
        return this.coda.size() == this.getNmax();
    }
    public Ticket getLast(){
        return this.coda.getLast();
    }
    public int numPrec(){
        return this.coda.getLast().getNum();
    }
}
