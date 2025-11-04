#include "header.h"
/*
Davide Benedetti  3BI  18/09/2024

Realizzare un programma contenente un menu in cui sono presenti I seguenti punti:
1.	Chiedere in input una frase all’utente;
2.	Contare il numero di vocali e consonanti di cui è composta quella frase;
3.	Stampare la frase al contrario;
4.	Sostituire le vocali con il simbolo “-” e stampare il risultato
5.	Dato un carattere chiesto in input, contare quante volte è presente quel carattere nella frase
*/
int main()
{
    char str[LENMAX];
    int m;
    do{
        m=leggiInt("\nInserisci:\n1. per inserire una frase\n2. contare numero di vocali e consonannti nella frase\n3. stampare la frase al contarrio\n4. Sostituire le vocali con il simbolo - e stampare il risultato\n5. Dato un carattere chiesto in input, contare quante volte e presente quel carattere nella frase\n6. termina\n", 1,6);
        switch(m){
        case 1:
            leggiFrase(str);
            break;
        case 2:
            conta(str);
            break;
        case 3:
            stampaContr(str);
            break;
        case 4:
            sostVoc(str);
            break;
        case 5:
            contaCar(str);
        }
    }while(m!=6);
    return 0;
}
