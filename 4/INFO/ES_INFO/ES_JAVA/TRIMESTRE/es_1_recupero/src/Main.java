/*
Si deve gestire una frazione e le operazioni che su di essa si possono realizzare.
La classe che gestisce questo nuovo TDA (Tipo di Dato Astratto) deve prevederei seguenti metodi:
a) costruttori (default, con parametri e di copia)
b) getter e setter
c) somma algebrica (add) della frazione con un numero o con un'altra frazione
d) moltiplicazione (mult) della frazione con un'altra frazione o con un numero
e) divisione (div) della frazione con un'altra frazione o con un numero
*/

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        int m,n,d;
        Frazione fraz1=new Frazione(15,14);
        Frazione fraz2=new Frazione(-2,7);
        Frazione fraz3=new Frazione(3,2);
        fraz1.add(fraz2);
        fraz1.add(fraz3);
        System.out.println(""+fraz1.getN()+"/"+fraz1.getD());
    }
    public static int leggiInt(String msg, int vmin, int vmax) {
        Scanner input = new Scanner(System.in);
        int n;
        System.out.println(msg);
        do {
            n = input.nextInt();
            if (n < vmin || n > vmax)
                System.out.println("errore,reinserire");
        } while (n < vmin || n > vmax);
        return n;
    }
}