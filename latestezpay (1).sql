-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2020 at 04:18 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latestezpay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Dashboard', 'fa-bar-chart', '/', NULL, NULL, NULL),
(2, 0, 4, 'Admin', 'fa-tasks', '', NULL, NULL, '2020-08-11 10:48:53'),
(3, 2, 5, 'Users', 'fa-users', 'auth/users', NULL, NULL, '2020-08-11 10:48:53'),
(4, 2, 6, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, '2020-08-11 10:48:53'),
(5, 2, 7, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, '2020-08-11 10:48:53'),
(6, 2, 8, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, '2020-08-11 10:48:53'),
(7, 2, 9, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, '2020-08-11 10:48:53'),
(8, 0, 2, 'Patients', 'fa-user', 'patients', '*', '2020-08-08 05:59:31', '2020-08-11 10:48:58'),
(9, 0, 3, 'Locations', 'fa-location-arrow', 'locations', '*', '2020-08-11 10:48:40', '2020-08-11 10:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin_operation_log`
--

DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE IF NOT EXISTS `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_operation_log`
--

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-06 13:59:45', '2020-08-06 13:59:45'),
(2, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-06 14:01:32', '2020-08-06 14:01:32'),
(3, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-06 14:02:48', '2020-08-06 14:02:48'),
(4, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-06 14:02:57', '2020-08-06 14:02:57'),
(5, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-06 14:09:53', '2020-08-06 14:09:53'),
(6, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-08 05:58:57', '2020-08-08 05:58:57'),
(7, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 05:59:05', '2020-08-08 05:59:05'),
(8, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Patients\",\"icon\":\"fa-user\",\"uri\":\"patients\",\"roles\":[\"1\",null],\"permission\":\"*\",\"_token\":\"Ov36OJxamXRX6bsfjdYFpmnF9sbz28QIw2cV77HY\"}', '2020-08-08 05:59:31', '2020-08-08 05:59:31'),
(9, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2020-08-08 05:59:31', '2020-08-08 05:59:31'),
(10, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_token\":\"Ov36OJxamXRX6bsfjdYFpmnF9sbz28QIw2cV77HY\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2020-08-08 05:59:36', '2020-08-08 05:59:36'),
(11, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 05:59:37', '2020-08-08 05:59:37'),
(12, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2020-08-08 05:59:41', '2020-08-08 05:59:41'),
(13, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 05:59:46', '2020-08-08 05:59:46'),
(14, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:05:51', '2020-08-08 06:05:51'),
(15, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:06:21', '2020-08-08 06:06:21'),
(16, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:23:14', '2020-08-08 06:23:14'),
(17, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:23:31', '2020-08-08 06:23:31'),
(18, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:27:21', '2020-08-08 06:27:21'),
(19, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:28:21', '2020-08-08 06:28:21'),
(20, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 06:41:12', '2020-08-08 06:41:12'),
(21, 1, 'admin/patients', 'GET', '127.0.0.1', '[]', '2020-08-08 09:44:27', '2020-08-08 09:44:27'),
(22, 1, 'admin/patients/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 09:44:40', '2020-08-08 09:44:40'),
(23, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:47:39', '2020-08-08 09:47:39'),
(24, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:49:08', '2020-08-08 09:49:08'),
(25, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:54:49', '2020-08-08 09:54:49'),
(26, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:55:09', '2020-08-08 09:55:09'),
(27, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:55:15', '2020-08-08 09:55:15'),
(28, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 09:55:44', '2020-08-08 09:55:44'),
(29, 1, 'admin/patients/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 09:55:50', '2020-08-08 09:55:50'),
(30, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-08 09:57:53', '2020-08-08 09:57:53'),
(31, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-08 09:57:59', '2020-08-08 09:57:59'),
(32, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-09 07:19:49', '2020-08-09 07:19:49'),
(33, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-09 07:19:52', '2020-08-09 07:19:52'),
(34, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_export_\":\"all\"}', '2020-08-09 07:20:01', '2020-08-09 07:20:01'),
(35, 1, 'admin/patients/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-09 07:28:55', '2020-08-09 07:28:55'),
(36, 1, 'admin/patients/1', 'GET', '127.0.0.1', '[]', '2020-08-09 07:59:24', '2020-08-09 07:59:24'),
(37, 1, 'admin', 'GET', '127.0.0.1', '[]', '2020-08-11 10:47:55', '2020-08-11 10:47:55'),
(38, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 10:48:08', '2020-08-11 10:48:08'),
(39, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Locations\",\"icon\":\"fa-location-arrow\",\"uri\":\"locations\",\"roles\":[\"1\",null],\"permission\":\"*\",\"_token\":\"KwMWCylesLL6VIWzuNfmNAxEpvUlJqENs3BWxVuA\"}', '2020-08-11 10:48:40', '2020-08-11 10:48:40'),
(40, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2020-08-11 10:48:41', '2020-08-11 10:48:41'),
(41, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_token\":\"KwMWCylesLL6VIWzuNfmNAxEpvUlJqENs3BWxVuA\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":9},{\\\"id\\\":8},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2020-08-11 10:48:53', '2020-08-11 10:48:53'),
(42, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 10:48:53', '2020-08-11 10:48:53'),
(43, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_token\":\"KwMWCylesLL6VIWzuNfmNAxEpvUlJqENs3BWxVuA\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":8},{\\\"id\\\":9},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2020-08-11 10:48:58', '2020-08-11 10:48:58'),
(44, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 10:48:58', '2020-08-11 10:48:58'),
(45, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2020-08-11 11:04:13', '2020-08-11 11:04:13'),
(46, 1, 'admin/locations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 11:04:15', '2020-08-11 11:04:15'),
(47, 1, 'admin/locations', 'GET', '127.0.0.1', '[]', '2020-08-11 11:06:20', '2020-08-11 11:06:20'),
(48, 1, 'admin/locations/3/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 11:07:05', '2020-08-11 11:07:05'),
(49, 1, 'admin/locations/3', 'PUT', '127.0.0.1', '{\"name\":\"16345 South Post Oak Road, Houston TX 77054\",\"status\":\"on\",\"_token\":\"KwMWCylesLL6VIWzuNfmNAxEpvUlJqENs3BWxVuA\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/locations\"}', '2020-08-11 11:07:10', '2020-08-11 11:07:10'),
(50, 1, 'admin/locations', 'GET', '127.0.0.1', '[]', '2020-08-11 11:07:11', '2020-08-11 11:07:11'),
(51, 1, 'admin/patients', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 11:07:15', '2020-08-11 11:07:15'),
(52, 1, 'admin/locations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2020-08-11 11:07:18', '2020-08-11 11:07:18'),
(53, 1, 'admin/locations', 'GET', '127.0.0.1', '[]', '2020-08-11 11:07:30', '2020-08-11 11:07:30'),
(54, 1, 'admin/locations', 'GET', '127.0.0.1', '[]', '2020-08-11 11:08:21', '2020-08-11 11:08:21'),
(55, 1, 'admin/locations', 'GET', '127.0.0.1', '[]', '2020-08-11 11:14:04', '2020-08-11 11:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE IF NOT EXISTS `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2020-08-06 13:59:05', '2020-08-06 13:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE IF NOT EXISTS `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(1, 8, NULL, NULL),
(1, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_permissions`
--

DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_users`
--

DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE IF NOT EXISTS `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$YXI.SdGCI7G6Awlu34hfX.6yW5ZAm5ui5xgCwnLndSlrztDNJNUby', 'Administrator', NULL, 'vwdTLL12jVsEUANWo4WYSnxUJKDCgggy2bh9cBZ2hMxPHLFe7KqKs0AUk6ra', '2020-08-06 13:59:05', '2020-08-06 13:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_permissions`
--

DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE IF NOT EXISTS `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_code`, `code`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', 'US', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '8150 Southwest Freeway, Houston TX 77074', 1, NULL, NULL, NULL),
(2, '6903 Brisbane Court,\r\nSuite 100 Sugarland TX \r\n77479', 1, NULL, NULL, NULL),
(3, '16345 South Post Oak Road, Houston TX 77054', 1, NULL, NULL, '2020-08-11 11:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_04_173148_create_admin_tables', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_08_07_175522_create_patients_table', 2),
(6, '2020_08_08_102134_create_countries_table', 2),
(7, '2020_08_08_102719_create_locations_table', 2),
(8, '2020_08_08_114823_create_states_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `cell_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countryId` int(11) DEFAULT NULL,
  `locationId` int(11) DEFAULT NULL,
  `appointment` datetime DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `stateId` int(11) NOT NULL,
  `terms` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countryId` (`countryId`),
  KEY `locationId` (`locationId`),
  KEY `stateId` (`stateId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `email_address`, `gender`, `dob`, `cell_phone`, `landline`, `zipcode`, `countryId`, `locationId`, `appointment`, `city`, `address`, `stateId`, `terms`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'asjkalj', 'sakljasklj', 'aslja@gma.com', 'male', '2020-08-08', '129-819-2819', NULL, '1212', 1, 1, '2020-08-08 19:40:00', 'lahroe', 'ajksakljaskl', 1, NULL, 1, NULL, '2020-08-07 21:44:04', '2020-08-08 09:44:04'),
(2, 'asjkalj', 'sakljasklj', 'aslja@gma.com', 'male', '2020-08-08', '129-819-2819', NULL, '1212', 1, 1, '2020-08-28 19:55:00', 'lahroe', 'ajksakljaskl', 1, NULL, 1, NULL, '2020-08-07 21:48:59', '2020-08-08 09:48:59'),
(3, 'asuaisj', 'asaklsajkl', 'sasjkalj2@m.com', 'male', '2020-08-08', '212-111-2121', NULL, '12', 1, 1, '2020-08-08 19:55:00', 'qjk', 'aksjaksaklajkl', 1, NULL, 1, NULL, '2020-08-07 21:52:50', '2020-08-08 09:52:50'),
(4, 'klajsklajakl', 'skajsklasjkl', 'akjsalkjkl2@gmail.com', 'male', '2020-08-08', '212-111-1221', NULL, '2121', 1, 1, '2020-08-08 19:53:00', 'klajsaklsjk', 'kajljaklajskl', 1, 1, 1, NULL, '2020-08-07 21:53:41', '2020-08-08 09:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `code`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alabama', 'AL', 1, NULL, NULL, NULL),
(2, 'Alaska', 'AK', 1, NULL, NULL, NULL),
(3, 'American Samoa', 'AS', 1, NULL, NULL, NULL),
(4, 'Arizona', 'AZ', 1, NULL, NULL, NULL),
(5, 'Arkansas', 'AR', 1, NULL, NULL, NULL),
(6, 'California', 'CA', 1, NULL, NULL, NULL),
(7, 'Colorado', 'CO', 1, NULL, NULL, NULL),
(8, 'Connecticut', 'CT', 1, NULL, NULL, NULL),
(9, 'Delaware', 'DE', 1, NULL, NULL, NULL),
(10, 'District of Columbia', 'DC', 1, NULL, NULL, NULL),
(11, 'Federated States of Micronesia', 'FM', 1, NULL, NULL, NULL),
(12, 'Florida', 'FL', 1, NULL, NULL, NULL),
(13, 'Georgia', 'GA', 1, NULL, NULL, NULL),
(14, 'Guam', 'GU', 1, NULL, NULL, NULL),
(15, 'Hawaii', 'HI', 1, NULL, NULL, NULL),
(16, 'Idaho', 'ID', 1, NULL, NULL, NULL),
(17, 'Illinois', 'IL', 1, NULL, NULL, NULL),
(18, 'Indiana', 'IN', 1, NULL, NULL, NULL),
(19, 'Iowa', 'IA', 1, NULL, NULL, NULL),
(20, 'Kansas', 'KS', 1, NULL, NULL, NULL),
(21, 'Kentucky', 'KY', 1, NULL, NULL, NULL),
(22, 'Louisiana', 'LA', 1, NULL, NULL, NULL),
(23, 'Maine', 'ME', 1, NULL, NULL, NULL),
(24, 'Marshall Islands', 'MH', 1, NULL, NULL, NULL),
(25, 'Maryland', 'MD', 1, NULL, NULL, NULL),
(26, 'Massachusetts', 'MA', 1, NULL, NULL, NULL),
(27, 'Michigan', 'MI', 1, NULL, NULL, NULL),
(28, 'Minnesota', 'MN', 1, NULL, NULL, NULL),
(29, 'Mississippi', 'MS', 1, NULL, NULL, NULL),
(30, 'Missouri', 'MO', 1, NULL, NULL, NULL),
(31, 'Montana', 'MT', 1, NULL, NULL, NULL),
(32, 'Nebraska', 'NE', 1, NULL, NULL, NULL),
(33, 'Nevada', 'NV', 1, NULL, NULL, NULL),
(34, 'New Hampshire', 'NH', 1, NULL, NULL, NULL),
(35, 'New Jersey', 'NJ', 1, NULL, NULL, NULL),
(36, 'New Mexico', 'NM', 1, NULL, NULL, NULL),
(37, 'New York', 'NY', 1, NULL, NULL, NULL),
(38, 'North Carolina', 'NC', 1, NULL, NULL, NULL),
(39, 'North Dakota', 'ND', 1, NULL, NULL, NULL),
(40, 'Northern Mariana Islands', 'MP', 1, NULL, NULL, NULL),
(41, 'Ohio', 'OH', 1, NULL, NULL, NULL),
(42, 'Oklahoma', 'OK', 1, NULL, NULL, NULL),
(43, 'Oregon', 'OR', 1, NULL, NULL, NULL),
(44, 'Palau', 'PW', 1, NULL, NULL, NULL),
(45, 'Pennsylvania', 'PA', 1, NULL, NULL, NULL),
(46, 'Puerto Rico', 'PR', 1, NULL, NULL, NULL),
(47, 'Rhode Island', 'RI', 1, NULL, NULL, NULL),
(48, 'South Carolina', 'SC', 1, NULL, NULL, NULL),
(49, 'South Dakota', 'SD', 1, NULL, NULL, NULL),
(50, 'Tennessee', 'TN', 1, NULL, NULL, NULL),
(51, 'Texas', 'TX', 1, NULL, NULL, NULL),
(52, 'Utah', 'UT', 1, NULL, NULL, NULL),
(53, 'Vermont', 'VT', 1, NULL, NULL, NULL),
(54, 'Virgin Islands', 'VI', 1, NULL, NULL, NULL),
(55, 'Virginia', 'VA', 1, NULL, NULL, NULL),
(56, 'Washington', 'WA', 1, NULL, NULL, NULL),
(57, 'West Virginia', 'WV', 1, NULL, NULL, NULL),
(58, 'Wisconsin', 'WI', 1, NULL, NULL, NULL),
(59, 'Wyoming', 'WY', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
