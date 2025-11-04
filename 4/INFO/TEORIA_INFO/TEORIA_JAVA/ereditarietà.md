se voglio fare in modo che una classe implementi da un'altra devo usare extends
class nomeSottoClasse extends nomeSopraClasse 
La sottoclasse ridefinisce ciò che era stato già definito nella sopraclasse
super() è il puntatore che permette di richiamare le istruzioni che sono state scritte nei costruttori della classe padre(ovviamente costruttore in base ai parametri
quindi praticamente super() serve per usare i costruttori della classe padre a sua volta la classe padre può avere un altro padre che  richiamerà con super(guarda sul libro per capire meglio)
probabilmente le classi dovranno essere protected

polimorfismo=si può fare in modo che quando nello stack ho un riferimento a una stuttura di tipo cerchio nell'heap, posso meììstesso metodo, il polimorfismo praticamente serve per eseguire lo stesso metodo(con magari codice diverso ma con stesso nome e stessi parametri) con pochissime righe perchè io uso un ciclo  e la chiamata alla funzione ma con la get di i tipo get(i).disegno() che essendo dentro a un ciclo for ti porta a tutti gli oggetti che sono di tipo contenuto nella famiglia

es da fare
Gestore(add,toString,elencoAree(che fa l'elenco di tutte le aree contenute nel gestore));Figura(area,2p,toString)Quad(l2,area,2p,tosìString);Triang(l2,l3,area, 2p, toString