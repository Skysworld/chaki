-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 09 Juin 2016 à 11:56
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
