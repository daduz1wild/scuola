import java.io.IOException;
import java.io.RandomAccessFile;
import java.util.InputMismatchException;
import java.util.Scanner;

public class Input {
    public static int lgInt(int vmin, int vmax, String mex){
        Scanner in = new Scanner(System.in);
        int x = 0;
        boolean val = false;
        while(!val){
            try {
                System.out.print(mex);
                x = in.nextInt();
                while (x < vmin || x > vmax) {
                    System.out.println("Errore");
                    System.out.print(mex);
                    x = in.nextInt();
                }
                val = true;
            } catch (InputMismatchException exc) {
                System.out.println(exc.getMessage());
                in.nextLine();
            }
        }
        return x;
    }
    public static double lgDbl(double vmin, double vmax, String mex){
        Scanner in = new Scanner(System.in);
        double x = 0;
        boolean val = false;
        while(!val){
            try {
                System.out.print(mex);
                x = in.nextDouble();
                while (x < vmin || x > vmax) {
                    System.out.println("Errore");
                    System.out.print(mex);
                    x = in.nextDouble();
                }
                val = true;
            } catch (InputMismatchException exc) {
                System.out.println(exc.getMessage());
                in.nextLine();
            }
        }
        return x;
    }
    public static char lgChar(String mex){
        Scanner in = new Scanner(System.in);
        char c;
        System.out.print(mex);
        c = in.next().charAt(0);
        while(c == '\0'){
            System.out.println("errore");
            System.out.print(mex);
            c = in.next().charAt(0);
        }
        return c;
    }
    public static String lgStr(String mex){
        Scanner in = new Scanner(System.in);
        String s;
        System.out.print(mex);
        s = in.next();
        while(s.isEmpty()){
            System.out.println("Errore");
            System.out.print(mex);
            s = in.next();
        }
        return s;
    }
    public static void writeString(RandomAccessFile raf,String s,int len)throws IOException{
        StringBuilder buf=new StringBuilder(s);
        buf.setLength(len);
        raf.writeChars(buf.toString());
    }
    public static String readString(RandomAccessFile raf,int len)throws IOException{
        char[] s=new char[len];
        for(int i=0;i<len;i++){
            s[i]=raf.readChar();
        }
        String str=new String(s);
        return str.trim();
    }
}
