-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 11:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` bigint(20) NOT NULL,
  `name` varchar(10) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `name`, `semester`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021/2022', 'Genap', '2023-06-19', '2023-06-21', 'Aktif', '2023-06-19 07:05:21', '2023-08-22 08:01:20'),
(2, '2022/2023', 'Ganjil', '2023-06-26', '2023-06-30', 'Aktif', '2023-06-26 07:22:45', '2023-07-28 07:25:06'),
(3, '2022/2023', 'Genap', '2023-02-13', '2023-08-31', 'Aktif', '2023-07-06 07:14:14', '2023-07-28 07:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `academic_year_id`, `teacher_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'TI-4D', '2023-07-06 04:19:00', '2023-07-06 04:27:45'),
(3, 2, 2, 'TI-4A', '2023-07-06 07:18:53', '2023-07-13 04:15:52'),
(4, 3, 1, 'TI-4D', '2023-07-13 04:10:56', '2023-07-13 04:10:56'),
(5, 3, 1, 'TI-4B', '2023-07-13 04:18:00', '2023-07-13 04:18:00'),
(6, 3, 3, 'TI-4C', '2023-07-13 04:38:19', '2023-07-13 04:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE `class_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`id`, `class_id`, `student_id`, `created_at`, `updated_at`) VALUES
(23, 2, 3, '2023-07-06 06:11:13', '2023-07-06 06:12:34'),
(27, 2, 4, '2023-07-06 06:26:02', '2023-07-06 06:28:39'),
(28, 4, 5, '2023-07-13 04:11:10', '2023-07-13 04:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id`, `academic_year_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Latihan 1', 'Latihan 1', '2023-06-27 03:16:43', '2023-07-06 03:46:12'),
(2, 2, 'Latihan 2', 'SELECT', '2023-07-06 04:31:04', '2023-07-06 04:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_question`
--

CREATE TABLE `exercise_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exercise_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no` int(11) NOT NULL,
  `isRemoved` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercise_question`
--

INSERT INTO `exercise_question` (`id`, `exercise_id`, `question_id`, `no`, `isRemoved`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 2, 9, 2, 0, '2023-08-03 06:21:35', '2023-08-04 00:28:05', NULL),
(15, 1, 14, 1, 0, '2023-08-07 20:39:48', '2023-08-07 20:39:48', NULL),
(16, 1, 9, 2, 0, '2023-08-22 08:19:16', '2023-08-22 08:19:16', NULL),
(17, 2, 15, 3, 0, '2023-08-22 19:25:11', '2023-08-22 19:25:11', NULL);

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
(4, '2020_02_03_070955_create_stages_table', 1),
(5, '2020_02_03_072229_create_topics_table', 1),
(6, '2020_02_03_124802_create_tasks_table', 1),
(7, '2020_02_05_073503_create_topic_files_table', 1),
(8, '2020_02_05_115248_create_test_files_table', 1),
(9, '2020_02_06_072655_create_task_results_table', 1),
(10, '2020_02_06_123551_create_learning_files_table', 1),
(11, '2020_02_07_113735_create_file_results_table', 1),
(12, '2020_02_09_114955_create_student_submits_table', 1),
(13, '2020_02_11_071233_create_student_validations_table', 1),
(14, '2020_02_11_115259_create_student_teachers_table', 1),
(15, '2020_03_06_053724_create_classrooms_table', 1),
(16, '2020_03_06_082524_create_class_members_table', 1),
(17, '2020_03_12_095710_create_download_history_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `dbname` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `required_table` text DEFAULT NULL,
  `test_code` text DEFAULT NULL,
  `guide` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `title`, `topic`, `dbname`, `description`, `required_table`, `test_code`, `guide`, `created_at`, `updated_at`) VALUES
(9, 'select table', 'Topic WHERE', 'dbname', 'Buatlah query untuk menampilkan sebuah tabel bernama \"kategori\"', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT has_table( \'kategori\', \'TABEL kategori\');\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT has_table( \'kategori\', \'TABEL kategori\');\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'SKLA.pdf', NULL, '2023-08-04 01:58:50'),
(14, 'SELECT Table1', 'SELECT Table', 'dbname', 'buat', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT has_table( \'kategori\', \'TABEL kategori\');\r\nRETURN NEXT has_table( \'mobil\', \'TABEL mobil\');\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT has_table( \'kategori\', \'TABEL kategori\');\r\nRETURN NEXT has_table( \'mobil\', \'TABEL mobil\');\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'iclop2.pdf', NULL, NULL),
(15, 'Select Table Tes', 'SELECT Table', 'iclop', 'buatlah', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT results_eq(\r\n    \'SELECT * from customers\',\r\n    \'SELECT * from customers\',\r\n    \'tabel customers\'\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'CREATE EXTENSION IF NOT EXISTS pgtap;\r\nCREATE OR REPLACE FUNCTION public.testschema()\r\nRETURNS SETOF TEXT LANGUAGE plpgsql AS $$\r\nBEGIN\r\nRETURN NEXT results_eq(\r\n    \'SELECT * from customers\',\r\n    \'SELECT * from customers\',\r\n    \'tabel customers\'\r\nEND;\r\n$$;\r\nSELECT * FROM runtests(\'public\'::name);', 'SKLA.pdf', NULL, '2023-08-24 22:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 'Aktif', '2023-07-06 13:10:33', '2023-07-06 13:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `solution` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `academic_year_id` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `nama`, `user_id`, `academic_year_id`, `created_at`, `updated_at`) VALUES
(1, 'Dwi Puspitasari', 2, '2', '2023-07-06 03:16:50', '2023-07-06 03:16:50'),
(2, 'Yan Watequlis Syaifudin', 2, '2', '2023-07-06 04:27:33', '2023-07-06 04:27:33'),
(3, 'Arief Prasetyo, S.Kom', 2, '3', '2023-07-13 04:37:55', '2023-07-13 04:37:55'),
(4, 'Putra Prima Arhandi, S.T., M.Kom', 2, '3', '2023-08-22 07:32:47', '2023-08-22 07:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_verifed_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verifed_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin2023@gmail.com', 'admin', NULL, '$2y$10$bHqkk/tvJm1kYMb9OlEeber.hld5QDZqwY1a3cIuue.hp0ZSlppKS', NULL, '2023-06-27 02:03:07', '2023-06-27 02:03:07'),
(2, 'Dosen', 'teacher2023@gmail.com', 'teacher', NULL, '$2y$10$cqRrFq0jMa/hQiJv477J3uDMC.XsCd7nCxEz1xCYWMFBjfeU1jW5q', NULL, '2023-06-27 02:03:07', '2023-06-27 02:03:07'),
(3, 'Auzan', 'zulhazmiauzan@gmail.com', 'student', NULL, '$2y$10$4Pc3tt6G5igaZ6Z5X9mNwO0YB7MuM/5pXuVnFsKBiAqihyVHVSc2K', NULL, '2023-06-27 03:00:53', '2023-06-27 03:00:53'),
(4, 'navis', 'navisabdillah@gmail.com', 'student', NULL, '$2y$10$T3as8PRmfq7Cc84kWE5F1eBVjBHIY5blRvr./r6wMP7urjSOzH3Ju', NULL, '2023-07-06 06:16:34', '2023-07-06 06:16:34'),
(5, 'fauzi', 'ahmadnurfauzi@gmail.com', 'student', NULL, '$2y$10$c.UFUbw0ehMQKQMGMLQaMObcoA1Shzd18p1hT39Dgo/kpdjkIkPzm', NULL, '2023-07-13 04:07:03', '2023-07-13 04:07:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `exercise_question`
--
ALTER TABLE `exercise_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_student`
--
ALTER TABLE `class_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exercise_question`
--
ALTER TABLE `exercise_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`);

--
-- Constraints for table `class_student`
--
ALTER TABLE `class_student`
  ADD CONSTRAINT `class_student_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`);

--
-- Constraints for table `exercise_question`
--
ALTER TABLE `exercise_question`
  ADD CONSTRAINT `exercise_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `exercise_question_ibfk_3` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
