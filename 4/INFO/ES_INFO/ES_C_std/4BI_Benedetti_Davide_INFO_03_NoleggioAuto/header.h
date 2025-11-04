///HEADER


#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#define NMAX 25
#define LENMAX 250

typedef struct{
    char tg[NMAX];
    char mod[NMAX];
    char tipo[NMAX];
    float przGiorn;
    float km;
}Tmacchina;

typedef struct{
    Tmacchina macchina;
    struct Tnodo* next;
}Tnodo;

float leggiFloat(char* msg,int vmin,int vmax);
int leggiInt(char* msg,int vmin,int vmax);
void leggiStr(char* msg,char *s);
char leggiChar(char* msg);
Tnodo* imp(Tnodo* f);
Tnodo* rir(Tnodo* first,char* dato);
void calcGuadagno(Tnodo* first);
void visDati(Tnodo* first);
void stampa(Tnodo *p);
void stampaP(Tnodo *p);
void espBin(Tnodo* first);
bool contrDati(Tmacchina nuovo,Tnodo* first);
