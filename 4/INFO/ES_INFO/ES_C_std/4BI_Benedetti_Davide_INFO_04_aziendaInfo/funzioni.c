///FUNZIONI


#include "header.h"

//Davide Benedetti 4BI



/*
descrizione file .csv
il file nomeF contiene un elemento per riga, con i dati separati da ";"
esempio:
FD098;Fabio;Daini;sistemista;1900;

funzione imp

par formali
first                   primo nodo della lista                                                  Tnodo*

var locali
fin                     file                                                                    FILE*
nuovo                   contiene temporanemanete i dati di un elemento                          Tdipendente
p                       nuovo nodo della lista                                                  Tnodo*
corretto                ci indica se i dati sono corretti                                       bool
riga                    contiene una riga del file                                              vettore di LENMAX caratteri
nomeF                   nome del file                                                           vettore di NMAX caratteri
nodo                     puntatore per muoversi all'interno della lista                         Tnodo*

inizio
    leggi nome del file in nomeF
    apri il file nomeF in input
    corretto=true
    se il file è stato aperto
    allora
        leggi la prima riga del file in riga
        mentre file non e finito
            spezza riga fra i suoi token
            assegna i token ai campi del record nuovo nel seguente ordine: codFis,nome,cognome,ruolo;stipendio,
            se nuovo.codFis non e univoco
                corretto=false
            fse
            se nuovo.ruolo!=("programmatore", "sistemista", "formatore")
                corretto=false
            fse
            se(corretto!=false)
                istanzia uno spazio per il puntatore p pari alla misura in byte di una struttura Tdipendente
                p->dipendente=nuovo
                p->next=NULL
                se(first==NULL)
                allora
                    first=p
                altrimenti
                    nodo=first
                    prec=NULL
                    mentre(p->dipendente.codFis>nodo->dipendente.codFis && nodo!=NULL)
                            prec=p
                            nodo=nodo->next
                    fmentre
                    se(nodo==first)
                    allora
                        p->next=first
                        first=p
                    altrimenti
                        prec->next=p
                        p->next=nodo
                    fse
                fse
            fse
        fmentre
    altrimenti
        scrivi "file non trovato"
    fse
    ritorna first
fine

*/
Tnodo* imp(Tnodo* first){
    char nomeF[NMAX],riga[NMAX];
    FILE* fin;
    Tdipendente nuovo;
    Tnodo* p=NULL;
    leggiStr("inserisci nome file",nomeF);
    fin=fopen(nomeF,"r");
    if(fin!=NULL){
        fgets(riga,LENMAX,fin);
        while(!feof(fin)){
            strcpy(nuovo.codFis,strtok(riga,";"));
            strcpy(nuovo.nome,strtok(NULL,";"));
            strcpy(nuovo.cognome,strtok(NULL,";"));
            strcpy(nuovo.ruolo,strtok(NULL,";"));
            nuovo.stip=atof(strtok(NULL,";"));
            if(contrDati(nuovo,first)){
                p=(Tnodo*)malloc(sizeof(Tnodo));
                p->dipendente=nuovo;
                p->next=NULL;
                if(first==NULL){
                    first=p;
                }else{
                    Tnodo* nodo=first;
                    Tnodo* prec=NULL;
                    while(nodo!=NULL && strcmp(p->dipendente.codFis,nodo->dipendente.codFis)>0){
                            prec=nodo;
                            nodo=nodo->next;
                    }
                    if(nodo==first){
                        p->next=first;
                        first=p;
                    }else{
                        prec->next=p;
                        p->next=nodo;
                    }
                }
            }
            fgets(riga,LENMAX,fin);
        }
        fclose(fin);
    }else
        printf("file non trovato");
    return first;
}
/*
funzione contrDati

par. form.
first              primo nodo della lista                                                           Tnodo*
n                  nuovo elemento da controllare                                                    Tdipendente

var. locali
p                       puntatore per muoversi fra i nodi della lista                               Tnodo*

inizio
    p=first
    mentre(p!=NULL && corretto)
        se codFis del nuovo elemento è uguale a codFis del nodo p
        allora
            corretto=false
        fse
        p=p->next
    fmentre
    se ruolo !="programmatore" && "sistemista" && "formatore"
    allora
        corretto=false
    fse
    ritorna corretto
fine

*/
bool contrDati(Tdipendente n,Tnodo* first){
    Tnodo* p=first;
    bool corretto=true;
    while(p!=NULL && corretto){
        if(strcmp(n.codFis,p->dipendente.codFis)==0)
            corretto=false;
        p=p->next;
    }
    if(strcmp(n.ruolo,"programmatore")!=0 && strcmp(n.ruolo,"sistemista")!=0 && strcmp(n.ruolo,"formatore")!=0)
        corretto=false;
    return corretto;
}
/*
procedura stampa

par. form.
p                   puntatore per muoversi fra i nodi della lista                                      Tnodo*

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        mentre(p!=NULL)
            stampa i campi del campo dipendente di p: codFis,nome,cognome,ruolo,stip
            p=p->next
        fmentre
    altrimenti
        scrivi "nessun dato presente
    fse
fine

*/
void stampa(Tnodo* first){
    if(first!=NULL){
        Tnodo* p=first;
        while(p!=NULL){
            stampaP(p);
            p=p->next;
        }
    }else
        printf("nessun dato presente");

}
/*
procedura stampaP

par. form.
p                   nodo da stampare                                                                    Tnodo*

inizio
     stampa i campi del campo dipendente di p: codFis,nome,cognome,ruolo,stip
fine
*/
void stampaP(Tnodo* p){
    printf("%s, ",p->dipendente.codFis);
    printf("%s, ",p->dipendente.nome);
    printf("%s, ",p->dipendente.cognome);
    printf("%s, ",p->dipendente.ruolo);
    printf("%f\n",p->dipendente.stip);
}
/*
procedura datiDip

par. form.
first               primo nodo della lista                                              Tnodo*

var. locali
dato                cod. fiscale da ricercare                                           vettore di NMAX caratteri
p                  puntatore per muoversi fra i nodi della lista                        Tnodo*
el                  contiene indirizzo del nodo se trovato, altrimenti NULL             Tnodo*

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        leggi codice fiscale da ricercare in dato
        cerca dato fra i nodi della lista e se lo trovi inserisci l'indirizzo in el
        se(el!=NULL)
        allora
            stampa i campi del campo dipendente di el
        altrimenti
            scrivi "elemento non trovato"
        fse
    altrimenti
        scrivi "nessun dato presente"
    fse
fine
*/
void datiDip(Tnodo* first){
    if(first!=NULL){
        Tnodo* el=NULL;
        char dato[NMAX];
        leggiStr("inserisci cod. fiscale da ricercare",dato);
        el=rir(first,dato);
        if(el!=NULL)
            stampaP(el);
        else
            printf("elemento non trovato");
    }else
        printf("nessun dato presente");
}
/*
procedura modStip

par. form.
first               primo nodo della lista                                              Tnodo*

var. locali
dato                cod. fiscale da ricercare                                           vettore di NMAX caratteri
p                  puntatore per muoversi fra i nodi della lista                        Tnodo*
el                  contiene indirizzo del nodo se trovato, altrimenti NULL             Tnodo*

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        leggi codice fiscale da ricercare in dato
        cerca dato fra i nodi della lista e se lo trovi inserisci l'indirizzo in el
        se(el!=NULL)
        allora
            leggi el->dipendente.stip
        altrimenti
            scrivi "elemento non trovato"
        fse
    altrimenti
        scrivi "nessun dato presente"
    fse
fine
*/
void modStip(Tnodo* first){
    if(first!=NULL){
        Tnodo* el=NULL;
        char dato[NMAX];
        leggiStr("inserisci cod. fiscale da ricercare",dato);
        el=rir(first,dato);
        if(el!=NULL)
            el->dipendente.stip=leggiFloat("inserisci nuovo stipendio",0,10000);
        else
            printf("elemento non trovato");
    }else
        printf("nessun dato presente");
}

