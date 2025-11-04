#include "header.h"

void calcIBM(sPersona *p,int *n){
    n=leggiInt("inserisci numero degli IBM da conoscere\n",0,30);
    p=(sPersona*)malloc((*n)*sizeof(sPersona));
    for(int i=0;i<*n;i++){
        (p+i)->altezza=leggiFloat("inserisci altezza in metri\n",0.2,3);
        (p+i)->peso=leggiFloat("inserisci peso\n",1,400);
        (p+i)->IBM=(p+i)->peso/((p+i)->altezza*(p+i)->altezza);
        if((p+i)->IBM<18.5)
            strcpy((p+i)->classe,"sottopeso");
        if((p+i)->IBM>=18.5 && (p+i)->IBM<25)
            strcpy((p+i)->classe,"normopeso");
        if((p+i)->IBM>=25 && (p+i)->IBM<30)
            strcpy((p+i)->classe,"sovrapeso");
        if((p+i)->IBM>=30 && (p+i)->IBM<35)
            strcpy((p+i)->classe,"obeso");
        if((p+i)->IBM>=35)
            strcpy((p+i)->classe,"estremamente obeso");
        printf("%s\n",(p+i)->classe);
    }
}
void espSott(sPersona *p,int *n){
    int s=0;
    FILE *fin=fopen("sott.txt","a");
    if(fin!=NULL){
        for(int i=0;i<*n;i++){
            if(strcmp((p+i)->classe,"sottopeso")==0){
                fprintf(fin,"%.2f %.2f\n",(p+i)->altezza,(p+i)->peso);
                s++;
            }
        }
        fprintf(fin,"il numero di persone sovrappeso e %d\n",s);
    }
}


