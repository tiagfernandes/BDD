-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 31 Juillet 2015 à 09:06
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `acronime_etiquette`
--

INSERT INTO `acronime_etiquette` (`idAcronimeEtiquette`, `valeurAcronime`, `acronimeEtiquette`) VALUES
(0, ' ', ' '),
(1, 'DO2', 'Mesure de l''O2 dissous'),
(3, 'SCA', 'Balance'),
(5, 'STO', 'Etuve'),
(6, 'REF', 'RÃ©frigÃ©rateur'),
(7, 'FRE', 'CongÃ©lateur'),
(8, 'STE', 'GÃ©nÃ©rateur de vapeur'),
(12, 'PHY', 'Phytotron'),
(14, 'APUM', 'Pompe Ã  air'),
(15, 'WPUM', 'Pompe Ã  eau'),
(16, 'CRY', 'Cryothermostat'),
(17, 'LYO', 'Lyophilisateur'),
(18, 'OVE', 'Four Ã  moufle'),
(19, 'TEC', 'Auto analyseur Technicon');

-- --------------------------------------------------------

--
-- Structure de la table `anomalie`
--

CREATE TABLE IF NOT EXISTS `anomalie` (
  `idAnomalie` int(11) NOT NULL AUTO_INCREMENT,
  `nomAnomalie` varchar(45) NOT NULL,
  `dateAnomalie` date DEFAULT NULL,
  `finAnomalie` date DEFAULT NULL,
  `descriptionAnomalie` varchar(1000) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAnomalie`,`idUtilisateur`),
  KEY `fk_Panne_Utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `calibration`
--

CREATE TABLE IF NOT EXISTS `calibration` (
  `idCalibration` int(11) NOT NULL AUTO_INCREMENT,
  `nomCalibration` varchar(45) NOT NULL,
  `dateCalibration` date DEFAULT NULL,
  `finCalibration` date DEFAULT NULL,
  `descriptionCalibration` varchar(1000) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idCalibration`,`idUtilisateur`),
  KEY `fk_calibration_utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_etiquette`
--

CREATE TABLE IF NOT EXISTS `categorie_etiquette` (
  `idCategorieEtiquette` int(11) NOT NULL AUTO_INCREMENT,
  `valeurCategorie` varchar(45) DEFAULT NULL,
  `categorieEtiquette` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategorieEtiquette`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `categorie_etiquette`
--

INSERT INTO `categorie_etiquette` (`idCategorieEtiquette`, `valeurCategorie`, `categorieEtiquette`) VALUES
(0, ' ', ' '),
(1, 'A', 'Actuator'),
(2, 'S', 'Sampler'),
(3, 'SA', 'Sample Analyser'),
(4, 'SC', 'Sample Conditionner'),
(5, 'SE', 'SEnsor'),
(6, 'C', 'Container'),
(8, 'DL', 'Data Logger Module'),
(9, 'E', 'Electronics'),
(10, 'SI', 'Services and Infrastructure'),
(14, 'V', 'Vehicles');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `idDocument` int(11) NOT NULL AUTO_INCREMENT,
  `nomDocument` varchar(45) DEFAULT NULL,
  `idEtiquette_Document` int(11) NOT NULL,
  `idLieux_Document` int(11) NOT NULL DEFAULT '0',
  `nomFichier` varchar(50) DEFAULT NULL,
  `cheminFichier` varchar(200) DEFAULT NULL,
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
  `valeurEmplacement` varchar(45) DEFAULT NULL,
  `emplacementArchive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEmplacement_Archive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `emplacement_archive`
--

INSERT INTO `emplacement_archive` (`idEmplacement_Archive`, `valeurEmplacement`, `emplacementArchive`) VALUES
(0, ' ', ' '),
(1, 'A1', 'Armoire nÂ°1'),
(2, 'A2', 'Armoire nÂ°2');

-- --------------------------------------------------------

--
-- Structure de la table `entretien`
--

CREATE TABLE IF NOT EXISTS `entretien` (
  `idEntretien` int(11) NOT NULL AUTO_INCREMENT,
  `nomEntretien` varchar(45) NOT NULL,
  `dateEntretien` date DEFAULT NULL,
  `finEntretien` date DEFAULT NULL,
  `descriptionEntretien` varchar(1000) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idEntretien`,`idUtilisateur`),
  KEY `fk_Entretient_Utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `idEquipement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipement` varchar(45) DEFAULT NULL,
  `idFournisseur` int(11) NOT NULL DEFAULT '0',
  `prix` double DEFAULT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `dateAjout` date DEFAULT NULL,
  `dateFabrication` date DEFAULT NULL,
  `dateReception` date DEFAULT NULL,
  `dateMiseService` date DEFAULT NULL,
  `garantie` date DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `idPlateforme` int(11) NOT NULL,
  `nomVariableAutomate` varchar(45) DEFAULT NULL,
  `adresseAutomate` varchar(45) DEFAULT NULL,
  `idStoc` varchar(45) DEFAULT NULL,
  `nFabrication` int(11) DEFAULT NULL,
  `attestationExamen` varchar(45) DEFAULT NULL,
  `contratEntretien` varchar(45) DEFAULT NULL,
  `suppleant` varchar(45) DEFAULT NULL,
  `observation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEquipement`,`idFournisseur`,`idPlateforme`),
  KEY `fk_Equipement_Fournisseur1_idx` (`idFournisseur`),
  KEY `fk_equipement_plateforme1_idx` (`idPlateforme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`idEquipement`, `nomEquipement`, `idFournisseur`, `prix`, `marque`, `dateAjout`, `dateFabrication`, `dateReception`, `dateMiseService`, `garantie`, `responsable`, `idPlateforme`, `nomVariableAutomate`, `adresseAutomate`, `idStoc`, `nFabrication`, `attestationExamen`, `contratEntretien`, `suppleant`, `observation`) VALUES
