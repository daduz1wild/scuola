package com.example.es_cassaforte;

public class Operazione extends Thread{
    private boolean prelievo;
    private double importo;
    private HelloController controller;
    private Cassaforte c;
    public Operazione(Cassaforte c,boolean prelievo,double importo,HelloController controller){
        setC(c);
        setPrelievo(prelievo);
        setImporto(importo);
        setController(controller);
    }

    public boolean isPrelievo() {
        return prelievo;
    }

    public void setPrelievo(boolean prelievo) {
        this.prelievo = prelievo;
    }

    public double getImporto() {
        return importo;
    }

    public void setImporto(double importo) {
        if(importo>0)
            this.importo = importo;
        else
            throw new IllegalArgumentException("valore non accettabile");
    }

    public HelloController getController() {
        return controller;
    }

    public void setController(HelloController controller) {
        this.controller = controller;
    }

    public Cassaforte getC() {
        return c;
    }

    public void setC(Cassaforte c) {
        this.c = c;
    }
    @Override
    public void run() {
        synchronized (c) {
            boolean suc;
            if (isPrelievo())
                suc = c.preleva(importo);
            else
                suc = c.deposita(importo);
            controller.aggiornaDati(this, suc);
            try {
                Thread.sleep(2000);
            } catch (InterruptedException e) {
                throw new RuntimeException(e);
            }
        }
    }

}