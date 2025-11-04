public class Printer implements Runnable{
    private Foglio f;

    public Printer(Foglio f) {
        setF(f);
    }

    public Foglio getF() {
        return f;
    }

    public void setF(Foglio f) {
        this.f = f;
    }

    @Override
    public void run() {
        String nomeT=Thread.currentThread().getName();
        synchronized (f) {
            for (int i = 0; i < 3; i++) {
                f.addContenuto(nomeT + " - " + i + "\n");
            }
        }
    }
}
