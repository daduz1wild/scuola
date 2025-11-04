public class Ticket {
    private int num;
    public Ticket(){
        setNum(1);
    }
    public Ticket(int num){
        setNum(num);
    }
    public boolean setNum(int num) {
        boolean cor = false;
        if (num > 0) {
            this.num = num;
            cor = true;
        }
        return cor;
    }
    public int getNum(){
        return num;
    }
}
