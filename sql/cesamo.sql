-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-08-2015 a las 04:51:51
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cesamo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `accessLog`(IN `EmployedCode` VARCHAR(4), IN `IPADdress` VARCHAR(20), IN `Reason` VARCHAR(50))
    NO SQL
INSERT INTO `accesos_de_usuario`(
	`employedCode`, `dateOfAdmission`, 
	`IPAddress`, `reason`
) 
VALUES 
	(
		EmployedCode, CURRENT_TIME, IPADdress, 
		Reason
	)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Agenda`(IN `nombre` VARCHAR(30))
    COMMENT 'consulta la informacion de un empleado'
SELECT empleados.P_Nombre,empleados.S_Nombre,empleados.P_Apellido,empleados.S_Apellido,empleados.NumIdentidad,empleados.Telefono,empleados.CorreoElectronico,empleados.FechaNacimiento,empleados.Sexo,empleados.Direccion 

FROM `empleados` 

WHERE P_Nombre =nombre or S_Nombre = nombre or P_Apellido = nombre Or S_Apellido = nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarExpediente`(IN `CodExpediente` VARCHAR(13), IN `P_Nombre` VARCHAR(30), IN `S_Nombre` VARCHAR(30), IN `P_Apellido` VARCHAR(30), IN `S_Apellido` VARCHAR(30), IN `FechaNacimiento` DATE, IN `Sexo` VARCHAR(1), IN `LugarNacimiento` VARCHAR(50))
    COMMENT 'Se agregar una nuevo expediente'
INSERT INTO `cesamo`.`expedientes`
(expedientes.CodExpediente,expedientes.P_Nombre,expedientes.S_Nombre,expedientes.P_Apellido,expedientes.S_Apellido,expedientes.FechaNacimiento,expedientes.Sexo,expedientes.LugarNacimiento)VALUES
(CodExpediente,P_Nombre,S_Nombre,P_Apellido,S_Apellido,FechaNacimiento,Sexo,LugarNacimiento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarPreclinica`(IN `Fecha` DATE, IN `Peso` FLOAT(20), IN `Presion` VARCHAR(20), IN `Temperatura` FLOAT(20), IN `Altura` FLOAT(20), IN `CodEmpleado` INT(11), IN `CodExpediente` VARCHAR(13))
    COMMENT 'crea una nueva preclinica'
INSERT INTO `preclinica`(`CodPreclinica`, `Fecha`, `Peso`, `Presion`, `Temperatura`, `Altura`, `CodEmpleado`, `CodExpediente`) VALUES (null,Fecha,Peso,Presion,Temperatura,Altura,CodEmpleado,CodExpediente)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allCharges`()
    NO SQL
SELECT * FROM cargos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allRegisters`()
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT 
	COUNT(accesos_de_usuario.employedCode) AS totalAccess,
    accesos_de_usuario.employedCode,
	empleados.P_Nombre, 
	empleados.P_Apellido
FROM 
	accesos_de_usuario 
	INNER JOIN empleados ON accesos_de_usuario.employedCode = empleados.CodEmpleado
    GROUP BY accesos_de_usuario.employedCode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `almacenarNuevoMedicamento`(IN `nombreMedicamento` VARCHAR(30), IN `nombreFabricante` VARCHAR(30), IN `descripcion` TEXT, IN `unidadMedida` VARCHAR(10))
    NO SQL
BEGIN
	insert into inventario(CodMedicamento, NombreMedicamento, NombreFabricante, Descripcion, Existencia, UnidadMedida) values (null,  nombreMedicamento, nombreFabricante, descripcion, 0, unidadMedida);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelarCita`(IN `idCita` INT(11))
    NO SQL
    SQL SECURITY INVOKER
    COMMENT 'Elimina la Cita que tenga el código que se recibe'
DELETE FROM citas WHERE citas.CodCita = idCita$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CancelarCitaCodMedico`(IN `idCita` DATE, IN `codMedico` INT(11))
    COMMENT 'borra la cita con el doctor'
DELETE FROM citas WHERE citas.CodCita = idCita AND citas.CodMedico = codMedico$$$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarConsulta`(IN `cod` INT(11))
    NO SQL
    DETERMINISTIC
SELECT `MotivoConsulta`,`Descripcion_examen_fisico`,`Descripcion_diagnostico`,`Descripcion_tratamiento` FROM `consultas` WHERE `CodConsulta` = cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarExpediente`(IN `id` VARCHAR(13) CHARSET utf8)
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'Obtiene el Expediente con el Respectivo Codigo'
SELECT * FROM expedientes WHERE expedientes.CodExpediente = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CitaMedico`(IN `fe` DATE, IN `codigo` INT)
    COMMENT 'se consulta la cita de acuerdo al medico'
SELECT `CodCita`, `Fecha`, `P_Nombre_Paciente`, `S_Nombre_Paciente`, `P_Apellido_Paciente`, `S_Apellido_Paciente`, `Telefono`, `CodMedico`, `Hora` FROM `citas` WHERE `citas`.`Fecha` =fe and `citas`.`CodMedico` = codigo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaMedico`()
    COMMENT 'consulta el nombre del doctor o medico'
SELECT `CodMedico`, `P_Nombre`, `S_Nombre`, `P_Apellido`, `S_Apellido` FROM `medicos`
inner join `empleados` on `medicos`.`CodEmpleado` =`empleados`.`CodEmpleado`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearConsulta`(IN `motivo` TEXT CHARSET utf8, IN `eFisico` TEXT CHARSET utf8, IN `diagnostico` TEXT CHARSET utf8, IN `tratamiento` TEXT CHARSET utf8, IN `codMedico` INT(11), IN `expediente` VARCHAR(13))
    COMMENT 'Guarda una consulta medica en la base de datos'
INSERT INTO `cesamo`.`consultas` (`CodConsulta`, `codExpediente`, `Fecha`, `MotivoConsulta`, `Descripcion_examen_fisico`, `Descripcion_diagnostico`, `Descripcion_tratamiento`, `CodMedico`) VALUES (NULL, expediente, CURRENT_TIMESTAMP, motivo, eFisico, diagnostico, tratamiento, codMedico)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crearReceta`(IN `codConsulta` INT(11))
    COMMENT 'Inserta una receta medica'
INSERT INTO `cesamo`.`receta_medica` (`CodReceta`, `codConsulta`) VALUES (NULL,codConsulta)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dateCitas`(IN `dates` DATE, IN `codMed` VARCHAR(4))
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure return all information of table citas'
SELECT * FROM `citas` WHERE citas.CodMedico = codMed AND citas.Fecha = dates$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employeesWithoutUser`()
    NO SQL
SELECT 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.P_Apellido
	) AS name,
    empleados.CodEmpleado AS codeE
    FROM
    empleados
    WHERE empleados.CodEmpleado NOT IN
    (SELECT usuarios.codEmpleado
     FROM usuarios
     )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Existencias`(IN `codmedicamento` INT)
    NO SQL
    SQL SECURITY INVOKER
BEGIN
	SELECT inventario.codMedicamento, inventario.Existencia from inventario where inventario.codMedicamento = codmedicamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `informePreclinica`(IN `codExpe` VARCHAR(13))
    NO SQL
SELECT `CodPreclinica`, `Fecha`,`Peso`,`Altura`,`Presion`,`Temperatura` FROM `preclinica` WHERE `CodExpediente`= codExpe ORDER BY Fecha DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEntradaMedicamentoInventario`(IN `codMedicamento` INT, IN `cantidad` INT, IN `fechaVencimiento` DATE)
    NO SQL
BEGIN
    INSERT INTO entrada_medicamentos_inventario
    (codEntrada, codmedicamento, cantidad, fechaVencimiento) 
    values((SELECT codentrada from entrada_medicamentos 
            order by codentrada desc limit 1), 
           codMedicamento, cantidad, fechaVencimiento);
           
    UPDATE inventario SET existencia = existencia + 
    	cantidad 
    WHERE inventario.codmedicamento = codMedicamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSalidaMedicamentoReceta`(IN `codMedicamento` INT, IN `cantidad` INT)
    NO SQL
BEGIN 
    INSERT INTO salidas_medicamentos_inventario
    (codsalida, codmedicamento, cantidad, motivosalida) 
    values((SELECT codsalida from salidas_medicamentos 
            order by codsalida desc limit 1), 
           codMedicamento, cantidad, 
           'Receta Medica');
           
    UPDATE inventario SET existencia = existencia - 
    	cantidad 
    WHERE inventario.codmedicamento = codMedicamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser`(IN `users` VARCHAR(30), IN `pass` VARCHAR(256), IN `emplo` VARCHAR(4))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'this procedure insert into usuarios a new user'
INSERT INTO usuarios(usuarios.userName, usuarios.password, usuarios.creationdate, usuarios.datemodified, usuarios.status, usuarios.codEmpleado, usuarios.log) VALUES
(users, pass, now(), now(), 1, emplo, 0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `medicamento_receta`(IN `codMedicamento` INT, IN `codReceta` INT, IN `cantidad` INT, IN `tratamiento` TEXT)
    READS SQL DATA
INSERT INTO `cesamo`.`inventario_receta_medica` (`CodMedicamento`, `CodReceta`, `cantidad`, `Tratamiento`) VALUES (codMedicamento, codReceta,cantidad,tratamiento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostRelevantUsers`()
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'this procedure return 4 users relevants'
SELECT 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.P_Apellido
	) AS name, 
	empleados.CodEmpleado as codeE, 
	(
		SELECT 
			cargos.nombreCargo 
		FROM 
			cargos 
		WHERE 
			cargos.cargoID = empleados.Cargo
	) AS office, 
	(
		SELECT 
			usuarios.log 
		FROM 
			usuarios 
		WHERE 
			usuarios.codEmpleado = codeE
	) AS log, 
	(
		SELECT 
			COUNT(*) 
		FROM 
			accesos_de_usuario 
		WHERE 
			accesos_de_usuario.employedCode = empleados.CodEmpleado
	) as total 
