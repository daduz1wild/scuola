import java.util.Scanner;
/*
Crea un programma organizzato a menu che permette di calcolare le aree di figure geometriche: triangolo,
 rettangolo, rombo, trapezio, cerchio, poligono regolare.

Vincolo: utilizzare una funzione per ciascuna funzionalità.
*/

public class Main {
    public static void main(String[] args) {

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

    public static String leggiStr(String msg) {
        Scanner input = new Scanner(System.in);
        System.out.println(msg);
        String s;
        do{
            s=input.nextLine();
            if(s.isEmpty())
                System.out.println("errore,reinserire");
        }while(s.isEmpty());
        return s;
    }

    public static double leggiDouble(String msg,double vmin,double vmax) {
        Scanner input = new Scanner(System.in);
        System.out.println(msg);
        double n;
        do{
            n=input.nextDouble();
            if(n<vmin || n>vmax)
                System.out.println("errore,reinserire");
        }while(n<vmin || n>vmax);
        return n;
    }
    public static char leggiChar(String msg) {
        Scanner input = new Scanner(System.in);
        System.out.println(msg);
        char c;
        do{
            c=input.next().charAt(0);
            if(c)
                System.out.println("errore,reinserire");
        }while(s.isEmpty());
        return s;
    }
}