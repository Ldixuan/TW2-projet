SET client_encoding = 'UTF8';
CREATE TABLE Abonnement (
    id int NOT NULL PRIMARY KEY CHECK(id>0),
    autor varchar(40) NOT NULL,
    category varchar(20) NOT NULL,
    keyword varchar(20) NOT NULL
);

COMMENT ON TABLE Abonnement IS 'details des abonnements';