FROM 
	empleados 
WHERE 
	empleados.CodEmpleado = (
		SELECT 
			usuarios.codEmpleado 
		FROM 
			usuarios 
		WHERE 
			usuarios.codEmpleado = empleados.CodEmpleado
	) 
ORDER BY 
	total DESC 
LIMIT 
	5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevaCita`(IN `fecha` DATE, IN `hora` TIME, IN `p_nombre` VARCHAR(30) CHARSET utf8, IN `s_nombre` VARCHAR(30) CHARSET utf8, IN `p_apellido` VARCHAR(30) CHARSET utf8, IN `s_apellido` VARCHAR(30) CHARSET utf8, IN `telefono` INT(8), IN `codMedico` INT(11))
    COMMENT 'Inserta una nueva cita'
INSERT INTO citas (citas.Fecha,citas.Hora,citas.P_Nombre_Paciente,citas.S_Nombre_Paciente,citas.P_Apellido_Paciente,citas.S_Apellido_Paciente,citas.Telefono,citas.CodMedico) VALUES (fecha,hora,p_nombre,s_nombre,p_apellido,s_apellido,telefono,codMedico)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevaEntrada`()
    NO SQL
BEGIN
		INSERT INTO entrada_medicamentos(codEntrada, fecha) values(null, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerCodigoMedico`(IN `codEmp` VARCHAR(4))
    NO SQL
SELECT medicos.CodMedico FROM `medicos` WHERE medicos.CodEmpleado = codEmp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionarConsultas`(IN `codExpe` VARCHAR(13))
    NO SQL
    DETERMINISTIC
SELECT * FROM `consultas` WHERE `codExpediente` = codExpe ORDER BY `Fecha` DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionarMedicamentos`()
    SQL SECURITY INVOKER
    COMMENT 'Obtiene todos los medicamentos '
SELECT inventario.CodMedicamento, inventario.NombreMedicamento FROM inventario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionarUltimaConsulta`(IN `codExpediente` VARCHAR(13) CHARSET utf8)
    NO SQL
    COMMENT 'Codigo de consulta, de la ultima consulta de un expediente'
SELECT `CodConsulta` FROM `consultas` WHERE `codExpediente` = codExpediente ORDER BY (Fecha) DESC LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllEmployed`()
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure return all employed in the system'
SELECT 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.P_Apellido
	) AS name, 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.S_Nombre, 
		' ', empleados.P_Apellido, ' ', empleados.S_Apellido
	) AS nameC, 
	empleados.Sexo AS sex, 
	empleados.CodEmpleado AS codeE, 
	empleados.CorreoElectronico AS email, 
	empleados.Direccion AS direction, 
	empleados.NumIdentidad AS idCard, 
	empleados.Telefono AS phoneNumber, 
	empleados.FechaNacimiento AS birthDay, 
	(
		SELECT 
			cargos.nombreCargo 
		FROM 
			cargos 
		WHERE 
			cargos.cargoID = empleados.Cargo
	) AS office, 
	(
		SELECT 
			usuarios.log 
		FROM 
			usuarios 
		WHERE 
			usuarios.codEmpleado = codeE
	) AS log 
FROM 
	empleados$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllUsers`()
    READS SQL DATA
    SQL SECURITY INVOKER
SELECT 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.P_Apellido
	) AS name, 
	empleados.CodEmpleado as codeE, 
	(
		SELECT 
			cargos.nombreCargo 
		FROM 
			cargos 
		WHERE 
			cargos.cargoID = empleados.Cargo
	) AS office, 
	(
		SELECT 
			usuarios.log 
		FROM 
			usuarios 
		WHERE 
			usuarios.codEmpleado = codeE
	) AS log
