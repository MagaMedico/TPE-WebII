-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2020 a las 17:08:18
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito_de_compras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`, `categoria`) VALUES
(1, 'donadonna', 'Bijouterie Online'),
(2, 'Lunera acero', 'bijouterie mayorista'),
(3, 'gotergood', 'pulseras y brazaletes para hombres'),
(4, 'Rapsodia', 'variedad de accesorios'),
(5, 'Tiffany & Co.', 'agregada desde la pagina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `stock`, `descripcion`, `imagen`, `id_marca`) VALUES
(1, 'pulsera', 205, 23, 'pulsera elegante', 'img/pulsera1.jpg', 4),
(2, 'aros', 100, 20, 'aros perfecto para fiesta de noche', 'img/aros2.jpg', 2),
(3, 'pulsera de cuentas', 200, 15, 'colores bien brillantes', 'img/pulsera4.jpg', 5),
(4, 'colita fringes', 100, 8, 'ajuste delicado', '', 4),
(5, 'aros square', 300, 5, 'ideal para ir a una quinta', '', 1),
(6, 'mix choker+colgante', 300, 3, 'oferta imperdible', '', 2),
(7, 'collar bull', 300, 5, 'genial para todos los dias', 'img/pulsera7.jpg', 1),
(8, 'Collar zafiro', 240, 23, 'el colla de la marca', '', 4),
(9, 'aros hanna', 12122, 12, 'agregado desde la pagina', '', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `admin`) VALUES
(1, 'magamedico@gmail.com', '$2y$10$zJCL282zDJdwSfggMMHSNuikf0hxDZiwz9KckRW/G8D/ACxo8buq2', 1),
(2, 'usuario@publico', '$2y$10$zJCL282zDJdwSfggMMHSNuikf0hxDZiwz9KckRW/G8D/ACxo8buq2', 0),
(3, 'nuevo@publico', '$2y$10$2zE98Ld1qoyvldSyucCKYOda2CcVVvUAYUIBJyeyMZlzg8f.haE8i', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
