-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

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
  `CedulaUsuario` DECIMAL(8,0) NOT NULL CHECK (CHAR_LENGTH(CAST('CedulaUsuario' AS CHAR)) = 8),
  `NombreUsuario` VARCHAR(45) NOT NULL,
  `ApellidoUsuario` VARCHAR(45) NOT NULL,
  `ContraseñaUsuario` VARCHAR(255) NOT NULL,
  `FotoUsuario` VARCHAR(45) DEFAULT NULL,
  `NicknameUsuario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`CedulaUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Alumnos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Alumnos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Alumnos` (
  `CedulaAlumno` DECIMAL(8,0) NOT NULL,
  PRIMARY KEY (`CedulaAlumno`),
  CONSTRAINT `CedulaUsuario`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Orientaciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Orientaciones` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Orientaciones` (
  `IdOrientacion` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreOrientacion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`IdOrientacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Asignaturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Asignaturas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Asignaturas` (
  `IdAsignatura` INT(11) NOT NULL AUTO_INCREMENT,
  `AsignaturaNombre` VARCHAR(45) NOT NULL,
  `IdOrientacion` INT(11) NOT NULL,
  PRIMARY KEY (`IdAsignatura`),
  INDEX `OrientacionAsignatura_idx` (`IdOrientacion` ASC),
  CONSTRAINT `OrientacionAsignatura`
    FOREIGN KEY (`IdOrientacion`)
    REFERENCES `mydb`.`Orientaciones` (`IdOrientacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`ChatsDirectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ChatsDirectos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`ChatsDirectos` (
  `UsuarioCedulaUno` DECIMAL(8,0) NOT NULL,
  `UsuarioCedulaDos` DECIMAL(8,0) NOT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Docentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Docentes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Docentes` (
  `CedulaDocente` DECIMAL(8,0) NOT NULL,
  `HorarioDeConsultasDesde` TIME NULL DEFAULT NULL,
  `HorarioDeConsultasHasta` TIME NULL DEFAULT NULL,
  `UltimaFechayHoraConexion` DATETIME NULL DEFAULT NULL,
  `UltimaFechaYHoraDesconexion` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`CedulaDocente`),
  CONSTRAINT `UsuarioCedula`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Consultas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Consultas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Consultas` (
  `IdConsulta` INT(11) NOT NULL AUTO_INCREMENT,
  `CedulaAlumno` DECIMAL(8,0) NOT NULL,
  `CedulaDocente` DECIMAL(8,0) NOT NULL,
  `FechaYHora` DATETIME NULL DEFAULT NULL,
  `Tema` VARCHAR(45) NULL DEFAULT NULL,
  `Estado` ENUM('Realizada', 'Contestada', 'Recibida') NULL DEFAULT NULL,
  PRIMARY KEY (`IdConsulta`, `CedulaAlumno`, `CedulaDocente`),
  INDEX `DocenteConsulta_idx` (`CedulaDocente` ASC),
  INDEX `AlumnoConsulta` (`CedulaAlumno` ASC),
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Salas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Salas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Salas` (
  `IdSala` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`IdSala`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Grupos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Grupos` (
  `IdGrupo` INT(11) NOT NULL AUTO_INCREMENT,
  `Grado` INT(11) NULL DEFAULT NULL,
  `Denominacion` VARCHAR(45) NULL DEFAULT NULL,
  `IdSala` INT(11) NULL DEFAULT NULL,
  `Turno` ENUM('Nocturno', 'Matutino', 'Tarde') NULL DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`),
  INDEX `IdSala_idx` (`IdSala` ASC),
  CONSTRAINT `GrupoSala`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Cursan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Cursan` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Cursan` (
  `IdGrupo` INT(11) NOT NULL,
  `IdAsignatura` INT(11) NOT NULL,
  `CedulaDocente` DECIMAL(8,0) NULL DEFAULT NULL,
  `IdSala` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IdGrupo`, `IdAsignatura`),
  INDEX `AsignaturaCurasn_idx` (`IdAsignatura` ASC),
  INDEX `DocentesCursan_idx` (`CedulaDocente` ASC),
  INDEX `SalaCursan_idx` (`IdSala` ASC),
  CONSTRAINT `AsignaturaCurasn`
    FOREIGN KEY (`IdAsignatura`)
    REFERENCES `mydb`.`Asignaturas` (`IdAsignatura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `DocentesCursan`
    FOREIGN KEY (`CedulaDocente`)
    REFERENCES `mydb`.`Docentes` (`CedulaDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `GruposCursan`
    FOREIGN KEY (`IdGrupo`)
    REFERENCES `mydb`.`Grupos` (`IdGrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `SalaCursan`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Inscritos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Inscritos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Inscritos` (
  `CedulaAlumno` DECIMAL(8,0) NOT NULL,
  `IdGrupo` INT(11) NOT NULL,
  `Autorizado` TINYINT(4) NULL DEFAULT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Mensajes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Mensajes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Mensajes` (
  `IdMensaje` INT(11) NOT NULL AUTO_INCREMENT,
  `FechaYHoraEmision` DATETIME NULL DEFAULT NULL,
  `Contenido` TEXT NULL DEFAULT NULL,
  `CedulaUsuario` DECIMAL(8,0) NULL DEFAULT NULL,
  PRIMARY KEY (`IdMensaje`),
  INDEX `UsuarioCedula_idx` (`CedulaUsuario` ASC),
  CONSTRAINT `MensajesUsuarios`
    FOREIGN KEY (`CedulaUsuario`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`MensajesChatDirecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`MensajesChatDirecto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`MensajesChatDirecto` (
  `UsuarioCedulaUno` DECIMAL(8,0) NOT NULL,
  `UsuarioCedulaDos` DECIMAL(8,0) NOT NULL,
  `IdMensaje` INT(11) NOT NULL,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`MensajesSalas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`MensajesSalas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`MensajesSalas` (
  `IdSala` INT(11) NOT NULL,
  `IdMensaje` INT(11) NOT NULL,
  PRIMARY KEY (`IdSala`, `IdMensaje`),
  INDEX `IdMensaje_idx` (`IdMensaje` ASC),
  CONSTRAINT `IdMensaje`
    FOREIGN KEY (`IdMensaje`)
    REFERENCES `mydb`.`Mensajes` (`IdMensaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `IdSala`
    FOREIGN KEY (`IdSala`)
    REFERENCES `mydb`.`Salas` (`IdSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Respuestas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Respuestas` (
  `IdRespuesta` INT(11) NOT NULL AUTO_INCREMENT,
  `CedulaUsuario` DECIMAL(8,0) NULL DEFAULT NULL,
  `Contenido` TEXT NULL DEFAULT NULL,
  `FechaYHoraEmision` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`IdRespuesta`),
  INDEX `UsuarioRespuesta_idx` (`CedulaUsuario` ASC),
  CONSTRAINT `UsuarioRespuesta`
    FOREIGN KEY (`CedulaUsuario`)
    REFERENCES `mydb`.`Usuarios` (`CedulaUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`RespuestasConsulta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`RespuestasConsulta` ;

CREATE TABLE IF NOT EXISTS `mydb`.`RespuestasConsulta` (
  `CedulaAlumno` DECIMAL(8,0) NOT NULL,
  `CedulaDocente` DECIMAL(8,0) NOT NULL,
  `IdConsulta` INT(11) NOT NULL,
  `IdRespuesta` INT(11) NOT NULL,
  PRIMARY KEY (`CedulaAlumno`, `CedulaDocente`, `IdConsulta`, `IdRespuesta`),
  INDEX `RespuestasRespuestas_idx` (`IdRespuesta` ASC),
  INDEX `ConsultasRespuestas2_idx` (`CedulaDocente` ASC),
  INDEX `ConsultasRespuestas3_idx` (`IdConsulta` ASC),
  CONSTRAINT `ConsultasRespuestas1`
    FOREIGN KEY (`CedulaAlumno`)
    REFERENCES `mydb`.`Consultas` (`CedulaAlumno`)
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
    ON UPDATE NO ACTION,
  CONSTRAINT `RespuestasRespuestas`
    FOREIGN KEY (`IdRespuesta`)
    REFERENCES `mydb`.`Respuestas` (`IdRespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `mydb` ;

-- -----------------------------------------------------
-- procedure AñadirRespuesta
-- -----------------------------------------------------

USE `mydb`;
DROP procedure IF EXISTS `mydb`.`AñadirRespuesta`;

DELIMITER $$
USE `mydb`$$
CREATE DEFINER=`root`@`%` PROCEDURE `AñadirRespuesta`(ciuser int ,conten varchar(225),FH datetime ,cia int , cid int,idc int)
BEGIN
insert into Respuestas(CedulaUsuario,Contenido,FechaYHoraEmision) values (ciuser,conten,FH);
insert into RespuestasConsulta(CedulaAlumno,CedulaDocente,IdRespuesta,IdConsulta) values (cia,cid,last_insert_id(),idc);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure CrearConsulta
-- -----------------------------------------------------

USE `mydb`;
DROP procedure IF EXISTS `mydb`.`CrearConsulta`;

DELIMITER $$
USE `mydb`$$
CREATE DEFINER=`root`@`%` PROCEDURE `CrearConsulta`(cedulaU int, cedulaD int,FH datetime,Tem VARCHAR(45),Est VARCHAR(45),conten text)
BEGIN
INSERT INTO Consultas (CedulaAlumno,CedulaDocente,FechaYHora,Tema,Estado) values (cedulaU,cedulaD,FH,Tem,Est);
SET @idconsulta = LAST_INSERT_ID();
INSERT INTO Respuestas (CedulaUsuario,Contenido,FechaYHoraEmision) values (cedulaU,conten,FH);
INSERT INTO RespuestasConsulta (CedulaAlumno,CedulaDocente,IdConsulta,IdRespuesta) values(cedulaU,cedulaD,@idconsulta,last_insert_id() );
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
