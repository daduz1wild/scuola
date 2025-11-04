#include "header.h"
void caricaVoti(float *v,int nV){
    printf("inserisci voti\n");
    for(int i=0;i<nV;i++)
        *(v+i)=leggiFloat("voto:",1,10);//praticamente dentro le parentesi io modifico l'indirizzo  quindi cambio cella invece fuori dalle parentesi c'è -* perche comunque nell0uguaglianza devo cambiare il valore del vettore
}

void stampaVoti(float *v,int nV){
    printf("voti\n");
    for(int i=0;i<nV;i++)
        printf("%.2f\n", *(v+i));
}

float mediaVoti(float *v,int nV){
    float med=0;
    for(int i=0;i<nV;i++)
        med+=*(v+i);
    return (med/nV);
}
