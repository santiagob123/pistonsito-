-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2025 a las 00:36:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `piston_rojo_actualizada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id_Cat` int(11) NOT NULL COMMENT 'Un identificador único para cada categoría de producto',
  `Cat_Nombre` varchar(25) NOT NULL,
  `Cat_Descripcion` varchar(45) NOT NULL,
  `Cat_Marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Id_Citas` int(11) NOT NULL COMMENT 'Identificador único para cada cita',
  `Cit_Fecha` date NOT NULL COMMENT 'Fecha programada para la cita',
  `Cit_Hora` time NOT NULL COMMENT 'Hora programada para la cita',
  `Cit_Estado` varchar(45) NOT NULL COMMENT 'Estado actual de la cita',
  `Servicios_Id_Servicio` int(11) NOT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_operacion`
--

CREATE TABLE `detalle_operacion` (
  `Id_Operacion` int(11) NOT NULL COMMENT 'Identificador único para cada operación',
  `Op_Cantidad` int(11) NOT NULL COMMENT 'Cantidad de productos involucrados',
  `Op_Fecha_Creacion` date NOT NULL COMMENT 'Fecha de creación de la operación',
  `Productos_Id_Pro` int(11) NOT NULL,
  `Tipo_de_Operacion_Id_Op` int(11) NOT NULL,
  `Movimientos_Id_Movimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `Id_Diagnostico` int(11) NOT NULL COMMENT 'Identificador único para cada diagnóstico',
  `Diag_Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del diagnóstico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_producto`
--

