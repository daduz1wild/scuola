libro PRO TECH Vol C
dopo aver fatto il cd in D:\xampp\mysql\bin> usi il comando "mysql -u root"
se c'è una password del database devi mettere anche -p
una funzione importante in mysql è "tee" che mi permette di tenere traccia di tutto cio che viene fatto all'interno del cls.
comando "select CURDATE();" "select now();" "select user();"(ci dice quale è l'utente loggato), altro comando "show databases;"(mostra database che già ci sono)
uno dei primi comandi per creare un database che fa parte delle DDL è il comando CREATE DATABASE PIPPO;   poi per usarlo/selezionarlo usi il comando  use PIPPO

cosi crei una tabella 
MariaDB [(none)]> use database PROVA;
ERROR 1049 (42000): Unknown database 'database'
MariaDB [(none)]> use PIPPO
Database changed
MariaDB [PIPPO]> CREATE TABLE utenti(
    -> user varchar(20),
    -> pass varchar(32),
    -> idU INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    -> );
