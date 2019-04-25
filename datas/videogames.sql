-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.23 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour videogames
CREATE DATABASE IF NOT EXISTS `videogames` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `videogames`;

-- Listage de la structure de la table videogames. constructor
CREATE TABLE IF NOT EXISTS `constructor` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. developers
CREATE TABLE IF NOT EXISTS `developers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. gamesgenres
CREATE TABLE IF NOT EXISTS `gamesgenres` (
  `idGenre` int(11) unsigned NOT NULL,
  `idVideoGame` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idGenre`,`idVideoGame`),
  KEY `FK_gamesgenres_videogames` (`idVideoGame`),
  CONSTRAINT `FK_gamesgenres_genres` FOREIGN KEY (`idGenre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_gamesgenres_videogames` FOREIGN KEY (`idVideoGame`) REFERENCES `videogames` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. genres
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. platform
CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `idConstructor` int(11) unsigned NOT NULL,
  `abbreviation` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_platform_constructor` (`idConstructor`),
  CONSTRAINT `FK_platform_constructor` FOREIGN KEY (`idConstructor`) REFERENCES `constructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. privileges
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. publishers
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logins` varchar(20) NOT NULL,
  `idPrivileges` int(11) NOT NULL,
  `passwords` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users_privileges` (`idPrivileges`),
  CONSTRAINT `FK_users_privileges` FOREIGN KEY (`idPrivileges`) REFERENCES `privileges` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table videogames. videogames
CREATE TABLE IF NOT EXISTS `videogames` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(256) NOT NULL,
  `ReleaseDate` varchar(64) DEFAULT NULL,
  `idPlatform` int(11) unsigned DEFAULT NULL,
  `Ref_games` varchar(7) DEFAULT NULL,
  `idPublisher` int(11) unsigned DEFAULT NULL,
  `idDeveloper` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_videogames_publishers` (`idPublisher`),
  KEY `FK_videogames_videogames_2` (`idDeveloper`),
  KEY `FK_videogames_videogames` (`idPlatform`),
  CONSTRAINT `FK_videogames_publishers` FOREIGN KEY (`idPublisher`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videogames_videogames` FOREIGN KEY (`idPlatform`) REFERENCES `platform` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_videogames_videogames_2` FOREIGN KEY (`idDeveloper`) REFERENCES `developers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=399 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
