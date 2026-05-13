import javax.management.openmbean.KeyAlreadyExistsException;
import java.io.*;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.NoSuchElementException;

public class Gestore {
    private Hashtable< String, Long > table;
    private RandomAccessFile raf;
    public Gestore()throws IOException{
        try{
            raf=new RandomAccessFile("table.dat","rw");
            ObjectInputStream ois=new ObjectInputStream(new FileInputStream("indici.dat"));
            table=(Hashtable< String, Long >) ois.readObject();
        }catch(FileNotFoundException | ClassNotFoundException e){
            table=new Hashtable<>();
            if(raf.length()>0)
                initTable();
        }
    }
    private void initTable() throws  IOException{
        raf.seek(0);
        long posPreRead;
        for(int i=0;raf.getFilePointer()<raf.length();i++){
            posPreRead=raf.getFilePointer();
            table.put(Input.readString(raf, Macchina.LENSTR),posPreRead);
            raf.seek((long)(i+1)*Macchina.LENREC);
        }
    }
    public void close()throws IOException{
        ObjectOutputStream oos=new ObjectOutputStream(new FileOutputStream("indici.dat"));
        oos.writeObject(table);
        oos.close();
        raf.close();
    }
    public void add(char alim, double cil, String marca, String modello, double prezzo, String targa, int yy)throws IOException{
        if(!this.table.containsKey(targa)) {
            raf.seek(raf.length());
            long posPreWrite=raf.getFilePointer();
            Macchina m = new Macchina(alim, cil, marca, modello, prezzo, targa, yy);
            m.write(raf);
            table.put(targa,posPreWrite);
        }else
            throw new KeyAlreadyExistsException("chiave gia registrata");
    }
    public Macchina search(String key)throws IOException{
        if(table.isEmpty()){
            throw new IllegalStateException("lista vuota");
        }else{
            Long pos=table.get(key);
            if(pos==null){
                throw new NoSuchElementException("elemento nomn trovato");
            }else{
                Macchina m=new Macchina();
                raf.seek(pos);
                m.read(raf);
                return m;
            }
        }
    }
    public String printAll()throws IOException{
        StringBuilder s=new StringBuilder();
        Macchina m=new Macchina();
        for(Long pos: table.values()){
            raf.seek(pos);
            m.read(raf);
            s.append(m);
            s.append("\n");
        }
        return s.toString();
    }

}
