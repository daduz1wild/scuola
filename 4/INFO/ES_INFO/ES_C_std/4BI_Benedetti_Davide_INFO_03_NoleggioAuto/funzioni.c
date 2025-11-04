///FUNZIONI


#include "header.h"

//Davide Benedetti 4BI



/*
DESCRIZIONE FILE  .CSV
il file  macchine.csv conterrà un elemento per riga, con i dati separati da un ";"
ESEMPIO:
FJ3445;stradale;utilitaria;120;45;\n
*/

/*
funzione imp
par formali
first         primo nodo della lista     Tnodo*

var locali
fin         file                                                                 FILE*
nomeF       nome del file                                                        vettore di NMAX caratteri
riga        contiene una riga del file                                           vettore di LENMAX caratteri
nuovo       contiene temporaneamente i dati di un elemento                       Tmacchina
corretto    ci indica se i dati in nuovo sono corretti                           bool
p           nuovo nodo della lista                                               Tnodo*

inizio
    leggi nome del file in nomeF
    apri file nomeF in input
    se file e aperto
    allora
        leggi la prima riga del file in riga
        mentre (file non e finito)
            spezza riga fra i suoi token
            assegna i token ai campi del record nuovo nel seguente ordine: tg,mod,tipo,przGiorn,km
            se i dati sono corretti
            allora
                istanzia  uno spazio in memoria pari alla misura in byte di una struttura Tnodo per p
                p->macchina=nuovo
                se(first==NULL)
                    first=p
                    p->next=NULL
                altrimenti
                    p->next=first
                    first=p
                fse
            fse
            leggi un'altra riga del file in riga
        fmentre
    altrimenti
        scrivi "errore"
    fse
    ritorna first
fine

*/
Tnodo* imp(Tnodo* first){
    FILE* fin;
    char nomeF[NMAX],riga[LENMAX];
    Tmacchina nuovo;
    bool corretto;
    leggiStr("inserisci nome file",nomeF);
    fin=fopen(nomeF,"r");
    if(fin!=NULL){
        fgets(riga,LENMAX,fin);
        while(!feof(fin)){
            strcpy(nuovo.tg,strtok(riga,";"));
            strcpy(nuovo.mod,strtok(NULL,";"));
            strcpy(nuovo.tipo,strtok(NULL,";"));
            nuovo.przGiorn=atof(strtok(NULL,";"));
            nuovo.km=atof(strtok(NULL,";"));
            corretto=contrDati(nuovo,first);
            if(corretto){
                Tnodo* p=(Tnodo*)malloc(sizeof(Tnodo));
                p->macchina=nuovo;
                p->next=first;
                first=p;
            }
            fgets(riga,LENMAX,fin);
        }
    }
    return first;
}
/*
funzione rir
par formali
first         primo nodo della lista     Tnodo*
dato          dato da ricercare          char*

var locali
el          contiene indirizzo dell'elemento trovato altrimenti NULL             Tmacchina
p           nodo della lista                                                     Tnodo*

inizio
    mentre(p!=NULL e el non trovato)
        se(dato==p->macchina.tg)
            el=p
        punta p al prossimo nodo della lista
    fmentre
    ritorna el
fine

*/
Tnodo* rir(Tnodo* first,char* dato){
    Tnodo* p=first;
    Tnodo* el=NULL;
    while(p!=NULL && el==NULL){
        if(strcmp(dato,p->macchina.tg)==0)
            el=p;
        p=p->next;
    }
    return el;
}
/*
procedura calcGuadagno

par formali
first         primo nodo della lista     Tnodo*

var locali
el          contiene indirizzo dell'elemento trovato altrimenti NULL             Tmacchina
p           nuovo nodo della lista                                               Tnodo*
dato          dato da ricercare                                                  vettore di NMAX caratteri
guad        guadagno per una macchina                                            reale


inizio
    el=NULL
    p=first
    leggi codice targa in dato
    ricerca dato nella lista
    se el è vuoto
    allora
        scrivi "non trovato"
    altrimenti
        calcola il calcolo dall'auto in base al suo tipo
        se è un utilitaria
        allora
            guad=el->macchina.km*0.44
        fse
        se è di lusso
        allora
            guad=el->macchina.km*1.99
        fse
        se è confort
        allora
            guad=el->macchina.km*0.99
        fse
        scrivi guad
    fse
fine

*/
void calcGuadagno(Tnodo* first){
    Tnodo* el=NULL;
    Tnodo* p=first;
    char dato[NMAX];
    float guad;
    leggiStr("inserisci targa",dato);
    el=rir(first,dato);
    if(el==NULL)
        printf("elemento non trovato");
    else
        if(strcmp(el->macchina.tipo,"utilitaria")==0)
            guad=el->macchina.km*0.44;
        if(strcmp(el->macchina.tipo,"lusso")==0)
            guad=el->macchina.km*1.99;
        if(strcmp(el->macchina.tipo,"confort")==0)
            guad=el->macchina.km*0.99;
        printf("il guadagno sulla seguente auto e di %f\n",guad);
}

