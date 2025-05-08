-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2024 a las 16:01:04
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
-- Base de datos: `piston`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id_Cat` int(11) NOT NULL COMMENT 'Un identificador único para cada operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de operaciones y facilitar su recuperación.',
  `Cat_Nombre` varchar(25) NOT NULL,
  `Cat_Descripcion` varchar(45) NOT NULL COMMENT 'Es la descripcion del tipo de operacion asignado si es entrada o salida de productos.',
  `Cat_Marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Id_Citas` int(11) NOT NULL COMMENT 'Un identificador único para cada cita en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.',
  `Cit_Fecha` date NOT NULL COMMENT 'La fecha en la que se ha programado la cita.\n',
  `Cit_Hora` time NOT NULL COMMENT 'La hora programada para la cita.',
  `Cit_Estado` varchar(45) NOT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id_Cotizacion` int(11) NOT NULL COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n',
  `Cot_Fecha` varchar(45) NOT NULL,
  `Cot_Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del servicio.\n',
  `Estado_Cotizacion_Id_EstadoCot` int(11) NOT NULL,
  `Diagnostico_Id_Diagnostico` int(11) NOT NULL,
  `Servicios_Id_Servicio` int(11) NOT NULL,
  `Cot_Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_operacion`
--

CREATE TABLE `detalle_operacion` (
  `Id_Operacion` int(11) NOT NULL COMMENT 'Un identificador único para cada tipo de operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de tipo de operación y facilitar su recuperación.',
  `Op_Cantidad` varchar(45) NOT NULL COMMENT 'La cantidad de producto o productos involucrados en la operación.\n',
  `Op_Fecha_Creacion` date NOT NULL COMMENT 'Fecha de creacion de la operación.\n',
  `Productos_Id_Pro` int(11) NOT NULL,
  `Movimientos_Id_Movimiento` int(11) NOT NULL,
  `Tipo_de_Operacion_Id_Op` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `Id_Diagnostico` int(11) NOT NULL COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n',
  `Diag_Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del servicio.\n',
  `Diag_Fecha` date NOT NULL,
  `Cita_Id_Citas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cotizacion`
--