CREATE TABLE `estado_producto` (
  `Id_EstadoP` int(11) NOT NULL COMMENT 'Identificador único para cada estado de producto',
  `Estp_Descripcion` varchar(20) NOT NULL COMMENT 'Descripción del estado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_moto`
--

CREATE TABLE `historia_moto` (
  `Id_Historia` int(11) NOT NULL COMMENT 'Identificador único para cada registro histórico',
  `His_Fecha_arreglo` date NOT NULL COMMENT 'Fecha en que se realizó el arreglo',
  `His_Kilometraje_arreglo` int(11) NOT NULL COMMENT 'Kilometraje al momento del arreglo',
  `His_Serv_Descripcion_Ini` varchar(45) NOT NULL COMMENT 'Descripción inicial del servicio',
  `His_Serv_Descripcion_Fin` varchar(45) NOT NULL COMMENT 'Descripción final del servicio',
  `His_Estado_Arreglo` varchar(45) NOT NULL COMMENT 'Estado del arreglo',
  `His_CostoTotal` int(11) NOT NULL COMMENT 'Costo total del servicio',
  `Moto_Id_Mot` int(11) NOT NULL,
  `Cita_Id_Citas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moto`
--

CREATE TABLE `moto` (
  `Id_Mot` int(11) NOT NULL COMMENT 'Identificador único para cada motocicleta',
  `Mot_Modelo` varchar(45) NOT NULL COMMENT 'Modelo específico de la motocicleta',
  `Mot_Placa` varchar(45) NOT NULL COMMENT 'Matrícula o placa de identificación',
  `Mot_Marca` varchar(45) NOT NULL COMMENT 'Fabricante o marca de la motocicleta',
  `Mot_Numero_serie` varchar(45) NOT NULL COMMENT 'Número único asignado por el fabricante',
  `Mot_Kilometraje` int(11) NOT NULL COMMENT 'Kilometraje actual de la motocicleta',
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `Id_Movimiento` int(11) NOT NULL COMMENT 'Identificador único para cada movimiento',
  `Mov_Total` decimal(10,2) NOT NULL COMMENT 'Total del movimiento realizado',
  `Mov_Fecha` date NOT NULL COMMENT 'Fecha del movimiento',
  `Tipo_de_Operacion_Id_Op` int(11) NOT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Pro` int(11) NOT NULL COMMENT 'Identificador único para cada producto',
  `Pro_Referencia` varchar(45) NOT NULL COMMENT 'Código único del artículo',
  `Pro_Nombre` varchar(45) NOT NULL COMMENT 'Nombre del producto o repuesto',
  `Pro_Marca` varchar(45) NOT NULL COMMENT 'Marca del producto',
  `Pro_Categoria` varchar(45) NOT NULL COMMENT 'Categoría general del producto',
  `Pro_Stock` int(11) NOT NULL COMMENT 'Cantidad de stock disponible',
  `Pro_Descripcion` varchar(255) NOT NULL COMMENT 'Descripción detallada del producto',
  `Pro_Precio` decimal(10,2) NOT NULL COMMENT 'Precio del producto',
  `Proveedores_Id_Prov` int(11) NOT NULL,
  `Categoria_Id_Cat` int(11) NOT NULL,
  `Estado_Id_Estado` int(11) NOT NULL,
  `Pro_Imagen` varchar(255) NOT NULL COMMENT 'Ruta de la imagen del producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_Prov` int(11) NOT NULL COMMENT 'Identificador único para cada proveedor',
  `Prov_Tipo_Documento` varchar(45) NOT NULL COMMENT 'Tipo de documento del proveedor',
  `Prov_Numero_Documento` varchar(45) NOT NULL COMMENT 'Número de documento del proveedor',
  `Prov_Nombre` varchar(45) NOT NULL COMMENT 'Nombre del proveedor',
  `Prov_Telefono` varchar(45) NOT NULL COMMENT 'Teléfono del proveedor',
  `Prov_Direccion` varchar(45) NOT NULL COMMENT 'Dirección del proveedor',
  `Prov_Email` varchar(45) NOT NULL COMMENT 'Correo electrónico del proveedor',
  `Prov_Estado` varchar(45) NOT NULL COMMENT 'Estado del proveedor (Activo/Inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id_Rol` int(11) NOT NULL COMMENT 'Identificador único para cada rol',
  `Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del rol (Admin, Empleado, Cliente)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `Id_Servicio` int(11) NOT NULL COMMENT 'Identificador único para cada servicio',
  `Serv_Nombre` varchar(45) NOT NULL COMMENT 'Nombre del servicio',
  `Serv_Descripcion` varchar(255) NOT NULL COMMENT 'Descripción detallada del servicio',
  `Serv_Costo_del_Servicio` decimal(10,2) NOT NULL COMMENT 'Costo asociado al servicio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_operacion`
--

CREATE TABLE `tipo_operacion` (
  `Id_Op` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de operación',
  `Op_Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del tipo de operación (Entrada/Salida)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usu` int(11) NOT NULL COMMENT 'Identificador único para cada usuario',
  `Usu_Tipo_Documento` varchar(45) NOT NULL COMMENT 'Tipo de documento del usuario',
  `Usu_Numero_Documento` varchar(45) NOT NULL COMMENT 'Número de documento del usuario',
  `Usu_Nombre` varchar(45) NOT NULL COMMENT 'Nombre del usuario',
  `Usu_Apellido` varchar(45) NOT NULL COMMENT 'Apellido del usuario',
  `Usu_Telefono` varchar(45) NOT NULL COMMENT 'Teléfono del usuario',
  `Usu_Direccion` varchar(45) NOT NULL COMMENT 'Dirección del usuario',
  `Usu_Email` varchar(45) NOT NULL COMMENT 'Correo electrónico del usuario',
  `Usu_Password` varchar(255) NOT NULL COMMENT 'Contraseña del usuario (debería estar hasheada)',
  `Rol_Id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id_Cat`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`Id_Citas`),
  ADD KEY `Servicios_Id_Servicio` (`Servicios_Id_Servicio`),
  ADD KEY `Usuario_Id_Usu` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  ADD PRIMARY KEY (`Id_Operacion`),
  ADD KEY `Productos_Id_Pro` (`Productos_Id_Pro`),
  ADD KEY `Tipo_de_Operacion_Id_Op` (`Tipo_de_Operacion_Id_Op`),
  ADD KEY `Movimientos_Id_Movimiento` (`Movimientos_Id_Movimiento`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`Id_Diagnostico`);

--
-- Indices de la tabla `estado_producto`
--
ALTER TABLE `estado_producto`
  ADD PRIMARY KEY (`Id_EstadoP`);

--
-- Indices de la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  ADD PRIMARY KEY (`Id_Historia`),
  ADD KEY `Moto_Id_Mot` (`Moto_Id_Mot`),
  ADD KEY `Cita_Id_Citas` (`Cita_Id_Citas`);

--
-- Indices de la tabla `moto`
--
ALTER TABLE `moto`
  ADD PRIMARY KEY (`Id_Mot`),
  ADD KEY `Usuario_Id_Usu` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`Id_Movimiento`),
  ADD KEY `Tipo_de_Operacion_Id_Op` (`Tipo_de_Operacion_Id_Op`),
  ADD KEY `Usuario_Id_Usu` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Pro`),
  ADD KEY `Proveedores_Id_Prov` (`Proveedores_Id_Prov`),
  ADD KEY `Categoria_Id_Cat` (`Categoria_Id_Cat`),
  ADD KEY `Estado_Id_Estado` (`Estado_Id_Estado`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`Id_Prov`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`Id_Servicio`);

--
-- Indices de la tabla `tipo_operacion`
--
ALTER TABLE `tipo_operacion`
  ADD PRIMARY KEY (`Id_Op`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usu`),
  ADD KEY `Rol_Id_Rol` (`Rol_Id_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Cat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada categoría de producto';

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `Id_Citas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada cita';

--
-- AUTO_INCREMENT de la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  MODIFY `Id_Operacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada operación';

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `Id_Diagnostico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada diagnóstico';

--
-- AUTO_INCREMENT de la tabla `estado_producto`
--
ALTER TABLE `estado_producto`
  MODIFY `Id_EstadoP` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada estado de producto';

--
-- AUTO_INCREMENT de la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  MODIFY `Id_Historia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada registro histórico';

--
-- AUTO_INCREMENT de la tabla `moto`
--
ALTER TABLE `moto`
  MODIFY `Id_Mot` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada motocicleta';

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `Id_Movimiento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada movimiento';

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Pro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada producto';

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_Prov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada proveedor';

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada rol';

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id_Servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada servicio';

--
-- AUTO_INCREMENT de la tabla `tipo_operacion`
--
ALTER TABLE `tipo_operacion`
  MODIFY `Id_Op` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de operación';

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada usuario';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`Servicios_Id_Servicio`) REFERENCES `servicios` (`Id_Servicio`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`);

--
-- Filtros para la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  ADD CONSTRAINT `detalle_operacion_ibfk_1` FOREIGN KEY (`Productos_Id_Pro`) REFERENCES `productos` (`Id_Pro`),
  ADD CONSTRAINT `detalle_operacion_ibfk_2` FOREIGN KEY (`Tipo_de_Operacion_Id_Op`) REFERENCES `tipo_operacion` (`Id_Op`),
  ADD CONSTRAINT `detalle_operacion_ibfk_3` FOREIGN KEY (`Movimientos_Id_Movimiento`) REFERENCES `movimientos` (`Id_Movimiento`);

--
-- Filtros para la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  ADD CONSTRAINT `historia_moto_ibfk_1` FOREIGN KEY (`Moto_Id_Mot`) REFERENCES `moto` (`Id_Mot`),
  ADD CONSTRAINT `historia_moto_ibfk_2` FOREIGN KEY (`Cita_Id_Citas`) REFERENCES `cita` (`Id_Citas`);

--
-- Filtros para la tabla `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `moto_ibfk_1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`Tipo_de_Operacion_Id_Op`) REFERENCES `tipo_operacion` (`Id_Op`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Proveedores_Id_Prov`) REFERENCES `proveedores` (`Id_Prov`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`Categoria_Id_Cat`) REFERENCES `categoria` (`Id_Cat`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`Estado_Id_Estado`) REFERENCES `estado_producto` (`Id_EstadoP`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Rol_Id_Rol`) REFERENCES `rol` (`Id_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;