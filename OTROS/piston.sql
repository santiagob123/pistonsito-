-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2024 a las 05:41:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarEstadoProducto` (IN `ProdID` INT, IN `NuevoEstado` INT)   BEGIN
    UPDATE productos 
    SET Id_EstadoP = NuevoEstado 
    WHERE Id_Pro = ProdID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarProveedor` (IN `Prov_NIT` INT, IN `Prov_Nombre` VARCHAR(45), IN `Prov_Telefono` VARCHAR(15), IN `Prov_Direccion` VARCHAR(45), IN `Prov_Email` VARCHAR(45))   BEGIN
    INSERT INTO proveedores (Prov_Numero_NIT, Prov_Nombre, Prov_Telefono, Prov_Direccion, Prov_Email, Prov_Estado)
    VALUES (Prov_NIT, Prov_Nombre, Prov_Telefono, Prov_Direccion, Prov_Email, 'Activo');
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `InventarioPorCategoria` (`CatId` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE total INT DEFAULT 0;
    SELECT COUNT(*) INTO total FROM productos WHERE Categoria_Id_Cat = CatId;
    RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `ObtenerCategoria` (`Id` INT) RETURNS VARCHAR(25) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE CatNombre VARCHAR(25) DEFAULT '';
    SELECT Cat_Nombre INTO CatNombre FROM categoria WHERE Id_Cat = Id;
    RETURN CatNombre;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id_Cat` int(11) NOT NULL,
  `Cat_Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Id_Cat`, `Cat_Nombre`) VALUES
(1, 'Motores'),
(2, 'Transmisiones'),
(3, 'Suspensiones'),
(4, 'Frenos'),
(5, 'Sistemas eléctricos'),
(6, 'Llantas y neumáticos'),
(7, 'Piezas de carrocería'),
(8, 'Accesorios'),
(9, 'Herramientas'),
(10, 'Kits de reparación'),
(11, 'Aceites'),
(12, 'Motor otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Id_Citas` int(11) NOT NULL,
  `Cit_Fecha` date NOT NULL,
  `Cit_Hora` time NOT NULL,
  `Id_estadoCita` int(11) DEFAULT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`Id_Citas`, `Cit_Fecha`, `Cit_Hora`, `Id_estadoCita`, `Usuario_Id_Usu`) VALUES
