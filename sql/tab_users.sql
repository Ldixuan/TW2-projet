SET client_encoding = 'UTF8';
CREATE TABLE tab_users (
    login varchar(40) NOT NULL,
    password varchar(100) NOT NULL,
    CONSTRAINT login_non_vide CHECK (((login)::text <> ''::text)),
    CONSTRAINT password_non_vide CHECK (((password)::text <> ''::text))
);
ALTER TABLE ONLY tab_users
    ADD CONSTRAINT tab_users_pkey PRIMARY KEY (login);

COMMENT ON TABLE tab_users IS 'table des utilisateurs';

INSERT INTO tab_users(login,password) VALUES(XIAN,123)
