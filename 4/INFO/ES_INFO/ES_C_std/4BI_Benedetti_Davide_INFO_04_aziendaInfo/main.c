///MAIN

#include "header.h"
/*
Davide Benedetti 4BI


Si devono gestire i dipendenti di un'azienda informatica.
Per ogni dipendente si conosce:
§ Codice Fiscale (univoco)
§ Nome
§ Cognome
§ Ruolo ("programmatore", "sistemista", "formatore")
§ Stipendio
Realizzare un programma che permetta di:

1. Importazione dei dipendenti da file csv (con controllo unicità codice fiscale) in una lista (inserimento ordinato crescente in base al codice fiscale); i dipendenti non importati saranno inseriti sul file log.csv
2. Stampare tutti i dati di tutti i dipendenti dell'azienda;
3. Fornito in input il Codice Fiscale, stampare i dati del dipendente;
4. Fornito in input il Codice Fiscale, modificare lo stipendio;
5. Stampare il costo totale che l'azienda dovrà versare per il pagamento degli stipendi.
6. Esportare su file binario tutti i dipendenti di un determinato ruolo
7. Fornito in input il Codice Fiscale, cancellare il relativo dipendente dalla lista.
8. Cancellare dalla lista i dipendenti aventi uno stipendio compreso tra due valori inseriti in input dall’utente.

Obblighi/Limiti:
- Ogni singolo punto del menu deve essere preceduto dallo pseudocodice con descrizione dei parametri, delle variabili locali e delle strutture dei file creati.
- Il progetto dovrà essere realizzato dividendo il codice in più file.
- Per gli input si dovranno utilizzare le apposite funzioni realizzate.
*/
int main()
{
    int m;
    Tnodo* first=NULL;
    do{
        m=leggiInt("Inserisci:\n1. Importazione dei dipendenti da file csv\n2. Stampare tutti i dati di tutti i dipendenti dell'azienda\n3. Fornito in input il Codice Fiscale, stampare i dati del dipendente\n4. Fornito in input il Codice Fiscale, modificare lo stipendio\n5. Stampare il costo totale che l'azienda dovrà versare per il pagamento degli stipendi\n6. Esportare su file binario tutti i dipendenti di un determinato ruolo\n7.Fornito in input il Codice Fiscale, cancellare il relativo dipendente dalla lista\n8.Cancellare dalla lista i dipendenti aventi uno stipendio compreso tra due valori inseriti in input dall’utente.\n9.termina",0,9);
        switch(m){
            case 1:
                first=imp(first);
                break;
            case 2:
                stampa(first);
                break;
            case 3:
                datiDip(first);
                break;
            case 4:
                modStip(first);
                break;
            case 5:
                costoStip(first);
                break;
            case 6:
                espRuolo(first);
                break;
            case 7:
                first=cancEl(first);
                break;
            case 8:
                first=cancMargStip(first);
                break;
        }
    }while(m!=9);
    return 0;
}
