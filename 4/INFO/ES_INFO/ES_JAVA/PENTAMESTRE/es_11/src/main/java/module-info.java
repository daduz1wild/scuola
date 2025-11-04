module com.example.es_11 {
    requires javafx.controls;
    requires javafx.fxml;


    opens com.example.es_11 to javafx.fxml;
    exports com.example.es_11;
}