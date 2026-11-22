-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2026 at 05:01 PM
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
-- Database: `task_db`
--

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_10_24_105031_create_sessions_table', 1),
(3, '2026_11_06_035446_create_tasks_table', 1),
(4, '2026_11_21_012730_add_is_archived_to_tasks_table', 2),
(5, '2026_11_21_012753_add_password_to_users_table', 2);

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
('zn3KWIR1Rl8YpNnL76HzxMyAZSKVH7oTbwforMmP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVW1mNllhVUpVdlU3RGtVTGp4ak5JS1lLUmdjMFN6emVWMjFaWlVBSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9fQ==', 1795274175);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `task_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `status`, `task_date`, `created_at`, `updated_at`, `is_archived`) VALUES
(1, 'Technical Summative 1', 'pending', '2026-11-06', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(2, 'Technical Summative 2', 'pending', '2026-11-06', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(3, 'Project', 'pending', '2026-11-06', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(4, 'Summative 1', 'pending', '2026-11-05', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(5, 'Midterm Exam 1', 'pending', '2026-11-05', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(6, 'Final Exam 1', 'pending', '2026-11-07', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(7, 'Final Exam 2', 'pending', '2026-11-07', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0),
(8, 'Final Exam 3', 'pending', '2026-11-08', '2026-11-06 07:10:20', '2026-11-06 07:10:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'Alex Administrator', 'alex@gmail.com', '$2y$12$W73JNrjGInqbAaoTtSX5tuAQkw2CyjNRgbkoCMlZWwQnAmhsyGuJC', '2026-11-06 07:10:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
