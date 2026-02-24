C:\Users\davide.benedetti>D:

D:\>cd D:\xampp\mysql\bin
D:\xampp\mysql\bin>mysql -u root

MariaDB [(none)]> SHOW DATABASES
    -> ;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| phpmyadmin         |
| pippo              |
| test               |
+--------------------+
6 rows in set (0.062 sec)

MariaDB [(none)]> CREATE DATABASE bollette;
Query OK, 1 row affected (0.079 sec)

MariaDB [(none)]> USE bollette;

MariaDB [bollette]> create table utenti(
    -> codice INT NOT NULL PRIMARY KEY,
    -> cognome VARCHAR(30) NOT NULL,
    -> nome VARCHAR(30) NOT NULL,
    -> indirizzo VARCHAR(50),
    -> citta VARCHAR(30)
    -> );



MariaDB [bollette]> CREATE TABLE bollette (
    ->     numero INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ->     data DATE NOT NULL,
    ->     consumo VARCHAR(30) NOT NULL,
    ->     importo DECIMAL(12,2),
    ->     utente INT NOT NULL,
    ->     FOREIGN KEY (utente) REFERENCES utenti (codice)
    -> );
Query OK, 0 rows affected (0.117 sec)

MariaDB [bollette]> describe bollette;
+---------+---------------+------+-----+---------+----------------+
| Field   | Type          | Null | Key | Default | Extra          |
+---------+---------------+------+-----+---------+----------------+
| numero  | int(11)       | NO   | PRI | NULL    | auto_increment |
| data    | date          | NO   |     | NULL    |                |
| consumo | varchar(30)   | NO   |     | NULL    |                |
| importo | decimal(12,2) | YES  |     | NULL    |                |
| utente  | int(11)       | NO   | MUL | NULL    |                |
+---------+---------------+------+-----+---------+----------------+
5 rows in set (0.121 sec)

MariaDB [bollette]> INSERT INTO UTENTI (nome,cognome,codice)
    -> VALUES ('Andrea','Bonardi',88);
Query OK, 1 row affected (0.140 sec)

MariaDB [bollette]> SELECT * FROM utenti; //PER VISUALIZZARE I DATI DI UNA TABELLA
+--------+---------+--------+-----------+-------+
| codice | cognome | nome   | indirizzo | citta |
+--------+---------+--------+-----------+-------+
|     88 | Bonardi | Andrea | NULL      | NULL  |
+--------+---------+--------+-----------+-------+
1 row in set (0.001 sec)

MariaDB [bollette]> DELETE FROM utenti WHERE codice=88; // PER ELIMINARE 



tupla e undupla sono sinonimi di riga qua in sql.
UPDATE utenti //INDICO QUALE TABELLA VOGLIO CAMBIARE



MariaDB [bollette]> UPDATE utenti
    -> SET cognome = 'Zola',
    ->     nome = 'Francesco'
    -> WHERE codice = 88;
Query OK, 1 row affected (0.024 sec)
Rows matched: 1  Changed: 1  Warnings: 0


//la SELECT stampa quello che vuoi con ordine che vuoi da una tabella di un database
SELECT codice,nome,cognome,codice FROM utenti;
+--------+-----------+---------+--------+
| codice | nome      | cognome | codice |
+--------+-----------+---------+--------+
|     88 | Francesco | Zola    |     88 |
+--------+-----------+---------+--------+



MariaDB [bollette]> INSERT INTO bollette(data, consumo, utente)
    -> VALUES
    ->     (curdate(), 30, 101),
    ->     (curdate(), 40, 102),
    ->     (curdate(), 55, 88),
    ->     (curdate(), 52, 88),
    ->     (curdate(), 51, 88),
    ->     (curdate(), 30, 101),
    ->     (curdate(), 30, 101),
    ->     (curdate(), 40, 102),
    ->     (curdate(), 40, 103);
Query OK, 9 rows affected (0.057 sec)
Records: 9  Duplicates: 0  Warnings: 0


quando crei la tabella devi usare ONUPDATE E ONDELETE IN MODO CHE ALMENO CON LE BOLLLETTE CREATE PUOI MODIFICARE GLI UTENTI O ELIMINARLI SENZA DOVER MODIFICARE MANUALMENTE LA TABELLA bollette

MariaDB [bollette]> DROP TABLE IF EXISTS bollette;
Query OK, 0 rows affected (0.208 sec)

MariaDB [bollette]> CREATE TABLE bollette (
    ->     numero INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ->     data DATE NOT NULL,
    ->     consumo VARCHAR(30) NOT NULL,
    ->     importo DECIMAL(12,2),
    ->     utente INT NOT NULL,
    ->     FOREIGN KEY (utente)
    ->         REFERENCES utenti(codice)
    ->         ON DELETE CASCADE
    ->         ON UPDATE CASCADE
    -> );
Query OK, 0 rows affected (0.120 sec)

- eliminare utente D

MariaDB [bollette]> DELETE FROM utenti
    -> WHERE codice = 103;
Query OK, 1 row affected (0.050 sec)


- aggiornare codice B

MariaDB [bollette]> UPDATE utenti
    -> SET codice = 201
    -> WHERE codice = 101;
Query OK, 1 row affected (0.022 sec)
Rows matched: 1  Changed: 1  Warnings: 0




🔹 Cos’è UNIQUE in SQL?

Il vincolo UNIQUE in SQL serve a garantire che i valori di una colonna (o combinazione di colonne) siano tutti diversi tra loro.

👉 In pratica:

Non possono esistere due righe con lo stesso valore in quella colonna.

È diverso da PRIMARY KEY perché:

una tabella può avere una sola PRIMARY KEY

può avere più vincoli UNIQUE

PRIMARY KEY implica automaticamente NOT NULL

UNIQUE può accettare NULL (a seconda del DBMS)

📌 Esempio semplice
email VARCHAR(100) UNIQUE

Non potranno esistere due utenti con la stessa email.

//ORDINAMENTO DECRESCENTE IN BASE A 2 elementi:
MariaDB [bollette]> SELECT * FROM utenti
    -> ORDER BY cognome desc, nome desc;
+--------+----------+-----------+-----------+-------+
| codice | cognome  | nome      | indirizzo | citta |
+--------+----------+-----------+-----------+-------+
|     88 | Zola     | Francesco | NULL      | NULL  |
|    102 | Rossi    | Giulia    | NULL      | NULL  |
|    105 | Romano   | Sara      | NULL      | NULL  |
|    201 | Ferrari  | Luca      | NULL      | NULL  |
|    104 | Esposito | Davide    | NULL      | NULL  |
+--------+----------+-----------+-----------+-------+
5 rows in set (0.002 sec)


//stampa di persone sulla base di un nome:
MariaDB [bollette]> SELECT *
    -> FROM utenti
    -> WHERE nome='Francesco';
+--------+---------+-----------+-------------+--------+
| codice | cognome | nome      | indirizzo   | citta  |
+--------+---------+-----------+-------------+--------+
|     88 | Zola    | Francesco | Via Roma 10 | Milano |
+--------+---------+-----------+-------------+--------+
1 row in set (0.001 sec)


//stampa di persone sulla base di iniziali di cognome:

MariaDB [bollette]> SELECT * FROM utenti WHERE cognome LIKE '%ro%';
+--------+---------+--------+-------------+--------+
| codice | cognome | nome   | indirizzo   | citta  |
+--------+---------+--------+-------------+--------+
|    102 | Rossi   | Giulia | Via Roma 10 | Milano |
|    105 | Romano  | Sara   | Via Roma 10 | Milano |
+--------+---------+--------+-------------+--------+
2 rows in set (0.002 sec)

