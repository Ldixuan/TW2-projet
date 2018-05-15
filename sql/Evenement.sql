SET client_encoding = 'UTF8';
CREATE TABLE Evenement (
    id int NOT NULL PRIMARY KEY CHECK(id>0),
    autor varchar(40) NOT NULL,
    title varchar(40) NOT NULL,
    description varchar(300) NOT NULL DEFAULT '', 
    category varchar(20) NOT NULL,
    ou varchar(100) DEFAULT '' NOT NULL,
    quand timestamp NOT NULL,
    Nb_participant int NOT NULL DEFAULT 0 CHECK(Nb_participant>=0),
    date_creation timestamp DEFAULT clock_timestamp()
);

COMMENT ON TABLE Evenement IS 'details des Evenement';
INSERT INTO Evenement(id,autor,title,category,ou,quand) VALUES(1,'XIAN123','barbecue','losir','M5','2018-12-5 12:00:00')
