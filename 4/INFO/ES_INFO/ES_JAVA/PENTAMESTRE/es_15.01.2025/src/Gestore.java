import java.util.LinkedList;

//Produrre classe GESTORE (con metodi add, toString ed elencoAree)
public class Gestore {
    private LinkedList<Figura> el;
    private int nmax;
    public Gestore(){
        init();
    }
    private void init(){
        el=new LinkedList<>();
        setNmax(3);
    }
    public Gestore(int nmax){
        el=new LinkedList<>();
        setNmax(nmax);
    }
    public void setNmax(int nmax){
        if(nmax>0)
            this.nmax=nmax;
        else
            this.nmax=3;
    }
    public int nmax(){
        return this.nmax;
    }
    public void add(Figura figura) {
        if (el.size() < nmax) {
            el.add(figura);
        } else {
            System.out.println("Numero massimo di figure raggiunto.");
        }
    }
    @Override
    public String toString(){
        String s="";
        for(Figura figura : el)
            s+=figura.stampa();
        return s;
    }
    public String elencoAree(){
        String s="";
        for(Figura figura : el)
            s+=figura.getArea();
        return s;
    }
}
