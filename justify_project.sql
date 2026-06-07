-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 05:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justify_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id_address` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `address_title` varchar(50) NOT NULL,
  `complete_address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id_address`, `id_user`, `address_title`, `complete_address`, `city`, `province`, `postal_code`, `created_at`, `updated_at`) VALUES
(3, 2, 'rumah', 'mkjhfdrrutiy', 'kjgfdtryui', 'jhugyfrt7yi', 'kjhuy78', '2026-06-06 09:27:44', '2026-06-06 09:27:44'),
(4, 2, 'rumah', 'mkjhfdrrutiy', 'kjgfdtryui', 'jhugyfrt7yi', 'kjhuy78', '2026-06-06 09:28:12', '2026-06-06 09:28:12'),
(5, 3, 'kos', 'bbhvsgdywe8diyoi', 'djbewguiudowe', 'uiwye78j3r', 'jbduywged', '2026-06-06 09:33:33', '2026-06-06 09:33:33'),
(6, 3, 'kos', 'bbhvsgdywe8diyoi', 'djbewguiudowe', 'uiwye78j3r', 'jbduywged', '2026-06-06 09:33:50', '2026-06-06 09:33:50'),
(12, 1, 'kos ayla', 'gusgas 2', 'bandung', 'jawa  barat', '40160', '2026-06-06 22:38:12', '2026-06-07 03:16:57'),
(14, 1, 'rumah', 'rangkasbitung', 'rangkasbitung', 'banten', '12134', '2026-06-07 05:21:56', '2026-06-07 05:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('Super Admin','Staff') NOT NULL DEFAULT 'Staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`, `name`, `role`, `created_at`, `last_login`, `remember_token`) VALUES
(1, 'admin', '$2y$12$D55bXTZOlkLpkHn/dkGyke9RFNFlNSE2a..JKxGMsuxkhiX3eai9a', 'Rifdah', 'Super Admin', '2026-06-05 02:20:04', '2026-06-07 05:28:46', NULL),
(2, 'staff', '$2y$12$QqVNoM7xfrAd29BfrfqDuel54qOn3JsoX3qN3Too1wrwcudWdjwVK', 'Nabila', 'Staff', '2026-06-05 02:20:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id_cart` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_variant` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_contents`
--

CREATE TABLE `home_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2026_05_08_091149_create_admins_table', 1),
(2, '2026_05_08_091224_create_users_table', 1),
(3, '2026_05_08_091301_create_product_categories_table', 1),
(4, '2026_05_08_091335_create_products_table', 1),
(5, '2026_05_08_091415_create_product_variants_table', 1),
(6, '2026_05_08_091548_create_product_images_table', 1),
(7, '2026_05_08_091626_create_size_charts_table', 1),
(8, '2026_05_08_091700_create_addresses_table', 1),
(9, '2026_05_08_091729_create_carts_table', 1),
(10, '2026_05_08_091800_create_orders_table', 1),
(11, '2026_05_08_091821_create_order_items_table', 1),
(12, '2026_05_08_091846_create_payment_logs_table', 1),
(13, '2026_05_08_091932_create_user_measurements_table', 1),
(14, '2026_05_28_074951_change_id_product_to_id_category_in_size_charts', 1),
(15, '2026_05_28_084005_rename_size_chart_columns', 1),
(16, '2026_06_06_131257_create_home_contents_table', 2),
(17, '2026_06_06_171209_create_password_reset_tokens_table', 2),
(18, '2026_06_07_053253_make_id_address_nullable_in_orders', 3),
(19, '2026_06_07_114309_create_mix_match_products_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mix_match_products`
--

CREATE TABLE `mix_match_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_address` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `total_product_price` decimal(12,2) NOT NULL,
  `shipping_cost` decimal(12,2) NOT NULL,
  `grand_total` decimal(12,2) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `payment_method` varchar(20) NOT NULL DEFAULT 'QRIS',
  `status` enum('Pending','Diproses','Dikirim','Selesai','Dibatalkan','Refund') NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `tracking_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_address`, `shipping_address`, `total_product_price`, `shipping_cost`, `grand_total`, `shipping_method`, `payment_method`, `status`, `order_date`, `tracking_number`) VALUES
