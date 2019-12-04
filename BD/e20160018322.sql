-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.etu.umontpellier.fr
-- Généré le :  mer. 04 déc. 2019 à 12:51
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
  `ev_id` decimal(10,0) NOT NULL,
  `ev_price` decimal(10,2) DEFAULT NULL,
  `ev_date_start` date NOT NULL,
  `ev_date_end` date NOT NULL,
  `ev_start_time` time NOT NULL,
  `ev_end_time` time NOT NULL,
  `ev_nb_people_min` decimal(30,0) DEFAULT NULL,
  `ev_nb_people_max` decimal(30,0) DEFAULT NULL,
  `ev_descriptive` text COLLATE utf8mb4_unicode_ci,
  `ev_average` decimal(10,0) DEFAULT NULL,
  `ev_lo_id` decimal(10,0) NOT NULL,
  `ev_th_id` decimal(10,0) NOT NULL,
  `ev_picture` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`ev_id`, `ev_price`, `ev_date_start`, `ev_date_end`, `ev_start_time`, `ev_end_time`, `ev_nb_people_min`, `ev_nb_people_max`, `ev_descriptive`, `ev_average`, `ev_lo_id`, `ev_th_id`, `ev_picture`) VALUES
(1, 39.00, '2020-01-11', '2020-01-11', '20:30:00', '22:30:00', NULL, 500, '<p>\r\nLE LAC DES CYGNES <br>\r\nBallet classique en deux actes et 4 tableaux <br>\r\nMusique :Piotr Tchaïkovski <br>\r\nChorégraphie : Marius Petipa <br>\r\nLe Lac des cygnes a été présenté la première fois à Moscou en 1877. <br>\r\nL’histoire d’amour du prince pour une jeune fille, transformée en cygne par un sorcier, est un sujet fantastique où la danseuse principale a un double personnage à jouer et à danser – Odette, cygne blanc, lyrique et poétique, Odile, cygne noir, maléfique et fatal. <br>\r\nC’est l’école russe de danse classique, l’école d’excellence de Saint-Pétersbourg, que les spectateurs pourront voir sur scène. Les danseurs ont été formés dans les meilleures écoles de ballet de Russie d’après la méthode Vaganova de Saint-Pétersbourg. <br>\r\nLe Lac des cygnes fait partie des ballets les plus connus au monde et le plus joué dans les théâtres. <br>\r\nLa musique de Piotr Tchaïkovski transporte le spectateur dans un univers poétique, un univers de grâce, d’élégance et de beauté infinie. <br>\r\nLa splendeur des décors et des costumes, l’orchestre live, l’esthétique et la poésie de la danse classique ,interprétée avec brio et élégance par les danseurs russes, font de ce spectacle un vrai joyau pour toute la famille ! <br>Réservations Personne à Mobilité Réduite (PMR) Tél : 0467546123</p>', NULL, 1, 1, 'http://www.montpellier-events.com/var/mtp/storage/images/agenda/le-lac-des-cygnes7/60491-1-fre-FR/LE'),
(2, 39.00, '2020-01-19', '2020-01-19', '18:00:00', '20:00:00', NULL, 500, '				\r\n                \r\n<p><b>Casse-Noisette – </b><b>Opéra national de Russie</b></p><p><b>Vivez la magie de Noël en 2019 avec le chef d’œuvre classique <i>Casse-Noisette</i>&nbsp;!</b></p><p>Ce conte de Noël raconte l’histoire de la jeune Clara qui reçoit en cadeau un casse-noisette en forme de petit bonhomme. Dans une nuit animée d’un mystérieux enchantement, les jouets menés par Casse-Noisette se livrent à une bataille acharnée contre les méchantes souris de la maison. Réveillée par le bruit, Clara décide d’affronter ses peurs en participant au combat et sauve son cher Casse Noisette du danger. Ému par son courage et plein de gratitude, il se transforme en prince charmant et emmène Clara dans un royaume féérique.</p><p>Ballet en deux actes, Casse-Noisette&nbsp;est présenté au public pour la première fois en décembre 1892 à Saint-Pétersbourg au Théâtre Mariinsky. La célèbre musique de Tchaïkovsky interprétée par le talentueux orchestre et la virtuosité des danseurs, sublimés par des décors et costumes époustouflants, feront vibrer petits et grands dans ce monde fantastique. Cette partition inoubliable vous plongera dans une atmosphère magique et vous fera revivre vos rêves d’enfants.</p><p>Retrouvez toute la beauté de ce joyau du répertoire classique, idéal en cette période de Noël.</p><p class=\" text-justify\"><b>Réservations pour les Personnes à Mobilité Réduite : 01 55 12 00 00</b></p>            ', NULL, 1, 1, 'http://www.montpellier-events.com/var/mtp/storage/images/agenda/casse-noisette2/60511-1-fre-FR/CASSE-NOISETTE_listing_agenda2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `lo_id` decimal(10,0) NOT NULL,
  `lo_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lo_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lo_city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lo_gps_lat` decimal(65,10) NOT NULL,
  `lo_gps_long` decimal(65,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`lo_id`, `lo_name`, `lo_address`, `lo_city`, `lo_gps_lat`, `lo_gps_long`) VALUES
(1, 'Le Corum', 'Place Charles de Gaulle, 34000 Montpellier', 'Montpellier', 43.6200000000, 3.8300000000),
(2, 'Zénith Sud', '2733 Avenue Albert Einstein, 34000 Montpellier', 'Montpellier', 43.6137900000, 3.9300100000);

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

CREATE TABLE `rate` (
  `ra_date` date NOT NULL,
  `ra_rating` decimal(10,0) NOT NULL,
  `ra_us_id` decimal(10,0) NOT NULL,
  `ra_ev_id` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

CREATE TABLE `register` (
  `re_registration_date` date NOT NULL,
  `re_us_id` decimal(10,0) NOT NULL,
  `re_ev_id` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `th_id` decimal(10,0) NOT NULL,
  `th_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `us_id` decimal(10,0) NOT NULL,
  `us_password` decimal(30,0) NOT NULL,
  `us_role` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_lo` FOREIGN KEY (`ev_lo_id`) REFERENCES `locations` (`lo_id`),
  ADD CONSTRAINT `fk_event_th` FOREIGN KEY (`ev_th_id`) REFERENCES `theme` (`th_id`);

--
-- Contraintes pour la table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `fk_ra_ev` FOREIGN KEY (`ra_ev_id`) REFERENCES `events` (`ev_id`),
  ADD CONSTRAINT `fk_ra_us` FOREIGN KEY (`ra_us_id`) REFERENCES `user` (`us_id`);

--
-- Contraintes pour la table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_re_ev` FOREIGN KEY (`re_ev_id`) REFERENCES `events` (`ev_id`),
  ADD CONSTRAINT `fk_re_us` FOREIGN KEY (`re_us_id`) REFERENCES `user` (`us_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
