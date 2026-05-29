-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2026 a las 15:52:00
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
-- Base de datos: `dbcorpo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news_items`
--

CREATE TABLE `news_items` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `order_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `news_items`
--

INSERT INTO `news_items` (`id`, `title`, `description`, `image_url`, `order_index`) VALUES
(1, '123345 efdsf', '12345', 'uploads/image_file_1_6a015457134e9.jpg', 1),
(2, 'waos2', 'que loco bro', 'img/img/torre_parque.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('carousel_1_description', '1'),
('carousel_1_image', 'uploads/carousel_image_1_6a01545710c31.jpg'),
('carousel_1_title', '1'),
('carousel_2_description', 'Some representative placeholder content for the second slide.'),
('carousel_2_image', 'img/img/gabinete.jpg'),
('carousel_2_title', 'Second slide label'),
('carousel_3_description', 'Some representative placeholder content for the third slide.'),
('carousel_3_image', 'img/img/resumen.jpg'),
('carousel_3_title', 'Third slide label'),
('logo_image', 'img/img/logocorpo.png'),
('video_src', 'videos/torres.mp4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Corpocomun', '277441834d199f24bc8bd1302affad4a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `news_items`
--
ALTER TABLE `news_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_order_index` (`order_index`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `news_items`
--
ALTER TABLE `news_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
