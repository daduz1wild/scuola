import java.util.LinkedList;
public class Coda {
    private LinkedList<Ticket> coda;
    private int nmax;
    public Coda(){
        coda=new LinkedList<>();
        setNmax(30);
    }
    public void setNmax(int nmax){
        boolean cor=false;
        if(nmax>0) {
            this.nmax = nmax;
            cor = true;
        }
    }
    public void add(){
        if(coda.size()<nmax)
            if(coda.isEmpty())
                coda.addLast(new Ticket(1));
            else
                coda.addLast(new Ticket(coda.getLast().getNum()+1));
        else
            throw new IllegalArgumentException("troppi ticket presenti");
    }
    public Ticket pop(){
        if(coda.isEmpty())
            throw new IllegalArgumentException("nessun Ticket da prelevare");
        else
            return coda.removeFirst();
    }
}
