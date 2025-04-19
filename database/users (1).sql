-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2025 at 03:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khaynet_billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_induk` bigint DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `nomor_induk`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-08-24 07:43:32', '$2y$12$Ev34zSKJNzP7T89lhq8LDe3EmtDbCtEnXNsgZzoj3wvojO7p.kgo.', NULL, NULL, 'FibsB9NXjo', '2024-08-24 07:43:33', '2024-08-24 07:43:33'),
(5, 'Admin Full', 'admin@gmail.com', NULL, '$2y$10$rY7uqhlljJIkh4HtHfks.ukNvMWMTNEYqwejg.Nt3As5OVvSpee9O', 'admin', NULL, NULL, '2024-09-11 05:47:47', '2024-09-11 05:47:47'),
(6, 'Abiyyu Akbar Althaf', 'rosaantira0@gmail.com', NULL, '$2y$12$hSCNcWwnfI/WZwdmaPA0Hu/D70a5QPfA.sm5anXqfLmJlCpQQStlK', 'siswa', NULL, NULL, '2024-09-11 05:49:43', '2024-09-11 05:49:43'),
(7, 'Zahira Rafanda Nugraha', 'natapertiwi@gmail.com', NULL, '$2y$12$VV6C5pvqEer7jnqcQ72CJ.PlLUXJRc4fIWFNGaJuv7y3zbYEoaUeG', 'siswa', NULL, NULL, '2024-09-13 07:13:42', '2024-09-13 07:13:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
