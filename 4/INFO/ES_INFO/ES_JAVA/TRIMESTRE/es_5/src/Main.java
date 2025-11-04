import java.util.Scanner;
/*
Leggere una sequenza di numeri interi. Terminare la lettura quando
 si incontra un valore pari a 9999. Determinare quanti sono stati i valori pari e i valori dispari.
*/
public class Main {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        int n=0,nPari=0,nDisp=0;
        while(n!=9999){
            System.out.println("Inserisci numero");
            n=input.nextInt();
            if(n!=9999) {
                if (n % 2 == 0)
                    nPari = nPari + 1;
                else
                    nDisp = nDisp + 1;
            }
        }
        System.out.println("i numeri pari sono "+nPari);
        System.out.println("i numeri dispari sono "+nDisp);
    }
}