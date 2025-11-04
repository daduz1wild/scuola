ogni termostato misura la temperatura e ci sono dei valori margini a cui quando si arriva la caldai viene spenta.
Questo però succede quando i segnali sono puliti ma quando i segnali sono un po imprecisi o sporchi con molti sbalzi questo potrebbe portare alla continua accensione o spensione della caldaia.
comunque rimane il fatto che io ho due soglie una per accendere o spegnere la caldaia e per andare incontroa a queste instabilità esiste il relee(quello che attiva un motore come la caldaia) che prima di accendere o spegnere la caldaia aspetta che questi cambiamenti della misura della temperatura finiscano.

l'isteresi è il filtro più sensibile e migliore.
un'operazionale che implementa l'isteresi è il trigger di shmitt, composto da una resistenza di feedback e da una di sistema, inoltre anche partitore di tensione la cui formula è=Ri/(Ri+Rf)
caratteristiche dell'amplificatore operazionale che sugli ingressi è sia in cortocircuito che circuito aperto perche ha una tensione altissima che amplifica la differenza di potenziale(chiedi a chat gpt).
col trigger di smich si decide se lavorare su o giù, infatti se Vd(Vt-V-)> allora il segnale uscirà dalla parte alta(saturazione alta, invece se Vd>0 allora l'uscita va bassa(saturazione bassa)(inverte il segnale) .																	trigger di smith simmetrico e il fattore  che stabilisce tutto(le soglie) è il rapporto fra le resistenze
R1/(Ri+Rf)           R1-Rf=1/(2) 

Vu=10
V+=8=10*(Ri/(Ri+Rf))

V+=Vu*(Ri/(Ri+Rp)