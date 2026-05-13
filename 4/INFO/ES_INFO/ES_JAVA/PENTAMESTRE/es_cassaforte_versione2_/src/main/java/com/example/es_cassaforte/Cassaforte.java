/*
Si dovrà implementare una classe GestoreOperazioni che conterrà una lista di Operazioni da eseguire sulla cassaforte.
La precendente versione realizzata dovrà essere modificata secondo la seguente modalità:
Cliccando i due bottoni relativi al prelievo e al versamento verranno istanziati i threads ma non avviati. I threads creati verranno
aggiunti alla lista di operazioni da eseguire.
Si dovrà inserire un bottono di “AVVIO OPERAZIONI” cliccato il quale avvierà tutti i threads della lista che andranno a modificare di
conseguenza il saldo e lo stato della cassaforte.
NB: La cassaforte puo' garantire l'accesso ad un solo utente per volta e permette l'operazione solo se vi sono le condizioni necessarie
(la cassaforte ha una capienza massima).
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