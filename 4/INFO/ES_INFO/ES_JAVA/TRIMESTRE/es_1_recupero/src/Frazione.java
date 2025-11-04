public class Frazione {
    private int n;
    private int d;
    public Frazione(){
        setN(0);
        setD(1);
    }
    public Frazione(int n,int d){
        setN(n);
        setD(d);
    }
    public Frazione(Frazione a){
        setN(a.getN());
        setD(a.getD());
    }
    public int getN() {
        return n;
    }

    public int getD() {
        return d;
    }

    public void setN(int n) {
        this.n = n;
    }

    public void setD(int d) {
        if(d!=0)
            this.d = d;
        else
            this.d=1;
    }
    public void add(int n){
        int mcm= this.d;
        this.n = (this.n + (n * mcm));
        this.d=mcm;
        sempl();
    }
    public void sempl(){
        int mcd = mcd(this.n, this.d);
        this.n /=mcd;
        this.d /=mcd;
    }
    public void add(Frazione fraz2){
        int mcm = mcm(this.d,fraz2.getD());
        this.n = (this.n * (mcm / this.d)) + (fraz2.getN() * (mcm / fraz2.getD()));
        this.d=mcm;
        sempl();
    }
    public void sott(int n){
        int mcm = mcm(this.d,);
        this.n = (this.n * (mcm / this.d)) + (fraz2.getN() * (mcm / fraz2.getD()));
        this.d=mcm;
        sempl();
    }
    public void sott(Frazione fraz2){
        int mcm = mcm(this.d,fraz2.getD());
        this.n = (this.n * (mcm / this.d)) + (fraz2.getN() * (mcm / fraz2.getD()));
        this.d=mcm;
        sempl();
    }
    public void moltNumero(int n){
        this.n=this.n*n;
        this.d=this.d;
        sempl();
    }
    public void moltFrazione(Frazione fraz2){
        this.n=this.n*n;
        this.d=this.d*d;
        sempl();
    }
    public void DivNumero(Frazione fraz2){
        this.d=this.d*n;
        this.n=this.n;
        int mcd=mcd(newN,newD);
    }
    public void divFrazione(int n,int d,Frazione ris){
        int newD=this.d*n;
        int newN=this.n*d;
        int mcd=mcd(newN,newD);
        newN/=mcd;
        newD/=mcd;
        ris.setN(newN);
        ris.setD(newD);
    }
    public int mcd(int a,int b){
            if(b==0)
                return a;
            else
                return mcd(b, a%b);
    }
    public int mcm(int n1,int n2){
        return Math.abs(n1*n2)/mcd(n1,n2);
    }
}
