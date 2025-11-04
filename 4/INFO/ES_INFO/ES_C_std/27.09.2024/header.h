#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define NMAX 10
#define LENMAX 40

typedef struct{
    float peso;
    float altezza;
    float IBM;
    char classe[LENMAX];
}sPersona;

float leggiFloat(char msg[],int vmin,int vmax);
int leggiInt(char msg[],int vmin,int vmax);
void leggiStr(char msg[],char *s);
void leggiChar(char *msg);
void calcIBM(sPersona *p,int *n);
void espSott(sPersona *p,int *n);
