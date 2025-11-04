Il primo step per la progettazione softwaree è la documentazione che ci viene servita dal committente(cliente), una volta effettUATO UN COLLOQUIO COL COMMITTENTE ABBIAMO TUTTI I REQUISITI NECESSARI PER INIZIARE LA FASE DI PROGETTAZIONE:
- 1 relazione tecnica=ci si esprime come abbiamo risolto il problema datosi dal cliente(che dovrà specificare tutte le caratteristiche del sistema, chi utilizza il sistema?(attore), che possibilita diamo a queste persone che lo 
utilizzano?(funzioni pogramma), per fare l'accesso c si deve registrare e tutte le altre azioni che deve svolgere o puo svolgere detti CASI D'USO)
- 2 diagramma di contesto o di casi d'uso: rappresenta in modo schematico le informazioni estrapolate dalla relazione,un attore non è per forza un'entita umana. ma sono tutte quelle entita interne o esterne che interagiscono col sistema. 
attore deve essere identificato univocamente e rappresentato come uno stickman per ogni caso d'uso.
- 3 diagramma di jacobson: viene fatto dopo l creazione del progrmma,si va a descirvere un caso d'uso , tanti diagrammi di qesto tipo saranno il manuale

UN ATTORE non è per forza un'entita umana. ma sono tutte quelle entita interne o esterne che interagiscono col sistema. 
attore deve essere identificato univocamente e rappresentato come uno stickman, attore non dve eessere chiamato sistema.
possiamo differenziae attore principale e attore secondario.
portare a termine un caso d'uso signfiica ad esempio che l'utente un prodotto viene acquistato e quindi l'attore porta a termine il caso d'uso e ne beneficia.
l'attore secondrio è un attore che interagisce col caso d'uso ma non lo termina(partecipa)
il sistema è rappresentato come un rettangolo tratteggiato(ovviamente con all'interno i casi d'uso) e al di fuori di questo troveremo gli utenti che intergiscono con i casi d'uso

un esempio di attore è un esempio di attore secondario(interviene solo in una certa fase, che ad esempio è quel server che si occupa del pagamento che invia i dati a un server(sistema bancario), l'utente che acquista invece è un attore
principale.

CASI D'USO=è la modalità con la quale l'attore usufruisce di una funzionalità
FUNZIONALITà=caratteristica o azione che il sistema offre di fare
SCENARIO= è l'insieme dei passi che un attore deve eseguire per portare a termine il caso d'uso
ogni caso d'uso ipoteticamente ha infiniti scenari in alcuni casi, come ce ne puo essere soltanto uno, e sono tutti i passi che io faccio per protare a termine il caso d'uso.
le associazioni sono le linee che collegano attore e casi d'uso

nella costruzione del diagramma casi d'uso si collega da attore al caso d'uso, ed è una linea continua, ovviamente un caso d'uso puo essere collegato a piu attori.
noi prevediamo che in alcuni caso d'uso ci siano inseiriti degli altri casi d'uso, ad esempio quando un cliente registrato vuole acquistare deve comunque fare l'accesso quindi conosceremo un vincolo.quindi nella relazione dovremo fare
 attnezione anche questo nella pianificazine dei passi di un certo scenario.

quando abbiamo 2 clienti che interagiscono dobbiamo distinguere quale è quello principale e quello secondario, per farlo si usano le frecce quindi ad esemepio l'attore principale che fa la richiesta d'acquisto richiamera anche il 
sistema bancario che essendo che nonè un attore che porta a termien il caso d'uso allora è un attore secondario e la frecccia andra verso di lui( la freccia devee  essere piena)

attore principale=entita che porta a termine un caso d'uso
l'attore secondrio= è un attore/entita che interagisce con una o piufasi del caso d'uso ma non lo termina(partecipa)

ci sono volte in cui 2 o piu casi d'uso sono strettamente legati, tipo acquisto e login lo sono. per vincolae casi d'uso ad altri si usa L'INCLUSIONE=elemento diagramma di contesto che va a specificare il vincolo tra i casi d'uso, 
quindi si india che posso eseguire  un certo caso d'uso, se e solo se,ho gia eseguito un'altro caso d'uso. per indicare l'inclusione si usa un afreccia tratteggiata con freccia piena (e nel testo si scrive <<include>>) che punta dal 
caso d'uso che ha bisogno dell'altro, all'altro

non si vincola la registrazione al login perchè un cliente non registrato è a parte non c'entra con tutti gli altri, e ovviamente non puo eseguire nessuna delle operazioni a cui serve il login

ESTENSIONE=particolare caso simile a quello dell'inclusione,  indichiamo che un caso d'uso è facoltativo, ad esempio acquisto prodotto non conosco tutte la fasi specifiche per l'acquisto di un prodotto quuindi potrei aver bisogno 
delkl'help online o dell'assistenza freccia tratteggiata piena con scritto extend che punta dal caso facoltativo a quello principale

GENERALIZZAZIONI=c'entra con ereditarietà(concetto programmazione oggetti, afferma che un ana classe detta classe figlio, eredita tutti gli attributi e metodi public). amazo prevede una zeiomne amazon business per le aziend eche vogliono
 comprare.quest'attore presenta 2 sottocategorie che ereditano tutte le caratteistiche dell'attore principale.Per farlo si usa la freccia vuota e si usa nel caso in cui ad esempio l'acquisto prodtto ha bisogno di esssere divo anche in 
casi piu specifici tipo acquistaCD acquisto libro e che quindi puneranno ad acquisto prodotto in modoo da indicare che ereditano da essa e allo stesso tempo ereditano anche anche i vincoli del login. anche i clienti possono essere 
generalizzati quindi se abbiamno ciente registrato e abbiamo di diversao in piu casi 'perche è troppo specifico allora ad esempio abbiamo azienda e privato e lo colleghiamo con linea continua e freccia vuota al cliente registrato generale.

documento dei requisti= srs

quando costruisci la tabella significa che il prodotto è gia stato realizzato e descrivimo quello che abbiamo fatto.
relazione  e casi d'uso fase progettazione
diagramma di jacobson(tabella) è nellla fase finale di descrizione dopo aver gia creato il programma che non deve essere ambigua oavere linguaggio clessso, perche sara lettta da uno stakeolder devo desvrivere cosa fa il cliente e cosa fa il sistema.
tabella pag 326-327

se c'è u estensione del caso d'uso allora la inserisco nella riga UseCase d'Extend
la exit condition= è la condizione che mi dici che i caso 'uso è terminato: di solito il cliente vede che l'acquisto è andato a buon fine(è quella frase che conferma all'utente che ha acquistato)
gli scenari alternativi sono tutti gli scenari che possono impedirmi di terminare il mio caso d'uso e anche come risolverlo.
requisiti speciali: sonod ei requisiti quindi caratteristiche particolari che quel caso s'udo deve rispettare ad esepio se sono utente di amazon e o labbonamento prime , il requisito che la spedizione deve rispettare è che la spedizioe 
sia minore. 
extension points indica quali altri sistemi esterni interagiscono col nostro sistema, li andiao a indicaretutti in questa sezione.
frequenza stimata utilizzo: approsimazione della stima di quante persone visiteranno il sistema per ogni minuto.
criticità: criticita che poi serviranno dal punta di vita sistemistico cheservoo poi per capire come gestire i sistema.


