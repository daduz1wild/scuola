
/*Letta una temperatura, si vuole classificarla scrivendo in output un
messaggio secondo il seguente schema: */

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        int temp;
        do{
            System.out.println("inserire temperatura");
            temp=input.nextInt();
        }while(temp<-50);
        if(temp<=0)
            System.out.println("molto freddo");
        else
            if(temp<=10)
                System.out.println("freddo");
            else
                if(temp<=16)
                    System.out.println("fresco");
                else
                    if(temp<=25)
                        System.out.println("clima mite");
                    else
                        if(temp<=32)
                            System.out.println("caldo");
                        else
                            System.out.println("molto caldo");
    }
}