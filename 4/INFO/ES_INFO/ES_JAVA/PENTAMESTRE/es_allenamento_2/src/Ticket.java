public class Ticket {
    int num;
    public Ticket(){
        setNum(1);
    }
    public Ticket(int num){
        setNum(num);
    }
    public Ticket(Ticket a){
        setNum(a.getNum());
    }
    public int setNum(int num) {
        if (num > 0)
            this.num=num;
        else
            this.num=1;
    }

}
