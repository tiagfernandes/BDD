-- MySQL Script generated by MySQL Workbench
-- 05/27/15 10:04:35
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ecotron
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ecotron` ;

-- -----------------------------------------------------
-- Schema ecotron
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ecotron` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ecotron` ;

-- -----------------------------------------------------
-- Table `ecotron`.`Type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Type` (
  `idType` INT NOT NULL AUTO_INCREMENT,
  `nomType` VARCHAR(45) NULL,
  PRIMARY KEY (`idType`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Fournisseur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Fournisseur` (
  `idFournisseur` INT NOT NULL AUTO_INCREMENT,
  `nomFournisseur` VARCHAR(45) NULL,
  `adresse` VARCHAR(45) NULL,
  `cp` INT NULL,
  `ville` VARCHAR(45) NULL,
  `telephone` INT NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idFournisseur`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Categorie_Etiquette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Categorie_Etiquette` (
  `idCategorieEtiquette` INT NOT NULL AUTO_INCREMENT,
  `categorieEtiquette` VARCHAR(45) NULL,
  PRIMARY KEY (`idCategorieEtiquette`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Acronime_Etiquette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Acronime_Etiquette` (
  `idAcronimeEtiquette` INT NOT NULL AUTO_INCREMENT,
  `acronimeEtiquette` VARCHAR(45) NULL,
  PRIMARY KEY (`idAcronimeEtiquette`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Numero_Etiquette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Numero_Etiquette` (
  `idNumeroEtiquette` INT NOT NULL AUTO_INCREMENT,
  `numeroEtiquette` INT NULL,
  PRIMARY KEY (`idNumeroEtiquette`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Etiquette_Equipement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Etiquette_Equipement` (
  `idEtiquetteEquipement` INT NOT NULL AUTO_INCREMENT,
  `idCategorieEtiquette` INT NOT NULL,
  `idAcronimeEtiquette` INT NOT NULL,
  `idNumeroEtiquette` INT NOT NULL,
  PRIMARY KEY (`idEtiquetteEquipement`, `idCategorieEtiquette`, `idAcronimeEtiquette`, `idNumeroEtiquette`),
  INDEX `fk_Etiquette_Equipement_Categorie_Etiquette1_idx` (`idCategorieEtiquette` ASC),
  INDEX `fk_Etiquette_Equipement_Acronime_Etiquette1_idx` (`idAcronimeEtiquette` ASC),
  INDEX `fk_Etiquette_Equipement_Numero_Etiquette1_idx` (`idNumeroEtiquette` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Equipement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Equipement` (
  `idEquipement` INT NOT NULL AUTO_INCREMENT,
  `idEtiquetteEquipement` INT NOT NULL,
  `nomEquiment` VARCHAR(45) NULL,
  `idType` INT NOT NULL,
  `idFournisseur` INT NOT NULL,
  `dateAjout` DATE NULL,
  `prix` DOUBLE NULL,
  `marque` VARCHAR(45) NULL,
  `anneeFabrication` DATE NULL,
  `dateReception` DATE NULL,
  `dateMiseService` DATE NULL,
  `garentie` INT NULL,
  PRIMARY KEY (`idEquipement`, `idEtiquetteEquipement`, `idType`, `idFournisseur`),
  INDEX `fk_Equipement_Type_idx` (`idType` ASC),
  INDEX `fk_Equipement_Fournisseur1_idx` (`idFournisseur` ASC),
  INDEX `fk_Equipement_Etiquette_Document1_idx` (`idEtiquetteEquipement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Type_Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Type_Document` (
  `idType_Document` INT NOT NULL AUTO_INCREMENT,
  `document` VARCHAR(45) NULL,
  PRIMARY KEY (`idType_Document`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Sous_Processus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Sous_Processus` (
  `idSous_Processus` INT NOT NULL AUTO_INCREMENT,
  `sousProcessus` VARCHAR(45) NULL,
  PRIMARY KEY (`idSous_Processus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Processus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Processus` (
  `idProcessus` INT NOT NULL AUTO_INCREMENT,
  `Processus` VARCHAR(45) NULL,
  PRIMARY KEY (`idProcessus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Numero_Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Numero_Document` (
  `idNumero_Document` INT NOT NULL AUTO_INCREMENT,
  `Numero_Document` INT NULL,
  PRIMARY KEY (`idNumero_Document`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Etiquette_Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Etiquette_Document` (
  `idEtiquette_Document` INT NOT NULL AUTO_INCREMENT,
  `idType_Document` INT NOT NULL,
  `idSous_Processus` INT NOT NULL,
  `idProcessus` INT NOT NULL,
  `idNumero_Document` INT NOT NULL,
  PRIMARY KEY (`idEtiquette_Document`, `idType_Document`, `idSous_Processus`, `idProcessus`, `idNumero_Document`),
  INDEX `fk_Etiquette_Document_Type_Document1_idx` (`idType_Document` ASC),
  INDEX `fk_Etiquette_Document_Sous_Processus1_idx` (`idSous_Processus` ASC),
  INDEX `fk_Etiquette_Document_Processus1_idx` (`idProcessus` ASC),
  INDEX `fk_Etiquette_Document_Numero_Document1_idx` (`idNumero_Document` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Plateforme_Archive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Plateforme_Archive` (
  `idPlateforme_Archive` INT NOT NULL AUTO_INCREMENT,
  `plateformeArchive` VARCHAR(45) NULL,
  PRIMARY KEY (`idPlateforme_Archive`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Piece`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Piece` (
  `idPiece` INT NOT NULL AUTO_INCREMENT,
  `Piece` VARCHAR(45) NULL,
  PRIMARY KEY (`idPiece`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Emplacement_Archive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Emplacement_Archive` (
  `idEmplacement_Archive` INT NOT NULL AUTO_INCREMENT,
  `emplacementArchive` VARCHAR(45) NULL,
  PRIMARY KEY (`idEmplacement_Archive`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Sous_Emplacement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Sous_Emplacement` (
  `idSous_Emplacement` INT NOT NULL AUTO_INCREMENT,
  `sousEmplacement` VARCHAR(45) NULL,
  PRIMARY KEY (`idSous_Emplacement`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Lieux_Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Lieux_Document` (
  `idLieux_Document` INT NOT NULL AUTO_INCREMENT,
  `idPlateforme_Archive` INT NOT NULL,
  `idPiece` INT NOT NULL,
  `idEmplacement_Archive` INT NOT NULL,
  `idSous_Emplacement` INT NOT NULL,
  PRIMARY KEY (`idLieux_Document`, `idPlateforme_Archive`, `idPiece`, `idEmplacement_Archive`, `idSous_Emplacement`),
  INDEX `fk_Lieux_Document_Plateforme_Archive1_idx` (`idPlateforme_Archive` ASC),
  INDEX `fk_Lieux_Document_Piece1_idx` (`idPiece` ASC),
  INDEX `fk_Lieux_Document_Emplacement_Archive1_idx` (`idEmplacement_Archive` ASC),
  INDEX `fk_Lieux_Document_Sous_Emplacement1_idx` (`idSous_Emplacement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Document` (
  `idDocument` INT NOT NULL AUTO_INCREMENT,
  `document` VARCHAR(45) NULL,
  `idEtiquette_Document` INT NOT NULL,
  `idLieux_Document` INT NOT NULL,
  PRIMARY KEY (`idDocument`, `idEtiquette_Document`, `idLieux_Document`),
  INDEX `fk_Document_Etiquette_Document1_idx` (`idEtiquette_Document` ASC),
  INDEX `fk_Document_Lieux_Document1_idx` (`idLieux_Document` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Utilisateur` (
  `idUtilisateur` INT NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` VARCHAR(45) NULL,
  `prenomUtilisateur` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `identifiantUtilisateur` VARCHAR(45) NULL,
  `mdpUtilisateur` VARCHAR(45) NULL,
  PRIMARY KEY (`idUtilisateur`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Planning_Occupation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Planning_Occupation` (
  `idPlanning_Occupation` INT NOT NULL AUTO_INCREMENT,
  `dateDebut` DATETIME NULL,
  `dateFin` DATETIME NULL,
  `idUtilisateur` INT NOT NULL,
  `Lieu_Occupation` VARCHAR(45) NULL,
  PRIMARY KEY (`idPlanning_Occupation`, `idUtilisateur`),
  INDEX `fk_Planning_Occupation_Utilisateur1_idx` (`idUtilisateur` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Equipement_has_Document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Equipement_has_Document` (
  `idEquipement` INT NOT NULL,
  `idDocument` INT NOT NULL,
  PRIMARY KEY (`idEquipement`, `idDocument`),
  INDEX `fk_Equipement_has_Document_Document1_idx` (`idDocument` ASC),
  INDEX `fk_Equipement_has_Document_Equipement1_idx` (`idEquipement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Entretient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Entretient` (
  `idEntretient` INT NOT NULL AUTO_INCREMENT,
  `dateEntretient` DATETIME NULL,
  `idUtilisateur` INT NOT NULL,
  PRIMARY KEY (`idEntretient`, `idUtilisateur`),
  INDEX `fk_Entretient_Utilisateur1_idx` (`idUtilisateur` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Equipement_has_Entretient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Equipement_has_Entretient` (
  `idEquipement` INT NOT NULL,
  `idEntretient` INT NOT NULL,
  PRIMARY KEY (`idEquipement`, `idEntretient`),
  INDEX `fk_Equipement_has_Entretient_Entretient1_idx` (`idEntretient` ASC),
  INDEX `fk_Equipement_has_Entretient_Equipement1_idx` (`idEquipement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Liaison`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Liaison` (
  `idLiaison` INT NOT NULL AUTO_INCREMENT,
  `idEquipement1` INT NOT NULL,
  `idEquipement2` INT NOT NULL,
  PRIMARY KEY (`idLiaison`, `idEquipement1`, `idEquipement2`),
  INDEX `fk_Liaison_Equipement1_idx` (`idEquipement1` ASC),
  INDEX `fk_Liaison_Equipement2_idx` (`idEquipement2` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Anomalie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Anomalie` (
  `idAnomalie` INT NOT NULL AUTO_INCREMENT,
  `nomAnomalie` VARCHAR(45) NULL,
  `dateAnomalie` DATETIME NULL,
  `finAnomalie` DATETIME NULL,
  `description` VARCHAR(200) NULL,
  `idUtilisateur` INT NOT NULL,
  PRIMARY KEY (`idAnomalie`, `idUtilisateur`),
  INDEX `fk_Panne_Utilisateur1_idx` (`idUtilisateur` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Equipement_has_Anomalie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Equipement_has_Anomalie` (
  `idEquipement` INT NOT NULL,
  `idAnomalie` INT NOT NULL,
  PRIMARY KEY (`idEquipement`, `idAnomalie`),
  INDEX `fk_Equipement_has_Panne_Panne1_idx` (`idAnomalie` ASC),
  INDEX `fk_Equipement_has_Panne_Equipement1_idx` (`idEquipement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Equipement_has_Planning_Occupation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Equipement_has_Planning_Occupation` (
  `idEquipement` INT NOT NULL,
  `idPlanning_Occupation` INT NOT NULL,
  PRIMARY KEY (`idEquipement`, `idPlanning_Occupation`),
  INDEX `fk_Equipement_has_Planning_Occupation_Planning_Occupation1_idx` (`idPlanning_Occupation` ASC),
  INDEX `fk_Equipement_has_Planning_Occupation_Equipement1_idx` (`idEquipement` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Plateforme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Plateforme` (
  `idPlateforme` INT NOT NULL AUTO_INCREMENT,
  `plateforme` VARCHAR(45) NULL,
  PRIMARY KEY (`idPlateforme`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Fonction_Principal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Fonction_Principal` (
  `idFonction_Principal` INT NOT NULL AUTO_INCREMENT,
  `fonctionPrincipal` VARCHAR(45) NULL,
  PRIMARY KEY (`idFonction_Principal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Fonction_Secondaire`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Fonction_Secondaire` (
  `idFonction_Secondaire` INT NOT NULL AUTO_INCREMENT,
  `fonctionSecondaire` VARCHAR(45) NULL,
  PRIMARY KEY (`idFonction_Secondaire`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Lieux`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Lieux` (
  `idLieux` INT NOT NULL AUTO_INCREMENT,
  `lieux` VARCHAR(45) NULL,
  PRIMARY KEY (`idLieux`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Pièce`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Pièce` (
  `idPièce` INT NOT NULL AUTO_INCREMENT,
  `piece` VARCHAR(45) NULL,
  PRIMARY KEY (`idPièce`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecotron`.`Lieu_Equipement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecotron`.`Lieu_Equipement` (
  `idEquipement` INT NOT NULL,
  `idPlateforme` INT NOT NULL,
  `idLieux` INT NOT NULL,
  `idPièce` INT NOT NULL,
  `idFonction_Principal` INT NOT NULL,
  `idFonction_Secondaire` INT NOT NULL,
  PRIMARY KEY (`idEquipement`, `idPlateforme`, `idLieux`, `idPièce`, `idFonction_Principal`, `idFonction_Secondaire`),
  INDEX `fk_Lieu_Equipement_Plateforme1_idx` (`idPlateforme` ASC),
  INDEX `fk_Lieu_Equipement_Lieux1_idx` (`idLieux` ASC),
  INDEX `fk_Lieu_Equipement_Pièce1_idx` (`idPièce` ASC),
  INDEX `fk_Lieu_Equipement_Fonction_Principal1_idx` (`idFonction_Principal` ASC),
  INDEX `fk_Lieu_Equipement_Fonction_Secondaire1_idx` (`idFonction_Secondaire` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
