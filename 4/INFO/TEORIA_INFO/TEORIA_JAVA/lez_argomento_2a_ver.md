esistono due tipologie di classi per gestire dei flussi di informazioni:
-basata sul byte
-basata sul carattere

ogni singola cifra viene salvata uogni 2 byte, rappresenta la codifica di un carattere e quindi poi verrà convertito in stringa

una famiglia si occupa della lettura su file di testo e l'altro della scrittura.

FILE CSV
noi lavoriamo solo con i file CSV
la pseudo è uguale a C, ma in java se apri in lettura usi una classe se apri in scrittura ne usi un'altra.
sono necessarie queste 2 classi:
fileWriter(nomeFile);
fileReader(nomeFile,boolean che indica se vuoi append o no);

insieme a queste devi anche aprire il bufferedReader o bufferedWriter(come il fin che facevi su C)
la condizione da utilizzare durante la lettura di unf file è (s!=null) infatti prima della condizione) metti s=readLine e poi lo metti anche all'interno del try catch come facevano con C che la lettura della riga la facevi sia priam del ciclo che dopo.
IOException(eccezione che potrebbe accadere lavorando con i file)


all'interno delle classi si permette che un oggetto sappia scriversi o leggersi nel file.
metodi utili
SCRITTURA
write(String);
append(String);
print(String);
println(String);

interface FileCsv<t>{
	String toCsv();
	T nomCsv(string s);
}

class Prodotto implements FileCsv<Prodotto>{
	-
	String toCsv();
}

classe astratta= non puoi definire un oggetto di quel tipo ma devi ereditare
