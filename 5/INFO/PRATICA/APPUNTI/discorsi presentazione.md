

# gurvir
Intestazione • Cliente/Committente: Bonardi Andrea • Materia: Gestione progetto e organizzazione d’impresa • Anno scolastico: 2025-2026 • Gruppo: Gruppo 4 • Data: 03 Ottobre 2025 1. Introduzione Con l’entrata in vigore del nuovo decreto ministeriale che vieta l’uso di smartphone a scuola, il docente committente necessita di una soluzione alternativa che permetta comunque l’utilizzo delle piattaforme di apprendimento interattivo in classe, in particolare Kahoot, usato per coinvolgere 25 studenti. Si deve garantire che i dispositivi usati a scuola siano limitati esclusivamente a Kahoot, impedendo qualsiasi altro tipo di utilizzo o distrazione. Il progetto proposto sviluppa una soluzione basata su Raspberry Pi 4 da 4 GB, touchscreen, configurazioni software in modalità kiosk e controlli di rete per un totale di 25 unità. La soluzione integra anche istruzioni dettagliate di setup, software, blocchi di sistema e guida all’acquisto dei materiali.


# davide

Perfetto Davide 👍  
Ti preparo lo stesso discorso che avevo scritto, ma arricchito con le spiegazioni sui termini tecnici, così quando parli sembri sicuro e padrone dell’argomento. In questo modo non sembri leggere definizioni ma spieghi in modo semplice e chiaro.

---

## **Testo discorsivo con spiegazioni**

Le motivazioni che ci hanno spinto a scegliere questa soluzione sono soprattutto di tipo pratico e tecnico.  
I dispositivi Raspberry Pi hanno un costo contenuto e, in caso di guasto, sono facili da sostituire e da mantenere. Questo rende la gestione della classe molto più semplice e sostenibile nel tempo. Un altro aspetto importante è la sicurezza: con le configurazioni software e i controlli di rete integrati, i dispositivi risultano bloccati su un unico utilizzo, quello di Kahoot, evitando che vengano usati per altro. La soluzione offre inoltre molta flessibilità: i Raspberry possono essere aggiornati e adattati ad altri scopi, se in futuro dovesse servire. Infine, dal punto di vista dell’esperienza utente, l’uso del touchscreen e del browser web rende l’interazione molto simile a quella di uno smartphone, quindi immediata e intuitiva per gli studenti.

Per quanto riguarda la guida operativa, il lavoro parte dall’acquisto dei componenti presso fornitori affidabili, come The Pi Hut, Kiwi Electronics o Amazon Italia.  
Una volta pronti i dispositivi, si prepara la microSD installando **Raspberry Pi OS**, che è il sistema operativo ufficiale sviluppato apposta per Raspberry Pi. Abbiamo scelto la versione _Bookworm 64-bit_, che è l’ultima release stabile, più sicura e con software aggiornato, così i dispositivi risultano più veloci e compatibili con le versioni recenti dei programmi.

Dopo l’installazione del sistema operativo, viene creato un **utente dedicato**, che nel nostro caso chiamiamo _kiosk_. Questo significa che non si usa l’utente principale del sistema, ma uno specifico solo per la funzione di Kahoot. Questo utente è configurato per fare il login automatico al desktop senza bisogno di inserire password: in questo modo, appena il Raspberry viene acceso, parte subito la modalità d’uso senza che l’utente debba fare nulla.

A questo punto entra in gioco uno **script**, chiamato _kiosk.sh_. Uno script è un piccolo programma scritto con comandi di sistema. Nel nostro caso serve a lanciare automaticamente **Chromium**, che è il browser open source basato su Google Chrome, molto leggero e compatibile, ideale per il Raspberry. Lo script fa sì che Chromium si apra in modalità **fullscreen kiosk**, cioè a schermo intero, senza barre degli strumenti, senza possibilità di aprire nuove schede e direttamente sul sito _kahoot.it_. In pratica lo studente vede solo la pagina di Kahoot e non ha modo di uscire o navigare altrove.

Per rendere il sistema ancora più sicuro, utilizziamo **xmodmap**, un programma che permette di rimappare i tasti della tastiera. Con questo strumento vengono disabilitate tutte le scorciatoie più comuni, come Alt+F4 o Ctrl+W, che normalmente servirebbero a chiudere le finestre. In questo modo non è possibile “scappare” dall’applicazione.

Infine, un altro aspetto fondamentale riguarda la sicurezza di rete. In collaborazione con l’IT della scuola, si imposta una **whitelist**, cioè una lista di siti autorizzati. In pratica il Raspberry Pi può accedere solo a Kahoot e ai suoi server, mentre tutto il resto di internet viene bloccato dal firewall o dal DNS. Questo garantisce che il dispositivo resti completamente dedicato e non possa essere usato per altro.

Prima di installare l’intero sistema, si fa un test su un paio di dispositivi prototipo, per ricevere feedback dal docente e dagli studenti. Una volta verificato che tutto funziona correttamente, l’immagine della microSD viene clonata, cioè copiata, per replicare la configurazione su tutte le unità.  
L’ultima fase riguarda l’installazione fisica in aula, con collegamento a Wi-Fi e alimentazione, e un monitoraggio successivo per eventuali aggiornamenti o problemi tecnici.

---

👉 Questo testo puoi studiarlo così com’è e già ti fa sembrare super preparato.  
Vuoi che ti faccia anche una **scaletta semplificata** con solo i punti chiave + le parole tecniche da ricordare (così se ti scordi una parte hai subito un appiglio mentale)?

# thomas

7. Test funzionalità su 2-3 dispositivi prototipo, con feedback docente e studenti. 8. Clonazione immagine microSD per configurazione rapida su tutte le unità. 9. Installazione fisica dei dispositivi in classe, collegamento alimentazione e rete Wi-Fi istruita. 10.Monitoraggio e supporto post-implementazione per eventuali aggiornamenti o problemi. 9. Conclusioni La soluzione proposta permette di coniugare obblighi normativi e esigenze didattiche con un investimento economico misurato, una tecnologia collaudata e una progettazione dettagliata di tutti i livelli (hardware, software, rete). Il progetto ben pianificato e realizzato renderà possibile per il docente continuare a svolgere attività Kahoot in classe senza rischi di utilizzi non autorizzati o distrazioni, garantendo un ambiente digitale sicuro e controllato.
8. 