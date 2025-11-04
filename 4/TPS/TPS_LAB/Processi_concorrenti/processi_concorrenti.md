pid serve per identificare ogni singolo processo presente.
quando uso la funzione fork, ci sono 3 casistiche, <0(processo non creato),0(processo creato/generato e risorsa(CPU) assegnata al procoesso figlio),>0(processo figlio creato(biforcazione avvenuta), ma la risorsa è assegnata al padre, il numero intero restituito indica il pid(valore intero univoco che identifica i processi) del processo figlio)
<stdlib.h> <stdio.h> <unistd.h>
int main(){
	int pid;
	printf("prima della fork: 1 processo MAIN\n");
	pid=fork();
	if(pid<0)
		printf("errore processo figlio noncreato");
	else if(pid ==0)
		printf("ciao sono il processo figlio");
	else
		printf("ciao sono il processo padre");
	retrun 0;


 getpid()
Descrizione: Restituisce l'ID del processo corrente (Process ID o PID), un numero univoco assegnato dal sistema operativo a ogni processo in esecuzione.

getppid()
Descrizione: Restituisce l'ID del processo padre (Parent Process ID o PPID), ossia l'ID del processo che ha generato il processo corrente.

nella programmazione concorrente i processi concorrono per avere unja risorsa e facendo in modo che essi vengano eseguiti in contemporanea.
amcchina concorrente(in grado di eseguire più processi sequenziali)

TERMINAZIONE DI UN PROCESSO
INVOLONTARIA
a causa di operazioni illegali(come la divisione per 0, o l'inserimento di una stringa in int), che genera interrupt di sistema.
VOLONTARIA
exit(int status);  il parametro può servire al padre che ha generato il figlio per essere informato sul fatto che il figlio è terminato


processo figlio se lo si crea nel main è una copia del main e condivide il suo spazio di memoria con il padre e lo stesso il padre con il figlio

sleep(2);/*con la sleep si fa addormentare il processo attivo, quindi visto che era attivo il main(padre) la cpu al posto di stare fermo viene disallocata dal padre e allocata al figlio*/

int getpid()= restituisce il valore del pid riferito al processo che esegue quella istruzione

int getppid() restituisce il pid del processo padre del processo che richiama questa istruzione se il processo con cui usi questa funzione è gia il main ti ritorna il valore del processo del server.

nel caso in cui termino il processo padre e dopo uso la getppid il pid che mi ritorna è quello del rpoocesso init, cioè il primo processo eseguito all'avvio della macchina per l'avvio del SO che ha pid 1


es da fare procedura che crea un singolo figlio facendo terminare prima il figlio poi il padre.nel main chiedi all'utente "quanti figli vuoi generare e quindi eseguirai il ciclo che crea un figlio n volte