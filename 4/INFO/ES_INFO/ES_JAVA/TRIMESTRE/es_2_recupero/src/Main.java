/*
Realizzare il programma che, usando la classe Lampadina, permetta di verificare, su due lampadine
create, quale di esse si brucia prima durante un ciclo di 100 accensioni e spegnimenti su un numero di
minuti stabilito in modo randomico per ciascuna lampadina (al max 60 minuti per ogni accensione). Non
appena una lampada si brucia il ciclo di 100 accensioni/spegnimenti si interrompe e si stampa lo stato di
entrambe le lampadine
 */
public class Main {
    public static void main(String[] args) {
        Lamp lamp1 = new Lamp("Lampada1", "Marca1", 600, 0, "rosso", false);
        Lamp lamp2 = new Lamp("Lampada2", "Marca2", 600, 0, "blu", false);
        for (int i = 0; i < 100 && !lamp1.isBurnOut() && !lamp2.isBurnOut(); i++) {
                int minutiLamp1 = (int) (Math.random() * 60) + 1;
                int minutiLamp2 = (int) (Math.random() * 60) + 1;
                lamp1.switchOn(minutiLamp1);
                lamp2.switchOn(minutiLamp2);
                lamp1.switchOff();
                lamp2.switchOff();
        }
        System.out.println(lamp1);
        System.out.println(lamp2);
        if (lamp1.isBurnOut()) {
            System.out.println("La lampadina " + lamp1.getNome() + " si è bruciata prima");
        } else
            if (lamp2.isBurnOut()) {
                System.out.println("La lampadina " + lamp2.getNome() + " si è bruciata prima");
            } else {
                System.out.println("Nessuna lampadina si è bruciata");
        }
    }
}