/*
Esercizio 10
In riferimento all’esercizio precedente, si dovrà creare un negozio di telefonia che gestisca diverse SIM.
Il negozio dovrà gestire sia le SIM inattive tenute in magazzino, sia le SIM acquistate dai vari clienti.
Del negozio si conoscono le seguenti informazioni:
§ P.IVA
§ Nome
§ Indirizzo
In negozio avrà la possibilità di:
1. Attivare una SIM
2. Disattivare una SIM
3. Acquisto SIM da parte del negozio. Le SIM acquistate dal negozio andranno in magazzino.
4. Ricaricare una SIM: si dovrà chiedere l’operatore, il numero di telefono e l’importo della ricarica
5. Richiedere la portabilità del numero: si dovrà chiedere l’ICCID della sim, il numero di telefono di cui effettuare la portabilità, l’operatore attuale e il nuovo operatore. Nella fase di portabilità si dovrà chiedere all’utente se trasferire o meno il credito residuo.
6. Visualizzare le SIM attive/disattive in negozio in base alla scelta dell’utente.
 */

import java.util.Iterator;
import java.util.LinkedList;

public class Negozio {
    private String nome;
    private String p_iva;
    private String ind;
    private LinkedList<Sim> mag;
    private LinkedList<Sim> clienti;
    public Negozio(){
        init();
    }
    private void init(){
        setNome("null");
        setP_iva("null");
        setInd("null");
        mag=new LinkedList<Sim>();
        clienti=new LinkedList<Sim>();
    }
    public Negozio(String nome,String p_iva,String ind){
        setNome(nome);
        setP_iva(p_iva);
        setInd(ind);
        mag=new LinkedList<Sim>();
        clienti=new LinkedList<Sim>();
    }
    public Negozio(Negozio a){
        if(a!=null){
            setNome(a.getNome());
            setP_iva(a.getP_iva());
            setInd(a.getInd());
            mag=new LinkedList<Sim>();
            clienti=new LinkedList<Sim>();
        }else
            init();
    }

    public void setNome(String nome) {
        if(nome!=null && !nome.isBlank())
            this.nome = nome;
        else
            throw new IllegalArgumentException("Nome non valido");
    }

    public String getNome() {
        return nome;
    }

    public void setP_iva(String p_iva) {
        if(p_iva!=null && !p_iva.isBlank())
            this.p_iva = p_iva;
        else
            throw new IllegalArgumentException("iva non valida");
    }

    public String getP_iva() {
        return p_iva;
    }

    public void setInd(String ind) {
        if(p_iva!=null && !p_iva.isBlank())
            this.ind = ind;
        else
            throw new IllegalArgumentException("indirizzo non valido");
    }

    public String getInd() {
        return ind;
    }

    public void setClienti(LinkedList<Sim> clienti) {
        if(clienti!=null)
            this.clienti = clienti;
        else
            throw new IllegalArgumentException("cliente non esistente");
    }

    public LinkedList<Sim> getClienti() {
        return clienti;
    }

    public void setMag(LinkedList<Sim> mag) {
        if(mag!=null)
            this.mag = mag;
        else
            throw new IllegalArgumentException("magazzino non esistente");
    }

    public LinkedList<Sim> getMag() {
        return mag;
    }
    public boolean attivaSim(String nom,String cogn){
        boolean attivo=true;
        Sim s;
        if(mag.isEmpty())
            attivo=false;
        else {
            s=mag.getLast();
            s.setNom(nom);
            s.setCogn(cogn);
            s.setAttiva(true);
            mag.remove(s);
            clienti.add(s);
        }
        return attivo;
    }
    public boolean disattSim(String id){
        Sim s=rirSim(id,clienti);
        boolean trovato=true;
        if(s==null)
            trovato=false;
        else{
            s.setNom("null");
            s.setCogn("null");
            s.setCred(0);
            s.setId("null");
            s.setMinTot(0);
            s.setNumCel("null");
            s.setAttiva(false);
            clienti.remove(s);
            mag.add(s);
        }
        return trovato;
    }
    public Sim rirSim(String id,LinkedList<Sim> lista) {
        Sim temp;
        Sim s=null;
        Iterator<Sim> it= lista.iterator();
        while(s==null && it.hasNext()){
            temp=it.next();
            if(temp.getId().equals(id))
                s=temp;
        }
        return s;
    }
    //3. Acquisto SIM da parte del negozio. Le SIM acquistate dal negozio andranno in magazzino. quan ricorda che praticmanete passi per
    // parametro una sim controlli che sia diverso dan quelle contenute nel megazzino (nel caso
    // in cui non ha valori di default) e poi glieli daai tu per sicurezza i valori di standard e in caso positivo la sposti nella lista magazzaino

}