(1, 'Test', 0, 100, '', '2015-06-12', '0000-00-00', '0000-00-00', '2015-06-12', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Test 2', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Etuve', 0, 0, 'PROLABO EB 280', '2015-06-12', '0000-00-00', '1990-01-01', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'RÃ©frigÃ©rateur', 0, 0, 'PROLINE', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'CongÃ©lateur', 0, 0, 'PROLINE', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Magicien d Oz', 1, 0, 'WEISHAUPT WL30Z-C Magicien d''Oz', '2015-06-12', '0000-00-00', '2010-06-01', '2010-06-01', '0000-00-00', '', 1, '', '', '', 0, '', '', '', ''),
(7, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Pompe pÃ©ristaltique', 0, 0, '', '2015-06-12', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

--
-- Contenu de la table `equipement_has_document`
--

INSERT INTO `equipement_has_document` (`idEquipement`, `idDocument`) VALUES
(0, 1),
(0, 2),
(0, 3),
(0, 4),
(0, 5),
(0, 6),
(0, 7),
(0, 8),
(0, 9),
(0, 10),
(0, 11),
(0, 12),
(0, 13),
(0, 14),
(0, 15),
(0, 16),
(0, 17),
(0, 18),
(0, 19);

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
  `idEtiquette_Equipement` int(11) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `etiquette_equipement`
--

INSERT INTO `etiquette_equipement` (`idEtiquette_Equipement`, `idCategorieEtiquette`, `idAcronimeEtiquette`, `idEquipement`) VALUES
(0, 0, 0, 0),
(1, 1, 1, 1),
(7, 1, 15, 7),
(8, 1, 15, 8),
(9, 1, 15, 9),
(10, 1, 15, 10),
(11, 1, 15, 11),
(12, 1, 15, 12),
(13, 1, 15, 13),
(14, 1, 15, 14),
(16, 1, 15, 16),
(17, 1, 15, 17),
(18, 1, 15, 18),
(2, 2, 3, 2),
(3, 4, 5, 3),
(4, 4, 6, 4),
(5, 4, 7, 5),
(6, 4, 8, 6);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_de_vie`
--

CREATE TABLE IF NOT EXISTS `fiche_de_vie` (
  `idFicheDeVie` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipement` int(11) NOT NULL,
  PRIMARY KEY (`idFicheDeVie`,`idEquipement`),
  KEY `fk_fiche_de_vie_equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `fiche_de_vie`
--

INSERT INTO `fiche_de_vie` (`idFicheDeVie`, `idEquipement`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(16, 16),
(17, 17),
(18, 18);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_de_vie_has_anomalie`
--

CREATE TABLE IF NOT EXISTS `fiche_de_vie_has_anomalie` (
  `idFicheDeVie` int(11) NOT NULL,
  `idAnomalie` int(11) NOT NULL,
  PRIMARY KEY (`idFicheDeVie`,`idAnomalie`),
  KEY `fk_fiche_de_vie_has_anomalie_anomalie1_idx` (`idAnomalie`),
  KEY `fk_fiche_de_vie_has_anomalie_fiche_de_vie1_idx` (`idFicheDeVie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fiche_de_vie_has_anomalie`
--

INSERT INTO `fiche_de_vie_has_anomalie` (`idFicheDeVie`, `idAnomalie`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_de_vie_has_calibration`
--

CREATE TABLE IF NOT EXISTS `fiche_de_vie_has_calibration` (
  `idFicheDeVie` int(11) NOT NULL,
  `idCalibration` int(11) NOT NULL,
  PRIMARY KEY (`idFicheDeVie`,`idCalibration`),
  KEY `fk_fiche_de_vie_has_calibration_calibration1_idx` (`idCalibration`),
  KEY `fk_fiche_de_vie_has_calibration_fiche_de_vie1_idx` (`idFicheDeVie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_de_vie_has_entretien`
--

CREATE TABLE IF NOT EXISTS `fiche_de_vie_has_entretien` (
  `idFicheDeVie` int(11) NOT NULL,
  `idEntretien` int(11) NOT NULL,
  PRIMARY KEY (`idFicheDeVie`,`idEntretien`),
  KEY `fk_fiche_de_vie_has_entretient_entretient1_idx` (`idEntretien`),
  KEY `fk_fiche_de_vie_has_entretient_fiche_de_vie1_idx` (`idFicheDeVie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `idFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nomFournisseur` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `pays` varchar(45) DEFAULT NULL,
  `telephone` tinytext,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idFournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idFournisseur`, `nomFournisseur`, `adresse`, `cp`, `ville`, `pays`, `telephone`, `email`) VALUES
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'CNRS', '78 rue du chÃ¢teau', 77140, 'St Pierre les Nemours', 'France', '', '');

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
-- Structure de la table `lieu_utilisation`
--

CREATE TABLE IF NOT EXISTS `lieu_utilisation` (
  `idLieu_Utilisation` int(11) NOT NULL AUTO_INCREMENT,
  `lieuUtilisation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLieu_Utilisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `lieu_utilisation`
--

INSERT INTO `lieu_utilisation` (`idLieu_Utilisation`, `lieuUtilisation`) VALUES
(1, 'Bureau');

-- --------------------------------------------------------

--
-- Structure de la table `piece_document`
--

CREATE TABLE IF NOT EXISTS `piece_document` (
  `idPiece_Document` int(11) NOT NULL AUTO_INCREMENT,
  `valeurPiece` varchar(45) DEFAULT NULL,
  `pieceDocument` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPiece_Document`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `piece_document`
--

INSERT INTO `piece_document` (`idPiece_Document`, `valeurPiece`, `pieceDocument`) VALUES
(0, ' ', ' '),
(1, 'BC', 'Bureau CEREEP');

-- --------------------------------------------------------

--
-- Structure de la table `piece_equipement`
--

CREATE TABLE IF NOT EXISTS `piece_equipement` (
  `idPiece` int(11) NOT NULL AUTO_INCREMENT,
  `piece` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPiece`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `piece_equipement`
--

INSERT INTO `piece_equipement` (`idPiece`, `piece`) VALUES
(0, NULL),
(1, 'Bureau');

-- --------------------------------------------------------

--
-- Structure de la table `planning_occupation`
--

CREATE TABLE IF NOT EXISTS `planning_occupation` (
  `idPlanning_Occupation` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idPlateforme` int(11) NOT NULL DEFAULT '0',
  `idLieu_Utilisation` int(11) NOT NULL DEFAULT '0',
  `idPiece` int(11) NOT NULL DEFAULT '0',
  `fonctionPrincipal` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fonctionSecondaire` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idPlanning_Occupation`,`idUtilisateur`,`idPlateforme`,`idLieu_Utilisation`,`idPiece`),
  KEY `fk_Planning_Occupation_Utilisateur1_idx` (`idUtilisateur`),
  KEY `fk_planning_occupation_plateforme1_idx` (`idPlateforme`),
  KEY `fk_planning_occupation_lieu_utilisation1_idx` (`idLieu_Utilisation`),
  KEY `fk_planning_occupation_piece_equipement1_idx` (`idPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE IF NOT EXISTS `plateforme` (
  `idPlateforme` int(11) NOT NULL AUTO_INCREMENT,
  `plateforme` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPlateforme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `plateforme`
--

INSERT INTO `plateforme` (`idPlateforme`, `plateforme`) VALUES
(1, 'Ecotron');

-- --------------------------------------------------------

--
-- Structure de la table `plateforme_archive`
--

CREATE TABLE IF NOT EXISTS `plateforme_archive` (
  `idPlateforme_Archive` int(11) NOT NULL AUTO_INCREMENT,
  `valeurPlateforme` varchar(45) DEFAULT NULL,
  `plateformeArchive` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPlateforme_Archive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `plateforme_archive`
--

INSERT INTO `plateforme_archive` (`idPlateforme_Archive`, `valeurPlateforme`, `plateformeArchive`) VALUES
(0, ' ', ' '),
(1, 'Serre', 'Serre de recherche');

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

CREATE TABLE IF NOT EXISTS `processus` (
  `idProcessus` int(11) NOT NULL AUTO_INCREMENT,
  `valeurProcessus` varchar(45) DEFAULT NULL,
  `Processus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProcessus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `processus`
--

INSERT INTO `processus` (`idProcessus`, `valeurProcessus`, `Processus`) VALUES
(1, 'CI', 'Communication interne'),
(2, 'M', 'Management'),
(3, 'Q', 'Qualite'),
(4, 'A', 'Achats'),
(5, 'Mat', 'Materiels'),
(6, 'I', 'Infrastructure'),
(7, 'Inf', 'Informatique'),
(8, 'Presta', 'Prestation de service plateformes de recherch'),
(9, 'AR', 'Activite de recherche'),
(10, 'F', 'Formation'),
(11, 'H', 'Hebergement');

-- --------------------------------------------------------

--
-- Structure de la table `sous_emplacement`
--

CREATE TABLE IF NOT EXISTS `sous_emplacement` (
  `idSous_Emplacement` int(11) NOT NULL AUTO_INCREMENT,
  `valeurSousEmplacement` varchar(45) DEFAULT NULL,
  `sousEmplacement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSous_Emplacement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `sous_emplacement`
--

INSERT INTO `sous_emplacement` (`idSous_Emplacement`, `valeurSousEmplacement`, `sousEmplacement`) VALUES
(0, ' ', ' '),
(1, 'E2', 'Ã‰tagÃ¨re nÂ°2');

-- --------------------------------------------------------

--
-- Structure de la table `sous_processus`
--

CREATE TABLE IF NOT EXISTS `sous_processus` (
  `idSous_Processus` int(11) NOT NULL AUTO_INCREMENT,
  `valeurSousProcessus` varchar(45) DEFAULT NULL,
  `sousProcessus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSous_Processus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sous_processus`
--

INSERT INTO `sous_processus` (`idSous_Processus`, `valeurSousProcessus`, `sousProcessus`) VALUES
(1, 'SD', 'Systeme Documentaire'),
(3, 'Serre', 'Serre de recherche'),
(4, 'Ecotron', 'Plateforme Ecotron');

-- --------------------------------------------------------

--
-- Structure de la table `type_document`
--

CREATE TABLE IF NOT EXISTS `type_document` (
  `idType_Document` int(11) NOT NULL AUTO_INCREMENT,
  `valeurTypeDoc` varchar(45) DEFAULT NULL,
  `typeDocument` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idType_Document`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `type_document`
--

INSERT INTO `type_document` (`idType_Document`, `valeurTypeDoc`, `typeDocument`) VALUES
(1, 'PO', 'PrOcessus'),
(2, 'PR', 'PRocedure'),
(3, 'MO', 'Mode Operatoire'),
(4, 'FO', 'FOrmulaire'),
(5, 'EN', 'ENregistrements'),
(6, 'FE', 'Fiche Equipement'),
(7, 'FV', 'Fiche de Vie'),
(8, 'FA', 'Fiche Anomalie'),
(9, 'G', 'Guide d utilisation');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `email`, `login`, `password`, `role`) VALUES
(1, 'Fernandes', 'Tiago', 'tiago_fernandes@live.fr', 'test', 'test', 'Administrateur'),
(2, NULL, NULL, NULL, NULL, NULL, 'Utilisateur');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
