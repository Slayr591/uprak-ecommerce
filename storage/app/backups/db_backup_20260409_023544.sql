-- Database backup generated at 2026-04-09 02:35:44
-- Source database: ukk
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `carts` (`id`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(13, 3, 4, 1, '2026-04-08 23:59:10', '2026-04-08 23:59:10');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000001_create_all_tables', 1);

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Premium Wireless Headphones', 4698300, 3, 14094900, '2026-04-06 07:36:25', '2026-04-06 07:36:25'),
(2, 2, 3, 'Moondrop Aria 2', 13345000, 1, 13345000, '2026-04-06 10:27:24', '2026-04-06 10:27:24'),
(3, 3, 11, 'Vertex Chrono V2', 5024000, 1, 5024000, '2026-04-06 10:29:21', '2026-04-06 10:29:21'),
(4, 3, 5, 'Pro Ultrabook 14', 20397300, 1, 20397300, '2026-04-06 10:29:22', '2026-04-06 10:29:22'),
(5, 3, 4, 'Ceramic Vessel Set', 1884000, 1, 1884000, '2026-04-06 10:29:22', '2026-04-06 10:29:22'),
(6, 3, 3, 'Moondrop Aria 2', 13345000, 1, 13345000, '2026-04-06 10:29:22', '2026-04-06 10:29:22'),
(7, 3, 16, 'Stone Island Black Glossy', 1000000, 1, 1000000, '2026-04-06 10:29:22', '2026-04-06 10:29:22'),
(8, 4, 4, 'Ceramic Vessel Set', 1884000, 1, 1884000, '2026-04-06 10:56:40', '2026-04-06 10:56:40'),
(9, 5, 3, 'Moondrop Aria 2', 13345000, 1, 13345000, '2026-04-07 07:06:55', '2026-04-07 07:06:55'),
(10, 6, 3, 'Moondrop Aria 2', 13345000, 2, 26690000, '2026-04-08 22:38:50', '2026-04-08 22:38:50'),
(11, 6, 5, 'Pro Ultrabook 14', 20397300, 1, 20397300, '2026-04-08 22:38:50', '2026-04-08 22:38:50');

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` enum('pending','paid','confirmed','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('unpaid','pending_verification','paid','rejected') NOT NULL DEFAULT 'unpaid',
  `payment_proof` varchar(255) DEFAULT NULL,
  `subtotal` bigint(20) NOT NULL DEFAULT 0,
  `shipping_cost` bigint(20) NOT NULL DEFAULT 0,
  `tax` bigint(20) NOT NULL DEFAULT 0,
  `total` bigint(20) NOT NULL DEFAULT 0,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_phone` varchar(20) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_postal` varchar(10) NOT NULL,
  `shipping_method` varchar(50) NOT NULL DEFAULT 'regular',
  `notes` text DEFAULT NULL,
  `confirmed_by` bigint(20) unsigned DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `status`, `payment_method`, `payment_status`, `payment_proof`, `subtotal`, `shipping_cost`, `tax`, `total`, `shipping_name`, `shipping_phone`, `shipping_address`, `shipping_city`, `shipping_postal`, `shipping_method`, `notes`, `confirmed_by`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 3, '#ORD-9B8E47', 'shipped', 'ewallet', 'paid', 'payment-proofs/2Lrwb4ywiGn8201b2rxP2swPw3F2iwORAEN0ZbEK.png', 14094900, 12000, 1550439, 15657339, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'depok', '12321', 'regular', NULL, 2, '2026-04-06 07:38:42', '2026-04-06 07:36:25', '2026-04-06 07:38:50'),
(2, 3, '#ORD-CB078A', 'pending', 'bank_transfer', 'rejected', 'payment-proofs/Bkj1ECpLHxdKugc6iJ2KJrscM2wZNOIzNz0NtLBe.jpg', 13345000, 25000, 1467950, 14837950, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'depok', '12321', 'express', NULL, NULL, NULL, '2026-04-06 10:27:24', '2026-04-06 10:28:01'),
(3, 3, '#ORD-1CF395', 'completed', 'bank_transfer', 'paid', 'payment-proofs/34ba39oybFEAnhrAJ4Hqe4eruEVNf75zOWVAQpN6.png', 41650300, 12000, 4581533, 46243833, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'depok', '12321', 'regular', NULL, 2, '2026-04-06 10:32:19', '2026-04-06 10:29:21', '2026-04-08 22:39:41'),
(4, 3, '#ORD-893318', 'completed', 'bank_transfer', 'paid', 'payment-proofs/mlBzcYg07kID0CkxosOd1cMGIfwMB5MALT27xp60.png', 1884000, 12000, 207240, 2103240, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'depok', '12321', 'regular', NULL, 2, '2026-04-07 07:04:58', '2026-04-06 10:56:40', '2026-04-08 22:17:58'),
(5, 3, '#ORD-F45E29', 'shipped', 'bank_transfer', 'paid', 'payment-proofs/LjZpXHBgu5tRfaOyWtD0DD6mORGj88bI9YRivYwF.png', 13345000, 12000, 1467950, 14824950, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'depok', '12321', 'regular', NULL, 2, '2026-04-07 07:12:13', '2026-04-07 07:06:55', '2026-04-08 22:41:54'),
(6, 3, '#ORD-AAF1FF', 'pending', 'bank_transfer', 'rejected', 'payment-proofs/q6IO5IiiZLM7NAIYkw4bFDWEyxhp7Bek6SsAdYdK.jpg', 47087300, 12000, 5179603, 52278903, 'Budi Santoso', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 'semarang', '16555', 'regular', NULL, NULL, NULL, '2026-04-08 22:38:50', '2026-04-08 22:42:01');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category` varchar(100) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `stock`, `category`, `sku`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Moondrop Aria 2', 'moondrop-aria-2', 'moondrop', 13345000, 7, 'Elektronik', 'NLC-001', 'products/B901QzrXs0lL5CZTr54nESfmHcNIE5cMdGD2MzrZ.jpg', 1, '2026-04-06 07:05:13', '2026-04-08 22:38:50'),
(4, 'Ceramic Vessel Set', 'ceramic-vessel-set', 'Produk berkualitas tinggi dengan desain minimalis modern.', 1884000, 28, 'Rumah & Taman', 'CVS-001', 'products/4664FCbszhkQTtRkGBN5Md3vr96LKOusdP8sQMnD.webp', 1, '2026-04-06 07:05:13', '2026-04-06 10:56:40'),
(5, 'Pro Ultrabook 14', 'pro-ultrabook-14', 'Produk berkualitas tinggi dengan desain minimalis modern.', 20397300, 16, 'Elektronik', 'PUL-001', 'products/XrUCLiodgWRXvDm3yGrbcKGxTQ21U72IQ2MkUMa6.jpg', 1, '2026-04-06 07:05:13', '2026-04-08 22:38:50'),
(11, 'Vertex Chrono V2', 'vertex-chrono-v2', 'Produk berkualitas tinggi dengan desain minimalis modern.', 5024000, 7, 'Elektronik', 'VX-CHR-2024', 'products/w3gsLv6TQFZyQnHGDFf7Ic1Mx3frp2PtUv1l2pDV.jpg', 1, '2026-04-06 07:05:13', '2026-04-06 10:29:22'),
(16, 'Stone Island Black Glossy', 'stone-island-black-glossy', 'iya', 1000000, 5, 'Fashion', 'NACL-02', 'products/MF8avsgPvVVKuq7191fzkRo9qU60pa7PVx7AjQIw.webp', 1, '2026-04-06 10:19:17', '2026-04-06 10:57:29');

DROP TABLE IF EXISTS `sessions`;
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

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','user') NOT NULL DEFAULT 'user',
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@ukk.com', NULL, '$2y$12$yblEEQhoZY6rVrGtxTWcB.ZDSOUdNuKEVj8JDpjMHTtoyuIlTa4AG', 'admin', NULL, NULL, 1, NULL, '2026-04-06 07:05:12', '2026-04-06 07:38:20'),
(2, 'Alex Rivera', 'staff@ukk.com', NULL, '$2y$12$59drX8yTKhNvmqZEGjJk7uQQMGhP4.kQ5hlPZFX1ggeI3vRdnum3a', 'staff', NULL, NULL, 1, NULL, '2026-04-06 07:05:12', '2026-04-06 07:05:12'),
(3, 'Budi Santoso', 'user@ukk.com', NULL, '$2y$12$OgSJBVf849w/Cu/.EOdrTeFjH4nrDq1UivSYCIwD3smztrJoweEzi', 'user', '+62 812 3456 7890', 'Jl. Sudirman No. 123, Jakarta Pusat', 1, NULL, '2026-04-06 07:05:12', '2026-04-06 07:05:12'),
(4, 'Mr.Fools', 'Mrfools@gmail.com', NULL, '$2y$12$RGryfShM6EZANOrPl16BJ.CR7jYFkVEf2wm6Y10i4QgKAzKJBe8eq', 'admin', NULL, NULL, 1, NULL, '2026-04-06 07:11:18', '2026-04-06 07:11:18'),
(5, 'ash', 'everblack@gmail.com', NULL, '$2y$12$aEcfLxKZ5obt9CmHEU2WQeU01VNkwyMh3r8WkViTL5MUbf6zTju0q', 'user', NULL, NULL, 1, NULL, '2026-04-07 06:54:20', '2026-04-07 06:54:20');

SET FOREIGN_KEY_CHECKS=1;
