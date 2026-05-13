il proxy è un server intermediario strategico che ci permette di avere grandi vantaggi, può essere usato per caching usandolo per salvare una pagina in modo da non doverla ricaricare ogni volta, lo svantaggio è che se una  è stata modificata su internet, io non vedo le modifiche perché ho già la pagina vecchia sulla cache e mi mostra quella, quindi dovrei fare una ricerca manuale.
filtraggio: blocca l'accesso a determinati siti web, a scuola proxy c'è.


forward proxy: usato dai client per accedere a internet tramite il proxy
reverse proxy:posto davanti a uno o più server interni per protezione, bilanciamento del carico SSL(si intende il bilanciamento del traffico di rete)

i proxy nella rete offloading

proxy nasconde l'ip pubblico.

CONTROLLO DI ACCESSO: la proxy permette di salvare nei log le attività dell'utenza.

i l proxy solitamente viene posizionato tra gli host e il router/firewall:
- server fisico: installazione su hardware dedicato per massime prestazioni
- rete separata posizionamento in una zona di sicurezza isolata
PROXY VS FIREWALL
lavorano a livelli diversi infatti proxy livello 7(livello di applicazione) e l'altro è livello 8(livello di trasporto, quindi solo  alivello di pacchetti trasmessi)


la differnza tra antivirus e firewall è che uno antivirus da quello che ho capito devia il lavoro del firewall

di solito sul oc abbiamosd em pre una porta di ascolto e una di scrittura

i file per installar eroxy sulla machina dei clioent puoi usare file .pac



