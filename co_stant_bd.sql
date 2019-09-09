-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
<<<<<<< HEAD
-- Généré le :  lun. 09 sep. 2019 à 13:19
=======
-- Généré le :  lun. 09 sep. 2019 à 13:40
>>>>>>> d71c555037ed76aed5b89318aef78b163533dc98
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `co'stant_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id_projet` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `texte` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_chat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id_projet` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `chemin` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_depot` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_depot`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_post` int(11) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_events` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_events`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_post`, `date`, `lieu`, `id_events`, `text`) VALUES
(1, '2019-09-10', 'lunel', 1, 'anniv charles'),
(1, '2019-11-22', 'vauvert', 2, 'anniv adrien');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nb_users` int(255) NOT NULL,
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_groupe`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_admin`, `id_user`, `nom`, `nb_users`, `id_groupe`) VALUES
(1, 1, 'groupe de basket', 255, 1),
(2, 2, 'groupe de airsoft', 255, 3);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `texte` varchar(255) CHARACTER SET utf8 NOT NULL,
  `createur` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id_admin` int(11) NOT NULL,
  `id_membres` int(11) NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(255) NOT NULL,
  PRIMARY KEY (`id_projet`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id_admin`, `id_membres`, `titre`, `id_projet`, `texte`) VALUES
(1, 1, 'projet arnaud', 1, 'comment vaincre Arnaud au babyfoot'),
<<<<<<< HEAD
(1, 1, 'projet arnaud', 2, 'comment vaincre Arnaud au babyfoot'),
(2, 2, 'projet mathieu', 3, 'comment plaquer mathieu au football américain'),
(2, 2, 'projet mathieu', 4, 'comment plaquer mathieu au football américain');
=======
(2, 2, 'projet mathieu', 3, 'comment plaquer mathieu au football américain');
>>>>>>> d71c555037ed76aed5b89318aef78b163533dc98

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` varchar(255) NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `id_post`, `titre`, `texte`) VALUES
(1, 1, 'le basket?', 'le basket c\'est quoi? et bien nous allons y répondre dans ce post'),
(2, 2, 'l\'airsoft', 'l\'airsoft c\'est quoi et bein nous allons le découvrir dans ce super groupe');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mdp` varchar(32) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mdp`, `nom`, `prenom`, `mail`) VALUES
(2, '123456', 'jean', 'delafontaine', 'jean.delafontaine@gmail.com'),
<<<<<<< HEAD
(3, '1234567', 'Jean-Jacques', 'rousseau', 'Jean-Jacques.rousseau@gmail.com');
=======
(3, '1234567', 'Jean-Jacques', 'rousseau', 'Jean-Jacques.rousseau@gmail.com'),
(1, '123', 'François-Marie', ' Arouet', 'François-Marie.Arouet@gmail.com');
>>>>>>> d71c555037ed76aed5b89318aef78b163533dc98
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
