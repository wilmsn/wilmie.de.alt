DROP TABLE IF EXISTS menu;

CREATE TABLE menu
(
   ID        INT UNSIGNED   NOT NULL AUTO_INCREMENT,
   menu1_id  INT            NOT NULL,
   menu2_id  INT            NOT NULL,
   menu3_id  INT            NOT NULL,
   role      VARCHAR(10),
   show_dt   BIT,
   show_mo   BIT,
   has_sub   BIT,
   class_dt  VARCHAR(10),
   class_mo  VARCHAR(10),
   label     VARCHAR(40),
   bookmark  VARCHAR(70),
   url       VARCHAR(80),
   content   VARCHAR(50),
   PRIMARY KEY (ID)
)
ENGINE=InnoDB;

DROP TABLE IF EXISTS securitytokens;

CREATE TABLE securitytokens
(
   id             INT UNSIGNED                                        NOT NULL AUTO_INCREMENT,
   user_id        INT                                                 NOT NULL,
   identifier     VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   securitytoken  VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   created_at     TIMESTAMP                                           DEFAULT CURRENT_TIMESTAMP NOT NULL,
   PRIMARY KEY (id)
)
ENGINE=InnoDB
COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS users;

CREATE TABLE users
(
   id                 INT UNSIGNED                                        NOT NULL AUTO_INCREMENT,
   email              VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   passwort           VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   vorname            VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   nachname           VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   created_at         TIMESTAMP                                           DEFAULT CURRENT_TIMESTAMP NOT NULL,
   updated_at         TIMESTAMP,
   passwortcode       VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci,
   passwortcode_time  TIMESTAMP,
   PRIMARY KEY (id)
)
ENGINE=InnoDB
COLLATE=utf8_unicode_ci;

CREATE UNIQUE INDEX email
   ON users (email ASC);

DROP TABLE IF EXISTS users_request;

CREATE TABLE users_request
(
   id                 INT UNSIGNED                                        NOT NULL AUTO_INCREMENT,
   email              VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   passwort           VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   vorname            VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   nachname           VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci   NOT NULL,
   created_at         TIMESTAMP                                           DEFAULT CURRENT_TIMESTAMP NOT NULL,
   updated_at         TIMESTAMP,
   passwortcode       VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci,
   passwortcode_time  TIMESTAMP,
   PRIMARY KEY (id)
)
ENGINE=InnoDB
COLLATE=utf8_unicode_ci;

CREATE UNIQUE INDEX email
   ON users_request (email ASC);
