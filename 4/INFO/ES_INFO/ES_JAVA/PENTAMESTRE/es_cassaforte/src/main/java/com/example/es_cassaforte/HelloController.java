package com.example.es_cassaforte;

import javafx.application.Platform;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import static java.lang.Double.parseDouble;

public class HelloController {
    Cassaforte c;
    @FXML
    private Button btnDep;

    @FXML
    private Label lblSaldo;

    @FXML
    private Button btnPrel;

    @FXML
    private Label lblStato;

    @FXML
    private TextField txtImporto;
    @FXML
    void onBtnDep(ActionEvent event) {
        double importo=parseDouble(txtImporto.getText());
        txtImporto.setText("");
        Operazione o=new Operazione( c,false, importo,HelloController.this);
        o.start();
    }

    @FXML
    void onBtnPrel(ActionEvent event) {
        double importo=parseDouble(txtImporto.getText());
        txtImporto.setText("");
        Operazione o=new Operazione( c,true, importo,HelloController.this);
        /*o.setUncaughtExceptionHandler(new Thread.UncaughtExceptionHandler() {
            @Override
            public void uncaughtException(Thread t, Throwable e) {

            }
        });*/
        o.start();
    }
    @FXML
    public void initialize(){
        c=new Cassaforte();
    }
    public void aggiornaDati(Operazione o,boolean suc){
        Platform.runLater(()->{
                if(o.isPrelievo() && suc)
                    lblStato.setText("prelievo: " + Double.toString(o.getImporto()) + " (successo)");
                else if(o.isPrelievo() && !suc)
                    lblStato.setText("prelievo: " + Double.toString(o.getImporto()) + " (insuccesso)");
                else if(!o.isPrelievo() && suc)
                    lblStato.setText("deposito: " + Double.toString(o.getImporto()) + " (successo)");
                else if(!o.isPrelievo() && !suc)
                    lblStato.setText("deposito: " + Double.toString(o.getImporto()) +" (insuccesso)");
                lblSaldo.setText(Double.toString(c.getSaldo()));
        });
    }
}