-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 12:35 PM
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
-- Database: `ssb_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `competition` varchar(100) DEFAULT NULL,
  `category` enum('team','individual') DEFAULT 'team',
  `player_id` int(11) DEFAULT NULL,
  `achievement_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('present','absent','excused','late') DEFAULT 'absent',
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `recorded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `license` varchar(100) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id`, `name`, `title`, `bio`, `photo`, `specialization`, `license`, `experience`, `email`, `phone`, `display_order`, `is_active`, `created_at`) VALUES
(1, 'Budi Santoso', 'Head Coach', 'Pelatih bersertifikat AFC dengan pengalaman 10 tahun', NULL, 'Technical Director', 'AFC A License', '10 tahun melatih berbagai usia', 'budi@ssb.com', '08123456780', 1, 1, '2025-12-18 09:35:35'),
(2, 'Sari Dewi', 'Goalkeeper Coach', 'Spesialis pelatih kiper dengan metode modern', NULL, 'Goalkeeping', 'AFC B License', '8 tahun spesialis kiper', 'sari@ssb.com', '08123456781', 2, 1, '2025-12-18 09:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `replied` tinyint(1) DEFAULT 0,
  `reply_message` text DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category` enum('training','match','event','facility','other') DEFAULT 'other',
  `event_date` date DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(300) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `category` enum('news','achievement','event','announcement') DEFAULT 'news',
  `views` int(11) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `published_at` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','transfer','qris') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL,
  `status` enum('pending','paid','confirmed','cancelled') DEFAULT 'pending',
  `confirmed_by` int(11) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `age` int(11) NOT NULL,
  `age_group` enum('U-6','U-8','U-10','U-12','U-14','U-16') NOT NULL,
  `school` varchar(100) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `position` enum('GK','DF','MF','FW') DEFAULT NULL,
  `parent_name` varchar(100) NOT NULL,
  `parent_phone` varchar(15) NOT NULL,
  `parent_email` varchar(100) DEFAULT NULL,
  `parent_occupation` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `health_info` text DEFAULT NULL,
  `emergency_contact` varchar(15) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `status` enum('pending','active','inactive','graduated') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `age_group` varchar(50) NOT NULL,
  `schedule` varchar(200) NOT NULL,
  `days` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `fee_description` text DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `current_participants` int(11) DEFAULT 0,
  `location` varchar(200) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `slug`, `description`, `age_group`, `schedule`, `days`, `time`, `duration`, `fee`, `fee_description`, `coach_id`, `max_participants`, `current_participants`, `location`, `is_featured`, `is_active`, `created_at`) VALUES
(1, 'Sekolah Sepak Bola Dasar', 'sepak-bola-dasar', 'Program untuk pemula usia 6-12 tahun', 'U-6, U-8, U-10, U-12', 'Setiap Senin, Rabu, Jumat', 'Senin, Rabu, Jumat', '15:00 - 17:00', '2 jam/sesi', 350000.00, 'Biaya bulanan termasuk jersey latihan', NULL, 30, 15, 'Lapangan Utama SSB', 1, 1, '2025-12-18 09:35:35'),
(2, 'Akademi Elite U-14', 'akademi-elite-u14', 'Program intensif untuk usia 13-14 tahun', 'U-14', 'Setiap Selasa, Kamis, Sabtu', 'Selasa, Kamis, Sabtu', '16:00 - 18:00', '2 jam/sesi', 500000.00, 'Termasuk latihan fisik dan nutrisi', NULL, 25, 10, 'Lapangan Stadion', 1, 1, '2025-12-18 09:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_type` varchar(50) DEFAULT 'text',
  `category` varchar(50) DEFAULT 'general',
  `description` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `setting_type`, `category`, `description`, `updated_at`) VALUES
(1, 'site_name', 'SSB Bintang Muda', 'text', 'general', 'Nama Sekolah Sepak Bola', NULL),
(2, 'site_title', 'Sekolah Sepak Bola Bintang Muda', 'text', 'general', 'Judul Website', NULL),
(3, 'site_description', 'Membentuk Generasi Unggul melalui Sepak Bola', 'text', 'general', 'Deskripsi Website', NULL),
(4, 'site_keywords', 'ssb, sekolah sepak bola, akademi sepak bola, football academy', 'text', 'general', 'Keywords SEO', NULL),
(5, 'contact_phone', '08123456789', 'text', 'contact', 'Nomor Telepon', NULL),
(6, 'contact_email', 'info@ssbbintangmuda.com', 'text', 'contact', 'Email Kontak', NULL),
(7, 'contact_address', 'Jl. Olahraga No. 123, Kota Kita', 'textarea', 'contact', 'Alamat Lengkap', NULL),
(8, 'social_facebook', 'https://facebook.com/ssbbintangmuda', 'text', 'social', 'Facebook URL', NULL),
(9, 'social_instagram', 'https://instagram.com/ssbbintangmuda', 'text', 'social', 'Instagram URL', NULL),
(10, 'social_youtube', 'https://youtube.com/ssbbintangmuda', 'text', 'social', 'YouTube URL', NULL),
(11, 'registration_fee', '250000', 'number', 'finance', 'Biaya Pendaftaran', NULL),
(12, 'training_fee', '350000', 'number', 'finance', 'Biaya Latihan Bulanan', NULL),
(13, 'currency', 'Rp', 'text', 'finance', 'Simbol Mata Uang', NULL),
(14, 'admin_email', 'admin@ssbbintangmuda.com', 'text', 'email', 'Email Administrator', NULL),
(15, 'smtp_host', 'smtp.gmail.com', 'text', 'email', 'SMTP Host', NULL),
(16, 'smtp_port', '587', 'text', 'email', 'SMTP Port', NULL),
(17, 'smtp_username', '', 'text', 'email', 'SMTP Username', NULL),
(18, 'smtp_password', '', 'text', 'email', 'SMTP Password', NULL),
(19, 'max_upload_size', '5', 'number', 'system', 'Ukuran maksimal upload (MB)', NULL),
(20, 'maintenance_mode', '0', 'boolean', 'system', 'Mode Maintenance', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `author_title` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` enum('admin','coach','staff') DEFAULT 'staff',
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `role`, `phone`, `photo`, `last_login`, `is_active`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ssb.com', 'Administrator', 'admin', '08123456789', NULL, NULL, 1, '2025-12-18 09:35:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `attendance_date` (`attendance_date`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_read` (`is_read`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category` (`category`),
  ADD KEY `is_published` (`is_published`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_no` (`registration_no`),
  ADD KEY `age_group` (`age_group`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
