-- MySQL Script generated by MySQL Workbench
-- 12/04/14 23:52:22
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Nuitdelinfo2014
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Nuitdelinfo2014` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
-- -----------------------------------------------------
-- Schema nuitdelinfo2014
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `nuitdelinfo2014` DEFAULT CHARACTER SET utf8 ;
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
  `idType` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NULL DEFAULT 'Public',
  PRIMARY KEY (`idType`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Nuitdelinfo2014`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Nuitdelinfo2014`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `pwd` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `Refuge_idRefuge` INT NOT NULL,
  `Type_idType` INT NOT NULL,
  PRIMARY KEY (`login`),
  INDEX `fk_User_Refuge1_idx` (`Refuge_idRefuge` ASC),
  INDEX `fk_User_Type1_idx` (`Type_idType` ASC),
  CONSTRAINT `fk_User_Refuge1`
    FOREIGN KEY (`Refuge_idRefuge`)
    REFERENCES `Nuitdelinfo2014`.`Refuge` (`idRefuge`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Type1`
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
  `User_login` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idRecherche`),
  INDEX `fk_Recherche_User1_idx` (`User_login` ASC),
  CONSTRAINT `fk_Recherche_User1`
    FOREIGN KEY (`User_login`)
    REFERENCES `Nuitdelinfo2014`.`User` (`login`)
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
  `User_login` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idProfil`),
  INDEX `fk_Profil_Refuge1_idx` (`Refuge_idRefuge` ASC),
  INDEX `fk_Profil_User1_idx` (`User_login` ASC),
  CONSTRAINT `fk_Profil_Refuge1`
    FOREIGN KEY (`Refuge_idRefuge`)
    REFERENCES `Nuitdelinfo2014`.`Refuge` (`idRefuge`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Profil_User1`
    FOREIGN KEY (`User_login`)
    REFERENCES `Nuitdelinfo2014`.`User` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Cette classe regroupe les informations correspondantes aux profils recherchés.';

USE `nuitdelinfo2014` ;

-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`userong`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`userong` (
  `idUserONG` INT(11) NOT NULL,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `pwd` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idUserONG`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Ce profil correspond à l\'ordinateur du refuge, il contient des informations de connexion.';


-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`refuge`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`refuge` (
  `idRefuge` INT(11) NOT NULL,
  `GPS` VARCHAR(45) NULL DEFAULT NULL,
  `UserONG_idUserONG` INT(11) NOT NULL,
  PRIMARY KEY (`idRefuge`, `UserONG_idUserONG`),
  INDEX `fk_Refuge_UserONG1_idx` (`UserONG_idUserONG` ASC),
  CONSTRAINT `fk_Refuge_UserONG1`
    FOREIGN KEY (`UserONG_idUserONG`)
    REFERENCES `nuitdelinfo2014`.`userong` (`idUserONG`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Cette table permet de stockre les coordonnées GPS d\'un refuge';


-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`userpublic`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`userpublic` (
  `idUserPublic` INT(11) NOT NULL,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `pwd` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idUserPublic`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tout utilisateur peut s\'enregistrer pour rechercher des membres.';


-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`profil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`profil` (
  `idProfil` INT(11) NOT NULL,
  `nom` VARCHAR(45) NULL DEFAULT NULL,
  `prenom` VARCHAR(45) NULL DEFAULT NULL,
  `descPhysique` VARCHAR(300) NULL DEFAULT NULL,
  `localisation` VARCHAR(45) NULL DEFAULT NULL,
  `telephone` VARCHAR(45) NULL DEFAULT NULL,
  `Refuge_idRefuge` INT(11) NOT NULL,
  `Refuge_UserONG_idUserONG` INT(11) NOT NULL,
  `UserONG_idUserONG` INT(11) NOT NULL,
  `UserPublic_idUserPublic` INT(11) NOT NULL,
  PRIMARY KEY (`idProfil`, `Refuge_idRefuge`, `Refuge_UserONG_idUserONG`, `UserONG_idUserONG`, `UserPublic_idUserPublic`),
  INDEX `fk_Profil_Refuge1_idx` (`Refuge_idRefuge` ASC, `Refuge_UserONG_idUserONG` ASC),
  INDEX `fk_Profil_UserONG1_idx` (`UserONG_idUserONG` ASC),
  INDEX `fk_Profil_UserPublic1_idx` (`UserPublic_idUserPublic` ASC),
  CONSTRAINT `fk_Profil_Refuge1`
    FOREIGN KEY (`Refuge_idRefuge` , `Refuge_UserONG_idUserONG`)
    REFERENCES `nuitdelinfo2014`.`refuge` (`idRefuge` , `UserONG_idUserONG`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Profil_UserONG1`
    FOREIGN KEY (`UserONG_idUserONG`)
    REFERENCES `nuitdelinfo2014`.`userong` (`idUserONG`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Profil_UserPublic1`
    FOREIGN KEY (`UserPublic_idUserPublic`)
    REFERENCES `nuitdelinfo2014`.`userpublic` (`idUserPublic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Cette classe regroupe les informations correspondantes aux profils recherchés.';


-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`recherche`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`recherche` (
  `idRecherche` INT(11) NOT NULL,
  `keywordDesc` VARCHAR(300) NULL DEFAULT NULL,
  `keywordLoc` VARCHAR(300) NULL DEFAULT NULL,
  `UserPublic_idUserPublic` INT(11) NOT NULL,
  PRIMARY KEY (`idRecherche`, `UserPublic_idUserPublic`),
  INDEX `fk_Recherche_UserPublic1_idx` (`UserPublic_idUserPublic` ASC),
  CONSTRAINT `fk_Recherche_UserPublic1`
    FOREIGN KEY (`UserPublic_idUserPublic`)
    REFERENCES `nuitdelinfo2014`.`userpublic` (`idUserPublic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Contient les informations liées à une recherche par un chercheur.';


-- -----------------------------------------------------
-- Table `nuitdelinfo2014`.`rechercheong`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nuitdelinfo2014`.`rechercheong` (
  `idRechercheONG` INT(11) NOT NULL,
  `keywordDesc` VARCHAR(300) NULL DEFAULT NULL,
  `keywordLoc` VARCHAR(300) NULL DEFAULT NULL,
  `UserONG_idUserONG` INT(11) NOT NULL,
  PRIMARY KEY (`idRechercheONG`, `UserONG_idUserONG`),
  INDEX `fk_RechercheONG_UserONG1_idx` (`UserONG_idUserONG` ASC),
  CONSTRAINT `fk_RechercheONG_UserONG1`
    FOREIGN KEY (`UserONG_idUserONG`)
    REFERENCES `nuitdelinfo2014`.`userong` (`idUserONG`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Contient les informations liées à une recherche par une ONG.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
