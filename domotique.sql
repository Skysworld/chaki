-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Mai 2016 à 16:45
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `domotique`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `NomClient` varchar(20) NOT NULL COMMENT 'Nom de l''utilisateur',
  `Password` varchar(80) NOT NULL COMMENT 'mot de passe',
  PRIMARY KEY (`NomClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table de connexion';

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NomClient`, `Password`) VALUES
('Chaki', 'fa24b2577ed8df13a474'),
('Erwan', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
('Paul', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
  `ID_historique` int(11) NOT NULL AUTO_INCREMENT,
  `NomClient` varchar(20) NOT NULL,
  `Mac` varchar(48) NOT NULL,
  `EtatBool1` tinyint(1) DEFAULT NULL,
  `EtatBool2` tinyint(1) DEFAULT NULL,
  `EtatBool3` tinyint(1) DEFAULT NULL,
  `EtatBool4` tinyint(1) DEFAULT NULL,
  `EtatBool5` tinyint(1) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateExpiration` datetime NOT NULL,
  PRIMARY KEY (`ID_historique`),
  UNIQUE KEY `Modif_Num` (`ID_historique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`ID_historique`, `NomClient`, `Mac`, `EtatBool1`, `EtatBool2`, `EtatBool3`, `EtatBool4`, `EtatBool5`, `Date`, `DateExpiration`) VALUES
(51, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 08:54:37', '2016-05-27 08:54:37'),
(52, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 08:54:38', '2016-05-27 08:54:38'),
(55, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 08:56:19', '2016-05-27 08:56:19'),
(56, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 08:56:49', '2016-05-27 08:56:49'),
(57, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 08:57:45', '2016-05-27 08:57:45'),
(58, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 09:03:17', '2016-05-27 09:03:17'),
(59, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-20 09:03:31', '2016-05-27 09:03:31'),
(60, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:39:56', '2016-05-30 16:39:56'),
(61, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:39:58', '2016-05-30 16:39:58'),
(62, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:01', '2016-05-30 16:40:01'),
(63, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:03', '2016-05-30 16:40:03'),
(64, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:05', '2016-05-30 16:40:05'),
(65, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:07', '2016-05-30 16:40:07'),
(66, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:09', '2016-05-30 16:40:09'),
(67, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:12', '2016-05-30 16:40:12'),
(68, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:14', '2016-05-30 16:40:14'),
(69, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:40:16', '2016-05-30 16:40:16'),
(70, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:42:03', '2016-05-30 16:42:03'),
(71, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:42:05', '2016-05-30 16:42:05'),
(72, 'Paul', '18:fe:34:e4:c1:47', 0, 1, 0, 0, 0, '2016-05-23 16:42:07', '2016-05-30 16:42:07');

-- --------------------------------------------------------

--
-- Structure de la table `multiprise`
--

CREATE TABLE IF NOT EXISTS `multiprise` (
  `NomClient` varchar(20) NOT NULL COMMENT 'Nom de la prise',
  `Mac` varchar(48) NOT NULL COMMENT 'Adresse mac',
  `IDWeb` int(11) DEFAULT NULL,
  `EtatBool1` tinyint(1) NOT NULL COMMENT 'Etats des prises ',
  `EtatBool2` tinyint(1) NOT NULL,
  `EtatBool3` tinyint(1) NOT NULL,
  `EtatBool4` tinyint(1) NOT NULL,
  `EtatBool5` tinyint(1) NOT NULL,
  PRIMARY KEY (`Mac`),
  UNIQUE KEY `IDWeb` (`IDWeb`),
  KEY `Identifiant` (`NomClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table d''identification de la prise';

--
-- Contenu de la table `multiprise`
--

INSERT INTO `multiprise` (`NomClient`, `Mac`, `IDWeb`, `EtatBool1`, `EtatBool2`, `EtatBool3`, `EtatBool4`, `EtatBool5`) VALUES
('Paul', '18:fe:34:e4:c1:47', 1, 0, 1, 0, 0, 0),
('Paul', '25-F2-54-9F-85-ED', 14, 1, 1, 1, 1, 0),
('Paul', '2B-05-8D-94-08-B0', 11, 1, 1, 1, 0, 0),
('Chaki', '91-70-1B-DC-9E-FF', 13, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `programmation`
--

CREATE TABLE IF NOT EXISTS `programmation` (
  `Mac` varchar(48) NOT NULL,
  `IDWeb` int(11) DEFAULT NULL,
  `Nb_Ephe_Prise1` int(10) DEFAULT NULL,
  `Prise1_E1` int(10) DEFAULT NULL,
  `Prise1_E2` int(10) DEFAULT NULL,
  `Prise1_E3` int(10) DEFAULT NULL,
  `Prise1_E4` int(10) DEFAULT NULL,
  `Prise1_E5` int(10) DEFAULT NULL,
  `Nb_Ephe_Prise2` int(10) DEFAULT NULL,
  `Prise2_E1` int(10) DEFAULT NULL,
  `Prise2_E2` int(10) DEFAULT NULL,
  `Prise2_E3` int(10) DEFAULT NULL,
  `Prise2_E4` int(10) DEFAULT NULL,
  `Prise2_E5` int(10) DEFAULT NULL,
  `Nb_Ephe_Prise3` int(10) DEFAULT NULL,
  `Prise3_E1` int(10) DEFAULT NULL,
  `Prise3_E2` int(10) DEFAULT NULL,
  `Prise3_E3` int(10) DEFAULT NULL,
  `Prise3_E4` int(10) DEFAULT NULL,
  `Prise3_E5` int(10) DEFAULT NULL,
  `Nb_Ephe_Prise4` int(10) DEFAULT NULL,
  `Prise4_E1` int(10) DEFAULT NULL,
  `Prise4_E2` int(10) DEFAULT NULL,
  `Prise4_E3` int(10) DEFAULT NULL,
  `Prise4_E4` int(10) DEFAULT NULL,
  `Prise4_E5` int(10) DEFAULT NULL,
  `Nb_Ephe_Prise5` int(10) DEFAULT NULL,
  `Prise5_E1` int(10) DEFAULT NULL,
  `Prise5_E2` int(10) DEFAULT NULL,
  `Prise5_E3` int(10) DEFAULT NULL,
  `Prise5_E4` int(10) DEFAULT NULL,
  `Prise5_E5` int(10) DEFAULT NULL,
  UNIQUE KEY `MAC` (`Mac`),
  UNIQUE KEY `IDWeb` (`IDWeb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `programmation`
--

INSERT INTO `programmation` (`Mac`, `IDWeb`, `Nb_Ephe_Prise1`, `Prise1_E1`, `Prise1_E2`, `Prise1_E3`, `Prise1_E4`, `Prise1_E5`, `Nb_Ephe_Prise2`, `Prise2_E1`, `Prise2_E2`, `Prise2_E3`, `Prise2_E4`, `Prise2_E5`, `Nb_Ephe_Prise3`, `Prise3_E1`, `Prise3_E2`, `Prise3_E3`, `Prise3_E4`, `Prise3_E5`, `Nb_Ephe_Prise4`, `Prise4_E1`, `Prise4_E2`, `Prise4_E3`, `Prise4_E4`, `Prise4_E5`, `Nb_Ephe_Prise5`, `Prise5_E1`, `Prise5_E2`, `Prise5_E3`, `Prise5_E4`, `Prise5_E5`) VALUES
('18:fe:34:e4:c1:47', 1, 2, 114101600, 103001655, 316302000, 0, 0, 0, 114101600, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('25-F2-54-9F-85-ED', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `multiprise`
--
ALTER TABLE `multiprise`
  ADD CONSTRAINT `multiprise_ibfk_1` FOREIGN KEY (`NomClient`) REFERENCES `client` (`NomClient`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
