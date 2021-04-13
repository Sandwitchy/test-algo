-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 avr. 2021 à 14:57
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_technique`
--

-- --------------------------------------------------------

--
-- Structure de la table `artisan`
--

DROP TABLE IF EXISTS `artisan`;
CREATE TABLE IF NOT EXISTS `artisan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `artisan`
--

INSERT INTO `artisan` (`id`, `name`) VALUES
(1, 'SuperElec'),
(2, 'MegaPool');

-- --------------------------------------------------------

--
-- Structure de la table `user_review`
--

DROP TABLE IF EXISTS `user_review`;
CREATE TABLE IF NOT EXISTS `user_review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `artisan_id` int NOT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `grade` int NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `review_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artisan_id` (`artisan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user_review`
--

INSERT INTO `user_review` (`id`, `artisan_id`, `author`, `grade`, `comment`, `review_date`) VALUES
(1, 2, 'Paul', 4, 'Super electricien', '2021-04-13 15:12:13'),
(2, 1, 'Michel', 2, 'Ouai bof', '2021-04-13 15:12:13'),
(3, 2, 'Jack', 4, 'excellent', '2021-04-13 15:13:01'),
(4, 2, 'Michel', 1, 'Très mauvais', '2021-04-13 15:13:01'),
(5, 1, 'Charles', 5, 'Excellent', '2021-04-13 15:13:58'),
(6, 1, 'Karl', 3, 'Bof', '2021-04-21 15:13:58'),
(7, 2, 'Giselle', 5, 'top', '2021-04-01 15:14:35'),
(8, 1, 'Olivier', 2, 'Bof', '2021-04-01 15:14:35');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `fk_artisan_id` FOREIGN KEY (`artisan_id`) REFERENCES `artisan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
