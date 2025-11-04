public class Nodo <T extends Comparable<T> & FileCsv>{
    private T dato;
    private Nodo<T> right,left;

    public Nodo<T> getNext() {
        return this.next;
    }
    public T getDati(){
        return this.dato;
    }

    public void setDato(T dato){
        if(dato==null){
            throw new NullPointerException("Non c'è nessun dato");
        }else
            this.dato = dato;
    }
    public void setRight(Nodo<T> right){
        this.right=right;
    }
    public void setLeft(Nodo<T> left){
        this.left=left;
    }
    public Nodo(T dato){
        setDato(dato);
        setRight(null);
        setLeft(null);
    }
    public Nodo(T dato, Nodo<T> right, Nodo<T> left){
        setDato(dato);
        setRight(right);
        setLeft(left);
    }

}

