/*BDD Ambre */
USE e20160018322;
/*BDD Alexandre 
USE e20170006075;
*/

DROP TABLE IF EXISTS Register;
DROP TABLE IF EXISTS Rate;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Events;
DROP TABLE IF EXISTS Locations;
DROP TABLE IF EXISTS Theme;
DROP TABLE IF EXISTS Logerror;

/*creation de la table events*/
create table EVENTS(
    ev_id NUMERIC(10) NOT NULL,
    ev_lo_id NUMERIC(10) NOT NULL,
    ev_th_id NUMERIC(10) NOT NULL,
    ev_name VARCHAR(30),
    ev_price NUMERIC(10,2), 
    ev_date_start DATE NOT NULL, 
    ev_date_end DATE NOT NULL,
    ev_start_time TIME NOT NULL,
    ev_end_time TIME NOT NULL, 
    ev_nb_people_min NUMERIC(30) DEFAULT NULL, 
    ev_nb_people_max NUMERIC(30) DEFAULT NULL,
    ev_descriptive TEXT,
    ev_average NUMERIC(10),
    ev_picture VARCHAR(50),
    CONSTRAINT pk_event PRIMARY KEY (ev_id),
    CONSTRAINT fk_event_lo FOREIGN KEY (ev_lo_id) REFERENCES LOCATIONS(lo_id),
    CONSTRAINT fk_event_th FOREIGN KEY (ev_th_id) REFERENCES THEME(th_id)
); 

/*creation de la table des locations*/
create table LOCATIONS(
    lo_id NUMERIC(10) NOT NULL,
    lo_name VARCHAR(30) NOT NULL, 
    lo_address VARCHAR(100) NOT NULL,
    lo_city VARCHAR(30) NOT NULL,
    lo_gps_lat DECIMAL(65,10) NOT NULL,
    lo_gps_long DECIMAL(65,10) NOT NULL,
    CONSTRAINT pk_location PRIMARY KEY (lo_id)
);

/*creation de la table theme*/
create table THEME(
    th_id NUMERIC(10) NOT NULL,
    th_name VARCHAR(30) NOT NULL,
    CONSTRAINT pk_th PRIMARY KEY (th_id)
);

/*creation de la table user*/
create table USER(
    us_id NUMERIC(10) NOT NULL,
    us_password NUMERIC(30) NOT NULL,
    us_role VARCHAR(30) CHECK (us_role IN ('administrator', 'contributor', 'visitor')),
    us_last_name VARCHAR(30), 
    us_first_name VARCHAR(30),
    us_email VARCHAR(30),
    CONSTRAINT pk_user PRIMARY KEY (us_id)
);

/*creationde la table register*/
create table REGISTER(
    re_registration_date DATE NOT NULL,
    re_us_id NUMERIC(10) NOT NULL,
    re_ev_id NUMERIC(10) NOT NULL,
    CONSTRAINT fk_re_us FOREIGN KEY (re_us_id) REFERENCES USER(us_id),
    CONSTRAINT fk_re_ev FOREIGN KEY (re_ev_id) REFERENCES EVENTS(ev_id),
    CONSTRAINT pk_re PRIMARY KEY (re_us_id, re_ev_id)
);

/*creation de la table rate*/
create table RATE(
    ra_date DATE NOT NULL,
    ra_rating NUMERIC(10) NOT NULL,
    ra_us_id NUMERIC(10) NOT NULL,
    ra_ev_id NUMERIC(10) NOT NULL,
    CONSTRAINT fk_ra_us FOREIGN KEY(ra_us_id) REFERENCES USER(us_id),
    CONSTRAINT fk_ra_ev FOREIGN KEY(ra_ev_id) REFERENCES EVENTS(ev_id),
    CONSTRAINT pk_ra PRIMARY KEY (ra_us_id, ra_ev_id)
);

/*creation de la table d'erreur*/
CREATE TABLE LOGERROR  (
  log_id INT(11) AUTO_INCREMENT,
  MESSAGE VARCHAR(255) DEFAULT NULL,
  THETIME TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT PK_LOGERROR PRIMARY KEY (log_id)
);	

/*-------------------------------
Les triggers
---------------------------------*/
/* Déclencheurs user */
DROP TRIGGER IF EXISTS user_role_attribue;
DELIMITER $$
CREATE TRIGGER user_role_attribue BEFORE INSERT ON user FOR EACH ROW IF NEW.us_role NOT IN ( 'administrator', 'contributor', 'visitor')  
    	THEN
        INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE ROLE DOIT ETRE BON"));
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE ROLE DOIT ETRE BON';
    END IF
$$
DELIMITER ;
COMMIT;

/* Déclencheurs event */
DROP TRIGGER IF EXISTS trigger_event;
DELIMITER $$
CREATE TRIGGER trigger_event BEFORE INSERT ON events FOR EACH ROW IF NEW.ev_price < 0.0 THEN
	INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE PRIX DOIT ETRE POSITIF"));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE PRIX DOIT ETRE POSITIF';
END IF
$$
DELIMITER ;


/*--------------------------------
Les insertions 
----------------------------------*/

/* Insertion de User */
INSERT INTO user (us_id, us_password, us_role, us_last_name, us_first_name, us_email) VALUES
('1', '12345', 'visitor', 'lamouchi', 'ambre', 'lamouchiambre@gmail.com');