/*
procedura visDati

par formali
first         primo nodo della lista     Tnodo*

var locali
el          contiene indirizzo dell'elemento trovato altrimenti NULL             Tmacchina
p           nuovo nodo della lista                                               Tnodo*
dato          dato da ricercare                                                  vettore di NMAX caratteri


inizio
    el=NULL
    p=first
    leggi codice targa in dato
    ricerca dato nella lista
    se el è vuoto
    allora
        scrivi "non trovato"
    altrimenti
        stampa i campi del campo macchina di el
    fse
fine

*/

void visDati(Tnodo* first){
    Tnodo* el=NULL;
    Tnodo* p=first;
    char dato[NMAX];
    leggiStr("inserisci targa",dato);
    el=rir(first,dato);
    if(el==NULL)
        printf("elemento non trovato");
    else
        stampaP(el);
}

/*
par form
p   nodo della lista   Tnodo*

inizio
    mentre nodo p!=NULL
        stampa i campi del campo macchina di p
    fmentre
fine
*/
void stampa(Tnodo *p){
    while(p!=NULL){
        stampaP(p);
        p=p->next;
    }
}
void stampaP(Tnodo *p){
    printf("%s, ",p->macchina.tg);
    printf("%s, ",p->macchina.mod);
    printf("%s, ",p->macchina.tipo);
    printf("%f, ",p->macchina.przGiorn);
    printf("%f\n",p->macchina.km);
}
/*
funzione espBin
par formali
first         primo nodo della lista     Tnodo*

var locali
fin         file                                                                 FILE*
p           nuovo nodo della lista                                               Tnodo*
dato        tipo macchina da esportare nel file binario                          vettore di NMAX caratteri

inizio
    se(first!=NULL)
        apri file binario in scrittura
        p=first
        scrivi"inserisci tipo" e leggi in dato
        mentre(lista non e finita)
            se(dato==p->macchina.tipo)
            allora
                scrivi p->macchina nel file
                trovato=true
            fse
            punta p sul prossimo nodo della lista
        fmentre
    fse
fine

*/
void espBin(Tnodo* first){
    if(first!=NULL){
        FILE* fin=fopen("file.bin","w");
        Tnodo* p=first;
        char dato[NMAX];
        bool trovato=false;
        leggiStr("inserisci tipo da esportare nel file",dato);
        while(p!=NULL){
            if(strcmp(p->macchina.tipo,dato)==0){
                fwrite(&(p->macchina),LENMAX,1,fin);
                trovato=true;
            }
            p=p->next;
        }
        fclose(fin);
        if(trovato==false)
            printf("non e presente nessuna macchina del tipo inserito");
    }else
        printf("nessun dato presente");
}

/*
funzione espBin
par formali
first         primo nodo della lista                                            Tnodo*
nuovo       contiene temporaneamente i dati di un elemento                       Tmacchina

var locali
p           nuovo nodo della lista                                               Tnodo*
corretto    ci indica se i dati in nuovo sono corretti                           bool

inizio
    corretto=true
    mentre(p!=NULL)
        se la targa è gia presente all'interno della lista
            corretto=false
        fse
        punta p al prossimo nodo della lista
    }
    se(nuovo.tipo e != da "utilitaria" e "lusso" e "confort")
    allora
        corretto=false
    fse
    ritorna il valore di corretto
fine

*/
bool contrDati(Tmacchina nuovo,Tnodo* first){
    bool corretto=true;
    Tnodo* p=first;
    while(p!=NULL){
        if(strcmp(nuovo.tg,p->macchina.tg)==0)
            corretto=false;
        p=p->next;
    }
    if(strcmp(nuovo.tipo,"utilitaria")!=0 && strcmp(nuovo.tipo,"lusso")!=0 && strcmp(nuovo.tipo,"confort")!=0)
        corretto=false;
    return corretto;
}
