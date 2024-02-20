-- -------------------------------------------------------------
-- TablePlus 5.9.0(538)
--
-- https://tableplus.com/
--
-- Database: jasa_pemod
-- Generation Time: 2024-02-20 10:37:29.7370
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_request_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_offering_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` int NOT NULL,
  `status_bill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`),
  UNIQUE KEY `clients_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_types`;
CREATE TABLE `job_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_type_job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_types_name_type_job_unique` (`name_type_job`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jobs_name_job_unique` (`name_job`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pay_orders`;
CREATE TABLE `pay_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_order` int NOT NULL,
  `status_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date_project` date NOT NULL,
  `end_date_project` date NOT NULL,
  `price_project` int NOT NULL,
  `detail_project` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `purchase_details`;
CREATE TABLE `purchase_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unitcost` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_purchase_order` int NOT NULL,
  `status_purchase_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `refrence_companies`;
CREATE TABLE `refrence_companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_bank_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `refrence_languages`;
CREATE TABLE `refrence_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `service_offerings`;
CREATE TABLE `service_offerings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_service_offerings` int NOT NULL,
  `detail_service_offerings` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `service_requests`;
CREATE TABLE `service_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_service_request` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date_service_request` date NOT NULL,
  `end_date_service_request` date NOT NULL,
  `price_service_request` int NOT NULL,
  `detail_service_request` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bills` (`id`, `project_id`, `service_request_id`, `service_offering_id`, `total_price`, `status_bill`, `created_at`, `updated_at`) VALUES
(1, '2', NULL, NULL, 5000, '0', '2024-02-20 02:23:27', '2024-02-20 02:23:27');

INSERT INTO `job_types` (`id`, `name_type_job`, `created_at`, `updated_at`) VALUES
(3, 'a', '2024-02-19 05:54:31', '2024-02-19 05:54:31');

INSERT INTO `jobs` (`id`, `job_type_id`, `name_job`, `created_at`, `updated_at`) VALUES
(2, '3', 'Job A', '2024-02-19 07:27:39', '2024-02-19 07:27:39');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_30_072200_add_username_and_phoro_to_users_table', 1),
(6, '2023_04_30_150318_create_customers_table', 1),
(7, '2023_05_01_111143_create_suppliers_table', 1),
(8, '2023_05_02_114617_create_categories_table', 1),
(9, '2023_05_02_122454_create_units_table', 1),
(10, '2023_05_02_140630_create_products_table', 1),
(11, '2023_05_04_084431_create_orders_table', 1),
(12, '2023_05_04_084646_create_order_details_table', 1),
(13, '2023_05_04_173440_create_shoppingcart_table', 1),
(14, '2023_05_06_142348_create_purchases_table', 1),
(15, '2023_05_06_143104_create_purchase_details_table', 1),
(16, '2024_02_19_012918_create_clients_table', 2),
(17, '2024_02_19_014807_create_job_types_table', 3),
(18, '2024_02_19_015023_create_jobs_table', 3),
(19, '2024_02_19_015039_create_projects_table', 4),
(20, '2024_02_19_015121_create_service_offerings_table', 5),
(21, '2024_02_19_015127_create_service_requests_table', 5),
(22, '2024_02_19_015148_create_bills_table', 5),
(23, '2024_02_19_015244_create_pay_orders_table', 5),
(24, '2024_02_19_015256_create_purchase_orders_table', 5),
(25, '2024_02_19_015312_create_refrence_companies_table', 5),
(26, '2024_02_19_015318_create_refrence_languages_table', 5);

INSERT INTO `projects` (`id`, `job_id`, `name_project`, `start_date_project`, `end_date_project`, `price_project`, `detail_project`, `created_at`, `updated_at`) VALUES
(2, '2', '8h0Lwo3pXj', '2024-02-19', '2024-02-20', 6000, 'Q8rRQxx2Ti', '2024-02-20 01:40:45', '2024-02-20 01:40:45');

INSERT INTO `purchase_orders` (`id`, `order_id`, `total_purchase_order`, `status_purchase_order`, `created_at`, `updated_at`) VALUES
(1, '2', 698682, '0', '2024-02-20 03:06:03', '2024-02-20 03:06:03'),
(2, '2', 698682, '0', '2024-02-20 03:06:03', '2024-02-20 03:06:03'),
(3, '2', 698682, '0', '2024-02-20 03:06:03', '2024-02-20 03:06:03'),
(4, '2', 698682, '0', '2024-02-20 03:06:03', '2024-02-20 03:06:03');

INSERT INTO `refrence_companies` (`id`, `name_company`, `email_company`, `account_bank_company`, `phone_company`, `created_at`, `updated_at`) VALUES
(2, 'Comp', 'yjnac@7ylq.com', '16BDsYkWj4', '9635601906', '2024-02-19 09:22:24', '2024-02-19 09:22:24');

INSERT INTO `service_offerings` (`id`, `job_id`, `company_id`, `price_service_offerings`, `detail_service_offerings`, `created_at`, `updated_at`) VALUES
(2, '2', '2', 100, 'caiRt7mSea', '2024-02-20 01:40:55', '2024-02-20 01:40:55');

INSERT INTO `service_requests` (`id`, `job_id`, `company_id`, `name_service_request`, `start_date_service_request`, `end_date_service_request`, `price_service_request`, `detail_service_request`, `created_at`, `updated_at`) VALUES
(2, '2', '2', '0cGIDJczCr', '2024-02-20', '2024-02-21', 166412, 'aXpWtSpheb', '2024-02-20 01:41:06', '2024-02-20 01:41:06');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `photo`) VALUES
(1, 'Admin', 'admin@gmail.com', '2024-02-18 05:45:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IyN0thZypb', '2024-02-18 05:45:01', '2024-02-19 03:43:00', 'admin', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;