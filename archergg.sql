-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 déc. 2023 à 15:26
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

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
