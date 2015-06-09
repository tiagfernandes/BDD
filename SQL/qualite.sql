-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Juin 2015 à 09:30
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `qualite`
--

-- --------------------------------------------------------

--
-- Structure de la table `acronime_etiquette`
--

CREATE TABLE IF NOT EXISTS `acronime_etiquette` (
  `idAcronimeEtiquette` int(11) NOT NULL AUTO_INCREMENT,
  `valeurAcronime` varchar(45) DEFAULT NULL,
  `acronimeEtiquette` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAcronimeEtiquette`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `acronime_etiquette`
--

INSERT INTO `acronime_etiquette` (`idAcronimeEtiquette`, `valeurAcronime`, `acronimeEtiquette`) VALUES
(1, 'DO2', 'Mesure de l O2 dissous'),
(2, 'REF', 'Refrigerateur');

-- --------------------------------------------------------

--
-- Structure de la table `acronime_has_categorie`
--

CREATE TABLE IF NOT EXISTS `acronime_has_categorie` (
  `idCategorieEtiquette` int(11) NOT NULL,
  `idAcronimeEtiquette` int(11) NOT NULL,
  PRIMARY KEY (`idCategorieEtiquette`,`idAcronimeEtiquette`),
  KEY `fk_Acronime_Etiquette_has_Categorie_Etiquette_Categorie_Eti_idx` (`idCategorieEtiquette`),
  KEY `fk_Acronime_Etiquette_has_Categorie_Etiquette_Acronime_Etiq_idx` (`idAcronimeEtiquette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `anomalie`
--

CREATE TABLE IF NOT EXISTS `anomalie` (
  `idAnomalie` int(11) NOT NULL AUTO_INCREMENT,
  `nomAnomalie` varchar(45) DEFAULT NULL,
  `dateAnomalie` datetime DEFAULT NULL,
  `finAnomalie` datetime DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAnomalie`,`idUtilisateur`),
  KEY `fk_Panne_Utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_etiquette`
--

CREATE TABLE IF NOT EXISTS `categorie_etiquette` (
  `idCategorieEtiquette` int(11) NOT NULL AUTO_INCREMENT,
  `categorieEtiquette` varchar(45) DEFAULT NULL,
  `valeurCategorie` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategorieEtiquette`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `categorie_etiquette`
--

INSERT INTO `categorie_etiquette` (`idCategorieEtiquette`, `categorieEtiquette`, `valeurCategorie`) VALUES
(1, 'Actionneur', 'A'),
(2, 'Sampler', 'S'),
(3, 'Sample Analyser', 'SA'),
(4, 'Sample Conditionner', 'SC'),
(5, 'SEnsor', 'SE'),
(6, 'Container', 'C'),
(7, 'Communication Tools', 'CL'),
(8, 'Data Logger Module', 'DL'),
(9, 'Electronics', 'E'),
(10, 'Services and Infrastructure', 'SI'),
(11, 'Vehicules', 'V');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `idDocument` int(11) NOT NULL AUTO_INCREMENT,
  `nomDocument` varchar(45) DEFAULT NULL,
  `idEtiquette_Document` int(11) NOT NULL,
  `idLieux_Document` int(11) NOT NULL,
  PRIMARY KEY (`idDocument`,`idEtiquette_Document`,`idLieux_Document`),
  KEY `fk_Document_Etiquette_Document1_idx` (`idEtiquette_Document`),
  KEY `fk_Document_Lieux_Document1_idx` (`idLieux_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `emplacement_archive`
--

CREATE TABLE IF NOT EXISTS `emplacement_archive` (
  `idEmplacement_Archive` int(11) NOT NULL AUTO_INCREMENT,
  `emplacementArchive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEmplacement_Archive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entretient`
--

CREATE TABLE IF NOT EXISTS `entretient` (
  `idEntretient` int(11) NOT NULL AUTO_INCREMENT,
  `dateEntretient` datetime DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idEntretient`,`idUtilisateur`),
  KEY `fk_Entretient_Utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `idEquipement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipement` varchar(45) DEFAULT NULL,
  `idFournisseur` int(11) NOT NULL,
  `dateAjout` date DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `dateFabrication` date DEFAULT NULL,
  `dateReception` date DEFAULT NULL,
  `dateMiseService` date DEFAULT NULL,
  `garantie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEquipement`,`idFournisseur`),
  KEY `fk_Equipement_Fournisseur1_idx` (`idFournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`idEquipement`, `nomEquipement`, `idFournisseur`, `dateAjout`, `prix`, `marque`, `dateFabrication`, `dateReception`, `dateMiseService`, `garantie`) VALUES
(2, 'Capteur Test', 1, '2015-06-08', 1, 'Ecotron', '2012-10-29', '2013-10-29', '2014-11-29', 2),
(4, 'Moteur', 0, '2015-06-08', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 0),
(5, 'Test', 0, '2015-06-08', 0, '', '0000-00-00', '0000-00-00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `equipement_has_anomalie`
--

CREATE TABLE IF NOT EXISTS `equipement_has_anomalie` (
  `idEquipement` int(11) NOT NULL,
  `idAnomalie` int(11) NOT NULL,
  PRIMARY KEY (`idEquipement`,`idAnomalie`),
  KEY `fk_Equipement_has_Panne_Panne1_idx` (`idAnomalie`),
  KEY `fk_Equipement_has_Panne_Equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipement_has_document`
--

CREATE TABLE IF NOT EXISTS `equipement_has_document` (
  `idEquipement` int(11) NOT NULL,
  `idDocument` int(11) NOT NULL,
  PRIMARY KEY (`idEquipement`,`idDocument`),
  KEY `fk_Equipement_has_Document_Document1_idx` (`idDocument`),
  KEY `fk_Equipement_has_Document_Equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipement_has_entretient`
--

CREATE TABLE IF NOT EXISTS `equipement_has_entretient` (
  `idEquipement` int(11) NOT NULL,
  `idEntretient` int(11) NOT NULL,
  PRIMARY KEY (`idEquipement`,`idEntretient`),
  KEY `fk_Equipement_has_Entretient_Entretient1_idx` (`idEntretient`),
  KEY `fk_Equipement_has_Entretient_Equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipement_has_planning_occupation`
--

CREATE TABLE IF NOT EXISTS `equipement_has_planning_occupation` (
  `idEquipement` int(11) NOT NULL,
  `idPlanning_Occupation` int(11) NOT NULL,
  PRIMARY KEY (`idEquipement`,`idPlanning_Occupation`),
  KEY `fk_Equipement_has_Planning_Occupation_Planning_Occupation1_idx` (`idPlanning_Occupation`),
  KEY `fk_Equipement_has_Planning_Occupation_Equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etiquette_document`
--

CREATE TABLE IF NOT EXISTS `etiquette_document` (
  `idEtiquette_Document` int(11) NOT NULL AUTO_INCREMENT,
  `idType_Document` int(11) NOT NULL,
  `idProcessus` int(11) NOT NULL,
  `idSous_Processus` int(11) NOT NULL,
  `idEtiquette_Equipement` int(11) NOT NULL,
  PRIMARY KEY (`idEtiquette_Document`,`idType_Document`,`idProcessus`,`idSous_Processus`,`idEtiquette_Equipement`),
  KEY `fk_Etiquette_Document_Type_Document1_idx` (`idType_Document`),
  KEY `fk_Etiquette_Document_Processus1_idx` (`idProcessus`),
  KEY `fk_Etiquette_Document_Sous_Processus1_idx` (`idSous_Processus`),
  KEY `fk_Etiquette_Document_Etiquette_Equipement1_idx` (`idEtiquette_Equipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etiquette_equipement`
--

CREATE TABLE IF NOT EXISTS `etiquette_equipement` (
  `idEtiquette_Equipement` int(11) NOT NULL AUTO_INCREMENT,
  `idCategorieEtiquette` int(11) NOT NULL,
  `idAcronimeEtiquette` int(11) NOT NULL,
  `idEquipement` int(11) NOT NULL,
  PRIMARY KEY (`idEtiquette_Equipement`,`idCategorieEtiquette`,`idAcronimeEtiquette`,`idEquipement`),
  KEY `fk_Etiquette_Equipement_Categorie_Etiquette1_idx` (`idCategorieEtiquette`),
  KEY `fk_Etiquette_Equipement_Equipement1_idx` (`idEquipement`),
  KEY `fk_Etiquette_Equipement_Acronime_Etiquette1_idx` (`idAcronimeEtiquette`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `etiquette_equipement`
--

INSERT INTO `etiquette_equipement` (`idEtiquette_Equipement`, `idCategorieEtiquette`, `idAcronimeEtiquette`, `idEquipement`) VALUES
(3, 3, 2, 3),
(1, 5, 1, 1),
(2, 5, 1, 2),
(4, 7, 2, 4),
(5, 11, 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fonction_principal`
--

CREATE TABLE IF NOT EXISTS `fonction_principal` (
  `idFonction_Principal` int(11) NOT NULL AUTO_INCREMENT,
  `fonctionPrincipal` varchar(45) DEFAULT NULL,
  `idFonction_Secondaire` int(11) NOT NULL,
  PRIMARY KEY (`idFonction_Principal`,`idFonction_Secondaire`),
  KEY `fk_Fonction_Principal_Fonction_Secondaire1_idx` (`idFonction_Secondaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fonction_secondaire`
--

CREATE TABLE IF NOT EXISTS `fonction_secondaire` (
  `idFonction_Secondaire` int(11) NOT NULL AUTO_INCREMENT,
  `fonctionSecondaire` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFonction_Secondaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `idFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nomFournisseur` varchar(45) DEFAULT NULL,
  `pays` varchar(45) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `telephone` tinytext,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idFournisseur`, `nomFournisseur`, `pays`, `cp`, `ville`, `adresse`, `telephone`, `email`) VALUES
(1, 'ecotron', 'France', 77, 'Nemours', '78 rue du chateau', '0123456789', 'eco@tron.fr');

-- --------------------------------------------------------

--
-- Structure de la table `liaison_equipement`
--

CREATE TABLE IF NOT EXISTS `liaison_equipement` (
  `idLiaison_Equipement` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipement1` int(11) NOT NULL,
  `idEquipement2` int(11) NOT NULL,
  PRIMARY KEY (`idLiaison_Equipement`,`idEquipement1`,`idEquipement2`),
  KEY `fk_Liaison_Equipement1_idx` (`idEquipement1`),
  KEY `fk_Liaison_Equipement2_idx` (`idEquipement2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lieux_document`
--

CREATE TABLE IF NOT EXISTS `lieux_document` (
  `idLieux_Document` int(11) NOT NULL AUTO_INCREMENT,
  `idPlateforme_Archive` int(11) NOT NULL,
  `idPiece_Document` int(11) NOT NULL,
  `idEmplacement_Archive` int(11) NOT NULL,
  `idSous_Emplacement` int(11) NOT NULL,
  PRIMARY KEY (`idLieux_Document`,`idPlateforme_Archive`,`idPiece_Document`,`idEmplacement_Archive`,`idSous_Emplacement`),
  KEY `fk_Lieux_Document_Plateforme_Archive1_idx` (`idPlateforme_Archive`),
  KEY `fk_Lieux_Document_Piece_Document1_idx` (`idPiece_Document`),
  KEY `fk_Lieux_Document_Emplacement_Archive1_idx` (`idEmplacement_Archive`),
  KEY `fk_Lieux_Document_Sous_Emplacement1_idx` (`idSous_Emplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_equipement`
--

CREATE TABLE IF NOT EXISTS `lieu_equipement` (
  `idLieu_Equipement` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipement` int(11) NOT NULL,
  `idPlateforme` int(11) NOT NULL,
  PRIMARY KEY (`idLieu_Equipement`,`idEquipement`,`idPlateforme`),
  KEY `fk_Lieu_Equipement_Plateforme1_idx` (`idPlateforme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_utilisation`
--

CREATE TABLE IF NOT EXISTS `lieu_utilisation` (
  `idLieu_Utilisation` int(11) NOT NULL AUTO_INCREMENT,
  `lieuUtilisation` varchar(45) DEFAULT NULL,
  `idPiece` int(11) NOT NULL,
  PRIMARY KEY (`idLieu_Utilisation`,`idPiece`),
  KEY `fk_Lieu_Equipement_Piece_Equipement1_idx` (`idPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `piece_document`
--

CREATE TABLE IF NOT EXISTS `piece_document` (
  `idPiece_Document` int(11) NOT NULL AUTO_INCREMENT,
  `pieceDocument` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPiece_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `piece_equipement`
--

CREATE TABLE IF NOT EXISTS `piece_equipement` (
  `idPiece` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` varchar(45) DEFAULT NULL,
  `piece` varchar(45) DEFAULT NULL,
  `idFonction_Principal` int(11) NOT NULL,
  PRIMARY KEY (`idPiece`,`idFonction_Principal`),
  KEY `fk_Piece_Equipement_Fonction_Principal1_idx` (`idFonction_Principal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `planning_occupation`
--

CREATE TABLE IF NOT EXISTS `planning_occupation` (
  `idPlanning_Occupation` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idLieu_Equipement` int(11) NOT NULL,
  PRIMARY KEY (`idPlanning_Occupation`,`idUtilisateur`,`idLieu_Equipement`),
  KEY `fk_Planning_Occupation_Utilisateur1_idx` (`idUtilisateur`),
  KEY `fk_Planning_Occupation_Lieu_Equipement1_idx` (`idLieu_Equipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE IF NOT EXISTS `plateforme` (
  `idPlateforme` int(11) NOT NULL AUTO_INCREMENT,
  `plateforme` varchar(45) DEFAULT NULL,
  `idLieu_Utilisation` int(11) NOT NULL,
  PRIMARY KEY (`idPlateforme`,`idLieu_Utilisation`),
  KEY `fk_Plateforme_Lieu_Equipement1_idx` (`idLieu_Utilisation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plateforme_archive`
--

CREATE TABLE IF NOT EXISTS `plateforme_archive` (
  `idPlateforme_Archive` int(11) NOT NULL AUTO_INCREMENT,
  `plateformeArchive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPlateforme_Archive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

CREATE TABLE IF NOT EXISTS `processus` (
  `idProcessus` int(11) NOT NULL AUTO_INCREMENT,
  `valeurProcessus` varchar(45) DEFAULT NULL,
  `Processus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProcessus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sous_emplacement`
--

CREATE TABLE IF NOT EXISTS `sous_emplacement` (
  `idSous_Emplacement` int(11) NOT NULL AUTO_INCREMENT,
  `sousEmplacement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSous_Emplacement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sous_processus`
--

CREATE TABLE IF NOT EXISTS `sous_processus` (
  `idSous_Processus` int(11) NOT NULL AUTO_INCREMENT,
  `valeurSousProcessus` varchar(45) DEFAULT NULL,
  `sousProcessus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSous_Processus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_document`
--

CREATE TABLE IF NOT EXISTS `type_document` (
  `idType_Document` int(11) NOT NULL AUTO_INCREMENT,
  `valeurTypeDoc` varchar(45) DEFAULT NULL,
  `typeDocument` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idType_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` varchar(45) DEFAULT NULL,
  `prenomUtilisateur` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `email`, `login`, `password`, `role`) VALUES
(1, 'Fernandes', 'Tiago', 'tiago_fernandes@live.fr', 'test', 'test', 'Administrateur');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
