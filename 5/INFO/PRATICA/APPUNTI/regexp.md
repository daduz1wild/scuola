il lookahead positivo non mi brucia caratteri della stringa hde sto analizzando. quindi nel controlloo di una password. quindi se uso la sintassi ?=.+(significa che almeno 1 o piu caratteri devono essere del tipo indicato).

il fatto che non bruci significa che non e come la regex normale che si basa sull'ordine della sintassi quando la richiamavi ma semplicemente indichi che in tuta la stringa ci dovra essere almeno un certo carattere e altri, poi alla fine indichi il numero di caratteri minimi .

rejexp in java devi creare l'ogetto pattern

pattern.compile, è un ogetto a cui devi offire quale vuoi che sia loa composizione della stringa(parametro stringa), poi pattern.matcher.group restituisce una stringa alla volta