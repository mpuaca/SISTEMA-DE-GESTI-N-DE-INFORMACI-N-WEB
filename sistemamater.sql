-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2023 a las 22:00:44
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemamater`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nombre_alimento` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `asistencia` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_estudiante`, `fecha`, `asistencia`) VALUES
(93, 19, '2023-10-21', 1),
(94, 20, '2023-10-21', 1),
(95, 21, '2023-10-21', 1),
(96, 22, '2023-10-21', 1),
(97, 23, '2023-10-21', 1),
(98, 24, '2023-10-21', 1),
(99, 26, '2023-10-21', 1),
(100, 27, '2023-10-21', 1),
(101, 28, '2023-10-21', 1),
(102, 19, '2023-10-28', 1),
(103, 20, '2023-10-28', 1),
(104, 21, '2023-10-28', 1),
(105, 22, '2023-10-28', 1),
(106, 23, '2023-10-28', 1),
(107, 24, '2023-10-28', 1),
(108, 26, '2023-10-28', 1),
(109, 27, '2023-10-28', 1),
(110, 28, '2023-10-28', 1),
(111, 30, '2023-10-28', 1),
(112, 19, '2023-10-29', 1),
(113, 20, '2023-10-29', 1),
(114, 21, '2023-10-29', 1),
(115, 22, '2023-10-29', 1),
(116, 23, '2023-10-29', 1),
(117, 30, '2023-10-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiarios`
--

