#include "header.h"
/*
DAVIDE BENEDETTI 3BI
*/
struct Nodo *creaNodo(char *nome, char *cognome, int eta) {
    struct Nodo *nuovoNodo =(struct Nodo*)malloc(sizeof(struct Nodo));
    strcpy(nuovoNodo->nom,nom);
    strcpy(nuovoNodo->cognom,cognom);
    nuovoNodo->eta=eta;
    nuovoNodo->next=NULL;
    return nuovoNodo;
}

void imp(Tpersona *persona){
    FILE *fin;
    char riga[LENMAX];
    int n=0;
    bool corretto;
    fin=fopen("file.csv","r");
    if(fin!=NULL){
        fgets(riga,NMAX,fin);
        while(!feof(fin)){
            strcpy((persona+n)->nom,strtok(riga,";"));
            strcpy((persona+n)->cognom,strtok(NULL,";"));
            (persona+n)->eta=atoi(strtok(NULL,";"));
        }
    }else
    printf("file non esiste");
}
