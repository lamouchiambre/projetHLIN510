-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 16 déc. 2019 à 21:20
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `groupe_h`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `afficher_us_ev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `afficher_us_ev` ()  NO SQL
SELECT us_email , ev_name FROM events, register, user WHERE us_id = re_us_id AND ev_id = re_ev_id$$

DROP PROCEDURE IF EXISTS `compter_nombre_inscrit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `compter_nombre_inscrit` (IN `id_ev` INT, OUT `nb_ins_ev` INT)  NO SQL
SELECT COUNT(*) INTO nb_ins_ev FROM register WHERE re_ev_id = id_ev$$

--
-- Fonctions
--
DROP FUNCTION IF EXISTS `nb_people_max`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nb_people_max` (`para1` INT) RETURNS INT(11) BEGIN
DECLARE nb INT;
SELECT ev_nb_people_max INTO nb FROM events WHERE ev_id = para1;
RETURN nb;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `ev_id` decimal(10,0) NOT NULL,
  `ev_lo_id` decimal(10,0) NOT NULL,
  `ev_th_id` decimal(10,0) NOT NULL,
  `ev_name` varchar(30) DEFAULT NULL,
  `ev_price` decimal(10,2) DEFAULT NULL,
  `ev_date_start` date NOT NULL,
  `ev_date_end` date NOT NULL,
  `ev_start_time` time NOT NULL,
  `ev_end_time` time NOT NULL,
  `ev_nb_people_min` decimal(30,0) DEFAULT NULL,
  `ev_nb_people_max` decimal(30,0) DEFAULT NULL,
  `ev_descriptive` text,
  `ev_average` decimal(10,0) DEFAULT NULL,
  `ev_picture` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ev_id`),
  KEY `fk_event_lo` (`ev_lo_id`),
  KEY `fk_event_th` (`ev_th_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ev_id`, `ev_lo_id`, `ev_th_id`, `ev_name`, `ev_price`, `ev_date_start`, `ev_date_end`, `ev_start_time`, `ev_end_time`, `ev_nb_people_min`, `ev_nb_people_max`, `ev_descriptive`, `ev_average`, `ev_picture`) VALUES
('1', '1', '1', 'LE LAC DES CYGNES', '39.00', '2020-01-11', '2020-01-11', '20:30:00', '22:30:00', NULL, '500', '<p>\r\nLE LAC DES CYGNES <br>\r\nBallet classique en deux actes et 4 tableaux <br>\r\nMusique :Piotr Tchaïkovski <br>\r\nChorégraphie : Marius Petipa <br>\r\nLe Lac des cygnes a été présenté la première fois à Moscou en 1877. <br>\r\nL’histoire d’amour du prince pour une jeune fille, transformée en cygne par un sorcier, est un sujet fantastique où la danseuse principale a un double personnage à jouer et à danser – Odette, cygne blanc, lyrique et poétique, Odile, cygne noir, maléfique et fatal. <br>\r\nC’est l’école russe de danse classique, l’école d’excellence de Saint-Pétersbourg, que les spectateurs pourront voir sur scène. Les danseurs ont été formés dans les meilleures écoles de ballet de Russie d’après la méthode Vaganova de Saint-Pétersbourg. <br>\r\nLe Lac des cygnes fait partie des ballets les plus connus au monde et le plus joué dans les théâtres. <br>\r\nLa musique de Piotr Tchaïkovski transporte le spectateur dans un univers poétique, un univers de grâce, d’élégance et de beauté infinie. <br>\r\nLa splendeur des décors et des costumes, l’orchestre live, l’esthétique et la poésie de la danse classique ,interprétée avec brio et élégance par les danseurs russes, font de ce spectacle un vrai joyau pour toute la famille ! <br>Réservations Personne à Mobilité Réduite (PMR) Tél : 0467546123</p>', NULL, 'http://www.montpellier-events.com/var/mtp/storage/'),
('2', '1', '1', 'Casse-Noisette', '39.00', '2020-01-19', '2020-01-19', '18:00:00', '20:00:00', NULL, '500', '				\r\n                \r\n<p><b>Casse-Noisette – </b><b>Opéra national de Russie</b></p><p><b>Vivez la magie de Noël en 2019 avec le chef d’œuvre classique <i>Casse-Noisette</i>&nbsp;!</b></p><p>Ce conte de Noël raconte l’histoire de la jeune Clara qui reçoit en cadeau un casse-noisette en forme de petit bonhomme. Dans une nuit animée d’un mystérieux enchantement, les jouets menés par Casse-Noisette se livrent à une bataille acharnée contre les méchantes souris de la maison. Réveillée par le bruit, Clara décide d’affronter ses peurs en participant au combat et sauve son cher Casse Noisette du danger. Ému par son courage et plein de gratitude, il se transforme en prince charmant et emmène Clara dans un royaume féérique.</p><p>Ballet en deux actes, Casse-Noisette&nbsp;est présenté au public pour la première fois en décembre 1892 à Saint-Pétersbourg au Théâtre Mariinsky. La célèbre musique de Tchaïkovsky interprétée par le talentueux orchestre et la virtuosité des danseurs, sublimés par des décors et costumes époustouflants, feront vibrer petits et grands dans ce monde fantastique. Cette partition inoubliable vous plongera dans une atmosphère magique et vous fera revivre vos rêves d’enfants.</p><p>Retrouvez toute la beauté de ce joyau du répertoire classique, idéal en cette période de Noël.</p><p class=\" text-justify\"><b>Réservations pour les Personnes à Mobilité Réduite : 01 55 12 00 00</b></p>            ', NULL, 'http://www.montpellier-events.com/var/mtp/storage/'),
('3', '2', '2', 'Maitre Gims', NULL, '2019-12-17', '2019-12-17', '20:00:00', '23:00:00', NULL, '2', 'C\'est concert de maître gims Youhou', NULL, NULL);