/*
procedura costoStip

par. form.
first               primo nodo della lista                                              Tnodo*

var. locali
p                  puntatore per muoversi fra i nodi della lista                        Tnodo*
totStip            somma di tutti gli stip                                              reale

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        totStip=0
        mentre(p!=NULL)
            totStip=totStip+p->dipendente.stip
            p=p->next
        fmentre
        stampa totStip
    altrimenti
        scrivi "nessun dato presente"
    fse
fine


*/
void costoStip(Tnodo* first){
    if(first!=NULL){
        Tnodo* p=first;
        float totStip=0;
        while(p!=NULL){
            totStip=totStip+p->dipendente.stip;
            p=p->next;
        }
        printf("%f",totStip);
    }else
        printf("nessun dato presente");
}

/*
procedura espRuolo

par. form.
first           primo nodo della lista                                          Tnodo*

var. locali
fin             file                                                            FILE*
p               nodo della lista                                                Tnodo*
dato            ruolo da esportare                                              vettore di NMAX caratteri

inizio
    se(first!=NULL)
    allora
        p=first
        apri il file binario file.bin in scrittura
        leggi dato e controlla che sia=="programmatore" o "sistemista" o "formatore"
        mentre(p!=NULL)
            se(dato==p->dipendente.ruolo)
                scrivi i campi del campo dipendente di p nel file fin con lunghezza massima LENMAX
            fse
            p=p->next
        fmentre
    altrimenti
        scrivi "nessun dato trovato"
    fse
fine
*/

