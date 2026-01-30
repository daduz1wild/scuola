lato client dobbiamo avere un form in cui obbligatoriamente dobbiamo usare metodo post, nell'elemento form ci deve essere obbligatoriamente questo attributo `enctype="multipart/form-data"` 
il server :
verificare che nel file php.ini la direttiva file uploads sia impostata on
l'array associativo $FILES  contiene i nomi e le informazioni che riguardano i file provenientti dal campo di tipo file di un form
name type size e tmp_name(percorso comleto del file temporaneo sul server) error

il file inviato va a finire in uan cartella temporanea, e se non viene usato non 

immagina che stai facendo un sito dove vai a salvare un immagine di profilo inviata da utente, la foto di profilo caricata è da memorizzare  nel server in una cartella apposita , per movere il file dove voglio si usa la funzione move_uploaded_file(string $from, string $to);
quando si muove il file 