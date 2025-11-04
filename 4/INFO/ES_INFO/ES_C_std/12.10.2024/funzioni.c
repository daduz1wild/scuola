#include "header.h"

Tpersona *impDati(Tpersona *first){
    FILE *fin;
    char riga[LENMAX];
    fin=fopen("file.csv","r");
    if(fin!=NULL){
        fgets(riga,LENMAX,fin);
        while(!feof(fin)){
            Tpersona *p=(Tpersona*)malloc(sizeof(Tpersona));
            if(first==NULL){
                first=p;
                p->next=NULL;
            }else{
                p->next=first;
                first=p;
            }
            strcpy((p)->nome,strtok(riga,";"));
            strcpy((p)->cognome,strtok(NULL,";"));
            (p)->eta=atoi(strtok(NULL,";"));
            fgets(riga,LENMAX,fin);
        }
    }else
        printf("errore nell'apertura del file");
    return first;
}

void stampa(Tpersona *p){
    while(p!=NULL){
        stampaP(p);
        p=p->next;
    }
}
void stampaP(Tpersona *p){
    printf("%s, ",p->nome);
    printf("%s, ",p->cognome);
    printf("%d\n",p->eta);
}

Tpersona *cancNodo(Tpersona *first){
    if(first!=NULL){
        char rirNome[NMAX],rirCognome[NMAX];
        leggiStr("inserisci nome della persona da eliminare dalla lista",rirNome);
        leggiStr("inserisci cognome della persona da eliminare dalla lista",rirCognome);
        Tpersona *el=rir(first,rirNome,rirCognome);
        if(el!=NULL){
            if(el==first){
                first=first->next;
                free(el);
            }else{
                    Tpersona *aus=first->next;
                    Tpersona *prec=NULL;
                    while(aus!=el){
                        prec=aus;
                        aus=aus->next;
                    }
                    prec->next=aus->next;
                    free(aus);
            }
        }else
            printf("elemento non trovato");
    }else
        printf("lista non esistente");
    return first;
}

Tpersona *rir(Tpersona *first,char *nome,char *cognome){
    Tpersona *el=NULL;
    Tpersona *aus=first;
    while(el==NULL && aus!=NULL){
        if(strcmp(aus->nome,nome)==0 && strcmp(aus->nome,nome)==0)
            el=aus;
        aus=aus->next;
    }
    return el;
}
