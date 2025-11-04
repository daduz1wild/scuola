public class Foglio {
    private String contenuto;

    public Foglio(String contenuto){
        setContenuto(contenuto);
    }

    public void setContenuto(String contenuto) {
        this.contenuto = contenuto;
    }

    public String getContenuto() {
        return contenuto;
    }
    public void addContenuto(String contenutoAdd){
        contenuto+=Thread.currentThread().getNome() + "-" + contenutoAdd+"\n";
    }
}
