-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.etu.umontpellier.fr
-- Généré le :  jeu. 12 déc. 2019 à 19:32
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e20160018322`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `ev_id` int(11) NOT NULL,
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
  `ev_picture` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ev_id`, `ev_lo_id`, `ev_th_id`, `ev_name`, `ev_price`, `ev_date_start`, `ev_date_end`, `ev_start_time`, `ev_end_time`, `ev_nb_people_min`, `ev_nb_people_max`, `ev_descriptive`, `ev_average`, `ev_picture`) VALUES
(1, 1, 1, 'LE LAC DES CYGNES', 39.00, '2020-01-11', '2020-01-11', '20:30:00', '22:30:00', NULL, 500, '<p>\r\nLE LAC DES CYGNES <br>\r\nBallet classique en deux actes et 4 tableaux <br>\r\nMusique :Piotr Tchaïkovski <br>\r\nChorégraphie : Marius Petipa <br>\r\nLe Lac des cygnes a été présenté la première fois à Moscou en 1877. <br>\r\nL’histoire d’amour du prince pour une jeune fille, transformée en cygne par un sorcier, est un sujet fantastique où la danseuse principale a un double personnage à jouer et à danser – Odette, cygne blanc, lyrique et poétique, Odile, cygne noir, maléfique et fatal. <br>\r\nC’est l’école russe de danse classique, l’école d’excellence de Saint-Pétersbourg, que les spectateurs pourront voir sur scène. Les danseurs ont été formés dans les meilleures écoles de ballet de Russie d’après la méthode Vaganova de Saint-Pétersbourg. <br>\r\nLe Lac des cygnes fait partie des ballets les plus connus au monde et le plus joué dans les théâtres. <br>\r\nLa musique de Piotr Tchaïkovski transporte le spectateur dans un univers poétique, un univers de grâce, d’élégance et de beauté infinie. <br>\r\nLa splendeur des décors et des costumes, l’orchestre live, l’esthétique et la poésie de la danse classique ,interprétée avec brio et élégance par les danseurs russes, font de ce spectacle un vrai joyau pour toute la famille ! <br>Réservations Personne à Mobilité Réduite (PMR) Tél : 0467546123</p>', NULL, 'img/events/backdrop-lac.jpg'),
(2, 1, 1, 'Casse-Noisette', 39.00, '2020-01-19', '2020-01-19', '18:00:00', '20:00:00', NULL, 500, '				\r\n                \r\n<p><b>Casse-Noisette – </b><b>Opéra national de Russie</b></p><p><b>Vivez la magie de Noël en 2019 avec le chef d’œuvre classique <i>Casse-Noisette</i>&nbsp;!</b></p><p>Ce conte de Noël raconte l’histoire de la jeune Clara qui reçoit en cadeau un casse-noisette en forme de petit bonhomme. Dans une nuit animée d’un mystérieux enchantement, les jouets menés par Casse-Noisette se livrent à une bataille acharnée contre les méchantes souris de la maison. Réveillée par le bruit, Clara décide d’affronter ses peurs en participant au combat et sauve son cher Casse Noisette du danger. Ému par son courage et plein de gratitude, il se transforme en prince charmant et emmène Clara dans un royaume féérique.</p><p>Ballet en deux actes, Casse-Noisette&nbsp;est présenté au public pour la première fois en décembre 1892 à Saint-Pétersbourg au Théâtre Mariinsky. La célèbre musique de Tchaïkovsky interprétée par le talentueux orchestre et la virtuosité des danseurs, sublimés par des décors et costumes époustouflants, feront vibrer petits et grands dans ce monde fantastique. Cette partition inoubliable vous plongera dans une atmosphère magique et vous fera revivre vos rêves d’enfants.</p><p>Retrouvez toute la beauté de ce joyau du répertoire classique, idéal en cette période de Noël.</p><p class=\" text-justify\"><b>Réservations pour les Personnes à Mobilité Réduite : 01 55 12 00 00</b></p>            ', NULL, 'img/events/casse-noisette.webp'),
(80, 1, 1, 'spcetcle', 8.00, '2019-12-20', '2022-03-04', '01:05:00', '03:03:00', NULL, NULL, 'dfsgdfgdfgdfgdfgdf', NULL, 'img/events/donut.png'),
(79, 1, 1, 'bonjour', 10.00, '2019-12-20', '2019-12-29', '01:01:00', '01:01:00', NULL, NULL, '1234123', NULL, 'img/events/menu.png'),
(81, 1, 1, 'ghfgh', 10.00, '2019-12-14', '2019-12-15', '12:24:00', '11:23:00', NULL, NULL, 'aller', NULL, 'https://www.les-chevaliers-dargouges.com/2000-large_default/tablette-bio-chocolat-lait-100g.jpg'),
(82, 1, 1, 'fjk', 5.00, '2019-12-14', '2019-12-21', '12:25:00', '12:25:00', NULL, NULL, 'fgjh', NULL, 'img/events/default.jpg'),
(83, 1, 1, 'fghfgh', 3.00, '2019-12-14', '2019-12-29', '12:27:00', '12:27:00', NULL, NULL, 'hgjghjgfjh', NULL, 'img/events/miaou.png'),
(84, 1, 1, 'je suis la', 8.00, '2019-12-21', '2020-01-13', '15:55:00', '15:55:00', NULL, NULL, 'yohoho', NULL, 'img/events/default.jpg'),
(85, 1, 1, 'sdf', 3.00, '2019-12-13', '2019-12-15', '14:09:00', '16:09:00', NULL, NULL, 'sdfsdf', NULL, 'img/events/default.jpg'),
(86, 2, 2, 'Maitre Gims', 50.00, '2019-12-13', '2019-12-14', '08:00:00', '08:00:00', NULL, NULL, 'Concert du talentueux et charismatique Maitre Gims (50€ la place bande de shlag)', NULL, 'img/events/default.jpg');

