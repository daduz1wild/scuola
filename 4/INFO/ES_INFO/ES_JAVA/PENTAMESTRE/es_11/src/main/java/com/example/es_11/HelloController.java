package com.example.es_11;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

public class HelloController {

    @FXML
    private Button btnSomma;

    @FXML
    private Label lblSomma;

    @FXML
    private TextField txtNum1;

    @FXML
    private TextField txtNum2;

    public void onBtnSommaClick(){
        int somma = Integer.parseInt(txtNum1.getText()) + Integer.parseInt(txtNum2.getText());
        lblSomma.setText(String.valueOf(somma));
    }


}