FROM 
	empleados 
WHERE 
	empleados.CodEmpleado = (
		SELECT 
			usuarios.codEmpleado 
		FROM 
			usuarios 
		WHERE 
			usuarios.codEmpleado = empleados.CodEmpleado
	)
ORDER BY log DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectDataRecipe`(IN `codReceta` INT(11))
    NO SQL
SELECT receta_medica.CodReceta, 						consultas.codconsulta, consultas.fecha, medicos.firma 	  FROM receta_medica inner join (consultas inner join 	  medicos on consultas.codmedico = medicos.codmedico)       on receta_medica.codconsulta = consultas.codconsulta       WHERE receta_medica.CodReceta = codReceta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectEmployed`(IN `users` VARCHAR(4))
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure return all referent the viewEmployed'
SELECT 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.P_Apellido
	) AS name, 
	CONCAT(
		empleados.P_Nombre, ' ', empleados.S_Nombre, 
		' ', empleados.P_Apellido, ' ', empleados.S_Apellido
	) AS nameC, 
	empleados.Sexo AS sex, 
	empleados.CodEmpleado AS codeE, 
	empleados.CorreoElectronico AS email, 
	empleados.Direccion AS direction, 
	empleados.NumIdentidad AS idCard, 
	empleados.Telefono AS phoneNumber, 
	empleados.FechaNacimiento AS birthDay, 
	(
		SELECT 
			cargos.nombreCargo 
		FROM 
			cargos 
		WHERE 
			cargos.cargoID = empleados.Cargo
	) AS office 
FROM 
	empleados 
WHERE 
	empleados.CodEmpleado = users$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectUser`(IN `user` VARCHAR(30))
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure view all information about the user log'
SELECT 
	usuarios.status, 
	usuarios.log, 
	usuarios.codEmpleado,
    usuarios.password,
	usuarios.userName, 
	(
		SELECT 
			empleados.Cargo 
		FROM 
			empleados 
		where 
			empleados.CodEmpleado = usuarios.codEmpleado
	) AS codRole 
FROM 
	usuarios 
WHERE 
	usuarios.userName = user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buscarInfoReceta`(IN `codReceta` INT(11))
    NO SQL
    SQL SECURITY INVOKER
SELECT consultas.Fecha, receta_medica.CodReceta, consultas.codConsulta, medicos.Firma from ((receta_medica INNER JOIN consultas ON receta_medica.codConsulta = consultas.CodConsulta ) INNER JOIN medicos ON consultas.CodMedico = medicos.CodMedico) WHERE receta_medica.CodReceta = codReceta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Inventario`()
    NO SQL
    SQL SECURITY INVOKER
BEGIN
	SELECT * FROM inventario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_nuevaSalida`()
    NO SQL