--
-- Déclencheurs `events`
--
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

CREATE TABLE `locations` (
  `lo_id` int(11) NOT NULL,
  `lo_name` varchar(30) NOT NULL,
  `lo_address` varchar(100) NOT NULL,
  `lo_city` varchar(30) NOT NULL,
  `lo_gps_lat` decimal(65,10) NOT NULL,
  `lo_gps_long` decimal(65,10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`lo_id`, `lo_name`, `lo_address`, `lo_city`, `lo_gps_lat`, `lo_gps_long`) VALUES
(1, 'Le Corum', 'Place Charles de Gaulle, 34000 Montpellier', 'Montpellier', 43.6114039271, 3.8810784230),
(2, 'Zénith Sud', '2733 Avenue Albert Einstein, 34000 Montpellier', 'Montpellier', 43.6137900000, 3.9300100000);

-- --------------------------------------------------------

--
-- Structure de la table `logerror`
--

CREATE TABLE `logerror` (
  `log_id` int(11) NOT NULL,
  `MESSAGE` varchar(255) DEFAULT NULL,
  `THETIME` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logerror`
--

INSERT INTO `logerror` (`log_id`, `MESSAGE`, `THETIME`) VALUES
(1, 'ATTENTION, LE PRIX DOIT ETRE POSITIF', '2019-12-08 12:10:07'),
(2, 'ATTENTION, LE ROLE DOIT ETRE BON', '2019-12-12 15:42:30');

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

CREATE TABLE `rate` (
  `ra_date` date NOT NULL,
  `ra_rating` decimal(10,0) NOT NULL,
  `ra_us_id` decimal(10,0) NOT NULL,
  `ra_ev_id` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

CREATE TABLE `register` (
  `re_registration_date` date NOT NULL,
  `re_us_id` decimal(10,0) NOT NULL,
  `re_ev_id` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `th_id` int(11) NOT NULL,
  `th_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`th_id`, `th_name`) VALUES
(1, 'Spectacle'),
(2, 'Concert'),
(3, 'Exposition'),
(4, 'Festival'),
(5, 'Evènement sportif');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `us_id` int(11) NOT NULL,
  `us_password` text NOT NULL,
  `us_role` varchar(30) DEFAULT NULL,
  `us_last_name` varchar(30) DEFAULT NULL,
  `us_first_name` varchar(30) DEFAULT NULL,
  `us_email` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`us_id`, `us_password`, `us_role`, `us_last_name`, `us_first_name`, `us_email`) VALUES
(1, '12345', 'visitor', 'lamouchi', 'ambre', 'lamouchiambre@gmail.com'),
(2, '0', 'visitor', 'dieyny', 'emma', 'emma@gmail.com'),
(3, '$2y$10$DBNzkJhyV2pLiue57wbXre7smNvSUprbyDugpG4Uq/7.E.AV7gBoS', 'visitor', 'cc', 'alexandre', 'alex@mail.com');

--
-- Déclencheurs `user`
--
DELIMITER $$
CREATE TRIGGER `user_role_attribue` BEFORE INSERT ON `user` FOR EACH ROW IF NEW.us_role NOT IN ( 'administrator', 'contributor', 'visitor')  
    	THEN
        INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE ROLE DOIT ETRE BON"));
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE ROLE DOIT ETRE BON';
    END IF
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ev_id`),
  ADD KEY `fk_event_lo` (`ev_lo_id`),
  ADD KEY `fk_event_th` (`ev_th_id`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`lo_id`);

--
-- Index pour la table `logerror`
--
ALTER TABLE `logerror`
  ADD PRIMARY KEY (`log_id`);

--
-- Index pour la table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`ra_us_id`,`ra_ev_id`),
  ADD KEY `fk_ra_ev` (`ra_ev_id`);

--
-- Index pour la table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`re_us_id`,`re_ev_id`),
  ADD KEY `fk_re_ev` (`re_ev_id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`th_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `lo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `logerror`
--
ALTER TABLE `logerror`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
