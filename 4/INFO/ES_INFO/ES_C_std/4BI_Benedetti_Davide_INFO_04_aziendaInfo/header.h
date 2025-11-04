///HEADER


#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#define NMAX 25
#define LENMAX 250

typedef struct Tdipendente{
    char codFis[NMAX];
    char nome[NMAX];
    char cognome[NMAX];
    char ruolo[NMAX];
    float stip;
}Tdipendente;

typedef struct Tnodo{
    Tdipendente dipendente;
    struct Tnodo* next;
}Tnodo;

float leggiFloat(char* msg,int vmin,int vmax);
int leggiInt(char* msg,int vmin,int vmax);
void leggiStr(char* msg,char *s);
char leggiChar(char* msg);
Tnodo* imp(Tnodo* first);
bool contrDati(Tdipendente n,Tnodo* first);
void stampa(Tnodo* first);
void stampaP(Tnodo* p);
Tnodo* rir(Tnodo* first,char *dato);
void datiDip(Tnodo* first);
void modStip(Tnodo* first);
void costoStip(Tnodo* first);
void espRuolo(Tnodo* first);
Tnodo* cancEl(Tnodo* first);
Tnodo* cancMargStip(Tnodo* first);
