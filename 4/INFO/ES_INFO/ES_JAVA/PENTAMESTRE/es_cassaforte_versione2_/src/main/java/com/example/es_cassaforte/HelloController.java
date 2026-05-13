package com.example.es_cassaforte;

import javafx.application.Platform;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import java.net.URL;
import java.util.LinkedList;
import java.util.ResourceBundle;

import static java.lang.Double.parseDouble;

public class HelloController implements Initializable {
    Cassaforte c;
    LinkedList<Operazione> coda;

    @FXML
    private Button btnAvvia;
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
        coda.addLast(o);
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
        coda.addLast(o);
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
            System.out.println(o);
        });
    }
    public void onBtnAvvia(){
        for(Operazione o: coda){
            o.start();
        }
    }

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        c=new Cassaforte();
        coda=new LinkedList<>();

    }
}