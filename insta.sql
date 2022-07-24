-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 02:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insta`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_05_26_050034_create_posts_table', 1),
(5, '2022_05_31_102938_create_payments_table', 1),
(6, '2022_06_29_082755_create_vendors_table', 1),
(7, '2022_06_29_083514_create_transanctions_table', 1),
(8, '2022_06_30_063232_add_pay_request_to_transanctions_table', 1),
(9, '2022_07_02_090659_add_access_token_to_posts_table', 1),
(10, '2022_07_19_084603_add_app_id_to_vendors_table', 1),
(11, '2022_07_19_084721_add_app_secret_to_vendors_table', 1),
(12, '2022_07_20_093816_add_ig_username_to_vendors_table', 1),
(13, '2022_07_20_093838_add_ig_profile_image_to_vendors_table', 1),
(14, '2022_07_21_055153_add_image_to_vendors_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_paypal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_paypal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_flug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_flug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `ig_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_account_owner_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `image`, `content`, `image_flug`, `content_flug`, `status`, `ig_account`, `user_unique_id`, `ig_account_owner_unique_id`, `created_at`, `updated_at`, `access_token`) VALUES
(1, '[\"http:\\/\\/localhost:8000\\/uploads\\/posts_image\\/2022-07-20-62d7dee221087_instagram.jpg\"]', 'my_post', '1', '1', 0, '17841404804688719', NULL, '62d7de6c45678', '2022-07-20 17:54:27', '2022-07-20 17:54:27', 'EAAOyUbzPRwoBAFweLWoCWKYegT3ZAtDhOWUinNZCzfrcgIMdij9EsoMOlBbO9EjzrZBBRlaaJnSKTGa5VOOJd64XaHSaIYwSGw0GZBbjgmtfZCEIDEGZAkRDQVZA7VoeXiwlcXzx1XTOxXdkfYhs02t1GxmnLjL5F4XZAMTEFymsHvO8I0yBjkAsZBGhy2o6k7RFgwADU3Iy521147HrDGxX1nHzZAawLTUpO8kqmkK24qdlK3ZC9SWeAvY'),
(2, '[\"http:\\/\\/localhost:8000\\/uploads\\/posts_image\\/2022-07-21-62d8f7485e8bf_instagram.jpg\"]', 'Et dicta et ea nesci', '1', '1', 0, '17841404804688719', NULL, '62d7de6c45678', '2022-07-21 13:50:49', '2022-07-21 13:50:49', 'EAAOyUbzPRwoBAOTD6LnA3RBlgaw5ZCgRuls0Pmpmo01JZChZC8wD7dms7iRjRLvN1OV8R35M5O0wN7eUzaewWDhcADxjwVgOkn8zBYe46fSitwQoovPA4e7dGbVfQ84PWr4GQAEygCWS2QgdcnvNt5kW6FxdeoNltWwwdx1z2lq7AhwciUHZCjBxOsv9nPAZD');

-- --------------------------------------------------------

--
-- Table structure for table `transanctions`
--

CREATE TABLE `transanctions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_paypal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ig_account_owner_paypal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ig_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `transanction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_account_owner_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_request` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transanctions`
--

INSERT INTO `transanctions` (`id`, `user_paypal`, `ig_account_owner_paypal`, `post_id`, `ig_account`, `amount`, `transanction_id`, `status`, `user_unique_id`, `ig_account_owner_unique_id`, `created_at`, `updated_at`, `pay_request`) VALUES
(1, 'sendinfo98-buyer@gmail.com', 'mdrobel.cse@paypal.com', '1', '17841404804688719', 450, '9U156199GW0489604', 1, NULL, '62d7de6c45678', '2022-07-20 17:54:53', '2022-07-20 17:56:07', 1),
(2, 'sendinfo98-buyer@gmail.com', 'mdrobel.cse@paypal.com', '2', '17841404804688719', 450, '27C45945JS113174M', 0, NULL, '62d7de6c45678', '2022-07-21 13:51:15', '2022-07-21 13:51:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_phone`, `unique_id`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@app.com', NULL, '62d7de44ea4e2', '$2y$10$rThyCRG57xZz4yL8ciBQBeXCYfPDUbdfhs7U9yQv2HOLlthKmFOTW', 1, '2022-07-20 17:51:49', '2022-07-20 17:51:49'),
(2, 'Vendor', 'vendor@app.com', NULL, '62d7de6c45678', '$2y$10$rsT/or.HG8PKd4quMaNuu.cX2GWFWIj.g/BY5Dg9NL/R1pvYyWesC', 2, '2022-07-20 17:52:28', '2022-07-20 17:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ig_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_profile_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_profile_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_price` int(11) DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `ig_account`, `access_token`, `facebook_email`, `facebook_profile_link`, `paypal_email`, `instagram_profile_link`, `post_price`, `unique_id`, `status`, `created_at`, `updated_at`, `app_id`, `app_secret`, `ig_username`, `ig_profile_image`, `image`) VALUES
(1, '17841404804688719', 'EAAOyUbzPRwoBAOTD6LnA3RBlgaw5ZCgRuls0Pmpmo01JZChZC8wD7dms7iRjRLvN1OV8R35M5O0wN7eUzaewWDhcADxjwVgOkn8zBYe46fSitwQoovPA4e7dGbVfQ84PWr4GQAEygCWS2QgdcnvNt5kW6FxdeoNltWwwdx1z2lq7AhwciUHZCjBxOsv9nPAZD', 'mdrobel.cse@facebook.com', 'https://www.facbook.com/robelcse', 'mdrobel.cse@paypal.com', 'https://www.instagram.com/mdrobelcse', 450, '62d7de6c45678', 2, '2022-07-20 17:52:28', '2022-07-21 13:35:05', '1040489059927818', '718977c5b653ecbddd13818e91f353c8', 'mdrobelcse', 'https://scontent.frjh1-1.fna.fbcdn.net/v/t51.2885-15/20633349_359099417857476_379813531467382784_a.jpg?_nc_cat=107&ccb=1-7&_nc_sid=86c713&_nc_ohc=Q_lGK9h-1usAX-CyPDn&_nc_ht=scontent.frjh1-1.fna&edm=AJdBtusEAAAA&oh=00_AT80Q2aFpc0CIhKMKkcErlGD7wojBCpcPAg6LjhVGtEIfg&oe=62DED42A', '2022-07-21-62d8f37cbc31e.jpg');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transanctions`
--
ALTER TABLE `transanctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transanctions`
--
ALTER TABLE `transanctions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
