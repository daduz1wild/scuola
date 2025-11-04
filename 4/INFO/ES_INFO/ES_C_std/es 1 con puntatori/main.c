#include "header.h"
int main()
{
    float *voti;
    int numVoti;
    numVoti=leggiInt("inserire numero voti\n",1,NMAX);
    voti=(int *) malloc(sizeof(int)*numVoti);
    caricaVoti(voti,numVoti);
    stampaVoti(voti,numVoti);
    printf("\n\nMedia: %.2f" , mediaVoti(voti,numVoti));
    return 0;
}
