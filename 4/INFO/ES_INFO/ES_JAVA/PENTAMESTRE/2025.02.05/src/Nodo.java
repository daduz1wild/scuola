public class Nodo <T>{
    private final T dati;
    private Nodo<T> next;

    public Nodo<T> getNext() {
        return this.next;
    }
    public T getDati(){
        return this.dati;
    }

    public void setNext(Nodo<T> next){
        this.next = next;
    }
    public Nodo(T dati){
        this.dati = dati;
        setNext(null);
    }
    public Nodo(T dati, Nodo<T> next){
        this.dati = dati;
        setNext(next);
    }

}

