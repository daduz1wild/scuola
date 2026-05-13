import javax.management.openmbean.KeyAlreadyExistsException;

public class ABR {
    private Nodo rad;
    public ABR(){
        rad=null;
    }
    public void add(int key,long pos){
        if(rad==null)
            rad=new Nodo(key,0);
        else {
            if (search(key) == -1)
                addRec(rad,key, pos);
            else
                throw new KeyAlreadyExistsException("chiave già esistente");
        }
    }
    public void addRec(Nodo rad,int key,long pos){
        if(key<rad.getKey()){
            if(rad.getLeft()==null)
                rad.setLeft(new Nodo(key,pos));
            else
                addRec(rad.getLeft(),key,pos);
        }else {
            if(rad.getRight()==null)
                rad.setRight(new Nodo(key,pos));
            else
                addRec(rad.getRight(),key,pos);
        }
    }
    public long search(int key){
        long pos;
        if(rad!=null){
            if(key==rad.getKey())
                pos=rad.getPos();
            else
                pos=searchRec(rad,key);
        }else
            throw new NullPointerException("albero vuoto");
        return pos;
    }
    public long searchRec(Nodo rad,int key) {
        long pos;
        if (rad == null)
            pos=-1;
        else if (key == rad.getKey())
            pos=rad.getPos();
        else if (key < rad.getKey())
            pos=searchRec(rad.getLeft(), key);
        else
            pos=searchRec(rad.getRight(), key);
        return pos;
    }

}
