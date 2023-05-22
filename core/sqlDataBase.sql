-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2023 a las 22:24:36
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vircalendar_demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `eid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `invited` TEXT NOT NULL,
  `desc` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `hour_start` time NOT NULL,
  `hour_end` time DEFAULT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`eid`, `uid`, `name`, `desc`, `date_start`, `date_end`, `hour_start`, `hour_end`, `color`) VALUES
(1, 1,'Evento demo 1','Descripción del evento demo 1',CURDATE(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),CURRENT_TIME,CURRENT_TIME+INTERVAL 2 HOUR,'#396EB0'),
(2, 1,'Evento demo 2','Descripción del evento demo 2',CURDATE(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),CURRENT_TIME+INTERVAL 3 HOUR,CURRENT_TIME+INTERVAL 4 HOUR,'#FFAB4C'),
(3, 1,'Evento demo 3','Descripción del evento demo 3',DATE_ADD(CURDATE(), INTERVAL 5 DAY),DATE_ADD(CURDATE(), INTERVAL 10 DAY),CURRENT_TIME,CURRENT_TIME+INTERVAL 2 HOUR,'#FF6D6D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `nickname` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`uid`, `rid`, `nickname`, `password`, `firstname`, `lastname`, `email`, `age`) VALUES
(1, 1, 'demo', '$2y$10$0ZoS7SAR0cpky9RfrITIlONdXUVv1U45zWjS2R.6ZOyHpugoSE35G', 'demo', 'demo', 'demo@demo.com', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_role`
--

CREATE TABLE `users_role` (
  `rid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_role`
--

INSERT INTO `users_role` (`rid`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `uid` (`uid`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `rid` (`rid`);

--
-- Indices de la tabla `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_role`
--
ALTER TABLE `users_role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_uid` FOREIGN KEY (`uid`) REFERENCES `users_data` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD CONSTRAINT `fk_rid` FOREIGN KEY (`rid`) REFERENCES `users_role` (`rid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
