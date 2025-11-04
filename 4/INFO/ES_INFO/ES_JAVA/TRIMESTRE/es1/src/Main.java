
/*
ES 1
Sul prezzo di un prodotto viene praticato uno sconto del 20% se costa meno di 500€ e del 25% per prezzi superiori a 500€. Calcolare il prezzo da pagare.
*/


import java.util.Scanner;

public class Main {
    public static void main(String[] args){
        Scanner input = new Scanner(System.in);
        double prezzo,prezzoFin;
        do {
            System.out.println("inserire il prezzo");
            prezzo = input.nextDouble();
        }while(prezzo<=0);
        if(prezzo > 500) {
            prezzoFin = prezzo - prezzo * 0.25;
        }else {
            prezzoFin = prezzo - prezzo * 0.2;
        }
        System.out.println(prezzoFin+"€");
    }
}