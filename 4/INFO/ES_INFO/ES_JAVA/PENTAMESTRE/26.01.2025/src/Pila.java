/*
Creare la classe Pila su tipo generico vincolato (metodi: costruttori, size, pop, push,
importa ed esporta) e la classe PacchettoAzionario (metodi: costruttori, set/get) che
implementi interfaccia FileCsv.
 */
import java.io.*;
import java.util.LinkedList;

public class Pila<E extends FileCSV & Copyable<E>>{
    private final LinkedList<E> pila;
    private String nome;
    public Pila(){
        pila=new LinkedList<>();
        setNome("null");
    }
    public Pila(String nome){
        pila = new LinkedList<>();
        setNome(nome);
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        if(nome != null)
            if(!nome.isEmpty())
                this.nome = nome;
            else
                throw new IllegalArgumentException("Stringa vuota");
        else
            throw new NullPointerException("el non esistente");
    }
    public int size(){
        return this.pila.size();
    }
    public boolean isEmpty(){
        return this.pila.isEmpty();
    }
    public E pop(){
        if(!pila.isEmpty())
            return this.pila.removeLast();
        else
            throw new IllegalArgumentException("la pila è vuota");
    }
    public void push(E el){
        if(el!=null)
            pila.addLast(el);
        else
            throw new IllegalArgumentException("elemeno inesistente");
    }
    public void imp(E aus){
        try {
            BufferedReader fin = new BufferedReader(new FileReader("file.csv"));
            String s = fin.readLine();
            while (s != null) {
                E obj = aus.copy();
                obj.fromCSV(s);
                push(obj);
                s = fin.readLine();
            }
            fin.close();
        }catch(IOException e){
            System.out.println("errore file"+e.getMessage());
        }
    }
    public void esp(){
        if(pila.isEmpty()) {
            try {
                PrintWriter fin = new PrintWriter(new FileWriter("file.csv"), true);
                for (E el : pila)
                    fin.printf(el.toCSV());
                fin.close();
            } catch (IOException e) {
                System.out.println("errore file, dettagli:" + e.getMessage());
            }
        }else
            throw new IllegalArgumentException("lista vuota");
    }
}
