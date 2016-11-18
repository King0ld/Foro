-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2016 a las 23:21:21
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Mi CategorÃ­a'),
(2, 'Otra categorÃ­a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` tinyint(1) NOT NULL,
  `timer` int(70) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `timer`) VALUES
(1, 1478705316);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id` int(200) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descrip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_mensajes` bigint(250) NOT NULL DEFAULT '0',
  `cantidad_temas` bigint(250) NOT NULL DEFAULT '0',
  `id_categoria` int(70) NOT NULL DEFAULT '1',
  `estado` int(1) NOT NULL DEFAULT '1',
  `ultimo_tema` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ultimo_tema` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`id`, `nombre`, `descrip`, `cantidad_mensajes`, `cantidad_temas`, `id_categoria`, `estado`, `ultimo_tema`, `id_ultimo_tema`) VALUES
(9, 'Me encierro', '<strong>Aqui se habla de muchas cosas</strong>', 1, 1, 2, 1, 'Te encierras en el dÃ­as de invierno', 7),
(10, 'Holaaa', 'ajgaoshgoaihgag', 5, 5, 2, 1, 'asdasdasfasda5464as68a4f6', 17),
(12, 'Holaaaaa', 'EDITADO', 0, 0, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` bigint(255) NOT NULL,
  `id_dueno` int(255) NOT NULL,
  `id_tema` int(255) NOT NULL,
  `id_foro` int(255) NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_dueno`, `id_tema`, `id_foro`, `contenido`) VALUES
(1, 1, 7, 9, '[h1]Excelente Poema bro![/h1]'),
(2, 1, 7, 9, 'sdasdasdjasdsadasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` bigint(255) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_foro` int(255) NOT NULL,
  `id_dueno` int(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '01/02/2016',
  `visitas` int(255) NOT NULL DEFAULT '0',
  `respuestas` int(255) NOT NULL DEFAULT '0',
  `id_ultimo` int(255) NOT NULL,
  `fecha_ultimo` varchar(21) COLLATE utf8_unicode_ci NOT NULL DEFAULT '01/02/2016 3:10pm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `contenido`, `id_foro`, `id_dueno`, `estado`, `tipo`, `fecha`, `visitas`, `respuestas`, `id_ultimo`, `fecha_ultimo`) VALUES
(7, 'Te encierras en el dÃ­as de invierno', 'La nieve leche cae sobre tu cuerpo y cubre tus pequeÃ±os hombros\nesa dulce ternura sacude el frÃ­o y detiene el tiempo.\n\nTus grandes ojos miran alrededor desesperadamente en busca de algo, \npara luego de un tiempo darte cuenta que siempre lo habÃ­as tenido\nbastante cerca. Dejas escapar un hermoso suspiro y lentamente miras\na mi direcciÃ³n.\n', 9, 4, 1, 1, '11/08/2016 ', 24, 2, 4, '11/08/2016 05:39 pm'),
(10, 'Creando tema de prueba xD', '\r\n    [b]Negrita[/b]\r\n    [i]Italic[/i]\r\n    [u]Subrayado[/u]\r\n    [s]Tachado[/s]\r\n    [img]URL image[/img]\r\n    [center]Centrar[/center]\r\n    [h1]Titulo gigante[/h1]\r\n    [h2]Titulo medianamete grande[/h2]\r\n    [h3]Titulo mediano[/h3]\r\n    [h4]Titulo normal[/h4]\r\n    [h5]Titulo pequeÃ±o[/h5]\r\n    [h6]Titulo muy pequeÃ±o[/h6]\r\n    [quote]Cita[/quote]\r\n    [size=20]Texto en 20px[/size]\r\n    [url=URL LINK]Texto a hacer clic[/url]\r\n    [font=Arial]Texto en arial[/font]\r\n    [bgimage=URL IMAGEN]Texto donde habrÃ¡ imagen de fondo[/bgimage]\r\n    [color=red]Color Rojo[/color]\r\n    [bgcolor=red]Color de fondo Rojo[/bgcolor]\r\n\r\n', 10, 1, 1, 2, '02/11/2016 ', 8, 0, 1, '02/11/2016 02:57 pm'),
(14, 'afuahf afiklaf''sa fbsauf bsafpasfnsaf asfusaiofasfaf', '\r\n    [b]Negrita[/b]\r\n    [i]Italic[/i]\r\n    [u]Subrayado[/u]\r\n    [s]Tachado[/s]\r\n    [img]URL image[/img]\r\n    [center]Centrar[/center]\r\n    [h1]Titulo gigante[/h1]\r\n    [h2]Titulo medianamete grande[/h2]\r\n    [h3]Titulo mediano[/h3]\r\n    [h4]Titulo normal[/h4]\r\n    [h5]Titulo pequeÃ±o[/h5]\r\n    [h6]Titulo muy pequeÃ±o[/h6]\r\n    [quote]Cita[/quote]\r\n    [size=20]Texto en 20px[/size]\r\n    [url=URL LINK]Texto a hacer clic[/url]\r\n    [font=Arial]Texto en arial[/font]\r\n    [bgimage=URL IMAGEN]Texto donde habrÃ¡ imagen de fondo[/bgimage]\r\n    [color=red]Color Rojo[/color]\r\n    [bgcolor=red]Color de fondo Rojo[/bgcolor]\r\n\r\n', 10, 1, 1, 1, '02/11/2016 ', 5, 0, 1, '02/11/2016 08:08 pm'),
(15, 'Isamar come coco en la playita', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estÃ¡ndar de las industrias desde el aÃ±o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usÃ³ una galerÃ­a de textos y los mezclÃ³ de tal manera que logrÃ³ hacer un libro de textos especimen. No sÃ³lo sobreviviÃ³ 500 aÃ±os, sino que tambien ingresÃ³ como texto de relleno en documentos electrÃ³nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaciÃ³n de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y mÃ¡s recientemente con software de autoediciÃ³n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.\r\n', 10, 6, 1, 1, '04/11/2016 ', 15, 0, 6, '04/11/2016 06:20 pm'),
(16, 'Un nuevo tema de prueba probando los mensajes', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estÃ¡ndar de las industrias desde el aÃ±o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usÃ³ una galerÃ­a de textos y los mezclÃ³ de tal manera que logrÃ³ hacer un libro de textos especimen. No sÃ³lo sobreviviÃ³ 500 aÃ±os, sino que tambien ingresÃ³ como texto de relleno en documentos electrÃ³nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaciÃ³n de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y mÃ¡s recientemente con software de autoediciÃ³n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 10, 1, 1, 1, '05/11/2016 ', 5, 0, 1, '05/11/2016 01:19 am'),
(17, 'asdasdasfasda5464as68a4f6', '\r\n    [b]Negrita[/b]\r\n    [i]Italic[/i]\r\n    [u]Subrayado[/u]\r\n    [s]Tachado[/s]\r\n    [img]URL image[/img]\r\n    [center]Centrar[/center]\r\n    [h1]Titulo gigante[/h1]\r\n    [h2]Titulo medianamete grande[/h2]\r\n    [h3]Titulo mediano[/h3]\r\n    [h4]Titulo normal[/h4]\r\n    [h5]Titulo pequeÃ±o[/h5]\r\n    [h6]Titulo muy pequeÃ±o[/h6]\r\n    [quote]Cita[/quote]\r\n    [size=20]Texto en 20px[/size]\r\n    [url=URL LINK]Texto a hacer clic[/url]\r\n    [font=Arial]Texto en arial[/font]\r\n    [bgimage=URL IMAGEN]Texto donde habrÃ¡ imagen de fondo[/bgimage]\r\n    [color=red]Color Rojo[/color]\r\n    [bgcolor=red]Color de fondo Rojo[/bgcolor]\r\n', 10, 1, 1, 1, '05/11/2016 ', 6, 0, 1, '05/11/2016 01:21 am');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `user` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `permisos` int(1) NOT NULL DEFAULT '0',
  `activo` int(1) NOT NULL DEFAULT '0',
  `keyreg` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keypass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `new_pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ultima_conexion` int(32) NOT NULL DEFAULT '1471096252',
  `no_leidos` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` varchar(70) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Usuario',
  `edad` int(3) NOT NULL DEFAULT '16',
  `fecha_reg` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '10/10/9999',
  `biografia` text COLLATE utf8_unicode_ci NOT NULL,
  `mensajes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `permisos`, `activo`, `keyreg`, `keypass`, `new_pass`, `ultima_conexion`, `no_leidos`, `img`, `firma`, `rango`, `edad`, `fecha_reg`, `biografia`, `mensajes`) VALUES
(1, 'mario', 'c0784027b45aa11e848a38e890f8416c', 'marioytorres@hotmail.com', 2, 1, '', '', '', 1478705316, '', 'default.jpg', '[center][img]https://logpublicity.files.wordpress.com/2013/04/29blpb9.png[/img][/center]', 'Usuario', 16, '12/8/2016', 'Soy un chico dulce y tierno', 16),
(3, 'UserTest', 'c0784027b45aa11e848a38e890f8416c', 'user@gmail.com', 0, 1, '', '', '', 1473827128, '', 'default.jpg', '', 'Usuario', 0, '10/10/9999', '', 0),
(4, 'Mario2', '6dfa699001ecb1826f278177d7305ad1', 'marioytorres@gmail.com', 0, 1, '', '', '', 1478112385, '', 'default.jpg', '', 'Usuario', 0, '10/10/9999', '', 4),
(5, 'Jorge', '7438ea8923df10e544ce6f4da8d7490c', 'jorgehmatosq@gmail.com', 0, 0, '70398e35df02f25eb4b3e5807ade14d1', '', '', 1471096252, '', 'default.jpg', '', 'Usuario', 0, '10/10/9999', '', 0),
(6, 'isamark97', 'aabfe790c3116240191699ba1f093f5a', 'isamarktorres@gmail.com', 1, 1, '', '', '', 1478322987, '', 'default.jpg', '', 'Usuario', 16, '04/11/2016', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
