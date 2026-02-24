il caso d'uso è la modalità con la quale l'attore usufruisce della funzionalita

lo scenario è l'insieme di passi o di punti (percorso) da svolgerein riferimento al caso d'uso. Di scenari ne abbiamo diversi:
- Principale: è quello che avviene senza eccezioni
- alternativi: sono quelli con eccezioni


-include:caso d'uso che impone un vincolo, cioe il caso d'uso che punta al caso d'uso incluso, puo essere eseguito solo se il caso d'uso puntato è stato eseguito
- estensione: serve per indicare che un caso d'uso puo essere eseguito durante l'esecuzione del caso d'uso 
- generalizzazione: è un tipo di asscoiziazione in ui andiamo a scomporre un caso spuso o attore principale in più categorie che hanno delle specifiche aggiuntive rispetto a quello principale.

nei diagrammi che donbbiamo fare in veri9fica in generale è sempre meglio inserire come casi d'uso: gestione profilo

admin  che nella relazione devo indicare come riceve le credenziali gestisce il catalogo, quindi puo aggiungere veicoli, togliere veicoli e i inoltre puo gestire utenti e gestire noleggi/car sharing

diagramma di contesto
Noleggio
Il cliente effettua un noleggio di un veicolo scelto dal catalogo
Scopo(insiemi generali dei passi da seguire) Scelta del Veicolo, inserimento dei dati temporali e spaziali, inserimento dati di pagamento, conferma noleggio
Cliente, Sistema Bancario
Cliente
Richiesta Optional
Noleggio di un veicolo senza richiesta di optional
entry condition(quale è la condizione necessaria affinché io posso noleggiare): il cliente deve avere effettuato la registrazione e il login.
flusso di eventi(non dobbiamo solamente indicare cosa fa l'attore ma dobbiamo dire anche come risponde il sistema/cosa mostra e senza mettere condizioni): 
1. il cliente clicca sul bottone in alto a sinistra "Effettua Noleggio"
2. il sistema mostra il catalogo con i possibili veicoli da noleggiare(il sistema mostra esclusivamente i veicoli disponibili)
3. l'utente seleziona il veicolo desiderato
4. il sistema visualizza una pagina con tutte le info riferite al veicolo selezionato
5. Il cliente conferma la scelta del veicolo
6. Il sistema visualizza una finestra in cui il cliente dovrà inserire i dati riferiti a:
	- data e stazione di ritiro
	- data e stazione di deposito
7. il cliente compila il Form con i dati temporali e  spaziali richiesti al punto 6
8. Il sistema visualizza un messaggio sulla pagina confermando i dati spaziali e temporali inseriti dal cliente
9. Il sistema mostra una pagina dove richiede di inserire i dati di pagamento(Il sistema consente i seguenti tipi di pagamento: carta di credito, carta di debito, bonifico).
10. il cliente inserisce i dati di pagamento richiesti
11. Il sistema bancario verifica i dati di pagamento inseriti dal cliente
12. il sistema mostra un messaggio su pagina di pagamento in cui viene confermato all'utente l'avvenuta verifica dei dati di pagamento inseriti e della loro correttezza
13. Il sistema mostra una pagina in cui è indicata la conferma del noleggio del veicolo scelto, mostrando il riepilogo dell'ordine effettuato

exit condition: Il cliente riceve un'email di conferma del noleggio con il riepilogo.


scenari alternativi: Noleggio di un veicolo con optional: tutto uguale ma si aggiunge 5. Il cliente accede alla sezione di richiesta optional  6. Il sistema mostra una finestra con i possibili optional da aggiungere al veicolo selezionato7. Il cliente in …

eccezioni: 
A. data o luogo di ritiri/deposito non disponibile:
	- il sistema mostra sulla pagina un messaggio al cliente indicando che data o luogo del ritiro/deposito indicate non sono0 disponibili per il veicolo selezionato 
	- il sistema richiede di inserire i dati indicati nel punto precedente
B.  Dati di pagamento non validi(dati inseriti errati o saldo insufficiente):
	- Il sistema mostra sulla pagina un messaggio al cliente indicando che i dati di pagamento inseriti non sono validi 

requisiti speciali(funzioni premium che l'utente puo richiedere)
extensions point: sono attori esterni con cui si comunica: sistema bancario
frequenza stimata all'utilizzo: 100 utenti al giorno
criticità: latenza dei server, mancanza di connessione






