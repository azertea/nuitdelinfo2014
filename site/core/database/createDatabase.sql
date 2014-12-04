-- MySQL Script generated by MySQL Workbench
-- 12/04/14 22:36:48
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Nuitdelinfo2014
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Nuitdelinfo2014` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Nuitdelinfo2014` ;

-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`Refuge`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`Refuge` (
  `idRefuge` INT NOT NULL AUTO_INCREMENT,
  `GPS` VARCHAR(45) NULL,
  PRIMARY KEY (`idRefuge`))
ENGINE = InnoDB
COMMENT = 'Cette table permet de stockre les coordonnées GPS d\'un refuge';


-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`Type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`Type` (
  `idType` INT NOT NULL,
  `libelle` VARCHAR(45) NULL DEFAULT 'Public',
  PRIMARY KEY (`idType`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`User` (
  `idUserPublic` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `pwd` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `Refuge_idRefuge` INT NOT NULL,
  `Type_idType` INT NOT NULL,
  PRIMARY KEY (`idUserPublic`),
  INDEX `fk_User_Refuge1_idx` (`Refuge_idRefuge` ASC),
  INDEX `fk_User_Type1_idx` (`Type_idType` ASC),
  CONSTRAINT `fk_User_Refuge`
    FOREIGN KEY (`Refuge_idRefuge`)
    REFERENCES `Nuitdelinfo2014`.`Refuge` (`idRefuge`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Type`
    FOREIGN KEY (`Type_idType`)
    REFERENCES `Nuitdelinfo2014`.`Type` (`idType`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tout utilisateur peut s\'enregistrer pour rechercher des membres.';


-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`Recherche`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`Recherche` (
  `idRecherche` INT NOT NULL AUTO_INCREMENT,
  `keywordDesc` VARCHAR(300) NULL,
  `keywordLoc` VARCHAR(300) NULL,
  `User_idUserPublic` INT NOT NULL,
  PRIMARY KEY (`idRecherche`),
  INDEX `fk_Recherche_User_idx` (`User_idUserPublic` ASC),
  CONSTRAINT `fk_Recherche_User`
    FOREIGN KEY (`User_idUserPublic`)
    REFERENCES `Nuitdelinfo2014`.`User` (`idUserPublic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Contient les informations liées à une recherche par un chercheur.';


-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`Profil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`Profil` (
  `idProfil` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `prenom` VARCHAR(45) NULL,
  `descPhysique` VARCHAR(300) NULL,
  `localisation` VARCHAR(45) NULL,
  `telephone` VARCHAR(45) NULL,
  `Refuge_idRefuge` INT NOT NULL,
  `User_idUserPublic` INT NOT NULL,
  PRIMARY KEY (`idProfil`),
  INDEX `fk_Profil_Refuge_idx` (`Refuge_idRefuge` ASC),
  INDEX `fk_Profil_User_idx` (`User_idUserPublic` ASC),
  CONSTRAINT `fk_Profil_Refuge`
    FOREIGN KEY (`Refuge_idRefuge`)
    REFERENCES `Nuitdelinfo2014`.`Refuge` (`idRefuge`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Profil_User`
    FOREIGN KEY (`User_idUserPublic`)
    REFERENCES `Nuitdelinfo2014`.`User` (`idUserPublic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Cette classe regroupe les informations correspondantes aux profils recherchés.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
