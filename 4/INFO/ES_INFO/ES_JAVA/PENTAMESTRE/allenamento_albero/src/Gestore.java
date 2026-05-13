import java.io.*;
import java.util.NoSuchElementException;

public class Gestore {
    private ABR abr;
    private RandomAccessFile raf;
    public Gestore()throws IOException{
        try {
            raf = new RandomAccessFile("prod.dat", "rw");
            ObjectInputStream ois=new ObjectInputStream(new FileInputStream("abr.dat"));
            abr=(ABR) ois.readObject();
        }catch(FileNotFoundException  | ClassNotFoundException e){
            if(raf.length()>0)
                loadABR();
            else
                abr=new ABR();
        }
    }
    private void loadABR()throws IOException{
        abr=new ABR();
        Prodotto p=new Prodotto();
        raf.seek(0);
        while(raf.getFilePointer()<raf.length()){
            long posPreRead=raf.getFilePointer();
            p.read(raf);
            abr.add(p.getCod(),posPreRead);
        }
    }
    public void add(int cod,String name,double prz)throws IOException{
        Prodotto p=new Prodotto(cod,name,prz);
        raf.seek(raf.length());
        abr.add(cod,raf.getFilePointer());
        p.write(raf);
    }
    public Prodotto search(int cod)throws IOException{
        long pos=abr.search(cod);
        if(pos!=-1) {
            raf.seek(pos);
            Prodotto p = new Prodotto();
            p.read(raf);
            return p;
        }else
            throw new NoSuchElementException("codice non trovato");
    }
    public void close()throws IOException{
        ObjectOutputStream oos= new ObjectOutputStream(new FileOutputStream("abr.dat",false));
        oos.writeObject(abr);
        oos.close();
        raf.close();
    }
}
