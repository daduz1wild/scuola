import java.util.StringTokenizer;

public class PacchettoAzionario implements FileCSV, Copyable<PacchettoAzionario> {
    private String nome;
    private double valore;
    private String data;
    public PacchettoAzionario(){
        setNome("null");
        setValore(0);
        setData("null");
    }
    public PacchettoAzionario(String nome, double valore,String data) {
        setNome(nome);
        setValore(valore);
        setData(data);
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        if(nome!=null)
            if(!nome.isEmpty())
                this.nome = nome;
            else
                throw new IllegalArgumentException("errore");
    }

    public double getValore() {
        return valore;
    }

    public void setValore(double valore) {
        if(valore>0)
            this.valore = valore;
        else
            throw new IllegalArgumentException("valore errato");
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        if(data!=null)
            if(!data.isEmpty())
                this.data = data;
            else
                throw new IllegalArgumentException("stringa vuota");
        else
            throw new NullPointerException("el non esistente");
    }

    @Override
    public void fromCSV(String s) {
        if (s != null) {
            if (!s.isEmpty()) {
                StringTokenizer toks = new StringTokenizer(s, ";");
                if(toks.countTokens() >= 2) {
                    this.nome = toks.nextToken().trim();
                    this.valore = Double.parseDouble(toks.nextToken());
                }else
                    throw new IllegalArgumentException("non ci sono abbastanza token nella riga");
            } else
                throw new IllegalArgumentException("Stringa vuota");
        } else
            throw new NullPointerException("Puntatore a NULL non consentito");
    }

    @Override
    public String toCSV() {
        return nome + "," + valore+ ";";
    }
    @Override
    public PacchettoAzionario copy(){
        return new PacchettoAzionario(getNome(), getValore(), getData());
    }
}