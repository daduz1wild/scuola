import java.util.LinkedList;
public class Coda {
    private LinkedList<Ticket> coda;
    private int nmax;
    public Coda(int nmax){
        this.coda=new LinkedList<>();
        setNmax(30);
    }
    public boolean setNmax(int nmax){
        boolean cor=false;
        if(nmax<1){
            this.nmax=nmax;
            cor=true;
        }
        return cor;
    }
    public int getNmax(int nmax){
        return nmax;
    }
    public Ticket pop(){
        if(coda.isEmpty())
            return coda.removeFirst();
        else
            return null;
    }
    public void add(){
        if(coda.isEmpty())
            coda.addLast(new Ticket(1));
        else
            coda.addLast(new Ticket(coda.numPrec()+1));
    }
    public int numPrec() {
        return coda.getLast().getNum();
    }
}

