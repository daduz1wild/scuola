#include "header.h"

int main()
{
    Tpersona *first=NULL;
    int m;
    do{
        m=leggiInt("Inserisci:\n1. per importare dal file\n2.per cancellare un nodo\n3. per terminare",1,3);
        switch(m){
            case 1:
                first=impDati(first);
                stampa(first);
                break;
            case 2:
                first=cancNodo(first);
                stampa(first);
                break;
        }
    }while(m!=3);
}
