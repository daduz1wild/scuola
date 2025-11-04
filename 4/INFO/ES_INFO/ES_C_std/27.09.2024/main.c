#include "header.h"
/*
Davide Benedetti 4BI

per una serie di persone di cui si conosce peso ed altezza, realizzare un programma che permetta di:
a) calcolare l'indice BMI (indice di massa corporea) indicando a quale classe appartiene l'utente
b) elencare in un file di testo(esportazione) i dati forniti per le persone considerate "sottopeso" e il loro numero totale.
I dati delle persone sono contenute in un file di testo avente per ogni riga peso e altezza di una singola persona separata da uno spazio.
Vincoli: i dati del file DEVONO essere caricati in un array di record istanziato a run time con un numero di elementi pari a numero delle
righe del file
*/
int main()
{
    int *n;
    sPersona *persona;
    int m;
    m=leggiInt("Inserisci:\n1.calcola l'indice BMI e scopri la tua classe\n2. esporta dati persone sottopeso e scopri il numero totale\n3.termina\n",0,3);
    do{
        switch(m){
            case 1:
                calcIBM(persona,n);
                break;
            case 2:
                espSott(persona,n);
                break;
        }
    }while(m!=3);
    return 0;
}
