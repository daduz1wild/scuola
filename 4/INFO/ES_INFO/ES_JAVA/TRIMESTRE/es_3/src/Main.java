import java.util.Scanner;
/*
 Davide Benedetti 4BI

L'indice di massa corporea si calcola dividendo il proprio peso espresso in kg per il quadrato dell'altezza espressa in metri:
IMC = massa corporea / altezza2.

Secondo l'Organizzazione Mondiale della Sanità l'IMC, o indice di massa corporea, è raggruppabile in 4 categorie: sottopeso
(IMC al di sotto di 19), normale (IMC compreso tra 19 e 24), sovrappeso (IMC compreso tra 25 e 30), obesità (IMC al di sopra di 30).
*/
public class Main {
    public static void main(String[] args) {
        Scanner input= new Scanner(System.in);
        double imc,massa,h;
        do{
            System.out.println("inserire la massa corporea");
            massa=input.nextDouble();
        }while(massa<=0 || massa >500);
        do{
            System.out.println("inserire l'altezza");
            h=input.nextDouble();
        }while(h<=0.50 || h>3);
        imc=massa/(h*h);
        if(imc<19)
            System.out.println("sottopeso");
            else
                if(imc<=24)
                    System.out.println("normale");
                    else
                        if(imc<=30)
                            System.out.println("sovrappeso");
                        else
                            System.out.println("obeso");
    }
}