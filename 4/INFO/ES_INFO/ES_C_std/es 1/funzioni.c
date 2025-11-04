#include "header.h"

void leggiFrase(char *s){
    leggiStr("\inserisci frase\n",s);
}

void conta(char *s){
    int lun;
    int voc=0,cons=0;
    lun=strlen(s);
    for(int i=0;i<lun;i++){
        if(*(s+i)=='a'||*(s+i)=='e' ||*(s+i)=='i'||*(s+i)=='o'||*(s+i)=='u'||*(s+i)=='A'||*(s+i)=='E'||*(s+i)=='I'||*(s+i)=='O'||*(s+i)=='U')
            voc=voc+1;
        else
            cons=cons+1;
    }
    printf("le vocali sono %d invece le consonanti sono %d",voc ,cons);
}

void stampaContr(char *s){
    int lun;
    lun=strlen(s);
    for(int i=lun;i>=0;i--)
        printf("%c",*(s+i));
}

void sostVoc(char *s){
    char sost[LENMAX];
    int lun;
    lun=strlen(s);
    for(int i=0;i<=lun;i++){
        *(sost+i)=*(s+i);
        if(*(s+i)=='a'||*(s+i)=='e' ||*(s+i)=='i'||*(s+i)=='o'||*(s+i)=='u'||*(s+i)=='A'||*(s+i)=='E'||*(s+i)=='I'||*(s+i)=='O'||*(s+i)=='U')
            *(sost+i)='-';
    }
    printf("la frase e diventata %s\n",sost);
}
void contaCar(char *s){
    char find;
    int lun;
    int nR=0;
    lun=strlen(s);
    find=leggiChar("inserisci carattere da ricercare\n");
    for(int i=0;i<=lun;i++){
        if(*(s+i)==find)
           nR++;
    }
    printf("\nil carattere %c e stato trovato %d volte/a\n",find,nR);
}
