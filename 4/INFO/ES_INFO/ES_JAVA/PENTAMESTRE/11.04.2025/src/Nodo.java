public class Nodo {
    private final int key;
    private final long pos;
    private Nodo left, right;

    public Nodo(int key, long pos)
            throws IllegalArgumentException
    {
        this.key = key;
        this.pos = pos;
        left = right = null;
    }

    public int getKey() {
        return key;
    }

    public long getPos() {
        return pos;
    }

    public Nodo getLeft() {
        return left;
    }
    public void setLeft(Nodo left) {
        this.left = left;
    }

    public Nodo getRight() {
        return right;
    }
    public void setRight(Nodo right) {
        this.right = right;
    }
}
