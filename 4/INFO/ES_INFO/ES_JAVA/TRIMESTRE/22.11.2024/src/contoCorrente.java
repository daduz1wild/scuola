/*
Esercizio in preparazione alla verifica:
1) realizzare una classe ContoCorrente che permette la gestione di un conto corrente bancario. Attributi da definire che permettono di identificare un cc. Metodi che permettono di impostare un conto corrente alla sua apertura, realizzare prelievo e versamento su di esso (con controlli), conoscere il saldo.
2) realizzare il programma presente allo sportello che prevede, dopo la creazione di un conto corrente, di effettuare più operazioni di versamento e di prelievo (con feedback) a scelta dell'utente
3) disegnare lo schema delle classi (UML) e documentazione della classe CC



+ classe ContoCorrente

 - numeroConto: String
 - titolare: String
 - saldo: double

 + ContoCorrente(String, String, double)
 + versa(double): boolean
 + preleva(double): boolean
 + getSaldo(): double
 + getDati(): String

 */
/*
documentazione classe contocorrente
Classe che rappresenta un conto corrente bancario.
Permette operazioni di versamento, prelievo e consultazione del saldo.

public contoCorrente(String nom,String cogn,double saldo,String iban)
    crea un conto corrente con i dati inseriti in input

public boolean prel(double val)
se valore di prelievo corretto, calcola il nuovo saldo altrimenti riuscito=false

public boolean vers(double val)
se valore di versamento corretto, calcola il nuovo saldo altrimenti riuscito=false

public double getSaldo()
restituisce il valore del saldo di un conto
 */
public class contoCorrente {
    private String nom;
    private String cogn;
    private double saldo;
    private String iban;
    public contoCorrente(String nom,String cogn,double saldo,String iban){
        if(nom!=null && cogn!=null) {
            this.nom = nom;
            this.cogn = cogn;
        }else {
            this.nom = "";
            this.cogn = "";
        }
        if(saldo>=0)
            this.saldo=saldo;
        else
            this.saldo=0;
        if(iban!=null)
            this.iban=iban;
        else
            this.iban="";
    }
    public contoCorrente(){
        this.nom="";
        this.cogn="";
        this.saldo=0;
        this.iban="";
    }
    public contoCorrente(contoCorrente conto){
        this.nom=conto.nom;
        this.cogn=conto.cogn;
        this.saldo=conto.saldo;
        this.iban=conto.iban;
    }
    public String getNom(){
        return nom;
    }
    public String getCogn(){
        return cogn;
    }
    public String getIban(){
        return iban;
    }
    public boolean prel(double val){
        boolean riuscito=true;
        if(val>0)
            this.saldo-=val;
        else
            riuscito=false;
        return riuscito;
    }
    public boolean vers(double val){
        boolean riuscito=true;
        if(val>0)
            this.saldo+=val;
        else
            riuscito=false;
        return riuscito;
    }
    public double getSaldo(){
        return saldo;
    }

}
