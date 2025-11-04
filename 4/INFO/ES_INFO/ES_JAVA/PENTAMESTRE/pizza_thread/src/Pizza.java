public class Pizza {
    private double tCott;
    private boolean stato;
    public Pizza(double tCott,boolean stato){
        setTCott(tCott);
        setStato(stato);
    }

    public void setStato(boolean stato) {
        this.stato = stato;
    }

    public void setTCott(double tCott) {
        this.tCott = tCott;
    }

    public double gettCott() {
        return tCott;
    }

    public boolean getStato() {
        return stato;
    }
}
