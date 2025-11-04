// Lamp.java

package com.example.es_12_javafx;/*
Scrivi il codice della classe Lampadina RGB. Una lampadina possiede un nome, si trova in uno
stato (on/off), possiede un livello di luminosità (da 1 a 5) e una componente RGB.
I metodi che si chiede di realizzare sono:
§ costruttore che riceve come parametro il nome della lampadina e crea una lampadina
spenta, con luminosità 1 e coi i seguenti valori RGB (255, 255, 255);
§ accendi: accende una lampadina spenta. Imposta come valori RGB (252, 255, 202);
§ spegni: spenge una lampadina accesa;
§ SetLum: imposta la luminosità della lampadina con il valore passato come parametro
§ setRGB: ha come parametri 3 valori RGB con cui verrà impostata la componente RGB della
lampadina
§ toCSV
§ FromCSV
Creare un main di prove per testare la classe Lampadina creata

        JAVAFX
Realizzare un progetto JAVAFX in grado di gestire un oggetto lampadina.
*/

public class Lamp {
    private String nome;
    private boolean stato;
    private int lum;
    private int r,g,b;
    public Lamp(String nome){
        setNome(nome);
        setStato(false);
        setLum(1);
        setRGB(255,255,255);
    }
    public void accLamp(){
        if(stato)
            throw new IllegalStateException("la lampadina è già accesa");
        else {
            stato = true;
        }
    }
    public void spegnLamp(){
        if(!stato)
            throw new IllegalStateException("la lampadina è già spenta");
        else
            stato = false;
    }
    public void setLum(int lum){
        if(lum>=1 && lum<=5)
            this.lum=lum;
        else
            throw new IllegalStateException("valore lum errato");
    }
    public void setRGB(int r,int g,int b){
        if((r>=0 && r<=255) && (g>=0 && g<=255) && (b>=0 && b<=255)){
            this.r=r;
            this.g=g;
            this.b=b;
        }else
            throw new IllegalStateException("almeno uno dei valori rgb è errato");
    }
    public void setStato(boolean stato){
        this.stato=stato;
    }
    public void setNome(String nome){
        if(!nome.isEmpty())
            this.nome=nome;
        else
            throw new IllegalStateException("valore non permesso");
    }

    public int getR() {
        return r;
    }

    public int getG() {
        return g;
    }

    public int getB() {
        return b;
    }

    public int getLum() {
        return lum;
    }
}


//HelloApplication.java

package com.example.es_12_javafx;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;

import java.io.IOException;

public class HelloApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {
        FXMLLoader fxmlLoader = new FXMLLoader(com.example.es_12_javafx.HelloApplication.class.getResource("hello-view.fxml"));
        Scene scene = new Scene(fxmlLoader.load());
        stage.setTitle("Hello!");
        stage.setScene(scene);
        stage.show();
    }

    public static void main(String[] args) {
        launch();
    }
}

//HelloController.java

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

//hello-view.fxml

<?xml version="1.0" encoding="UTF-8"?>

<?import javafx.scene.control.Button?>
<?import javafx.scene.control.Label?>
<?import javafx.scene.control.TextField?>
<?import javafx.scene.layout.Pane?>
<?import javafx.scene.shape.Circle?>

<Pane maxHeight="-Infinity" maxWidth="-Infinity" minHeight="-Infinity" minWidth="-Infinity" prefHeight="400.0" prefWidth="600.0" xmlns="http://javafx.com/javafx/23.0.1" xmlns:fx="http://javafx.com/fxml/1" fx:controller="com.example.es_12_javafx.HelloController">
   <children>
      <TextField fx:id="txtNome" layoutX="200.0" layoutY="189.0" prefHeight="25.0" prefWidth="79.0" />
      <Circle fx:id="crcLamp" fill="DODGERBLUE" layoutX="279.0" layoutY="112.0" radius="66.0" stroke="BLACK" strokeType="INSIDE" visible="false" />
      <Button fx:id="btnNewLamp" layoutX="285.0" layoutY="189.0" mnemonicParsing="false" onAction="#btnNewLampOnClick" text="new Lamp" />
      <TextField fx:id="txtLum" disable="true" layoutX="200.0" layoutY="227.0" prefHeight="25.0" prefWidth="79.0" />
      <Button fx:id="btnLum" disable="true" layoutX="285.0" layoutY="227.0" mnemonicParsing="false" onAction="#onBtnSetLum" text="ins Lum" />
      <TextField fx:id="txtR" disable="true" layoutX="200.0" layoutY="261.0" prefHeight="25.0" prefWidth="37.0" promptText="R" />
      <TextField fx:id="txtG" disable="true" layoutX="300.0" layoutY="261.0" prefHeight="25.0" prefWidth="37.0" promptText="B" />
      <TextField fx:id="txtB" disable="true" layoutX="253.0" layoutY="261.0" prefHeight="25.0" prefWidth="37.0" promptText="G" />
      <Button fx:id="btnRGB" disable="true" layoutX="253.0" layoutY="297.0" mnemonicParsing="false" onAction="#onBtnSetRGB" text="setRGB" />
      <Button fx:id="btnOn" disable="true" layoutX="137.0" layoutY="101.0" mnemonicParsing="false" onAction="#onBtnSetOn" text="ON" />
      <Button fx:id="btnOff" disable="true" layoutX="386.0" layoutY="101.0" mnemonicParsing="false" onAction="#onBtnSetOff" text="OFF" />
      <Label fx:id="lblError" layoutX="132.0" layoutY="14.0" prefHeight="17.0" prefWidth="287.0" />
      <Button fx:id="btnCancel" disable="true" layoutX="254.0" layoutY="352.0" mnemonicParsing="false" onAction="#onBtnCancelLamp" text="Delete" />
   </children>
</Pane>