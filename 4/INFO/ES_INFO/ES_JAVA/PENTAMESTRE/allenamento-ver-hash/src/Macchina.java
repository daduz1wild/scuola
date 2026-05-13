import java.io.IOException;
import java.io.RandomAccessFile;

/// Classe che gestisce una singola macchina
public class Macchina implements IOFileRandom,Copyable<Macchina>, Comparable<Macchina> {
    /// Lunghezza in byte singola Stringa
    public static final int LENSTR = 20;

    /// Lunghezza in byte dell'intero record
    public static final int LENREC = 82;
    // 20 + 20 + 20 + 2 + 8 + 8 + 4 = 51
    private String targa, marca, modello;
    private char alim;
    private double cil, prezzo;
    private int yy;

    /// Ritorna l'anno
    ///
    /// @return Anno
    public int getYy() {
        return this.yy;
    }

    /// Imposta l'anno a yy
    ///
    /// @param yy Anno
    /// @throws IllegalArgumentException Se l'anno non e' valido
    public void setYy(int yy) {
        if (yy >= 1900)
            this.yy = yy;
        else
            throw new IllegalArgumentException("Anno non valido");
    }

    /// Ritorna il prezzo
    ///
    /// @return Prezzo
    public double getPrezzo() {
        return this.prezzo;
    }

    /// Imposta il prezzo a prezzo
    ///
    /// @param prezzo Prezzo
    /// @throws IllegalArgumentException Se il prezzo non e' valido
    public void setPrezzo(double prezzo) {
        if (prezzo > 0)
            this.prezzo = prezzo;
        else
            throw new IllegalArgumentException("Prezzo non valido");
    }

    /// Ritorna la cilindrata
    ///
    /// @return Cilindrata
    public double getCil() {
        return this.cil;
    }

    /// Imposta la cilindrata a cil
    ///
    /// @param cil Cilindrata
    /// @throws IllegalArgumentException Se la cilindrata non e' valida
    public void setCil(double cil) {
        if (cil > 0)
            this.cil = cil;
        else
            throw new IllegalArgumentException("Cilindrata non valida");
    }

    /// Ritorna l'alimentazione
    ///
    /// @return Alimentazione
    public char getAlim() {
        return this.alim;
    }

    /// Imposta l'alimentazione ad alim
    ///
    /// @param alim Alimentazione
    /// @throws IllegalArgumentException Se l'alimentazione non e' valida
    public void setAlim(char alim) {
        this.alim = alim;
    }

    /// Ritorna il modello
    ///
    /// @return Modello
    public String getModello() {
        return this.modello;
    }

    /// Imposta il modello a modello
    ///
    /// @param modello Modello
    /// @throws IllegalArgumentException Se il modello non e' valido
    public void setModello(String modello) {
        if (!modello.isEmpty())
            this.modello = modello;
        else
            throw new IllegalArgumentException("Modello non valido");
    }

    /// Ritorna la marca
    ///
    /// @return Marca
    public String getMarca() {
        return this.marca;
    }

    /// Imposta la marca a marca
    ///
    /// @param marca Marca
    /// @throws IllegalArgumentException Se la marca non e' valida
    public void setMarca(String marca) {
        if (!marca.isEmpty())
            this.marca = marca;
        else
            throw new IllegalArgumentException("Marca non valida");
    }

    /// Ritorna la targa
    ///
    /// @return Targa
    /// @throws IllegalArgumentException Se la targa non e' valida
    public String getTarga() {
        return this.targa;
    }

    /// Imposta la targa a targa
    ///
    /// @param targa Targa
    /// @throws IllegalArgumentException Se la targa non e' valida
    public void setTarga(String targa) {
        if (!targa.isEmpty())
            this.targa = targa;
        else
            throw new IllegalArgumentException("Targa non valida");
    }


    /// Costruttore default
    public Macchina() {
        setAlim('B');
        setCil(100);
        setMarca("Ford");
        setModello("Fiesta");
        setPrezzo(10000);
        setTarga("AA111AA");
        setYy(2014);
    }

    /// Costruttore con parametri
    ///
    /// @param alim    Alimentazione
    /// @param cil     Cilindrata
    /// @param marca   Marca
    /// @param modello Modello
    /// @param prezzo  Prezzo
    /// @param targa   Targa
    /// @param yy      Anno
    /// @throws IllegalArgumentException Se almeno uno dei parametri non e' valido
    public Macchina(char alim, double cil, String marca, String modello,
                    double prezzo, String targa, int yy) throws IllegalArgumentException {
        setAlim(alim);
        setCil(cil);
        setMarca(marca);
        setModello(modello);
        setPrezzo(prezzo);
        setTarga(targa);
        setYy(yy);
    }
    @Override
    public String toString()
    {
        String s = getTarga() + " ";
        s = s.concat(getAlim() + " ");
        s = s.concat(getCil() + " ");
        s = s.concat(getMarca() + " ");
        s = s.concat(getModello() + " ");
        s = s.concat(getPrezzo() + " ");
        s = s.concat(Integer.toString(getYy()));
        return s;
    }
    public void write(RandomAccessFile raf)throws IOException{
        Input.writeString(raf, getTarga(), LENSTR);
        raf.writeChar(getAlim());
        raf.writeDouble(getCil());
        Input.writeString(raf, getMarca(), LENSTR);
        Input.writeString(raf, getModello(), LENSTR);
        raf.writeDouble(getPrezzo());
        raf.writeInt(getYy());
    }
    public void read(RandomAccessFile raf)throws IOException{
        setTarga(Input.readString(raf, LENSTR));
        setAlim(raf.readChar());
        setCil(raf.readDouble());
        setMarca(Input.readString(raf, LENSTR));
        setModello(Input.readString(raf, LENSTR));
        setPrezzo(raf.readDouble());
        setYy(raf.readInt());
    }
    public Macchina copy()
    {
        return new Macchina(getAlim(), getCil(), getMarca(), getModello(), getPrezzo(), getTarga(), getYy());
    }
    @Override
    public int compareTo(Macchina o) {
        return getTarga().compareTo(o.getTarga());
    }

}
