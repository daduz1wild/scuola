/*
Realizzare un’applicazione in grado di gestire la vostra scheda SIM.
La SIM è caratterizzata da:
Nome intestatario
ICCID
Numero di telefono
Credito residuo
Minuti di chiamate effettuate sulla SIM
SIM attiva(boolean)
Realizzare i seguenti metodi:
Costruttori (ogni SIM creata deve essere disattiva)
Getters e Setters
Metodo toString
Metodo compareTo
Metodo che riceve un valore in euro ed effettua la ricarica della SIM.
Metodo che, dato un tempo in minuti, permetta di effettuare una chiamata. (La tariffa per le chiamate è pari a 0,32€/min – nel caso in cui il credito non sia sufficiente?)
Metodo DISATTIVA SIM con cui si potrà disattivare la SIM
Metodo che converte i minuti di chiamate nel formato: hh:mm

Realizzare un main di prova contenente il seguente menu:
Attiva SIM
Stampa dati SIM
Ricarica SIM (tagli ricarica: 5€, 10€, 20€)
Effettua telefonata
Visulizza hh:mm totale di chiamate
Disattiva SIM
 */

public class Sim implements Comparable <Sim>{
    private String nom;
    private String cogn;
    private String id;
    private String numCel;
    private String oper;
    private double cred;
    private int minTot;
    private boolean attiva;
    public Sim(){
        init();
    }
    private void init(){
        setNom("");
        setCogn("");
        setId("");
        setNumCel("");
        setOper("");
        setCred(0);
        setMinTot(0);
        setAttiva(true);
    }
    public Sim(String nom, String cogn){
        setNom(nom);
        setCogn(cogn);
        setId("hefuerhr");
        setNumCel("3789786789");
        setOper("wind");
        setCred(0);
        setMinTot(0);
        setAttiva(false);
    }
    public Sim(Sim a){
        if(a==null) {
            setNom(a.getNom());
            setCogn(a.getCogn());
            setId(a.getId());
            setNumCel(a.getNumCel());
            setOper(a.getOper());
            setCred(a.getCred());
            setMinTot(a.getMinTot());
            setAttiva(a.getAttiva());
        }else
            init();
    }



    public String getNom() {
        return nom;
    }

    public String getCogn() {
        return cogn;
    }

    public String getId() {
        return id;
    }

    public String getNumCel() {
        return numCel;
    }

    public String getOper() { return oper; }

    public double getCred() {
        return cred;
    }

    public int getMinTot() {
        return minTot;
    }

    public boolean getAttiva(){
        return attiva;
    }

    public void setNom(String nom) {
        if(!(nom.trim().isEmpty()))
            this.nom = nom;
        else
            this.nom="";
    }

    public void setCogn(String cogn) {
        if(!(cogn.trim().isEmpty()))
            this.cogn = cogn;
        else
            this.cogn="";
    }

    public void setId(String id) {
        if(!(id.trim().isEmpty()))
            this.id = id;
        else
            this.id="";
    }

    public void setNumCel(String numCel) {
        if(!(numCel.trim().isEmpty()))
            this.numCel = numCel;
        else
            this.numCel="";
    }

    public void setOper(String oper) {
        if(!(oper.trim().isEmpty()))
            this.oper = oper;
        else
            this.oper="";
    }

    public void setCred(double cred) {
        if(cred>=0)
            this.cred = cred;
        else
            this.cred=0;
    }

    public void setMinTot(int minTot) {
        if(minTot>=0)
            this.minTot = minTot;
        else
            this.minTot=0;
    }

    public void setAttiva(boolean attiva) {
        this.attiva = attiva;
    }

    @Override
    public String toString() {
        String conc = "";
        conc = this.nom + "," + this.cogn + "," + this.id + "," + this.numCel + "," + this.cred + "," + this.minTot + "," + this.attiva;
        return conc;
    }
    @Override
    public int compareTo(Sim altraSim) {
        if (this.cred < altraSim.getCred()) {
            return -1;
        } else if (this.cred > altraSim.getCred()) {
            return 1;
        } else {
            return 0;
        }
    }

    public void ricarica(double val){
        if(val>0)
            this.cred+=val;
    }
    public boolean chiamata(int minuti){
        boolean canCall=true;
        double costo;
        if(minuti>0) {
            costo=0.32*minuti;
            if(costo>this.cred)
                canCall=false;
            else
                minTot+=minuti;
        }
        return canCall;
    }
    public String convMin(){
        int hours,min;
        String ore;
        hours=this.minTot/60;
        min=this.minTot%60;
        ore = ""+hours+":"+min;
        return ore;
    }
}
