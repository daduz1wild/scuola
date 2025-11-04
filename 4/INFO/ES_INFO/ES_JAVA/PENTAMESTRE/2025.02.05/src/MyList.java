/*
Realizzare la classe MyList su tipo generico T (e relativa classe Nodo) con i seguenti metodi:
boolean add(T obj), void addFirst(T obj), void addLast(T obj), void clear(), boolean cointains(), T element(),
 T getFirst(), T getLast(), T remove (), T removeLast(); (si veda documentazione della classe MyList x la
 relativa descrizione ed eccezioni che devono lanciare).
Postare la soluzione su OneNote.

Esercizio: gestione di una coda per o sportello di un ufficio postale in cui esistono code di tipo diverso ed in
cui ogni push avviene determinando il numero del ticket da stampare per l'utente come concatenazione di nome
della coda + numero progressivo autoincrementante.
 */

public class MyList<E> {
    private Nodo<E> first;

    public Nodo<E> getFirstNode() {
        return first;
    }
    public void setFirst(Nodo<E> first) {
        this.first = first;
    }

    public MyList() {
        this.first = null;
    }

    public boolean add(E e) {
        if (e != null) {
            if (contains(e)) {
                return false;
            } else {
                Nodo<E> last = new Nodo<>(e);
                if (getFirstNode() == null) {
                    this.first = last;
                } else {
                    Nodo<E> nodo = getFirstNode();
                    while (nodo.getNext() != null) {
                        nodo = nodo.getNext();
                    }
                    nodo.setNext(last);
                }
                return true;
            }
        } else {
            throw new NullPointerException("Oggetto null non consentito");
        }
    }

    public void addFirst(E e) {
        if (e != null) {
            Nodo<E> aus = getFirstNode();
            this.first = new Nodo<>(e, aus);
        } else {
            throw new NullPointerException("Oggetto null non consentito");
        }
    }

    public void addLast(E e) {
        if (e != null) {
            Nodo<E> last = new Nodo<>(e);
            if (getFirstNode() != null) {
                Nodo<E> nodo = getFirstNode();
                while (nodo.getNext() != null) {
                    nodo = nodo.getNext();
                }
                nodo.setNext(last);
            } else {
                first = last;
            }
        } else {
            throw new NullPointerException("Oggetto null non consentito");
        }
    }

    public void clear() {
        if (getFirstNode() != null) {
            this.first = null;
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public boolean contains(E e) {
        if (e != null) {
            Nodo<E> nodo = this.first;
            while (nodo != null) {
                if (e.equals(nodo.getDati())) {
                    return true;
                }
                nodo = nodo.getNext();
            }
            return false;
        } else {
            throw new NullPointerException("Oggetto null non consentito");
        }
    }

    public E element() {
        if (getFirstNode() != null) {
            return this.first.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public E getFirst() {
        return element();
    }

    public E getLast() {
        if (getFirstNode() != null) {
            Nodo<E> last = getFirstNode();
            while (last.getNext() != null) {
                last = last.getNext();
            }
            return last.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public E removeFirst() {
        if (getFirstNode() != null) {
            Nodo<E> exFirst = getFirstNode();
            this.first = this.first.getNext();
            return exFirst.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public E removeLast() {
        if (getFirstNode() != null) {
            Nodo<E> prec = null;
            Nodo<E> last = getFirstNode();
            while (last.getNext() != null) {
                prec = last;
                last = last.getNext();
            }
            if (prec == null) {
                clear();
            } else {
                prec.setNext(null);
            }
            return last.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public E get(int index) {
        if (getFirstNode() != null) {
            Nodo<E> nod = getFirstNode();
            int n=0;
            while (nod!=null && n!=index ) {
                nod = nod.getNext();
                n++;
            }
            if(nod==null)
                throw new IndexOutOfBoundsException("Indice non valido: " + index);
            else
                return nod.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }

    public E remove(int index) {
        if (getFirstNode() != null) {
            Nodo<E> prec = null;
            Nodo<E> nod = getFirstNode();
            int n=0;
            while (nod!= null && n!=index ) {
                prec = nod;
                nod = nod.getNext();
                n++;
            }
            if(nod==null)
                throw new IndexOutOfBoundsException("Indice non valido: " + index);
            if (prec == null) {
                setFirst(nod.getNext());
            } else {
                prec.setNext(nod.getNext());
            }
            return nod.getDati();
        } else {
            throw new IllegalStateException("Lista vuota");
        }
    }
}