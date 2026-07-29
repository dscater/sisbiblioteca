-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-07-2026 a las 19:21:32
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisbiblioteca_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autors`
--

CREATE TABLE `autors` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusels`
--

CREATE TABLE `carrusels` (
  `id` bigint UNSIGNED NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `familiar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel_f` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicions`
--

CREATE TABLE `edicions` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorials`
--

CREATE TABLE `editorials` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectors`
--

CREATE TABLE `lectors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasenia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` bigint UNSIGNED NOT NULL,
  `nro_inventario` bigint NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `area_id` bigint UNSIGNED NOT NULL,
  `autor_id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edicion_id` bigint UNSIGNED NOT NULL,
  `volumen_id` bigint UNSIGNED NOT NULL,
  `lugar_id` bigint UNSIGNED NOT NULL,
  `editorial_id` bigint UNSIGNED NOT NULL,
  `fecha_anio` int NOT NULL,
  `nro_paginas` int NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptores` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `procedencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(24,2) DEFAULT NULL,
  `signatura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contraportada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion_id` bigint UNSIGNED NOT NULL,
  `portal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vistos` int DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugars`
--

CREATE TABLE `lugars` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_07_26_110750_create_carrusels_table', 1),
(3, '2026_07_28_084112_create_areas_table', 1),
(4, '2026_07_28_084121_create_autors_table', 1),
(5, '2026_07_28_084131_create_edicions_table', 1),
(6, '2026_07_28_084144_create_volumens_table', 1),
(7, '2026_07_28_084153_create_lugars_table', 1),
(8, '2026_07_28_084202_create_editorials_table', 1),
(9, '2026_07_28_084349_create_ubicacions_table', 1),
(10, '2026_07_28_084401_create_libros_table', 1),
(11, '2026_07_28_084414_create_lectors_table', 1),
(12, '2026_07_28_084426_create_solicitud_prestamos_table', 1),
(13, '2026_07_28_084439_create_prestamos_table', 1),
(14, '2026_07_29_164550_create_razon_socials_table', 1),
(15, '2026_07_29_164632_create_datos_usuarios_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint UNSIGNED NOT NULL,
  `libro_id` bigint UNSIGNED NOT NULL,
  `solicitud_id` bigint UNSIGNED NOT NULL,
  `lector_id` bigint UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `fecha_registro` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razon_socials`
--

CREATE TABLE `razon_socials` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `casilla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_economica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `razon_socials`
--

INSERT INTO `razon_socials` (`id`, `nombre`, `alias`, `ciudad`, `dir`, `fono`, `cel`, `casilla`, `correo`, `logo`, `web`, `actividad_economica`, `created_at`, `updated_at`) VALUES
(1, 'EMPRESA PRUEBA', 'CP', 'LA PAZ', 'ZONA LOS OLIVOS CALLE 3 #3232', '21134568', '78945612', '', '', 'logo.png', '', 'ACTIVIDAD ECONOMICA', '2026-07-29 23:10:21', '2026-07-29 23:10:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_prestamos`
--

CREATE TABLE `solicitud_prestamos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` bigint NOT NULL,
  `libro_id` bigint UNSIGNED NOT NULL,
  `lector_id` bigint UNSIGNED NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `fecha_registro` date NOT NULL,
  `estado_solicitud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacions`
--

CREATE TABLE `ubicacions` (
  `id` bigint UNSIGNED NOT NULL,
  `estante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','AUXILIAR','LECTOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `tipo`, `foto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$jr/rq1N3Ddc9oqWT/3Sap.wDYjz8/IbXXJwsWSZRytrad3SQwMPUu', 'ADMINISTRADOR', 'user_default.png', 1, '2026-07-29 23:10:21', '2026-07-29 23:10:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `volumens`
--

CREATE TABLE `volumens` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrusels`
--
ALTER TABLE `carrusels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_usuarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `edicions`
--
ALTER TABLE `edicions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `editorials`
--
ALTER TABLE `editorials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lectors`
--
ALTER TABLE `lectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lectors_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libros_area_id_foreign` (`area_id`),
  ADD KEY `libros_autor_id_foreign` (`autor_id`),
  ADD KEY `libros_edicion_id_foreign` (`edicion_id`),
  ADD KEY `libros_volumen_id_foreign` (`volumen_id`),
  ADD KEY `libros_lugar_id_foreign` (`lugar_id`),
  ADD KEY `libros_editorial_id_foreign` (`editorial_id`),
  ADD KEY `libros_ubicacion_id_foreign` (`ubicacion_id`);

--
-- Indices de la tabla `lugars`
--
ALTER TABLE `lugars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_prestamos`
--
ALTER TABLE `solicitud_prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_prestamos_libro_id_foreign` (`libro_id`),
  ADD KEY `solicitud_prestamos_lector_id_foreign` (`lector_id`);

--
-- Indices de la tabla `ubicacions`
--
ALTER TABLE `ubicacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `volumens`
--
ALTER TABLE `volumens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `autors`
--
ALTER TABLE `autors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrusels`
--
ALTER TABLE `carrusels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `edicions`
--
ALTER TABLE `edicions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editorials`
--
ALTER TABLE `editorials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lectors`
--
ALTER TABLE `lectors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugars`
--
ALTER TABLE `lugars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitud_prestamos`
--
ALTER TABLE `solicitud_prestamos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacions`
--
ALTER TABLE `ubicacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `volumens`
--
ALTER TABLE `volumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `datos_usuarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `lectors`
--
ALTER TABLE `lectors`
  ADD CONSTRAINT `lectors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `libros_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `autors` (`id`),
  ADD CONSTRAINT `libros_edicion_id_foreign` FOREIGN KEY (`edicion_id`) REFERENCES `edicions` (`id`),
  ADD CONSTRAINT `libros_editorial_id_foreign` FOREIGN KEY (`editorial_id`) REFERENCES `editorials` (`id`),
  ADD CONSTRAINT `libros_lugar_id_foreign` FOREIGN KEY (`lugar_id`) REFERENCES `lugars` (`id`),
  ADD CONSTRAINT `libros_ubicacion_id_foreign` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicacions` (`id`),
  ADD CONSTRAINT `libros_volumen_id_foreign` FOREIGN KEY (`volumen_id`) REFERENCES `volumens` (`id`);

--
-- Filtros para la tabla `solicitud_prestamos`
--
ALTER TABLE `solicitud_prestamos`
  ADD CONSTRAINT `solicitud_prestamos_lector_id_foreign` FOREIGN KEY (`lector_id`) REFERENCES `lectors` (`id`),
  ADD CONSTRAINT `solicitud_prestamos_libro_id_foreign` FOREIGN KEY (`libro_id`) REFERENCES `libros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