void espRuolo(Tnodo* first){
    if(first!=NULL){
        Tnodo* p=first;
        char dato[NMAX];
        FILE* fin=fopen("file.bin","w");
        do{
            leggiStr("inserisci ruolo(programmatore, sistemista, formatore)",dato);
        }while(strcmp(dato,"programmatore")!=0 && strcmp(dato,"sistemista")!=0 && strcmp(dato,"formatore")!=0);
        while(p!=NULL){
            if(strcmp(dato,p->dipendente.ruolo)==0)
                fwrite(&(p->dipendente),LENMAX,1,fin);
            p=p->next;
        }
        fclose(fin);
    }else
        printf("nessun dato da esportare trovato");
}
/*
funzione rir

par. form.
first       primo nodo della lista                                              Tnodo*
dato        dato da ricercare                                                   char*

var. locali
p           nodo della lista                                                    Tnodo*
el          contiene indirizzo del nodo se trovato, altrimenti NULL             Tnodo*

inizio
    p=first
    mentre(lista non e finita && el non trovato)
        se(p->dipendente.codFis==dato)
            el=p
        fse
        p=p->next
    fmentre
    ritorna el
fine

*/
Tnodo* rir(Tnodo* first, char* dato){
    Tnodo* p=first;
    Tnodo* el=NULL;
    while(p!=NULL && el==NULL){
        if(strcmp(p->dipendente.codFis,dato)==0)
            el=p;
        p=p->next;
    }
    return el;
}
/*
procedura cancEl

par. form.
first               primo nodo della lista                                              Tnodo*

var. locali
dato                cod. fiscale da ricercare                                                    vettore di NMAX caratteri
p                   serve per ricollegare i nodi adiacenti al nodo che viene cancellato          Tnodo*
el                  contiene indirizzo del nodo se trovato, altrimenti NULL                      Tnodo*
prec                serve per ricollegare i nodi adiacenti al nodo che viene cancellato          Tnodo*

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        leggi codice fiscale da ricercare in dato
        cerca dato fra i nodi della lista e se lo trovi inserisci l'indirizzo in el
        se(el!=NULL)
        allora
            se(el==first)
            allora
                first=first->next
                cancella il nodo puntato da el
            altrimenti
                p=el
                prec=first
                mentre(prec->next!=el)
                    prec=prec->next
                fmentre
                cancella il nodo puntato da el
                prec->next=p->next
            fse
        altrimenti
            scrivi "elemento non trovato"
        fse
    altrimenti
        scrivi "nessun dato presente"
    fse
    ritorna first
fine
*/
Tnodo* cancEl(Tnodo* first){
    if(first!=NULL){
        Tnodo* el=NULL;
        char dato[NMAX];
        leggiStr("inserisci cod. fiscale dell'el. da cancellare",dato);
        el=rir(first,dato);
        if(el!=NULL){
            if(el==first){
                first=first->next;
                free(el);
            }else{
                Tnodo* p=el;
                Tnodo* prec=first;
                while(prec->next!=el)
                    prec=prec->next;
                prec->next=p->next;
                free(el);
            }
        }else
            printf("elemento non trovato");
    }else
        printf("nessun dato presente");
    return first;
}

/*
procedura cancEl

par. form.
first               primo nodo della lista                                              Tnodo*

var. locali
p                   serve per muoversi fra i nodi della lista e per riagganciare i nodi          Tnodo*
aus                 serve per eliminare un nodo inizializzandolo con l'indirizzo di esso         Tnodo*
prec                serve per ricollegare i nodi adiacenti al nodo che viene cancellato          Tnodo*
a                   intervallo minore (per ricerca stipendio)                                    reale
b                   intervallo maggiore (per ricerca stipendio)                                  reale
trovato             ci indica se abbiamo trovato almeno un el                                    bool

inizio
    se è stato creato almeno un nodo
    allora
        p=first
        trovato=false
        leggi intervallo(a,b) da ricercare e controlla che a sia <b
        se(p!=NULL)
        allora
            se(p->dipendente.stip si trova nell'intervallo)
            allora
                aus=p
                se(p==first)
                    first=first->next
                    cancella il nodo puntato da aus
                altrimenti
                    prec=first;
                    mentre(prec->next!=p)
                        prec=prec->next;
                    fmentre
                    prec->next=p->next;
                    cancella il nodo puntato da aus
                fse
                trovato=true
            fse
            p=p->next
        altrimenti
            scrivi "nessun elemento nel margine e stato trovato"
        fse
    altrimenti
        scrivi "nessun dato presente"
    fse
    ritorna first
fine
*/

Tnodo* cancMargStip(Tnodo* first){
    if(first!=NULL){
        Tnodo* p=first;
        float a,b;
        bool trovato=false;
        do{
        a=leggiFloat("inserisci intervallo a(<b e <10000)",0,10000);
        b=leggiFloat("inserisci intervallo b(>a e <10000)",0,10000);
        }while(a>b);
        while(p!=NULL){
            if(p->dipendente.stip>=a && p->dipendente.stip<=b){
                Tnodo* aus=p;
                if(p==first){
                    first=first->next;
                    free(aus);
                }else{
                    Tnodo* prec=first;
                    while(prec->next!=p)
                        prec=prec->next;
                    prec->next=p->next;
                    free(aus);
                }
                trovato=true;
            }
            p=p->next;
        }
        if(!trovato)
            printf("nessun elemento nel margine e stato trovato");
    }else
        printf("nessun dato presente");
    return first;
}
