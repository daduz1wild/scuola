#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

int main() {
    int num1, num2;
    printf("Inserisci il primo numero: ");
    scanf("%d", &num1);
    printf("Inserisci il secondo numero: ");
    scanf("%d", &num2);
    pid_t pid = fork();
    if (pid < 0) {
        perror("Errore nella creazione del processo");
    } else if (pid == 0) {
        printf("Processo Figlio [PID: %d]: Il prodotto è %d\n", getpid(), num1 * num2);
    } else {
        printf("Processo Padre [PID: %d]: La somma è %d\n", getpid(), num1 + num2);
    }
    return 0;
}