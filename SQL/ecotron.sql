-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 29 Mai 2015 à 15:39
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ecotron`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `acronime_etiquette`
--

INSERT INTO `acronime_etiquette` (`idAcronimeEtiquette`, `valeurAcronime`, `acronimeEtiquette`) VALUES
(1, 'DO2', 'Mesure de l O2 dissous'),
(2, 'REF', 'Réfrigérateur'),
(3, 'FRE', 'Congélateur');

-- --------------------------------------------------------

--
-- Structure de la table `acronime_has_categorie`
--

CREATE TABLE IF NOT EXISTS `acronime_has_categorie` (
  `idCategorieEtiquette` int(11) NOT NULL,
  `idAcronimeEtiquette` int(11) NOT NULL,
  PRIMARY KEY (`idAcronimeEtiquette`,`idCategorieEtiquette`),
  KEY `fk_Acronime_Etiquette_has_Categorie_Etiquette_Categorie_Eti_idx` (`idCategorieEtiquette`),
  KEY `fk_Acronime_Etiquette_has_Categorie_Etiquette_Acronime_Etiq_idx` (`idAcronimeEtiquette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `acronime_has_categorie`
--

INSERT INTO `acronime_has_categorie` (`idCategorieEtiquette`, `idAcronimeEtiquette`) VALUES
(5, 1),
(5, 2),
(5, 3);

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
  `valeurCategorie` varchar(45) DEFAULT NULL,
  `categorieEtiquette` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategorieEtiquette`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `categorie_etiquette`
--

INSERT INTO `categorie_etiquette` (`idCategorieEtiquette`, `valeurCategorie`, `categorieEtiquette`) VALUES
(1, 'A', 'Actionneur'),
(2, 'S', 'Sampler'),
(3, 'SA', 'Sample Analyser'),
(4, 'SC', 'Sample Conditionner'),
(5, 'SE', 'SEnsor'),
(6, 'C', 'Container'),
(7, 'CL', 'Communication Tools'),
(8, 'DL', 'Data Logger Module'),
(9, 'E', 'Electronics'),
(10, 'SI', 'Services and Infrastructure'),
(11, 'V', 'Vehicles');

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
  `idSous_Emplacement` int(11) NOT NULL,
  PRIMARY KEY (`idEmplacement_Archive`,`idSous_Emplacement`),
  KEY `fk_Emplacement_Archive_Sous_Emplacement1_idx` (`idSous_Emplacement`)
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
  `nomEquiment` varchar(45) DEFAULT NULL,
  `idType` int(11) NOT NULL,
  `idFournisseur` int(11) NOT NULL,
  `prix` double DEFAULT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `dateAjout` date DEFAULT NULL,
  `dateFabrication` date DEFAULT NULL,
  `dateReception` date DEFAULT NULL,
  `dateMiseService` date DEFAULT NULL,
  `garantie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEquipement`,`idType`,`idFournisseur`),
  KEY `fk_Equipement_Type_idx` (`idType`),
  KEY `fk_Equipement_Fournisseur1_idx` (`idFournisseur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`idEquipement`, `nomEquiment`, `idType`, `idFournisseur`, `prix`, `marque`, `dateAjout`, `dateFabrication`, `dateReception`, `dateMiseService`, `garantie`) VALUES
(2, 'Capteur', 2, 2, 100, 'dell', '2015-05-08', '2015-05-11', '2015-05-06', '2015-05-06', 2);

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
-- Structure de la table `etiequipement`
--