--
-- Déclencheurs `events`
--
DROP TRIGGER IF EXISTS `trigger_event`;
DELIMITER $$
CREATE TRIGGER `trigger_event` BEFORE INSERT ON `events` FOR EACH ROW IF NEW.ev_price < 0.0 THEN
	INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE PRIX DOIT ETRE POSITIF"));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE PRIX DOIT ETRE POSITIF';
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `lo_id` decimal(10,0) NOT NULL,
  `lo_name` varchar(30) NOT NULL,
  `lo_address` varchar(100) NOT NULL,
  `lo_city` varchar(30) NOT NULL,
  `lo_gps_lat` decimal(65,10) NOT NULL,
  `lo_gps_long` decimal(65,10) NOT NULL,
  PRIMARY KEY (`lo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`lo_id`, `lo_name`, `lo_address`, `lo_city`, `lo_gps_lat`, `lo_gps_long`) VALUES
('1', 'Le Corum', 'Place Charles de Gaulle, 34000 Montpellier', 'Montpellier', '43.6200000000', '3.8300000000'),
('2', 'Zénith Sud', '2733 Avenue Albert Einstein, 34000 Montpellier', 'Montpellier', '43.6137900000', '3.9300100000');

-- --------------------------------------------------------

--
-- Structure de la table `logerror`
--

DROP TABLE IF EXISTS `logerror`;
CREATE TABLE IF NOT EXISTS `logerror` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `MESSAGE` varchar(255) DEFAULT NULL,
  `THETIME` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logerror`
--

INSERT INTO `logerror` (`log_id`, `MESSAGE`, `THETIME`) VALUES
(1, 'ATTENTION, LE PRIX DOIT ETRE POSITIF', '2019-12-16 14:03:25'),
(2, 'DESOLER, L\'EVENEMENT EST COMPLET', '2019-12-16 19:17:26');

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `ra_date` date NOT NULL,
  `ra_rating` decimal(10,0) NOT NULL,
  `ra_us_id` decimal(10,0) NOT NULL,
  `ra_ev_id` decimal(10,0) NOT NULL,
  PRIMARY KEY (`ra_us_id`,`ra_ev_id`),
  KEY `fk_ra_ev` (`ra_ev_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `re_registration_date` date NOT NULL,
  `re_us_id` decimal(10,0) NOT NULL,
  `re_ev_id` decimal(10,0) NOT NULL,
  PRIMARY KEY (`re_us_id`,`re_ev_id`),
  KEY `fk_re_ev` (`re_ev_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `register`
--

INSERT INTO `register` (`re_registration_date`, `re_us_id`, `re_ev_id`) VALUES
('2019-12-16', '1', '1'),
('2019-12-14', '2', '1'),
('2019-12-12', '3', '2'),
('2019-12-16', '1', '3'),
('2019-12-16', '2', '3'),
('2019-12-16', '3', '3');

--
-- Déclencheurs `register`
--
DROP TRIGGER IF EXISTS `est_complet`;
DELIMITER $$
CREATE TRIGGER `est_complet` BEFORE INSERT ON `register` FOR EACH ROW BEGIN
DECLARE ev_ent INT;
call compter_nombre_inscrit(new.re_ev_id, ev_ent);
IF nb_people_max(new.re_ev_id) < ev_ent -1 THEN
   INSERT INTO logerror(MESSAGE)VALUES (CONCAT("DESOLER, L'EVENEMENT EST COMPLET"));
   SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "L'EVENEMENT EST COMPLET";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `th_id` decimal(10,0) NOT NULL,
  `th_name` varchar(30) NOT NULL,
  PRIMARY KEY (`th_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`th_id`, `th_name`) VALUES
('1', 'Spectacle'),
('2', 'Concert'),
('3', 'Exposition'),
('4', 'Festival'),
('5', 'Evènement sportif');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `us_id` decimal(10,0) NOT NULL,
  `us_password` decimal(30,0) NOT NULL,
  `us_role` varchar(30) DEFAULT NULL,
  `us_last_name` varchar(30) DEFAULT NULL,
  `us_first_name` varchar(30) DEFAULT NULL,
  `us_email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`us_id`, `us_password`, `us_role`, `us_last_name`, `us_first_name`, `us_email`) VALUES
('1', '12345', 'visitor', 'lamouchi', 'ambre', 'lamouchiambre@gmail.com'),
('2', '12345', 'administrator', 'Canton condes', 'Alexandre', 'alex@mail.com'),
('3', '12345', 'visitor', 'Meler', 'Arnaud', 'arnaud@mail.com'),
('4', '12345', 'visitor', 'Bardin', 'Melvin', 'melvin@mail.com');

--
-- Déclencheurs `user`
--
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
