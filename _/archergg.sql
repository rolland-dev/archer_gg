-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 déc. 2023 à 07:28
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archergg`
--

-- --------------------------------------------------------

--
-- Structure de la table `archers`
--

DROP TABLE IF EXISTS `archers`;
CREATE TABLE IF NOT EXISTS `archers` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `date_n` date NOT NULL,
  `email` varchar(20) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `pere` varchar(100) DEFAULT NULL,
  `mere` varchar(100) DEFAULT NULL,
  `licence` varchar(50) NOT NULL,
  `certif` int NOT NULL,
  `valide` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `archers`
--

INSERT INTO `archers` (`id`, `nom`, `prenom`, `sexe`, `date_n`, `email`, `tel`, `mobile`, `pere`, `mere`, `licence`, `certif`, `valide`) VALUES
(1, 'rolland', 'didier', 'M', '1972-06-27', 'didier.rld@gmail.com', '0323240255', '0626842797', '', '', 'compétition', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fleches`
--

DROP TABLE IF EXISTS `fleches`;
CREATE TABLE IF NOT EXISTS `fleches` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `couleur` varchar(50) NOT NULL,
  `point` int NOT NULL,
  `archers_id` int NOT NULL,
  `date` date NOT NULL,
  `valide` int NOT NULL,
  `validateur` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `plumes`
--

DROP TABLE IF EXISTS `plumes`;
CREATE TABLE IF NOT EXISTS `plumes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `couleur` varchar(50) NOT NULL,
  `point` int NOT NULL,
  `archers_id` int NOT NULL,
  `date` date NOT NULL,
  `valide` int NOT NULL,
  `validateur` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `plumes`
--

INSERT INTO `plumes` (`id`, `couleur`, `point`, `archers_id`, `date`, `valide`, `validateur`) VALUES
(1, 'jaune', 210, 1, '2023-12-16', 0, 'Jean Luc GRELET'),
(2, 'rouge', 200, 1, '2023-12-15', 0, 'Jean Luc GRELET'),
(3, 'noire', 221, 1, '2023-12-15', 0, 'Jean Luc GRELET');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `mdp`, `role`) VALUES
(1, 'rolland.didier', '$2y$10$X0D3dCxGZMYcBobHHEIVWeStcDVY4OZ5GO5kytjv90USe1z5/jTYa', 'ADMIN'),
(2, 'rolland.didier', NULL, 'ARCHER');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
