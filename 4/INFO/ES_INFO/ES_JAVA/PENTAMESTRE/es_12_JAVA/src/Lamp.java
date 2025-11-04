/*
Scrivi il codice della classe Lampadina RGB. Una lampadina possiede un nome, si trova in uno
stato (on/off), possiede un livello di luminosità (da 1 a 5) e una componente RGB.
I metodi che si chiede di realizzare sono:
§ costruttore che riceve come parametro il nome della lampadina e crea una lampadina
spenta, con luminosità 1 e coi i seguenti valori RGB (255, 255, 255);
§ accendi: accende una lampadina spenta. Imposta come valori RGB (252, 255, 202);
§ spegni: spenge una lampadina accesa;
§ SetLum: imposta la luminosità della lampadina con il valore passato come parametro
§ setRGB: ha come parametri 3 valori RGB con cui verrà impostata la componente RGB della
lampadina
§ toCSV
§ FromCSV
Creare un main di prove per testare la classe Lampadina creata

        JAVAFX
Realizzare un progetto JAVAFX in grado di gestire un oggetto lampadina.
*/

public class Lamp {
    private String nome;
    private boolean stato;
    private int lum;
    private int r,g,b;
    public Lamp(String nome){
        setNome(nome);
        setStato(false);
        setLum(1);
        setRGB(255,255,255);
    }
    public void accLamp(){
        if(stato)
            throw new IllegalStateException("la lampadina è già accesa");
        else {
            stato = true;
            setRGB(252,255,202);
        }
    }
    public void spegnLamp(){
        if(!stato)
            throw new IllegalStateException("la lampadina è già spenta");
        else
            stato = false;
    }
    public void setLum(int lum){
        if(lum>=1 && lum<=5)
            this.lum=lum;
        else
            throw new IllegalStateException("valore lum errato");
    }
    public void setRGB(int r,int g,int b){
        if((r>=0 && r<=255) && (g>=0 && g<=255) && (b>=0 && b<=255)){
            this.r=r;
            this.g=g;
            this.b=b;
        }else
            throw new IllegalStateException("almeno uno dei valori rgb è errato");
    }
    public void setStato(boolean stato){
        this.stato=stato;
    }
    public void setNome(String nome){
        if(!nome.isEmpty())
            this.nome=nome;
        else
            throw new IllegalStateException("valore non permesso");
    }

}
