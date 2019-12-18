-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.etu.umontpellier.fr
-- Généré le :  mer. 18 déc. 2019 à 10:58
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
(3, 4, 3, 'Les hivernales', 0.00, '2019-11-27', '2019-12-28', '20:00:00', '23:59:00', NULL, NULL, 'Depuis 10 ans, la Ville de Montpellier organise en décembre pour les Montpelliérains et les visiteurs de tous horizons un marché de Noël du Sud.</br>\r\n\r\nUn véritable village de Noël s\'installe sur l\'Esplanade Charles de Gaulle. Les artisans et commerçants accueillent les visiteurs dans leurs chalets pour le plus grand plaisir des yeux, des papilles et d’offrir.<br/>\r\n\r\nCette année, la Ville de Montpellier met l’accent sur la présence d’artisans locaux et la mise en valeur de leur savoir-faire.</br>\r\n\r\nEn effet, une vingtaine de maître-artisans, artisans en métier d’art, artistes-auteurs seront valorisés. Le public pourra trouver différents types de professions :</br>\r\n- dans le domaine alimentaire : chocolatier, fabriquant de pains d’épices, macarons, fruits confits, bonbons,...</br>\r\n- dans le domaine artistique : des maîtres santonniers, des céramistes, des couteliers, des fabricants de bijoux, sacs et accessoires, tableaux.</br>', NULL, 'https://www.montpellier.fr/uploads/Image/ee/34910_342_BANNERS-HIVERNALES-11-19-NG.jpg'),
(12, 2, 5, 'WE ARE THE 90S (Wat90s)', 16.00, '2019-12-20', '2019-12-20', '23:52:00', '02:00:00', NULL, NULL, 'La We Are The 90s est une soirée organisée par un groupe d\'amis à la fois fans et nostalgiques de la décennie de leurs années collège. Rapidement l\'idée de faire des soirées « revival »', NULL, 'img/events/default.jpg'),
(8, 5, 5, 'Montpellier Brest', 12.00, '2019-12-21', '2019-12-21', '20:45:00', '22:45:00', NULL, NULL, 'FOOTBALL - Ligue 1 Conforama, Saison 2019/2020\r\n\r\n- Les dates et horaires indiqués sur les billets ne sont pas définitifs, les informations sont susceptibles de modifications de la part de la LFP, il appartient à la personne qui achète le billet de se tenir informé des éventuels changements de date et/ou d’horaire concernant la rencontre. \r\n\r\nRéservez vos places de sport pour : MONTPELLIER HSC / STADE BRESTOIS 29 - STADE DE LA MOSSON\r\nLe prix des places est à partir de : 12.00 €', NULL, 'img/events/default.jpg'),
(6, 1, 1, 'Goûter Magique', 0.00, '2019-12-05', '2019-12-05', '16:00:00', '20:00:00', NULL, NULL, '</br>\r\nSpectacle de fin d\'année des école Elementaire de montpellier.', NULL, 'img/events/default.jpg');

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
(2, 'Zénith Sud', '2733 Avenue Albert Einstein, 34000 Montpellier', 'Montpellier', 43.6137900000, 3.9300100000),
(3, 'Esplanade Charles-de-Gaulle', '', 'Montpellier', 43.6109890000, 3.8818590000),
(5, 'Stade de la Mosson', '345 Avenue de Heidelberg, 34080 Montpellier', 'Montpellier', 43.6220770000, 3.8120900000),
(6, 'Le Rockstore', '20 Rue de Verdun, 34000 Montpellier', 'Montpellier', 43.6062310000, 3.8812150000);

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

--
-- Déchargement des données de la table `register`
--

INSERT INTO `register` (`re_registration_date`, `re_us_id`, `re_ev_id`) VALUES
('2019-12-17', 4, 1),
('2019-12-18', 7, 1),
('2019-12-18', 7, 2),
('2019-12-02', 3, 6);

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
(5, 'Evènement sportif'),
(6, 'marcher');

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
(1, '$2y$10$jxT2IXhINBhICViTrtp55uBZD.2k1V7Tu7pDXTFopU5yFmOd2JDK2', 'administrator', 'Lamouchi', 'Ambre', 'ambre.lamouchi@mail.com'),
(2, '$2y$10$QXhou1fq9mFqxL0GelxQhO.9i60bnNih8zfHol6gRl.J7QvaaD2Me', 'administrator', 'Canton Condes', 'Alexandre', 'canton.alex@live.fr'),
(3, '$2y$10$FxjQ3sKp8hAvgUQ1tOhxgeWt6MMjxdW76W9as2SnrRmtk7uceAey6', 'visitor', 'peler', 'arnaud', 'arnaud.peler@mail.com');

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
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `lo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `logerror`
--
ALTER TABLE `logerror`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
