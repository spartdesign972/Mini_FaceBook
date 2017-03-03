-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 28 Février 2017 à 15:14
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wf3minifacebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `likestatus`
--

CREATE TABLE IF NOT EXISTS `likestatus` (
  `idLike` int(11) NOT NULL AUTO_INCREMENT,
  `Users_idUsers` int(11) NOT NULL,
  `Statut_idStatut` int(11) NOT NULL,
  PRIMARY KEY (`idLike`,`Users_idUsers`,`Statut_idStatut`),
  KEY `fk_Like_Users1_idx` (`Users_idUsers`),
  KEY `fk_Like_Statut1_idx` (`Statut_idStatut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `likestatus`
--

INSERT INTO `likestatus` (`idLike`, `Users_idUsers`, `Statut_idStatut`) VALUES
(1, 1, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `likestatus`
--
ALTER TABLE `likestatus`
  ADD CONSTRAINT `fk_Like_Statut1` FOREIGN KEY (`Statut_idStatut`) REFERENCES `statut` (`idStatut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Like_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
