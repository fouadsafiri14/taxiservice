-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 07 juil. 2021 à 23:46
-- Version du serveur :  8.0.22
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--  nom de la base 
-- Base de données : `gps`  

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--
CREATE DATABASE gps;
use gps;
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `tel_number` int NOT NULL,
  `pseudo_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `naissance` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `prenom`, `nom`, `tel_number`, `pseudo_name`, `password`, `naissance`) VALUES
(1, 'SWT', 'FSTE', 80808080, 'ziadtaouchikht@gmail.com', '$2y$10$wicSBZXGxfEvS.1/3Cjyqet21C53y6dsqFW6SXZBIAKwwDvxEoPFi', '2000-10-10');

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `id` int NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `tel_number` int NOT NULL,
  `pseudo_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `naissance` date NOT NULL,
  `valeur` int NOT NULL DEFAULT '0',
  `latitude` float(12,9) NOT NULL DEFAULT '0.000000000',
  `longitude` float(12,9) NOT NULL DEFAULT '0.000000000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `tel_number` int NOT NULL,
  `pseudo_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `naissance` date NOT NULL,
  `latitude` float(12,9) NOT NULL DEFAULT '0.000000000',
  `longitude` float(12,9) NOT NULL DEFAULT '0.000000000',
  `solde` float NOT NULL DEFAULT '1000'
) ;

--
-- Déchargement des données de la table `client`
--


-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id` int NOT NULL,
  `departlati` float(12,9) NOT NULL DEFAULT '0.000000000',
  `departlong` float(12,9) NOT NULL DEFAULT '0.000000000',
  `arriveelati` float(12,9) NOT NULL DEFAULT '0.000000000',
  `arriveelong` float(12,9) NOT NULL DEFAULT '0.000000000',
  `chauffeur_id` int NOT NULL,
  `client_id` int NOT NULL,
  `timing` datetime NOT NULL,
  `message` varchar(100) NOT NULL,
  `distance` float NOT NULL DEFAULT '0',
  `ready` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `telnumber` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `text` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int NOT NULL,
  `departlati` float NOT NULL DEFAULT '0',
  `departlong` float NOT NULL DEFAULT '0',
  `arriveelati` float NOT NULL DEFAULT '0',
  `arriveelong` float NOT NULL DEFAULT '0',
  `chauffeur_id` int NOT NULL DEFAULT '0',
  `client_id` int NOT NULL DEFAULT '0',
  `timing` datetime NOT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ready` int NOT NULL DEFAULT '0',
  `distance` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `departlati` float(12,9) NOT NULL DEFAULT '0.000000000',
  `departlong` float(12,9) NOT NULL DEFAULT '0.000000000',
  `arriveelati` float(12,9) NOT NULL DEFAULT '0.000000000',
  `arriveelong` float(12,9) NOT NULL DEFAULT '0.000000000',
  `chauffeur_id` int NOT NULL,
  `client_id` int NOT NULL,
  `timing` datetime NOT NULL,
  `soldeDebite` float NOT NULL,
  `distanceParcourue` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo_name` (`pseudo_name`);

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo_name` (`pseudo_name`),
  ADD UNIQUE KEY `pseudo_name_2` (`pseudo_name`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo_name` (`pseudo_name`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client` (`client_id`),
  ADD KEY `fk_chauffeur` (`chauffeur_id`);

--



--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chauffeur` (`chauffeur_id`),
  ADD KEY `client` (`client_id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chauffeur` (`chauffeur_id`),
  ADD KEY `client` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;



--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
