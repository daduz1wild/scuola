albero binario: connesso senza cicli, sinistra valori inferiori al nodo(padre) e a destra quelli superiore.viene usato l'interface comparable, in modo che potro confrontare  2 oggetti,
il tipo T deve essere vincolato a comparable perche deve essere in gardo di confrontare i vari oggetti fra loro.
Per la ricerca si fa un ciclo che ha all'interno un if che in base a se il valore è min o magg del nodo corrente, fa getLeft o getRight in modo che venga restituito l'indirizzo del nodo che appartiene al percorso che ci serve per trovare il valore da trovare.
percorrimento ABR= postOrder (SDR) , preorder (RSD) , inorder (SRD)
quando parlo dei nodi figli, dico sottoalbero. la cosa bella è che nello stessa struttura abbiamo piu radici e le percorriamo una alla volta.

preorder

postorder (/-/-/-10-9-/-/-13-12)-(/-/-22-/-25-15)

inorder(/-9-/-10-/-12-/-13-/-15)-(/-22-/-25-/)