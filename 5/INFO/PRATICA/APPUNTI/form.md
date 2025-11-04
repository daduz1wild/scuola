Validazione lato client.
 
l'obbiettivo della validazione lato client è un controllo che viene fatto prima che i campi del form vengano mandati al server, la validazione ato client puo essere aggiratat , pertanto non deve sostituire la validazione lato server.(quindi nom bastano solo client).
step è una freccetta che permette di incremenetaref

io posso mettere una sorta du regolache va a dirmi se il ciontenuto è accettabile oppure, ad ese se viogliono che ci siano estttamente 10 cifrre compre tra dei certi caratteri.
in alternativa aui cibtrolli html i controlli possono essdere fattri con javascripy, quindi quando clicchiamo il tasto, prima di invuiare i dati al server viene eseuito il codice javascript quindi nel campo form metti   onsubmit= return controlloJS(this), return perche il metodo restituisce un boolean , onsubmit se gli viene dato valore false non invia altrimenti si.

per dichiarare le varibaili si usa let, ilo rpof nella validazione dati di JS ha consigliato di mettere una stringa su cui si concatyenano i vari errori e ovviamente la variabile booleana e per controllare i dati devi fare ,nomeIns=form.nome.value;ù

il form è visto come un oggetto  infatti quando richisamiamo i metodo della convalida usiamo il (this) che è il riferimento a se stesso