/*
Creare una classe che vada a gestire un set di numeri interi appartenenti ad un range prefissato.
Ogni gestore di numeri interi istanziato conoscerà il valore minimo, il valore massimo (in riferimento al range da gestire) e se deve accettare numeri pari o numeri dispari.
La classe dovrà presentare i seguenti metodi:
Costruttori:
Default: istanzia un oggetto che accetta numeri pari compresi tra 0 e 200
Con parametri
Di copia
Getters e Setters
Un metodo per aggiungere un numero al set
Un metodo che restituisce una stringa csv di tutti i numeri del set
Un metodo che restituisce la media dei numeri del set

Un metodo che restituisce, in base ad un valore passato come parametro, il numero massimo o il numero minimo, tra i numeri del set
Crea un programma di prova che verifichi il funzionamento della classe.
 */
/*
UML

classe Numeri

+ classe ContoCorrente
attributi
- vmin: int
- vmax-int
- num- int[]
-pari- bool

costruttori
+Numeri()
+Numeri(int vmin,int vmax,boolean pari)
+Numeri(Numeri n)

metodi
+ getVmin():int
+ public getVmax():int
+ getPari(): boolean
+ setVmin: void
+setVmax:void
+setPari:void
+aggiungiNum(int):void
+uniNum():String
+mediaN():float
maxOMin(boolean):int

descr. metodi
int getVmin()
restituisce il valore di vmin di un oggetto

int getVmax()
restituisce il valore di vmax di un oggetto

boolean getPari()
restituice il valore dell'attributo pari di un oggetto

void setVmin()
serve per modificare il valore di vmin di un oggetto

void setVmax()
serve per modificare il valore di vmax di un oggetto

void setPari()
serve per modificare il valore di pari di un oggetto

void aggiungiNum(int num)
se(num%2==0 && pari || num%2!=0 && !pari) && se(num>=vmin && num<=vmax) aggiungi numero al set e n++

String uniNum()
se(n>0) inserisci tutti i numeri del set in un'unica stringa altrimenti scrivi "nessun numero presente"

float mediaN()
se(n==) ritorna 0 altrimenti calcola la media dei numeri del set

int maxOMin(boolean pari)
se(max) allora cerca il numero massimodel set e mettilo in val, altrimenti cerca il numero minimo del set e mettilo in val. Ritorna val.
 */
public class Numeri {
    private int vmin,vmax,n=0;
    private int[] num;
    private boolean pari;
    public Numeri(){
        this.vmin=0;
        this.vmax=200;
        this.pari=true;
        this.num=new int[20];
    }
    public Numeri(int vmin,int vmax,boolean pari){
        if(vmin>vmax) {
            this.vmin = 0;
            this.vmax = 200;
            this.pari = true;
        }else{
            this.vmin=vmin;
            this.vmax=vmax;
            this.pari=pari;
        }
        this.num=new int[20];
    }
    public Numeri(Numeri n){
        if (n!=null){
            this.vmin = n.vmin;
            this.vmax = n.vmax;
            this.pari = n.pari;
        }else {
            this.vmin = 0;
            this.vmax = 200;
            this.pari = true;
        }
        this.n=0;
        this.num=new int[20];
    }
    public int getVmin(){
        return vmin;
    }
    public int getVmax(){
        return vmax;
    }
    public boolean getPari(){
        return pari;
    }
    public void setVmin(int vmin){
        if(vmin<this.vmax)
            this.vmin=vmin;
        else
            this.vmin=0;
    }
    public void setVmax(int vmax){
        if(vmax>this.vmin)
            this.vmax=vmax;
        else
            this.vmax=0;
    }
    public void setPari(boolean pari){
        this.pari=pari;
    }
    public void aggiungiNum(int num){
        if(num%2==0 && pari || num%2!=0 && !pari)
            if(num>=vmin && num<=vmax){
                this.num[n]=num;
                n++;
            }
    }
    public String uniNum(){
        String numUni="";
        if(n!=0)
            for(int i=0;i<n;i++)
                numUni=numUni+num[i]+",";
        else
            numUni="nessun numero nel set";
        return numUni;
    }
    public float mediaN(){
        float media;
        int tot=0;
        if(n==0)
            return 0;
        for(int i=0;i<n;i++)
            tot=tot+num[i];
        media=tot/n;
        return media;
    }
    public int maxOMin(boolean max){
        int nMin=Integer.MAX_VALUE,nMax=Integer.MIN_VALUE,val;
        if(max) {
            for (int i = 0; i < n; i++) {
                if (this.num[i] > nMax)
                    nMax = this.num[i];
            }
            val=nMax;
        }else {
            for (int i = 0; i < n; i++) {
                if (this.num[i] < nMin)
                    nMin = this.num[i];
            }
            val=nMin;
        }
        return val;
    }
}
