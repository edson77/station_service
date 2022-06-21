-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 juin 2020 à 15:55
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `station`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

DROP TABLE IF EXISTS `alerte`;
CREATE TABLE IF NOT EXISTS `alerte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alerte`
--

INSERT INTO `alerte` (`id`, `jour`, `status`) VALUES
(74, '2020-06-01', 1),
(64, '2020-06-02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `bons`
--

DROP TABLE IF EXISTS `bons`;
CREATE TABLE IF NOT EXISTS `bons` (
  `identifiant` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `date_bon` datetime NOT NULL,
  `localite` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `montant` double NOT NULL,
  `libelle` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bons`
--

INSERT INTO `bons` (`identifiant`, `categorie`, `date_bon`, `localite`, `nom`, `montant`, `libelle`, `status`) VALUES
('BON-1590780667', 'A5', '2020-05-29 00:00:00', 'Efoulan', 'Amaori Learn', 10000, 'se bon est un bom pour une aide au deplacement', 2),
('BON-1590919318', 'A4', '2020-05-31 00:00:00', 'messamena', 'Amazina lorn', 100000, 'le bon est pour une association à but non lucratif', 0);

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `disponible` double NOT NULL,
  PRIMARY KEY (`disponible`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `citerne`
--

DROP TABLE IF EXISTS `citerne`;
CREATE TABLE IF NOT EXISTS `citerne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_livraison` datetime DEFAULT NULL,
  `type_carburant` varchar(255) NOT NULL,
  `quantiteLivree` double NOT NULL,
  `compagnie` varchar(255) NOT NULL,
  `montant` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `citerne`
--

INSERT INTO `citerne` (`id`, `date_livraison`, `type_carburant`, `quantiteLivree`, `compagnie`, `montant`) VALUES
(6, '2020-05-25 00:00:00', 'essence', 100000, 'GTA city', 50000),
(7, '2020-05-25 00:00:00', 'gazoil', 100000, 'GTA city', 50500),
(8, '2020-05-31 00:00:00', 'essence', 30, 'LERNA 90', 40000);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `numeroCNI` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `fonction` varchar(50) DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  PRIMARY KEY (`numeroCNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numeroCNI`, `nom`, `grade`, `fonction`, `tel`) VALUES
('1257T15', 'Amaori Learn', 'A2', 'Dentiste', '697878606');

-- --------------------------------------------------------

--
-- Structure de la table `consommation`
--

DROP TABLE IF EXISTS `consommation`;
CREATE TABLE IF NOT EXISTS `consommation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_consomation` datetime DEFAULT NULL,
  `quantite_carburant` double NOT NULL,
  `montant_consomation` double NOT NULL,
  `typeCarburant` varchar(50) NOT NULL,
  `pompe` varchar(255) NOT NULL,
  `modepayement` varchar(255) NOT NULL,
  `id_station_service` int(11) NOT NULL,
  `immatriculation` varchar(50) NOT NULL,
  `numeroCNI` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `consommation_station_service_FK` (`id_station_service`),
  KEY `consommation_voitures0_FK` (`immatriculation`),
  KEY `consommation_client1_FK` (`numeroCNI`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consommation`
--

INSERT INTO `consommation` (`id`, `date_consomation`, `quantite_carburant`, `montant_consomation`, `typeCarburant`, `pompe`, `modepayement`, `id_station_service`, `immatriculation`, `numeroCNI`, `deleted`) VALUES
(2, '0202-05-15 00:00:00', 20, 3000, 'essence', 'pompe1', 'espece', 1, '157T1478', '1257T15', 0),
(3, '2020-05-29 00:00:00', 20, 2000, 'essence', 'pompe1', 'boncarburant', 1, '157T1478', '1257T15', 0),
(4, '2020-05-29 00:00:00', 20, 2000, 'essence', 'pompe1', 'boncarburant', 1, '157T1478', '1257T15', 0),
(5, '2020-05-29 00:00:00', 20, 52522, 'essence', 'pompe1', 'espece', 1, '157T1478', '1257T15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `auteur` int(11) NOT NULL,
  `jour` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`id`, `libelle`, `created_at`, `updated_at`, `auteur`, `jour`) VALUES
(34, 'Bitjoka Edson vient d enregistrer une nouvelle livraison de la sociétéGTA city le2020-05-25 08:17:37', '2020-05-25 08:17:37', '2020-05-25 08:17:37', 1, '2020-05-25'),
(35, 'Bitjoka Edson vient d enregistrer une nouvelle livraison de la sociétéGTA city le2020-05-25 08:18:35', '2020-05-25 08:18:35', '2020-05-25 08:18:35', 1, '2020-05-25'),
(36, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-25 17:29:16', '2020-05-25 17:29:16', 1, '2020-05-25'),
(37, 'Bitjoka Edson vient d\'enregistré la consommation du vihicule immatriculé64aze46azeAppartenant à azeazeaze', '2020-05-25 18:21:00', '2020-05-25 18:21:00', 1, '2020-05-25'),
(38, 'Bitjoka Edson vient d\'enregistré la consommation du vihicule immatriculé157T1478Appartenant à Amaori Learn', '2020-05-25 18:29:33', '2020-05-25 18:29:33', 1, '2020-05-25'),
(39, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-27 06:47:27', '2020-05-27 06:47:27', 1, '2020-05-27'),
(40, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-27 14:03:49', '2020-05-27 14:03:49', 1, '2020-05-27'),
(41, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-28 06:20:00', '2020-05-28 06:20:00', 1, '2020-05-28'),
(42, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-28 15:12:32', '2020-05-28 15:12:32', 1, '2020-05-28'),
(43, 'Impression de la liste des utilisateurs', '2020-05-28 16:14:16', '2020-05-28 16:14:16', 1, '2020-05-28'),
(44, 'Impression de la liste des utilisateurs', '2020-05-28 16:19:06', '2020-05-28 16:19:06', 1, '2020-05-28'),
(45, 'Impression de la liste des utilisateurs', '2020-05-28 16:21:17', '2020-05-28 16:21:17', 1, '2020-05-28'),
(46, 'Impression de la liste des utilisateurs', '2020-05-28 16:23:52', '2020-05-28 16:23:52', 1, '2020-05-28'),
(47, 'Impression de la liste des utilisateurs', '2020-05-28 16:26:00', '2020-05-28 16:26:00', 1, '2020-05-28'),
(48, 'Impression de la liste des utilisateurs', '2020-05-28 16:30:02', '2020-05-28 16:30:02', 1, '2020-05-28'),
(49, 'Impression de la liste des utilisateurs', '2020-05-28 16:32:06', '2020-05-28 16:32:06', 1, '2020-05-28'),
(50, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-28 16:35:01', '2020-05-28 16:35:01', 1, '2020-05-28'),
(51, 'Impression de la liste des utilisateurs', '2020-05-28 16:36:08', '2020-05-28 16:36:08', 1, '2020-05-28'),
(52, 'Impression de la liste des utilisateurs', '2020-05-28 16:42:05', '2020-05-28 16:42:05', 1, '2020-05-28'),
(53, 'Impression de la liste des utilisateurs', '2020-05-28 16:44:13', '2020-05-28 16:44:13', 1, '2020-05-28'),
(54, 'Impression de la liste des utilisateurs', '2020-05-28 16:50:09', '2020-05-28 16:50:09', 1, '2020-05-28'),
(55, 'Impression de la liste des utilisateurs', '2020-05-28 16:54:26', '2020-05-28 16:54:26', 1, '2020-05-28'),
(56, 'Impression de la liste des utilisateurs', '2020-05-28 17:02:19', '2020-05-28 17:02:19', 1, '2020-05-28'),
(57, 'Impression de la liste des utilisateurs', '2020-05-28 17:33:12', '2020-05-28 17:33:12', 1, '2020-05-28'),
(58, 'Impression de la liste des utilisateurs', '2020-05-28 17:33:15', '2020-05-28 17:33:15', 1, '2020-05-28'),
(59, 'Impression de la liste des utilisateurs', '2020-05-28 17:33:16', '2020-05-28 17:33:16', 1, '2020-05-28'),
(60, 'Impression de la liste des utilisateurs', '2020-05-28 17:34:33', '2020-05-28 17:34:33', 1, '2020-05-28'),
(61, 'Impression de la liste des livraisons', '2020-05-28 17:49:26', '2020-05-28 17:49:26', 1, '2020-05-28'),
(62, 'Impression de la liste des livraisons', '2020-05-28 17:49:27', '2020-05-28 17:49:27', 1, '2020-05-28'),
(63, 'Impression de la liste des livraisons', '2020-05-28 17:49:28', '2020-05-28 17:49:28', 1, '2020-05-28'),
(64, 'Impression de la liste des livraisons', '2020-05-28 17:53:34', '2020-05-28 17:53:34', 1, '2020-05-28'),
(65, 'Impression de la liste des livraisons', '2020-05-28 17:54:11', '2020-05-28 17:54:11', 1, '2020-05-28'),
(66, 'Impression de la liste des livraisons', '2020-05-28 17:54:15', '2020-05-28 17:54:15', 1, '2020-05-28'),
(67, 'Impression de la liste des livraisons', '2020-05-28 17:54:16', '2020-05-28 17:54:16', 1, '2020-05-28'),
(68, 'Impression de la liste des livraisons', '2020-05-28 17:55:26', '2020-05-28 17:55:26', 1, '2020-05-28'),
(69, 'Impression de la liste des livraisons', '2020-05-28 17:55:58', '2020-05-28 17:55:58', 1, '2020-05-28'),
(70, 'Impression de la liste des livraisons', '2020-05-28 17:56:01', '2020-05-28 17:56:01', 1, '2020-05-28'),
(71, 'Impression de la liste des livraisons', '2020-05-28 17:56:02', '2020-05-28 17:56:02', 1, '2020-05-28'),
(72, 'Impression de la liste des utilisateurs', '2020-05-28 18:05:54', '2020-05-28 18:05:54', 1, '2020-05-28'),
(73, 'Impression de la liste des utilisateurs', '2020-05-28 18:06:25', '2020-05-28 18:06:25', 1, '2020-05-28'),
(74, 'Impression de la liste des utilisateurs', '2020-05-28 18:07:00', '2020-05-28 18:07:00', 1, '2020-05-28'),
(75, 'Impression de la liste des utilisateurs', '2020-05-28 18:07:03', '2020-05-28 18:07:03', 1, '2020-05-28'),
(76, 'Impression de la liste des utilisateurs', '2020-05-28 18:07:05', '2020-05-28 18:07:05', 1, '2020-05-28'),
(77, 'Impression de la liste des bons de carburant', '2020-05-28 18:16:06', '2020-05-28 18:16:06', 1, '2020-05-28'),
(78, 'Impression de la liste des bons de carburant', '2020-05-28 18:16:08', '2020-05-28 18:16:08', 1, '2020-05-28'),
(79, 'Impression de la liste des bons de carburant', '2020-05-28 18:16:08', '2020-05-28 18:16:08', 1, '2020-05-28'),
(80, 'Impression de la liste des bons de carburant', '2020-05-28 18:17:11', '2020-05-28 18:17:11', 1, '2020-05-28'),
(81, 'Impression de la liste des bons de carburant', '2020-05-28 18:17:14', '2020-05-28 18:17:14', 1, '2020-05-28'),
(82, 'Impression de la liste des bons de carburant', '2020-05-28 18:17:15', '2020-05-28 18:17:15', 1, '2020-05-28'),
(83, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 05:00:29', '2020-05-29 05:00:29', 1, '2020-05-29'),
(84, 'Impression d\'un utilisateur', '2020-05-29 05:38:21', '2020-05-29 05:38:21', 1, '2020-05-29'),
(85, 'Impression d\'un utilisateur', '2020-05-29 05:40:37', '2020-05-29 05:40:37', 1, '2020-05-29'),
(86, 'Impression d\'un utilisateur', '2020-05-29 05:44:25', '2020-05-29 05:44:25', 1, '2020-05-29'),
(87, 'Impression d\'un utilisateur', '2020-05-29 05:44:31', '2020-05-29 05:44:31', 1, '2020-05-29'),
(88, 'Impression d\'un utilisateur', '2020-05-29 05:44:34', '2020-05-29 05:44:34', 1, '2020-05-29'),
(89, 'Impression d\'un utilisateur', '2020-05-29 06:14:37', '2020-05-29 06:14:37', 1, '2020-05-29'),
(90, 'Impression d\'un utilisateur', '2020-05-29 06:14:39', '2020-05-29 06:14:39', 1, '2020-05-29'),
(91, 'Impression d\'un utilisateur', '2020-05-29 06:14:40', '2020-05-29 06:14:40', 1, '2020-05-29'),
(92, 'Impression de la liste des clients', '2020-05-29 06:29:50', '2020-05-29 06:29:50', 1, '2020-05-29'),
(93, 'Impression de la liste des clients', '2020-05-29 06:30:27', '2020-05-29 06:30:27', 1, '2020-05-29'),
(94, 'Impression de la liste des clients', '2020-05-29 06:30:30', '2020-05-29 06:30:30', 1, '2020-05-29'),
(95, 'Impression de la liste des clients', '2020-05-29 06:30:31', '2020-05-29 06:30:31', 1, '2020-05-29'),
(96, 'Impression de la liste des voitures enregistrées', '2020-05-29 07:05:43', '2020-05-29 07:05:43', 1, '2020-05-29'),
(97, 'Impression de la liste des voitures enregistrées', '2020-05-29 07:05:44', '2020-05-29 07:05:44', 1, '2020-05-29'),
(98, 'Impression de la liste des voitures enregistrées', '2020-05-29 07:05:45', '2020-05-29 07:05:45', 1, '2020-05-29'),
(99, 'Impression d\'une consommations', '2020-05-29 10:08:39', '2020-05-29 10:08:39', 1, '2020-05-29'),
(100, 'Impression d\'une consommations', '2020-05-29 10:15:14', '2020-05-29 10:15:14', 1, '2020-05-29'),
(101, 'Impression d\'une consommations', '2020-05-29 10:15:17', '2020-05-29 10:15:17', 1, '2020-05-29'),
(102, 'Impression d\'une consommations', '2020-05-29 10:15:18', '2020-05-29 10:15:18', 1, '2020-05-29'),
(103, 'Déconnection de l\'utilisateur  ', '2020-05-29 10:18:59', '2020-05-29 10:18:59', 1, '2020-05-29'),
(104, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 10:19:44', '2020-05-29 10:19:44', 1, '2020-05-29'),
(105, 'Déconnection de l\'utilisateur  ', '2020-05-29 10:20:07', '2020-05-29 10:20:07', 1, '2020-05-29'),
(106, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 10:22:59', '2020-05-29 10:22:59', 1, '2020-05-29'),
(107, 'Déconnection de l\'utilisateur  ', '2020-05-29 10:23:33', '2020-05-29 10:23:33', 1, '2020-05-29'),
(108, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 10:24:38', '2020-05-29 10:24:38', 1, '2020-05-29'),
(109, 'Impression d\'une consommations', '2020-05-29 10:28:47', '2020-05-29 10:28:47', 1, '2020-05-29'),
(110, 'Impression d\'une consommations', '2020-05-29 10:29:24', '2020-05-29 10:29:24', 1, '2020-05-29'),
(111, 'Impression d\'une consommations', '2020-05-29 10:29:29', '2020-05-29 10:29:29', 1, '2020-05-29'),
(112, 'Impression d\'une consommations', '2020-05-29 10:29:30', '2020-05-29 10:29:30', 1, '2020-05-29'),
(113, 'Impression d\'une consommations', '2020-05-29 10:45:24', '2020-05-29 10:45:24', 1, '2020-05-29'),
(114, 'Impression d\'une consommations', '2020-05-29 10:45:27', '2020-05-29 10:45:27', 1, '2020-05-29'),
(115, 'Impression d\'une consommations', '2020-05-29 10:45:28', '2020-05-29 10:45:28', 1, '2020-05-29'),
(116, 'Impression d\'une consommations', '2020-05-29 10:50:12', '2020-05-29 10:50:12', 1, '2020-05-29'),
(117, 'Impression d\'une consommations', '2020-05-29 10:50:15', '2020-05-29 10:50:15', 1, '2020-05-29'),
(118, 'Impression d\'une consommations', '2020-05-29 10:50:16', '2020-05-29 10:50:16', 1, '2020-05-29'),
(119, 'Impression de la liste des bons de carburant', '2020-05-29 11:04:48', '2020-05-29 11:04:48', 1, '2020-05-29'),
(120, 'Impression de la liste des bons de carburant', '2020-05-29 11:04:53', '2020-05-29 11:04:53', 1, '2020-05-29'),
(121, 'Impression de la liste des bons de carburant', '2020-05-29 11:04:57', '2020-05-29 11:04:57', 1, '2020-05-29'),
(122, 'Impression d\'une consommations', '2020-05-29 11:05:36', '2020-05-29 11:05:36', 1, '2020-05-29'),
(123, 'Impression d\'une consommations', '2020-05-29 11:05:41', '2020-05-29 11:05:41', 1, '2020-05-29'),
(124, 'Impression d\'une consommations', '2020-05-29 11:05:44', '2020-05-29 11:05:44', 1, '2020-05-29'),
(125, 'Impression d\'une consommations', '2020-05-29 11:14:35', '2020-05-29 11:14:35', 1, '2020-05-29'),
(126, 'Impression d\'une consommations', '2020-05-29 11:14:38', '2020-05-29 11:14:38', 1, '2020-05-29'),
(127, 'Impression d\'une consommations', '2020-05-29 11:14:39', '2020-05-29 11:14:39', 1, '2020-05-29'),
(128, 'Déconnection de l\'utilisateur  ', '2020-05-29 11:20:37', '2020-05-29 11:20:37', 1, '2020-05-29'),
(129, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 11:21:18', '2020-05-29 11:21:18', 1, '2020-05-29'),
(130, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 15:48:59', '2020-05-29 15:48:59', 1, '2020-05-29'),
(131, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:18:20', '2020-05-29 16:18:20', 1, '2020-05-29'),
(132, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-29 16:18:48', '2020-05-29 16:18:48', 2, '2020-05-29'),
(133, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:32:38', '2020-05-29 16:32:38', 2, '2020-05-29'),
(134, 'Authentification de l\'utilisateur lenon Karmis 2', '2020-05-29 16:33:07', '2020-05-29 16:33:07', 3, '2020-05-29'),
(135, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:41:07', '2020-05-29 16:41:07', 3, '2020-05-29'),
(136, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 16:41:17', '2020-05-29 16:41:17', 1, '2020-05-29'),
(137, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:42:44', '2020-05-29 16:42:44', 1, '2020-05-29'),
(138, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-29 16:42:56', '2020-05-29 16:42:56', 2, '2020-05-29'),
(139, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:43:51', '2020-05-29 16:43:51', 2, '2020-05-29'),
(140, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-29 16:44:01', '2020-05-29 16:44:01', 5, '2020-05-29'),
(141, 'Déconnection de l\'utilisateur  ', '2020-05-29 16:57:11', '2020-05-29 16:57:11', 5, '2020-05-29'),
(142, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 16:57:24', '2020-05-29 16:57:24', 1, '2020-05-29'),
(143, 'Déconnection de l\'utilisateur  ', '2020-05-29 17:17:42', '2020-05-29 17:17:42', 1, '2020-05-29'),
(144, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-29 17:17:50', '2020-05-29 17:17:50', 5, '2020-05-29'),
(145, 'Déconnection de l\'utilisateur  ', '2020-05-29 17:49:17', '2020-05-29 17:49:17', 5, '2020-05-29'),
(146, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-29 17:49:30', '2020-05-29 17:49:30', 1, '2020-05-29'),
(147, 'Déconnection de l\'utilisateur  ', '2020-05-29 17:52:11', '2020-05-29 17:52:11', 1, '2020-05-29'),
(148, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-29 17:52:22', '2020-05-29 17:52:22', 2, '2020-05-29'),
(149, 'Déconnection de l\'utilisateur  ', '2020-05-29 17:53:26', '2020-05-29 17:53:26', 2, '2020-05-29'),
(150, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-29 17:55:01', '2020-05-29 17:55:01', 5, '2020-05-29'),
(151, 'Déconnection de l\'utilisateur  ', '2020-05-29 17:57:32', '2020-05-29 17:57:32', 5, '2020-05-29'),
(152, 'Authentification de l\'utilisateur Learning 2 Amaori 1', '2020-05-29 17:57:40', '2020-05-29 17:57:40', 4, '2020-05-29'),
(153, 'Déconnection de l\'utilisateur  ', '2020-05-29 18:07:22', '2020-05-29 18:07:22', 4, '2020-05-29'),
(154, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-29 18:07:30', '2020-05-29 18:07:30', 2, '2020-05-29'),
(155, 'Déconnection de l\'utilisateur  ', '2020-05-29 18:24:04', '2020-05-29 18:24:04', 2, '2020-05-29'),
(156, 'Authentification de l\'utilisateur lenon Karmis 2', '2020-05-29 18:24:28', '2020-05-29 18:24:28', 3, '2020-05-29'),
(157, 'Déconnection de l\'utilisateur  ', '2020-05-29 19:29:11', '2020-05-29 19:29:11', 3, '2020-05-29'),
(158, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-29 19:29:41', '2020-05-29 19:29:41', 2, '2020-05-29'),
(159, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculéAppartenant à ', '2020-05-29 20:01:06', '2020-05-29 20:01:06', 2, '2020-05-29'),
(160, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculéAppartenant à ', '2020-05-29 20:04:00', '2020-05-29 20:04:00', 2, '2020-05-29'),
(161, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculéAppartenant à ', '2020-05-29 20:06:59', '2020-05-29 20:06:59', 2, '2020-05-29'),
(162, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-30 05:43:45', '2020-05-30 05:43:45', 5, '2020-05-30'),
(163, 'Déconnection de l\'utilisateur  ', '2020-05-30 06:50:08', '2020-05-30 06:50:08', 5, '2020-05-30'),
(164, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-31 04:49:17', '2020-05-31 04:49:17', 2, '2020-05-31'),
(165, 'Déconnection de l\'utilisateur  ', '2020-05-31 04:55:22', '2020-05-31 04:55:22', 2, '2020-05-31'),
(166, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-31 04:55:40', '2020-05-31 04:55:40', 5, '2020-05-31'),
(167, 'Déconnection de l\'utilisateur  ', '2020-05-31 04:59:29', '2020-05-31 04:59:29', 5, '2020-05-31'),
(168, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-31 04:59:56', '2020-05-31 04:59:56', 2, '2020-05-31'),
(169, 'Déconnection de l\'utilisateur  ', '2020-05-31 05:08:00', '2020-05-31 05:08:00', 2, '2020-05-31'),
(170, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-31 05:08:15', '2020-05-31 05:08:15', 5, '2020-05-31'),
(171, 'Déconnection de l\'utilisateur  ', '2020-05-31 05:42:13', '2020-05-31 05:42:13', 5, '2020-05-31'),
(172, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-31 05:42:26', '2020-05-31 05:42:26', 2, '2020-05-31'),
(173, 'Impression de la liste des utilisateurs', '2020-05-31 06:29:19', '2020-05-31 06:29:19', 2, '2020-05-31'),
(174, 'Déconnection de l\'utilisateur  ', '2020-05-31 06:34:53', '2020-05-31 06:34:53', 2, '2020-05-31'),
(175, 'Authentification de l\'utilisateur lenon Karmis 2', '2020-05-31 06:36:02', '2020-05-31 06:36:02', 3, '2020-05-31'),
(176, 'Karmis lenon vient d enregistrer une nouvelle livraison de la sociétéLERNA 90 le2020-05-31 06:51:17', '2020-05-31 06:51:17', '2020-05-31 06:51:17', 3, '2020-05-31'),
(177, 'Déconnection de l\'utilisateur  ', '2020-05-31 06:53:22', '2020-05-31 06:53:22', 3, '2020-05-31'),
(178, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-05-31 08:31:04', '2020-05-31 08:31:04', 5, '2020-05-31'),
(179, 'Déconnection de l\'utilisateur  ', '2020-05-31 09:41:15', '2020-05-31 09:41:15', 5, '2020-05-31'),
(180, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-05-31 09:41:30', '2020-05-31 09:41:30', 2, '2020-05-31'),
(181, 'Impression d\'un utilisateur', '2020-05-31 12:24:18', '2020-05-31 12:24:18', 2, '2020-05-31'),
(182, 'Impression d\'un utilisateur', '2020-05-31 12:24:57', '2020-05-31 12:24:57', 2, '2020-05-31'),
(183, 'Impression d\'un utilisateur', '2020-05-31 12:24:59', '2020-05-31 12:24:59', 2, '2020-05-31'),
(184, 'Impression d\'un utilisateur', '2020-05-31 12:25:01', '2020-05-31 12:25:01', 2, '2020-05-31'),
(185, 'Déconnection de l\'utilisateur  ', '2020-05-31 13:26:24', '2020-05-31 13:26:24', 2, '2020-05-31'),
(186, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-05-31 15:43:09', '2020-05-31 15:43:09', 1, '2020-05-31'),
(187, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-06-01 05:00:13', '2020-06-01 05:00:13', 5, '2020-06-01'),
(188, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-06-01 11:11:25', '2020-06-01 11:11:25', 5, '2020-06-01'),
(189, 'Déconnection de l\'utilisateur  ', '2020-06-01 12:44:39', '2020-06-01 12:44:39', 5, '2020-06-01'),
(190, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-01 12:44:50', '2020-06-01 12:44:50', 1, '2020-06-01'),
(191, 'Déconnection de l\'utilisateur  ', '2020-06-01 14:25:05', '2020-06-01 14:25:05', 1, '2020-06-01'),
(192, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-06-01 14:25:44', '2020-06-01 14:25:44', 5, '2020-06-01'),
(193, 'Déconnection de l\'utilisateur  ', '2020-06-01 14:47:53', '2020-06-01 14:47:53', 5, '2020-06-01'),
(194, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-06-01 14:48:22', '2020-06-01 14:48:22', 5, '2020-06-01'),
(195, 'Déconnection de l\'utilisateur  ', '2020-06-01 14:57:50', '2020-06-01 14:57:50', 5, '2020-06-01'),
(196, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-01 14:58:03', '2020-06-01 14:58:03', 1, '2020-06-01'),
(197, 'Déconnection de l\'utilisateur  ', '2020-06-01 15:00:20', '2020-06-01 15:00:20', 1, '2020-06-01'),
(198, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-06-01 15:00:40', '2020-06-01 15:00:40', 2, '2020-06-01'),
(199, 'Déconnection de l\'utilisateur  ', '2020-06-01 15:46:26', '2020-06-01 15:46:26', 2, '2020-06-01'),
(200, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-01 15:47:22', '2020-06-01 15:47:22', 1, '2020-06-01'),
(201, 'Déconnection de l\'utilisateur  ', '2020-06-01 15:59:54', '2020-06-01 15:59:54', 1, '2020-06-01'),
(202, 'Authentification de l\'utilisateur lenon Karmis 2', '2020-06-01 16:02:34', '2020-06-01 16:02:34', 3, '2020-06-01'),
(203, 'Déconnection de l\'utilisateur  ', '2020-06-01 16:11:08', '2020-06-01 16:11:08', 3, '2020-06-01'),
(204, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-04 13:59:44', '2020-06-04 13:59:44', 1, '2020-06-04'),
(205, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-04 15:17:42', '2020-06-04 15:17:42', 1, '2020-06-04'),
(206, 'Déconnection de l\'utilisateur  ', '2020-06-04 15:18:52', '2020-06-04 15:18:52', 1, '2020-06-04'),
(207, 'Authentification de l\'utilisateur Jessica Pirson 3', '2020-06-04 15:19:54', '2020-06-04 15:19:54', 2, '2020-06-04'),
(208, 'Déconnection de l\'utilisateur  ', '2020-06-04 15:20:41', '2020-06-04 15:20:41', 2, '2020-06-04'),
(209, 'Authentification de l\'utilisateur Michel KURL Aragon 4', '2020-06-04 15:20:58', '2020-06-04 15:20:58', 5, '2020-06-04'),
(210, 'Déconnection de l\'utilisateur  ', '2020-06-04 15:23:36', '2020-06-04 15:23:36', 5, '2020-06-04'),
(211, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-04 15:23:48', '2020-06-04 15:23:48', 1, '2020-06-04'),
(212, 'Déconnection de l\'utilisateur  ', '2020-06-04 15:40:01', '2020-06-04 15:40:01', 1, '2020-06-04'),
(213, 'Authentification de l\'utilisateur Edson Bitjoka 1', '2020-06-04 15:48:08', '2020-06-04 15:48:08', 1, '2020-06-04'),
(214, 'Déconnection de l\'utilisateur  ', '2020-06-04 15:49:46', '2020-06-04 15:49:46', 1, '2020-06-04');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `received` int(11) NOT NULL,
  `send` int(11) NOT NULL,
  `unread` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `received`, `send`, `unread`, `created_at`, `updated_at`) VALUES
(3, 'la compagnie GTA city a livrée du essence le 2020-05-25 08:17:37', 4, 1, 1, '2020-05-25 08:17:37', '2020-05-25 08:17:37'),
(4, 'la compagnie GTA city a livrée du gazoil le 2020-05-25 08:18:35', 4, 1, 1, '2020-05-25 08:18:35', '2020-05-25 08:18:35'),
(6, 'Bitjoka Edson vient d\'enregistré la consommation du vihicule immatriculé157T1478Appartenant à Amaori Learn', 4, 1, 1, '2020-05-25 18:29:33', '2020-05-25 18:29:33'),
(7, 'Amaori vient de creer l\'utilisateur Carlina Rose', 2, 4, 1, '2020-05-29 18:06:31', '2020-05-29 18:06:31'),
(8, 'Amaori vient de creer l\'utilisateur Carlina Rose', 5, 4, 1, '2020-05-29 18:06:31', '2020-05-29 18:06:31'),
(9, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 2, 2, 1, '2020-05-29 20:01:06', '2020-05-29 20:01:06'),
(10, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 5, 2, 1, '2020-05-29 20:01:06', '2020-05-29 20:01:06'),
(11, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 2, 2, 1, '2020-05-29 20:03:59', '2020-05-29 20:03:59'),
(12, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 5, 2, 1, '2020-05-29 20:03:59', '2020-05-29 20:03:59'),
(13, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 2, 2, 1, '2020-05-29 20:06:58', '2020-05-29 20:06:58'),
(14, 'Pirson Jessica vient d\'enregistré la consommation du vihicule immatriculé', 5, 2, 1, '2020-05-29 20:06:58', '2020-05-29 20:06:58'),
(15, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 1, 3, 1, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(16, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 4, 3, 0, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(17, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 6, 3, 0, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(18, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 7, 3, 0, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(19, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 2, 3, 1, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(20, 'la compagnie LERNA 90 a livrée du essence le 2020-05-31 06:51:18', 5, 3, 1, '2020-05-31 06:51:18', '2020-05-31 06:51:18'),
(21, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 4, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(22, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 3, 1, 1, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(23, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 6, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(24, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 7, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(25, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 19, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(26, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 20, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(27, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 21, 1, 0, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(28, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 2, 1, 1, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(29, 'Bitjoka vient de creer l\'utilisateur Amazina la traitre', 5, 1, 1, '2020-06-01 12:50:48', '2020-06-01 12:50:48'),
(30, 'Bitjoka vient de creer l\'utilisateur Amaorie elmar', 3, 1, 0, '2020-06-04 15:28:19', '2020-06-04 15:28:19'),
(31, 'Bitjoka vient de creer l\'utilisateur Amaorie elmar', 2, 1, 0, '2020-06-04 15:28:19', '2020-06-04 15:28:19'),
(32, 'Bitjoka vient de creer l\'utilisateur Amaorie elmar', 5, 1, 0, '2020-06-04 15:28:20', '2020-06-04 15:28:20'),
(33, 'Bitjoka vient de creer l\'utilisateur Amaorie elmar', 7, 1, 0, '2020-06-04 15:28:20', '2020-06-04 15:28:20');

-- --------------------------------------------------------

--
-- Structure de la table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `privileges`
--

INSERT INTO `privileges` (`id`, `privilege`) VALUES
(1, 'admin'),
(2, 'agent pompiste'),
(3, 'responsable station'),
(4, 'chef sed');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text,
  `payload` text,
  `last_activity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`, `role`) VALUES
('sessions_1590427756', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36', NULL, 1590431355, '2020-05-25 17:29:16', '2020-05-25 17:29:16', '1'),
('sessions_1590562047', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36', NULL, 1590565644, '2020-05-27 06:47:27', '2020-05-27 06:47:27', '1'),
('sessions_1590588229', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36', NULL, 1590591828, '2020-05-27 14:03:49', '2020-05-27 14:03:49', '1'),
('sessions_1590646800', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36', NULL, 1590650399, '2020-05-28 06:20:00', '2020-05-28 06:20:00', '1'),
('sessions_1590678752', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590682351, '2020-05-28 15:12:32', '2020-05-28 15:12:32', '1'),
('sessions_1590683701', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', NULL, 1590687301, '2020-05-28 16:35:01', '2020-05-28 16:35:01', '1'),
('sessions_1590728429', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590732029, '2020-05-29 05:00:29', '2020-05-29 05:00:29', '1'),
('sessions_1590747585', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590751184, '2020-05-29 10:19:45', '2020-05-29 10:19:45', '1'),
('sessions_1590747779', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590751378, '2020-05-29 10:22:59', '2020-05-29 10:22:59', '1'),
('sessions_1590747878', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590751478, '2020-05-29 10:24:38', '2020-05-29 10:24:38', '1'),
('sessions_1590751278', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590754878, '2020-05-29 11:21:18', '2020-05-29 11:21:18', '1'),
('sessions_1590767340', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590770939, '2020-05-29 15:49:00', '2020-05-29 15:49:00', '1'),
('sessions_1590769128', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590772727, '2020-05-29 16:18:48', '2020-05-29 16:18:48', '3'),
('sessions_1590769987', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590773587, '2020-05-29 16:33:07', '2020-05-29 16:33:07', '2'),
('sessions_1590770477', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590774077, '2020-05-29 16:41:17', '2020-05-29 16:41:17', '1'),
('sessions_1590770576', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590774176, '2020-05-29 16:42:56', '2020-05-29 16:42:56', '3'),
('sessions_1590770641', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590774241, '2020-05-29 16:44:01', '2020-05-29 16:44:01', '4'),
('sessions_1590771444', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590775044, '2020-05-29 16:57:24', '2020-05-29 16:57:24', '1'),
('sessions_1590772670', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590776270, '2020-05-29 17:17:50', '2020-05-29 17:17:50', '4'),
('sessions_1590774570', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590778170, '2020-05-29 17:49:30', '2020-05-29 17:49:30', '1'),
('sessions_1590774742', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590778342, '2020-05-29 17:52:22', '2020-05-29 17:52:22', '3'),
('sessions_1590774901', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590778501, '2020-05-29 17:55:01', '2020-05-29 17:55:01', '4'),
('sessions_1590775060', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590778660, '2020-05-29 17:57:40', '2020-05-29 17:57:40', '1'),
('sessions_1590775650', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590779250, '2020-05-29 18:07:30', '2020-05-29 18:07:30', '3'),
('sessions_1590776669', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590780268, '2020-05-29 18:24:29', '2020-05-29 18:24:29', '2'),
('sessions_1590780582', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590784181, '2020-05-29 19:29:42', '2020-05-29 19:29:42', '3'),
('sessions_1590817425', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590821024, '2020-05-30 05:43:45', '2020-05-30 05:43:45', '4'),
('sessions_1590900558', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590904155, '2020-05-31 04:49:18', '2020-05-31 04:49:18', '3'),
('sessions_1590900940', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590904540, '2020-05-31 04:55:40', '2020-05-31 04:55:40', '4'),
('sessions_1590901196', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590904796, '2020-05-31 04:59:56', '2020-05-31 04:59:56', '3'),
('sessions_1590901695', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590905295, '2020-05-31 05:08:15', '2020-05-31 05:08:15', '4'),
('sessions_1590903746', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590907346, '2020-05-31 05:42:26', '2020-05-31 05:42:26', '3'),
('sessions_1590906962', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590910562, '2020-05-31 06:36:02', '2020-05-31 06:36:02', '2'),
('sessions_1590913864', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590917464, '2020-05-31 08:31:04', '2020-05-31 08:31:04', '4'),
('sessions_1590918090', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590921690, '2020-05-31 09:41:30', '2020-05-31 09:41:30', '3'),
('sessions_1590939789', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590943389, '2020-05-31 15:43:09', '2020-05-31 15:43:09', '1'),
('sessions_1590987613', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1590991212, '2020-06-01 05:00:13', '2020-06-01 05:00:13', '4'),
('sessions_1591009885', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591013484, '2020-06-01 11:11:25', '2020-06-01 11:11:25', '4'),
('sessions_1591015490', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591019089, '2020-06-01 12:44:50', '2020-06-01 12:44:50', '1'),
('sessions_1591021544', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591025143, '2020-06-01 14:25:44', '2020-06-01 14:25:44', '4'),
('sessions_1591022902', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591026502, '2020-06-01 14:48:22', '2020-06-01 14:48:22', '4'),
('sessions_1591023483', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591027083, '2020-06-01 14:58:03', '2020-06-01 14:58:03', '1'),
('sessions_1591023640', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591027240, '2020-06-01 15:00:40', '2020-06-01 15:00:40', '3'),
('sessions_1591026442', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591030042, '2020-06-01 15:47:22', '2020-06-01 15:47:22', '1'),
('sessions_1591027354', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591030954, '2020-06-01 16:02:34', '2020-06-01 16:02:34', '2'),
('sessions_1591279184', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591282781, '2020-06-04 13:59:44', '2020-06-04 13:59:44', '1'),
('sessions_1591283862', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591287460, '2020-06-04 15:17:42', '2020-06-04 15:17:42', '1'),
('sessions_1591283994', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591287593, '2020-06-04 15:19:54', '2020-06-04 15:19:54', '3'),
('sessions_1591284058', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591287658, '2020-06-04 15:20:58', '2020-06-04 15:20:58', '4'),
('sessions_1591284228', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591287828, '2020-06-04 15:23:48', '2020-06-04 15:23:48', '1'),
('sessions_1591285688', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', NULL, 1591289288, '2020-06-04 15:48:08', '2020-06-04 15:48:08', '1');

-- --------------------------------------------------------

--
-- Structure de la table `station_service`
--

DROP TABLE IF EXISTS `station_service`;
CREATE TABLE IF NOT EXISTS `station_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `nombre_employers` int(11) DEFAULT NULL,
  `date_dernier_control` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `station_service`
--

INSERT INTO `station_service` (`id`, `adresse`, `telephone`, `nombre_employers`, `date_dernier_control`) VALUES
(1, 'Tradex Efoulan', '687546985', 7, '2020-05-08 07:25:41');

-- --------------------------------------------------------

--
-- Structure de la table `systeme_de_controle_operations`
--

DROP TABLE IF EXISTS `systeme_de_controle_operations`;
CREATE TABLE IF NOT EXISTS `systeme_de_controle_operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_jour` datetime NOT NULL,
  `carburantLivree` double NOT NULL,
  `carburantConsommer` double NOT NULL,
  `typeCarburant` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `systeme_de_controle_operations`
--

INSERT INTO `systeme_de_controle_operations` (`id`, `date_jour`, `carburantLivree`, `carburantConsommer`, `typeCarburant`) VALUES
(6, '2020-05-25 08:17:37', 100000, 0, 'essence'),
(7, '2020-05-25 08:18:34', 100000, 0, 'gazoil'),
(9, '2020-05-25 18:29:33', 0, 20, 'gazoil'),
(10, '2020-05-29 20:01:05', 0, 20, 'essence'),
(11, '2020-05-29 20:03:59', 0, 20, 'essence'),
(12, '2020-05-29 20:06:58', 0, 20, 'essence'),
(13, '2020-05-31 06:51:17', 30, 0, 'essence');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `numero` varchar(255) NOT NULL,
  `recettes` double DEFAULT NULL,
  `depenses` double DEFAULT NULL,
  `date_jour` datetime DEFAULT NULL,
  `caissier` varchar(255) DEFAULT NULL,
  `id_consommation` int(11) DEFAULT NULL,
  `id_recharge` int(11) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`numero`, `recettes`, `depenses`, `date_jour`, `caissier`, `id_consommation`, `id_recharge`) VALUES
('2020INJECTION1590567687', 0, 0, '2020-05-27 08:21:27', NULL, NULL, NULL),
('2020INJECTION1590588468', 500, 0, '2020-05-27 14:07:48', NULL, NULL, NULL),
('2020INJECTION1590589304', -500, 0, '2020-05-27 14:21:44', NULL, NULL, NULL),
('2020TRANSACTION1590394657', 0, 50000, '2020-05-25 08:17:37', 'Bitjoka Edson', NULL, NULL),
('2020TRANSACTION1590394715', 0, 50500, '2020-05-25 08:18:35', 'Bitjoka Edson', NULL, NULL),
('2020TRANSACTION1590430860', 50000, 0, '2020-05-25 18:21:00', 'Bitjoka Edson', NULL, NULL),
('2020TRANSACTION1590431373', 3000, 0, '2020-05-25 18:29:33', 'Bitjoka Edson', NULL, NULL),
('2020TRANSACTION1590782465', 2000, 0, '2020-05-29 20:01:05', 'Pirson Jessica', NULL, NULL),
('2020TRANSACTION1590782639', 2000, 0, '2020-05-29 20:03:59', 'Pirson Jessica', NULL, NULL),
('2020TRANSACTION1590782818', 52522, 0, '2020-05-29 20:06:58', 'Pirson Jessica', NULL, NULL),
('2020TRANSACTION1590907877', 0, 40000, '2020-05-31 06:51:17', 'Karmis lenon', NULL, NULL),
('TRANSACTION-3B38', 200000, NULL, '2020-05-25 06:08:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `datenaissance` varchar(50) NOT NULL,
  `id_privileges` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_privileges_FK` (`id_privileges`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `mail`, `identifiant`, `password`, `slug`, `avatar`, `phone`, `created_at`, `updated_at`, `datenaissance`, `id_privileges`, `is_deleted`, `remember_token`) VALUES
(1, 'Bitjoka', 'Edson', 'edsonelmar4@gmail.com', 'edson77', '$2y$10$8SV8tO3LxxhDkLpB6muaweB9xM.PBi/ZIXGKjIhCv2exO5oyQNcxC', 'Bitjoka-Edson-77', '1589435322_edson111.PNG', '6978452034', '2020-05-08 07:25:41', '2020-05-14 05:48:42', '10 Avril 2018', 1, 0, 'XvHuaw6uV3hPb50t5X2kuOUtlOYJNsauVdO2pRsDM6J9TrgnuC8zT6oOvuaM'),
(2, 'Pirson', 'Jessica', 'edsonmusic237@gmail.com', 'jessica77', '$2y$10$YZDpGxzO7.cWpndVtavDQeBRsvBG30B621mZV3lk9L2hIGFzUNLcq', 'Pirson-Jessica-77', 'img.PNG', '6978452078', '2020-05-08 07:25:41', '2020-05-15 06:48:16', '10 Avril 2000', 3, 0, '3tYUBWgsmuO1crjdkCGxJrGLddMwXFvNDZW7nN5YtYUJid03LNVbjMV1hTnQ'),
(3, 'Karmis', 'lenon', 'lenon@gmail.com', 'lenon77', '$2y$10$abBjgnVwgxpWMMycaltp0.DRQPrxUueRPdWugN8WtaYDiIZwWF.ke', 'Karmis-lenon-77', '1591026637_Neon Flamingo.png', '6848452038', '2020-05-08 07:25:41', '2020-06-01 15:50:37', '10 Avril 1980', 2, 0, 'Qyy876QA4hZGk5j9w0F7IwGCuUVSn9tP4bfgw78aLs7siNdLicimV6UOcRZx'),
(5, 'Aragon', 'Michel KURL', 'edsonelmar4@gmail.com', 'aragon77', '$2y$10$60y3HBF75t.BlAku26WwqOnr4u3SJHZXmpDHYnFc3O9EPNZnmQP5i', 'Aragon-MichelKurl-77', 'img.PNG', '6678452078', '2020-05-08 07:25:41', '2020-05-15 06:48:08', '10 Avril 1975', 4, 0, '7GKhL5HYl2FOE9TmxhbDOkkZaywt9d6rEOoutPSkGmVOZtAs3LTCRQ2UsQqj');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `immatriculation` varchar(50) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `typeCarburant` varchar(50) NOT NULL,
  `numeroCNI` varchar(50) NOT NULL,
  PRIMARY KEY (`immatriculation`),
  KEY `voitures_client_FK` (`numeroCNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`immatriculation`, `marque`, `modele`, `typeCarburant`, `numeroCNI`) VALUES
('157T1478', 'opel', '2015', 'essence', '1257T15');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD CONSTRAINT `consommation_client1_FK` FOREIGN KEY (`numeroCNI`) REFERENCES `client` (`numeroCNI`),
  ADD CONSTRAINT `consommation_station_service_FK` FOREIGN KEY (`id_station_service`) REFERENCES `station_service` (`id`),
  ADD CONSTRAINT `consommation_voitures0_FK` FOREIGN KEY (`immatriculation`) REFERENCES `voitures` (`immatriculation`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_privileges_FK` FOREIGN KEY (`id_privileges`) REFERENCES `privileges` (`id`);

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_client_FK` FOREIGN KEY (`numeroCNI`) REFERENCES `client` (`numeroCNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
