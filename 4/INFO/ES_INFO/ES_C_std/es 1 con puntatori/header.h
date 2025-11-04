#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define NMAX 10

float leggiFloat(char msg[],int vmin,int vmax);
int leggiInt(char msg[],int vmin,int vmax);
void leggiStr(char msg[],char *s);
void caricaVoti(float *v,int nV);
float mediaVoti(float *v,int nV);
void stampaVoti(float *v,int nV);
