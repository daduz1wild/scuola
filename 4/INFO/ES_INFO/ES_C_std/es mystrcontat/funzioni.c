#include "header.h"

char *mystrconcat(char *s,char *sC){
    int q;
    int lun1=strlen(s);
    int lun2=strlen(sC);
    char *sConcat=(char *)malloc(lun1+lun2+1);
    for(int i=0;*(s+i)!='\0';i++){
        *(sConcat+i)=*(s+i);
        q=i;
    }
    for(int i=0;*(sC+i)!='\0';i++){
        *(sConcat+q)=*(sC+i);
        q++;
    }
    return sConcat;
}
