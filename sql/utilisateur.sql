SET client_encoding = 'UTF8';
CREATE TABLE utilisateurs (
    id varchar(40) NOT NULL PRIMARY KEY ,
    description  varchar(1024) DEFAULT '',
    Nb_evenement int DEFAULT 0 CHECK (Nb_evenement >= 0),
    Nb_join int DEFAULT 0 CHECK (Nb_join >= 0),
    Nb_joined int DEFAULT 0 CHECK(Nb_joined >= 0),
    CONSTRAINT login_non_vide CHECK (((id)::text <> ''::text))
);

COMMENT ON TABLE utilisateurs IS 'details des utilisateurs';
-- COMMENT ON COLUMN id IS 'identifiant';
-- COMMENT ON COLUMN description IS 'présentation';
-- COMMENT ON COLUMN Nb_evenement IS 'nb d evenements créées';
-- COMMENT ON COLUMN Nb_join IS 'nb de participations';
-- COMMENT ON COLUMN Nb_joined IS 'nb de participants aux évènements qu il a créés';
