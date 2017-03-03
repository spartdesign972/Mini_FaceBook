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
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `UserLastName` varchar(50) NOT NULL,
  `UserFirstName` varchar(50) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserBirtday` date NOT NULL,
  `UserGender` varchar(10) DEFAULT NULL,
  `UserAvatar` varchar(45) DEFAULT NULL,
  `UserDescription` varchar(45) DEFAULT NULL,
  `UserSubscribeDate` date NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `UserLastName`, `UserFirstName`, `UserEmail`, `UserPassword`, `UserBirtday`, `UserGender`, `UserAvatar`, `UserDescription`, `UserSubscribeDate`) VALUES
(1, 'Machin', 'Ang', 'machinang@mail.com', '', '1980-09-02', 'homme', 'avatar/avatar_homme.png', 'Je suis un gars qui est en mode je sais pas q', '2016-11-08'),
(2, 'Sexy', 'Katara', 'sexykatara@mail.com', '', '1985-02-11', 'femme', 'avatar/avatar_femme.png', 'Je suis une fille qui manie l''eau.Faites gaff', '2016-08-15'),
(3, 'Machin', 'Chouette', 'machinchouette@mail.com', '', '1981-02-05', 'homme', 'avatar/avatar_homme', 'Texte aléatoire d''une certaine longueur', '2017-02-26'),
(4, 'Machin', 'Chouette', 'msdkmlk@mail.com', 'azerty', '1981-02-05', 'homme', 'avatar/avatar_homme', 'Texte aléatoire d''une certaine longueur', '2017-02-26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
