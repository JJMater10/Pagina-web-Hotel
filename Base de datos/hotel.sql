-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema hotel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hotel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8 ;
USE `hotel` ;

-- -----------------------------------------------------
-- Table `hotel`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nom_client` VARCHAR(45) NOT NULL,
  `epelli_client` VARCHAR(45) NOT NULL,
  `edad_client` INT NOT NULL,
  `iden_client` INT NOT NULL,
  `tel_client` INT NOT NULL,
  `email_client` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`medio_pag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`medio_pag` (
  `idmedio_pag` INT NOT NULL AUTO_INCREMENT,
  `tipo_pag` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmedio_pag`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`emple_recep`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`emple_recep` (
  `idemple_recep` INT NOT NULL AUTO_INCREMENT,
  `nom_cecep` VARCHAR(45) NOT NULL,
  `edad_recep` INT NOT NULL,
  `tel_recep` INT NOT NULL,
  `ident_recep` INT NOT NULL,
  `email_recep` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idemple_recep`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`habitacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`habitacion` (
  `idhabitacion` INT NOT NULL AUTO_INCREMENT,
  `nom_hab` VARCHAR(45) NOT NULL,
  `precio_hab` INT NOT NULL,
  PRIMARY KEY (`idhabitacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`hospedaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`hospedaje` (
  `idhospedaje` INT NOT NULL AUTO_INCREMENT,
  `fecha_entra` DATE NOT NULL,
  `fecha_sal` DATE NOT NULL,
  `habitacion_idhabitacion` INT NOT NULL,
  `medio_pag_idmedio_pag` INT NOT NULL,
  PRIMARY KEY (`idhospedaje`, `habitacion_idhabitacion`, `medio_pag_idmedio_pag`),
  INDEX `fk_hospedaje_habitacion_idx` (`habitacion_idhabitacion` ASC) VISIBLE,
  INDEX `fk_hospedaje_medio_pag1_idx` (`medio_pag_idmedio_pag` ASC) VISIBLE,
  CONSTRAINT `fk_hospedaje_habitacion`
    FOREIGN KEY (`habitacion_idhabitacion`)
    REFERENCES `hotel`.`habitacion` (`idhabitacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hospedaje_medio_pag1`
    FOREIGN KEY (`medio_pag_idmedio_pag`)
    REFERENCES `hotel`.`medio_pag` (`idmedio_pag`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`cuenta_recep`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`cuenta_recep` (
  `idcuenta_recep` INT NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `emple_recep_idemple_recep` INT NOT NULL,
  PRIMARY KEY (`idcuenta_recep`, `emple_recep_idemple_recep`),
  INDEX `fk_cuenta_recep_emple_recep1_idx` (`emple_recep_idemple_recep` ASC) VISIBLE,
  CONSTRAINT `fk_cuenta_recep_emple_recep1`
    FOREIGN KEY (`emple_recep_idemple_recep`)
    REFERENCES `hotel`.`emple_recep` (`idemple_recep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel`.`hospedaje_has_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel`.`hospedaje_has_cliente` (
  `hospedaje_idhospedaje` INT NOT NULL,
  `hospedaje_habitacion_idhabitacion` INT NOT NULL,
  `hospedaje_medio_pag_idmedio_pag` INT NOT NULL,
  `cliente_idcliente` INT NOT NULL,
  PRIMARY KEY (`hospedaje_idhospedaje`, `hospedaje_habitacion_idhabitacion`, `hospedaje_medio_pag_idmedio_pag`, `cliente_idcliente`),
  INDEX `fk_hospedaje_has_cliente_cliente1_idx` (`cliente_idcliente` ASC) VISIBLE,
  INDEX `fk_hospedaje_has_cliente_hospedaje1_idx` (`hospedaje_idhospedaje` ASC, `hospedaje_habitacion_idhabitacion` ASC, `hospedaje_medio_pag_idmedio_pag` ASC) VISIBLE,
  CONSTRAINT `fk_hospedaje_has_cliente_hospedaje1`
    FOREIGN KEY (`hospedaje_idhospedaje` , `hospedaje_habitacion_idhabitacion` , `hospedaje_medio_pag_idmedio_pag`)
    REFERENCES `hotel`.`hospedaje` (`idhospedaje` , `habitacion_idhabitacion` , `medio_pag_idmedio_pag`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hospedaje_has_cliente_cliente1`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `hotel`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
