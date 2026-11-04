-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2025 at 11:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asa_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('national','international','local') NOT NULL DEFAULT 'local',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_topic`
--

CREATE TABLE `article_topic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_requests`
--

CREATE TABLE `assessment_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `security_assessment` tinyint(1) NOT NULL,
  `quality_assessment` tinyint(1) NOT NULL,
  `person_type` enum('natural_person','legal_person') NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_national_id` varchar(255) DEFAULT NULL,
  `applicant_economic_code` varchar(255) DEFAULT NULL,
  `applicant_landline_phone` varchar(255) DEFAULT NULL,
  `applicant_mobile_phone` varchar(255) DEFAULT NULL,
  `applicant_email` varchar(255) DEFAULT NULL,
  `applicant_fax` varchar(255) DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `manager_national_id` varchar(255) DEFAULT NULL,
  `manager_phone` varchar(255) DEFAULT NULL,
  `manager_email` varchar(255) DEFAULT NULL,
  `technical_manager_name` varchar(255) DEFAULT NULL,
  `technical_manager_national_id` varchar(255) DEFAULT NULL,
  `technical_manager_phone` varchar(255) DEFAULT NULL,
  `technical_manager_email` varchar(255) DEFAULT NULL,
  `product_type` enum('local','non_local') NOT NULL DEFAULT 'local',
  `product_name` varchar(255) NOT NULL,
  `product_brand_name` varchar(255) DEFAULT NULL,
  `software_version` varchar(255) DEFAULT NULL,
  `client_server` tinyint(1) NOT NULL,
  `mobile_application` tinyint(1) NOT NULL,
  `desktop_application` tinyint(1) NOT NULL,
  `web_application` tinyint(1) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_requests`
--

