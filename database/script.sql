-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ICS199Group08_prod
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ICS199Group08_prod
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ICS199Group08_prod` DEFAULT CHARACTER SET latin1 ;
USE `ICS199Group08_prod` ;

-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`GENRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`GENRE` (
  `genreID` INT(11) NOT NULL AUTO_INCREMENT,
  `genre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`genreID`),
  UNIQUE INDEX `genre` (`genre` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`USER_ACCOUNT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`USER_ACCOUNT` (
  `USEREMAIL` VARCHAR(100) NOT NULL,
  `firstName` VARCHAR(25) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `DOB` DATE NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `address` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `province` VARCHAR(45) NULL DEFAULT NULL,
  `postal_code` VARCHAR(45) NULL DEFAULT NULL,
  `phoneNumber` VARCHAR(25) NULL DEFAULT NULL,
  `admin` VARCHAR(1) NULL DEFAULT NULL,
  `privCheck` VARCHAR(1) NULL DEFAULT NULL,
  `last_login` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`USEREMAIL`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`INVOICE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`INVOICE` (
  `invoiceID` INT(11) NOT NULL AUTO_INCREMENT,
  `purchaseDate` DATETIME NOT NULL,
  `orderStatus` VARCHAR(45) NULL DEFAULT NULL,
  `USER_ACCOUNT_USEREMAIL` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`invoiceID`),
  INDEX `fk_INVOICE_USER_ACCOUNT1_idx` (`USER_ACCOUNT_USEREMAIL` ASC),
  CONSTRAINT `fk_INVOICE_USER_ACCOUNT1`
    FOREIGN KEY (`USER_ACCOUNT_USEREMAIL`)
    REFERENCES `ICS199Group08_prod`.`USER_ACCOUNT` (`USEREMAIL`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 48
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`RECORD`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`RECORD` (
  `itemNumber` INT(11) NOT NULL AUTO_INCREMENT,
  `artist` VARCHAR(45) NOT NULL,
  `albumTitle` VARCHAR(45) NOT NULL,
  `PRICE` FLOAT NULL DEFAULT NULL,
  `RELEASEDATE` DATE NULL DEFAULT NULL,
  `quality` VARCHAR(25) NOT NULL,
  `albumArtwork` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(300) NULL DEFAULT NULL,
  `spotifyLink` VARCHAR(512) NULL DEFAULT NULL,
  PRIMARY KEY (`itemNumber`))
ENGINE = InnoDB
AUTO_INCREMENT = 111
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`INVOICE_PRODUCT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`INVOICE_PRODUCT` (
  `RECORD_itemNumber` INT(11) NOT NULL,
  `INVOICE_invoiceID` INT(11) NOT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `quantity` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`RECORD_itemNumber`, `INVOICE_invoiceID`),
  INDEX `fk_INVOICE_PRODUCT_INVOICE1_idx` (`INVOICE_invoiceID` ASC),
  CONSTRAINT `fk_INVOICE_PRODUCT_INVOICE1`
    FOREIGN KEY (`INVOICE_invoiceID`)
    REFERENCES `ICS199Group08_prod`.`INVOICE` (`invoiceID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INVOICE_PRODUCT_RECORD1`
    FOREIGN KEY (`RECORD_itemNumber`)
    REFERENCES `ICS199Group08_prod`.`RECORD` (`itemNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`RECORD_CATEGORY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`RECORD_CATEGORY` (
  `RECORD_itemNumber` INT(11) NOT NULL,
  `GENRE_genreID` INT(11) NOT NULL,
  PRIMARY KEY (`RECORD_itemNumber`, `GENRE_genreID`),
  INDEX `fk_RECORD_CATEGORY_RECORD1_idx` (`RECORD_itemNumber` ASC),
  INDEX `fk_RECORD_CATEGORY_GENRE1_idx` (`GENRE_genreID` ASC),
  CONSTRAINT `RECORD_CATEGORY_GENRE1`
    FOREIGN KEY (`GENRE_genreID`)
    REFERENCES `ICS199Group08_prod`.`GENRE` (`genreID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `RECORD_CATEGORY_RECORD1`
    FOREIGN KEY (`RECORD_itemNumber`)
    REFERENCES `ICS199Group08_prod`.`RECORD` (`itemNumber`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`SHOPPING_CART`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`SHOPPING_CART` (
  `quantityOrdered` INT(25) NOT NULL,
  `RECORD_itemNumber` INT(11) NOT NULL,
  `USER_ACCOUNT_USEREMAIL` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`RECORD_itemNumber`, `USER_ACCOUNT_USEREMAIL`),
  INDEX `fk_SHOPPING_CART_RECORD1_idx` (`RECORD_itemNumber` ASC),
  INDEX `fk_SHOPPING_CART_USER_ACCOUNT1_idx` (`USER_ACCOUNT_USEREMAIL` ASC),
  CONSTRAINT `fk_SHOPPING_CART_RECORD1`
    FOREIGN KEY (`RECORD_itemNumber`)
    REFERENCES `ICS199Group08_prod`.`RECORD` (`itemNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SHOPPING_CART_USER_ACCOUNT1`
    FOREIGN KEY (`USER_ACCOUNT_USEREMAIL`)
    REFERENCES `ICS199Group08_prod`.`USER_ACCOUNT` (`USEREMAIL`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `ICS199Group08_prod`.`backupTable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ICS199Group08_prod`.`backupTable` (
  `genre` VARCHAR(45) NULL DEFAULT NULL,
  `genreID` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`genreID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
