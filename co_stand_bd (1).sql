-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 sep. 2019 à 09:20
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
-- Base de données :  `co_stand_bd`
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
  PRIMARY KEY (`id_projet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id_projet` int(11) NOT NULL,
  `chemin` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_createur` int(11) DEFAULT NULL,
  `titre` varchar(64) DEFAULT NULL,
  `id_depot` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_depot`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id_projet`, `chemin`, `id_createur`, `titre`, `id_depot`) VALUES
(18, '\\fichiers\\carte got.jpg', 3, 'carte got.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_post` int(11) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categorie`
--

DROP TABLE IF EXISTS `forum_categorie`;
CREATE TABLE IF NOT EXISTS `forum_categorie` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cat_ordre` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_ordre` (`cat_ordre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_categorie`
--

INSERT INTO `forum_categorie` (`cat_id`, `cat_nom`, `cat_ordre`) VALUES
(1, 'Sport', 10),
(2, 'Culturel', 20),
(3, 'Jeux', 30);

-- --------------------------------------------------------

--
-- Structure de la table `forum_forum`
--

DROP TABLE IF EXISTS `forum_forum`;
CREATE TABLE IF NOT EXISTS `forum_forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_cat_id` mediumint(8) NOT NULL,
  `forum_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_desc` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_ordre` mediumint(8) NOT NULL,
  `forum_last_post_id` int(11) NOT NULL,
  `forum_topic` mediumint(8) NOT NULL,
  `forum_post` mediumint(8) NOT NULL,
  `auth_view` tinyint(4) NOT NULL,
  `auth_post` tinyint(4) NOT NULL,
  `auth_topic` tinyint(4) NOT NULL,
  `auth_annonce` tinyint(4) NOT NULL,
  `auth_modo` tinyint(4) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_forum`
--

INSERT INTO `forum_forum` (`forum_id`, `forum_cat_id`, `forum_name`, `forum_desc`, `forum_ordre`, `forum_last_post_id`, `forum_topic`, `forum_post`, `auth_view`, `auth_post`, `auth_topic`, `auth_annonce`, `auth_modo`) VALUES
(1, 1, 'Club Foot', 'Buuuuuuuuuuut', 10, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 'Club de Basket', 'recherche membre chaud pour faire un basket tous les samedi soir .', 20, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, 'Club Cinéma ', 'Fan de cinéma rejoignez nous !', 30, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 3, 'For the Horde !', 'Vous voulez mangez de l\'ally dans la pause du midi venez nous rejoindre !', 40, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 'Gr club d\'escrime', 'pik pik !', 60, 18, 6, 8, 0, 0, 0, 0, 0),
(7, 2, 'Muséo c\'est trop rigolo', 'fan de musée en tout genre \r\nba venez pas !', 100, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 2, 'Club de musique', 'Tout genre confondu', 90, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 3, 'Club d\'échec', 'rejoignez nous', 100, 9, 3, 4, 0, 0, 0, 0, 0),
(10, 3, 'Fort nite ', 'pour ceux qui ne savent jouer qu\'a des jeux d\'enfants', 90, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `forum_membres`
--

DROP TABLE IF EXISTS `forum_membres`;
CREATE TABLE IF NOT EXISTS `forum_membres` (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_pseudo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_mdp` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_email` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_avatar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_signature` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_localisation` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `membre_inscrit` int(11) NOT NULL,
  `membre_derniere_visite` int(11) NOT NULL,
  `membre_rang` tinyint(4) DEFAULT '2',
  `membre_post` int(11) DEFAULT NULL,
  PRIMARY KEY (`membre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_membres`
--

INSERT INTO `forum_membres` (`membre_id`, `membre_pseudo`, `membre_mdp`, `membre_email`, `membre_avatar`, `membre_signature`, `membre_localisation`, `membre_inscrit`, `membre_derniere_visite`, `membre_rang`, `membre_post`) VALUES
(5, 'toto', '05286453bcafb0ece483fa4584ce8d17', 'cladadrien@gmail.com', '1553607224.png', 'La signature est limitée à 200 caractères', 'Montpellier', 1553607224, 1553607224, 2, NULL),
(6, 'clad22', '0db9669af0a5e4f99a5495df4cba60df', 'adrien.noel@epsi.fr', '1554373070.jpg', 'Monn héro préférée c\'est mon professeurs de Php ! \r\n\r\n(grattage de point gratuit  ) ', 'Montpellier', 1554373070, 1554373070, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `forum_post`
--

DROP TABLE IF EXISTS `forum_post`;
CREATE TABLE IF NOT EXISTS `forum_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_createur` int(11) NOT NULL,
  `post_texte` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `post_time` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_forum_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_post`
--

INSERT INTO `forum_post` (`post_id`, `post_createur`, `post_texte`, `post_time`, `topic_id`, `post_forum_id`) VALUES
(5, 5, 'la moitié de la population de l’univers n’est pas décimée et a été projetée dans un univers parallèle. Les super-héros de l’univers classique vont devoir tout faire pour les retrouver et les ramener à la réalité.', 1554207707, 5, 9),
(6, 5, 'grâce à la Pierre du Temps (ensorcelée par Doctor Strange ?) ou à l’aide du monde quantique, les super-héros vont parvenir à revenir dans le passé, afin d’empêcher la disparition de leurs amis.\r\n\r\n', 1554207825, 6, 9),
(7, 5, 'aucun des super-héros que l’on voit disparaître à la fin d’Infinity War n’est mort. En fait, ce sont les autres, ceux qui restent, qui sont réduits à néant. Thanos (et la production !) s’est bien joué de nous.', 1554207896, 7, 9),
(8, 5, 'power ', 1554219571, 8, 6),
(9, 6, 'Mouai bof', 1554450991, 7, 9),
(10, 6, 'big deadpool', 1554456060, 9, 6),
(11, 6, 'jte crois pass', 1554456124, 9, 6),
(12, 6, 'jour', 1554793486, 10, 6),
(13, 6, 'parce dans le dernier filme ', 1555151042, 11, 6),
(14, 6, 'nan il aime pas ', 1555151086, 11, 6),
(15, 6, 'ppp', 1558619496, 12, 6),
(17, 6, 'dadadadadaddaad', 1559302580, 14, 0),
(18, 5, 'non', 1563665547, 13, 6);

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

DROP TABLE IF EXISTS `forum_topic`;
CREATE TABLE IF NOT EXISTS `forum_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `topic_titre` char(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `topic_createur` int(11) NOT NULL,
  `topic_vu` mediumint(8) NOT NULL,
  `topic_time` int(11) NOT NULL,
  `topic_genre` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `topic_last_post` int(11) DEFAULT NULL,
  `topic_first_post` int(11) DEFAULT NULL,
  `topic_post` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic_last_post` (`topic_last_post`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_topic`
--

INSERT INTO `forum_topic` (`topic_id`, `forum_id`, `topic_titre`, `topic_createur`, `topic_vu`, `topic_time`, `topic_genre`, `topic_last_post`, `topic_first_post`, `topic_post`) VALUES
(5, 9, 'Ils ne sont pas vraiment mort !', 5, 2, 1554207707, 'Message', 5, 5, NULL),
(6, 9, 'Les avengers vont revenir dans le temps', 5, 1, 1554207825, 'Message', 6, 6, NULL),
(7, 9, 'en réalité, seuls ceux qui restent sont morts', 5, 4, 1554207896, 'Message', 9, 7, NULL),
(8, 6, 'dead pool', 5, 11, 1554219571, 'Message', 8, 8, NULL),
(9, 6, 'test', 6, 31, 1554456060, 'Annonce', 11, 10, NULL),
(10, 6, 'Bon', 6, 1, 1554793486, 'Message', 12, 12, NULL),
(11, 6, 'Est-ce que Deadpool aime les légumes', 6, 9, 1555151042, 'Message', 14, 13, NULL),
(12, 6, 'kk', 6, 3, 1558619496, 'Message', 15, 15, NULL),
(13, 6, 'bijour', 6, 12, 1558700951, 'Message', 18, 16, NULL),
(14, 0, 'adadadadaddad', 6, 2, 1559302580, 'Message', 17, 17, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nb_users` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membres_projets`
--

DROP TABLE IF EXISTS `membres_projets`;
CREATE TABLE IF NOT EXISTS `membres_projets` (
  `id_membre` int(32) DEFAULT NULL,
  `id_projet` int(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres_projets`
--

INSERT INTO `membres_projets` (`id_membre`, `id_projet`) VALUES
(3, 17),
(2, 17),
(2, 17),
(2, 17),
(3, 17),
(3, 18),
(2, 18);

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
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id_admin` int(11) NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(255) NOT NULL,
  PRIMARY KEY (`id_projet`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id_admin`, `titre`, `id_projet`, `texte`) VALUES
(3, 'PROJ 1', 18, 'AZERTYttyh( y (');

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `titre` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `mdp` varchar(32) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_groupe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_groupe` (`id_groupe`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `mdp`, `nom`, `prenom`, `mail`, `id_groupe`) VALUES
(2, 'c1442c2c6ec7407b0e3ebfc8006dc819', 'Noel', 'Adrien', 'toto@gmail.com', 0),
(3, '202cb962ac59075b964b07152d234b70', 'Royo', 'Arnaud', 'royo.arnaud@gmail.com', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
