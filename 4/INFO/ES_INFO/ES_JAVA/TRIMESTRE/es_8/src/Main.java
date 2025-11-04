
/*
Creare una classe che vada a gestire un set di numeri interi appartenenti ad un range prefissato.

Ogni gestore di numeri interi istanziato conoscerà il valore minimo, il valore massimo (in riferimento al range da gestire) e se deve accettare numeri pari o numeri dispari.

La classe dovrà presentare i seguenti metodi:
Costruttori:
Default: istanzia un oggetto che accetta numeri pari compresi tra 0 e 200
Con parametri
Di copia
Getters e Setters
Un metodo per aggiungere un numero al set
Un metodo che restituisce una stringa csv di tutti i numeri del set
Un metodo che restituisce la media dei numeri del set
Un metodo che restituisce, in base ad un valore passato come parametro, il numero massimo o il numero minimo, tra i numeri del set

Crea un programma di prova che verifichi il funzionamento della classe.
 */

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        int m, num, val;
        int vmin, vmax;
        boolean pari, max;
        String tipo, numUni;
        double media;
        vmin = leggiInt("inserisci valore minimo", Integer.MIN_VALUE, Integer.MAX_VALUE);
        vmax = leggiInt("inserisci valore massimo", vmin, Integer.MAX_VALUE);
        do {
            tipo = leggiStr("pari o dispari?");
        } while (!tipo.equals("pari") && !tipo.equals("dispari"));
        if (tipo.equals("pari"))
            pari = true;
        else
            pari = false;
        Numeri set = new Numeri(vmin, vmax, pari);
        do {
            m = leggiInt("Inserisci:\n1.per inseire un nuovo numero\n2.per visulizzare tutti i numeri del set\n3.per visualizzare la media di tutti i numeri del set\n4.per conoscere il valore max o min del set\n5.termina\n", 1, 5);
            switch (m) {
                case 1:
                    do {
                        num = leggiInt("inserisci numero", vmin, vmax);
                    } while ((pari && num % 2 != 0) || (!pari && num % 2 == 0));
                    set.aggiungiNum(num);
                    break;
                case 2:
                    numUni = set.uniNum();
                    System.out.println(numUni);
                    break;
                case 3:
                    media = set.mediaN();
                    System.out.println(media);
                    break;
                case 4:
                    do {
                        tipo = leggiStr("valore minimo o massimo?");
                    } while (!tipo.equals("minimo") && !tipo.equals("massimo"));
                    if (tipo.equals("massimo")) {
                        max = true;
                    } else {
                        max = false;
                    }
                    try {
                        val = set.maxOMin(max);
                        if (max)
                            System.out.println("il numero max del set è " + val);
                        else
                            System.out.println("il numero min del set è " + val);
                    } catch (IllegalStateException e) {
                        System.out.println(e.getMessage());
                    }
            }
        } while (m != 5);
    }
}