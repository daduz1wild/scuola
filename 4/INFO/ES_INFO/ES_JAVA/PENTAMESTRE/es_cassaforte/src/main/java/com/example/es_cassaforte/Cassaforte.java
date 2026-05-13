/*
Creare un applicativo JavaFX in gradi di gestire le operazioni di deposito e prelievo in una cassaforte.
La cassaforte è caratterizzata da un saldo e da una capienza massima e presenta i metodi per effettuare un prelievo o un versamento.
Sarà presente la classe Operazione le cui istanze, in base ad un parametro booleano fornito come parametro nel costruttore, rappresenteranno
un prelievo (false) o un versamento (true).
Versione 1
Sarà presente un border pane dove a sinistra e a destra ci saranno due bottoni per generare i processi che potranno essere di due tipi:
prelievo o versamento. Al centro ci sarà un pane, che rappresenta la cassaforte, contenente una label che mostrerà il saldo. In alto ci
sarà il titolo dell’applicativo e in basso una label che mostrerà lo stato dell’operazione: es (Deposito: 5€ -> Operazione effettuata,
Prelievo: 2€ -> Operazione effettuata, Prelievo: 1000€ -> Operazione fallita). Al click dei due bottoni verra creato e avviato un nuovo
processo che si preoccuperà di eseguire l’operazione scelta aggiornando di conseguenza il saldo della cassaforte e i relativi elementi
 grafici (label del saldo e label dello stato dell’operazione).
 */

package com.example.es_cassaforte;
public class Cassaforte{
    private double saldo;
    private double saldoMax;
    public Cassaforte(){
        setSaldo(0);
        setSaldoMax(100000);
    }
    public Cassaforte(double saldo,double saldoMax){
        setSaldo(saldo);
        setSaldoMax(saldoMax);
    }
    public void setSaldo(double saldo){
        if(saldo>=0)
            this.saldo=saldo;
        else
            throw new IllegalArgumentException("valore non accettabile");
    }
    private void setSaldoMax(double saldoMax){
        if(saldoMax>=0)
            this.saldoMax=saldoMax;
        else
            throw new IllegalArgumentException("valore non accettabile");
    }

    public double getSaldo() {
        return saldo;
    }

    public double getSaldoMax() {
        return saldoMax;
    }

    public boolean preleva(double daPre){
        boolean suc=true;
        if(daPre>0 && daPre<=saldo) {
            saldo-= daPre;
        }else
            suc=false;
        return suc;
    }
    public boolean deposita(double daDep){
        boolean suc=true;
        if(daDep>0 && daDep<100000) {
            saldo += daDep;
        }else
            suc=false;
        return suc;
    }
}