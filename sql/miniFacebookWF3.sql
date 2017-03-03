SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema WF3MiniFaceBook
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WF3MiniFaceBook
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WF3MiniFaceBook` DEFAULT CHARACTER SET utf8 ;
USE `WF3MiniFaceBook` ;

-- -----------------------------------------------------
-- Table `WF3MiniFaceBook`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WF3MiniFaceBook`.`Users` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `UserLastName` VARCHAR(50) NOT NULL,
  `UserFirstName` VARCHAR(50) NOT NULL,
  `UserBirtday` DATE NOT NULL,
  `UserEmail` VARCHAR(50) NOT NULL,
  `UserPassword` VARCHAR(255) NOT NULL,
  `UserGender` VARCHAR(10) NULL,
  `UserAvatar` VARCHAR(45) NULL,
  `UserDescription` VARCHAR(45) NULL,
  `UserSubscribeDate` DATE NOT NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WF3MiniFaceBook`.`Statut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WF3MiniFaceBook`.`Statut` (
  `idStatut` INT NOT NULL AUTO_INCREMENT,
  `StatutTitle` VARCHAR(50) NOT NULL,
  `StatutPictureUrl` VARCHAR(255) NULL,
  `StatutVideoURL` VARCHAR(255) NULL,
  `StatutText` LONGTEXT NULL,
  `StatutDatePublication` DATE NOT NULL,
  `Users_idUsers` INT NOT NULL,
  PRIMARY KEY (`idStatut`, `Users_idUsers`),
  INDEX `fk_Statut_Users_idx` (`Users_idUsers` ASC),
  CONSTRAINT `fk_Statut_Users`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `WF3MiniFaceBook`.`Users` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WF3MiniFaceBook`.`LikeStatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WF3MiniFaceBook`.`LikeStatus` (
  `idLikeStatus` INT NOT NULL AUTO_INCREMENT,
  `Users_idUsers` INT NOT NULL,
  `Statut_idStatut` INT NOT NULL,
  PRIMARY KEY (`idLikeStatus`, `Users_idUsers`, `Statut_idStatut`),
  INDEX `fk_Like_Users1_idx` (`Users_idUsers` ASC),
  INDEX `fk_Like_Statut1_idx` (`Statut_idStatut` ASC),
  CONSTRAINT `fk_Like_Users1`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `WF3MiniFaceBook`.`Users` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Like_Statut1`
    FOREIGN KEY (`Statut_idStatut`)
    REFERENCES `WF3MiniFaceBook`.`Statut` (`idStatut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
