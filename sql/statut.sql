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
-- Structure de la table `statut`
--

CREATE TABLE IF NOT EXISTS `statut` (
  `idStatut` int(11) NOT NULL AUTO_INCREMENT,
  `StatutTitle` varchar(50) NOT NULL,
  `StatutPictureUrl` varchar(255) DEFAULT NULL,
  `StatutVideoURL` varchar(255) DEFAULT NULL,
  `StatutText` longtext,
  `StatutDatePublication` date NOT NULL,
  `Users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idStatut`,`Users_idUsers`),
  KEY `fk_Statut_Users_idx` (`Users_idUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`idStatut`, `StatutTitle`, `StatutPictureUrl`, `StatutVideoURL`, `StatutText`, `StatutDatePublication`, `Users_idUsers`) VALUES
(1, 'Le pouvoir du feu', 'picture/feu.png', '//ht//tps://www.youtube.com/watch?v=AMeHq4hA-Vc', 'Le pouvoir du feu est déter mais attention à ne pas vous bruler.Il faut pouvoir résister à des température très élevées pour maîtriser ce pouvoir.Le pouvoir du feu est déter mais attention à ne pas vous bruler.Il faut pouvoir résister à des température très élevées pour maîtriser ce pouvoir.Le pouvoir du feu est déter mais attention à ne pas vous bruler.Il faut pouvoir résister à des température très élevées pour maîtriser ce pouvoir.Le pouvoir du feu est déter mais attention à ne pas vous bruler.Il faut pouvoir résister à des température très élevées pour maîtriser ce pouvoir.Le pouvoir du feu est déter mais attention à ne pas vous bruler.Il faut pouvoir résister à des température très élevées pour maîtriser ce pouvoir.', '2017-01-27', 1),
(2, 'Le pouvoir de l''eau', 'picture/eau.png', 'ht//tps://www.youtube.com/watch?v=_NX7FNdWz0E', 'Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.Le pouvoir de l''eau est humide, très humide.Donc si vous aimez restez au sec n''essayer même pas.', '2017-01-03', 1),
(3, 'Le pouvoir de la terre', 'picture/terre.png', 'https://www.youtube.com/watch?v=5RsBqUkDozU', 'Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.Le pouvoir de la terre est un honneur, n''en faites pas usage n''importe comment.', '2017-02-01', 2),
(4, 'La force est en toi', 'image.png', '', 'nbhbsdubdsubsdbdslbsdlnblsdnsldnsdhosidhgbisehisdhohgdnoihgnounfoufgoihgoihgughiughoufghofgo', '2017-06-06', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `statut`
--
ALTER TABLE `statut`
  ADD CONSTRAINT `fk_Statut_Users` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
