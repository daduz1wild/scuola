module com.example.es_cassaforte {
    requires javafx.controls;
    requires javafx.fxml;


    opens com.example.es_cassaforte to javafx.fxml;
    exports com.example.es_cassaforte;
}