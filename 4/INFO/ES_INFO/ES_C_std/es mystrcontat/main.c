#include "header.h"

int main()
{
    char s1[LENMAX],s2[LENMAX];
    char *strconcat;
    leggiStr("Inserisci prima frase\n",s1);
    leggiStr("\nInserisci seconda frase\n",s2);
    strconcat=mystrconcat(s1,s2);
    printf("%s\n", strconcat);
    return 0;
}