INSERT INTO `assessment_requests` (`id`, `user_id`, `security_assessment`, `quality_assessment`, `person_type`, `applicant_name`, `applicant_national_id`, `applicant_economic_code`, `applicant_landline_phone`, `applicant_mobile_phone`, `applicant_email`, `applicant_fax`, `manager_name`, `manager_national_id`, `manager_phone`, `manager_email`, `technical_manager_name`, `technical_manager_national_id`, `technical_manager_phone`, `technical_manager_email`, `product_type`, `product_name`, `product_brand_name`, `software_version`, `client_server`, `mobile_application`, `desktop_application`, `web_application`, `product_description`, `file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 1, 0, 'legal_person', 'مرکز پژوهشی امنیت سایبری شرق', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'local', 'وبسایت مرکز پژوهشی امنیت سایبری شرق', NULL, '1.0.0', 1, 0, 0, 1, 'وبسایت مرکز پژوهشی آسا شرق با فریم‌ورک لاراول (ورژن 9) توسعه داده شده است.', '1_2025_09_02_174432.zip', '2025-09-02 13:14:32', '2025-09-02 13:14:32', NULL),
(6, 50, 1, 1, 'natural_person', 'علی زاهدی', '5552225', '555222558', '233325225', '091555555555', 'abb@abn.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'local', 'hhd', 'sse', '2.52', 1, 1, 1, 1, NULL, '50_2025_09_27_230521.rar', '2025-09-27 19:35:21', '2025-09-27 19:35:21', NULL),
(7, 54, 1, 0, 'legal_person', 'یگانه شکیب', '0770271855', NULL, NULL, '09303490856', 'shakibyeganeh@gmail.com', NULL, 'اقای سالخورده', NULL, '09151135801', NULL, 'عرفان حیدریان', NULL, '09153266958', NULL, 'local', 'سایت مرکز آسا شرق', NULL, '1', 0, 0, 0, 1, 'سایت مرتبط با مرکز آسا شرق', '54_2025_10_04_214321.zip', '2025-10-04 18:13:21', '2025-10-04 18:13:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_request_checklists`
--

CREATE TABLE `assessment_request_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assessment_request_id` bigint(20) UNSIGNED NOT NULL,
  `qa_product_catalog` tinyint(1) DEFAULT NULL,
  `qa_user_manual` tinyint(1) DEFAULT NULL,
  `qa_basic_procedures_description` tinyint(1) DEFAULT NULL,
  `qa_product_security_requirements` tinyint(1) DEFAULT NULL,
  `qa_product_release_version` tinyint(1) DEFAULT NULL,
  `qa_product_architecture` tinyint(1) DEFAULT NULL,
  `qa_database_documentation` tinyint(1) DEFAULT NULL,
  `qa_non_functional_requirements` tinyint(1) DEFAULT NULL,
  `qa_system_diagrams` tinyint(1) DEFAULT NULL,
  `qa_questionnaire` tinyint(1) DEFAULT NULL,
  `qa_manufacturer_info` tinyint(1) DEFAULT NULL,
  `qa_maintenance_manual` tinyint(1) DEFAULT NULL,
  `qa_communication_protocols` tinyint(1) DEFAULT NULL,
  `qa_programming_environment` tinyint(1) DEFAULT NULL,
  `sa_product_catalog` tinyint(1) DEFAULT NULL,
  `sa_user_manual` tinyint(1) DEFAULT NULL,
  `sa_product_identity` tinyint(1) DEFAULT NULL,
  `sa_product_security_requirements` tinyint(1) DEFAULT NULL,
  `sa_analysis_design_doc` tinyint(1) DEFAULT NULL,
  `sa_product_architecture` tinyint(1) DEFAULT NULL,
  `sa_security_target_doc` tinyint(1) DEFAULT NULL,
  `sa_product_release_version` tinyint(1) DEFAULT NULL,
  `sa_agd` tinyint(1) DEFAULT NULL,
  `sa_alc` tinyint(1) DEFAULT NULL,
  `sa_adv` tinyint(1) DEFAULT NULL,
  `sa_crypto_capability_declaration` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_request_checklists`
--

INSERT INTO `assessment_request_checklists` (`id`, `assessment_request_id`, `qa_product_catalog`, `qa_user_manual`, `qa_basic_procedures_description`, `qa_product_security_requirements`, `qa_product_release_version`, `qa_product_architecture`, `qa_database_documentation`, `qa_non_functional_requirements`, `qa_system_diagrams`, `qa_questionnaire`, `qa_manufacturer_info`, `qa_maintenance_manual`, `qa_communication_protocols`, `qa_programming_environment`, `sa_product_catalog`, `sa_user_manual`, `sa_product_identity`, `sa_product_security_requirements`, `sa_analysis_design_doc`, `sa_product_architecture`, `sa_security_target_doc`, `sa_product_release_version`, `sa_agd`, `sa_alc`, `sa_adv`, `sa_crypto_capability_declaration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 0, '2025-09-08 07:23:18', '2025-09-08 07:23:18', NULL),
(9, 6, 0, 1, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2025-09-27 19:35:49', '2025-09-27 19:35:49', NULL),
(10, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, '2025-10-04 18:15:23', '2025-10-04 18:15:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_news`
--

CREATE TABLE `category_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `news_id`, `article_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'خدا قوت', 1, 2, NULL, 'pending', '2025-09-27 18:45:01', '2025-09-27 18:45:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2019_08_19_000000_create_failed_jobs_table', 1),
(64, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(65, '2025_03_18_180000_create_news_table', 1),
(66, '2025_03_18_181000_create_articles_table', 1),
(67, '2025_03_18_182000_create_comments_table', 1),
(68, '2025_03_18_183000_create_permission_tables', 1),
(69, '2025_06_30_120000_create_sliders_table', 1),
(70, '2025_07_05_200000_create_assessment_requests_table', 1),
(71, '2025_07_05_201000_create_assessment_request_checklists_table', 1),
(72, '2025_07_05_202000_create_projects_table', 1),
(73, '2025_07_05_203000_create_tickets_table', 1),
(74, '2025_08_26_200000_create_sessions_table', 1),
(75, '2025_09_30_160000_create_categories_table', 1),
(76, '2025_09_30_161000_create_category_news_table', 1),
(77, '2025_09_30_162000_create_topics_table', 1),
(78, '2025_09_30_163000_create_article_topic_table', 1),
(79, '2025_09_30_170000_create_standards_table', 1),
(80, '2025_09_30_171000_create_certificates_table', 1),
(81, '2025_09_30_172000_create_achievements_table', 1),
(82, '2025_12_edit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 25),
(2, 'App\\Models\\User', 27),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 51),
(2, 'App\\Models\\User', 52),
(2, 'App\\Models\\User', 53),
(2, 'App\\Models\\User', 54),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 50),
(8, 'App\\Models\\User', 16),
(8, 'App\\Models\\User', 26),
(8, 'App\\Models\\User', 29),
(9, 'App\\Models\\User', 24),
(9, 'App\\Models\\User', 33);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slider_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`slider_images`)),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `slider_images`, `user_id`, `status`, `is_archived`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'برگزاری مسابقه امنیت سایبری - فتح پرچم در دانشگاه سجاد', '<p style=\"text-align: justify; \">                    مسابقه فتح پرچم در روز پنجشنبه مورخ ۲۱ فروردین ۱۴۰۴ در محل دانشگاه سجاد با حمایت مرکز مدیریت راهبردی افتای خراسان رضوی و شرکت خدمات علمی صنعتی خراسان برگزار گردید.&nbsp;<span style=\"color: rgb(33, 37, 41); background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">اهداف اولیه این مسابقه، آشنایی دانشجویان رشته کامپیوتر با مباحث مختلف امنیت سایبری و استعدادیابی در این حوزه می‌باشد.&nbsp;</span><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">این مسابقه از ساعت ۷:۳۰ لغایت ۱۴ ادامه داشته نتایج به شرح زیر اعلام می‌گردد:</span></p><table class=\"table table-bordered\"><tbody><tr><td style=\"text-align: center; \"><b>رتبه</b></td><td style=\"text-align: center;\"><b>نام دانشگاه</b></td><td style=\"text-align: center; \"><b>اسم تیم</b></td><td style=\"text-align: center; \"><b>نام اعضای تیم</b></td></tr><tr><td style=\"text-align: center;\">1</td><td style=\"text-align: center; \">شهید منتظری</td><td style=\"text-align: center; \">Sucrose</td><td style=\"text-align: center; \">امیر‌حسین زیبایی - حمیدرضا حمیدی</td></tr><tr><td style=\"text-align: center;\">2</td><td style=\"text-align: center; \">امام رضا</td><td style=\"text-align: center; \">Null</td><td style=\"text-align: center; \">محمد خراشادی‌زاده - امیر زارع -&nbsp; مصطفی خراشادی‌زاده</td></tr><tr><td style=\"text-align: center;\">3</td><td style=\"text-align: center; \">صنعتی قوچان</td><td style=\"text-align: center; \">Access Point</td><td style=\"text-align: center; \">پوریا خندان - علی غفاریان</td></tr><tr><td style=\"text-align: center;\">4</td><td style=\"text-align: center; \">امام رضا</td><td style=\"text-align: center; \">Neuron</td><td style=\"text-align: center; \">سید امیررضا حسینی - محمدیاسین علی‌آبادی</td></tr><tr><td style=\"text-align: center;\">5</td><td style=\"text-align: center; \">امام رضا</td><td style=\"text-align: center; \">Black Pixel</td><td style=\"text-align: center; \">علی‌اکبر رضایوف - نیما اسلامی - علی حق‌شناس</td></tr></tbody></table><p><br></p><p>سایت مسابقه:&nbsp; 🖇 <a href=\"https://mashhad-ctf.ir\" target=\"_blank\">https://mashhad-ctf.ir</a><a href=\"https://mashhad-ctf.ir\" target=\"_blank\"></a></p><p><br></p><p>\r\n\r\n\r\n                </p>', '6851c516ba5ae.jpg', NULL, 1, 'approved', 0, '2025-05-18 18:25:44', '2025-09-11 16:05:10', NULL),
(2, 'مراسم اختتامیه مسابقه فتح پرچم (CTF)', '<p style=\"text-align: justify; \"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">نخستین دوره از مسابقات سراسری فتح پرچم با محتوای  امنیت سایبری با حضور دکتر طالبی معاونت آموزش و تحقیقات و دکتر مظهر معاونت فنی مرکز مدیریت راهبردی افتای ریاست جمهوری به همراه مهندس آقایی رئیس مرکز مدیریت راهبردی افتای</span><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;خراسان رضوی و معاونین در مورخ ۱۴۰۴/۱/۲۱ در محل دانشگاه سجاد برگزار گردید. در این دوره از مسابقات تعداد ۱۲۰ شرکت‌کننده در قالب ۵۳ تیم از دانشگاه‌های برجسته استان خراسان بزرگ حضور داشتند.</span></p><p style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><br></span></p>', '685123ba7b0ea.jpg', '[\"6867fffa759d2.jpg\",\"6867fffa7bf63.jpg\"]', 1, 'approved', 0, '2025-06-11 18:40:05', '2025-08-01 10:06:49', NULL),
(3, 'فراخوان جشنواره کاهش آسیب‌های فضای مجازی', '<p><div style=\"text-align: justify;\"><span style=\"color: rgb(33, 37, 41); background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">اگر دغدغه آسیب‌های فضای مجازی را دارید،</span></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">اگر دستی بر قلم، دوربین، ایده یا طراحی دارید،</span></div></span><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">و اگر می‌خواهید در مسیر اصلاح فرهنگی جامعه نقش‌آفرین باشید، در این حرکت فرهنگی اثرگذار، سهیم باشید.</span></div></span><div style=\"text-align: justify;\"><font color=\"#212529\"><br></font></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">از همه‌ی علاقه‌مندان، اساتید، معلمان، هنرمندان، دانشجویان، دانش‌آموزان، شرکتها و فعالان رسانه‌ای و دغدغه‌مند دعوت می‌شود تا آثار خلاقانه و اثرگذار خود را در خصوص محورهای جشنواره برای دبیرخانه ارسال نمایند.</span></div></span><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">آخرین مهلت ارسال آثار: </span><u style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">۳۱ مرداد ماه ۱۴۰۴</u></div></span><div style=\"text-align: justify;\"><font color=\"#212529\"><br></font></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">اطلاعات بیشتر و ارسال آثار از طریق وب سایت جشنواره به آدرس&nbsp;</span><a href=\"http://www.smartngo.ir\" target=\"_blank\" style=\"font-family: Vazir, IRANSans; font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">www.smartngo.ir</a></div></span><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">یا نشانی khrsmartngo@ در شبکه های اجتماعی و پیام‌رسان‌ها</span></div></span><div style=\"text-align: justify;\"><font color=\"#212529\"><br></font></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">به آثار منتخب 2.000.000.000 ریال جایزه نقدی و جوایز ارزنده غیر نقد دیگر اهدا خواهد شد.</span></div></span><div style=\"text-align: justify;\"><font color=\"#212529\"><br></font></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">منتظر خلاقیت‌های شما هستیم!</span></div></span><div style=\"text-align: justify;\"><font color=\"#212529\"><br></font></div><span style=\"color: rgb(33, 37, 41);\"><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">(انجمن عام‌المنفعه هوشمندسازی استان خراسان رضوی)</span></div></span></p><p><br></p>', '684b391edc075.jpg', NULL, 1, 'approved', 0, '2025-06-12 19:31:26', '2025-08-01 10:07:30', NULL),
(4, 'مراسم تقدیر از کادر اجرایی مسابقه فتح پرچم', '<div style=\"text-align: justify; \"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">مراسم تقدیر و تشکر از کادر اجرایی مسابقه فتح پرچم، روز سه‌شنبه، ۳۱ اردیبهشت ماه، با حضور نمایندگان محترم مرکز مدیریت راهبردی افتای خراسان رضوی و جمعی از مسئولین دانشگاه سجاد در محل این دانشگاه&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); background-color: var(--bs-body-bg);\">به منظور ارج نهادن به تلاش‌های بی‌وقفه و زحمات شبانه‌روزی دست‌اندرکاران و کادر اجرایی مسابقه فتح پرچم برگزار شد. سخنرانان در این مراسم، ضمن تقدیر از سطح برگزاری و کیفیت بالای مسابقه، بر اهمیت برگزاری رویدادهایی از این دست در راستای کشف و پرورش استعدادهای جوان در حوزه امنیت سایبری تأکید کردند.</span><br></div><div><div style=\"outline: none !important;\"><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\"><span style=\"background-color: var(--bs-body-bg); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">در پایان، با اهدای لوح تقدیر و هدایایی، از زحمات و همکاری‌های ارزشمند تمامی اعضای کادر اجرایی مسابقه فتح پرچم قدردانی به عمل آمد.</span></div></div><div style=\"outline: none !important;\"><br></div></div>', '68507685b665c.jpg', '[\"6862b9a95ab2c.jpg\",\"6862b9a963f9e.jpg\",\"6862b9a96958f.jpg\",\"6862b9a96f350.jpg\"]', 1, 'approved', 0, '2025-06-16 18:54:45', '2025-09-11 16:04:51', NULL),
(5, 'دوره آموزشی مجازی تهدیدات سایبری و راهکارهای دفاعی', '<div><span style=\"color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" background-color:=\"\" var(--bs-body-bg);=\"\" font-size:=\"\" var(--bs-body-font-size);=\"\" font-weight:=\"\" var(--bs-body-font-weight);\"=\"\">📢 دوره آموزشی مجازی تهدیدات سایبری و راهکارهای دفاعی</span><br></div><div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br style=\"outline: none !important;\"></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">📅 زمان برگزاری:</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">یکشنبه ۲۹ تیرماه | ساعت ۱۶:۰۰ تا ۱۹:۰۰</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br style=\"outline: none !important;\"></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">🖥 محل برگزاری:</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">به‌صورت آنلاین از طریق سامانه اسکای روم</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br style=\"outline: none !important;\"></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">&nbsp;🎯 سرفصل‌های کلیدی دوره: ️</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">&nbsp;- آشنایی با جدیدترین تهدیدات سایبری ️</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">- یادگیری راهکارهای دفاعی و امنیتی ️</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br style=\"outline: none !important;\"></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">&nbsp;-آموزش توسط اساتید مجرب ️</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">&nbsp;- ارائه گواهینامه معتبر</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br style=\"outline: none !important;\"></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">📞 اطلاعات بیشتر و ثبت‌نام:</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">۰۵۱-۳۸۷۸۷۷۶۶ | ۰۵۱-۳۸۷۸۹۳۶۷</div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\">🌐 <a href=\"http://tam.kmtc.ir\" target=\"_blank\">tam.kmtc.ir</a></div><div style=\"text-align: right; color: rgb(29, 34, 40); font-family: \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" outline:=\"\" none=\"\" !important;\"=\"\"><br></div></div>', '687a8a1eb74fe.jpg', NULL, 1, 'approved', 0, '2025-07-18 16:53:36', '2025-09-09 13:34:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `fa_name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `fa_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage_users', 'مدیریت کاربران', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(2, 'manage_roles', 'مدیریت نقش‌ها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(3, 'manage_projects', 'مدیریت پروژه‌ها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(4, 'manage_news', 'مدیریت خبرها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(5, 'manage_articles', 'مدیریت مقاله‌ها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(6, 'manage_sliders', 'مدیریت اسلایدرها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(7, 'manage_comments', 'مدیریت کامنت‌ها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(8, 'manage_tickets', 'مدیریت تیکت‌ها', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(9, 'manage_logs', 'مدیریت لاگ‌های سیستم', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(10, 'manage_support_tickets', 'مدیریت تیکت‌های پشتیبانی', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(11, 'submit_news', 'ثبت خبر', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20'),
(12, 'submit_article', 'ثبت مقاله', 'web', '2025-08-27 07:29:20', '2025-08-27 07:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `assessment_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `primary_coach_id` bigint(20) UNSIGNED NOT NULL,
  `secondary_coach_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('request_submission','initial_audit','contract_signing','testing_and_monitoring','final_confirmation','final_report_submission','end_of_contract') NOT NULL DEFAULT 'request_submission',
  `request_submission` text DEFAULT NULL,
  `request_submission_file` varchar(255) DEFAULT NULL,
  `initial_audit` text DEFAULT NULL,
  `initial_audit_file` varchar(255) DEFAULT NULL,
  `contract_signing` text DEFAULT NULL,
  `contract_signing_file` varchar(255) DEFAULT NULL,
  `testing_and_monitoring` text DEFAULT NULL,
  `testing_and_monitoring_file` varchar(255) DEFAULT NULL,
  `final_confirmation` text DEFAULT NULL,
  `final_confirmation_file` varchar(255) DEFAULT NULL,
  `final_report_submission` text DEFAULT NULL,
  `final_report_submission_file` varchar(255) DEFAULT NULL,
  `end_of_contract` text DEFAULT NULL,
  `end_of_contract_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `applicant_id`, `assessment_request_id`, `primary_coach_id`, `secondary_coach_id`, `title`, `status`, `request_submission`, `request_submission_file`, `initial_audit`, `initial_audit_file`, `contract_signing`, `contract_signing_file`, `testing_and_monitoring`, `testing_and_monitoring_file`, `final_confirmation`, `final_confirmation_file`, `final_report_submission`, `final_report_submission_file`, `end_of_contract`, `end_of_contract_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 1, NULL, 'خلاصه اقدامات و جلسات برگزار شده در خصوص پروژه', 'initial_audit', 'گزارش کار پروژه\r\nموضوع: خلاصه اقدامات و جلسات برگزار شده در خصوص پروژه\r\nتاریخ: ۲۹ تیر ۱۴۰۴\r\nاین گزارش به منظور تشریح و مستندسازی فعالیت‌ها و جلسات برگزار شده در راستای پیشبرد پروژه، از مرحله بررسی محتوا تا تعیین وظایف تیم‌های فنی، تهیه و ارائه می‌گردد.', 'report-01.pdf', '۱. بررسی و تدوین محتوای پروژه:\r\n• برگزاری جلسات متعدد در دفتر جناب آقای دادرس: در این جلسات، محتواهای اولیه که از سوی ایشان در اختیار تیم قرار گرفته بود، مورد بحث و بررسی قرار گرفت.\r\n• بررسی فنی در آزمایشگاه افتا: محتوای دریافتی جهت تحلیل و ارزیابی فنی به آزمایشگاه افتا ارسال گردید.\r\n• مکتوب‌سازی تغییرات: کلیه موارد نیازمند حذف یا اضافه در محتوای پروژه به صورت مکتوب درآمد و در جلسات آتی با حضور جناب آقای دادرس مجدداً بررسی و نهایی شد.\r\n۲. نهایی‌سازی و امضای سند پروژه:\r\n• برگزاری سه جلسه نهایی: پس از تدوین محتوا، سه جلسه متمرکز بر روی فایل نهایی سند پروژه در دفتر جناب آقای دادرس برگزار گردید تا تمامی جوانب سند پیش از امضا، شفاف‌سازی شود.\r\n• امضای نهایی اسناد :در جلسه آخر، تمامی اوراق و اسناد مربوط به پروژه به امضای طرفین رسید. دو نسخه از اسناد امضا شده تهیه گردید که یک نسخه نزد جناب آقای دادرس و نسخه دیگر نزد جناب آقای دکتر سالخورده و جناب مهندس حسامی باقی ماند.\r\n۳. هماهنگی و زمان‌بندی تیم‌های اجرایی:\r\n• جلسه زمان‌بندی پروژه راهکار: یک جلسه اختصاصی در دفتر جناب آقای حسامی به منظور تدوین و نهایی‌سازی زمان‌بندی اجرای \"پروژه راهکار\" برگزار شد.\r\n• جلسات با تیم‌های فنی:\r\no یک جلسه مشترک با حضور تیم‌های فرانت‌اند (Front-End) و بک‌اند (Back-End) پروژه برگزار گردید.\r\no چندین جلسه مجزا با تیم طراحی رابط کاربری (UI) برگزار شد.\r\n۴. تخصیص و تحویل وظایف (تسک‌ها):\r\n• تیمهای فرانت‌اند و بک‌اند: در طی جلسه مشترک، تعدادی وظیفه (تسک) مشخص به این تیم‌ها محول گردید. مقرر شد تسک‌های مذکور تا انتهای هفته آتی تکمیل و تحویل داده شوند.\r\n• تیم UI: برای تیم طراحی رابط کاربری نیز وظایف مشخصی در نظر گرفته شد که این تیم با موفقیت تمامی تسک‌های محوله را به طور کامل انجام داده و تحویل نموده است.\r\nوضعیت فعلی:\r\nدر حال حاضر، تیم UI وظایف اولیه خود را به اتمام رسانده و تیمهای برنامه‌نویسی فرانت‌اند و بک‌اند در حال کار بر روی تسک‌های تعیین شده می‌باشند. پروژه طبق زمان‌بندی مورد توافق در حال پیشرفت است.\r\nبا احترام سیده یگانه خراشادی زاده', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-13 07:11:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-06-05 21:58:03', '2025-06-05 21:58:03'),
(2, 'user', 'web', '2025-06-05 21:58:03', '2025-06-05 21:58:03'),
(3, 'support', 'web', '2025-06-05 21:58:04', '2025-06-05 21:58:04'),
(8, 'coach', 'web', '2025-08-27 06:48:02', '2025-08-27 06:48:02'),
(9, 'delegate', 'web', '2025-08-27 07:01:40', '2025-08-27 07:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(10, 3),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7YqWc2qew4PVMRDtZb9eg7QBmj1147K7lcHSYSay', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOVJCNFMxNFRHR2lidVhud3RHaGczcmVXSEV1YUxBTU40VVBLRldCRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQvbWFuYWdlLXN1cHBvcnQtdGlja2V0cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzU5Nzg2NDE3O319', 1759787389);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slide_number` tinyint(3) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slide_number`, `image`, `title`, `description`, `button_text`, `button_link`, `created_at`, `updated_at`) VALUES
(1, 1, 'banner.jpg', NULL, NULL, NULL, NULL, '2025-07-04 09:48:42', '2025-07-04 09:48:42'),
(2, 2, 'CTF06.jpg', 'مراسم اختتامیه مسابقه فتح پرچم (CTF)', 'نخستین دوره از مسابقات سراسری فتح پرچم با محتوای امنیت سایبری با حضور دکتر طالبی معاونت آموزش و تحقیقات و دکتر مظهر معاونت فنی مرکز مدیریت راهبردی افتای ریاست جمهوری به همراه مهندس آقایی رئیس مرکز مدیریت راهبردی افتای خراسان رضوی و معاونین در ...', 'نمایش خبر', '/news/2', '2025-07-04 09:51:27', '2025-07-04 15:31:55'),
(3, 3, 'CTF07.jpg', 'برگزاری مسابقه امنیت سایبری - فتح پرچم در دانشگاه سجاد', 'مسابقه فتح پرچم در روز پنجشنبه مورخ ۲۱ فروردین ۱۴۰۴ در محل دانشگاه سجاد با حمایت مرکز مدیریت راهبردی افتای خراسان رضوی و شرکت خدمات علمی صنعتی خراسان برگزار گردید...', 'نمایش خبر', '/news/1', '2025-07-04 09:53:06', '2025-07-04 15:47:22'),
(4, 4, 'CTF04.jpg', 'مراسم اختتامیه مسابقه فتح پرچم (CTF)', 'نخستین دوره از مسابقات سراسری فتح پرچم با محتوای امنیت سایبری با حضور دکتر طالبی معاونت آموزش و تحقیقات و دکتر مظهر معاونت فنی مرکز مدیریت راهبردی افتای ریاست جمهوری به همراه مهندس آقایی رئیس مرکز مدیریت راهبردی افتای خراسان رضوی و معاونین در ...', 'نمایش خبر', '/news/2', '2025-07-04 09:54:20', '2025-07-04 15:34:04'),
(5, 5, 'CTF05.jpg', 'مراسم اختتامیه مسابقه فتح پرچم (CTF)', 'نخستین دوره از مسابقات سراسری فتح پرچم با محتوای امنیت سایبری با حضور دکتر طالبی معاونت آموزش و تحقیقات و دکتر مظهر معاونت فنی مرکز مدیریت راهبردی افتای ریاست جمهوری به همراه مهندس آقایی رئیس مرکز مدیریت راهبردی افتای خراسان رضوی و معاونین در ...', 'نمایش خبر', '/news/2', '2025-07-04 09:57:25', '2025-07-04 15:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','in_progress','closed') NOT NULL DEFAULT 'open',
  `response` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `sender_id`, `receiver_id`, `project_id`, `subject`, `message`, `status`, `response`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 50, 54, NULL, 'کمک', 'کمک تست', 'closed', 'اوکی', '2025-09-27 19:36:27', '2025-09-28 08:36:08', NULL),
(6, 54, NULL, NULL, 'تست', 'تست', 'open', 'بررسی شد..', '2025-10-05 08:08:48', '2025-10-06 21:46:37', NULL),
(7, 1, NULL, NULL, 'نامعتبر', 'این تیکت نامعتبر است. اقدام به حذف آن شود.', 'closed', NULL, '2025-10-06 17:23:12', '2025-10-06 17:25:48', '2025-10-06 17:25:48'),
(8, 1, 13, NULL, 'نقص مدارک درخواست پیش ارزیابی', 'کاربر گرامی، مدارک ارسالی شما برای درخواست پیش ارزیابی ناقص است.', 'closed', 'اصلاح شد. بررسی نمایید.', '2025-10-06 18:17:17', '2025-10-06 20:18:30', NULL),
(11, 4, 50, NULL, 'درخواست نامعتبر', 'با سلام. درخواست شما با عنوان پیش ارزیابی محصول با نام hhd نامعتبر است.', 'open', NULL, '2025-10-06 20:33:55', '2025-10-06 20:33:55', NULL),
(12, 1, NULL, 1, 'تیکت پروژه - 1', 'تیکت پروژه - 1', 'in_progress', 'دریافت شد.', '2025-10-06 21:11:01', '2025-10-06 21:26:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile_number`, `email`, `password`, `avatar`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'مدیر سایت', '09907702002', 'admin1@example.com', '$2y$10$WhZaIdxC8MhlwHjkrwojh.Bdz.J6OhIg3kW6PwpD7KeAbACebzPD6', '68377a6af26ae.png', NULL, 'W94xRL1n67gZQQ7yG6HJKRsvo1AsMPmjVjX9DR4CpROTwu8gbsK4qaURYPpl', '2025-05-18 14:48:19', '2025-09-27 18:49:03', NULL),
(4, 'محسن پشتیبان', '09136066306', 'mohsen@gmail.com', '$2y$10$YqADhs5Xb.cFbTpfkr.Ms.5ypHJCvYkNcFph5d9PXgF27DUsigSiy', '6834289937b43.jpg', NULL, NULL, '2025-05-18 14:56:20', '2025-05-26 08:38:49', NULL),
(6, 'علی جهانی', '09645917461', 'a.jahani@example.org', '$2y$10$YqADhs5Xb.cFbTpfkr.Ms.5ypHJCvYkNcFph5d9PXgF27DUsigSiy', NULL, '2025-05-18 15:42:59', 'J16t8RdutE', '2025-05-18 15:42:59', '2025-05-18 15:42:59', NULL),
(7, 'یوسف یوسفی', '09097187376', 'yousefi@example.com', '$2y$10$YqADhs5Xb.cFbTpfkr.Ms.5ypHJCvYkNcFph5d9PXgF27DUsigSiy', '68333b2c4178f.jpg', '2025-05-18 15:43:49', 'ijI5bgZuMmZe4rMdu8b6NalIOE7ZdnhNAUMopceJIgqoEWPxVTFazUh7sNYW', '2025-05-18 15:43:49', '2025-05-25 15:45:48', NULL),
(8, 'استاد مهناز مؤمنی', '09010210202', 'momeni@example.net', '$2y$10$RccyuAI1AGDTI8oU7N.ZPuX5TQwwm8DJtP0UEl5EgJzEG8oh5aKiq', NULL, '2025-05-18 15:44:07', 'kPMjFCCfYW', '2025-05-18 15:44:08', '2025-05-18 15:44:08', NULL),
(9, 'شادان زهرایی', '09401479085', 'zahraee@example.net', '$2y$10$0HbRn2xYA7QAS301aa0LnessBP5z.SEylnK6DHu829dSzzd/Q.4Ji', NULL, '2025-05-18 15:44:09', 'U0AOXXzjHF', '2025-05-18 15:44:09', '2025-05-18 15:44:09', NULL),
(10, 'سعید رشیدی', '09300022546', 'rashidi@example.net', '$2y$10$OdBKJVZ6EtzZ9E0mpLH96u.1frRFbqIZ3TUHmKRoDWre4N2uEeLai', NULL, '2025-05-18 15:44:10', '4qFd2415k5', '2025-05-18 15:44:11', '2025-05-18 15:44:11', NULL),
(11, 'اکبر عظیمی', '09426896827', 'akbar.a@gmail.com', '$2y$10$amRlfJM1FfIoXY6aFexl4e3X5UQotNpZvYFUcSYI8RkBNiNmT6YFS', NULL, '2025-05-18 15:44:12', 'JoMU2UFmcj', '2025-05-18 15:44:12', '2025-05-18 15:44:12', NULL),
(12, 'دکتر عادله رهنما', '09834667359', 'dr.rahnama@example.net', '$2y$10$UVh3z87clcdV4OaiGo9OhegXPtgghZpTS1T8ohU7XUwYDYbpAPQHm', NULL, '2025-05-18 15:44:13', 'UYaTEb2YNi', '2025-05-18 15:44:13', '2025-05-18 15:44:13', NULL),
(13, 'مهندس یعقوب سپهریان', '09858808233', 'sepehrian@example.net', '$2y$10$OL1nrETH0ppXVgmMrEo4sOGrq3DGK/9gh7cvrhVbYjvGm/7q34QL2', NULL, '2025-05-18 15:44:14', 'd5JZQdSvRxmKItlCIY1tVyCBsEF5rNGjsK6lvWW7vP47tFQf3hYjzWX2joHW', '2025-05-18 15:44:15', '2025-05-19 14:15:47', NULL),
(14, 'دکتر هیلدا عبادی', '09692875139', 'ebaadi@example.com', '$2y$10$AUl/LnXaHxJ5AzQz4cTMvew7RDWfThlWD6fuMm5hCtYtXFDh7yycu', NULL, '2025-05-18 15:44:16', 'pANBkP4Wdm', '2025-05-18 15:44:16', '2025-05-18 15:44:16', NULL),
(15, 'نادر خراسانی', '09142594826', 'nader.khorasani@yahoo.com', '$2y$10$PQUnb5P/10QCGr71aoIBGudbo2VtiFghr3Qg4yr0/skomNaAytoRW', NULL, '2025-05-18 15:44:36', 'PBxOKwRUZy', '2025-05-18 15:44:36', '2025-05-18 15:44:36', NULL),
(16, 'استاد پیام شجاعی', '09813239768', 'payam.shojaei@example.com', '$2y$10$lpdG9uNpGkI/oG.zTh.Qc.rNbwa/bcZ24ihnWBRp11m8LGNvEGwYy', NULL, '2025-05-18 15:44:37', 'UhPJk8NxRGsm6EGVYvihHSZilv4dXwd70kamYNyTlE2o0KehCP0jJlKT11L8', '2025-05-18 15:44:38', '2025-09-10 15:35:35', NULL),
(17, 'احمد دهقان', '09954083574', 'dehghan_ahmad@example.org', '$2y$10$EJ.6MZUhGLrP/CSuERPIVu6nmZo/GLxKGX4jUwdlxol7bGdeV8HOG', NULL, '2025-05-18 15:44:39', 'i89kXrqrg7', '2025-05-18 15:44:39', '2025-05-18 15:44:39', NULL),
(18, 'پریا میرزاده', '09626527563', 'paria_mirzadeh@example.net', '$2y$10$hk6Yuc1WvJGz8TCy1WN2f.6uWPGxE80Yu5tAV.IaPSoGDju2E9yyu', NULL, '2025-05-18 15:44:40', 'FPB3QYltXy', '2025-05-18 15:44:41', '2025-05-18 15:44:41', NULL),
(19, 'سپیده رفیعی', '09463324325', 'rafiee@example.org', '$2y$10$MjNgdk/e1UdRWgg8npC9WeuTs0owIwHQ/Hp4c3AIaHCL9HRlnqQXO', NULL, '2025-05-18 15:44:42', 'ORcQqr1DJ1', '2025-05-18 15:44:42', '2025-05-18 15:44:42', NULL),
(20, 'مجید درگاهی', '09213970449', 'majid@example.org', '$2y$10$C/Wx41kNqdLDrIVLW30zlePwCfXJ7OFhzMWgqSsjtMvkAYZhjNUji', NULL, '2025-05-18 15:44:43', 'cR4qb8pmNI', '2025-05-18 15:44:44', '2025-05-18 15:44:44', NULL),
(21, 'توکا مجتبایی', '09848603366', 'tooka@example.org', '$2y$10$CY8GsgzKFZ5fa1X2x91lNOzcdxpuisI3FUkSSgEJwNWFWm0Ngq54G', NULL, '2025-05-18 15:44:45', 'h4Co40FRMh', '2025-05-18 15:44:45', '2025-05-18 15:44:45', NULL),
(22, 'پرهام کاکاوند', '09667056015', 'parham@yahoo.com', '$2y$10$NCWfkwrZ7rGE5UJ1dnwv8.BpWwh/2ArhuJhAWzG/utkjxcpduRR8e', '68341f15dbefd.jpg', '2025-05-18 15:44:46', 'QuX8Am0i8OA1j2v2QGXlxMsXkwxLcCPjgrKW86KuzweWHZinSZ4S2YJ8aCcx', '2025-05-18 15:44:47', '2025-05-26 07:58:14', NULL),
(23, 'کریم نوروزی', '09636487531', 'karim30@example.net', '$2y$10$payoqsYeJ4dgt1QSql1jh.XRwNifq2XE7l3yn6KUwwK3Nmts/0FA2', NULL, '2025-05-18 15:44:48', 'jrVG1tSUmR', '2025-05-18 15:44:48', '2025-05-18 15:44:48', NULL),
(24, 'خسرو خسروی', '09420122890', 'khosravi@gmail.com', '$2y$10$V9yx7/XzI9WyTH1eQnllFuzfBuqG4e9eS8JF517XbY1/BD7Qs.L1S', NULL, '2025-05-18 15:44:56', '45jnAX9LrxUd42agrWpN0DXS5XnIq2CJWgp9WmDD9NB3XkfnMnSe2eE94QXI', '2025-05-18 15:44:56', '2025-09-13 09:28:36', NULL),
(25, 'مهتاب مدیریان', '09893247857', 'm.modiri@example.org', '$2y$10$7qwH6tcwo/GwNfUKPo4QzeR5BNfn1Iy/.K1G9s6y9XdvlMX3p0JR6', '68342a7cb7537.gif', '2025-05-18 15:44:57', '2IvoWfpLMXEWIwBDIA5KeKNXMnguxbOshYJQwMiOJrZtXavHafExbdItGiZk', '2025-05-18 15:44:57', '2025-05-26 08:46:52', NULL),
(26, 'بهنام احمدی', '09825170889', 'behnam@example.net', '$2y$10$/LTkvCHpVGz3PEVysukPG.JDLby.33cSpRAdbuQX7fhGBB/ymlCye', NULL, '2025-05-18 15:44:59', 'tfQcOfHGGF', '2025-05-18 15:44:59', '2025-09-10 15:35:05', NULL),
(27, 'مهبانو علی زاده', '09850795851', 'alizadeh@example.com', '$2y$10$bckD8.GgZ7aNrgUgp0aQNu4URyi3RoJYkq.J8A6cMSDX2fgHkVOL6', NULL, '2025-05-18 15:45:00', 'OzSFe6Nwck', '2025-05-18 15:45:00', '2025-05-18 15:45:00', NULL),
(29, 'مهندس داریوش زندی', '09914332671', 'dariush.zandi@example.org', '$2y$10$U5mGl/Bc5AV9KvUN/7k9RuereU6ZJLG4vOdTqsc5mE6JPQdwEcmsK', NULL, '2025-05-18 15:45:03', 'ziAa0VCeoSMp5l2zqTPLk1u95S1TKdiWN3ZLAM3ZuVDb6VX8eTMbLDeoDzX2', '2025-05-18 15:45:03', '2025-08-27 07:32:03', NULL),
(30, 'پرویز خمسه', '09713032423', 'parviz@yahoo.com', '$2y$10$HPOENt9Pbe0bzm258w0kEOSUznfswaqctWReamgtWPZIwtGJDTdu.', NULL, '2025-05-18 15:45:05', 'VkJsQrCvxw', '2025-05-18 15:45:05', '2025-05-18 15:45:05', NULL),
(31, 'هوتن همت', '09816266528', 'hootan_hemat@gmail.com', '$2y$10$ofOhjr4lwjF4Lmk8nEt1TOR6ngCQfxCMpER8n4gnRxrampAVyW1fS', NULL, '2025-05-18 15:45:06', 'kdiI5tmubN', '2025-05-18 15:45:06', '2025-05-18 15:45:06', NULL),
(32, 'سیمین رازی', '09147548180', 's.raazi@example.com', '$2y$10$CIfOUAGTeMvnbt674Fv8Y.hN0sGTL08mufjs28V9QlsnbNxXKbljS', NULL, '2025-05-18 15:45:07', '0FzIYGtF2y', '2025-05-18 15:45:07', '2025-06-14 10:14:49', NULL),
(33, 'فرّخ حائری', '09525782478', 'haeri@example.com', '$2y$10$6LGZHoUJ6pC.QkrFexxLKuCBosR2rG5Mi4eudquxIYp7zp8bpdsWq', NULL, '2025-05-18 15:45:09', '65xuSDoJrRZw13RxYe9U9WM2nvdQOZm2CdRx0ZiDRkLFMAi1EPWFrBEmA3pK', '2025-05-18 15:45:09', '2025-08-27 07:31:45', NULL),
(34, 'حمید کارگزار', '09123334444', 'hamid@yahoo.com', '$2y$10$Z9yT6HubAWeV6Z5d3eUWb.ubBI7Po2w5WFGVANOfuY0cp5KEEJ3OO', NULL, NULL, NULL, '2025-05-18 17:56:52', '2025-06-14 10:30:58', NULL),
(50, 'ali zahedifar', '09931192849', 'alizahedifar1381@gmail.com', '$2y$10$8UZYf00QcBVrGWBLgsamz.qi/MrBjsFOSQ555VIlbvsRJ7NzqUIy6', '68d832a856359.jpg', NULL, '6RqeEVH7vUC18dWxjWMEXhXaHNI0RBHJ6FvZt3M2KtPNG9YOXWOZxW78g4cm', '2025-09-27 18:52:13', '2025-09-28 08:37:03', NULL),
(51, 'مبینا میرشجاعان', '09023707118', 'missmirshojaan.2003@gmail.com', '$2y$10$PygKVKh6mrucusnad5zEKOMVtK6c.cMPEMM.IyILrQPZHqQ8pcYuS', NULL, NULL, NULL, '2025-10-01 09:38:52', '2025-10-01 09:38:52', NULL),
(52, 'Amirparsa Sakibaee', '09300207926', 'apshakibaee1382@gmail.com', '$2y$10$ssRmJ5S0TLMKL5etflL6vOtcdO0A7Etf4GUcYl0xFzWrP05nCFN46', NULL, NULL, 'ie4neB3htwSP4GS55LCttAasovkSc21stuYkAbWDIDOkRW7JYJD0TlvajSGK', '2025-10-01 09:41:28', '2025-10-01 09:41:28', NULL),
(53, 'امیررضا', '09364811757', 'amirrezazohourian01rez@gmail.com', '$2y$10$BkN8UozV/wEerH686QWcxeKQvIz75FcRe3Dd42/yHxWg8hwTseQw.', NULL, NULL, NULL, '2025-10-01 18:04:49', '2025-10-01 18:04:49', NULL),
(54, 'یگانه شکیب', '09303490856', 'shakibyeganeh@gmail.com', '$2y$10$ezxFZvH3MB/IgsDmVwPELuzW0SLro2IKvUQ4N.WXISA3u1nVcN6ce', NULL, NULL, NULL, '2025-10-04 18:00:38', '2025-10-04 18:00:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `article_topic`
--
ALTER TABLE `article_topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_topic_article_id_foreign` (`article_id`),
  ADD KEY `article_topic_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `assessment_requests`
--
ALTER TABLE `assessment_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `assessment_request_checklists`
--
ALTER TABLE `assessment_request_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_request_checklists_assessment_request_id_foreign` (`assessment_request_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_news_news_id_foreign` (`news_id`),
  ADD KEY `category_news_category_id_foreign` (`category_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_news_id_foreign` (`news_id`),
  ADD KEY `comments_article_id_foreign` (`article_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_applicant_id_foreign` (`applicant_id`),
  ADD KEY `projects_assessment_request_id_foreign` (`assessment_request_id`),
  ADD KEY `projects_primary_coach_id_foreign` (`primary_coach_id`),
  ADD KEY `projects_secondary_coach_id_foreign` (`secondary_coach_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sliders_slide_number_unique` (`slide_number`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_sender_id_foreign` (`sender_id`),
  ADD KEY `tickets_receiver_id_foreign` (`receiver_id`),
  ADD KEY `tickets_project_id_foreign` (`project_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topics_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_number_unique` (`mobile_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article_topic`
--
ALTER TABLE `article_topic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_requests`
--
ALTER TABLE `assessment_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assessment_request_checklists`
--
ALTER TABLE `assessment_request_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_topic`
--
ALTER TABLE `article_topic`
  ADD CONSTRAINT `article_topic_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_topic_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assessment_requests`
--
ALTER TABLE `assessment_requests`
  ADD CONSTRAINT `assessment_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `assessment_request_checklists`
--
ALTER TABLE `assessment_request_checklists`
  ADD CONSTRAINT `assessment_request_checklists_assessment_request_id_foreign` FOREIGN KEY (`assessment_request_id`) REFERENCES `assessment_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_news`
--
ALTER TABLE `category_news`
  ADD CONSTRAINT `category_news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_news_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_assessment_request_id_foreign` FOREIGN KEY (`assessment_request_id`) REFERENCES `assessment_requests` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_primary_coach_id_foreign` FOREIGN KEY (`primary_coach_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_secondary_coach_id_foreign` FOREIGN KEY (`secondary_coach_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
