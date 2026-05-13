
CREATE TABLE Gare(
	idGara Int PRIMARY KEY AUTO_INCREMENT,
	dataOra DATETIME NOT NULL,
	descrizione TEXT,
	genere VARCHAR(1),
	idSpecialità INT NOT NULL
	FOREIGN KEY (idSpecialità) REFERENCES Specialità(idSpecialità)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
	CHECK(genere='M' OR genere='F')

);
INSERT INTO atleti(cognome, nome, sesso , dataNascita, idNazione)
VALUES ('Rossi', 'Marco', 'M', '15-10-2008',
(SELECT idNazione FROM nazioni WHERE nome='Italia'));

UPDATE Partecipazioni 
SET posizione=2
WHERE idGara=3 AND (SELECT)

DELETE FROM Partecipazioni 
WHERE idAtleta = (SELECT idAtleta FROM Atleti WHEE)

SELECT COUNT(*) AS MedaglieORO FROM Partecipazioni where posizione=1;


SELECT * FROM atleti 
WHERE sesso ="F"
ORDER BY birth DESC LIMIT 10;
