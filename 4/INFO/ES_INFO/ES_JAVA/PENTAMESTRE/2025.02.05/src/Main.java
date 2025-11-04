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
public class Main{
    public static void main(String[] args) {
        CodaPostale spedizioni = new CodaPostale("SPEDIZIONI");
        CodaPostale pagamenti = new CodaPostale("PAGAMENTI");
        spedizioni.push();
        spedizioni.push();
        pagamenti.push();
        spedizioni.pop();
        spedizioni.stampaCoda();
        pagamenti.stampaCoda();
    }
}