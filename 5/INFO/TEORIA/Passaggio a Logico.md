ristrutturazione er, eliminazione degli attributi multipli nella risttruttuazione si deve cercare di trasformare relazioni complesse tra piu di due entita trasformarle in relazioni binarie


ogni entita diventa una tabella con chiave primaria obbligatoria , l'attributo che identifica univocamente un'istanza dell'entita diventa la chiave primaria, se non ce ne uno apoposta ad esempio utilizziamo un contatore.

diversi casi:
- due entita legate da relazione 1 a 1 è perche nel 95% dei casi potete raggruppare in un'unica tabella, scegliendo quale è piu devole e eliminarla implemenentandola dentro e quindi il nome della entita andrà all'interno del nome dell'attributo per riconoscere.
- due entita legate da una relazione uno a molti: un cittadino puo avere piu numeri di telefono, come faccio con tabelle excel a rappresentare questa pluralità quindi aggiungo il campo chiave univoco anche nella tabella che non è identificata. nella tabella teleofni non puoi inserire un codice fiscale  che non ci sia nella tabelal cittadini.
	la chiave esterna fk identifica in modo univoco una riga in'analtra tabella.
	codice_fiscale(fk->Cittadini)
- due entita legate da una relazione molti a molti(N:M) diventano 3 tabelle essendo che dovremo fare la tabella dell'azione in questo caso recita che contiene il nome attore che prima era contenuto nell'entita attori e l'attributo nome nell'entita film quindi collego e diventano tutte e due attributi primari, sono tutte e due fk, quindi la risposta è che non posso unirle nella stessa entità normalmente perche ci sono piu corrispondenze in cui un attore puo stare a piu film e c'è bisogno delle chiavi fx.
- nel caso in cui un attributo di azione faccio la tabella che ha come  nome il nome dell'azione e inserisco dentro i due attributi collegati principlai e anche l'attributo di azione.

NELL'EREDITA:
- se hai entita ereditarie tipo persona le unisci nella stessa tabella e aggiungi anche attributo tipo per capire quale è
- altrimenti puoi passare ad usare quelle figlie come tabelle implmenteando in queste glia ttributi dell'entita principale
- altrimenti faccio 3 tabelle e in quelle figlie devo mettere chiave fk che in questo caso è cod fiscale





