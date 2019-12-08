-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2019 a las 17:41:58
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gastos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_com_pub`
--

CREATE TABLE `c_com_pub` (
  `id_gasto` int(4) NOT NULL,
  `cuantia` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_com_pub`
--

INSERT INTO `c_com_pub` (`id_gasto`, `cuantia`) VALUES
(1, '5'),
(2, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(4) NOT NULL,
  `id_usuario` int(3) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `tipo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `id_usuario`, `descripcion`, `fecha`, `tipo`) VALUES
(1, 2, 'comida', '2019-11-28', 1),
(2, 2, 'transporte publico', '2019-11-28', 3),
(3, 2, 'viaje', '2019-11-28', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_fijo`
--

CREATE TABLE `grupo_fijo` (
  `id_grupo` int(4) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `pkm` decimal(8,0) NOT NULL,
  `denominacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_fijo`
--

INSERT INTO `grupo_fijo` (`id_grupo`, `id_usuario`, `pkm`, `denominacion`) VALUES
(1, 5, '1', ' Viaje de fin de curso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_gastos`
--

CREATE TABLE `grupo_gastos` (
  `id_grupo` int(4) NOT NULL,
  `id_gasto` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dieta`
--

CREATE TABLE `tipo_dieta` (
  `id` int(4) NOT NULL,
  `denominacion_dieta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_dieta`
--

INSERT INTO `tipo_dieta` (`id`, `denominacion_dieta`) VALUES
(2, 'Transporte'),
(1, 'Comida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transporte`
--

CREATE TABLE `tipo_transporte` (
  `id` int(4) NOT NULL,
  `denominacion_transporte` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_transporte`
--

INSERT INTO `tipo_transporte` (`id`, `denominacion_transporte`) VALUES
(3, 'Publico'),
(4, 'Personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(4) NOT NULL,
  `tipo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_personal`
--

CREATE TABLE `transporte_personal` (
  `id_gasto` int(4) NOT NULL,
  `km` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transporte_personal`
--

INSERT INTO `transporte_personal` (`id_gasto`, `km`) VALUES
(3, 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `user` varchar(15) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(25) NOT NULL,
  `tipo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `user`, `pass`, `email`, `tipo`) VALUES
(1, 'username', 'userape', 'user', '$2y$10$O57ZaY9eKdYQssujqbxW6OKkx5a7H1qSHS3463UyxenMLJ8wTyo.C', 'usr@asd.com', 2),
(2, 'Antonio', 'juarez', 'usr', '$2y$10$ME5ZJlJaMmhXP/JHs3.zJedzFcNG9DqCHL6oZVFtyKT29g2uM8.ki', 'user@asd.com', 2),
(4, 'usu2', 'ape2', 'user2', '$2y$10$A6fG5kJBANhl6QSZB3FlS.G9iseKrnv9lXSp7ZNXtE274qwGo.coW', 'uu@hh.com', 2),
(5, 'dd', 'dd', 'admin', '$2y$10$qQv4iQPnOsUi7pIjZdz/8OHJBv8onvaSkNdnrQ6Qw5RY4tkIGikZG', 'dddd@nn.mm', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `c_com_pub`
--
ALTER TABLE `c_com_pub`
  ADD PRIMARY KEY (`id_gasto`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo_fijo`
--
ALTER TABLE `grupo_fijo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo_fijo`
--
ALTER TABLE `grupo_fijo`
  MODIFY `id_grupo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
