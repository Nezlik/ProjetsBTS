-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 09 nov. 2023 à 22:48
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mycoach`
--
CREATE DATABASE IF NOT EXISTS `mycoach` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mycoach`;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `CodeActivites` int(3) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- RELATIONS POUR LA TABLE `activites`:
--

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`CodeActivites`, `libelle`) VALUES
(1, 'Demi fond'),
(2, 'Gym'),
(3, 'Muscu'),
(4, 'Pilate');

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

CREATE TABLE `adherents` (
  `CodeAdherent` int(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `Commentaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `adherents`:
--

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`CodeAdherent`, `nom`, `prenom`, `adresse`, `Commentaire`) VALUES
(289, 'Dariel', 'Benoit', '5 rue lafaille', 'perte de 20kg bravo'),
(478, 'Richard', 'Bruno', '13 rue du tourmalet', 'Prise de masse en cours'),
(758, 'Cobblepot', 'Pingouin', '13 rue du tourmalet', 'RAS');

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `CodeDate` int(3) NOT NULL,
  `HeureDebut` varchar(3) NOT NULL,
  `HeureFin` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `horaires`:
--

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`CodeDate`, `HeureDebut`, `HeureFin`) VALUES
(1, '8h', '11h'),
(2, '13h', '16h'),
(3, '19h', '22h'),
(4, '9h', '11h'),
(5, '14h', '16h'),
(6, '18h', '20h');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `CodeLieu` int(3) NOT NULL,
  `Libelle` varchar(100) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `CodePostal` int(5) NOT NULL,
  `Ville` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `lieu`:
--

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`CodeLieu`, `Libelle`, `Adresse`, `CodePostal`, `Ville`) VALUES
(1, 'Gymnase roux', '5 rue de la liberte', 31000, 'Toulouse'),
(2, 'Gymnase 5', '5 rue lafaille', 31000, 'Toulouse'),
(3, 'Gymnase leblanc', '31 rue Mondran', 31240, 'l\'Union');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `Id` int(3) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `login`:
--   `Id`
--       `adherents` -> `CodeAdherent`
--

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`Id`, `Username`, `Password`) VALUES
(289, 'Darielm', '123456');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `CodeSeance` int(3) NOT NULL,
  `CodeLieu` int(3) NOT NULL,
  `CodeDate` int(3) NOT NULL,
  `CodeActivites` int(3) NOT NULL,
  `Jour` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `seance`:
--   `CodeActivites`
--       `activites` -> `CodeActivites`
--   `CodeDate`
--       `horaires` -> `CodeDate`
--   `CodeLieu`
--       `lieu` -> `CodeLieu`
--

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`CodeSeance`, `CodeLieu`, `CodeDate`, `CodeActivites`, `Jour`) VALUES
(1, 2, 6, 1, 'mardi'),
(2, 2, 3, 2, 'mercredi'),
(3, 2, 1, 3, 'mercredi'),
(4, 3, 4, 1, 'Jeudi'),
(5, 2, 6, 4, 'Dimanche'),
(6, 1, 1, 3, 'Jeudi'),
(7, 2, 2, 3, 'Vendredi'),
(8, 1, 6, 2, 'Samedi'),
(9, 3, 6, 2, 'Vendredi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`CodeActivites`);

--
-- Index pour la table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`CodeAdherent`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`CodeDate`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`CodeLieu`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`CodeSeance`),
  ADD KEY `ForeignSeance` (`CodeActivites`),
  ADD KEY `Foreignlieu` (`CodeLieu`),
  ADD KEY `Foreigndate` (`CodeDate`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `CodeDate` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `CodeSeance` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `ForeinLogin` FOREIGN KEY (`Id`) REFERENCES `adherents` (`CodeAdherent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `ForeignSeance` FOREIGN KEY (`CodeActivites`) REFERENCES `activites` (`CodeActivites`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Foreigndate` FOREIGN KEY (`CodeDate`) REFERENCES `horaires` (`CodeDate`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Foreignlieu` FOREIGN KEY (`CodeLieu`) REFERENCES `lieu` (`CodeLieu`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
