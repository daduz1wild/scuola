/*
Si deve gestire una lampadina e le operazioni che su di essa si possono realizzare. Ogni lampadina è
caratterizzata da una marca, dal numero di minuti massimi previsti di accensione, dal numero di minuti
effettivi di accensione, dal colore rgb che può assumere quando si accende e può realizzare alcune
operazioni quali: accendersi, spegnersi, cambiare colore e bruciarsi (quando il numero di ore effettive
supera il numero di ore massime previste). Inoltre, può avere un nome per poter essere accesa tramite
comandi verbali (vedi Alexa). La classe che gestisce questo nuovo TDA (Tipo di Dato Astratto) deve
prevedere i seguenti metodi:
a) costruttori (default, con parametri e di copia)
b) getter e setter x colore e x nome
c) switchOn che accende la lampadina per un certo numero di minuti
d) switchOff che spegne la lampadina (dovrà essere memorizzato il numero di minuti in cui è stata
accesa per aggiornare il numero di minuti di effettivo funzionamento)
e) isOn che indica se la lampadina è accesa
f) isBurnOut che indica se la lampada è bruciata
g) toString che restituisce i dati della lampadina in formato stringa (nome- marca- stato- colore)
 */
public class Lamp {
    private String nome;
    private String marca;
    private int minMax;
    private int minEff;
    private String color;
    private boolean acceso;

    public Lamp() {
        init();
    }


    public Lamp(String nome, String marca, int minMax, int minEff, String color, boolean acceso) {
        setNome(nome);
        setMarca(marca);
        setMinMax(minMax);
        setMinEff(minEff);
        setColor(color);
        setAcceso(acceso);
    }

    public Lamp(Lamp a) {
        if (a != null) {
            setNome(a.getNome());
            setMarca(a.getMarca());
            setMinMax(a.getMinMax());
            setMinEff(a.getMinEff());
            setColor(a.getColor());
            setAcceso(a.getAcceso());
        } else
            init();
    }
    private void init(){
        setNome("Lampada");
        setMarca("");
        setMinMax(500);
        setMinEff(0);
        setColor("");
        setAcceso(false);
    }
    public String getNome() {
        return nome;
    }

    public boolean setNome(String nome) {
        if (nome != null && !nome.isBlank()) {
            this.nome = nome;
            return true;
        } else {
            this.nome = "Lampada";
            return false;
        }
    }

    public String getMarca() {
        return marca;
    }

    public void setMarca(String marca) {
        if (marca != null && !marca.isBlank()) {
            this.marca = marca;
        } else {
            this.marca = "Sconosciuta";
        }
    }

    public int getMinMax() {
        return minMax;
    }

    public void setMinMax(int minMax) {
        if (minMax > 0) {
            this.minMax = minMax;
        } else {
            this.minMax = 500;
        }
    }

    public int getMinEff() {
        return minEff;
    }

    public void setMinEff(int minEff) {
        if (minEff >= 0) {
            this.minEff = minEff;
        } else {
            this.minEff = 0;
        }
    }

    public String getColor() {
        return color;
    }

    public void setColor(String color) {
        if (color != null && !color.isBlank()) {
            this.color = color;
        } else {
            this.color = "bianco";
        }
    }

    public boolean getAcceso() {
        return acceso;
    }

    public void setAcceso(boolean acceso) {
        this.acceso = acceso;
    }

    public void switchOn(int min) {
        if (min > 0 && !isBurnOut()) {
            acceso = true;
            minEff += min;
        }
    }

    public void switchOff() {
        acceso = false;
    }

    public boolean isOn() {
        return acceso;
    }

    public boolean isBurnOut() {
        return minEff >= minMax;
    }

    @Override
    public String toString() {

        String s="Nome: " + nome +", Marca: " + marca +", Stato: " +  stampaStato() +", Colore: " + color;
        return s;
    }
    public String stampaStato(){
        if(isOn())
            return "accesa";
        else
            return "spenta";
    }
}