/* Insertion de Theme */
INSERT INTO theme (th_id, th_name) VALUES
('1', 'Spectacle'),
('2', 'Concert'),
('3', 'Exposition'),
('4', 'Festival'),
('5', 'Evènement sportif');

/*Insertion de Location*/
INSERT INTO locations (lo_id, lo_name, lo_address, lo_city, lo_gps_lat, lo_gps_long) VALUES
(1, 'Le Corum', 'Place Charles de Gaulle, 34000 Montpellier', 'Montpellier', 43.6200000000, 3.8300000000),
(2, 'Zénith Sud', '2733 Avenue Albert Einstein, 34000 Montpellier', 'Montpellier', 43.6137900000, 3.9300100000);

/*Insertion de Events*/
INSERT INTO events (ev_id, ev_lo_id, ev_th_id, ev_name, ev_price, ev_date_start, ev_date_end, ev_start_time, ev_end_time, ev_nb_people_min, ev_nb_people_max, ev_descriptive, ev_average, ev_picture) VALUES
(1, 1, 1, 'LE LAC DES CYGNES', 39.00, '2020-01-11', '2020-01-11', '20:30:00', '22:30:00', NULL, 500, '<p>\r\nLE LAC DES CYGNES <br>\r\nBallet classique en deux actes et 4 tableaux <br>\r\nMusique :Piotr Tchaïkovski <br>\r\nChorégraphie : Marius Petipa <br>\r\nLe Lac des cygnes a été présenté la première fois à Moscou en 1877. <br>\r\nL’histoire d’amour du prince pour une jeune fille, transformée en cygne par un sorcier, est un sujet fantastique où la danseuse principale a un double personnage à jouer et à danser – Odette, cygne blanc, lyrique et poétique, Odile, cygne noir, maléfique et fatal. <br>\r\nC’est l’école russe de danse classique, l’école d’excellence de Saint-Pétersbourg, que les spectateurs pourront voir sur scène. Les danseurs ont été formés dans les meilleures écoles de ballet de Russie d’après la méthode Vaganova de Saint-Pétersbourg. <br>\r\nLe Lac des cygnes fait partie des ballets les plus connus au monde et le plus joué dans les théâtres. <br>\r\nLa musique de Piotr Tchaïkovski transporte le spectateur dans un univers poétique, un univers de grâce, d’élégance et de beauté infinie. <br>\r\nLa splendeur des décors et des costumes, l’orchestre live, l’esthétique et la poésie de la danse classique ,interprétée avec brio et élégance par les danseurs russes, font de ce spectacle un vrai joyau pour toute la famille ! <br>Réservations Personne à Mobilité Réduite (PMR) Tél : 0467546123</p>', NULL, 'http://www.montpellier-events.com/var/mtp/storage/'),
(2, 1, 1, 'Casse-Noisette', 39.00, '2020-01-19', '2020-01-19', '18:00:00', '20:00:00', NULL, 500, '				\r\n                \r\n<p><b>Casse-Noisette – </b><b>Opéra national de Russie</b></p><p><b>Vivez la magie de Noël en 2019 avec le chef d’œuvre classique <i>Casse-Noisette</i>&nbsp;!</b></p><p>Ce conte de Noël raconte l’histoire de la jeune Clara qui reçoit en cadeau un casse-noisette en forme de petit bonhomme. Dans une nuit animée d’un mystérieux enchantement, les jouets menés par Casse-Noisette se livrent à une bataille acharnée contre les méchantes souris de la maison. Réveillée par le bruit, Clara décide d’affronter ses peurs en participant au combat et sauve son cher Casse Noisette du danger. Ému par son courage et plein de gratitude, il se transforme en prince charmant et emmène Clara dans un royaume féérique.</p><p>Ballet en deux actes, Casse-Noisette&nbsp;est présenté au public pour la première fois en décembre 1892 à Saint-Pétersbourg au Théâtre Mariinsky. La célèbre musique de Tchaïkovsky interprétée par le talentueux orchestre et la virtuosité des danseurs, sublimés par des décors et costumes époustouflants, feront vibrer petits et grands dans ce monde fantastique. Cette partition inoubliable vous plongera dans une atmosphère magique et vous fera revivre vos rêves d’enfants.</p><p>Retrouvez toute la beauté de ce joyau du répertoire classique, idéal en cette période de Noël.</p><p class=\" text-justify\"><b>Réservations pour les Personnes à Mobilité Réduite : 01 55 12 00 00</b></p>            ', NULL, 'http://www.montpellier-events.com/var/mtp/storage/'),
(3, 1, 1, 'la meteo en folie', -1.00, '2019-12-19', '2019-12-19', '15:00:00', '17:00:00', NULL, 300, 'Un spectacle en folie avec plein d sintemperie', NULL, NULL),
(4, 2, 1, 'blabla', '10.00', '2019-12-26', '2019-12-26', '12:00:00', '14:00:00', NULL, '100', 'fghdfh', NULL, NULL);

/*------------------------------
Création de Trigger
--------------------------------*/
DROP TRIGGER IF EXISTS `user_role_attribue`;
DELIMITER $$
CREATE TRIGGER `user_role_attribue` BEFORE INSERT ON `user` FOR EACH ROW IF NEW.us_role NOT IN ( 'administrator', 'contributor', 'visitor')  
    	THEN
        INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE ROLE DOIT ETRE BON"));
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE ROLE DOIT ETRE BON';
    END IF
$$
DELIMITER ;
COMMIT;