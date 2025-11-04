import java.util.Scanner;

/*
Davide Benedetti 4BI
Scrivi un algoritmo che legga una sequenza di voti (tra 1 e 10). Quando viene inserito 0, viene stampata
la media dei voti inseriti.
*/
public class Main {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        int n,tot=0;
        do{
            System.out.println("inserisci numero");
            do {
                n = input.nextInt();
            }while(n<0 || n>10);
            tot=tot+n;
        }while(n!=0);
        System.out.println(tot);
    }

}