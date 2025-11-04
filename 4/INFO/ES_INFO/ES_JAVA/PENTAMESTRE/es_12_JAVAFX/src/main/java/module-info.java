module com.example.es_12_javafx {
    requires javafx.controls;
    requires javafx.fxml;


    opens com.example.es_12_javafx to javafx.fxml;
    exports com.example.es_12_javafx;
}