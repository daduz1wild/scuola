import java.io.IOException;
import java.io.RandomAccessFile;

public class Prodotto implements IOFileRandom{
    public static int LENSTR = 20;
    private int cod;
    private String nome;
    private double prz;

    public Prodotto() {
        setCod(1);
        setNome("acqua");
        setPrz(1);
    }
    public Prodotto(int cod, String nome, double prz)throws IllegalArgumentException {
        setCod(cod);
        setNome(nome);
        setPrz(prz);
    }

    public int getCod() {
        return cod;
    }

    public void setCod(int cod) {
        if(cod>0)
            this.cod = cod;
        else
            throw new IllegalArgumentException("codice non valido");
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        if(nome!=null && !nome.isEmpty())
            this.nome = nome;
        else throw new IllegalArgumentException("nome non valido");
    }

    public double getPrz() {
        return prz;
    }

    public void setPrz(double prz) {
        if(prz>0 && prz<2000)
            this.prz = prz;
        else
            throw new IllegalArgumentException("prezzo non valido");
    }
    public void write(RandomAccessFile raf)
            throws IOException
    {
        raf.writeInt(cod);
        Input.writeString(raf, nome, LENSTR);
        raf.writeDouble(prz);
    }

    public void read(RandomAccessFile raf)
            throws IOException
    {
        cod = raf.readInt();
        nome = Input.readString(raf, LENSTR);
        prz = raf.readDouble();
    }
}
