-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2022 a las 00:20:25
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wp_dev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_autos`
--

DROP TABLE IF EXISTS `wp_autos`;
CREATE TABLE IF NOT EXISTS `wp_autos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA_REG` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `MARCA` varchar(50) CHARACTER SET utf8 NOT NULL,
  `MODELO` varchar(50) CHARACTER SET utf8 NOT NULL,
  `AÑO` varchar(50) CHARACTER SET utf8 NOT NULL,
  `PLACA` varchar(50) CHARACTER SET utf8 NOT NULL,
  `SERIE` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_clientes`
--

DROP TABLE IF EXISTS `wp_clientes`;
CREATE TABLE IF NOT EXISTS `wp_clientes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA_REG` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NOMBRE` varchar(50) CHARACTER SET utf8 NOT NULL,
  `APELLIDO_MAT` varchar(50) CHARACTER SET utf8 NOT NULL,
  `APELLIDO_PAT` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TELEFONO_1` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TELEFONO_2` varchar(50) CHARACTER SET utf8 NOT NULL,
  `DIRECCION` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_clientes`
--

INSERT INTO `wp_clientes` (`ID`, `FECHA_REG`, `NOMBRE`, `APELLIDO_MAT`, `APELLIDO_PAT`, `TELEFONO_1`, `TELEFONO_2`, `DIRECCION`) VALUES
(13, '2022-07-27 20:59:07', 'Prueba', 'Prueba', 'Prueba', '123', '123', 'Prueba'),
(14, '2022-07-27 22:02:48', 'Manuel', 'Coronel', '', '+524445675388', '', 'Soledad de Graciano Sanchez'),
(15, '2022-07-27 22:06:43', 'Manuel', 'Coronel', '', '+524445675388', '', 'Soledad de Graciano Sanchez'),
(16, '2022-07-27 22:09:09', 'Manuel', 'Coronel', 'Coronel', '+524445675388', '+524445675388', 'Soledad de Graciano Sanchez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_clientes_autos`
--

DROP TABLE IF EXISTS `wp_clientes_autos`;
CREATE TABLE IF NOT EXISTS `wp_clientes_autos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_AUTO` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_CLIENTE` (`ID_CLIENTE`),
  KEY `ID_AUTO` (`ID_AUTO`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
