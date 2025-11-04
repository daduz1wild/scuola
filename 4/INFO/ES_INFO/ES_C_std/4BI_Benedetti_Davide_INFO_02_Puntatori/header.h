#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <limits.h>
#include <stdbool.h>

#define NMAX 100
#define LENMAX 250
typedef struct {
    char nom[LENMAX];
    char cognom[LENMAX];
    int eta;
    Tpersona *next;
}Tpersona;

int leggiInt(char msg[],int vmin,int vmax);
float leggiFloat(char msg[],int vmin,int vmax);
char leggiChar(char *msg);
void leggiStr(char *msg,char *s);
void imp(giochi *Tgiochi);
void stampa(giochi *Tgiochi);
void stampaCat(giochi *Tgiochi, int n);
int contaRighe();
bool controllaRiga(giochi *Tgiochi,int n);
void valEcon(giochi *Tgiochi,int n);
void cercaID(giochi *Tgiochi,int n);
void modCosto(giochi *Tgiochi,int n);
void stampaF(giochi Tgiochi,int n);
void stampaClasse(giochi *Tgiochi,int n);
void inizializzaFile();
