package com.example.es_12_javafx;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.paint.Color;
import javafx.scene.shape.Circle;

public class HelloController {

    private Lamp lamp;

    @FXML
    private Button btnCancel;

    @FXML
    private Button btnLum;

    @FXML
    private Button btnNewLamp;

    @FXML
    private Button btnOff;

    @FXML
    private Button btnOn;

    @FXML
    private Button btnRGB;

    @FXML
    private Circle crcLamp;

    @FXML
    private Label lblError;

    @FXML
    private TextField txtB;

    @FXML
    private TextField txtG;

    @FXML
    private TextField txtLum;

    @FXML
    private TextField txtNome;

    @FXML
    private TextField txtR;

    public void btnNewLampOnClick(){
        try {
            lamp = new Lamp(txtNome.getText());
            setDisable(false);
        }catch(NullPointerException | IllegalStateException e){
            System.out.println(e.getMessage());
        }
    }
    private void setDisable(boolean dis){
        btnOn.setDisable(dis);
        btnOff.setDisable(dis);
        txtLum.setDisable(dis);
        btnLum.setDisable(dis);
        txtR.setDisable(dis);
        txtG.setDisable(dis);
        txtB.setDisable(dis);
        btnRGB.setDisable(dis);
        btnCancel.setDisable(dis);
    }
    public void onBtnSetOn(){
        try {
            lamp.accLamp();
            crcLamp.setVisible(true);
        }catch(IllegalArgumentException e){
            System.out.println(e.getMessage());
        }
    }
    public void onBtnSetOff(){
        try{
            lamp.spegnLamp();
            crcLamp.setVisible(false);
        }catch(IllegalArgumentException e){
            lblError.setText(e.getMessage());
        }
    }
    public void onBtnSetLum(){
        try {
            lamp.setLum(Integer.parseInt(txtLum.getText()));
            crcLamp.setOpacity((double) lamp.getLum() / 5);
        }catch(NumberFormatException | IllegalStateException e) {
            lblError.setText(e.getMessage());
        }
    }
    public void onBtnSetRGB(){
        try {
            lamp.setRGB(Integer.parseInt(txtR.getText()), Integer.parseInt(txtG.getText()), Integer.parseInt(txtB.getText()));
            crcLamp.setFill(Color.rgb(lamp.getR(), lamp.getG(), lamp.getB()));
        }
        catch(NumberFormatException | IllegalStateException e){
            lblError.setText(e.getMessage());
        }
    }
    public void onBtnCancelLamp(){
        try {
            lamp = null;
            setDisable(true);
            crcLamp.setVisible(false);
        }catch(Exception e){
            lblError.setText(e.getMessage());
        }
    }
}
