-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 jan. 2024 à 09:37
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
-- Base de données : `bd_forma`
--

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

DROP TABLE IF EXISTS `association`;
CREATE TABLE IF NOT EXISTS `association` (
  `id_association` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `numero_icom` int DEFAULT NULL,
  `id_interlocuteur` int NOT NULL,
  PRIMARY KEY (`id_association`),
  UNIQUE KEY `id_interlocuteur` (`id_interlocuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `association`
--

INSERT INTO `association` (`id_association`, `nom`, `numero_icom`, `id_interlocuteur`) VALUES
(1, 'Les amours', 123, 1),
(2, 'abracadabra', 456, 2),
(3, 'asso-iti', 789, 3);

-- --------------------------------------------------------

--
-- Structure de la table `connexion_utilisateur`
--

DROP TABLE IF EXISTS `connexion_utilisateur`;
CREATE TABLE IF NOT EXISTS `connexion_utilisateur` (
  `id_utilisateur` int NOT NULL,
  `login` varchar(7) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `connexion_utilisateur`
--

INSERT INTO `connexion_utilisateur` (`id_utilisateur`, `login`, `password`) VALUES
(1, 'jose', 'admin'),
(2, 'silvacj', 'admin'),
(3, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `demande_inscription`
--

DROP TABLE IF EXISTS `demande_inscription`;
CREATE TABLE IF NOT EXISTS `demande_inscription` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `CP` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `id_association` int NOT NULL,
  `id_statut` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_association` (`id_association`),
  KEY `id_statut` (`id_statut`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demande_inscription`
--

INSERT INTO `demande_inscription` (`id_utilisateur`, `nom`, `prenom`, `adresse`, `CP`, `email`, `ville`, `id_association`, `id_statut`) VALUES
(6, 'uydfc', 'test', 'goumçp_olkyx', 89465, 'vchj@gmzki.opcp', 'hvugkiy', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `domaine_formation`
--

DROP TABLE IF EXISTS `domaine_formation`;
CREATE TABLE IF NOT EXISTS `domaine_formation` (
  `id_domaine` int NOT NULL,
  `libelle_domaine` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_domaine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `domaine_formation`
--

INSERT INTO `domaine_formation` (`id_domaine`, `libelle_domaine`) VALUES
(1, 'Gestion'),
(2, 'Informatique'),
(3, 'developpement durable'),
(4, 'Secourisme'),
(5, 'Communication');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id_form` int NOT NULL,
  `libelle_form` varchar(100) DEFAULT NULL,
  `intervenant` int DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `nb_max` int DEFAULT NULL,
  `contenu_form` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_domaine` int NOT NULL,
  PRIMARY KEY (`id_form`),
  KEY `id_domaine` (`id_domaine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id_form`, `libelle_form`, `intervenant`, `prix`, `nb_max`, `contenu_form`, `id_domaine`) VALUES
(1, 'Soirée d\'information sur la convention collective nationale du sport', 1, 15, 120, 'tatatti, tatatta ', 1),
(4, 'Atelier de Gestion de Projet', 2, 30, 25, 'Cet atelier abordera les principes fondamentaux de la gestion de projet.', 1),
(5, 'Formation avancée en PHP', 3, 50, 15, 'Une formation approfondie sur le développement PHP, couvrant les sujets avancés.', 2),
(6, 'Secourisme de base', 1, 15, 20, 'Formation pratique sur les premiers secours et les gestes de base en cas durgence.', 4),
(7, 'Communication efficace en milieu professionnel', 4, 40, 30, 'Améliorez vos compétences en communication pour réussir dans le milieu professionnel.', 5);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id_utilisateur` int NOT NULL,
  `id_form` int NOT NULL,
  `date_inscription` date DEFAULT NULL,
  `etat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_form`),
  KEY `id_form` (`id_form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id_utilisateur`, `id_form`, `date_inscription`, `etat`) VALUES
(2, 1, '2024-01-11', 'ok'),
(2, 6, '2024-01-11', 'ok'),
(2, 7, '2024-01-11', 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `interlocuteur`
--

DROP TABLE IF EXISTS `interlocuteur`;
CREATE TABLE IF NOT EXISTS `interlocuteur` (
  `id_interlocuteur` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `tel` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_interlocuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `interlocuteur`
--

INSERT INTO `interlocuteur` (`id_interlocuteur`, `nom`, `prenom`, `tel`, `email`, `fax`) VALUES
(1, 'racli', 'daniel', 2147483647, 'danielPro@gmail.com', 'Fax1'),
(2, 'sautere', 'Lamande', 2147483647, 'LamandeLaBoss@hotmail.fr', 'Fax2'),
(3, 'Manere', 'Austere', 656789123, 'ManereDeAustere@gmail.com', 'Fax3');

-- --------------------------------------------------------

--
-- Structure de la table `session_formation`
--

DROP TABLE IF EXISTS `session_formation`;
CREATE TABLE IF NOT EXISTS `session_formation` (
  `id_session` int NOT NULL AUTO_INCREMENT,
  `date_session` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` varchar(50) DEFAULT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `id_form` int NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `id_form` (`id_form`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `session_formation`
--

INSERT INTO `session_formation` (`id_session`, `date_session`, `heure_debut`, `heure_fin`, `lieu`, `id_form`) VALUES
(1, '2023-12-21', '11:00:00', '12:00:00', 'le chalet', 1),
(2, '2023-12-22', '19:00:00', '12:00:00', 'Le cidre', 1),
(3, '2024-02-15', '09:00:00', '12:00:00', 'Salle de réunion A', 4),
(4, '2024-02-20', '14:00:00', '17:00:00', 'Amphithéâtre B', 5),
(5, '2024-03-05', '10:30:00', '13:30:00', 'Salle de formation C', 6),
(6, '2024-03-10', '15:00:00', '18:00:00', 'Centre de secourisme D', 7),
(7, '2024-03-15', '09:30:00', '12:30:00', 'Salle de conférence E', 4),
(8, '2024-03-22', '13:00:00', '16:00:00', 'Amphithéâtre F', 5),
(9, '2024-04-02', '11:00:00', '14:00:00', 'Salle de formation G', 6),
(10, '2024-04-08', '14:30:00', '17:30:00', 'Centre de secourisme H', 7),
(11, '2023-12-23', '14:00:00', '16:00:00', 'Salle A', 1),
(12, '2023-12-25', '10:00:00', '12:00:00', 'Salle B', 1),
(13, '2023-12-27', '18:00:00', '20:00:00', 'Salle C', 1),
(14, '2023-12-29', '12:00:00', '14:00:00', 'Salle D', 1),
(15, '2023-12-31', '16:00:00', '18:00:00', 'Salle E', 1),
(21, '2023-12-23', '14:00:00', '16:00:00', 'Salle A', 1),
(22, '2023-12-25', '10:00:00', '12:00:00', 'Salle B', 1),
(23, '2023-12-27', '18:00:00', '20:00:00', 'Salle C', 1),
(24, '2023-12-29', '12:00:00', '14:00:00', 'Salle D', 1),
(25, '2023-12-31', '16:00:00', '18:00:00', 'Salle E', 1);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE IF NOT EXISTS `statut` (
  `id_statut` int NOT NULL,
  `libelle_statut` varchar(50) NOT NULL,
  PRIMARY KEY (`id_statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id_statut`, `libelle_statut`) VALUES
(1, 'Organisateur'),
(2, 'Salarié'),
(3, 'Bénévole');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `CP` int DEFAULT NULL,
  `fonction` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `id_association` int NOT NULL,
  `id_statut` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_association` (`id_association`),
  KEY `id_statut` (`id_statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `adresse`, `CP`, `fonction`, `email`, `ville`, `id_association`, `id_statut`) VALUES
(1, 'jose', 'Silva Costa', 'rue de la muerte', 31000, 'chepa', 'jose@gmail.com', 'Toulouse', 1, 1),
(2, 'Ferrer', 'Ethan', '38 de la foret du sanglier', 20100, 'bref', 'etha@sanglier.com', 'Sartene City', 2, 2),
(3, 'Long', 'Guillaume', '45 train de la snf', 31156, 'train', 'guilluame@sncf.com', 'Toulouse', 3, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `association`
--
ALTER TABLE `association`
  ADD CONSTRAINT `association_ibfk_1` FOREIGN KEY (`id_interlocuteur`) REFERENCES `interlocuteur` (`id_interlocuteur`);

--
-- Contraintes pour la table `connexion_utilisateur`
--
ALTER TABLE `connexion_utilisateur`
  ADD CONSTRAINT `connexion_utilisateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`id_domaine`) REFERENCES `domaine_formation` (`id_domaine`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_form`) REFERENCES `formation` (`id_form`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `session_formation`
--
ALTER TABLE `session_formation`
  ADD CONSTRAINT `session_formation_ibfk_1` FOREIGN KEY (`id_form`) REFERENCES `formation` (`id_form`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_association`) REFERENCES `association` (`id_association`),
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id_statut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