BEGIN
	INSERT INTO `cesamo`.`salidas_medicamentos` 
    (`CodSalida`, `Fecha`) VALUES (NULL, 
                                   CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tablaMedicamentoReceta`(IN `codReceta` INT)
    NO SQL
BEGIN
SELECT inventario_receta_medica.codmedicamento, inventario.nombremedicamento, inventario_receta_medica.cantidad from inventario_receta_medica inner join inventario on inventario_receta_medica.codmedicamento = inventario.codmedicamento where inventario_receta_medica.codreceta = codReceta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ultimaReceta`(IN `codConsulta` INT(11))
    READS SQL DATA
SELECT `CodReceta` FROM `receta_medica` WHERE `codConsulta` = codConsulta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateLog`(IN `logs` INT(1), IN `cod` VARCHAR(4))
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure update the status in the table users'
UPDATE 
	usuarios 
SET 
	log = logs 
WHERE 
	codEmpleado = cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStatus`(IN `codE` VARCHAR(30), IN `statu` INT(1))
    NO SQL
UPDATE 
	usuarios 
SET 
	usuarios.status = statu, usuarios.disablingdate = now()
WHERE 
	usuarios.codEmpleado = codE$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewUser`(IN `codeE` VARCHAR(4))
    READS SQL DATA
    SQL SECURITY INVOKER
    COMMENT 'This procedure return all information about a user'
SELECT 
	usuarios.userName, 
	DATE(usuarios.creationdate) AS creationdate, 
	DATE(usuarios.datemodified) AS datemodified, 
	DATE(usuarios.disablingdate) AS disablingdate, 
	usuarios.status, 
	usuarios.log, 
	(
		SELECT 
			CONCAT(
				empleados.P_Nombre, ' ', empleados.S_Nombre, 
				' ', empleados.P_Apellido, ' ', empleados.S_Apellido
			) 
		FROM 
			empleados 
		WHERE 
			empleados.CodEmpleado = codeE
	) AS nameC 
FROM 
	usuarios 
WHERE 
	usuarios.codEmpleado = codeE$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos_de_usuario`
--

CREATE TABLE IF NOT EXISTS `accesos_de_usuario` (
  `employedCode` varchar(4) NOT NULL,
  `dateOfAdmission` datetime NOT NULL,
  `IPAddress` varchar(20) NOT NULL,
  `departureTime` datetime NOT NULL,
  `reason` varchar(50) NOT NULL,
  `iden` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `accesos_de_usuario`
--

INSERT INTO `accesos_de_usuario` (`employedCode`, `dateOfAdmission`, `IPAddress`, `departureTime`, `reason`, `iden`) VALUES
('dag2', '2015-08-14 14:34:56', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 1),
('adf2', '2015-08-14 14:45:44', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 2),
('efd2', '2015-08-14 14:45:55', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 3),
('adf2', '2015-08-14 14:46:57', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 4),
('dag2', '2015-08-14 15:26:37', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 5),
('dag2', '2015-08-14 15:27:21', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 6),
('adf2', '2015-08-14 16:54:50', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 7),
('efd2', '2015-08-14 17:37:35', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 8),
('dag2', '2015-08-14 17:40:37', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 9),
('efd2', '2015-08-14 17:41:12', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 10),
('adf2', '2015-08-14 17:47:38', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 11),
('adf2', '2015-08-14 19:38:09', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 12),
('adf2', '2015-08-14 21:36:15', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 13),
('irm1', '2015-08-14 21:39:02', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 14),
('irm1', '2015-08-14 21:40:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 15),
('irm1', '2015-08-14 21:41:18', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 16),
('adf2', '2015-08-14 21:45:36', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 17),
('mrn1', '2015-08-14 22:31:20', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 18),
('adf2', '2015-08-14 22:31:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 19),
('adf2', '2015-08-14 22:32:00', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 20),
('hel1', '2015-08-14 22:32:44', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 21),
('hel1', '2015-08-14 22:38:49', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 22),
('adf2', '2015-08-14 23:16:43', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 23),
('adf2', '2015-08-14 23:27:05', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 24),
('adf2', '2015-08-15 00:02:59', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 25),
('dag2', '2015-08-15 00:03:28', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 26),
('efd2', '2015-08-15 00:05:36', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 27),
('adf2', '2015-08-15 00:07:00', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 28),
('dag2', '2015-08-16 18:20:10', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 29),
('dag2', '2015-08-16 18:28:46', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 30),
('dag2', '2015-08-16 18:29:13', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 31),
('dag2', '2015-08-16 18:30:25', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 32),
('dag2', '2015-08-16 18:31:59', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 33),
('dag2', '2015-08-17 21:38:15', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 34),
('dag2', '2015-08-18 09:00:39', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 35),
('dag2', '2015-08-18 10:04:13', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 36),
('dag2', '2015-08-18 17:05:48', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 37),
('dag2', '2015-08-19 04:10:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 38),
('dag2', '2015-08-19 10:33:49', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 39),
('dag2', '2015-08-19 12:01:01', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 40),
('dag2', '2015-08-20 14:32:54', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 41),
('dag2', '2015-08-20 19:50:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 42),
('dag2', '2015-08-21 13:38:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 43),
('dag2', '2015-08-22 06:35:32', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 44),
('dag2', '2015-08-22 06:35:41', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 45),
('dag2', '2015-08-22 06:39:10', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 46),
('dag2', '2015-08-22 06:39:40', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 47),
('dag2', '2015-08-22 06:39:54', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 48),
('dag2', '2015-08-22 06:40:17', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 49),
('mrn1', '2015-08-22 08:30:07', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 50),
('irm1', '2015-08-22 08:45:27', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 51),
('irm1', '2015-08-22 08:58:05', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 52),
('dag2', '2015-08-22 09:00:30', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 53),
('irm1', '2015-08-22 09:10:58', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 54),
('dag2', '2015-08-22 09:17:33', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 55),
('dag2', '2015-08-22 09:26:21', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 56),
('dag2', '2015-08-22 09:33:50', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 57),
('dag2', '2015-08-22 09:37:42', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 58),
('dag2', '2015-08-22 09:39:28', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 59),
('dag2', '2015-08-22 09:42:59', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 60),
('dag2', '2015-08-22 09:44:04', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 61),
('dag2', '2015-08-22 09:45:25', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 62),
('dag2', '2015-08-22 14:47:43', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 63),
('dag2', '2015-08-22 16:50:04', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 64),
('dag2', '2015-08-22 16:57:13', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 65),
('dag2', '2015-08-22 17:00:20', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 66),
('dag2', '2015-08-22 17:01:50', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 67),
('dag2', '2015-08-22 17:04:52', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 68),
('dag2', '2015-08-22 17:20:34', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 69),
('dag2', '2015-08-22 17:25:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 70),
('dag2', '2015-08-22 17:50:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 71),
('dag2', '2015-08-22 17:52:00', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 72),
('irm1', '2015-08-22 17:55:53', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 73),
('dag2', '2015-08-22 17:57:28', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 74),
('irm1', '2015-08-22 17:58:29', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 75),
('dag2', '2015-08-22 18:00:07', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 76),
('dag2', '2015-08-22 18:34:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 77),
('dag2', '2015-08-22 18:36:22', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 78),
('dag2', '2015-08-22 18:40:56', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 79),
('mrn1', '2015-08-22 21:23:23', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 80),
('mrn1', '2015-08-22 21:33:05', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 81),
('dag2', '2015-08-22 21:35:59', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 82),
('mrn1', '2015-08-22 21:36:11', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 83),
('efd2', '2015-08-22 23:06:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 84),
('hel1', '2015-08-22 23:06:53', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 85),
('efd2', '2015-08-22 23:07:47', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 86),
('mrn1', '2015-08-22 23:51:55', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 87),
('dag2', '2015-08-23 08:53:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 88),
('dag2', '2015-08-23 10:06:44', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 89),
('dag2', '2015-08-23 11:59:36', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 90),
('dag2', '2015-08-23 18:57:27', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 91),
('dag2', '2015-08-23 19:31:31', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 92),
('dag2', '2015-08-23 19:33:39', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 93),
('dag2', '2015-08-23 19:39:02', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 94),
('dag2', '2015-08-23 19:54:11', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 95),
('dag2', '2015-08-23 20:01:10', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 96),
('dag2', '2015-08-24 10:26:21', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 97),
('dag2', '2015-08-24 10:29:40', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 98),
('dag2', '2015-08-24 10:30:22', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 99),
('dag2', '2015-08-24 10:36:43', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 100),
('adf2', '2015-08-24 10:38:32', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 101),
('dag2', '2015-08-24 16:12:30', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 102),
('dag2', '2015-08-24 22:58:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 103),
('dag2', '2015-08-24 23:05:42', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 104),
('dag2', '2015-08-24 23:06:05', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 105),
('dag2', '2015-08-24 23:06:45', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 106),
('dag2', '2015-08-24 23:19:19', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 107),
('dag2', '2015-08-24 23:22:09', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 108),
('adf2', '2015-08-25 10:18:04', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 109),
('hel1', '2015-08-25 10:19:10', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 110),
('efd2', '2015-08-25 10:20:32', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 111),
('dag2', '2015-08-25 10:23:18', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 112),
('dag2', '2015-08-25 10:25:26', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 113),
('efd2', '2015-08-25 10:41:57', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 114),
('efd2', '2015-08-25 10:45:39', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 115),
('mrn1', '2015-08-25 10:45:52', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 116),
('efd2', '2015-08-25 10:54:35', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 117),
('efd2', '2015-08-25 10:54:42', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 118),
('efd2', '2015-08-25 10:55:43', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 119),
('efd2', '2015-08-25 10:55:46', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 120),
('adf2', '2015-08-25 10:56:45', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 121),
('adf2', '2015-08-25 10:58:17', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 122),
('dag2', '2015-08-25 10:58:48', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 123),
('dag2', '2015-08-25 10:59:05', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 124),
('dag2', '2015-08-25 11:00:29', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 125),
('mrn1', '2015-08-25 11:00:52', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 126),
('irm1', '2015-08-25 11:06:02', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 127),
('mrn1', '2015-08-25 11:08:55', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 128),
('irm1', '2015-08-25 11:12:24', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 129),
('efd2', '2015-08-25 11:13:33', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 130),
('dag2', '2015-08-25 11:15:04', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 131),
('dag2', '2015-08-25 14:23:45', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 132),
('dag2', '2015-08-25 14:23:52', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 133),
('adf2', '2015-08-25 14:27:46', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 134),
('adf2', '2015-08-25 14:35:03', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 135),
('adf2', '2015-08-25 17:45:42', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 136),
('adf2', '2015-08-25 20:51:16', '127.0.0.1', '0000-00-00 00:00:00', 'Inicio de sesión', 137);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `binnacle`
--

CREATE TABLE IF NOT EXISTS `binnacle` (
  `codBinnacle` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `codEmpleado` varchar(4) NOT NULL,
  `dateAction` datetime NOT NULL,
  `ipMachine` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
  `cargoID` int(11) NOT NULL,
  `nombreCargo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`cargoID`, `nombreCargo`) VALUES
(1, 'Administrador'),
(6, 'Enfermera'),
(3, 'Medicina'),
(2, 'Recepción'),
(5, 'Recursos Humanos'),
(4, 'Regente de farmacia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `CodCita` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `P_Nombre_Paciente` varchar(30) NOT NULL,
  `S_Nombre_Paciente` varchar(30) NOT NULL,
  `P_Apellido_Paciente` varchar(30) NOT NULL,
  `S_Apellido_Paciente` varchar(30) NOT NULL,
  `Telefono` int(8) NOT NULL,
  `CodMedico` int(11) NOT NULL,
  `Hora` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CodCita`, `Fecha`, `P_Nombre_Paciente`, `S_Nombre_Paciente`, `P_Apellido_Paciente`, `S_Apellido_Paciente`, `Telefono`, `CodMedico`, `Hora`) VALUES
(1, '2015-08-09', 'Miguel', 'Cesilio', 'Herrera', 'Fuentes', 22222222, 1, '00:00:00'),
(8, '2015-09-09', 'Karla', 'Maria', 'Guillen', 'Ortega', 22114455, 1, '09:00:00'),
(15, '2015-08-22', 'Maria', 'Jose', 'Duran', 'Duran', 22114477, 1, '10:00:00'),
(19, '2015-08-12', 'Coky', 'Margarita', 'Guillen', 'Ortega', 22556699, 1, '23:59:00'),
(20, '2015-08-15', 'Douglas', 'Alberto', 'Guillen', 'Ortega', 98155905, 1, '10:00:00'),
(21, '2015-08-12', 'Melvin', 'Ricardo', 'Nuñez', 'Ramirez', 99885566, 1, '14:30:00'),
(23, '0000-00-00', 'Hector', 'Eulises', 'Llanos', 'Pineda', 98086001, 1, '23:05:00'),
(26, '2015-08-18', 'Rony ', 'Douglas', 'Guillen', 'Cerna', 88888888, 1, '10:00:00'),
(27, '2015-08-25', 'Gabriela', 'Patricia', 'Godoy', 'Godoy', 99966661, 1, '08:00:00'),
(29, '2015-08-25', 'Isis', 'Yasmin', 'Lozano', 'Chicas', 98989989, 1, '07:30:00'),
(30, '2015-08-09', 'Miguel', 'Cesilio', 'Herrera', 'Fuentes', 22222222, 1, '00:00:00'),
(31, '2015-09-09', 'Karla', 'Maria', 'Guillen', 'Ortega', 22114455, 1, '09:00:00'),
(32, '2015-08-22', 'Maria', 'Jose', 'Duran', 'Duran', 22114477, 1, '10:00:00'),
(33, '2015-08-12', 'Coky', 'Margarita', 'Guillen', 'Ortega', 22556699, 1, '23:59:00'),
(34, '2015-08-15', 'Douglas', 'Alberto', 'Guillen', 'Ortega', 98155905, 1, '10:00:00'),
(35, '2015-08-12', 'Melvin', 'Ricardo', 'Nuñez', 'Ramirez', 99885566, 1, '14:30:00'),
(38, '2015-08-23', 'Maria', 'Luisa', 'Guillen', 'Cerna', 66559988, 3, '08:20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
  `CodConsulta` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MotivoConsulta` text NOT NULL,
  `Descripcion_examen_fisico` text NOT NULL,
  `Descripcion_diagnostico` text NOT NULL,
  `Descripcion_tratamiento` text NOT NULL,
  `CodMedico` int(11) NOT NULL,
  `codExpediente` varchar(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`CodConsulta`, `Fecha`, `MotivoConsulta`, `Descripcion_examen_fisico`, `Descripcion_diagnostico`, `Descripcion_tratamiento`, `CodMedico`, `codExpediente`) VALUES
(1, '2015-08-09 06:00:00', 'Gripe', 'En condiciones Aceptables', 'Gripe normal', 'Tomar Panadol antigripal', 1, ''),
(4, '2015-08-11 23:13:28', 'Dolor abasdfasdf', 'asdf', 'asdf', 'asdf', 1, '0801199222858'),
(5, '2015-08-11 23:15:17', 'qwer', 'qwer', 'qwer', 'qwer', 1, '0801199222858'),
(6, '2015-08-12 05:06:15', 'ugugiuy', 'lojigujiug', 'jkiugytut', 'jbkbyufvyu', 1, '0801199299999'),
(7, '2015-08-12 14:51:33', 'Dice tener constantes mareos, fiebres de mas  de 38 grados y dolor de cuerpo.', 'No se encontró nada fuera de lo normal.', 'Posible caso de dengue.', 'Beber muchos líquidos y si se presentan nuevamente los síntomas ingerir 2 Panadol cada 8 horas.\nProgramar una nueva cita dentro de 2 días para ver la evolución del cuadro medico.', 1, '0801199222858'),
(8, '2015-08-14 21:47:13', 'affda', 'asf', 'asfasf', 'a', 1, '0801199222858'),
(9, '2015-08-17 00:21:51', 'Fiebre, dolor de cuerpo', 'Asaber', 'Dengue', 'Reposo durante 1 semana.\nBeber mucha agua, y tratar con acetaminofen', 1, '0801199222858'),
(10, '2015-08-19 10:41:43', 'Dolor de Estomago', 'Nada', 'Nada', 'Nada', 1, '0801199222858'),
(11, '2015-08-19 16:34:20', 'jdjdjd', 'asdfasdf', 'asdfasdfasdfadf', 'xcvbxcvb', 1, '0801199222858'),
(12, '2015-08-21 02:09:43', 'NA', 'NE', 'Ni', 'No', 1, '0801199299999'),
(13, '2015-08-22 15:19:50', 'Fiebre y Dolor de Cabeza.', 'Salpullido en el área de la espalda.', 'No determinado.', 'Mantenerse en reposo y si se presenta algún malestar volver para realizar otro diagnostico.', 1, '0801199288888'),
(14, '2015-08-23 00:02:41', 'Dolor de cabeza desde hace 2 horas.', 'Presenta una no se que en la cabeza.', 'Nada....', 'Reposo y que si se presentan nuevamente los malestares acuda a otro hospital aqui no sabemos...', 1, '0801199277777'),
(15, '2015-08-24 01:55:46', 'Dolor de cuerpo', 'no presenta ninguna anomalía.', 'Dolor de cuerpo provocado por realizar mucho ejercicio fisico.', 'Dejar descansar los músculos y controlar el dolor con relajantes musculares.', 1, '0801199222858'),
(16, '2015-08-24 02:00:18', 'Dolor de cabeza y fiebre.', 'Presenta múltiples picadas de zancudo.', 'El paciente presenta síntomas de Dengue clásico.', 'El paciente necesitara reposo y mantenerse bajo supervision para evitar que la enfermedad se desarrolle y complique.', 1, '0801199222858'),
(17, '2015-08-24 16:31:42', 'asdf', 'asdf', 'asdf', 'asdf', 1, '0801199222858'),
(18, '2015-08-25 04:58:49', 'Dolor de cabeza', 'nada', 'nada ', 'no mucho', 3, '0801199277777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `CodEmpleado` varchar(4) NOT NULL,
  `NumIdentidad` varchar(13) NOT NULL,
  `P_Nombre` varchar(30) NOT NULL,
  `S_Nombre` varchar(30) DEFAULT NULL,
  `P_Apellido` varchar(30) NOT NULL,
  `S_Apellido` varchar(30) DEFAULT NULL,
  `Telefono` int(8) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  `FechaNacimiento` datetime NOT NULL,
  `Sexo` varchar(1) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`CodEmpleado`, `NumIdentidad`, `P_Nombre`, `S_Nombre`, `P_Apellido`, `S_Apellido`, `Telefono`, `CorreoElectronico`, `FechaNacimiento`, `Sexo`, `Direccion`, `Cargo`) VALUES
('adf2', '0601199301279', 'Alex', 'Dario', 'Flores', 'Aplicano', 32436703, 'alex_dario92@hotmail.com', '1992-09-21 00:00:00', 'M', 'Choluteca', 1),
('dag2', '0801199219039', 'Douglas', 'Alberto', 'Guillen', NULL, 98566454, 'douglas_guillen@hotmail.com', '1992-11-28 00:00:00', 'M', 'La joya', 3),
('efd2', '0921199332455', 'Edwin', NULL, 'Paz', NULL, NULL, NULL, '1992-07-22 00:00:00', 'F', 'Las uvas', 4),
('hel1', '0703199100093', 'Hector', 'Eulises', 'Llanos', 'Pineda', 98086001, 'hllanos75@gmail.com', '1991-01-22 00:00:00', 'M', 'Danli', 5),
('irm1', '0801201593316', 'Irma', 'Leonord', 'Pineda', 'Nuñez', NULL, NULL, '2015-08-14 00:00:00', 'F', 'Tegucigalpa', 6),
('mrn1', '0801199109876', 'Melvin', 'Ricardo', 'Nuñez', NULL, 89987887, 'melvin_nuñez@gmail.com', '1991-07-06 00:00:00', 'M', 'Col. Miramontes', 2),
('pru1', '0203233424234', 'Prueba', NULL, 'Prueba', NULL, 32342342, NULL, '2015-08-09 00:00:00', 'M', 'asdfa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_medicamentos`
--

CREATE TABLE IF NOT EXISTS `entrada_medicamentos` (
  `CodEntrada` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada_medicamentos`
--

INSERT INTO `entrada_medicamentos` (`CodEntrada`, `Fecha`) VALUES
(1, '2015-08-09 00:00:00'),
(2, '2015-08-19 18:00:00'),
(3, '2015-08-22 23:34:59'),
(4, '2015-08-22 23:35:01'),
(5, '2015-08-22 23:35:01'),
(6, '2015-08-22 23:35:02'),
(7, '2015-08-22 23:35:09'),
(8, '2015-08-22 23:35:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_medicamentos_inventario`
--

CREATE TABLE IF NOT EXISTS `entrada_medicamentos_inventario` (
  `CodEntrada` int(11) NOT NULL,
  `CodMedicamento` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `iden` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada_medicamentos_inventario`
--

INSERT INTO `entrada_medicamentos_inventario` (`CodEntrada`, `CodMedicamento`, `cantidad`, `FechaVencimiento`, `iden`) VALUES
(1, 1, 5000, '2016-02-18', 1),
(2, 1, 5000, '2015-08-27', 2),
(2, 2, 5000, '2015-08-20', 3),
(3, 4, 100, '2015-12-31', 4),
(4, 4, 100, '2015-12-31', 5),
(5, 4, 100, '2015-12-31', 6),
(6, 4, 100, '2015-12-31', 7),
(7, 4, 100, '2015-12-31', 8),
(8, 4, 100, '2015-12-31', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
  `codEspecialidad` int(11) NOT NULL,
  `especialidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE IF NOT EXISTS `expedientes` (
  `CodExpediente` varchar(13) NOT NULL,
  `P_Nombre` varchar(30) NOT NULL,
  `S_Nombre` varchar(30) NOT NULL,
  `P_Apellido` varchar(30) NOT NULL,
  `S_Apellido` varchar(30) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Sexo` varchar(1) NOT NULL,
  `LugarNacimiento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `expedientes`
--

INSERT INTO `expedientes` (`CodExpediente`, `P_Nombre`, `S_Nombre`, `P_Apellido`, `S_Apellido`, `FechaNacimiento`, `Sexo`, `LugarNacimiento`) VALUES
('0801199222858', 'Douglas', 'Alberto', 'Guillen', 'Ortega', '1992-12-01', 'M', 'Tegucigalpa, Francisco Morazán'),
('0801199277777', 'Isis', 'Yasmin', 'Lozano', 'Chicas', '1992-11-11', 'M', 'Tegucigalpa, Francisco Morazan'),
('0801199288888', 'Gabriela', 'Patricia', 'Godoy', 'Godoy', '1990-10-03', 'M', 'Tegucigalpa, Honduras.'),
('0801199299999', 'Coky', 'Mariela', 'Guillen', 'Ortega', '1990-10-11', 'F', 'Tegucigalpa, Honduras'),
('1', 'Raul', 'Luis', 'Castro', 'Sesamo', '2015-08-31', 'M', 'Tegucigalpa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `CodMedicamento` int(11) NOT NULL,
  `NombreMedicamento` varchar(30) NOT NULL,
  `NombreFabricante` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL,
  `Existencia` int(11) NOT NULL,
  `UnidadMedida` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`CodMedicamento`, `NombreMedicamento`, `NombreFabricante`, `Descripcion`, `Existencia`, `UnidadMedida`) VALUES
(1, 'Panadol Antigripal', 'Infarma', 'Alivia la congestion nasal y el malestar de la gripe.', 13982, 'Sobres'),
(2, 'Tabcin', 'Tabcin', 'Pastillas para la tos', 100, 'Pastillas'),
(3, 'StimPack', 'Lee Rapid Pharmaceutical', 'Is a marvel of modern medicine.', 6188, 'Inyeccion'),
(4, 'Jet', 'Lee Rapid Pharmaceutical', 'Just what the doctor ordered', 10786, 'Ampolla'),
(5, 'Musculeina', 'Lee Rapid Pharmaceutical', 'Aumenta la salud', 1183, 'Frascos'),
(73, 'Alka-Seltzer', 'Bayern', 'Alivia el malestar estomacal', 100, 'Sobres'),
(74, 'Dilabrom Compuesto', 'Infarma', 'Jarabe contra la tos', 100, 'Frasco'),
(75, 'Altruline', 'pfizer', 'Pastilla para hacerlo mas alegre', 100, 'Slide'),
(76, 'Ziprexsa', 'Lilly', 'Pastilla para hacerlo mas alegre', 100, 'Slide'),
(77, 'Ibuprofeno', 'Infarma', 'Pastillas para aliviar el malestar del dolor de articulaciones y otros tipos de dolores corporales.', 500, 'Slide'),
(78, 'Despertac', 'Bayern', 'Pastilla que se utiliza para mantenerse despierto.', 0, 'Sobres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_receta_medica`
--

CREATE TABLE IF NOT EXISTS `inventario_receta_medica` (
  `CodMedicamento` int(11) DEFAULT NULL,
  `CodReceta` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Tratamiento` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_receta_medica`
--

INSERT INTO `inventario_receta_medica` (`CodMedicamento`, `CodReceta`, `cantidad`, `Tratamiento`) VALUES
(1, 19, 88, '10'),
(2, 19, 111, 'nada'),
(2, 20, 333, 'Nada'),
(1, 20, 1000, 'Nada 2'),
(1, 21, 9, 'Beber una cada 8 horas por 3 dias, y si despues de los 3 '),
(2, 22, 9, 'Una cada 8 horas'),
(1, 22, 4, 'una cada 12 horas por 2 dias'),
(76, 23, 10, 'Tomar 1 al dia durante 10 dias'),
(78, 24, 2, '1 al dia'),
(1, 25, 10, 'Una cada 8 horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `CodMedico` int(11) NOT NULL,
  `CodEmpleado` varchar(4) NOT NULL,
  `Firma` varchar(100) NOT NULL,
  `Sello` varchar(100) DEFAULT NULL,
  `Especialidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`CodMedico`, `CodEmpleado`, `Firma`, `Sello`, `Especialidad`) VALUES
(1, 'adf2', 'Jose Mario Lopez Izaguirre', 'JMLI', 'Farmacia'),
(3, 'dag2', 'si', 'si', 'Pediatria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_especialidades`
--

CREATE TABLE IF NOT EXISTS `medico_especialidades` (
  `codMedico` int(11) NOT NULL,
  `codEspecialidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preclinica`
--

CREATE TABLE IF NOT EXISTS `preclinica` (
  `CodPreclinica` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Peso` float NOT NULL,
  `Presion` varchar(20) NOT NULL,
  `Temperatura` float NOT NULL,
  `Altura` float NOT NULL,
  `CodEmpleado` int(11) NOT NULL,
  `CodExpediente` varchar(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preclinica`
--

INSERT INTO `preclinica` (`CodPreclinica`, `Fecha`, `Peso`, `Presion`, `Temperatura`, `Altura`, `CodEmpleado`, `CodExpediente`) VALUES
(1, '2015-08-19 03:00:00', 140, '120/80', 37, 1.75, 1, '0801199222858'),
(2, '2015-08-19 12:00:00', 140, '120/60', 37, 1.7, 1, '0801199222858');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_medica`
--

CREATE TABLE IF NOT EXISTS `receta_medica` (
  `CodReceta` int(11) NOT NULL,
  `codConsulta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta_medica`
--

INSERT INTO `receta_medica` (`CodReceta`, `codConsulta`) VALUES
(19, 10),
(20, 11),
(21, 13),
(22, 14),
(23, 14),
(24, 14),
(25, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas_medicamentos`
--

CREATE TABLE IF NOT EXISTS `salidas_medicamentos` (
  `CodSalida` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salidas_medicamentos`
--

INSERT INTO `salidas_medicamentos` (`CodSalida`, `Fecha`) VALUES
(1, '2015-08-19 07:00:00'),
(2, '2015-08-22 23:10:59'),
(3, '2015-08-22 23:12:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas_medicamentos_inventario`
--

CREATE TABLE IF NOT EXISTS `salidas_medicamentos_inventario` (
  `CodSalida` int(11) NOT NULL,
  `CodMedicamento` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `MotivoSalida` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salidas_medicamentos_inventario`
--

INSERT INTO `salidas_medicamentos_inventario` (`CodSalida`, `CodMedicamento`, `cantidad`, `MotivoSalida`) VALUES
(1, 1, 100, 'Prueba'),
(1, 1, 200, 'Prueba 2'),
(2, 1, 9, 'Receta Medica'),
(3, 1, 9, 'Receta Medica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `userName` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `creationdate` datetime NOT NULL,
  `datemodified` datetime NOT NULL,
  `disablingdate` datetime DEFAULT NULL,
  `status` int(1) NOT NULL,
  `codEmpleado` varchar(4) NOT NULL,
  `log` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`userName`, `password`, `creationdate`, `datemodified`, `disablingdate`, `status`, `codEmpleado`, `log`) VALUES
('darioaplicano', 'QWRmYXBsaWNhbm8xIQ==', '2015-08-22 23:45:09', '2015-08-22 23:45:09', NULL, 1, 'adf2', 0),
('dgou', 'QXNkLjEyMzQ=', '2015-08-23 00:13:17', '2015-08-23 00:13:17', '2015-08-25 10:18:47', 1, 'dag2', 0),
('edwi', 'QXNkLjEyMzQ=', '2015-08-23 00:15:26', '2015-08-23 00:15:26', NULL, 1, 'efd2', 0),
('hllanos', 'UG9wb3JveWxANjY2', '2015-08-23 00:16:06', '2015-08-23 00:16:06', '2015-08-24 23:06:25', 1, 'hel1', 0),
('irma', 'QXNkLjEyMzQ=', '2015-08-23 00:16:43', '2015-08-23 00:16:43', NULL, 1, 'irm1', 0),
('mrnr', 'QXNkLjEyMzQ=', '2015-08-23 00:17:16', '2015-08-23 00:17:16', NULL, 1, 'mrn1', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos_de_usuario`
--
ALTER TABLE `accesos_de_usuario`
  ADD PRIMARY KEY (`iden`),
  ADD KEY `employedCode_FK` (`employedCode`);

--
-- Indices de la tabla `binnacle`
--
ALTER TABLE `binnacle`
  ADD PRIMARY KEY (`codBinnacle`),
  ADD KEY `codEmpleado_FK_Binnacle` (`codEmpleado`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cargoID`),
  ADD UNIQUE KEY `nombreCargo` (`nombreCargo`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CodCita`),
  ADD KEY `citas_ibfk_1` (`CodMedico`) USING BTREE;

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`CodConsulta`),
  ADD KEY `CodMedico` (`CodMedico`) USING BTREE;

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`CodEmpleado`),
  ADD UNIQUE KEY `CodEmpleado` (`CodEmpleado`),
  ADD UNIQUE KEY `NumIdentidad` (`NumIdentidad`),
  ADD KEY `CargoE_FK` (`Cargo`);

--
-- Indices de la tabla `entrada_medicamentos`
--
ALTER TABLE `entrada_medicamentos`
  ADD PRIMARY KEY (`CodEntrada`);

--
-- Indices de la tabla `entrada_medicamentos_inventario`
--
ALTER TABLE `entrada_medicamentos_inventario`
  ADD PRIMARY KEY (`iden`),
  ADD KEY `CodEntradaFK` (`CodEntrada`),
  ADD KEY `CodMedicamento_EM_FK` (`CodMedicamento`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`codEspecialidad`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`CodExpediente`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`CodMedicamento`);

--
-- Indices de la tabla `inventario_receta_medica`
--
ALTER TABLE `inventario_receta_medica`
  ADD KEY `CodMedicamento_inv_recetaFK` (`CodMedicamento`),
  ADD KEY `CodRecetaFK` (`CodReceta`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`CodMedico`),
  ADD UNIQUE KEY `CodMedico_2` (`CodMedico`),
  ADD UNIQUE KEY `CodEmpleado` (`CodEmpleado`),
  ADD KEY `CodMedico` (`CodMedico`);

--
-- Indices de la tabla `preclinica`
--
ALTER TABLE `preclinica`
  ADD PRIMARY KEY (`CodPreclinica`),
  ADD KEY `preclinica_ibfk_1` (`CodExpediente`);

--
-- Indices de la tabla `receta_medica`
--
ALTER TABLE `receta_medica`
  ADD PRIMARY KEY (`CodReceta`),
  ADD KEY `receta_medica_ibfk_1` (`codConsulta`);

--
-- Indices de la tabla `salidas_medicamentos`
--
ALTER TABLE `salidas_medicamentos`
  ADD PRIMARY KEY (`CodSalida`);

--
-- Indices de la tabla `salidas_medicamentos_inventario`
--
ALTER TABLE `salidas_medicamentos_inventario`
  ADD KEY `CodSalidaFK` (`CodSalida`),
  ADD KEY `CodMedicamento_SM_FK` (`CodMedicamento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `codEmpleado` (`codEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos_de_usuario`
--
ALTER TABLE `accesos_de_usuario`
  MODIFY `iden` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `binnacle`
--
ALTER TABLE `binnacle`
  MODIFY `codBinnacle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cargoID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CodCita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `CodConsulta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `entrada_medicamentos`
--
ALTER TABLE `entrada_medicamentos`
  MODIFY `CodEntrada` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `entrada_medicamentos_inventario`
--
ALTER TABLE `entrada_medicamentos_inventario`
  MODIFY `iden` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `CodMedicamento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `CodMedico` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `preclinica`
--
ALTER TABLE `preclinica`
  MODIFY `CodPreclinica` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `receta_medica`
--
ALTER TABLE `receta_medica`
  MODIFY `CodReceta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `salidas_medicamentos`
--
ALTER TABLE `salidas_medicamentos`
  MODIFY `CodSalida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos_de_usuario`
--
ALTER TABLE `accesos_de_usuario`
  ADD CONSTRAINT `employedCode_FK` FOREIGN KEY (`employedCode`) REFERENCES `empleados` (`CodEmpleado`);

--
-- Filtros para la tabla `binnacle`
--
ALTER TABLE `binnacle`
  ADD CONSTRAINT `codEmpleado_FK_Binnacle` FOREIGN KEY (`codEmpleado`) REFERENCES `empleados` (`CodEmpleado`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`CodMedico`) REFERENCES `medicos` (`CodMedico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`CodMedico`) REFERENCES `medicos` (`CodMedico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `CargoE_FK` FOREIGN KEY (`Cargo`) REFERENCES `cargos` (`cargoID`);

--
-- Filtros para la tabla `entrada_medicamentos_inventario`
--
ALTER TABLE `entrada_medicamentos_inventario`
  ADD CONSTRAINT `CodEntradaFK` FOREIGN KEY (`CodEntrada`) REFERENCES `entrada_medicamentos` (`CodEntrada`),
  ADD CONSTRAINT `CodMedicamento_EM_FK` FOREIGN KEY (`CodMedicamento`) REFERENCES `inventario` (`CodMedicamento`);

--
-- Filtros para la tabla `inventario_receta_medica`
--
ALTER TABLE `inventario_receta_medica`
  ADD CONSTRAINT `CodMedicamento_inv_recetaFK` FOREIGN KEY (`CodMedicamento`) REFERENCES `inventario` (`CodMedicamento`),
  ADD CONSTRAINT `CodRecetaFK` FOREIGN KEY (`CodReceta`) REFERENCES `receta_medica` (`CodReceta`);

--
-- Filtros para la tabla `preclinica`
--
ALTER TABLE `preclinica`
  ADD CONSTRAINT `preclinica_ibfk_1` FOREIGN KEY (`CodExpediente`) REFERENCES `expedientes` (`CodExpediente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta_medica`
--
ALTER TABLE `receta_medica`
  ADD CONSTRAINT `receta_medica_ibfk_1` FOREIGN KEY (`codConsulta`) REFERENCES `consultas` (`CodConsulta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salidas_medicamentos_inventario`
--
ALTER TABLE `salidas_medicamentos_inventario`
  ADD CONSTRAINT `CodMedicamento_SM_FK` FOREIGN KEY (`CodMedicamento`) REFERENCES `inventario` (`CodMedicamento`),
  ADD CONSTRAINT `CodSalidaFK` FOREIGN KEY (`CodSalida`) REFERENCES `salidas_medicamentos` (`CodSalida`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`codEmpleado`) REFERENCES `empleados` (`CodEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
