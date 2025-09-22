-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-09-2025 a las 04:06:14
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
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_18_222222_alter_users_table', 2),
(5, '2025_09_19_185036_create_orders_table', 3),
(6, '2025_09_19_193747_create_mobile_phones_table', 4),
(7, '2025_09_20_000001_alter_users_phone_to_string', 5),
(11, '2025_09_20_221541_create_specifications_table', 6),
(13, '2025_09_20_240100_create_order_items_table', 7),
(14, '2025_09_20_241000_create_reviews_table', 8),
(15, '2025_09_20_242500_drop_review_id_from_users_table', 9),
(16, '2025_09_20_250000_add_user_id_to_orders_table', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_phones`
--

CREATE TABLE `mobile_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mobile_phones`
--

INSERT INTO `mobile_phones` (`id`, `name`, `photo_url`, `brand`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(3, 'iPhone 17 Air', 'http://127.0.0.1:8000/images/apple/iphone17airjpg-1758411530.webp', 'Apple', 999, 49, '2025-09-21 04:38:50', '2025-09-21 08:33:24'),
(4, 'iPhone 15 Pro Max', 'http://127.0.0.1:8000/images/apple/iphone15promax-1758421143.webp', 'Apple', 849, 10, '2025-09-21 07:19:03', '2025-09-21 07:19:03'),
(5, 'iPhone 14', 'http://127.0.0.1:8000/images/apple/iphone14purple-1758421202.jpg', 'Apple', 749, 10, '2025-09-21 07:20:02', '2025-09-21 07:20:02'),
(6, 'Galaxy S24 Ultra', 'http://127.0.0.1:8000/images/samsung/s24ultragray-1758421282.webp', 'Samsung', 999, 30, '2025-09-21 07:21:22', '2025-09-21 07:23:29'),
(7, 'Galaxy A54', 'http://127.0.0.1:8000/images/samsung/a54black-1758421337.webp', 'Samsung', 449, 3, '2025-09-21 07:22:17', '2025-09-21 07:23:22'),
(8, 'Pixel 8 Pro', 'http://127.0.0.1:8000/images/google/pixel8problue-1758421397.webp', 'Google', 899, 25, '2025-09-21 07:23:17', '2025-09-21 07:23:17'),
(9, 'Pixel 7a', 'http://127.0.0.1:8000/images/google/pixel7awhite-1758421450.webp', 'Google', 649, 5, '2025-09-21 07:24:10', '2025-09-21 07:24:10'),
(10, '13T Pro', 'http://127.0.0.1:8000/images/xiaomi/17tproblack-1758421535.avif', 'Xiaomi', 999, 30, '2025-09-21 07:25:28', '2025-09-21 07:25:35'),
(11, 'OnePlus 11', 'http://127.0.0.1:8000/images/oneplus/oneplus11green-1758421630.jpg', 'OnePlus', 699, 14, '2025-09-21 07:27:10', '2025-09-21 08:47:50'),
(12, 'Nord CE 3 Lite', 'http://127.0.0.1:8000/images/oneplus/nordce3liteyellow-1758421698.webp', 'OnePlus', 349, 38, '2025-09-21 07:28:18', '2025-09-21 08:46:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','paid','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `status`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-21', 'cancelled', 999, '2025-09-21 08:33:24', '2025-09-21 08:45:56'),
(2, 1, '2025-09-21', 'cancelled', 698, '2025-09-21 08:46:14', '2025-09-21 08:46:50'),
(3, 1, '2025-09-21', 'pending', 699, '2025-09-21 08:47:50', '2025-09-21 08:47:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `mobile_phone_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `mobile_phone_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 999, '2025-09-21 08:33:24', '2025-09-21 08:33:24'),
(2, 2, 12, 2, 349, '2025-09-21 08:46:14', '2025-09-21 08:46:14'),
(3, 3, 11, 1, 699, '2025-09-21 08:47:50', '2025-09-21 08:47:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mobile_phone_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rating` int(11) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `mobile_phone_id`, `status`, `rating`, `comments`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'approved', 4, 'Muy buen celular, mala batería', NULL, '2025-09-21 05:29:23'),
(3, 1, 3, 'approved', 5, 'El mejor celular!', '2025-09-21 07:09:29', '2025-09-21 07:45:54'),
(4, 1, 3, 'approved', 5, 'El mejor celular que he tenido.', NULL, NULL),
(5, 3, 4, 'approved', 4, 'Buen rendimiento por el precio.', NULL, NULL),
(6, 4, 5, 'approved', 5, 'Excelente cámara y fluidez.', NULL, NULL),
(7, 1, 6, 'approved', 3, 'Cumple pero esperaba más de la batería.', NULL, NULL),
(8, 3, 7, 'approved', 4, 'Muy rápido y con buena pantalla.', NULL, NULL),
(9, 4, 8, 'approved', 5, 'Relación calidad-precio insuperable.', NULL, '2025-09-21 07:48:54'),
(10, 1, 9, 'approved', 2, 'La cámara nocturna es floja.', NULL, NULL),
(11, 3, 10, 'approved', 3, 'Aceptable, aunque algo lento en apps pesadas.', NULL, NULL),
(12, 4, 11, 'approved', 4, 'Buen diseño y pantalla brillante.', NULL, NULL),
(13, 1, 12, 'approved', 5, 'Motorola sorprende con gran calidad.', NULL, NULL),
(14, 3, 3, 'approved', 4, 'Gran experiencia de usuario.', NULL, NULL),
(15, 4, 4, 'approved', 3, 'Cumple pero no destaca en nada.', NULL, NULL),
(16, 1, 5, 'approved', 5, 'Fotografía profesional en el bolsillo.', NULL, NULL),
(17, 3, 6, 'approved', 4, 'Muy equilibrado en todo sentido.', NULL, NULL),
(18, 4, 7, 'approved', 3, 'Buen móvil, aunque algo pesado.', NULL, '2025-09-21 07:48:59'),
(19, 1, 8, 'approved', 5, 'Cámara y pantalla de altísima calidad.', NULL, NULL),
(20, 3, 9, 'approved', 4, 'Perfecto para juegos.', NULL, NULL),
(21, 4, 10, 'approved', 2, 'Esperaba más por el precio.', NULL, NULL),
(22, 1, 11, 'approved', 4, 'Buena batería, dura todo el día.', NULL, NULL),
(23, 3, 12, 'approved', 5, 'Muy recomendable, excelente compra.', NULL, NULL),
(24, 4, 3, 'approved', 4, 'Samsung de gama alta confiable.', NULL, NULL),
(25, 1, 4, 'approved', 3, 'Correcto pero no sorprende.', NULL, NULL),
(26, 3, 5, 'approved', 5, 'De lo mejor que he usado.', NULL, NULL),
(27, 4, 6, 'approved', 4, 'Buen rendimiento y cámaras decentes.', NULL, NULL),
(28, 1, 7, 'approved', 5, 'Sorprendente carga rápida.', NULL, NULL),
(29, 3, 8, 'approved', 3, 'Rinde bien en general, pero no es perfecto.', NULL, NULL),
(30, 4, 9, 'approved', 4, 'Mejor de lo que esperaba.', NULL, '2025-09-21 07:48:56'),
(31, 1, 10, 'approved', 3, 'Aceptable en funciones básicas.', NULL, NULL),
(32, 3, 11, 'approved', 4, 'Diseño moderno y pantalla fluida.', NULL, NULL),
(33, 4, 12, 'approved', 5, 'Excelente compra, muy satisfecho.', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lEiCsIo9ckCbeWV2DeJ9blo7o13UvhV4pew7Jyns', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidEpZa3diVzIxWjc0UnZUSWpuak9TTjQyODFUeWVTdnYzTThiR21BaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntzOjU6Iml0ZW1zIjthOjE6e2k6NTthOjc6e3M6MjoiaWQiO2k6NTtzOjQ6Im5hbWUiO3M6OToiaVBob25lIDE0IjtzOjU6ImJyYW5kIjtzOjU6IkFwcGxlIjtzOjk6InBob3RvX3VybCI7czo2NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2ltYWdlcy9hcHBsZS9pcGhvbmUxNHB1cnBsZS0xNzU4NDIxMjAyLmpwZyI7czo1OiJwcmljZSI7aTo3NDk7czo4OiJxdWFudGl0eSI7aToxO3M6NToic3RvY2siO2k6MTA7fX19czo1OiJmbGFzaCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTg1MDU3NjI7fX0=', 1758505762),
('tEoDBkt2y5xvJDFksLaEYzr5c9usxiC4Joy8qEIW', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVHA3eFp0dGdVOXNxYVF3N01rTG9vRnZtNHJMVVpzTlBGcGtkUjVYdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9waG9uZXMvNyI7fXM6NDoiY2FydCI7YToxOntzOjU6Iml0ZW1zIjthOjA6e319czo1OiJmbGFzaCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTg0MjY2MzQ7fX0=', 1758428748);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specifications`
--

CREATE TABLE `specifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `battery` int(11) NOT NULL,
  `screen_size` double NOT NULL,
  `screen_tech` varchar(255) NOT NULL,
  `ram` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `camera_specs` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `mobile_phone_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `specifications`
--

INSERT INTO `specifications` (`id`, `model`, `processor`, `battery`, `screen_size`, `screen_tech`, `ram`, `storage`, `camera_specs`, `color`, `mobile_phone_id`, `created_at`, `updated_at`) VALUES
(2, 'A1179', 'A19 Pro', 3950, 6.3, 'OLED', 8, 512, '48MP', 'Light Blue', 3, '2025-09-21 04:39:48', '2025-09-21 07:31:04'),
(3, 'A1923', 'A17 Pro', 4422, 6.7, 'OLED', 8, 256, 'Triple 48MP + 12MP', 'Black Titanium', 4, '2025-09-21 07:30:48', '2025-09-21 07:30:48'),
(4, 'S8962', 'Snapdragon 8 Gen 3', 5000, 6.8, 'AMOLED', 12, 256, 'Triple 200MP + 12MP', 'Deep Black', 6, '2025-09-21 07:32:28', '2025-09-21 07:32:28'),
(5, 'P0900', 'Tensor G3', 5050, 6.7, 'OLED', 12, 128, 'Triple 50MP + 48MP', 'Sky Blue', 8, '2025-09-21 07:33:22', '2025-09-21 07:33:22'),
(6, 'X1212', 'Dimensity 9200+', 5000, 6.7, 'AMOLED', 12, 512, 'Triple 50MP', 'Black', 10, '2025-09-21 07:34:35', '2025-09-21 07:34:35'),
(7, 'O8765', 'Snapdragon 8 Gen 2', 5000, 6.7, 'AMOLED', 16, 256, 'Triple 50MP + 48MP + 32MP', 'Dark Green', 11, '2025-09-21 07:36:19', '2025-09-21 07:36:19'),
(8, 'S4545', 'Exynos 1380', 5000, 6.4, 'Super AMOLED', 8, 128, 'Triple 50MP + 12MP + 5MP', 'Black', 7, '2025-09-21 07:37:29', '2025-09-21 07:37:29'),
(9, 'A2309', 'A15 Bionic', 3279, 6.1, 'OLED', 6, 128, 'Dual 12MP', 'Light Purple', 5, '2025-09-21 07:38:27', '2025-09-21 07:38:27'),
(10, 'P0011', 'Snapdragon 695', 5000, 6.7, 'IPS LCD', 8, 128, 'Triple 108MP + Dual 2MP', 'Lemon', 12, '2025-09-21 07:39:48', '2025-09-21 07:39:48'),
(11, 'G3219', 'Tensor G2', 4385, 6.1, 'OLED', 8, 128, 'Dual 64MP + 3MP', 'Bone White', 9, '2025-09-21 07:41:18', '2025-09-21 07:41:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `staff`, `phone`, `address`) VALUES
(1, 'Alejandro Carmona', 'alejocar04@hotmail.com', NULL, '$2y$12$vvXHManyhyuEwsGcHWrqrezngzgdswHgB/b/5QgzPxAdEjBAliyu.', 'FfzFBb0AhudaEtSWhOU5MFgi3GNPM2mISFSUyWG3I1X6S5zTREsZ5oUa62o1', '2025-09-19 04:56:25', '2025-09-21 08:53:05', 1, '3052960276', 'Calle 25D #15 Sur - 30'),
(3, 'Miguel A. Arcila', 'miguel107@gmail.com', NULL, '$2y$12$Vg9rfkW2zwbpEiU1KfKfuO6w2NooBJxFMZf1BNObvQIGfbvadUr0C', NULL, '2025-09-20 23:58:44', '2025-09-21 00:29:56', 0, '3052960278', 'Calle 3 #27 Sur - 125'),
(4, 'Santiago Sabogal', 'santiago104@gmail.com', NULL, '$2y$12$/JnHAg1kNNcxtp503x8gmedJueoPRYennaP7KgGEO7FILBgSVkh7e', NULL, '2025-09-21 00:30:33', '2025-09-21 01:51:00', 0, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mobile_phones`
--
ALTER TABLE `mobile_phones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_mobile_phone_id_foreign` (`mobile_phone_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_mobile_phone_id_foreign` (`mobile_phone_id`),
  ADD KEY `reviews_user_id_mobile_phone_id_index` (`user_id`,`mobile_phone_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specifications_mobile_phone_id_unique` (`mobile_phone_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mobile_phones`
--
ALTER TABLE `mobile_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
