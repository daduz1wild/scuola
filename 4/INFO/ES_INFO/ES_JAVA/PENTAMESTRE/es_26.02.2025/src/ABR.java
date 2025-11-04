/*
Classe ABR su tipo generico T vincolato all'interfaccia Comparable e FileCsv: metodi costruttore, get e set del
dato, add, importa ed esporta di file csv (e classe Nodo con get/set, fromCsv e toCsv) ed un main di esempio.
 */

import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;

public class ABR<T extends FileCsv & Comparable> {
    private Nodo<T> radice;
    public void ABR(){
        setRadice(null);
    }
    public Nodo<T> getRadice() {
        return radice;
    }
    public void setRadice(Nodo<T> radice) {
        this.radice = radice;
    }
    public void add(Nodo<T> nodo){
        if(nodo==null){
            throw new NullPointerException("Il nodo non può essere nullo");
        }else{
            if(radice.compareTo(nodo)>0)
                radice.setLeft(nodo);
            else if(radice.compareTo(nodo)<0)
                radice.setRight(nodo);
        }
    }
    public void importa(String file){

    }
    public void esporta(String file){
        boolean open=true;
        if(file==null || file.isEmpty())
            throw new IllegalStateException("il nome del file è errato");
        else {
            try {
                PrintWriter fin = new PrintWriter(new FileWriter(file));
            } catch (IOException e) {
                open = false;
            }


        }
    }
}