(1, '2024-07-25', '10:00:00', 3, 2),
(2, '2024-07-25', '11:30:00', 2, 4),
(3, '2024-07-27', '14:00:00', 2, 5),
(4, '2024-07-28', '09:00:00', 1, 6),
(5, '2024-07-29', '12:00:00', 1, 8),
(6, '2024-07-30', '15:30:00', 1, 9),
(7, '2024-08-01', '10:00:00', 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id_Cotizacion` int(11) NOT NULL COMMENT '\r\n',
  `Cot_Fecha` varchar(45) NOT NULL,
  `Cot_Descripcion` varchar(150) NOT NULL,
  `Id_EstadoCot` int(11) NOT NULL,
  `Diagnostico_Id_Diagnostico` int(11) NOT NULL,
  `Servicios_Id_Servicio` int(11) NOT NULL,
  `Cot_CantidadServ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id_Cotizacion`, `Cot_Fecha`, `Cot_Descripcion`, `Id_EstadoCot`, `Diagnostico_Id_Diagnostico`, `Servicios_Id_Servicio`, `Cot_CantidadServ`) VALUES
(1, '2024-07-25', 'Cambio de aceite para motocicleta Bajaj Pulsar RS200', 2, 1, 2, 1),
(2, '2024-07-26', 'Reparación de Motor para motocicleta Yamaha NMAX 155', 1, 2, 16, 1),
(3, '2024-07-27', 'Sincronización de carburadores para motocicleta Suzuki GSX-R1000', 4, 3, 9, 1),
(4, '2024-07-28', 'Revisión y ajuste de suspensión delantera para motocicleta Yamaha FZ-09', 3, 4, 4, 1),
(5, '2024-07-29', 'Cambio de sistema electrico para motocicleta Kawasaki Ninja 300', 3, 5, 5, 1),
(6, '2024-07-30', 'Cambio de llanta trasera para motocicleta Yamaha R6', 5, 6, 6, 1),
(7, '2024-08-01', 'Lavado, engrase y revisión general de motocicleta KTM Duke 390', 7, 7, 15, 1),
(8, '2024-07-27', 'Sincronización de carburadores para motocicleta Suzuki GSX-R1000', 4, 3, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_operacion`
--

CREATE TABLE `detalle_operacion` (
  `Id_Operacion` int(11) NOT NULL,
  `Op_Cantidad` varchar(45) NOT NULL,
  `Op_Fecha_Creacion` date NOT NULL,
  `Productos_Id_Pro` int(11) NOT NULL,
  `Movimientos_Id_Movimiento` int(11) NOT NULL,
  `Tipo_de_Operacion_Id_Op` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_operacion`
--

INSERT INTO `detalle_operacion` (`Id_Operacion`, `Op_Cantidad`, `Op_Fecha_Creacion`, `Productos_Id_Pro`, `Movimientos_Id_Movimiento`, `Tipo_de_Operacion_Id_Op`) VALUES
(1, '1', '2024-07-20', 1, 1, 1),
(2, '2', '2024-07-20', 2, 1, 2),
(3, '3', '2024-07-21', 3, 2, 3),
(4, '1', '2024-07-21', 4, 2, 1),
(5, '2', '2024-07-22', 5, 3, 2),
(6, '3', '2024-07-22', 6, 3, 3),
(7, '1', '2024-07-24', 7, 4, 1),
(8, '2', '2024-07-25', 8, 5, 2),
(9, '3', '2024-07-26', 9, 6, 3),
(10, '1', '2024-07-27', 10, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `Id_Diagnostico` int(11) NOT NULL COMMENT '\r\n',
  `Diag_Descripcion` varchar(45) NOT NULL,
  `Diag_Fecha` date NOT NULL,
  `Cita_Id_Citas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`Id_Diagnostico`, `Diag_Descripcion`, `Diag_Fecha`, `Cita_Id_Citas`) VALUES
(1, 'Revisión general', '2024-07-25', 1),
(2, 'Ruido extraño en el motor', '2024-07-26', 2),
(3, 'Dificultad para arrancar', '2024-07-27', 3),
(4, 'Pérdida de potencia', '2024-07-28', 4),
(5, 'Falla en el sistema eléctrico', '2024-07-29', 5),
(6, 'Desgaste excesivo en los neumáticos', '2024-07-30', 6),
(7, 'Fugas de aceite', '2024-08-01', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cita`
--

CREATE TABLE `estado_cita` (
  `Id_EstadoCit` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_cita`
--

INSERT INTO `estado_cita` (`Id_EstadoCit`, `Descripcion`) VALUES
(1, 'Atendida'),
(2, 'Confirmada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cotizacion`
--

CREATE TABLE `estado_cotizacion` (
  `Id_EstadoCot` int(11) NOT NULL,
  `Estc_Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_cotizacion`
--

INSERT INTO `estado_cotizacion` (`Id_EstadoCot`, `Estc_Descripcion`) VALUES
(1, 'Pendiente'),
(2, 'Enviada'),
(3, 'Aprobada'),
(4, 'Rechazada'),
(5, 'Aprobada con modificaciones'),
(6, 'En espera de pago'),
(7, 'Pagada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_producto`
--

CREATE TABLE `estado_producto` (
  `Id_EstadoP` int(11) NOT NULL,
  `Estp_Descripcion` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_producto`
--

INSERT INTO `estado_producto` (`Id_EstadoP`, `Estp_Descripcion`) VALUES
(1, 'Existencias altas'),
(2, 'Existencias bajas'),
(3, 'Existencias no disponibles'),
(4, 'Producto inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_moto`
--

CREATE TABLE `historia_moto` (
  `Id_Historia` int(11) NOT NULL COMMENT '\r\n',
  `His_Fecha_arreglo` date NOT NULL,
  `His_Kilometraje_arreglo` int(11) NOT NULL,
  `His_Serv_Descripcion_Ini` varchar(250) NOT NULL,
  `His_Serv_Descripcion_Fin` varchar(250) NOT NULL,
  `His_Estado_Arreglo` varchar(45) NOT NULL,
  `Moto_Id_Mot` int(11) NOT NULL,
  `Cita_Id_Citas` int(11) NOT NULL,
  `id_Diagnostico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historia_moto`
--

INSERT INTO `historia_moto` (`Id_Historia`, `His_Fecha_arreglo`, `His_Kilometraje_arreglo`, `His_Serv_Descripcion_Ini`, `His_Serv_Descripcion_Fin`, `His_Estado_Arreglo`, `Moto_Id_Mot`, `Cita_Id_Citas`, `id_Diagnostico`) VALUES
(1, '2024-07-26', 23456, 'Revisión general y cambio de aceite', 'Revisión completa, cambio de aceite sintético 10W40, filtro de aceite y filtro de aire', 'En proceso', 1, 1, 1),
(2, '2024-07-27', 18900, 'Reparación de Motor ', 'Reemplazo de Valvulas y pistones, limpieza y ajuste de motor', 'Completado', 2, 2, 2),
(3, '2024-07-28', 32000, 'Ajuste de embrague y sincronización de carburadores', 'Ajuste de embrague, sincronización de carburadores y limpieza de bujías', 'Completado', 3, 3, 3),
(4, '2024-07-29', 15678, 'Revisión y ajuste de suspensión delantera', 'Revisión de horquilla delantera, ajuste de precarga y rebote', 'En proceso', 4, 4, 4),
(5, '2024-07-30', 9876, 'Cambio de sistema electrico', 'Reemplazo de sistema electrico', 'Completado', 5, 5, 5),
(6, '2024-08-01', 4321, 'Cambio de llantas delanteras y traseras', 'Reemplazo de llantas delanteras y traseras, balanceo y alineación', 'En proceso', 6, 6, 6),
(7, '2024-08-02', 7654, 'Lavado, engrase y revisión general', 'Lavado completo, engrase de puntos vitales, revisión de niveles y luces', 'Completado', 7, 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moto`
--

CREATE TABLE `moto` (
  `Id_Mot` int(11) NOT NULL,
  `Mot_Modelo` varchar(45) NOT NULL,
  `Mot_Placa` varchar(45) NOT NULL,
  `Mot_Marca` varchar(45) NOT NULL,
  `Mot_Numero_serie` varchar(18) NOT NULL,
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
  `Id_Movimiento` int(11) NOT NULL,
  `Mov_Total` varchar(45) NOT NULL,
  `Mov_Fecha` date NOT NULL,
  `Usuario_Id_Usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`Id_Movimiento`, `Mov_Total`, `Mov_Fecha`, `Usuario_Id_Usu`) VALUES
(1, '2', '2024-07-19', 1),
(2, '2', '2024-07-20', 3),
(3, '2', '2024-07-21', 3),
(4, '1', '2024-07-22', 3),
(5, '1', '2024-07-23', 7),
(6, '1', '2024-07-24', 1),
(7, '1', '2024-07-25', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Pro` int(11) NOT NULL,
  `Pro_ProductoRef` varchar(45) NOT NULL,
  `Pro_Nombre` varchar(45) NOT NULL,
  `Pro_Stock` int(11) NOT NULL,
  `Pro_Precio` int(11) NOT NULL,
  `Pro_marca` varchar(35) NOT NULL,
  `Proveedores_Id_Prov` int(11) NOT NULL,
  `Categoria_Id_Cat` int(11) NOT NULL,
  `Id_EstadoP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_Pro`, `Pro_ProductoRef`, `Pro_Nombre`, `Pro_Stock`, `Pro_Precio`, `Pro_marca`, `Proveedores_Id_Prov`, `Categoria_Id_Cat`, `Id_EstadoP`) VALUES
(1, 'REF1238', 'Filtro de aceite', 18, 15000, 'Suzuki Genuine Parts', 10, 1, 1),
(2, 'REF5678', 'Pastillas de freno delanteras', 15, 30000, 'Honda Genuine Parts', 3, 4, 1),
(3, 'REF9012', 'Kit de embrague', 10, 80000, 'Yamaha Genuine Parts', 5, 10, 2),
(4, 'REF2345', 'Llantas traseras', 4, 120000, 'Kawasaki Genuine Parts', 7, 6, 2),
(5, 'REF6789', 'Cadena de transmisión', 8, 25000, 'Bajaj Genuine Parts', 8, 2, 1),
(6, 'REF0123', 'Bujías', 12, 10000, 'Kymco Genuine Parts', 3, 12, 1),
(7, 'REF3456', 'Espejos retrovisores', 18, 8000, 'SYM Genuine Parts', 9, 8, 4),
(8, 'REF7890', 'Batería', 6, 150000, 'TVS Genuine Parts', 10, 5, 2),
(9, 'REF12345', 'Manubrio', 0, 25000, 'Piaggio Genuine Parts', 5, 7, 3),
(10, 'REF56789', 'Suspensión delantera', 0, 180000, 'Hero Genuine Parts', 3, 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `Id_Prov` int(11) NOT NULL,
  `Prov_Numero_NIT` int(11) NOT NULL,
  `Prov_Nombre` varchar(45) NOT NULL,
  `Prov_Telefono` varchar(45) NOT NULL,
  `Prov_Direccion` varchar(45) NOT NULL,
  `Prov_Email` varchar(45) NOT NULL,
  `Prov_Estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`Id_Prov`, `Prov_Numero_NIT`, `Prov_Nombre`, `Prov_Telefono`, `Prov_Direccion`, `Prov_Email`, `Prov_Estado`) VALUES
(1, 123456789, 'Repuestos Moto ABC', '+57 312 3456789', 'Calle 10 # 12-34, Bogotá, Colombia', 'repuestosmotoabc@ejemplo.com', 'Activo'),
(2, 987654321, 'Motos El Rápido', '+57 310 9876543', 'Carrera 15 # 23-45, Medellín, Colombia', 'motoseldrapido@ejemplo.com', 'Activo'),
(3, 1000000001, 'Repuestos Originales', '+57 311 1234567', 'Avenida Jiménez # 56-78, Cali, Colombia', 'repuestosoriginales@ejemplo.com', 'Activo'),
(4, 234567890, 'Moto Partes Express', '+57 313 2345678', 'Diagonal 70 # 90-12, Barranquilla, Colombia', 'motopartexpress@ejemplo.com', 'Activo'),
(5, 345678901, 'Repuestos Moto Fácil', '+57 314 3456789', 'Calle 50 # 13-15, Bucaramanga, Colombia', 'repuestosmotofacil@ejemplo.com', 'Activo'),
(6, 2000000002, 'Suministros Moto', '+57 315 4567890', 'Carrera 40 # 16-18, Cartagena, Colombia', 'suministrosmoto@ejemplo.com', 'Activo'),
(7, 456789012, 'Moto Repuestos Económicos', '+57 316 5678901', 'Avenida Pedro de Heredia # 19-21, Santa Marta', 'motorepuestoseconmicos@ejemplo.com', 'Activo'),
(8, 567890123, 'Repuestos Moto Elite', '+57 317 6789012', 'Calle Real # 22-24, Montería, Colombia', 'repuestosmotoelite@ejemplo.com', 'Activo'),
(9, 2147483647, 'Moto Partes del Sur', '+57 318 7890123', 'Carrera 7 # 25-27, Neiva, Colombia', 'motopartedessur@ejemplo.com', 'Activo'),
(10, 678901234, 'Repuestos Moto Importados', '+57 319 8901234', 'Avenida Ambalá # 28-30, Villavicencio, Colomb', 'repuestosmotoimportados@ejemplo.com', 'Activo'),
(11, 1029143013, 'Hermanos Ortega', '3053055073', 'Cra 5', 'Hermanos@ejemplo.com', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id_Rol` int(11) NOT NULL,
  `Rol_Descripcion` varchar(45) NOT NULL
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
  `Id_Servicio` int(11) NOT NULL COMMENT '\r\n',
  `Serv_Nombre` varchar(45) NOT NULL,
  `Serv_Descripcion` varchar(150) NOT NULL,
  `Serv_Costo_del_Servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`Id_Servicio`, `Serv_Nombre`, `Serv_Descripcion`, `Serv_Costo_del_Servicio`) VALUES
(1, 'Revisión general', 'Revisión completa del estado mecánico de la motocicleta, incluyendo motor, transmisión, frenos, suspensión, sistema eléctrico y neumáticos.', 50000),
(2, 'Cambio de aceite', 'Reemplazo del aceite del motor y filtro de aceite, siguiendo las recomendaciones del fabricante.', 30000),
(3, 'Ajuste de frenos', 'Revisión y ajuste del sistema de frenos, incluyendo pastillas, discos y líquido de frenos.', 25000),
(4, 'Revisión de suspensión', 'Inspección y ajuste de la suspensión delantera y trasera, asegurando un manejo óptimo de la motocicleta.', 20000),
(5, 'Revisión del sistema eléctrico', 'Verificación del correcto funcionamiento del sistema eléctrico, incluyendo batería, luces, indicadores y cableado.', 25000),
(6, 'Cambio de llantas', 'Reemplazo de las llantas delanteras y/o traseras, asegurando un agarre adecuado y seguridad en la conducción.', 40000),
(7, 'Ajuste de embrague', 'Regulación del embrague para garantizar un cambio de marchas suave y preciso.', 15000),
(8, 'Limpieza de carburador', 'Desmontaje, limpieza y ajuste del carburador para optimizar el rendimiento del motor.', 20000),
(9, 'Sincronización de carburadores', 'Ajuste preciso de los carburadores para asegurar una combustión uniforme y un funcionamiento equilibrado del motor.', 30000),
(10, 'Revisión de bujías', 'Inspección y reemplazo de las bujías si es necesario, para asegurar una ignición adecuada y un buen rendimiento del motor.', 10000),
(11, 'Ajuste de válvulas', 'Regulación del juego de válvulas para garantizar un funcionamiento óptimo del motor y reducir el desgaste.', 40000),
(12, 'Revisión de cadena de transmisión', 'Inspección y ajuste de la tensión de la cadena de transmisión, asegurando una transmisión de potencia eficiente.', 15000),
(13, 'Lubricaión general', 'Engrase de puntos de pivote, cables y demás componentes que requieren lubricación para un funcionamiento suave y duradero.', 10000),
(14, 'Revisión de filtro de aire', 'Inspección y reemplazo del filtro de aire si es necesario, para asegurar un flujo de aire adecuado al motor.', 10000),
(15, 'Lavado y engrase de moto', 'Limpieza profunda de la motocicleta, incluyendo motor, carrocería, llantas y componentes, seguido de engrase de puntos específicos.', 30000),
(16, 'Reparación de Motor', 'Desmontaje, limpieza y ajuste del motor para optimizar el rendimiento.', 60000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `Id_Op` int(11) NOT NULL,
  `Op_Descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_operacion`
--

INSERT INTO `tipo_de_operacion` (`Id_Op`, `Op_Descripcion`) VALUES
(1, 'Entrada'),
(2, 'Salida'),
(3, 'Devolución ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usu` int(11) NOT NULL,
  `Usu_Tipo_Documento` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `Usu_Numero_Documento` varchar(45) NOT NULL COMMENT '\r\n',
  `Usu_Nombre` varchar(45) NOT NULL,
  `Usu_Apellido` varchar(45) NOT NULL,
  `Usu_Telefono` varchar(45) NOT NULL,
  `Usu_Direccion` varchar(45) NOT NULL,
  `Usu_Email` varchar(45) NOT NULL,
  `Id_Usupass` int(11) DEFAULT NULL,
  `Rol_Id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usu`, `Usu_Tipo_Documento`, `Usu_Numero_Documento`, `Usu_Nombre`, `Usu_Apellido`, `Usu_Telefono`, `Usu_Direccion`, `Usu_Email`, `Id_Usupass`, `Rol_Id_Rol`) VALUES
(1, 'CC', '123456789', 'Juan', 'Perez', '3123456789', 'Calle 123 # 45-67', 'juan.perez@gmail.com', 1, 1),
(2, 'CE', '987654321', 'Maria', 'Gomez', '3012345678', 'Carrera 10 # 20-30', 'maria.gomez@email.com', 2, 2),
(3, 'CC', '1234567890', 'Pedro', 'Lopez', '3101234567', 'Calle 50 # 60-70', 'pedro.lopez@email.com', 3, 1),
(4, 'CC', '987654321', 'Ana', 'Martinez', '3123456789', 'Calle 10 # 20-30', 'ana.martinez@email.com', 4, 2),
(5, 'CE', '1234567890', 'Carlos', 'Lopez', '3012345678', 'Carrera 15 # 40-50', 'carlos.lopez@email.com', 5, 2),
(6, 'TI', '987654321', 'Laura', 'Gómez', '3101234567', 'Calle 50 # 60-70', 'laura.gomez@email.com', 6, 2),
(7, 'CC', '123456789', 'David', 'Perez', '3123456789', 'Calle 123 # 45-67', 'david.perez@email.com', 7, 1),
(8, 'CC', '987654321', 'Sandra', 'Martinez', '3012345678', 'Carrera 10 # 20-30', 'sandra.martinez@email.com', 8, 2),
(9, 'CC', '1234567890', 'Andrés', 'Lopez', '3101234567', 'Calle 50 # 60-70', 'andres.lopez@email.com', 9, 2),
(10, 'CC', '987654321', 'Carolina', 'Gómez', '3123456789', 'Calle 123 # 45-67', 'carolina.gomez@email.com', 10, 2),
(17, 'CC', '1022947165', 'Santiago', 'Forero', '3103487220', 'Carrera 10 # 20-39', 'Galindo560@gmail.com', 17, 2),
(18, 'CC', '1140915162', 'Santiago', 'Forero', '3103487220', 'Carrera 10 # 20-39', '123@gmail.com', 18, 2),
(19, 'CC', '11409151621', 'Santiago', 'Forero', '3103487220', 'Carrera 10 # 20-39', 'Galindo5600@gmail.com', 19, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_password`
--

CREATE TABLE `usuario_password` (
  `Id_Usupass` int(11) NOT NULL,
  `password` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_password`
--

INSERT INTO `usuario_password` (`Id_Usupass`, `password`) VALUES
(1, 0xb1a52d94750749db5646ef871c389a79),
(2, 0xedc1ea3f4e0d1fe0883055bc0e714f78d0288a5dd4abadd487584c0b2c4d1fad),
(3, 0x86b47e4fd5c1dfd906749abcb63618d2d4649bbf93f5447d55ea619ce0777c8f),
(4, 0xeda000ee07d070554943d3abb8806cb0d0810f9ab535213bee053f0eae9ebf60),
(5, 0x1b71ead66ca29c92f5f2bf7b934636e5c2844e54b481440d0879e969bcce9ac7),
(6, 0xc2939c0f231324f2393265f668eba8e1),
(7, 0x1e83f36731c6b94e8bfcbe1a9d758356),
(8, 0xe0e8c14c78d5788403daccbb6c127df9),
(9, 0x81bdb6c8ce7e928c49499553f95a80d4),
(10, 0x1b1d10b255d9127ef608a40754f804e1),
(11, 0x24327924313024736578736573595364726863666d4e6c56765148317578516b314d4758644a2e4c532e365a366b6565786470727374596c32755432),
(12, 0x2432792431302434666a69316f6f424650554f6d636655554a2f2e694f612e543276624577634c58654858674e4e38626f542e664f38726868757347),
(13, 0x243279243130246b56434e73324a474d386a6b4241695155354377446556727a6358524c5a34626e34375867746a77644653337475752f7a55464f61),
(14, 0x243279243130244e4b57456270462e5245726d4c3170333747545734754e7155544c3257757a6e4171487a796a2e554d76314a4c666c79684f4b7553),
(15, 0x243279243130244171726655452f2e30792f342f453147623531524d2e57664355644258453744373878475978314a494f53536c7952507871697569),
(16, 0x24327924313024484643332e7158777047414d536a62516c6875666b4f504c4f694d3666494e695741366f5a3735746b6c457770514e77334d537979),
(17, 0x2432792431302453795a584542686d33616d3139394e4d6c456770632e6d784c3762657a6d54422f6c42535457325749334862484467636261394d43),
(18, 0x243279243130244a44414430304d6d316f31636d374e796f397a6c724f5335544431464936465173356d563364506643382f356f48384338534e566d),
(19, 0x243279243130243475347a7a2e576369477a79446263554b44497458656378426e6d5475756f51564344512f777462644434594a784c516343344565);

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
  ADD KEY `fk_Cita_Usuario1_idx` (`Usuario_Id_Usu`),
  ADD KEY `Id_estadoCita` (`Id_estadoCita`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_Cotizacion`),
  ADD KEY `fk_Cotizacion_Estado_Cotizacion1_idx` (`Id_EstadoCot`),
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
-- Indices de la tabla `estado_cita`
--
ALTER TABLE `estado_cita`
  ADD PRIMARY KEY (`Id_EstadoCit`);

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
  ADD KEY `id_Diagnostico` (`id_Diagnostico`);

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
  ADD KEY `fk_Movimientos_Usuario1_idx` (`Usuario_Id_Usu`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Pro`),
  ADD KEY `fk_Productos_Proveedores1_idx` (`Proveedores_Id_Prov`),
  ADD KEY `fk_Productos_Categoria1_idx` (`Categoria_Id_Cat`),
  ADD KEY `fk_Productos_Estado1_idx` (`Id_EstadoP`);

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
  ADD KEY `fk_Usuario_Rol1_idx` (`Rol_Id_Rol`),
  ADD KEY `Id_Usupass` (`Id_Usupass`);

--
-- Indices de la tabla `usuario_password`
--
ALTER TABLE `usuario_password`
  ADD PRIMARY KEY (`Id_Usupass`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `Id_Citas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_Cotizacion` int(11) NOT NULL AUTO_INCREMENT COMMENT '\r\n', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_operacion`
--
ALTER TABLE `detalle_operacion`
  MODIFY `Id_Operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `Id_Diagnostico` int(11) NOT NULL AUTO_INCREMENT COMMENT '\r\n', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado_cita`
--
ALTER TABLE `estado_cita`
  MODIFY `Id_EstadoCit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historia_moto`
--
ALTER TABLE `historia_moto`
  MODIFY `Id_Historia` int(11) NOT NULL AUTO_INCREMENT COMMENT '\r\n', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `moto`
--
ALTER TABLE `moto`
  MODIFY `Id_Mot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `Id_Movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `Id_Prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `Id_Servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT '\r\n', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `Id_Op` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario_password`
--
ALTER TABLE `usuario_password`
  MODIFY `Id_Usupass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`Id_estadoCita`) REFERENCES `estado_cita` (`Id_EstadoCit`),
  ADD CONSTRAINT `fk_Cita_Usuario1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `fk_Cotizacion_Diagnostico1` FOREIGN KEY (`Diagnostico_Id_Diagnostico`) REFERENCES `diagnostico` (`Id_Diagnostico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cotizacion_Estado_Cotizacion1` FOREIGN KEY (`Id_EstadoCot`) REFERENCES `estado_cotizacion` (`Id_EstadoCot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_Historia_Moto_Moto1` FOREIGN KEY (`Moto_Id_Mot`) REFERENCES `moto` (`Id_Mot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `historia_moto_ibfk_1` FOREIGN KEY (`id_Diagnostico`) REFERENCES `diagnostico` (`Id_Diagnostico`);

--
-- Filtros para la tabla `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `fk_Moto_Usuario1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_Movimientos_Usuario1` FOREIGN KEY (`Usuario_Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Categoria1` FOREIGN KEY (`Categoria_Id_Cat`) REFERENCES `categoria` (`Id_Cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Estado1` FOREIGN KEY (`Id_EstadoP`) REFERENCES `estado_producto` (`Id_EstadoP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Productos_Proveedores1` FOREIGN KEY (`Proveedores_Id_Prov`) REFERENCES `proveedores` (`Id_Prov`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`Rol_Id_Rol`) REFERENCES `rol` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_Usupass`) REFERENCES `usuario_password` (`Id_Usupass`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
