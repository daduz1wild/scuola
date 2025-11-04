#include "header.h"

void leggiStr(char *msg,char *s){
    printf("%s",msg);
    do{
        gets(s);
        if(strcmp(s,"")==0)
            printf("errore,reinserire");
    }while(strcmp(s,"")==0);
}

int leggiInt(char msg[],int vmin,int vmax){
    int n;
    printf("%s",msg);
    do{
        scanf("%d",& n);
        if(n<vmin || n>vmax)
            printf("errore,reinserire");
    }while(n<vmin || n>vmax);
    fflush(stdin);
    return n;
}

float leggiFloat(char msg[],int vmin,int vmax){
    float n;
    printf("%s",msg);
    do{
        scanf("%f",& n);
        if(n<vmin || n>vmax)
            printf("errore,reinserire");
    }while(n<vmin || n>vmax);
    return n;
}
char leggiChar(char *msg){
    char s;
    printf("%s",msg);
    do{
        scanf("%c",& s);
        if(s=='\0')
            printf("\nerrore,reinserire\n");
    }while(s=='\0');
    return s;
}
