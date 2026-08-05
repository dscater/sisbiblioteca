-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-08-2026 a las 16:27:56
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

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'AREA 1', '', '2026-07-30 22:56:06', '2026-07-30 22:56:06'),
(2, 'AREA 2', '', '2026-07-30 22:56:10', '2026-07-30 22:56:10'),
(3, 'AREA 3', NULL, '2026-08-05 18:28:19', '2026-08-05 18:28:19');

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

--
-- Volcado de datos para la tabla `autors`
--

INSERT INTO `autors` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'AUTOR 1', 'DESC', '2026-08-05 18:20:47', '2026-08-05 18:20:47'),
(2, 'AUTORA 2', '', '2026-08-05 18:20:51', '2026-08-05 18:20:51'),
(3, 'NUEVO AUTOR', NULL, '2026-08-05 18:28:26', '2026-08-05 18:28:26');

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

--
-- Volcado de datos para la tabla `carrusels`
--

INSERT INTO `carrusels` (`id`, `imagen`, `created_at`, `updated_at`) VALUES
(1, '1785437642.jpg', '2026-07-30 22:54:02', '2026-07-30 22:54:02'),
(2, '1785437648.jpg', '2026-07-30 22:54:08', '2026-07-30 22:54:08'),
(3, '1785437653.jpg', '2026-07-30 22:54:13', '2026-07-30 22:54:13');

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

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `genero`, `dir`, `email`, `fono`, `cel`, `user_id`, `familiar`, `cel_f`, `created_at`, `updated_at`) VALUES
(1, 'JUAN', 'PERES', 'MAMANI', '123456', 'LP', 'MASCULINO', 'LOS OLIVOS #1', 'JUAN@GMAIL.COM', '2222233', '7878787878', 3, '', '', '2026-08-05 18:59:59', '2026-08-05 18:59:59');

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

--
-- Volcado de datos para la tabla `edicions`
--

INSERT INTO `edicions` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'EDICION 1', 'DESC 1', '2026-08-05 18:20:39', '2026-08-05 18:20:39'),
(2, 'EDICION 2', '', '2026-08-05 18:20:42', '2026-08-05 18:20:42'),
(3, '3RA EDICION', NULL, '2026-08-05 18:28:37', '2026-08-05 18:28:37');

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

--
-- Volcado de datos para la tabla `editorials`
--

INSERT INTO `editorials` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'EDITORIAL 1', 'DESC', '2026-08-05 18:20:05', '2026-08-05 18:20:05'),
(2, 'EDITORIAL 2', '', '2026-08-05 18:20:11', '2026-08-05 18:20:11'),
(3, 'EDITORIAL 3', NULL, '2026-08-05 18:29:06', '2026-08-05 18:29:06');

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

--
-- Volcado de datos para la tabla `lectors`
--

INSERT INTO `lectors` (`id`, `user_id`, `nombre`, `apellidos`, `ci`, `ci_exp`, `cel`, `dir`, `correo`, `contrasenia`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 2, 'JUAN', 'PERES', '123456', 'LP', '67676767', 'LOS PEDREGALES #2', 'juan@gmail.com', '123456', '2026-08-05', '2026-08-05 18:49:08', '2026-08-05 18:49:08');

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

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nro_inventario`, `fecha_ingreso`, `area_id`, `autor_id`, `titulo`, `edicion_id`, `volumen_id`, `lugar_id`, `editorial_id`, `fecha_anio`, `nro_paginas`, `isbn`, `descriptores`, `resumen`, `procedencia`, `precio`, `signatura`, `estado`, `portada`, `contraportada`, `tipo`, `ubicacion_id`, `portal`, `observaciones`, `vistos`, `fecha_registro`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-08-05', 1, 1, 'PRIMER LIBRO', 1, 1, 1, 1, 2026, 200, 'ISBN', 'DESCRIPCION PALABRAS CLAVE', 'RESUMEN INDICE', 'PROCEDENCI', 200.00, 'SIGNATURA', 'NUEVO', 'PRIMER LIBRO_P1785939937.jpg', 'PRIMER LIBRO_CP1785939937.jpg', 'LIBRO', 1, 'SI', 'OBSERVACIONES', 1, '2026-08-05', 1, '2026-08-05 18:25:37', '2026-08-05 16:27:26'),
(2, 2, '2026-08-05', 2, 2, 'SEGUNDO LIBRO', 2, 2, 2, 2, 2018, 198, 'ISBN 2', 'LIBRO 2', 'RESUMEN LIBRO 2', 'PROCEDENCIA', 100.00, 'SIGNATURA', 'BUENO', 'SEGUNDO LIBRO_P1785940086.webp', 'SEGUNDO LIBRO_CP1785940086.jpeg', 'LIBRO', 2, 'SI', 'OBSERVACIONES', 0, '2026-08-05', 1, '2026-08-05 18:28:06', '2026-08-05 18:28:06'),
(3, 3, '2026-08-05', 3, 3, 'TERCER LIBRO', 3, 3, 3, 3, 1990, 300, 'ISBN', 'PALABRA CLAVE 3', 'RESUMEN 3', 'PROCEDENCIA', 230.00, 'SIGNATURA 3', 'NUEVO', 'TERCER LIBRO_P1785940214.jpg', 'TERCER LIBRO_CP1785940214.jpeg', 'LIBRO', 2, 'SI', '', 22, '2026-08-05', 1, '2026-08-05 18:30:14', '2026-08-05 19:00:23');

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

--
-- Volcado de datos para la tabla `lugars`
--

INSERT INTO `lugars` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'LUGAR 1', 'DESC', '2026-08-05 18:20:20', '2026-08-05 18:20:20'),
(2, 'LUGAR 2', '', '2026-08-05 18:20:23', '2026-08-05 18:20:23'),
(3, 'NUEVO LUGAR', NULL, '2026-08-05 18:29:00', '2026-08-05 18:29:00');

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
(15, '2026_07_29_164632_create_datos_usuarios_table', 1),
(16, '2026_07_30_194849_create_notificacions_table', 2),
(17, '2026_07_30_194851_create_notificacion_users_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacions`
--

