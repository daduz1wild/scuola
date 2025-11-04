trasferire dati in un file binario significa copiare il valore binario dei datiall'interno di un programma e copiarli direttamente nel file.
la classe RandomAccessFile ci permette di muoverci all'interno del flusso di dati(tramite i pointer(in c usavi la seek, file pointer))
questa classe ci fornisce dei metodi tra cui la seek che parte sempre dalla posizione 0 nella visura del file. il file puo essere identificato in base al nome o in base all'oggetto che punta sul file.
i dati li conteniamo ovviamente nei record, per afrlo con file binario e piu semplice infatti basta che ad esempio crei l'oggetto libro e poi fai f.read(libro).
essendo che i record che contengono i dati devono avere la stessa misura(occupare lo stesso spazio in memoria) allora devo definire un attributo final "LENSTR" nella classe le cui istanze servono per memorizzare i dati del file. in modo che tutti i record occupino lo stesso spazio ad esempio se nel file memorizzo 3 stringhe e 2 numeri interi ovviamente i numeri interi avranno un sacco di spazio che eccede ma le stringhe potranno essere fino a 50 caratteri
la prof non usa subito la raf.write con le stringhe in modo d  non scrivere nel file tutti gli spazi vuoti(caratteri in eccesso)

interfaccia IOFileRandom con metodi readFR e writeFR che all'interno hanno la read e la write della classe RandomAccessFIle

ci sono diversi metodi per la scrittura(char per char usi il for e nel momento in cui finisci di scrivere tramite la writeChar devi controllare che non ci siano altri spazi vuoti (<len) e in caso comntrario aggiungi carattere vuoto)
altrimenti
altrimenti c'è un altro modo usando la classe StringBuffer buf che lo usi sempre con il writeChar(buf)

essendo che non c'è la modalita di scrittura in append, siamo noi che dobbiamo  usiamo la len per scoprire la lunghezza del file e usare la seek in pos+1 (penso) comunque fatto sta che tramit getLen e seek ci spostiamo nel posto giusto

