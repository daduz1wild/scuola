public class Main {
    public static void main(String[] args) {
        Foglio f= new Foglio();
        Printer p1=new Printer(f);
        Printer p2=new Printer(f);
        Thread tp1=new Thread(p1,"p1");
        Thread tp2 =new Thread(p2,"p2");
        tp1.start();
        tp2.start();
        try{
            tp1.join();
            tp2.join();
        }catch(InterruptedException e) {
                throw new RuntimeException(e);
        }
    }
}