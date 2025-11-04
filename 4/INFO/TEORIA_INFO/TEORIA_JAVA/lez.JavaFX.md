per fare l'es 1 il prof ha:
prima di tutto ha  creato il progetto, aperto scene builder tramite il link che si trova nella hello view del progetto. ha creato la struttura usando per l'input 
i textfield, per avviare l'azione della somma ha usato button e per la casella di output un label.
a tutti questi elementi ha dato un id.poi è andato in controller(in scene builder) che si trova a sinistra e ha impostato l'url. poi vai su view->show 
semple controller e copi in controller tutto il codice cancellando quello che c'era prima.sotto a questo codice copiato fai i metodin subito sotto
(sempre nel comntroller) e in questo il prof ha fatto questo:

    public void onBtnSommaClick(){
        int somma = Integer.parseInt(txtNum1.getText()) + 		Integer.parseInt(txtNum2.getText());
        lblSomma.setText(String.valueOf(somma));
    }

descrizione: come vedi crea una variabile somma che ti servirà poi per l'output.
usi il parse int che fa parte della classe Integer, perché il dato inserito in inpuit è una stringa quindi devi convertirlo. txt.num1 e 2 sono gli id delle
 textfield. .text serve per estrapolare il dato dalla textfield ultima cosa .setText serve per inserire un valore in questo caso nella label.
usando String.valueof perché il valore in output deve essere stringa.

