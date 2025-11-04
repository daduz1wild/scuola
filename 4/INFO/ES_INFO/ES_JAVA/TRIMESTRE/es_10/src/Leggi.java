import java.util.Scanner;

public class Leggi {
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
}
