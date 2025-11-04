import java.util.Scanner;

/*
Esercizio in preparazione alla verifica:
1) realizzare una classe ContoCorrente che permette la gestione di un conto corrente bancario. Attributi da definire che permettono di identificare un cc. Metodi che permettono di impostare un conto corrente alla sua apertura, realizzare prelievo e versamento su di esso (con controlli), conoscere il saldo.
2) realizzare il programma presente allo sportello che prevede, dopo la creazione di un conto corrente, di effettuare più operazioni di versamento e di prelievo (con feedback) a scelta dell'utente
3) disegnare lo schema delle classi (UML) e documentazione della classe CC
 */
public class Main{
    public static void main(String[] args){
        String nom,cogn,iban;
        double saldo,val;
        int m;
        boolean corretto;
        nom=leggiStr("inserisci nome");
        cogn=leggiStr("inserisci cognome");
        saldo=leggiDouble("inserisci saldo",0,1000000);
        iban=leggiStr("inserisci Iban");
        contoCorrente conto=new contoCorrente(nom,cogn,saldo,iban);
        do{
            m=leggiInt("inserisci:\n1.versa denaro\n2.preleva denaro\n3.termina\n",1,3);
            switch(m){
                case 1:
                    val=leggiDouble("Inserisci somma da versare",0,10000);
                    corretto=conto.vers(val);
                    if(corretto)
                        System.out.println("versamento andato a buon fine, sul conto hai "+ conto.getSaldo());
                    else
                        System.out.println("somma da versare non valida");
                    break;
                case 2:
                    val=leggiDouble("Inserisci somma da prelevare",0,10000);
                    corretto=conto.prel(val);
                    if(corretto)
                        System.out.println("prelievo andato a buon fine, sul conto hai "+ conto.getSaldo());
                    else
                        System.out.println("somma da prelevare non valida");
                    break;
            }
        }while(m!=3);
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
}
