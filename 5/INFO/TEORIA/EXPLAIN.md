comando che posizionato prima di una query mi permette di ricavare l'efficienza di una query
dobbisamo usare un indice quando vogliamo abìvere un risparmio rilevante sull'efficienza delle quey.
quando cereo un campo primario o creo 
un indice va a creare uno spazio in memoria, ma se sono operazioni di aggiornamento o comunque modifica, mi rallenta le operazioni
se un indice coinvolge piu colonne 
create index indc ON studenti(cognome);