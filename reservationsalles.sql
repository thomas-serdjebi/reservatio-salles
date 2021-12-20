-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 déc. 2021 à 13:02
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(27, 'test10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2022-01-03 16:00:00', '2022-01-03 17:00:00', 4),
(26, 'test8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-17 18:00:00', '2021-12-17 19:00:00', 4),
(25, 'test7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-17 16:00:00', '2021-12-17 17:00:00', 4),
(24, 'test6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-17 15:00:00', '2021-12-17 16:00:00', 4),
(23, 'test5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-17 12:00:00', '2021-12-17 13:00:00', 4),
(22, 'test4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-17 10:00:00', '2021-12-17 11:00:00', 4),
(21, 'test3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-16 17:00:00', '2021-12-16 18:00:00', 4),
(20, 'test2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-16 10:00:00', '2021-12-16 11:00:00', 4),
(19, 'test1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed urna sapien, imperdiet eu odio quis, posuere accumsan velit. Nullam at dolor bibendum, tempus diam eu, malesuada orci. Proin scelerisque lacus nec posuere aliquet. Nulla a facilisis ex. Suspendisse consequat dui mauris, id cursus enim congue sed. Proin sed tellus metus. Ut in magna metus. Etiam a velit nibh. Nullam massa massa, accumsan mollis leo sit amet, iaculis mollis erat. Quisque tristique urna in mi porttitor tempor. Quisque et.', '2021-12-16 14:00:00', '2021-12-16 15:00:00', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'harrypotter', 'bd4325ad55a77e2951508b9674400f61'),
(2, 'hermionegranger', 'bd4325ad55a77e2951508b9674400f61'),
(3, 'fredweasley', '485c742e331150893e2fb69577e0279b'),
(4, 'testform', 'bd4325ad55a77e2951508b9674400f61');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
