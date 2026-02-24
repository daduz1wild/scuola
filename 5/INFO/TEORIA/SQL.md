è un insieme di linguaggi che è stato definito nel 1970 per gestire e manipolare i database relazionali.
5 famiglie:
- DDL
-  DML
- TCL
- DQL
- DCL
noi usiamo MariaDB che è un fork di MySQL
InnoDB è il motore interno che usa MariaDB


SELECT region, COUNT(*) AS '#'
FROM countries
GROUP BY REGION;


SELECT region, COUNT(*) AS '#'
FROM countries
GROUP BY REGION
HAVING country>=15  WHERE area>300000