CREATE TABLE `beneficiarios` (
  `BeneficiarioID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(9) NOT NULL,
  `dpi` varchar(13) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `propósito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficiarios`
--

INSERT INTO `beneficiarios` (`BeneficiarioID`, `nombre`, `telefono`, `dpi`, `observaciones`, `propósito`) VALUES
(1, 'Andrea  S. Barbara Xic Lux de Sabaj', 35922417, '1933331630801', '', 'alimentos'),
(2, 'Erika Olegraria Alvarado Zapeta', 50591965, '1746121170802', '', 'alimentos'),
(3, 'Claudia Lopez', 45565208, '1776641261101', '', 'alimentos'),
(18, 'Ilbia Lilí Morales Antonio', 41738021, '34644633309', '', 'alimentos'),
(27, 'Maria Teresa Torres', 77375034, '3257897970802', '', 'útiles_escolares'),
(28, 'Juana Antonieta Puac', 77375034, '3257897970802', '', 'ambos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catecumenos`
--

CREATE TABLE `catecumenos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `id_asistencia` int(11) NOT NULL,
  `Padrinos` tinyint(1) NOT NULL,
  `certificado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catecumenos`
--

INSERT INTO `catecumenos` (`Id`, `Nombre`, `Apellido`, `Edad`, `Telefono`, `id_asistencia`, `Padrinos`, `certificado`) VALUES
(1, 'Erika Olegraria', 'Alvarado Zapeta', 15, 32879655, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `ComboID` int(11) NOT NULL,
  `DescripcionCombo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combos`
--

INSERT INTO `combos` (`ComboID`, `DescripcionCombo`) VALUES
(13, 'combo alimentos'),
(14, 'combo utiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_donaciones`
--

CREATE TABLE `detalle_donaciones` (
  `DetalleDonacionID` int(11) NOT NULL,
  `DonacionID` int(11) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `medida` varchar(50) NOT NULL,
  `Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_donaciones`
--

INSERT INTO `detalle_donaciones` (`DetalleDonacionID`, `DonacionID`, `Descripcion`, `Cantidad`, `medida`, `Categoria`) VALUES
(77, 74, 'aceite', 100, 'unidades', 'alimentos'),
(78, 74, 'cuadernos', 100, 'unidades', 'útiles'),
(79, 75, 'lapiceros', 100, 'unidades', 'útiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `DonacionID` int(11) NOT NULL,
  `DonanteID` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`DonacionID`, `DonanteID`, `Fecha`) VALUES
(74, 1, '2023-10-21'),
(75, 1, '2023-10-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donantes`
--

CREATE TABLE `donantes` (
  `DonanteID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donantes`
--

INSERT INTO `donantes` (`DonanteID`, `Nombre`, `telefono`) VALUES
(1, 'Congregacion', 77375034);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `EntregaID` int(11) NOT NULL,
  `BeneficiarioID` int(11) DEFAULT NULL,
  `ComboID` int(11) DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `asistio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`EntregaID`, `BeneficiarioID`, `ComboID`, `FechaEntrega`, `asistio`) VALUES
(62, 3, 13, '2023-10-21', 1),
(63, 1, 13, '2023-10-21', 1),
(64, 2, 13, '2023-10-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas_utiles`
--

CREATE TABLE `entregas_utiles` (
  `EntregaID` int(11) NOT NULL,
  `BeneficiarioID` int(11) DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  `asistio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entregas_utiles`
--

INSERT INTO `entregas_utiles` (`EntregaID`, `BeneficiarioID`, `FechaEntrega`, `asistio`) VALUES
(4, 27, '2023-10-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Padrino` tinyint(1) DEFAULT NULL,
  `certificado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`ID`, `Nombre`, `Edad`, `Telefono`, `Padrino`, `certificado`) VALUES
(19, 'Miriam Marisol Puac Ajanel', 20, '77375034', 1, 1),
(20, 'Juan Francisco Puac Puac', 13, '77375034', 0, 1),
(21, 'Juana', 25, '32879656', 0, 1),
(22, 'Maria Teresa', 20, '32879655', 0, 1),
(23, 'Miriampruba1', 15, '32879655', 0, 1),
(24, 'Juana Antonieta ', 20, '32879655', 0, 1),
(26, 'Maria Teresa', 20, '77375034', 0, 1),
(27, 'Maria Teresa1', 15, '32879655', 0, 1),
(28, 'Miriam Marisol', 20, '77375034', 1, 0),
(30, 'Juana Antonieta ', 20, '77375034', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `ProductoID` int(11) NOT NULL,
  `NombreProducto` varchar(50) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`ProductoID`, `NombreProducto`, `Cantidad`, `Categoria`) VALUES
(14, 'aceite', 58, 'alimentos'),
(15, 'cuadernos', 63, 'útiles'),
(16, 'lapiceros', 93, 'útiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosentregadosutiles`
--

CREATE TABLE `productosentregadosutiles` (
  `ProductoEntregadoID` int(11) NOT NULL,
  `EntregaID` int(11) DEFAULT NULL,
  `ProductoID` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `FechaEntregaProducto` date DEFAULT NULL,
  `Observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productosentregadosutiles`
--

INSERT INTO `productosentregadosutiles` (`ProductoEntregadoID`, `EntregaID`, `ProductoID`, `Cantidad`, `FechaEntregaProducto`, `Observaciones`) VALUES
(1, 4, 15, 1, NULL, NULL),
(2, 4, 16, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_combos`
--

CREATE TABLE `productos_combos` (
  `ProductoComboID` int(11) NOT NULL,
  `ComboID` int(11) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_combos`
--

INSERT INTO `productos_combos` (`ProductoComboID`, `ComboID`, `ProductoID`, `Cantidad`) VALUES
(20, 13, 14, 2),
(21, 14, 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_asistencia`
--
-- Error leyendo la estructura de la tabla sistemamater.registro_asistencia: #1932 - Table 'sistemamater.registro_asistencia' doesn't exist in engine
-- Error leyendo datos de la tabla sistemamater.registro_asistencia: #1064 - Algo está equivocado en su sintax cerca 'FROM `sistemamater`.`registro_asistencia`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `rol`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodonaciones`
--

CREATE TABLE `tipodonaciones` (
  `TipoDonacionID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodonaciones`
--

INSERT INTO `tipodonaciones` (`TipoDonacionID`, `Nombre`) VALUES
(1, 'dinero'),
(2, 'alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `clave`, `rol`, `estado`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'Miriam MarisolPuac Ajanel', 'miriampuac9812@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 1, NULL, NULL),
(102, 'user', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD PRIMARY KEY (`BeneficiarioID`);

--
-- Indices de la tabla `catecumenos`
--
ALTER TABLE `catecumenos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`ComboID`);

--
-- Indices de la tabla `detalle_donaciones`
--
ALTER TABLE `detalle_donaciones`
  ADD PRIMARY KEY (`DetalleDonacionID`),
  ADD KEY `DonacionID` (`DonacionID`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`DonacionID`),
  ADD KEY `DonanteID` (`DonanteID`);

--
-- Indices de la tabla `donantes`
--
ALTER TABLE `donantes`
  ADD PRIMARY KEY (`DonanteID`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`EntregaID`),
  ADD KEY `BeneficiarioID` (`BeneficiarioID`),
  ADD KEY `ComboID` (`ComboID`);

--
-- Indices de la tabla `entregas_utiles`
--
ALTER TABLE `entregas_utiles`
  ADD PRIMARY KEY (`EntregaID`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ProductoID`);

--
-- Indices de la tabla `productosentregadosutiles`
--
ALTER TABLE `productosentregadosutiles`
  ADD PRIMARY KEY (`ProductoEntregadoID`),
  ADD KEY `EntregaID` (`EntregaID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `productos_combos`
--
ALTER TABLE `productos_combos`
  ADD PRIMARY KEY (`ProductoComboID`),
  ADD KEY `ComboID` (`ComboID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipodonaciones`
--
ALTER TABLE `tipodonaciones`
  ADD PRIMARY KEY (`TipoDonacionID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `usuarios_ibfk_1` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  MODIFY `BeneficiarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `catecumenos`
--
ALTER TABLE `catecumenos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `ComboID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_donaciones`
--
ALTER TABLE `detalle_donaciones`
  MODIFY `DetalleDonacionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `DonacionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `donantes`
--
ALTER TABLE `donantes`
  MODIFY `DonanteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `EntregaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `entregas_utiles`
--
ALTER TABLE `entregas_utiles`
  MODIFY `EntregaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productosentregadosutiles`
--
ALTER TABLE `productosentregadosutiles`
  MODIFY `ProductoEntregadoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos_combos`
--
ALTER TABLE `productos_combos`
  MODIFY `ProductoComboID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipodonaciones`
--
ALTER TABLE `tipodonaciones`
  MODIFY `TipoDonacionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_donaciones`
--
ALTER TABLE `detalle_donaciones`
  ADD CONSTRAINT `detalle_donaciones_ibfk_1` FOREIGN KEY (`DonacionID`) REFERENCES `donaciones` (`DonacionID`);

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`DonanteID`) REFERENCES `donantes` (`DonanteID`);

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`BeneficiarioID`) REFERENCES `beneficiarios` (`BeneficiarioID`);

--
-- Filtros para la tabla `productosentregadosutiles`
--
ALTER TABLE `productosentregadosutiles`
  ADD CONSTRAINT `productosentregadosutiles_ibfk_1` FOREIGN KEY (`EntregaID`) REFERENCES `entregas_utiles` (`EntregaID`),
  ADD CONSTRAINT `productosentregadosutiles_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `inventario` (`ProductoID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
