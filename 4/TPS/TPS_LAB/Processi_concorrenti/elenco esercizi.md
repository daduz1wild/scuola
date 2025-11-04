h
Ah, capisco! Ecco il tuo primo messaggio con il codice formattato correttamente, in modo che tu possa copiarlo e incollarlo senza che esca storto:

---

**Realizzare un programma che chiede in input un valore intero all'utente; generare in seguito una biforcazione. Il processo padre stampa tutti i divisori di quel numero, il processo figlio stampa il cubo del numero.**

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>
#include <sys/wait.h>

int main()
{
    int n, pid;
    printf("Inserisci numero: ");
    scanf("%d", &n);
    pid = fork();
    if(pid == 0){
        //stampa cubo
    }
}
```

---

**Realizzare un programma che chiede in input un valore intero all'utente; generare in seguito una biforcazione. Il processo padre stampa tutti i divisori di quel numero, il processo figlio stampa il cubo del numero.**

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>
#include <sys/wait.h>

int main()
{
    int n, pid;
    printf("Inserisci numero: ");
    scanf("%d", &n);
    pid = fork();
    if(pid == 0){
        //stampa cubo
        printf("PF: potenza= %d", pow(n, 3));
        exit(1);
    }else{
        //stampa divisori
        for(int i = 1; i<=(n/2);i++)
        {
            if(n%i == 0)
                printf("%d, ", i);
        }
        printf("%d\n", n);
        exit(0);
    }
}
```

---

**Realizzare un programma che chiede in input 4 valori all'utente; generare in seguito una biforcazione. Il processo padre effettua stampa il maggiore, il processo figlio stampa la media dei valori.**

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>
#include <sys/wait.h>

int main()
{
    int numeri[4];
    int pid;
    for(int i = 0; i<4; i++)
    {
        printf("Inserisci n%d: ", (i+1));
        scanf("%d", &numeri[i]);
    }
    if(pid == 0){
        float media = 0;
        for(int i = 0; i<4; i++)
            media += numeri[i];
        media /= 4.0;
        printf("PF: media = %f", media);
        exit(1);
    }
    else{
        int magg = numeri[0];
        for(int i = 1; i<4; i++)
            if(numeri[i] > magg)
                magg = numeri[i];
        printf("PP: maggiore = %d", magg);
        exit(0);
    }
}
```

---

**Realizzare un programma che chiede in input una parola. Generare 2 processi figli. Il primo processo stampa la parola sostituendo le vocali con il simbolo '*' Il secondo processo stampa la lunghezza della parola; Il processo padre scrive su un file di testo la parola.**

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>
#include <sys/wait.h>

int main()
{
    int pid1, pid2;
    char str[100];
    printf("Inserisci la parola");
    scanf("%s", str);
    pid1 = fork();
    if(pid1 == 0)
    {
        for(int i = 0; str[i] != '\0'; i++){
            if(str[i] == 'a' || str[i] == 'e' || str[i] == 'i' || str[i] == 'o' || str[i] == 'u')
                str[i] = '*';
        }
        printf("PF1: parola modificata: %s\n", str);
        exit(1);
    }else{
        pid2 = fork();
        if(pid2 == 0)
        {
            int i = 0;
            for(i = 0; str[i] != '\0'; i++);
            printf("PF2: la lunghezza della parola e': %d", i);
            //string.h -> length(str)
            exit(2);
        }else{
            printf("PP: parola: %s\n", str);
            exit(0);
        }
    }
}
```

---

**Creare un programma che generi 4 processi figli. Per ogni figlio chiedere in input un tempo di attesa in secondi. Il processo padre attenderà il processo con attesa MAGGIORE.**

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <math.h>
#include <sys/wait.h>

int main()
{
    int attese[4], pid[4], posMagg, magg;
    for(int i = 0; i<4; i++)
    {
        printf("Inserisci attesa %d: ", (i+1));
        //controllo attesa
        scanf("%d", &attese[i]);
    }
    magg = attese[0];
    for(int i = 1; i<4; i++)
        if(attese[i] > magg){
            magg = attese[i];
            posMagg = i;
        }
    pid[0] = fork();
    if(pid[0] == 0)
    {
        sleep(attese[0]);
        printf("Ciao sono il figlio con pid %d: mio padre: %d\n", getpid(), getppid());
        exit(1);
    }else{
        pid[1] = fork();
        if(pid[1] == 0)
        {
            sleep(attese[1]);
            printf("Ciao sono il figlio con pid %d: mio padre: %d\n", getpid(), getppid());
            exit(1);
        }else{
            pid[2] = fork();
            if(pid[2] == 0)
            {
                sleep(attese[2]);
                printf("Ciao sono il figlio con pid %d: mio padre: %d\n", getpid(), getppid());
                exit(1);
            }else{
                pid[3] = fork();
                if(pid[3] == 0)
                {
                    sleep(attese[3]);
                    printf("Ciao sono il figlio con pid %d: mio padre: %d\n", getpid(), getppid());
                    exit(1);
                }else{
                    int stato;
                    int pidW = waitpid(pid[posMagg], &stato, 0);
                    printf("Ciao sono il processo padre con pid %d", getpid());
                    printf("Il figlio che ho atteso e': %d con stato %d", pidW, stato);
                    exit(0);
                }
            }
        }
    }
}
```

---

Ecco la parte finale del tuo messaggio, riformattata correttamente per essere copiata e incollata senza problemi:

```c
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>

int main()
{
    int pid1, pid2, pid3, pidA, stato;
    pid1 = fork();
    if(pid1 == 0){
        //ramo figlio 1
        for(int i = 0; i<1000000000; i++)
        {
            int n = 1;
        }
        printf("Sono il figlio 1\n");
        printf("PF: il mio pid e': %d - mio padre: %d\n", getpid(), getppid());
        exit(1);
    }
    else{
        //ramo padre
        pid2 = fork();
        if(pid2 == 0){
            //ramo figlio 2
            
            for(int i = 0; i<500000000; i++){
                
            }
            printf("Sono il figlio 2\n");
            printf("PF: il mio pid e': %d - mio padre: %d\n", getpid(), getppid());
            exit(2);
        }
        else{
            //ramo padre
            pid3 = fork();
            if(pid3 == 0){
                //ramo figlio 3
             
                printf("Sono il figlio 3\n");
                printf("PF: il mio pid e': %d - mio padre: %d\n", getpid(), getppid());
                exit(3);
            }
            else
            {
                //ramo padre
                pidA = wait(&stato);
                printf("Sono il padre\n");
                printf("Ho atteso mio figlio con PID: %d che e' terminato con: %d", pidA, stato);
                exit(0);
            }
        }
    }
}
```

---

```c
/******************************************************************************

                            Online C Compiler.
                Code, Compile, Run and Debug C program online.
Write your code in this editor and press "Run" button to compile and execute it.

*******************************************************************************/

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

void creaFiglio();

int main()
{
    int numF;
    printf("Numero figli: ");
    scanf("%d", &numF);
    for(int i = 0; i<numF; i++)
        creaFiglio();
    return 0;
}

void creaFiglio(){
    int pid = fork();
    if(pid == 0){
        //ramo figlio
        printf("PF: sono il processo figlio %d - PP: %d\n", getpid(), getppid());
        //exit(1);
    }
    else
    {
        //ramo padre
        sleep(2);
        printf("PP: sono il processo padre %d - PP: %d - PF: %d\n", getpid(), getppid(), pid);
        //exit(0);
    }
}
```

Ora puoi copiare e incollare tutto correttamente! Se hai altre richieste o hai bisogno di modifiche, fammi sapere.