CREATE TABLE `notificacions` (
  `id` bigint UNSIGNED NOT NULL,
  `tipo_notificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `modulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registro_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notificacions`
--

INSERT INTO `notificacions` (`id`, `tipo_notificacion`, `descripcion`, `fecha`, `hora`, `modulo`, `registro_id`, `created_at`, `updated_at`) VALUES
(1, 'PRESTAMO VENCIDO', 'SE NOTIFICA QUE EL PRESTAMO DEL LIBRO PRIMER LIBRO DEL LECTOR JUAN PERES CON C.I. 123456 YA VENCIO SU FECHA DE DEVOLUCION', '2026-08-05', '12:13:44', 'Prestamo', 6, '2026-08-05 16:13:44', '2026-08-05 16:13:44'),
(2, 'PRESTAMO VENCIDO', 'SE NOTIFICA QUE EL PRESTAMO DEL LIBRO SEGUNDO LIBRO DEL LECTOR JUAN PERES CON C.I. 123456 YA VENCIO SU FECHA DE DEVOLUCION', '2026-08-05', '12:13:44', 'Prestamo', 7, '2026-08-05 16:13:44', '2026-08-05 16:13:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_users`
--

CREATE TABLE `notificacion_users` (
  `id` bigint UNSIGNED NOT NULL,
  `notificacion_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `visto` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notificacion_users`
--

INSERT INTO `notificacion_users` (`id`, `notificacion_id`, `user_id`, `visto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2026-08-05 16:13:44', '2026-08-05 16:14:34'),
(2, 1, 3, 0, '2026-08-05 16:13:44', '2026-08-05 16:13:44'),
(3, 2, 1, 1, '2026-08-05 16:13:44', '2026-08-05 16:14:39'),
(4, 2, 3, 0, '2026-08-05 16:13:44', '2026-08-05 16:13:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint UNSIGNED NOT NULL,
  `libro_id` bigint UNSIGNED NOT NULL,
  `solicitud_id` bigint UNSIGNED DEFAULT NULL,
  `lector_id` bigint UNSIGNED DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `fecha_registro` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `libro_id`, `solicitud_id`, `lector_id`, `tipo`, `observaciones`, `descripcion`, `fecha_registro`, `fecha_devolucion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'INGRESO', 'REGISTRO', NULL, '2026-08-05', NULL, 1, '2026-08-05 18:25:37', '2026-08-05 18:25:37'),
(2, 2, NULL, NULL, 'INGRESO', 'REGISTRO', NULL, '2026-08-05', NULL, 1, '2026-08-05 18:28:06', '2026-08-05 18:28:06'),
(3, 3, NULL, NULL, 'INGRESO', 'REGISTRO', NULL, '2026-08-05', NULL, 1, '2026-08-05 18:30:14', '2026-08-05 18:30:14'),
(4, 3, 1, 1, 'EGRESO', '', 'PRESTAMO', '2026-08-05', '2026-08-06', 2, '2026-08-05 18:55:43', '2026-08-05 19:01:28'),
(5, 3, 1, 1, 'INGRESO', 'SIN OBSERVACIONES', 'DEVOLUCION', '2026-08-05', NULL, 1, '2026-08-05 19:01:28', '2026-08-05 19:01:28'),
(6, 1, 3, 1, 'EGRESO', '', 'PRESTAMO', '2026-08-05', '2026-08-05', 2, '2026-08-05 15:44:17', '2026-08-05 16:23:27'),
(7, 2, 2, 1, 'EGRESO', '', 'PRESTAMO', '2026-08-05', '2026-08-05', 2, '2026-08-05 15:44:27', '2026-08-05 16:20:01'),
(8, 2, 2, 1, 'INGRESO', '', 'DEVOLUCION', '2026-08-05', NULL, 1, '2026-08-05 16:20:01', '2026-08-05 16:20:01'),
(9, 1, 3, 1, 'INGRESO', '', 'DEVOLUCION', '2026-08-05', NULL, 1, '2026-08-05 16:23:27', '2026-08-05 16:23:27'),
(10, 1, NULL, 1, 'EGRESO', '', 'PRESTAMO', '2026-08-05', '2026-08-06', 1, '2026-08-05 16:23:51', '2026-08-05 16:23:51');

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
(1, 'EMPRESA PRUEBA', 'CP', 'LA PAZ', 'ZONA LOS OLIVOS CALLE 3 #3232', '21134568', '78945612', '', '', 'logo1785436323.jpg', '', 'ACTIVIDAD ECONOMICA', '2026-07-29 23:10:21', '2026-07-30 22:32:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_prestamos`
--

CREATE TABLE `solicitud_prestamos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Volcado de datos para la tabla `solicitud_prestamos`
--

INSERT INTO `solicitud_prestamos` (`id`, `codigo`, `libro_id`, `lector_id`, `fecha_solicitud`, `fecha_fin`, `observacion`, `fecha_registro`, `estado_solicitud`, `created_at`, `updated_at`) VALUES
(1, 'P-00001', 3, 1, '2026-08-05 14:54:48', '2026-08-07 14:54:48', '', '2026-08-05', 'APROBADO', '2026-08-05 18:54:48', '2026-08-05 18:55:43'),
(2, 'P-00002', 2, 1, '2026-08-05 15:38:05', '2026-08-07 15:38:05', 'SEGUNDA SOLICITUD', '2026-08-05', 'APROBADO', '2026-08-05 19:38:05', '2026-08-05 15:44:27'),
(3, 'P-00003', 1, 1, '2026-08-05 11:43:56', '2026-08-07 11:43:56', '', '2026-08-05', 'APROBADO', '2026-08-05 15:43:56', '2026-08-05 15:44:17');

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

--
-- Volcado de datos para la tabla `ubicacions`
--

INSERT INTO `ubicacions` (`id`, `estante`, `balda`, `created_at`, `updated_at`) VALUES
(1, 'ESTANTE 1', 'BALDA 1', '2026-08-05 18:21:01', '2026-08-05 18:21:01'),
(2, 'ESTANTE 2', 'BALDA 2', '2026-08-05 18:21:08', '2026-08-05 18:21:08');

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
(1, 'admin', '$2y$12$jr/rq1N3Ddc9oqWT/3Sap.wDYjz8/IbXXJwsWSZRytrad3SQwMPUu', 'ADMINISTRADOR', 'user_default.png', 1, '2026-07-29 23:10:21', '2026-07-29 23:10:21'),
(2, 'juan@gmail.com', '$2y$12$7XE/B1pGfQ1jSTAEjAu.KeUIw8YxrL22oXSkY1zGG6V/ir39Mobli', 'LECTOR', 'user_default.png', 1, '2026-08-05 18:49:08', '2026-08-05 18:49:08'),
(3, 'JPERES', '$2y$12$Ll/G.zlVr.yDmub9ZiM7s.fFy88k1HsrRv/AHZidL9VdodYpdQU12', 'AUXILIAR', 'JUAN1785941999.jpg', 1, '2026-08-05 18:59:59', '2026-08-05 18:59:59');

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
-- Volcado de datos para la tabla `volumens`
--

INSERT INTO `volumens` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'VOLUMEN 1', 'DESC', '2026-08-05 18:20:29', '2026-08-05 18:20:29'),
(2, 'VOLUMEN 2', '', '2026-08-05 18:20:32', '2026-08-05 18:20:32'),
(3, 'VOLUMEN 3', NULL, '2026-08-05 18:28:42', '2026-08-05 18:28:42');

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
-- Indices de la tabla `notificacions`
--
ALTER TABLE `notificacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificacion_users_notificacion_id_foreign` (`notificacion_id`),
  ADD KEY `notificacion_users_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `autors`
--
ALTER TABLE `autors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carrusels`
--
ALTER TABLE `carrusels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `edicions`
--
ALTER TABLE `edicions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `editorials`
--
ALTER TABLE `editorials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lectors`
--
ALTER TABLE `lectors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lugars`
--
ALTER TABLE `lugars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `notificacions`
--
ALTER TABLE `notificacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `razon_socials`
--
ALTER TABLE `razon_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitud_prestamos`
--
ALTER TABLE `solicitud_prestamos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ubicacions`
--
ALTER TABLE `ubicacions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `volumens`
--
ALTER TABLE `volumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Filtros para la tabla `notificacion_users`
--
ALTER TABLE `notificacion_users`
  ADD CONSTRAINT `notificacion_users_notificacion_id_foreign` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacions` (`id`),
  ADD CONSTRAINT `notificacion_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
