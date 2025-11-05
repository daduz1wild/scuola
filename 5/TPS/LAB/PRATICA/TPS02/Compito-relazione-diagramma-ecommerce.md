## Relazione sul Diagramma di Contesto

Il diagramma di contesto rappresenta il sistema e le sue interazioni con gli attori esterni.  
Nel nostro caso, il sistema è una **piattaforma di e-commerce** che permette ai clienti di visualizzare e acquistare prodotti, e al personale di gestire le varie funzionalità interne.

Gli **attori** principali e secondari sono i seguenti:

1. **Cliente non registrato**
    
2. **Cliente registrato**
    
3. **Dipendente** (attore secondario)
    
4. **Admin**
    
5. **Sistema bancario** (attore secondario)
    

I **casi d’uso** principali del sistema sono:

- Registrazione
    
- Visualizzazione catalogo
    
- Login
    
- Acquisto prodotto
    
- Gestione account
    
- Rimborso prodotto
    
- Assistenza cliente
    
- Gestione catalogo
    
- Gestione personale
    

---

### Descrizione degli attori e delle loro interazioni

**1. Cliente non registrato**  
Il cliente non registrato ha un accesso limitato al sistema.  
Può:

- **Visualizzare il catalogo** dei prodotti;
    
- **Registrarsi** tramite il caso d’uso “Registrazione” per creare un account ed ottenere funzionalità aggiuntive.
    

Non può acquistare né gestire un account fino al completamento della registrazione e del login.

---

**2. Cliente registrato**  
Il cliente registrato ha accesso alle funzioni principali del sistema.  
Può:

- **Effettuare il login** per accedere alla propria area personale;
    
- **Visualizzare il catalogo** dei prodotti;
    
- **Acquistare prodotti**, interagendo con il **sistema bancario** per la gestione del pagamento;
    
- **Gestire il proprio account**, modificando dati personali o impostazioni;
    
- **Richiedere un rimborso prodotto**, caso in cui è coinvolto anche il **sistema bancario** per la restituzione del denaro;
    
- **Contattare l’assistenza cliente**, che coinvolge il **dipendente** come attore secondario.
    

---

**3. Dipendente (attore secondario)**  
Il dipendente interviene principalmente in fase di **assistenza cliente**, fornendo supporto e risolvendo eventuali problemi segnalati dai clienti.  
Può inoltre:

- **Effettuare il login** per accedere all’area riservata del personale;
    
- **Gestire account**, ad esempio verificando o modificando le informazioni relative ai clienti o alle richieste di assistenza.
    

Il suo ruolo è di supporto e gestione operativa, non direttamente legato alle vendite.

---

**4. Admin**  
L’amministratore è l’attore con il livello di accesso più elevato.  
Può:

- **Effettuare il login** al sistema;
    
- **Gestire il catalogo**, aggiungendo, modificando o eliminando prodotti;
    
- **Gestire il personale**, creando o modificando gli account dei dipendenti;
    
- **Gestire gli account**, supervisionando quelli dei clienti o dei dipendenti.
    

Il suo compito principale è mantenere il corretto funzionamento del sistema e coordinare le attività del personale.

---

**5. Sistema bancario (attore secondario)**  
Il sistema bancario è un attore esterno che interagisce con la piattaforma in due casi specifici:

- Durante l’**acquisto di un prodotto**, per gestire il pagamento;
    
- Durante un **rimborso prodotto**, per restituire l’importo al cliente.