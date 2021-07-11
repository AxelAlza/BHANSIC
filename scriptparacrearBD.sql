-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Usuarios` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Usuarios` (
  `CedulaUsuario` DECIMAL(8) NOT NULL,
  `NombreUsuario` VARCHAR(45) NOT NULL,
  `ApellidoUsuario` VARCHAR(45) NOT NULL,
  `ContraseñaUsuario` VARCHAR(255) NOT NULL,
  `FotoUsuario` VARCHAR(45) NULL,
  `AvatarUsuario` VARCHAR(45) NULL,
  PRIMARY KEY (`CedulaUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Docentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Docentes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Docentes` (
  `CedulaDocente` DECIMAL(8) NOT NULL,
  `HorarioDeConsultasDesde` INT NULL,
  `HorarioDeConsultasHasta` INT NULL,
  `UltimaFechayHoraConexion` DATETIME NULL,
  `UltimaFechaYHoraDesconexion` DATETIME NULL,
  PRIMARY KEY (`CedulaDocente`),
  CONSTRAINT `UsuarioCedula`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Alumnos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Alumnos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Alumnos` (
  `CedulaAlumno` DECIMAL(8) NOT NULL,
  PRIMARY KEY (`CedulaAlumno`),
  CONSTRAINT `CedulaUsuario`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Mensajes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Mensajes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Mensajes` (
  `IdMensaje` INT NOT NULL AUTO_INCREMENT,
  `FechaYHoraEmision` DATETIME NULL,
  `Contenido` TEXT NULL,
  `CedulaUsuario` DECIMAL(8) NULL,
  PRIMARY KEY (`IdMensaje`),
  INDEX `UsuarioCedula_idx` (`CedulaUsuario` ASC),
  CONSTRAINT `MensajesUsuarios`
    FOREIGN KEY (`CedulaUsuario`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ChatsDirectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ChatsDirectos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ChatsDirectos` (
  `UsuarioCedulaUno` DECIMAL(8) NOT NULL,
  `UsuarioCedulaDos` DECIMAL(8) NOT NULL,
  PRIMARY KEY (`UsuarioCedulaUno`, `UsuarioCedulaDos`),
  INDEX `UsuarioChatDirecto2_idx` (`UsuarioCedulaDos` ASC),
  CONSTRAINT `UsuarioChatDirecto1`
    FOREIGN KEY (`UsuarioCedulaUno`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UsuarioChatDirecto2`
    FOREIGN KEY (`UsuarioCedulaDos`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MensajesChatDirecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`MensajesChatDirecto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`MensajesChatDirecto` (
  `UsuarioCedulaUno` DECIMAL(8) NOT NULL,
  `UsuarioCedulaDos` DECIMAL(8) NOT NULL,
  `IdMensaje` INT NOT NULL,
  PRIMARY KEY (`UsuarioCedulaUno`, `UsuarioCedulaDos`),
  INDEX `IdMensaje_idx` (`IdMensaje` ASC),
  CONSTRAINT `ChatDirectosMensajes`
    FOREIGN KEY (`UsuarioCedulaUno` , `UsuarioCedulaDos`)
    REFERENCES `mydb`.`ChatsDirectos` (`UsuarioCedulaUno` , `UsuarioCedulaDos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `MensajesChatDirecto`
    FOREIGN KEY (`IdMensaje`)
    REFERENCES `mydb`.`Mensajes` (`IdMensaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Salas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Salas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Salas` (
  `IdSala` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`IdSala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MensajesSalas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`MensajesSalas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`MensajesSalas` (
  `IdSala` INT NOT NULL,
  `IdMensaje` INT NOT NULL,
  PRIMARY KEY (`IdSala`, `IdMensaje`),
  INDEX `IdMensaje_idx` (`IdMensaje` ASC),
  CONSTRAINT `IdSala`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `IdMensaje`
    FOREIGN KEY (`IdMensaje`)
    REFERENCES `mydb`.`Mensajes` (`IdMensaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Grupos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Grupos` (
  `IdGrupo` INT NOT NULL AUTO_INCREMENT,
  `Grado` INT NULL,
  `Denominacion` VARCHAR(45) NULL,
  `IdSala` INT NULL,
  `Turno` ENUM("Nocturno", "Matutino", "Tarde") NULL,
  PRIMARY KEY (`IdGrupo`),
  INDEX `IdSala_idx` (`IdSala` ASC),
  CONSTRAINT `GrupoSala`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Inscritos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Inscritos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Inscritos` (
  `CedulaAlumno` DECIMAL(8) NOT NULL,
  `IdGrupo` INT NOT NULL,
  `Autorizado` TINYINT NULL,
  PRIMARY KEY (`CedulaAlumno`, `IdGrupo`),
  INDEX `GrupoInscrito_idx` (`IdGrupo` ASC),
  CONSTRAINT `AlumnoInscrito`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Alumnos` (`CedulaAlumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `GrupoInscrito`
    FOREIGN KEY (`IdGrupo`)
    REFERENCES `mydb`.`Grupos` (`IdGrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Orientaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Orientaciones` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Orientaciones` (
  `IdOrientacion` INT NOT NULL AUTO_INCREMENT,
  `NombreOrientacion` VARCHAR(45) NULL,
  PRIMARY KEY (`IdOrientacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Asignaturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Asignaturas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Asignaturas` (
  `IdAsignatura` INT NOT NULL AUTO_INCREMENT,
  `AsignaturaNombre` VARCHAR(45) NOT NULL,
  `IdOrientacion` INT NOT NULL,
  PRIMARY KEY (`IdAsignatura`),
  INDEX `OrientacionAsignatura_idx` (`IdOrientacion` ASC),
  CONSTRAINT `OrientacionAsignatura`
    FOREIGN KEY (`IdOrientacion`)
    REFERENCES `mydb`.`Orientaciones` (`IdOrientacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cursan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Cursan` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Cursan` (
  `IdGrupo` INT NOT NULL,
  `IdAsignatura` INT NOT NULL,
  `CedulaDocente` DECIMAL(8) NULL,
  `IdSala` INT NULL,
  PRIMARY KEY (`IdGrupo`, `IdAsignatura`),
  INDEX `AsignaturaCurasn_idx` (`IdAsignatura` ASC),
  INDEX `DocentesCursan_idx` (`CedulaDocente` ASC),
  INDEX `SalaCursan_idx` (`IdSala` ASC),
  CONSTRAINT `AsignaturaCurasn`
    FOREIGN KEY (`IdAsignatura`)
    REFERENCES `mydb`.`Asignaturas` (`IdAsignatura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `GruposCursan`
    FOREIGN KEY (`IdGrupo`)
    REFERENCES `mydb`.`Grupos` (`IdGrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `DocentesCursan`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Docentes` (`CedulaDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `SalaCursan`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Consultas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Consultas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Consultas` (
  `IdConsulta` INT NOT NULL AUTO_INCREMENT,
  `CedulaAlumno` DECIMAL(8) NOT NULL,
  `CedulaDocente` DECIMAL(8) NOT NULL,
  `FechaYHora` DATETIME NULL,
  `Tema` VARCHAR(45) NULL,
  `Estado` VARCHAR(45) NULL,
  PRIMARY KEY (`IdConsulta`, `CedulaAlumno`, `CedulaDocente`),
  INDEX `DocenteConsulta_idx` (`CedulaDocente` ASC),
  CONSTRAINT `AlumnoConsulta`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Alumnos` (`CedulaAlumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `DocenteConsulta`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Docentes` (`CedulaDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Respuestas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Respuestas` (
  `IdRespuesta` INT NOT NULL AUTO_INCREMENT,
  `CedulaUsuario` DECIMAL(8) NULL,
  `Contenido` TEXT NULL,
  `FechaYHoraEmision` DATETIME NULL,
  PRIMARY KEY (`IdRespuesta`),
  INDEX `UsuarioRespuesta_idx` (`CedulaUsuario` ASC),
  CONSTRAINT `UsuarioRespuesta`
    FOREIGN KEY (`CedulaUsuario`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`RespuestasConsulta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`RespuestasConsulta` ;

CREATE TABLE IF NOT EXISTS `mydb`.`RespuestasConsulta` (
  `CedulaAlumno` DECIMAL(8) NOT NULL,
  `CedulaDocente` DECIMAL(8) NOT NULL,
  `IdConsulta` INT NOT NULL,
  `IdRespuesta` INT NOT NULL,
  PRIMARY KEY (`CedulaAlumno`, `CedulaDocente`, `IdConsulta`, `IdRespuesta`),
  INDEX `RespuestasRespuestas_idx` (`IdRespuesta` ASC),
  INDEX `ConsultasRespuestas2_idx` (`CedulaDocente` ASC),
  INDEX `ConsultasRespuestas3_idx` (`IdConsulta` ASC),
  CONSTRAINT `ConsultasRespuestas1`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Consultas` (`CedulaAlumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `RespuestasRespuestas`
    FOREIGN KEY (`IdRespuesta`)
    REFERENCES `mydb`.`Respuestas` (`IdRespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ConsultasRespuestas2`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Consultas` (`CedulaDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ConsultasRespuestas3`
    FOREIGN KEY (`IdConsulta`)
    REFERENCES `mydb`.`Consultas` (`IdConsulta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
