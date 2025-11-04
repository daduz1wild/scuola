# POSTBACK
esempio interazione client->server:
instauro il collegamento col server php(entro nella pagina php), faccio richiesta in GET alla pagina php il server mi risponde  il server mi risponde ciao Tobu 
in questo caso la pagina php con cui lavoriamo è sempre la stessa(contattiamo sempre lei), il modo in cui differenziamo il tipo di contatto che vogliamo avere con lo stesso file è che in uno semplicemente facciamo una richiesta tipo  e nell'altra gli diamo dei valori

empty sul vettore ?_GET controlla che il vettore non sia vuoto

sono 3 i controlli che devono essere fati all'entrata di php
quindi controlli se non è arrivato nulla posso usare empty(?_GET), poi controllo se una parte è stata inviata e l'altra no  e poi se i dati inviati sono corretti

questa tecnica prevede un'unica pagina php per mostrare il form al client e elaborare anche i dati ricevuti

se non specifico action nel forml'invio viene fatta allo stessa pagin

volendo possiamo usare una richiesta in get non trasmite richiesta in form ma anche tramite URL utilizzando il metodo GET

nel caso in cui il $_GET è vuoto allora mostro il form ovviamente, invece se il get non e vuoto allora faccio il controllo di validita dei dati:
- se sono validi faccio le operazioni dovute
- se non sono validi, avviso

il prof chiede di tenere separato html e php
e di tenere memoria dei casi e dell'errore(lo ha fatto nell'esercizio in classe non so se veramente lo vuole perche non mi smebra molto efficiente)

è una buona pratica anche controllare che l'accesso al sito php non sia tramite altri metodi e vietarlo if($_SERVER["REQUESTMETHOD"]=="GET)


