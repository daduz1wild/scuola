#include "header.h"
/*Esercizio 2
Un negozio di informatica commissiona un applicativo per la gestione del proprio catalogo di videogiochi.
Ogni videogioco ha le seguenti caratteristiche:
	ID – Univoco
	Nome
	Costo
	Classificazione (S, A, B)
	Usato (0->usato, 1->nuovo)

Realizzare un menu che presenti le seguenti funzionalità:
1)	Importa il catalogo dei videogiochi da file (controlla che i dati del videogioco siano corretti. In caso di errori la riga riferita al videogioco dovrà essere esportata in un file chiamato log.csv);
2)	Stampa catalogo;
3)	Stampa il valore economico totale del catalogo;
4)	Dato l'ID, stampa i dati videogioco;
5)	Dato l’ID, modifica il costo del videogioco;
6)	Data la classificazione, esporta in un file i videogiochi aventi quella classificazione;

	VINCOLI/OBBLIGHI
	Il progetto dovrà essere realizzato dividendo il codice in più file.
	Per gli input si dovranno utilizzare le apposite funzioni realizzate.
	L’array di record si deve istanziare a run time
	obbligo di uso dei puntatori all’interno delle procedure e delle funzioni.
	Non è possibile utilizzare parentesi quadre ([]).
*/
int main()
{
    int m;
    int n=0;
    n=contaRighe();
    printf("%d\n",n);
    giochi *Tgiochi=(giochi*)malloc(sizeof(giochi)*n);
    do{
        m=leggiInt("inserisci:\n1.Importa il catalogo dei videogiochi da file\n2.Stampa catalogo\n3.Stampa il valore economico totale del catalogo\n4.Dato l'ID, stampa i dati videogioco \n5.Dato l’ID, modifica il costo del videogioco \n6.Data la classificazione, esporta in un file i videogiochi aventi quella classificazione\n7.termina\n",1,7);
        switch(m){
            case 1:
                imp(Tgiochi);
                break;
            case 2:
                stampaCat(Tgiochi,n);
                break;
            case 3:
                valEcon(Tgiochi,n);
                break;
            case 4:
                cercaID(Tgiochi,n);
                break;
            case 5:
                modCosto(Tgiochi,n);
                break;
            case 6:
                stampaClasse(Tgiochi,n);
                break;
            case 7:
                printf("termina");
                break;
        }
    }while(m!=7);
    return 0;
}
