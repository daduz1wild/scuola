public class CodaPostale {
    private String nomeCoda;
    private MyList<String> coda;
    private int contatore;

    public CodaPostale(String nomeCoda) {
        this.nomeCoda = nomeCoda;
        this.coda = new MyList<>();
        this.contatore = 1;
    }

    public void push() {
        String ticket = nomeCoda + "-" + contatore;
        coda.addLast(ticket);
        System.out.println("Generato ticket: " + ticket);
        contatore++;
    }


    public String pop() {
        if (coda.getFirstNode() != null) {
            String ticket = coda.removeFirst();
            System.out.println("Servito ticket: " + ticket);
            return ticket;
        } else {
            System.out.println("La coda " + nomeCoda + " è vuota!");
            return null;
        }
    }


    public void stampaCoda() {
        System.out.println("\nTicket in coda " + nomeCoda + ":");
        Nodo<String> nodo = coda.getFirstNode();
        while (nodo != null) {
            System.out.println(nodo.getDati());
            nodo = nodo.getNext();
        }
    }
}