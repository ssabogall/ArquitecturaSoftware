-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: proyectofinal
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_09_18_222222_alter_users_table',2),(5,'2025_09_19_185036_create_orders_table',3),(6,'2025_09_19_193747_create_mobile_phones_table',4),(7,'2025_09_20_000001_alter_users_phone_to_string',5),(11,'2025_09_20_221541_create_specifications_table',6),(13,'2025_09_20_240100_create_order_items_table',7),(14,'2025_09_20_241000_create_reviews_table',8),(15,'2025_09_20_242500_drop_review_id_from_users_table',9),(16,'2025_09_20_250000_add_user_id_to_orders_table',10),(17,'2025_11_09_010535_add_balance_to_users_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobile_phones`
--

DROP TABLE IF EXISTS `mobile_phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobile_phones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobile_phones`
--

LOCK TABLES `mobile_phones` WRITE;
/*!40000 ALTER TABLE `mobile_phones` DISABLE KEYS */;
INSERT INTO `mobile_phones` VALUES (3,'iPhone 17 Air','images/apple/iphone17airjpg-1758411530.webp','Apple',999,48,'2025-09-21 04:38:50','2025-11-09 04:54:40'),(4,'iPhone 15 Pro Max','images/apple/iphone15promax-1758421143.webp','Apple',849,10,'2025-09-21 07:19:03','2025-09-21 07:19:03'),(5,'iPhone 14','http://127.0.0.1:8000/images/apple/iphone14purple-1758421202.jpg','Apple',749,10,'2025-09-21 07:20:02','2025-09-21 07:20:02'),(6,'Galaxy S24 Ultra','http://127.0.0.1:8000/images/samsung/s24ultragray-1758421282.webp','Samsung',999,30,'2025-09-21 07:21:22','2025-09-21 07:23:29'),(8,'Pixel 8 Pro','http://127.0.0.1:8000/images/google/pixel8problue-1758421397.webp','Google',899,25,'2025-09-21 07:23:17','2025-09-21 07:23:17'),(9,'Pixel 7a','http://127.0.0.1:8000/images/google/pixel7awhite-1758421450.webp','Google',649,5,'2025-09-21 07:24:10','2025-09-21 07:24:10'),(10,'13T Pro','http://127.0.0.1:8000/images/xiaomi/17tproblack-1758421535.avif','Xiaomi',999,30,'2025-09-21 07:25:28','2025-09-21 07:25:35'),(11,'OnePlus 11','http://127.0.0.1:8000/images/oneplus/oneplus11green-1758421630.jpg','OnePlus',699,14,'2025-09-21 07:27:10','2025-09-21 08:47:50'),(12,'Nord CE 3 Lite','http://127.0.0.1:8000/images/oneplus/nordce3liteyellow-1758421698.webp','OnePlus',349,37,'2025-09-21 07:28:18','2025-11-09 06:16:54'),(13,'iPhone 17 Pro Max','http://127.0.0.1:8000/images/apple/iphone17prowebp-1762646971.webp','Apple',1199,15,'2025-11-09 05:09:31','2025-11-09 05:28:02'),(14,'iPhone 16e','images/apple/iphone16e-1762669345.png','Apple',699,10,'2025-11-09 05:58:47','2025-11-09 11:22:25'),(15,'Galaxy S25 Ultra','images/samsung/s25ultra-1762669337.png','Samsung',1199,5,'2025-11-09 10:38:12','2025-11-09 11:22:17');
/*!40000 ALTER TABLE `mobile_phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `mobile_phone_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_mobile_phone_id_foreign` (`mobile_phone_id`),
  CONSTRAINT `order_items_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,3,1,999,'2025-09-21 08:33:24','2025-09-21 08:33:24'),(2,2,12,2,349,'2025-09-21 08:46:14','2025-09-21 08:46:14'),(3,3,11,1,699,'2025-09-21 08:47:50','2025-09-21 08:47:50'),(4,4,3,1,999,'2025-11-09 04:54:40','2025-11-09 04:54:40'),(5,5,12,1,349,'2025-11-09 06:16:54','2025-11-09 06:16:54');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','paid','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'2025-09-21','cancelled',999,'2025-09-21 08:33:24','2025-09-21 08:45:56'),(2,1,'2025-09-21','cancelled',698,'2025-09-21 08:46:14','2025-09-21 08:46:50'),(3,1,'2025-09-21','pending',699,'2025-09-21 08:47:50','2025-09-21 08:47:50'),(4,1,'2025-11-08','pending',999,'2025-11-09 04:54:40','2025-11-09 04:54:40'),(5,1,'2025-11-09','pending',349,'2025-11-09 06:16:54','2025-11-09 06:16:54');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `mobile_phone_id` bigint(20) unsigned NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rating` int(11) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_mobile_phone_id_foreign` (`mobile_phone_id`),
  KEY `reviews_user_id_mobile_phone_id_index` (`user_id`,`mobile_phone_id`),
  CONSTRAINT `reviews_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,3,3,'approved',4,'Muy buen celular, mala batería',NULL,'2025-09-21 05:29:23'),(3,1,3,'approved',5,'El mejor celular!','2025-09-21 07:09:29','2025-09-21 07:45:54'),(4,1,3,'approved',5,'El mejor celular que he tenido.',NULL,NULL),(5,3,4,'approved',4,'Buen rendimiento por el precio.',NULL,NULL),(6,4,5,'approved',5,'Excelente cámara y fluidez.',NULL,NULL),(7,1,6,'approved',3,'Cumple pero esperaba más de la batería.',NULL,NULL),(9,4,8,'approved',5,'Relación calidad-precio insuperable.',NULL,'2025-09-21 07:48:54'),(10,1,9,'approved',2,'La cámara nocturna es floja.',NULL,NULL),(11,3,10,'approved',3,'Aceptable, aunque algo lento en apps pesadas.',NULL,NULL),(12,4,11,'approved',4,'Buen diseño y pantalla brillante.',NULL,NULL),(13,1,12,'approved',5,'Motorola sorprende con gran calidad.',NULL,NULL),(14,3,3,'approved',4,'Gran experiencia de usuario.',NULL,NULL),(15,4,4,'approved',3,'Cumple pero no destaca en nada.',NULL,NULL),(16,1,5,'approved',5,'Fotografía profesional en el bolsillo.',NULL,NULL),(17,3,6,'approved',4,'Muy equilibrado en todo sentido.',NULL,NULL),(19,1,8,'approved',5,'Cámara y pantalla de altísima calidad.',NULL,NULL),(20,3,9,'approved',4,'Perfecto para juegos.',NULL,NULL),(21,4,10,'approved',2,'Esperaba más por el precio.',NULL,NULL),(22,1,11,'approved',4,'Buena batería, dura todo el día.',NULL,NULL),(23,3,12,'approved',5,'Muy recomendable, excelente compra.',NULL,NULL),(24,4,3,'approved',4,'Samsung de gama alta confiable.',NULL,NULL),(25,1,4,'approved',3,'Correcto pero no sorprende.',NULL,NULL),(26,3,5,'approved',5,'De lo mejor que he usado.',NULL,NULL),(27,4,6,'approved',4,'Buen rendimiento y cámaras decentes.',NULL,NULL),(29,3,8,'approved',3,'Rinde bien en general, pero no es perfecto.',NULL,NULL),(30,4,9,'approved',4,'Mejor de lo que esperaba.',NULL,'2025-09-21 07:48:56'),(31,1,10,'approved',3,'Aceptable en funciones básicas.',NULL,NULL),(32,3,11,'approved',4,'Diseño moderno y pantalla fluida.',NULL,NULL),(33,4,12,'approved',5,'Excelente compra, muy satisfecho.',NULL,NULL),(34,1,3,'rejected',5,'Es muy delgado y liviano, excelente compra!','2025-11-09 04:54:30','2025-11-09 05:02:00');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('OGOu5SnmRhECITwIVx2JWxKp9HbL6JEXiH9VbJKP',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Safari/605.1.15','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQkdvbUhVZmJ5R3VuaFFyMk9yNFJzSEhtb25qQXN5RHZPYVNEalpzbyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3JlcG9ydHMvc2FsZXMvZXhjZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6ImZsYXNoIjthOjA6e31zOjEwOiJhcHBfbG9jYWxlIjtzOjI6ImVzIjtzOjQ6ImNhcnQiO2E6MTp7czo1OiJpdGVtcyI7YToxOntpOjU7YTo3OntzOjI6ImlkIjtpOjU7czo0OiJuYW1lIjtzOjk6ImlQaG9uZSAxNCI7czo1OiJicmFuZCI7czo1OiJBcHBsZSI7czo5OiJwaG90b191cmwiO3M6NjQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbWFnZXMvYXBwbGUvaXBob25lMTRwdXJwbGUtMTc1ODQyMTIwMi5qcGciO3M6NToicHJpY2UiO2k6NzQ5O3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InN0b2NrIjtpOjEwO319fX0=',1762672723),('WcucjQL3AtXagGKGNuCSeEKj6vUC0qpHIErTUr8v',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Safari/605.1.15','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZGdiQXNNU0RDbGlyT1VXNzJ1VUdpMHZ1T0pqSXh1OFF0T09kT3JVVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzYyNjM5OTM5O31zOjQ6ImNhcnQiO2E6MDp7fXM6NToiZmxhc2giO2E6MDp7fX0=',1762651024);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specifications`
--

DROP TABLE IF EXISTS `specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `processor` varchar(255) NOT NULL,
  `battery` int(11) NOT NULL,
  `screen_size` double NOT NULL,
  `screen_tech` varchar(255) NOT NULL,
  `ram` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `camera_specs` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `mobile_phone_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `specifications_mobile_phone_id_unique` (`mobile_phone_id`),
  CONSTRAINT `specifications_mobile_phone_id_foreign` FOREIGN KEY (`mobile_phone_id`) REFERENCES `mobile_phones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specifications`
--

LOCK TABLES `specifications` WRITE;
/*!40000 ALTER TABLE `specifications` DISABLE KEYS */;
INSERT INTO `specifications` VALUES (2,'A1179','A19 Pro',3950,6.3,'OLED',8,512,'48MP','Light Blue',3,'2025-09-21 04:39:48','2025-09-21 07:31:04'),(3,'A1923','A17 Pro',4422,6.7,'OLED',8,256,'Triple 48MP + 12MP','Black Titanium',4,'2025-09-21 07:30:48','2025-09-21 07:30:48'),(4,'S8962','Snapdragon 8 Gen 3',5000,6.8,'AMOLED',12,256,'Triple 200MP + 12MP','Deep Black',6,'2025-09-21 07:32:28','2025-09-21 07:32:28'),(5,'P0900','Tensor G3',5050,6.7,'OLED',12,128,'Triple 50MP + 48MP','Sky Blue',8,'2025-09-21 07:33:22','2025-09-21 07:33:22'),(6,'X1212','Dimensity 9200+',5000,6.7,'AMOLED',12,512,'Triple 50MP','Black',10,'2025-09-21 07:34:35','2025-09-21 07:34:35'),(7,'O8765','Snapdragon 8 Gen 2',5000,6.7,'AMOLED',16,256,'Triple 50MP + 48MP + 32MP','Dark Green',11,'2025-09-21 07:36:19','2025-09-21 07:36:19'),(9,'A2309','A15 Bionic',3279,6.1,'OLED',6,128,'Dual 12MP','Light Purple',5,'2025-09-21 07:38:27','2025-09-21 07:38:27'),(10,'P0011','Snapdragon 695',5000,6.7,'IPS LCD',8,128,'Triple 108MP + Dual 2MP','Lemon',12,'2025-09-21 07:39:48','2025-09-21 07:39:48'),(11,'G3219','Tensor G2',4385,6.1,'OLED',8,128,'Dual 64MP + 3MP','Bone White',9,'2025-09-21 07:41:18','2025-09-21 07:41:18'),(12,'A2464','A19 Pro',4500,6.9,'Super Retina XDR',8,256,'Triple 48 MP','Naranja',13,'2025-11-09 05:11:42','2025-11-09 05:11:42'),(13,'A2501','A18',2918,6.1,'Super Retina XDR',6,128,'12MP','Black',14,'2025-11-09 05:59:43','2025-11-09 05:59:43'),(14,'S4543','Snapdragon 8 Elite',4000,6.2,'Dynamic LTPO AMOLED X',12,256,'Triple 50MP + 12MP + 12MP','Negro Titanio',15,'2025-11-09 10:52:35','2025-11-09 10:52:35');
/*!40000 ALTER TABLE `specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alejandro Carmona','alejocar04@hotmail.com',4651.00,NULL,'$2y$12$vvXHManyhyuEwsGcHWrqrezngzgdswHgB/b/5QgzPxAdEjBAliyu.','FfzFBb0AhudaEtSWhOU5MFgi3GNPM2mISFSUyWG3I1X6S5zTREsZ5oUa62o1','2025-09-19 04:56:25','2025-11-09 09:58:34',1,'3052960278','Cra. 46A # 29 SUR-29, Zona 2, Envigado, Antioquia, Colombia'),(3,'Miguel A. Arcila','miguel107@gmail.com',1500.00,NULL,'$2y$12$Vg9rfkW2zwbpEiU1KfKfuO6w2NooBJxFMZf1BNObvQIGfbvadUr0C',NULL,'2025-09-20 23:58:44','2025-11-09 10:01:06',0,'3052960278','Cl. 3 # 43B-48, El Poblado, Medellín, El Poblado, Medellín, Antioquia, Colombia'),(4,'Santiago Sabogal','santiago104@gmail.com',0.00,NULL,'$2y$12$/JnHAg1kNNcxtp503x8gmedJueoPRYennaP7KgGEO7FILBgSVkh7e',NULL,'2025-09-21 00:30:33','2025-11-09 05:27:49',1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-09 14:44:52
