#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define NMAX 30
#define LENMAX 250

typedef struct Tpersona{
    char nome[NMAX];
    char cognome[NMAX];
    int eta;
    struct Tpersona *next;
}Tpersona;

float leggiFloat(char msg[],int vmin,int vmax);
int leggiInt(char msg[],int vmin,int vmax);
void leggiStr(char msg[],char *s);
char leggiChar(char *msg);
Tpersona *impDati(Tpersona *first);
void stampaP(Tpersona *p);
void stampa(Tpersona *persona);
Tpersona *cancNodo(Tpersona *persona);
Tpersona *rir(Tpersona *first,char *nome,char *cognome);