(1, 2, 4, 'mkjhfdrrutiy, kjgfdtryui, jhugyfrt7yi kjhuy78', 125000.00, 15000.00, 140000.00, 'Plus Delivery', 'Midtrans', 'Selesai', '2026-06-06 09:28:12', NULL),
(2, 3, 6, 'bbhvsgdywe8diyoi, djbewguiudowe, uiwye78j3r jbduywged', 350000.00, 15000.00, 365000.00, 'Plus Delivery', 'Midtrans', 'Selesai', '2026-06-06 09:33:50', NULL),
(3, 1, NULL, 'gsgas2, bandung, jabar 40178', 150000.00, 15000.00, 165000.00, 'Plus Delivery', 'Midtrans', 'Selesai', '2026-06-06 10:22:21', NULL),
(4, 1, NULL, 'gsgas2, bandung, jabar 40178', 350000.00, 15000.00, 365000.00, 'Plus Delivery', 'Midtrans', 'Selesai', '2026-06-06 10:29:48', NULL),
(5, 1, NULL, 'gsgas2, bandung, jabar 40178', 350000.00, 15000.00, 365000.00, 'Plus Delivery', 'Midtrans', 'Selesai', '2026-06-06 12:08:50', NULL),
(6, 1, NULL, 'gsgas2, bandung, jabar 40178', 145000.00, 15000.00, 160000.00, 'Plus Delivery', 'Midtrans', 'Dikirim', '2026-06-06 12:21:08', NULL),
(7, 1, 12, 'gusgas 2, bandung, jawa  barat 40160', 150000.00, 15000.00, 165000.00, 'Plus Delivery', 'Midtrans', 'Diproses', '2026-06-06 22:38:44', NULL),
(8, 1, 14, 'rangkasbitung, rangkasbitung, banten 12134', 145000.00, 15000.00, 160000.00, 'Plus Delivery', 'Midtrans', 'Pending', '2026-06-07 05:27:05', NULL),
(9, 1, 14, 'rangkasbitung, rangkasbitung, banten 12134', 145000.00, 15000.00, 160000.00, 'Plus Delivery', 'Midtrans', 'Pending', '2026-06-07 05:49:57', NULL),
(10, 1, 14, 'rangkasbitung, rangkasbitung, banten 12134', 125000.00, 15000.00, 140000.00, 'Plus Delivery', 'Midtrans', 'Pending', '2026-06-07 07:38:30', NULL),
(11, 1, 14, 'rangkasbitung, rangkasbitung, banten 12134', 170000.00, 15000.00, 185000.00, 'Plus Delivery', 'Midtrans', 'Pending', '2026-06-07 07:47:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_variant` bigint(20) UNSIGNED NOT NULL,
  `price_at_purchase` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_variant`, `price_at_purchase`, `quantity`) VALUES
(1, 1, 1, 125000.00, 1),
(2, 2, 3, 350000.00, 1),
(3, 3, 10, 150000.00, 1),
(4, 4, 3, 350000.00, 1),
(5, 5, 3, 350000.00, 1),
(6, 6, 5, 145000.00, 1),
(7, 7, 10, 150000.00, 1),
(8, 8, 5, 145000.00, 1),
(9, 9, 5, 145000.00, 1),
(10, 10, 1, 125000.00, 1),
(11, 11, 15, 170000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id_log` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `gross_amount` decimal(12,2) NOT NULL,
  `response_payload` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `gender` enum('Perempuan','Laki-laki') NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `product_name`, `gender`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Ribbed Ribbon Crop Top', 'Perempuan', 'Atasan lengan pendek putih dengan detail ikat tali merah di bagian dada.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(2, 1, '3D Floral Bustier Dress', 'Perempuan', 'Dress mini putih dengan aksen bunga 3D warna-warni dan tali pundak tipis.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(3, 3, 'Off-Shoulder Knit Top', 'Perempuan', 'Atasan rajut putih model sabrina dengan detail kancing depan dan pita kecil.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(4, 4, 'Ruched Milkmaid Top', 'Perempuan', 'Atasan putih dengan kerutan di dada dan lengan puff pendek ala cottagecore.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(5, 5, 'Asymmetrical Floral Cami', 'Perempuan', 'Atasan tali tipis motif bunga pink-lilac dengan potongan bawah asimetris.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(6, 6, 'Lilac Floral Corset Top', 'Perempuan', 'Atasan korset tanpa lengan berwarna pastel dengan motif bunga lilac lembut.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(7, 10, 'Daisy Pattern A-Line Skirt', 'Perempuan', 'Rok mini bersiluet A-line dengan motif bunga daisy kuning-lilac kecil.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(8, 5, 'Plaid Halter Corset Top', 'Perempuan', 'Atasan halterneck motif kotak-kotak kuning-biru dengan detail kancing depan.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(9, 4, 'Lace Trim Ruffle Blouse', 'Perempuan', 'Atasan putih bertekstur dengan detail kerutan (ruffles) dan tepian renda.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(10, 5, 'Plaid Gingham Camisole', 'Perempuan', 'Atasan longgar (flowy) motif kotak-kotak hitam putih dengan tali hitam.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(11, 6, 'Yellow Floral Lace-Up Top', 'Perempuan', 'Atasan bustier motif bunga kuning dengan detail tali sepatu (lace-up) di depan.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(12, 4, 'Polkadot Ribbon Tie Top', 'Perempuan', 'Atasan putih motif polkadot hitam dengan aksen pita biru tua di bawah dada.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(13, 6, 'Gingham Plaid Bustier', 'Perempuan', 'Atasan bustier seksi motif kotak-kotak biru muda (gingham) dengan detail pita.', '2026-06-05 02:20:05', '2026-06-05 02:22:01', '2026-06-05 02:22:01'),
(14, 10, 'Vintage Floral Maxi Skirt', 'Perempuan', 'Rok panjang (maxi) berwarna putih dengan motif bunga-bunga vintage yang estetik.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(15, 11, 'Floral Mini Skort with Ties', 'Perempuan', 'Rok mini motif bunga kecil yang dilengkapi tali samping, praktis karena berbentuk skort.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(16, 10, 'Denim Pleated Mini Skirt', 'Perempuan', 'Rok mini jeans lipit-lipit (pleated) warna biru muda dengan detail renda putih.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(17, 10, 'Red Gingham Pleated Skirt', 'Perempuan', 'Rok mini lipit motif kotak-kotak merah putih ala sekolah dengan tepian renda.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(18, 10, 'Two-Tone Plaid Mini Skirt', 'Perempuan', 'Rok mini paduan motif kotak-kotak gelap dan kain polos krem dengan detail bordir bintang.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(19, 10, 'Y2K Pleated Low-Rise Skirt', 'Perempuan', 'Rok mini lipit gaya Y2K warna cokelat dengan aksen ban pinggang ganda.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(20, 9, 'High-Waist Wide Jeans', 'Perempuan', 'Celana jeans panjang high-waist berwarna light blue wash dengan potongan lebar.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(21, 12, 'Dark Blue Denim Shorts', 'Perempuan', 'Celana pendek jeans warna biru tua (navy) pekat dilengkapi dengan ikat pinggang.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(22, 12, 'Acid Wash Denim Bermuda', 'Perempuan', 'Celana pendek jeans model loose/Bermuda dengan efek washed kekuningan.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(23, 8, 'Classic Slim-Fit Black Shirt', 'Laki-laki', 'Kemeja lengan panjang polos warna hitam pekat dengan potongan pas badan.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(24, 8, 'Smart Casual Shirt & Sweater', 'Laki-laki', 'Kemeja biru muda polos yang dipadukan dengan sweater cokelat melingkar di bahu.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(25, 8, 'Layered Black Open Shirt', 'Laki-laki', 'Kemeja lengan panjang hitam yang dipakai terbuka sebagai luaran kaos putih.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(26, 8, 'Olive Green Cuban Shirt', 'Laki-laki', 'Kemeja lengan pendek warna hijau oliv polos dengan kerah model Cuban.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(27, 8, 'Flannel Plaid Oversized Shirt', 'Laki-laki', 'Kemeja flanel motif kotak-kotak cokelat-hitam yang dipadukan dengan kaos putih.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(28, 12, 'Monogram Tailored Shorts', 'Laki-laki', 'Celana pendek kain formal cokelat dengan motif monogram penuh yang elegan.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(29, 13, 'Army Green Multi-Pocket Cargo', 'Laki-laki', 'Celana panjang kargo warna hijau tentara/olif dengan banyak kantong fungsional.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(30, 14, 'Ripped Black Denim Shorts', 'Laki-laki', 'Celana pendek jeans hitam dengan detail robek-robek (ripped) dan rumbai di bawah.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(31, 12, 'Classic 3-Stripes Trackpants', 'Laki-laki', 'Celana panjang olahraga (sportswear) warna hitam dengan detail 3 garis putih di samping.', '2026-06-05 02:20:05', '2026-06-05 02:20:05', NULL),
(32, 14, 'apslah', 'Perempuan', 'djhbwkjdld', '2026-06-05 02:21:19', '2026-06-05 02:21:52', '2026-06-05 02:21:52'),
(33, 9, 'kentut', 'Perempuan', 'ndjgyue', '2026-06-06 10:24:20', '2026-06-06 10:24:41', '2026-06-06 10:24:41'),
(34, 1, 'pbo', 'Perempuan', 'jkdohsdiowq', '2026-06-07 07:50:09', '2026-06-07 07:50:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id_category`, `category_name`) VALUES
(4, 'Blouse'),
(13, 'Cargo'),
(6, 'Corset'),
(2, 'Crop top'),
(1, 'Dress'),
(9, 'Jeans'),
(3, 'Off-Shoulder'),
(14, 'Ripped jeans'),
(8, 'Shirt'),
(12, 'Shorts'),
(10, 'Skirt'),
(11, 'Skort'),
(7, 'T-Shirt'),
(5, 'Tanktop');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id_image` bigint(20) UNSIGNED NOT NULL,
  `id_variant` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id_image`, `id_variant`, `image_url`, `is_main`) VALUES
(1, 1, 'assets/image/imgMixmatch/wanita/atscewe1.png', 1),
(2, 3, 'assets/image/imgMixmatch/wanita/atscewe2.png', 1),
(3, 5, 'assets/image/imgMixmatch/wanita/atscewe3.png', 1),
(4, 7, 'assets/image/imgMixmatch/wanita/atscewe4.png', 1),
(5, 8, 'assets/image/imgMixmatch/wanita/atscewe5.png', 1),
(6, 9, 'assets/image/imgMixmatch/wanita/atscewe6.png', 1),
(7, 10, 'assets/image/imgMixmatch/wanita/atscewe7.png', 1),
(8, 12, 'assets/image/imgMixmatch/wanita/atscewe8.png', 1),
(9, 13, 'assets/image/imgMixmatch/wanita/atscewe9.png', 1),
(10, 14, 'assets/image/imgMixmatch/wanita/atscewe10.png', 1),
(11, 15, 'assets/image/imgMixmatch/wanita/atscewe11.png', 1),
(12, 16, 'assets/image/imgMixmatch/wanita/atscewe12.png', 1),
(13, 17, 'assets/image/imgMixmatch/wanita/atscewe13.png', 1),
(14, 18, 'assets/image/imgMixmatch/wanita/bwhcewe2.png', 1),
(15, 19, 'assets/image/imgMixmatch/wanita/bwhcewe3.png', 1),
(16, 20, 'assets/image/imgMixmatch/wanita/bwhcewe4.png', 1),
(17, 22, 'assets/image/imgMixmatch/wanita/bwhcewe5.png', 1),
(18, 23, 'assets/image/imgMixmatch/wanita/bwhcewe6.png', 1),
(19, 24, 'assets/image/imgMixmatch/wanita/bwhcewe7.png', 1),
(20, 25, 'assets/image/imgMixmatch/wanita/bwhcewe8.png', 1),
(21, 27, 'assets/image/imgMixmatch/wanita/bwhcewe9.png', 1),
(22, 28, 'assets/image/imgMixmatch/wanita/bwhcewe10.png', 1),
(23, 29, 'assets/image/imgMixmatch/pria/atscowo1.png', 1),
(24, 31, 'assets/image/imgMixmatch/pria/atscowo2.png', 1),
(25, 32, 'assets/image/imgMixmatch/pria/atscowo3.png', 1),
(26, 33, 'assets/image/imgMixmatch/pria/atscowo4.png', 1),
(27, 35, 'assets/image/imgMixmatch/pria/atscowo5.png', 1),
(28, 36, 'assets/image/imgMixmatch/pria/bwhcowo1.png', 1),
(29, 37, 'assets/image/imgMixmatch/pria/bwhcowo2.png', 1),
(30, 39, 'assets/image/imgMixmatch/pria/bwhcowo3.png', 1),
(31, 40, 'assets/image/imgMixmatch/pria/bwhcowo4.png', 1),
(32, 41, 'storage/products/NGrDJjimTsEXZWgtag6eSgK0KQkjMVyV1r80YniT.jpg', 1),
(33, 42, 'storage/products/NGrDJjimTsEXZWgtag6eSgK0KQkjMVyV1r80YniT.jpg', 1),
(34, 43, 'storage/products/NGrDJjimTsEXZWgtag6eSgK0KQkjMVyV1r80YniT.jpg', 1),
(35, 44, 'storage/products/NGrDJjimTsEXZWgtag6eSgK0KQkjMVyV1r80YniT.jpg', 1),
(36, 45, 'storage/products/h9bc0Jkz2OgOs3ROBZyYiYeScFzkxkmvShw44wSO.jpg', 1),
(37, 46, 'storage/products/h9bc0Jkz2OgOs3ROBZyYiYeScFzkxkmvShw44wSO.jpg', 1),
(38, 47, 'storage/products/h9bc0Jkz2OgOs3ROBZyYiYeScFzkxkmvShw44wSO.jpg', 1),
(39, 48, 'storage/products/h9bc0Jkz2OgOs3ROBZyYiYeScFzkxkmvShw44wSO.jpg', 1),
(40, 49, 'products/PRadFn0sHOlJ9wwqIrcM22oCrvMfRDCPjlR3Wxqo.png', 1),
(41, 50, 'products/PRadFn0sHOlJ9wwqIrcM22oCrvMfRDCPjlR3Wxqo.png', 1),
(42, 51, 'products/PRadFn0sHOlJ9wwqIrcM22oCrvMfRDCPjlR3Wxqo.png', 1),
(43, 52, 'products/PRadFn0sHOlJ9wwqIrcM22oCrvMfRDCPjlR3Wxqo.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id_variant` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(30) NOT NULL,
  `size` enum('S','M','L','XL') NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` enum('Ready','Out of Stock','Hidden') NOT NULL DEFAULT 'Ready',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id_variant`, `id_product`, `color`, `size`, `price`, `stock`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'White', 'M', 125000.00, 15, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(2, 1, 'White', 'L', 125000.00, 10, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(3, 2, 'White Floral', 'M', 350000.00, 5, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(4, 2, 'White Floral', 'L', 350000.00, 8, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(5, 3, 'White', 'M', 145000.00, 12, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(6, 3, 'White', 'L', 145000.00, 14, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(7, 4, 'White', 'M', 135000.00, 20, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(8, 5, 'Pink-Lilac', 'M', 115000.00, 10, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(9, 6, 'Lilac', 'M', 165000.00, 7, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(10, 7, 'Yellow-Lilac', 'S', 150000.00, 12, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(11, 7, 'Yellow-Lilac', 'M', 150000.00, 15, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(12, 8, 'Blue-Yellow Plaid', 'M', 140000.00, 9, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(13, 9, 'White', 'M', 155000.00, 11, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(14, 10, 'Black-White', 'M', 110000.00, 18, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(15, 11, 'Yellow Floral', 'M', 170000.00, 8, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(16, 12, 'White Polkadot', 'M', 130000.00, 13, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(17, 13, 'Light Blue', 'M', 160000.00, 10, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(18, 14, 'White Floral', 'M', 210000.00, 11, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(19, 15, 'White Floral', 'M', 175000.00, 16, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(20, 16, 'Light Blue', 'S', 195000.00, 10, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(21, 16, 'Light Blue', 'M', 195000.00, 12, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(22, 17, 'Red-White', 'M', 165000.00, 20, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(23, 18, 'Dark Plaid-Khaki', 'M', 185000.00, 8, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(24, 19, 'Brown', 'M', 190000.00, 7, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(25, 20, 'Light Blue Wash', 'M', 280000.00, 15, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(26, 20, 'Light Blue Wash', 'L', 280000.00, 11, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(27, 21, 'Navy Blue', 'M', 150000.00, 25, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(28, 22, 'Acid Wash Yellow', 'M', 175000.00, 13, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(29, 23, 'Black', 'L', 225000.00, 18, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(30, 23, 'Black', 'XL', 225000.00, 7, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(31, 24, 'Light Blue-Brown', 'L', 299000.00, 6, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(32, 25, 'Black-White', 'L', 245000.00, 12, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(33, 26, 'Olive Green', 'M', 195000.00, 22, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(34, 26, 'Olive Green', 'L', 195000.00, 15, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(35, 27, 'Brown-Black Plaid', 'XL', 260000.00, 10, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(36, 28, 'Monogram Brown', 'M', 210000.00, 8, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(37, 29, 'Army Green', 'L', 320000.00, 14, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(38, 29, 'Army Green', 'XL', 320000.00, 9, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(39, 30, 'Ripped Black', 'L', 180000.00, 11, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(40, 31, 'Black-White', 'L', 275000.00, 20, 'Ready', NULL, '2026-06-05 02:20:05', NULL),
(41, 32, 'knwd', 'S', 23452.00, 12, 'Ready', '2026-06-05 02:21:19', '2026-06-05 02:21:19', NULL),
(42, 32, 'djde', 'S', 23452.00, 12, 'Ready', '2026-06-05 02:21:19', '2026-06-05 02:21:19', NULL),
(43, 32, 'knwd', 'M', 23452.00, 12, 'Ready', '2026-06-05 02:21:19', '2026-06-05 02:21:19', NULL),
(44, 32, 'djde', 'M', 23452.00, 12, 'Ready', '2026-06-05 02:21:19', '2026-06-05 02:21:19', NULL),
(45, 33, 'kjwshduh', 'S', 2345.00, 233, 'Ready', '2026-06-06 10:24:20', '2026-06-06 10:24:20', NULL),
(46, 33, 'bdhewg', 'S', 2345.00, 233, 'Ready', '2026-06-06 10:24:20', '2026-06-06 10:24:20', NULL),
(47, 33, 'kjwshduh', 'M', 2345.00, 233, 'Ready', '2026-06-06 10:24:20', '2026-06-06 10:24:20', NULL),
(48, 33, 'bdhewg', 'M', 2345.00, 233, 'Ready', '2026-06-06 10:24:20', '2026-06-06 10:24:20', NULL),
(49, 34, 'ungu', 'M', 123439.00, 192, 'Ready', '2026-06-07 07:50:09', '2026-06-07 07:50:09', NULL),
(50, 34, 'putih', 'M', 123439.00, 192, 'Ready', '2026-06-07 07:50:09', '2026-06-07 07:50:09', NULL),
(51, 34, 'ungu', 'L', 123439.00, 192, 'Ready', '2026-06-07 07:50:09', '2026-06-07 07:50:09', NULL),
(52, 34, 'putih', 'L', 123439.00, 192, 'Ready', '2026-06-07 07:50:09', '2026-06-07 07:50:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size_charts`
--

CREATE TABLE `size_charts` (
  `id_size_chart` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `size` enum('S','M','L','XL') NOT NULL,
  `length_cm` int(11) NOT NULL,
  `width_cm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_charts`
--

INSERT INTO `size_charts` (`id_size_chart`, `id_category`, `size`, `length_cm`, `width_cm`) VALUES
(1, 1, 'M', 68, 44),
(2, 1, 'L', 72, 46),
(3, 2, 'S', 40, 34),
(4, 2, 'M', 44, 36),
(5, 3, 'S', 45, 38),
(6, 3, 'M', 48, 40),
(7, 4, 'M', 65, 42),
(8, 4, 'L', 69, 45),
(9, 5, 'S', 50, 30),
(10, 5, 'M', 54, 32),
(11, 6, 'S', 35, 32),
(12, 6, 'M', 38, 34),
(13, 7, 'M', 70, 46),
(14, 7, 'L', 74, 48),
(15, 8, 'M', 72, 45),
(16, 8, 'L', 76, 47),
(17, 9, 'S', 98, 72),
(18, 9, 'M', 102, 76),
(19, 10, 'S', 40, 68),
(20, 10, 'M', 44, 72),
(21, 11, 'S', 38, 70),
(22, 11, 'M', 42, 74),
(23, 12, 'S', 42, 72),
(24, 12, 'M', 45, 76),
(25, 13, 'S', 100, 74),
(26, 13, 'M', 104, 78),
(27, 14, 'S', 99, 73),
(28, 14, 'M', 103, 77);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_google` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `email`, `email_verified_at`, `password`, `id_google`, `phone_number`, `profile_picture`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nabila Ayla Putri', 'nabilaaylaputri@gmail.com', NULL, '$2y$12$l/gLkBF50eQstZUCgzsnpeOVFjSm8pU4G2zDi4w7sHBDHQaOuG0g2', NULL, '087887073980', 'profiles/k6T65yGlSEKR5y2CdVFBkTZSeXV19mbUzorvDJfP.jpg', 1, NULL, '2026-06-06 07:35:27', '2026-06-07 04:07:31'),
(2, 'Rifdah Mahirah', 'rifdahm12@gmail.com', NULL, '$2y$12$qYyw058J7tJxkkh541fmw.BbCM/PWNerxK47We6nW6uZsLxBl.GvS', NULL, NULL, NULL, 1, NULL, '2026-06-06 07:38:02', '2026-06-06 07:38:02'),
(3, 'masdariah', 'masda@gmqil.com', NULL, '$2y$12$NfJ6Bvi7EXPgi8EKbXk2suA9rM5MqkvdU47HToFyYl6fZMgxLiZBi', NULL, NULL, NULL, 1, NULL, '2026-06-06 09:31:42', '2026-06-06 09:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_measurements`
--

CREATE TABLE `user_measurements` (
  `id_measurement` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `weight_kg` decimal(5,2) NOT NULL,
  `height_cm` decimal(5,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `addresses_id_user_foreign` (`id_user`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id_cart`),
  ADD UNIQUE KEY `carts_id_user_id_variant_unique` (`id_user`,`id_variant`),
  ADD KEY `carts_id_variant_foreign` (`id_variant`);

--
-- Indexes for table `home_contents`
--
ALTER TABLE `home_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mix_match_products`
--
ALTER TABLE `mix_match_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_id_user_foreign` (`id_user`),
  ADD KEY `orders_id_address_foreign` (`id_address`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `order_items_id_order_foreign` (`id_order`),
  ADD KEY `order_items_id_variant_foreign` (`id_variant`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `payment_logs_id_order_foreign` (`id_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `product_categories_category_name_unique` (`category_name`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id_image`),
  ADD UNIQUE KEY `product_images_id_variant_image_url_unique` (`id_variant`,`image_url`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id_variant`),
  ADD UNIQUE KEY `product_variants_id_product_color_size_unique` (`id_product`,`color`,`size`);

--
-- Indexes for table `size_charts`
--
ALTER TABLE `size_charts`
  ADD PRIMARY KEY (`id_size_chart`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_measurements`
--
ALTER TABLE `user_measurements`
  ADD PRIMARY KEY (`id_measurement`),
  ADD UNIQUE KEY `user_measurements_id_user_unique` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id_address` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id_cart` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_contents`
--
ALTER TABLE `home_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mix_match_products`
--
ALTER TABLE `mix_match_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_item` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id_image` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id_variant` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `size_charts`
--
ALTER TABLE `size_charts`
  MODIFY `id_size_chart` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_measurements`
--
ALTER TABLE `user_measurements`
  MODIFY `id_measurement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_id_variant_foreign` FOREIGN KEY (`id_variant`) REFERENCES `product_variants` (`id_variant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_address_foreign` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id_address`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_id_variant_foreign` FOREIGN KEY (`id_variant`) REFERENCES `product_variants` (`id_variant`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD CONSTRAINT `payment_logs_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `product_categories` (`id_category`) ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_id_variant_foreign` FOREIGN KEY (`id_variant`) REFERENCES `product_variants` (`id_variant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON UPDATE CASCADE;

--
-- Constraints for table `user_measurements`
--
ALTER TABLE `user_measurements`
  ADD CONSTRAINT `user_measurements_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