CREATE TABLE `estado_cotizacion` (
  `Id_EstadoCot` int(11) NOT NULL COMMENT 'Un identificador único en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de roles y facilitar su recuperación.',
  `Estc_Descripcion` varchar(45) NOT NULL COMMENT 'Es la descripcion del rol asignado si es admin, cliente o empleado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_producto`
--

CREATE TABLE `estado_producto` (
  `Id_EstadoP` int(11) NOT NULL COMMENT 'Un identificador único en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de roles y facilitar su recuperación.',
  `Estp_Descripcion` varchar(20) NOT NULL COMMENT 'Es la descripcion del rol asignado si es admin, cliente o empleado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_moto`
--

CREATE TABLE `historia_moto` (
  `Id_Historia` int(11) NOT NULL COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n',
  `His_Fecha_arreglo` date NOT NULL COMMENT 'Costo asociado al servicio.',
  `His_Kilometraje_arreglo` int(11) NOT NULL,
  `His_Serv_Descripcion_Ini` varchar(45) NOT NULL,
  `His_Serv_Descripcion_Fin` varchar(45) NOT NULL,
  `His_Estado_Arreglo` varchar(45) NOT NULL,
  `Moto_Id_Mot` int(11) NOT NULL,
  `Cita_Id_Citas` int(11) NOT NULL,
  `Cotizacion_id_Cotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moto`
--

CREATE TABLE `moto` (
  `Id_Mot` int(11) NOT NULL COMMENT 'Un identificador único para cada motocicleta en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de motocicletas y facilitar su recuperación.',
  `Mot_Modelo` varchar(45) NOT NULL COMMENT 'El nombre o modelo específico de la motocicleta.',
  `Mot_Placa` varchar(45) NOT NULL COMMENT 'La matrícula o placa de identificación de la motocicleta.',
  `Mot_Marca` varchar(45) NOT NULL COMMENT ' El fabricante o marca de la motocicleta.',
  `Mot_Numero_serie` varchar(18) NOT NULL COMMENT ' Un número único asignado por el fabricante a cada motocicleta.\r\n',
  `Mot_Kilometraje` int(11) NOT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moto`
--

INSERT INTO `moto` (`Id_Mot`, `Mot_Modelo`, `Mot_Placa`, `Mot_Marca`, `Mot_Numero_serie`, `Mot_Kilometraje`, `Usuario_Id_Usu`) VALUES
(1, 'Pulsar RS200', 'ABC123', 'Bajaj', '1234567890123456', 10000, 2),
(2, 'NMAX 155', 'DEF456', 'Yamaha', '2345678901234567', 5000, 4),
(3, 'GSX-R1000', 'GHI789', 'Suzuki', '3456789012345678', 20000, 5),
(4, 'FZ-09', 'JKL012', 'Yamaha', '4567890123456789', 15000, 6),
(5, 'Ninja 300', 'MNO345', 'Kawasaki', '5678901234567890', 8000, 8),
(6, 'R6', 'PQR678', 'Yamaha', '6789012345678901', 12000, 9),
(7, 'Duke 390', 'STU901', 'KTM', '7890123456789012', 10000, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `Id_Movimiento` int(11) NOT NULL COMMENT 'Un identificador único para cada movimiento en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de movimientos y facilitar su recuperación.',
  `Mov_Total` varchar(45) NOT NULL COMMENT 'Total del movimientos realizados ',
  `Mov_Fecha` date NOT NULL COMMENT 'Fecha del movimiento.',
  `Usuario_Id_Usu1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Pro` int(11) NOT NULL COMMENT 'Es un identificador único que se asigna a cada producto en una base de datos. Este ID sirve como clave primaria para diferenciar un producto de otro y es fundamental para la organización y gestión de la información de los productos.\n',
  `Pro_Referencia` varchar(45) NOT NULL COMMENT 'La referencia de un repuesto es un código único asignado a cada artículo en una base de datos.',
  `Pro_Nombre` varchar(45) NOT NULL COMMENT 'Nombre del producto o repuesto.',
  `Pro_Stock` int(11) NOT NULL COMMENT 'Cantidad de stock disponible.',
  `Pro_Precio` int(11) NOT NULL COMMENT 'Precio del producto.',
  `Proveedores_Id_Prov` int(11) NOT NULL,
  `Categoria_Id_Cat` int(11) NOT NULL,
  `Estado_Id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_Prov` int(11) NOT NULL COMMENT 'Es un identificador único que se asigna a cada proveedor en una base de datos. Este ID sirve como clave primaria para diferenciar a un proveedor de otro y es fundamental para la organización y gestión de la información de los proveedores.',
  `Prov_Tipo_Documento` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL COMMENT 'Es el tipo de documento de identidad que posee el proveedor, como cédula de ciudadanía, pasaporte, tarjeta de identidad, cédula extranjera.',
  `Prov_Numero_Documento` varchar(45) NOT NULL COMMENT 'Número de documento del proveedor.',
  `Prov_Nombre` varchar(45) NOT NULL COMMENT 'Es el Nombre del proveedor.\n',
  `Prov_Telefono` varchar(45) NOT NULL COMMENT 'El número de teléfono del proveedor.',
  `Prov_Direccion` varchar(45) NOT NULL COMMENT ' Dirección del proveedor.',
  `Prov_Email` varchar(45) NOT NULL COMMENT 'Correo electrónico del proveedor.',
  `Prov_Estado` varchar(45) NOT NULL COMMENT 'Estado del proveedor, activo o inactivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id_Rol` int(11) NOT NULL COMMENT 'Un identificador único en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de roles y facilitar su recuperación.',
  `Rol_Descripcion` varchar(45) NOT NULL COMMENT 'Es la descripcion del rol asignado si es admin, cliente o empleado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id_Rol`, `Rol_Descripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `Id_Servicio` int(11) NOT NULL COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n',
  `Serv_Nombre` varchar(45) NOT NULL,
  `Serv_Descripcion` varchar(45) NOT NULL COMMENT 'Descripción del servicio.\n',
  `Serv_Costo_del_Servicio` int(11) NOT NULL COMMENT 'Costo asociado al servicio.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `Id_Op` int(11) NOT NULL COMMENT 'Un identificador único para cada operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de operaciones y facilitar su recuperación.',
  `Op_Descripcion` varchar(20) NOT NULL COMMENT 'Es la descripcion del tipo de operacion asignado si es entrada o salida de productos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usu` int(11) NOT NULL,
  `Usu_Tipo_Documento` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL COMMENT 'Es el tipo de documento de identidad que posee el usuario, como cédula de ciudadanía, pasaporte, tarjeta de identidad, cédula extranjera.',
  `Usu_Numero_Documento` varchar(45) NOT NULL COMMENT 'Es el numero asignado por el pais para cada persona.\n\n',
  `Usu_Nombre` varchar(45) NOT NULL COMMENT 'Es el nombre personal del usuario.\n',
  `Usu_Apellido` varchar(45) NOT NULL COMMENT 'Es el apellido familiar del usuario, apellido parterno.',
  `Usu_Telefono` varchar(45) NOT NULL COMMENT 'El número de teléfono del usuario.',
  `Usu_Direccion` varchar(45) NOT NULL COMMENT ' La dirección residencial del usuario.',
  `Usu_Email` varchar(45) NOT NULL COMMENT ' Correo electrónico del usuario.',
  `Usu_Password` varchar(45) NOT NULL COMMENT 'Contraseña del usuario.\n',
  `Rol_Id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usu`, `Usu_Tipo_Documento`, `Usu_Numero_Documento`, `Usu_Nombre`, `Usu_Apellido`, `Usu_Telefono`, `Usu_Direccion`, `Usu_Email`, `Usu_Password`, `Rol_Id_Rol`) VALUES
(1, 'CC', '123456789', 'Juan', 'Perez', '3123456789', 'Calle 123 # 45-67', 'juan.perez@email.com', '123456', 1),
(2, 'CE', '987654321', 'Maria', 'Gomez', '3012345678', 'Carrera 10 # 20-30', 'maria.gomez@email.com', '123456', 2),
(3, 'CC', '1234567890', 'Pedro', 'Lopez', '3101234567', 'Calle 50 # 60-70', 'pedro.lopez@email.com', '123456', 1),
(4, 'CC', '987654321', 'Ana', 'Martinez', '3123456789', 'Calle 10 # 20-30', 'ana.martinez@email.com', '123456', 2),
(5, 'CE', '1234567890', 'Carlos', 'Lopez', '3012345678', 'Carrera 15 # 40-50', 'carlos.lopez@email.com', '123456', 2),
(6, 'TI', '987654321', 'Laura', 'Gómez', '3101234567', 'Calle 50 # 60-70', 'laura.gomez@email.com', '123456', 2),
(7, 'CC', '123456789', 'David', 'Perez', '3123456789', 'Calle 123 # 45-67', 'david.perez@email.com', '123456', 1),
(8, 'CC', '987654321', 'Sandra', 'Martinez', '3012345678', 'Carrera 10 # 20-30', 'sandra.martinez@email.com', '123456', 2),
(9, 'CC', '1234567890', 'Andrés', 'Lopez', '3101234567', 'Calle 50 # 60-70', 'andres.lopez@email.com', '123456', 2),
(10, 'CC', '987654321', 'Carolina', 'Gómez', '3123456789', 'Calle 123 # 45-67', 'carolina.gomez@email.com', '123456', 2);

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
  ADD KEY `fk_Cita_Usuario1_idx` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_Cotizacion`),
  ADD KEY `fk_Cotizacion_Estado_Cotizacion1_idx` (`Estado_Cotizacion_Id_EstadoCot`),
  ADD KEY `fk_Cotizacion_Diagnostico1_idx` (`Diagnostico_Id_Diagnostico`),
  ADD KEY `fk_Cotizacion_Servicios1_idx` (`Servicios_Id_Servicio`);

--
-- Indices de la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  ADD PRIMARY KEY (`Id_Operacion`),
  ADD KEY `fk_Detalle_Operacion_Productos1_idx` (`Productos_Id_Pro`),
  ADD KEY `fk_Detalle_Operacion_Movimientos1_idx` (`Movimientos_Id_Movimiento`),
  ADD KEY `fk_Detalle_Operacion_Tipo_de_Operacion1_idx` (`Tipo_de_Operacion_Id_Op`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`Id_Diagnostico`),
  ADD KEY `fk_Diagnostico_Cita1_idx` (`Cita_Id_Citas`);

--
-- Indices de la tabla `estado_cotizacion`
--
ALTER TABLE `estado_cotizacion`
  ADD PRIMARY KEY (`Id_EstadoCot`);

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
  ADD KEY `fk_Historia_Moto_Moto1_idx` (`Moto_Id_Mot`),
  ADD KEY `fk_Historia_Moto_Cita1_idx` (`Cita_Id_Citas`),
  ADD KEY `fk_Historia_Moto_Cotizacion1_idx` (`Cotizacion_id_Cotizacion`);

--
-- Indices de la tabla `moto`
--
ALTER TABLE `moto`
  ADD PRIMARY KEY (`Id_Mot`),
  ADD KEY `fk_Moto_Usuario1_idx` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`Id_Movimiento`),
  ADD KEY `fk_Movimientos_Usuario1_idx` (`Usuario_Id_Usu1`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Pro`),
  ADD KEY `fk_Productos_Proveedores1_idx` (`Proveedores_Id_Prov`),
  ADD KEY `fk_Productos_Categoria1_idx` (`Categoria_Id_Cat`),
  ADD KEY `fk_Productos_Estado1_idx` (`Estado_Id_Estado`);

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
-- Indices de la tabla `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  ADD PRIMARY KEY (`Id_Op`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usu`),
  ADD KEY `fk_Usuario_Rol1_idx` (`Rol_Id_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Cat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de operaciones y facilitar su recuperación.';

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_Cotizacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n';

--
-- AUTO_INCREMENT de la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  MODIFY `Id_Operacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada tipo de operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de tipo de operación y facilitar su recuperación.';

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `Id_Diagnostico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n';

--
-- AUTO_INCREMENT de la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  MODIFY `Id_Historia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n';

--
-- AUTO_INCREMENT de la tabla `moto`
--
ALTER TABLE `moto`
  MODIFY `Id_Mot` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada motocicleta en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de motocicletas y facilitar su recuperación.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `Id_Movimiento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada movimiento en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de movimientos y facilitar su recuperación.';

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Pro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es un identificador único que se asigna a cada producto en una base de datos. Este ID sirve como clave primaria para diferenciar un producto de otro y es fundamental para la organización y gestión de la información de los productos.\n';

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_Prov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es un identificador único que se asigna a cada proveedor en una base de datos. Este ID sirve como clave primaria para diferenciar a un proveedor de otro y es fundamental para la organización y gestión de la información de los proveedores.';

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id_Servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada servicio en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de citas y facilitar su recuperación.\n\n';

--
-- AUTO_INCREMENT de la tabla `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `Id_Op` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un identificador único para cada operación en la base de datos. Este campo es esencial para garantizar la unicidad de los registros de operaciones y facilitar su recuperación.';

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_Cita_Usuario1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `fk_Cotizacion_Diagnostico1` FOREIGN KEY (`Diagnostico_Id_Diagnostico`) REFERENCES `diagnostico` (`Id_Diagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cotizacion_Estado_Cotizacion1` FOREIGN KEY (`Estado_Cotizacion_Id_EstadoCot`) REFERENCES `estado_cotizacion` (`Id_EstadoCot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cotizacion_Servicios1` FOREIGN KEY (`Servicios_Id_Servicio`) REFERENCES `servicios` (`Id_Servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  ADD CONSTRAINT `fk_Detalle_Operacion_Movimientos1` FOREIGN KEY (`Movimientos_Id_Movimiento`) REFERENCES `movimientos` (`Id_Movimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Detalle_Operacion_Productos1` FOREIGN KEY (`Productos_Id_Pro`) REFERENCES `productos` (`Id_Pro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Detalle_Operacion_Tipo_de_Operacion1` FOREIGN KEY (`Tipo_de_Operacion_Id_Op`) REFERENCES `tipo_de_operacion` (`Id_Op`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `fk_Diagnostico_Cita1` FOREIGN KEY (`Cita_Id_Citas`) REFERENCES `cita` (`Id_Citas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  ADD CONSTRAINT `fk_Historia_Moto_Cita1` FOREIGN KEY (`Cita_Id_Citas`) REFERENCES `cita` (`Id_Citas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Historia_Moto_Cotizacion1` FOREIGN KEY (`Cotizacion_id_Cotizacion`) REFERENCES `cotizacion` (`id_Cotizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Historia_Moto_Moto1` FOREIGN KEY (`Moto_Id_Mot`) REFERENCES `moto` (`Id_Mot`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `fk_Moto_Usuario1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_Movimientos_Usuario1` FOREIGN KEY (`Usuario_Id_Usu1`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Categoria1` FOREIGN KEY (`Categoria_Id_Cat`) REFERENCES `categoria` (`Id_Cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Estado1` FOREIGN KEY (`Estado_Id_Estado`) REFERENCES `estado_producto` (`Id_EstadoP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Proveedores1` FOREIGN KEY (`Proveedores_Id_Prov`) REFERENCES `proveedores` (`Id_Prov`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`Rol_Id_Rol`) REFERENCES `rol` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