CREATE TABLE IF NOT EXISTS `etiequipement` (
  `idEtiEquipement` int(11) NOT NULL AUTO_INCREMENT,
  `idCategorieEtiquette` int(11) NOT NULL,
  PRIMARY KEY (`idEtiEquipement`,`idCategorieEtiquette`),
  KEY `fk_EtiEquipement_Categorie_Etiquette1_idx` (`idCategorieEtiquette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etiquette_document`
--

CREATE TABLE IF NOT EXISTS `etiquette_document` (
  `idEtiquette_Document` int(11) NOT NULL AUTO_INCREMENT,
  `idType_Document` int(11) NOT NULL,
  PRIMARY KEY (`idEtiquette_Document`,`idType_Document`),
  KEY `fk_Etiquette_Document_Type_Document1_idx` (`idType_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etiquette_equipement`
--

CREATE TABLE IF NOT EXISTS `etiquette_equipement` (
  `idEtiquette_Equipement` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipement` int(11) NOT NULL,
  `idCategorieEtiquette` int(11) NOT NULL,
  PRIMARY KEY (`idEtiquette_Equipement`,`idEquipement`,`idCategorieEtiquette`),
  KEY `fk_Etiquette_Equipement_Categorie_Etiquette1_idx` (`idCategorieEtiquette`),
  KEY `fk_Etiquette_Equipement_Equipement1_idx` (`idEquipement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `etiquette_equipement`
--

INSERT INTO `etiquette_equipement` (`idEtiquette_Equipement`, `idEquipement`, `idCategorieEtiquette`) VALUES
(1, 2, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`idLieux_Document`,`idPlateforme_Archive`),
  KEY `fk_Lieux_Document_Plateforme_Archive1_idx` (`idPlateforme_Archive`)
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
  `lieuEquipement` varchar(45) DEFAULT NULL,
  `idPiece` int(11) NOT NULL,
  PRIMARY KEY (`idLieu_Utilisation`,`idPiece`),
  KEY `fk_Lieu_Equipement_Piece_Equipement1_idx` (`idPiece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `numero_document`
--

CREATE TABLE IF NOT EXISTS `numero_document` (
  `idNumero_Document` int(11) NOT NULL AUTO_INCREMENT,
  `idEtiEquipement` int(11) NOT NULL,
  PRIMARY KEY (`idNumero_Document`,`idEtiEquipement`),
  KEY `fk_Numero_Document_EtiEquipement1_idx` (`idEtiEquipement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `piece_document`
--

CREATE TABLE IF NOT EXISTS `piece_document` (
  `idPiece_Document` int(11) NOT NULL AUTO_INCREMENT,
  `pieceDocument` varchar(45) DEFAULT NULL,
  `idEmplacement_Archive` int(11) NOT NULL,
  PRIMARY KEY (`idPiece_Document`,`idEmplacement_Archive`),
  KEY `fk_Piece_Document_Emplacement_Archive1_idx` (`idEmplacement_Archive`)
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
  `idPiece_Document` int(11) NOT NULL,
  PRIMARY KEY (`idPlateforme_Archive`,`idPiece_Document`),
  KEY `fk_Plateforme_Archive_Piece_Document1_idx` (`idPiece_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

CREATE TABLE IF NOT EXISTS `processus` (
  `idProcessus` int(11) NOT NULL AUTO_INCREMENT,
  `Processus` varchar(45) DEFAULT NULL,
  `idSous_Processus` int(11) NOT NULL,
  PRIMARY KEY (`idProcessus`,`idSous_Processus`),
  KEY `fk_Processus_Sous_Processus1_idx` (`idSous_Processus`)
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
  `sousProcessus` varchar(45) DEFAULT NULL,
  `idNumero_Document` int(11) NOT NULL,
  PRIMARY KEY (`idSous_Processus`,`idNumero_Document`),
  KEY `fk_Sous_Processus_Numero_Document1_idx` (`idNumero_Document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `nomType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_document`
--

CREATE TABLE IF NOT EXISTS `type_document` (
  `idType_Document` int(11) NOT NULL AUTO_INCREMENT,
  `typeDocument` varchar(45) DEFAULT NULL,
  `idProcessus` int(11) NOT NULL,
  PRIMARY KEY (`idType_Document`,`idProcessus`),
  KEY `fk_Type_Document_Processus1_idx` (`idProcessus`)
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
(1, 'Fernandes', 'Tiago', 'tiago_fernandes@live.fr', 'test', 'test', 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
