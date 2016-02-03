-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 04 Février 2016 à 00:47
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
-- Structure de la table `identifiant`
--

CREATE TABLE IF NOT EXISTS `identifiant` (
  `Identi` varchar(20) NOT NULL COMMENT 'Nom de l''utilisateur',
  `Password` varchar(20) NOT NULL COMMENT 'mot de passe',
  PRIMARY KEY (`Identi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table de connexion';

--
-- Contenu de la table `identifiant`
--

INSERT INTO `identifiant` (`Identi`, `Password`) VALUES
('bleu', '123456'),
('chose', '321'),
('Massard', '123');

-- --------------------------------------------------------

--
-- Structure de la table `prise`
--

CREATE TABLE IF NOT EXISTS `prise` (
  `Identity` varchar(20) NOT NULL COMMENT 'Nom de la prise',
  `Mac` varchar(48) NOT NULL COMMENT 'Adresse mac',
  `IDWeb` int(11) NOT NULL,
  `EtatBool1` tinyint(1) NOT NULL COMMENT 'Etats des prises ',
  `EtatBool2` tinyint(1) NOT NULL,
  `EtatBool3` tinyint(1) NOT NULL,
  `EtatBool4` tinyint(1) NOT NULL,
  `EtatBool5` tinyint(1) NOT NULL,
  PRIMARY KEY (`Mac`),
  KEY `Identi` (`Identity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table d''identification de la prise';

--
-- Contenu de la table `prise`
--

INSERT INTO `prise` (`Identity`, `Mac`, `IDWeb`, `EtatBool1`, `EtatBool2`, `EtatBool3`, `EtatBool4`, `EtatBool5`) VALUES
('bleu', '41:45:pm', 0, 1, 1, 0, 0, 1),
('Massard', 'b4:b4:b4', 0, 0, 0, 0, 0, 0),
('chose', 'b4:b4:b4:x1', 0, 1, 1, 1, 1, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `prise`
--
ALTER TABLE `prise`
  ADD CONSTRAINT `prise_ibfk_1` FOREIGN KEY (`Identity`) REFERENCES `identifiant` (`Identi`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
