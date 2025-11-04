/*
Realizzare la classe PILA (finita o infinita) su tipo Generico T (con lancio di eccezioni per le situazioni di errore e SENZA I/O interni) cghe abia i seguenti metodi pubblici:
a) costruttori
b) push
c) pop
d) size
e) isEmpty e isFull
Realizzare il main che permetta di risolvere la seguente espressione (con numeri ad 1 sola cifra) matematica in notazione postfissa 56+7-4*
 */

import java.util.LinkedList;

public class Pila<T> {
    private LinkedList<T> pila;
    private int nmax;
    class Pila(){
        this.pila=new LinkedList<>();
        setNmax(30);
    }
    class Pila(int nmax){
        
    }
}
