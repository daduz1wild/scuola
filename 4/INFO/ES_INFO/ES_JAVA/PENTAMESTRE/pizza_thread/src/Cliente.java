public class Cliente implements Runnable{
    Pizza p;
    public Cliente(Pizza p){
        setP(p);
    }

    public void setP(Pizza p) {
        this.p = p;
    }

    public Pizza getP() {
        return p;
    }
    public void run(){
        String nomeT=Thread.currentThread().getName();

        }
    }
}
