-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2024 pada 19.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imbos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` char(36) NOT NULL,
  `guru_id` char(36) NOT NULL,
  `kelas_id` char(36) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_details`
--

CREATE TABLE `absensi_details` (
  `id` char(36) NOT NULL,
  `absensi_id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_gurus`
--

CREATE TABLE `absensi_gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `email`, `foto`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('9c84a566-a710-4061-ab76-edf2cea0e49c', 'admin', 'Admin User', 'admin@example.com', 'admins/GMHOKpNXFvuND4ein2OY9ixK2D9IVhdkFl7MaUso.jpg', NULL, '$2y$12$lgjl6DOfTCAX1xWPSnNuP.s/z4D3CUw24mJ/uQT/n8R4W0U5l0MfS', 'ItOAELGHsSm2zXCOxJwphiAoi9N8nP3qWwmrP0fXjHitDZyLzZhBKhVAh5sb', '2024-07-13 22:34:06', '2024-07-29 10:07:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumnis`
--

CREATE TABLE `alumnis` (
  `id` char(36) NOT NULL,
  `nama_alumni` varchar(255) NOT NULL,
  `jenis_perguruan_tinggi_id` char(36) DEFAULT NULL,
  `nama_universitas` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tahun_lulusan` year(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumnis`
--

INSERT INTO `alumnis` (`id`, `nama_alumni`, `jenis_perguruan_tinggi_id`, `nama_universitas`, `foto`, `tahun_lulusan`, `status`, `created_at`, `updated_at`) VALUES
('9ca9a046-025d-4238-9263-4fc5c045186b', 'Afkar Dzaki Asyrof', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Sekolah Tinggi Pertanahan Nasional - D-IV Pertanahan', 'foto_alumni/mJ2VKsOi3yb4zlebf9cv9aLjIURhFQOWE0jj8Sqa.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:04'),
('9ca9a046-101f-4e6c-8f85-bc89b37d14ef', 'Nayra Yaniza', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Poltekes TJ Karang- Kebidanan', 'foto_alumni/6xEWHKV2qBDT06QWDlNvcB4AEgNO8M5VI758MpOY.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:16'),
('9ca9a046-1165-490f-a393-604eb46a013c', 'Widian Saputra', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Carabuk University Turkey - Bussines Administration', 'foto_alumni/C1hivlBkeVJG3N8E8g3Bzj7XoqsFJgwZfhc3JCUe.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:28'),
('9ca9a046-12b2-4b68-b880-163c90671489', 'Nazala Aulia Salsabila', '8bb88f3a-428b-453d-998c-bba0264195d1', 'Politeknik Negeri Lampung - Teknologi Produksi Ternak', 'foto_alumni/ctUQSney030OPzuYqc44sX4t2cKCtb6F2PjjHmJX.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:38'),
('9ca9a046-13ec-41e8-a0d9-382b725076c9', 'A\' Alam El Izzi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Teknik Geologi', 'foto_alumni/laf2F7cgu0f3aGKWnxNCknsxNOaEYy3qUGfNEoxG.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:49'),
('9ca9a046-151b-495c-b13a-7a4ac727a78d', 'Daffa Azka Zhafira', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Lampung - Akuntansi', 'foto_alumni/pw1f47QarOA8fXE1BcM2ApyJEyHHEwCJFYSrOt0g.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:45:59'),
('9ca9a046-164d-4504-9ae7-2f65a878a229', 'Miqdad Ibadurrahman', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Negeri Padang - Ilmu Hukum', 'foto_alumni/B3.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-1769-47bb-a546-0542ac9be8e7', 'Noha Azizah Ramadhani', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Padjajaran - Peternakan', 'foto_alumni/dPSegNZtzlFEpKQ8EjH1kGCnhxhUPx07atjP8cAf.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:46:14'),
('9ca9a046-187b-4698-a924-22801561d8d8', 'M Dzaki Attamimi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Negeri Jakarta - Pendidikan Jasmani', 'foto_alumni/aAs5vbH0NWz5YQmnXGXepUeRZY4AuTTW5VDGUdzi.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:46:31'),
('9ca9a046-19a6-4792-af9c-8b31ca238a50', 'M Alwi Hanif', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universtas Sriwijaya - Pendidikan Bahasa Inggris', 'foto_alumni/OwA33R3q8K2CwyZEFzx1nFE7Aj5ME3XFbblk4XeW.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:18:01'),
('9ca9a046-1acb-4ed4-a30d-199b41e74ce8', 'Salima Athiyah Fahriyah', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Sriwijaya - Pendidikan Biologi', 'foto_alumni/5odr32ebesGqVeWyNfmucMSs2cjy72hwYnxEU8DN.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:19:08'),
('9ca9a046-1bcb-449c-adf8-b7d3c3e075f8', 'Jihan Nursakinah', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Sultan Ageng Tirtayasa - Hukum', 'foto_alumni/B8.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-1cc6-4070-abfa-c464fb143655', 'Abdy Putra Sanjaya', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Bengkulu - Pendidikan Jasmani', 'foto_alumni/B9.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-1df1-4762-a468-9d26522044e3', 'Winny Haba Fadhillah', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'Universitas Terbuka - Ilmu Pemerintahan', 'foto_alumni/B10.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-1f20-432c-b8b8-47035018f8ba', 'Khafid Zaidan Muzakki', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Teknik Lingkungan', 'foto_alumni/B11.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2052-49d9-ab02-121e38ba00a9', 'Nauval Ahmad Dzaki', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Teknik Mesin', 'foto_alumni/B12.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2174-4d2b-a91a-2a341574e054', 'Qonita Aditya Rahmadina', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Biologi', 'foto_alumni/B13.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-229d-44af-ae4b-7bdc37a3a382', 'Adzkia Hasna Salsanila', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA -Akuntansi', 'foto_alumni/B14.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-23af-4fef-b4ad-c539bc4fe771', 'M Rafli Yulianto', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Pendidikan Jasmani', 'foto_alumni/B15.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-24bf-421b-873f-7a6050555ee0', 'Dhiya Jauza Hanun', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Pendidikan Biologi', 'foto_alumni/B16.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-25db-4bf3-bb1f-5939901dabd3', 'Hafidz Izzuddin Alfaruq', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - IESP', 'foto_alumni/B17.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-26f7-49ff-800d-eae457e0ff2c', 'Shofura Nuha Handoko', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Hukum', 'foto_alumni/B18.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-27fe-4c24-a79a-ef921d539ca7', 'Fany Azzahra', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Manajemen', 'foto_alumni/B19.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2926-4b44-abec-d0a1ac40c6fe', 'Qonita Nurul Izzah', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Pendidikan Ekonomi', 'foto_alumni/B20.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2a40-47c4-a806-08a015a3a722', 'Tsabita Nur Azkiya', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Ilmu Komunikasi', 'foto_alumni/B21.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2b5d-4e77-9831-ca590bfdef85', 'Haidar Rosyidul Umam', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Ilmu Pemerintahan', 'foto_alumni/B22.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2c73-45eb-8528-da7be1ab0e32', 'Alfarisa Dhea Fatmala', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Kimia', 'foto_alumni/B23.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2d84-41b7-8b60-c2dee8fef1c2', 'Nizar Farezi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'UNILA - Adminitrasi Negara', 'foto_alumni/B24.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2e8c-4bc4-97c6-2f51789f41f3', 'Harits Mukhlash Al Qisthi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA -Teknik Geomatika', 'foto_alumni/B25.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-2fa5-430b-a5df-12b79c165ae0', 'Azhar Jihan Sabela', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Teknik Kimia', 'foto_alumni/B26.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-30c8-4609-88a1-836e2199ed81', 'Tia Dewitasari', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Rekayasa Kosmetik', 'foto_alumni/B27.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-31c8-4b9e-a825-74b84e323c9e', 'Bela Apriliani', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Farmasi', 'foto_alumni/B28.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-32d6-4e33-b139-3955c633ba69', 'Muhammad Dava Cody', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Teknik Kimia', 'foto_alumni/B29.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-33e8-4f58-aede-9db133bdc30a', 'William Kadavi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Arsitektur Lanskap', 'foto_alumni/B30.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-34e1-4e6c-9908-61964117ff7c', 'Ananda Meco AlFadil', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Arsitektur', 'foto_alumni/B31.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-35a9-468d-a622-ca0889abc91c', 'Izzati Hasna Adiba', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Desain Komunikasi Visual', 'foto_alumni/B32.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-36a1-4473-b6fa-a2a8fea8f97f', 'Hana Yusriyyah Shofa', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Desain Komunikasi Visual', 'foto_alumni/B33.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-37ba-4014-aead-3b627044bcef', 'Rifqi Ihsanu Raafi', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Teknik Material', 'foto_alumni/B34.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-38c9-43e4-b693-ea1e2f8bdb6a', 'Ilyas Hafiyyan Surya', '52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'ITERA - Teknik Material', 'foto_alumni/B35.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-39dc-492f-ae63-479d01385e9e', 'M Najmi Robbani', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Sunan Gunung Djati Bandung - Pendidikan Bahasa Inggris', 'foto_alumni/pUtyO1IDmaHj5G0DKprtFF3Mi3kd6tSbjapSXOJ7.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:47:09'),
('9ca9a046-3aeb-4309-9ff3-6aa21953ff10', 'Fira Aprilia Nur Rahma', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Syarif Hidayatullah - Pendidikan Agama Islam', 'foto_alumni/Oa6H72nbWmJq1jATxf7Mua6CqOwgYnsOPKexSAqw.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 20:48:06'),
('9ca9a046-3bf9-4002-ba70-8ca9affadeeb', 'Naila Zahra H', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung- Pendidikan Agama Islam', 'foto_alumni/2aacPhQerjENMhszNcqeuQD3digt0jGw7NdFBvOs.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:21:00'),
('9ca9a046-3d0a-4bff-833b-4dca1d3d7474', 'Fitrisya Aura Delia', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung- Psikologi Islam', 'foto_alumni/ZSV4J2151FEO06GI3FKOLxHThlKdec2XTVWb5Sxp.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:21:20'),
('9ca9a046-3e10-47a4-8f65-e2647e94cbe9', 'Rizki Fika Wandhifi', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung - Manajemen Bisnis Syariah', 'foto_alumni/uthTKPh33wPPkNLoWZlpYqb0KhIvfW0l2GLEdQRV.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:21:38'),
('9ca9a046-3f39-443f-937b-d79a7463b39a', 'Silfi Wulandari', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung - Pendidikan Bahasa Arab', 'foto_alumni/C6.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-402e-4cb5-9efb-0d08f736b729', 'Surya Faras F', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung - Pendidikan Agama Islam', 'foto_alumni/C7.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-412f-4a0d-9f52-2098b6ae8f5a', 'Naysila Indah Praba', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Sunan Gunung Djati Bandung - Hukum Pidana Islam', 'foto_alumni/C8.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4236-4f4e-9e4c-abfc20e0fbf4', 'Atina Syifa Kamila', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung - Komunikasi dan Penyiaran Islam', 'foto_alumni/C9.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-435a-4b75-bdcd-9360944d062f', 'Uny Ulfatussalwa', 'b06855b8-2183-42a3-973a-1000266e5ebc', 'UIN Raden Intan Lampung - Pendidikan Biologi', 'foto_alumni/C10.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4468-4fd7-950a-11c8ed1c38ab', 'Tazkiya Al Khonza', '0e014732-6779-4883-80e3-994b1e28d15f', 'Umar Usman Business School - Bisnis', 'foto_alumni/2ZfjBnuzdiT32lNW862sFYL3VjKgsmzdFvbDFEfI.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:22:27'),
('9ca9a046-453f-4178-bd7d-0a478bb4d998', 'Muhammad Mumtaz Abida', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Islam Indonesia - Akuntansi', 'foto_alumni/JeAkTbUrLcrbQpxhB85ARZnN9qeS45AzQNBfgPDy.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:23:33'),
('9ca9a046-4609-4cd5-8fb6-e6b36c0e0448', 'Nurul Fadillah', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Budi Luhur - Komunikasi Pariwisata', 'foto_alumni/77AVoXR1ofwDvGmkLnEXLsIJjPVJGycm8FV2QPa0.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:24:01'),
('9ca9a046-470c-4cd8-bb42-540feb67b0dd', 'Esa Arba Nabila', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Muhammadiyah Yogyakarta -Keperawatan', 'foto_alumni/CZw17TX2UYIadXrDbgsxwAZ9CJ7VFVPV0TcKKEfN.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:24:18'),
('9ca9a046-4845-41c0-a0a8-f9b582baef77', 'M Fathan Ghiyats A', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Muhammadiyah Yogyakarta - Teknik Mesin', 'foto_alumni/TvRoh0cPBb6wtTlzkd1KY2Wd0b4Tx9xcg2RabEg0.jpg', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 09:24:34'),
('9ca9a046-4973-4c49-90c9-4ed413559ce9', 'Izzati Najla Mutia', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas \'Aisyah Yogyakarta - Teknologi Laboratorium Medis', 'foto_alumni/D6.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4a9f-4ff7-8fe6-23c1ef54d776', 'Dzakwan Taqi Rizkhillah', '0e014732-6779-4883-80e3-994b1e28d15f', 'Univeristas Muhammadiyah Palembang - Teknik Industri', 'foto_alumni/D7.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4bc7-4fdd-8fcc-90a2a37b4617', 'Abdullah Azam', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Malahayati - Manajemen', 'foto_alumni/D8.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4ccf-478d-a4c4-05ad2d131495', 'Adzira Devina Putri', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Malahayati - Kedokteran', 'foto_alumni/D9.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4da1-49e0-a47d-9c57c8c741a9', 'Muhammad Rahman', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Malahayati - Manajemen', 'foto_alumni/D10.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4e9a-41dc-ae20-ce3f69ec25f8', 'Caesalina Indah Mu\'assyaroh', '0e014732-6779-4883-80e3-994b1e28d15f', 'IBI DARMAJAYA -Bisnis Digital', 'foto_alumni/D11.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-4fac-4d97-bb1f-7a69bde27aca', 'Achmad Ruzabari', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Bandar Lampung - Hukum', 'foto_alumni/D12.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-50a4-4608-8663-005f645a1af5', 'Yulistia Karera Muhti', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Bandar Lampung - Hukum', 'foto_alumni/D13.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-51ab-4eb3-ac06-bd958d54dbc1', 'Friska Naula Satria', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Bandar Lampung - Hukum', 'foto_alumni/D14.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-52ac-4095-b67a-6f708e542dd0', 'Rayhan Abudllah', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Muhammadiyah Pringsewu - Manajemen', 'foto_alumni/D15.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-53a8-4ea3-a956-78dde420c7ae', 'Hanan Rafidah', '0e014732-6779-4883-80e3-994b1e28d15f', 'Universitas Muhammadiyah Pringsewu - Pendidikan Bahasa Indonesia', 'foto_alumni/D16.JPG', '2022', 1, '2024-08-01 07:45:23', '2024-08-01 08:05:29'),
('9ca9a046-5481-418f-b7a1-f8299e26de71', 'Aisyah Ramadhani', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-55c7-4d6b-97a1-78032e9b1bc8', 'Fadillah Kurniawan', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-56e8-4ab0-872e-fa4384b0b17a', 'M Alfico Prasetia Luzer', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5818-44ef-b555-2614cc324e8a', 'Muhammad Faiz Adlan', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5916-40e8-aa33-cfbc013bdf4e', 'Angelita Tiwi Eka Putri', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5a13-47fa-94bb-44fb7622ca3a', 'Dinda Dewi Asyifa', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5b2d-46c0-8895-4af60bcc3edb', 'Khofifah Juliana Putri', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5c5f-41b3-953c-360b483aca48', 'Bima Raffi Alhaqi', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-5fdb-470d-a572-7ad1065fe41b', 'Fazza Rafi Abrar Zahrran', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-611e-4fe1-b278-c434221d6fa9', 'Muhammad Gholib Hizbullah', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9a046-623d-494d-87a0-541a55bb70da', 'Az-zahra Zakiyah Dane', '1755050f-5014-11ef-ac37-50000f4a498d', 'Gapyer', NULL, '2022', 1, '2024-08-01 07:45:23', '2024-08-01 07:45:23'),
('9ca9c9f3-e8e0-4a1a-a397-4df4ef69f47f', 'Tiwiendah Syah', '0e014732-6779-4883-80e3-994b1e28d15f', 'S1 Kedokteran Gigi - Universitas Muhammadiyah Yogyakarta', 'foto_alumni/1722530516.jpg', '2022', 1, '2024-08-01 09:41:56', '2024-08-01 09:41:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritas`
--

CREATE TABLE `beritas` (
  `id` char(36) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kategori_id` char(36) NOT NULL,
  `author_id` char(36) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `beritas`
--

INSERT INTO `beritas` (`id`, `judul_berita`, `isi_berita`, `foto`, `kategori_id`, `author_id`, `status`, `file`, `created_at`, `updated_at`) VALUES
('9caabc10-5fc6-4dc7-a2f4-9757a8f44769', 'UTBK ada auran baru: Apa ya????', '<p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Nggak hanya SNBP, ada juga aturan baru yang perlu kamu pahami di UTBK-SNBT 2024. Apa aja? Ini detailnya.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1. Lulus SNBT, Nggak Bisa Daftar Jalur Mandiri</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Peserta yang dinyatakan lulus melalui Jalur SNBT 2024 dan telah daftar ulang atau registrasi di PTN yang dituju tidak dapat diterima pada seleksi Jalur Mandiri di PTN manapun.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2. Bisa Memilih hingga 4 Program Studi</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Kamu memiliki kesempatan untuk memilih maksimal 4 (empat) pilihan program studi, yang terdiri dari 2 (dua) pilihan program akademik dan 2 (dua) pilihan program vokasi. Detailnya bisa kamu cek di bawah ya!</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3. Ada Soal Isian</span></p><p><span style=\"font-weight:normal;\" id=\"docs-internal-guid-df9bfb62-7fff-f506-aefe-1ec0fd4d1c06\"></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Tipe soal di SNBT 2024 juga akan memiliki sedikit perubahan nih. Ada soal isian singkat di UTBK-SNBT mendatang. Eits, kamu nggak perlu khawatir. Tipe soal ini bukan soal esai yang membutuhkan jawaban panjang. Kamu hanya perlu menuliskan jawaban secara singkat dan merupakan jawaban akhir jika itu soal matematika. Angkanya juga merupakan angka bulat, bukan berupa pecahan sehingga nggak akan menyulitkan dan akan tetap bisa dinilai lewat sistem komputer.</span></p>', 'fotos/gNDS47eHi9BXi9BsjGPFmgkBm0mfwJEVQP6Ewd0l.jpg', '07810638-b306-4e5b-8d8e-7c5a52acdb09', '9c84a566-a710-4061-ab76-edf2cea0e49c', 1, NULL, '2024-08-01 20:58:55', '2024-08-01 20:58:55'),
('9caabcb7-7418-4539-be14-8acd6fbd86e7', 'Jadwal dan Waktu Pelaksanaan UTBK SNBT 2024', '<p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pelaksanaan UTBK 2024 dibagi menjadi 2 gelombang. Gelombang pertama berlangsung di tanggal 30 April sampai 7 Mei. Sementara gelombang kedua berlangsung di tanggal 14 sampai 20 Mei 2024.&nbsp; Akan ada 2 sesi di setiap harinya, yaitu pagi dan siang. Berikut jadwal lengkap UTBK 2024:</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pembuatan akun SNPMB: 9 Januari – 15 Februari 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pendaftaran UTBK-SNBT: 21 Maret – 5 April 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pelaksanaan UTBK Gelombang I: 30 April dan 2 – 7 Mei 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pelaksanaan UTBK Gelombang II: 14 – 20 Mei 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pengumuman Hasil SNBT: 13 Juni 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Masa Unduh Sertifikat UTBK: 17 Juni – 31 Juli 2024</span></p><p><b style=\"font-weight:normal;\" id=\"docs-internal-guid-39bac65f-7fff-f3c5-1fb0-54f01dc7a76f\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ketentuan Pilihan Program Studi di SNBT 2024</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Setiap peserta bebas memilih program studi di PTN Akademik, PTN Vokasi, dan/atau PTKIN.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Setiap peserta diperbolehkan memilih maksimal 4 (empat) program studi yang terdiri dari 2 (dua) pilihan Program Akademik (Sarjana) dan 2 (dua) pilihan Program Vokasi (Diploma Tiga dan Diploma Empat/Sarjana Terapan) dengan ketentuan sebagaimana tabel terlampir.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Urutan dalam pemilihan program studi menyatakan prioritas pilihan.</span></p><p><span style=\"font-weight:normal;\"></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><span style=\"font-size:11pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Yuk, lihat ketentuan baru pemilihan program studi di UTBK SNBT 2024 berikut ini.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:10pt;\"><img src=\"https://demo.imbos.sch.id/storage/gambar_berita/SyBWoK0aLcmhekv3aJsIqEIBTzv5euCf1SI2Y1t1.jpg\" style=\"width: 686px;\"><br></p>', 'fotos/dYZAN4qVRAsn9o2fkbgwCn0jWugk6nHXVH9xp9bo.jpg', '4c07a9bc-70b6-4a30-9439-8d4ebfb98906', '9c84a566-a710-4061-ab76-edf2cea0e49c', 1, NULL, '2024-08-01 21:00:45', '2024-08-01 21:00:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gurus`
--

CREATE TABLE `gurus` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `mata_pelajaran_id` char(36) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `foto_sampul` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `motto` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gurus`
--

INSERT INTO `gurus` (`id`, `nama`, `nip`, `mata_pelajaran_id`, `tempat_lahir`, `tanggal_lahir`, `foto`, `foto_sampul`, `password`, `motto`, `created_at`, `updated_at`) VALUES
('9c99aa91-0259-4361-80d8-2a0e7af72b79', 'M.Kosim Ali, M.Pd', '2022199705191180', '71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', NULL, NULL, 'fotos/mIUL0x57dLlJrffRdUI712PWZUG8Ak2yF58LAbWw.jpg', NULL, '$2y$12$PwXeqwWLq9WDjiz7ySzNiOJk7ANL.L51yUbHh8sTQ0Jjk/84IHYBW', 'Setiap Rumus yang dipecahkan adalah bukti bahwa semangatmu lebih kuat dari pada kerumitan matematika', '2024-07-24 09:20:55', '2024-08-01 20:20:30'),
('9c99adcf-7b21-4b09-a80d-02d0f6ae8cfe', 'Ardian Fahri, M.Pd', '2021199707021118', '93e136c7-a3d3-4658-9f18-9c54ca8a4e20', NULL, NULL, 'fotos/S0SKVtf0bsSadJbbW2kIhU6qiNE2O20pnkieYY2G.jpg', NULL, '$2y$12$XztwK2455sZ7gLE0BPBhROrQxGkxRlSs9p/rjdrvf/.3Avdwp/XW.', 'A dream doesn\'t become reality throught magic; it takes sweat, determination, hard work, and prayer', '2024-07-24 09:29:59', '2024-08-01 20:21:41'),
('9c99ae45-83e0-42b9-a35f-7acde74b0fbe', 'Wildan Amadi, M.Pd', '2022199510071190', '1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', NULL, NULL, 'fotos/zkCLPZyPj6M7DVo6roVnr9lpJclCIaVZ6sTKe558.jpg', NULL, '$2y$12$7UJY7Cq9FWWH7xcHk8l/Oe/H3OzTLs2pmuLOI5.h7zyfBRnxlYJiW', 'Masa depan adalah milik mereka yang belajar sepanjang hayat', '2024-07-24 09:31:17', '2024-08-01 20:22:18'),
('9c99ae86-25c6-4e6e-ac1d-dc517af8b353', 'Niro SAS, M.Pd', '2021199406081117', '462d7204-80b5-4f40-8ead-69a411a99668', NULL, NULL, 'fotos/ijKD1FdJcrd8YRO7mfxjvQSJfFxmph2qng6ZOOze.jpg', NULL, '$2y$12$c8tSyaTzcxUPIto8mBjGC.Npz40HMBEH5poF38zXIuLpQmziuWpRq', 'Do something today that makes yourself thank for it, believe in yourself and do the best of you', '2024-07-24 09:31:59', '2024-08-01 20:22:50'),
('9c99af0b-aacf-42c6-9863-74e3fc96686d', 'Afrizal Halim, S.Si', '2021199827051179', '93e136c7-a3d3-4658-9f18-9c54ca8a4e20', NULL, NULL, 'fotos/brR7RG70iqzbvuT6RDNMvJNNhMC4aiFfwwYtEZ8R.jpg', NULL, '$2y$12$iKrvxtcrS5FAHyPnviV/NuOfpd1sJq4mCy5s3n2J6FH/HaWIbJGd2', 'Dirikanlah shalat dan tunaikanlah zakat, setelah itu bekerja keraslah hingga kamu tidak pernah menyesali hasilmu', '2024-07-24 09:33:27', '2024-08-01 20:23:59'),
('9c99af89-a48e-42f1-a8c7-4a28e47b5b34', 'Afifah Thurrifqoh, S.Pd', '2021199918022126', '71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', NULL, NULL, 'fotos/Jro6CJ5uNGw91Z69eJdZkJ9EDUNTV2CiENev0MCr.jpg', NULL, '$2y$12$eAZbEafikXPhiMNzuTQrl.0H1uyiNVOMAbbMaFKOHmGcF/GqQrhZ2', 'Live your truth. Express your love. Share your enthusiasm. Take action towards your dreams. Embrace your blessings. Use the Qur’an as a guide. Make this day worth remembering', '2024-07-24 09:34:49', '2024-08-01 20:24:51'),
('9c99afea-360d-4c09-bf4f-37e14ec66b74', 'Nur Faradila Tsani, S.Pd', '2022199806112182', '1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', NULL, NULL, 'fotos/mVrdromy32Adzs0clL8ltDQlYrhriepxJ0u7qr2r.jpg', NULL, '$2y$12$5/tR34InD4.RuALNhs0DLuu2ZuA6ZsfiBdw4d8FWRpin4SsIHCts6', 'Setiap hari adalah kesempatan baru untuk belajar dan berkembang menjadi versi terbaik dari dirimu.Ketekunan dalam belajar adalah jembatan yang menghubungkan mimpi dan kenyataan', '2024-07-24 09:35:52', '2024-08-01 20:25:34'),
('9caab132-5267-4e92-b611-5d6e3d0b869b', 'Adriansyah, S.Pd', '2022199702031195', 'a0e9d872-5b7c-4d41-ac17-fa6eab6aca1e', NULL, NULL, 'fotos/6yPuXfGAKvHx59OtXIHXkifZF6VqysgdAhVw6AJl.jpg', NULL, '$2y$12$nEvd/igPe7cGJ/3BAKz3heoZMD87SJHGzY2SxmgTGZXGZGzWbQKBW', NULL, '2024-08-01 20:28:32', '2024-08-01 20:29:48'),
('9caab15b-4532-478b-9d9a-c3b940b3663a', 'M. Ilham Megantara, S.Pd', '2021199525071121', '71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', NULL, NULL, 'fotos/seLSmWylBud7SzpzMWLdGDSLiyEEmzvwmm2DdpEp.jpg', NULL, '$2y$12$lma99DH72nk2m9Dvb3eLsO4j908C0IHylpmze8La5fMXhRc4NFRAa', 'Hidup bukan sebuah balapan, bukan tentang siapa yang duluan tapi tentang siapa yang memberi manfaat lebih banyak, jalani hidup sesuai ritmemu', '2024-08-01 20:28:59', '2024-08-01 20:29:15'),
('9caab1c5-b000-4c31-a5d8-a6eb05af3e1a', 'Septa Putri Nugraha, S.Pd', '2021199716092114', '0ba1c675-b081-4175-9f09-773e4dc51ed3', NULL, NULL, 'fotos/V95aFiRVGfqdzniADezlRrPTPO32zKaqZGjmpzeu.jpg', NULL, '$2y$12$qVwRviBMh6rco4ZGbT8cGuAYF5tSP/eE2KnI0OFpUSvwvvEu7v5su', NULL, '2024-08-01 20:30:08', '2024-08-01 20:30:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_perguruan_tinggis`
--

CREATE TABLE `jenis_perguruan_tinggis` (
  `id` char(36) NOT NULL,
  `nama_jenis_pt` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_perguruan_tinggis`
--

INSERT INTO `jenis_perguruan_tinggis` (`id`, `nama_jenis_pt`, `status`, `created_at`, `updated_at`) VALUES
('0e014732-6779-4883-80e3-994b1e28d15f', 'PTS (Perguruan Tinggi Swasta)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('1755050f-5014-11ef-ac37-50000f4a498d', 'Lain - Lain', 1, '2024-08-01 14:40:57', '2024-08-01 14:40:57'),
('52ef99a1-a73b-40e1-b10a-b9be773e0c73', 'PTN (Perguruan Tinggi Negeri)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('8bb88f3a-428b-453d-998c-bba0264195d1', 'PTK (Perguruan Tinggi Kedinasan)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54'),
('b06855b8-2183-42a3-973a-1000266e5ebc', 'PTKIN (Perguruan Tinggi Islam Negeri)', 1, '2024-07-23 09:13:54', '2024-07-23 09:13:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_beritas`
--

CREATE TABLE `kategori_beritas` (
  `id` char(36) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_beritas`
--

INSERT INTO `kategori_beritas` (`id`, `nama_kategori`, `status`, `created_at`, `updated_at`) VALUES
('07810638-b306-4e5b-8d8e-7c5a52acdb09', 'UTBK', 1, '2024-08-01 20:56:16', '2024-08-01 20:56:16'),
('4c07a9bc-70b6-4a30-9439-8d4ebfb98906', 'Jadwal', 1, '2024-08-01 20:57:29', '2024-08-01 20:57:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` char(36) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `tingkat_kelas` varchar(255) NOT NULL,
  `status_kedinasan` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat_kelas`, `status_kedinasan`, `status`, `created_at`, `updated_at`) VALUES
('47b862e3-3bb8-462d-aa5c-f57aa29195f7', 'BIMBEL 2', 'BIMBEL 2', 0, 1, '2024-08-02 08:23:39', '2024-08-02 08:23:39'),
('55f0c807-6b7e-4076-8184-e0f705ed0123', 'KEDINASAN 2', 'KEDINASAN 2', 1, 1, '2024-08-02 08:24:30', '2024-08-02 08:24:30'),
('6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', 'BIMBEL 5', 'BIMBEL 5', 0, 1, '2024-08-02 08:24:05', '2024-08-02 08:24:05'),
('b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', 'BIMBEL DAN KEDINASAN', 'BIMBEL DAN KEDINASAN', 2, 1, '2024-08-02 08:24:41', '2024-08-02 08:24:41'),
('d293962b-c0aa-4a64-ae0e-71d47f1ee41a', 'KEDINASAN 1', 'KEDINASAN 1', 1, 1, '2024-08-02 08:24:16', '2024-08-02 08:24:22'),
('d48df278-bfb9-4956-86b5-caff718d5efa', 'BIMBEL 3', 'BIMBEL 3', 0, 1, '2024-08-02 08:23:47', '2024-08-02 08:23:47'),
('e72a9bc2-aaf7-4665-b692-68233706316d', 'BIMBEL 1', 'BIMBEL 1', 0, 1, '2024-08-02 08:23:31', '2024-08-02 08:23:31'),
('f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', 'BIMBEL 4', 'BIMBEL 4', 0, 1, '2024-08-02 08:23:55', '2024-08-02 08:23:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentars`
--

CREATE TABLE `komentars` (
  `id` char(36) NOT NULL,
  `berita_id` char(36) NOT NULL,
  `nama_komentator` varchar(255) NOT NULL,
  `isi_komentar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` char(36) NOT NULL,
  `namaMataPelajaran` varchar(255) NOT NULL,
  `kode_mapel` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `opsi_test_tps` tinyint(1) NOT NULL DEFAULT 0,
  `opsi_kedinasan` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `namaMataPelajaran`, `kode_mapel`, `status`, `opsi_test_tps`, `opsi_kedinasan`, `created_at`, `updated_at`) VALUES
('0ba1c675-b081-4175-9f09-773e4dc51ed3', 'Pemahaman Bacaan dan Menulis', 'pbm', 'Aktif', 1, 0, '2024-07-17 10:02:26', '2024-08-02 02:58:31'),
('1ceed2bc-0fa4-4a08-9cb6-8d2d4e36675a', 'LITERASI BAHASA INDONESIA', 'bindo', 'Aktif', 0, 0, '2024-07-17 10:01:48', '2024-08-01 23:33:27'),
('462d7204-80b5-4f40-8ead-69a411a99668', 'LITERASI BAHASA INGGRIS', 'bing', 'Aktif', 0, 0, '2024-07-17 10:01:53', '2024-08-01 23:33:51'),
('47a487cb-d6bf-4cf2-8b85-af427e37b64a', 'Pengetahuan Umum', 'pu', 'Aktif', 1, 0, '2024-07-17 10:02:03', '2024-08-02 02:58:05'),
('71731ef6-dca4-44b5-8c67-9d9cdd7f97ca', 'PENALARAN MTK', 'pmtk', 'Aktif', 0, 0, '2024-07-17 10:01:42', '2024-08-01 23:34:24'),
('93e136c7-a3d3-4658-9f18-9c54ca8a4e20', 'Pengetahuan Kuantitatif', 'pk', 'Aktif', 1, 0, '2024-07-17 10:02:11', '2024-08-02 02:58:15'),
('a0e9d872-5b7c-4d41-ac17-fa6eab6aca1e', 'TES WAWASAN KEBANGSAAN', 'twk', 'Aktif', 0, 1, '2024-08-01 20:29:29', '2024-08-02 02:59:28'),
('c13c08a5-66db-48a5-9e13-24e0048496a1', 'TES KARAKTERISTIK PRIBADI', 'tkp', 'Aktif', 0, 1, '2024-08-01 23:37:46', '2024-08-02 02:59:41'),
('f1272bd5-4d6f-4547-8e0c-de379c8682be', 'Pengetahuan dan Pemahaman Umum', 'ppu', 'Aktif', 1, 0, '2024-07-17 10:02:18', '2024-08-02 02:58:24'),
('f1ca0302-3765-491b-9c02-4d8e96aa8aec', 'TES INTELEGENSI UMUM', 'tiu', 'Aktif', 0, 1, '2024-08-01 23:37:10', '2024-08-02 02:59:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_14_053009_add_username_to_users_table', 2),
(5, '2024_07_14_053214_create_admins_table', 3),
(6, '2024_07_15_061649_create_mata_pelajarans_table', 4),
(7, '2024_07_15_123415_create_gurus_table', 5),
(8, '2024_07_16_005741_modify_columns_nullable_in_gurus_table', 6),
(9, '2024_07_16_012748_create_kelas_table', 6),
(10, '2024_07_16_024747_create_program_bimbels_table', 6),
(11, '2024_07_16_025909_modify_icon_program_nullable_in_program_bimbels_table', 6),
(12, '2024_07_16_031744_create_siswas_table', 6),
(13, '2024_07_16_033059_add_foto_siswa_to_siswas_table', 6),
(14, '2024_07_16_034831_make_siswa_columns_nullable', 6),
(15, '2024_07_16_035538_create_tahun_pelajarans_table', 6),
(16, '2024_07_16_053956_create_tryouts_table', 6),
(17, '2024_07_16_060317_create_nilais_table', 6),
(18, '2024_07_18_014717_add_password_to_gurus_table', 7),
(19, '2024_07_18_020815_create_absensi_gurus_table', 8),
(20, '2024_07_19_073428_add_foto_sampul_to_gurus_table', 9),
(21, '2024_07_19_095454_create_absensis_table', 9),
(22, '2024_07_19_141220_remove_materi_from_absensis_table', 10),
(23, '2024_07_19_142530_add_timestamps_to_absensi_details_table', 11),
(24, '2024_07_22_165602_add_opsi_test_tps_to_mata_pelajarans_table', 12),
(25, '2024_07_22_185956_add_tanggal_to_tryouts_table', 13),
(26, '2024_07_22_192112_create_sertifikat_tryouts_table', 14),
(27, '2024_07_22_193811_add_tryout_id_to_sertifikat_tryouts_table', 15),
(28, '2024_07_23_155858_create_alumnis_table', 16),
(29, '2024_07_23_161124_create_jenis_perguruan_tinggis_table', 17),
(30, '2024_07_23_161944_modify_jenis_perguruan_tinggi_column_in_alumnis_table', 18),
(31, '2024_07_23_171719_create_testimonials_table', 19),
(32, '2024_07_23_173353_create_kategori_beritas_table', 20),
(33, '2024_07_23_174211_create_beritas_table', 21),
(34, '2024_07_23_180235_create_komentars_table', 22),
(35, '2024_07_23_181212_create_tanggapan_komentars_table', 23),
(36, '2024_07_24_105119_add_foto_to_admins_table', 24),
(37, '2024_07_24_142406_add_motto_to_gurus_table', 25),
(38, '2024_07_26_152546_add_kode_mapel_to_mata_pelajarans_table', 26),
(39, '2024_07_27_102737_create_sertifikat_perkembangans_table', 26),
(40, '2024_07_27_110646_create_setting_sertifikat_table', 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilais`
--

CREATE TABLE `nilais` (
  `id` char(36) NOT NULL,
  `tryout_id` char(36) NOT NULL,
  `mata_pelajaran_id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `nilai` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_bimbels`
--

CREATE TABLE `program_bimbels` (
  `id` char(36) NOT NULL,
  `nama_program` varchar(255) NOT NULL,
  `deskripsi_program` text NOT NULL,
  `icon_program` varchar(255) DEFAULT NULL,
  `status_bimbel_kedinasan` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_bimbels`
--

INSERT INTO `program_bimbels` (`id`, `nama_program`, `deskripsi_program`, `icon_program`, `status_bimbel_kedinasan`, `status`, `created_at`, `updated_at`) VALUES
('0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Program UTBK Dan Kedinasan', 'Program UTBK Dan Kedinasan', NULL, 0, 1, '2024-08-02 08:22:37', '2024-08-02 08:22:37'),
('3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Program Kedinasan', 'Program Kedinasan', NULL, 0, 1, '2024-08-02 08:22:43', '2024-08-02 08:22:43'),
('5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Program UTBK', 'Program UTBK', NULL, 0, 1, '2024-08-02 08:22:49', '2024-08-02 08:22:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_perkembangans`
--

CREATE TABLE `sertifikat_perkembangans` (
  `id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `no_sertifikat` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sertifikat_perkembangans`
--

INSERT INTO `sertifikat_perkembangans` (`id`, `siswa_id`, `no_sertifikat`, `status`, `created_at`, `updated_at`) VALUES
('9cabba23-605f-400b-aa8b-421e0ba488b8', '9cabb673-9091-414e-a91c-f33d7315384f', 'QCOUDQRUNA', 1, '2024-08-02 08:49:22', '2024-08-02 08:49:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_tryouts`
--

CREATE TABLE `sertifikat_tryouts` (
  `id` char(36) NOT NULL,
  `siswa_id` char(36) NOT NULL,
  `no_sertifikat` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tryout_id` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yqvesEQkQ01ThRXqKihDYyofWAEaDyFLdvw1UtTy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1RZQWcybFZvTk9YR2h5NEFqN3hlMEtJMjBEczUyUWlXS1dzN0xWYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722764115),
('zUoAPz8bCgB2h0oljlnuJIpxmSwVKqlbxLBNohqu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQWFiUmZlT1lvSHlaNnl6aXlVSEJha0dPZTJyOWpnNDd3MExSUTFxbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1722746825);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_sertifikats`
--

CREATE TABLE `setting_sertifikats` (
  `id` char(36) NOT NULL,
  `nama_template` varchar(255) DEFAULT NULL,
  `logo_1` varchar(255) DEFAULT NULL,
  `logo_2` varchar(255) DEFAULT NULL,
  `watermark` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting_sertifikats`
--

INSERT INTO `setting_sertifikats` (`id`, `nama_template`, `logo_1`, `logo_2`, `watermark`, `status`, `created_at`, `updated_at`) VALUES
('892c9a3c-4b49-44d0-afd3-9eb0d1b8429e', 'set1', 'settings/pEwMvDhcctsj1DYaJavsmAQ36Q0sEaje13vw5Zkr.png', NULL, 'settings/d3c7VXehkJcvaFZpt29eBZ0yglewXFRullpruFcz.png', 1, '2024-07-28 22:46:16', '2024-07-28 22:46:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` char(36) NOT NULL,
  `kelas_id` char(36) NOT NULL,
  `program_bimbel_id` char(36) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmpt_lahir` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `nis` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `kelas_id`, `program_bimbel_id`, `nama_siswa`, `tgl_lahir`, `tmpt_lahir`, `no_hp`, `foto_siswa`, `nis`, `password`, `status`, `created_at`, `updated_at`) VALUES
('9cabb648-b3c6-4bf0-8c3d-f22ef33de934', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Ahmad Khadavi Cody', '2007-04-10', 'PALEMBANG', '081278179060', 'foto_siswa/R1.JPG', 22008, '$2y$12$IYzPr545sN92GsXRyHzDJO6DV4TEtW9Dec2qcq4P6/SmnXiXH05Ua', 1, '2024-08-02 08:38:35', '2024-08-02 08:38:35'),
('9cabb649-3045-43bf-a367-70fae187fb16', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Ahmad Fakhrial Aziiz', '2007-08-02', 'KALIREJO', '081379402227', 'foto_siswa/TKWwNdreX1Yiu9WVIHgmOULLblihzzuwwn4bwvzq.jpg', 2200712, '$2y$12$GGkVAQTRarGszm8CE9fEd.6.dYMnraICxPaYXtoZYVYL8bfZPVnh6', 1, '2024-08-02 08:38:35', '2024-08-03 17:56:58'),
('9cabb649-abd5-4e2c-93ab-3a4e155ede7c', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Ahmad Raihan', '2006-04-27', 'KOTA AGUNG', '085208832777', 'foto_siswa/R2.JPG', 22009, '$2y$12$xqw5sCrEwO9U9TYSnI8Q5.2qZP92WSn/DZWhNJkR1.b/IcN9CrORC', 1, '2024-08-02 08:38:36', '2024-08-02 08:38:36'),
('9cabb64a-2596-4f07-a55b-818da7bbf4e8', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Bagus Erlangga Mahyudi', '2006-12-18', 'BUKIT KEMUNING', '085266611318', 'foto_siswa/R3.JPG', 22023, '$2y$12$RQvXmgE9GhY230y3I8UvwudeEPgVL18VCJHdwmktPPr0vMAt76XkC', 1, '2024-08-02 08:38:36', '2024-08-02 08:38:36'),
('9cabb64a-9fd5-43c9-bde7-fbd528f9503e', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Erino Ibnu Zhafran', '2007-03-29', 'TANJUNG BINTANG', NULL, 'foto_siswa/F4.JPG', 22032, '$2y$12$QlvFW8b8ML..g6./MdzGlOLqiexq5MZdXiimbCERdYiVkdWI4O7Ou', 1, '2024-08-02 08:38:36', '2024-08-02 08:38:36'),
('9cabb64b-1b1d-4c3c-9ea4-8c412379856b', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Faisal Yusuf Qordhowi', '2006-09-14', 'WONOKRIYO', '085378054416', 'foto_siswa/R4.JPG', 22034, '$2y$12$QCzXKwHAjeCTxPFUiKxhduG4EEpvBjRC.ZPbU23GEGt44LWk6abbq', 1, '2024-08-02 08:38:37', '2024-08-02 08:38:37'),
('9cabb64b-9577-494f-b0a8-d635d3cafd79', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Hafidzon Galih Pratama', '2007-02-06', 'TULANG BAWANG', '081272768989', 'foto_siswa/R5.JPG', 22042, '$2y$12$itkt7I0BK7lw2Y3KFd34d.MXOW84YabDQzdTO1/lgKn0I2XQUuCLS', 1, '2024-08-02 08:38:37', '2024-08-02 08:38:37'),
('9cabb64c-0fc5-44a4-8b9a-c6f98599f190', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Juan Rafli Birrulwaalidayn', '2006-12-15', 'PRINGSEWU', '082187430586', 'foto_siswa/R6.JPG', 22049, '$2y$12$785h.ptmaynCHme8L05DnOqOSutuYsa5AC6/3dXFeJLemTcNEmGHa', 1, '2024-08-02 08:38:37', '2024-08-02 08:38:37'),
('9cabb64c-8a8d-46cd-a849-2a46999d4ae7', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'M. Faiz Hibaturrahman', '2007-04-07', 'RUMBIA', '085208286482', 'foto_siswa/R7.JPG', 22056, '$2y$12$2PceyfDGv2tqZA4PljWdyuA9OI.lV3dxOOecdfBcgPJfJofWfIgVG', 1, '2024-08-02 08:38:38', '2024-08-02 08:38:38'),
('9cabb64d-05a0-458b-a15d-c1686d03e614', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'M. Muharam Al Munawar', '2008-01-10', 'PALEMBANG', '0811792571', 'foto_siswa/R8.JPG', 22059, '$2y$12$reJ.1BMwO22qiJwvI4BaM.cKsXKSQ4VCu6eU0RTujOGO1ilE4/jNW', 1, '2024-08-02 08:38:38', '2024-08-02 08:38:38'),
('9cabb64d-8116-4793-9404-d90c566bb4b3', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'M. Rafi Alfarel', '2007-04-12', 'TALANG PADANG', NULL, 'foto_siswa/F5.JPG', 22060, '$2y$12$apc9JZrS8tN8bLFftoiz5ugvVdWapDeiUUzoVTKmp1kTqoctkOGRG', 1, '2024-08-02 08:38:38', '2024-08-02 08:38:38'),
('9cabb64d-fa51-494b-8e44-92ca552e51ff', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Muhamad Rocky Ridwansyah', '2007-07-25', 'BOGOR', '081282139878', 'foto_siswa/R9.JPG', 22065, '$2y$12$VBITzn85r8WKvyojaU7.Ae3W3NhYcqbamofvpzT6gHWdc.pqVDHqO', 1, '2024-08-02 08:38:39', '2024-08-02 08:38:39'),
('9cabb64e-73da-4a80-80db-b5b4b00dcfdc', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Muhammad Fachry Azka', '2007-12-29', 'KOTA BUMI', '085366993560', 'foto_siswa/R10.JPG', 22070, '$2y$12$U3VQDsrQ8Q5eTnspyTuZiOtxLi/gNXL.gP9VkAvJEK8wRuHLoNGZK', 1, '2024-08-02 08:38:39', '2024-08-02 08:38:39'),
('9cabb64e-ec23-4925-8c53-ebb7f11f696f', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Muhammad Fadhil Antarun', '2007-12-24', 'TANJUNG KARANG', '081379141403', 'foto_siswa/R11.JPG', 22071, '$2y$12$6JchCCZpGS.TQXS2qQHFR.IHsOTK.llcwYxFUVo1MZR4qLOOnNEo6', 1, '2024-08-02 08:38:39', '2024-08-02 08:38:39'),
('9cabb64f-678a-48f7-ab91-22e830f922e0', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Muhammad Ibnu Habibi', '2007-04-17', 'GISTING', '081369113693', 'foto_siswa/R12.JPG', 22077, '$2y$12$Rjqh3RUu9jk0ccF1jYUzs.GyVZtaZpjLZx666BNvlVQKe4z2Pcu72', 1, '2024-08-02 08:38:39', '2024-08-02 08:38:39'),
('9cabb64f-e760-430a-a9ba-8b5661ef08ae', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Muhammad Rafid Dzakwan', '2007-03-04', 'TANJUNG KARANG', '08127970303', 'foto_siswa/R13.JPG', 22079, '$2y$12$ZD7asfgiPPTV/QNokEayo.qOpIUmW0VIeu./FcNevZMELxy3jBJiW', 1, '2024-08-02 08:38:40', '2024-08-02 08:38:40'),
('9cabb650-644b-48e5-80dc-8bb4d0a35e4e', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Nabill Havitz Al-Ayubi', '2006-09-03', 'TANJUNG SARI', NULL, 'foto_siswa/R14.JPG', 22085, '$2y$12$bw69CYaSu57JMx1iI0tHaukD3VgXK.2AaTlPqSBv6xYBLftRgBtPC', 1, '2024-08-02 08:38:40', '2024-08-02 08:38:40'),
('9cabb650-dee7-437b-9ee6-2c6f9da8cb92', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Najwan Jundulloh', '2007-02-18', 'DEPOK', '085378664113', 'foto_siswa/R15.JPG', 22088, '$2y$12$TLUPphY7G04yu2eZ03Ss/.EYAqG.vhgr0C46DR48zviBbNUmdzT6O', 1, '2024-08-02 08:38:40', '2024-08-02 08:38:40'),
('9cabb651-57ea-4662-8641-bac4823de086', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Reifki Wardana', '2007-06-30', 'AMBARAWA', '085809298325', 'foto_siswa/F8.JPG', 22103, '$2y$12$c2ZuIXbhHHtAgGJXfzsufu1lKMClAo7g2XXPBSMdYyDtMcCQD52de', 1, '2024-08-02 08:38:41', '2024-08-02 08:38:41'),
('9cabb651-d169-4fef-bb0f-07aaed118f4f', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Revaldo Rudiannanda', '2007-07-26', 'BANGUNAN KEC. PALAS', '08979085771', 'foto_siswa/R17.JPG', 22104, '$2y$12$Np02zfyeN5SUcd2rkbQ3A.bdZ88whU7Kgzbpx2h2sLGNCabKrVCii', 1, '2024-08-02 08:38:41', '2024-08-02 08:38:41'),
('9cabb652-4a92-4ca5-93a3-5fb89a6a6fea', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Syaikhul Akbar', '2007-10-26', 'PRINGSEWU', '085269030465', 'foto_siswa/R18.JPG', 22114, '$2y$12$25GCbMOoWOMtzdhv2JluQOOY9wsvHi7dURyQyg.IR0q2xrco4IBYq', 1, '2024-08-02 08:38:41', '2024-08-02 08:38:41'),
('9cabb652-c3c1-4d42-b517-c419302a7e27', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Aditya Surya Pratama', '2007-01-05', 'BANDAR LAMPUNG', '082184613818', 'foto_siswa/F9.JPG', 22003, '$2y$12$crKZ8mV9jNfKQ1coCikR..QM5wtDsFk6bB9Lluiu41lLzgaX2tH.m', 1, '2024-08-02 08:38:42', '2024-08-02 08:38:42'),
('9cabb653-3d1a-4595-a20f-a32d014d48de', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Dimas Abi Wibowo', '2007-05-21', 'PRINGSEWU', '081369611113', 'foto_siswa/R19.JPG', 22028, '$2y$12$3zKDtbll8tF0HUn0lLbeo.ZXdveBhfLj0QZgxtyb0p6EEllojoZ8C', 1, '2024-08-02 08:38:42', '2024-08-02 08:38:42'),
('9cabb653-b71f-4593-8ce8-ff5f7f702f5a', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Hatta Marwa Bakti', '2007-08-17', 'SUKOHARJO IV', '081379740770', 'foto_siswa/R20.JPG', 22045, '$2y$12$OJF7O241VtQnEvtB7alj/.kLAHdrQN2VzpCVVcAUwD2RGgMtV0l1q', 1, '2024-08-02 08:38:42', '2024-08-02 08:38:42'),
('9cabb654-3095-4076-973d-b7c8b3c44381', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Muhammad Ammar Ashari', '2006-12-29', 'GISTING', '085366064448', 'foto_siswa/R21.JPG', 22066, '$2y$12$nkh0YHZWp532B9hgFuShuONAy/vs4IpZB1rDbux4DN8gSzD3JcyS2', 1, '2024-08-02 08:38:43', '2024-08-02 08:38:43'),
('9cabb654-a9ae-48be-a86d-306205c015fe', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Muhammad Hafizh Fadhilah', '2006-06-15', 'WARINGIN SARI BARAT', '085269534350', 'foto_siswa/F11.JPG', 22074, '$2y$12$pnlVSks1/l79Ssgv8K4S4ObiN8lP8TRIi62zr04SjIYz/vO1pXdnm', 1, '2024-08-02 08:38:43', '2024-08-02 08:38:43'),
('9cabb655-2387-412c-b839-d5f476b77d86', '47b862e3-3bb8-462d-aa5c-f57aa29195f7', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Muhammad Dzaki', '2007-06-27', 'MUARA ENIM', '085268553518', 'foto_siswa/R22.JPG', 22069, '$2y$12$fiRiwt9uk6O9BrI8nH839.vT4Fx1p5F9/n8yMHG91PWpWyV7GZhUS', 1, '2024-08-02 08:38:43', '2024-08-02 08:38:43'),
('9cabb655-9e51-4dab-b314-4c74d0862685', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'M. Haidar Al Faruq', '2006-11-11', 'TANJUNG KARANG', '089626894096', 'foto_siswa/R23.JPG', 22058, '$2y$12$KnapQic9xoFWmbGtoh/jveDhTe/IBW5nTMICdVbOv8psmlu/jMFDW', 1, '2024-08-02 08:38:44', '2024-08-02 08:38:44'),
('9cabb656-17cf-4946-9823-c41d60b9137f', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Muhamad Hafiz Nuril Qolbi', '2007-03-27', 'PRINGSEWU', NULL, 'foto_siswa/R24.JPG', 22075, '$2y$12$8nc061cvSwTWhs8ZMuCQ3uxWY6lBieQvZeCYSxLQHe.lB7DiBMDM2', 1, '2024-08-02 08:38:44', '2024-08-02 08:38:44'),
('9cabb656-91c1-47e8-a6a5-f9d65d143ac0', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Mumtaz Ibadurrahman Ats Tsalits', '2007-04-10', 'BANDAR LAMPUNG', '089653350194', 'foto_siswa/F13.JPG', 22082, '$2y$12$t8UhSOzuBts1yhd.1ebyRug40Kbv8wyTkFcfPiNA07QATV8bquTRi', 1, '2024-08-02 08:38:44', '2024-08-02 08:38:44'),
('9cabb657-0d5c-44fb-a777-f50724449723', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Raihan Afreza Ramadhan', '2006-10-09', 'TAMAN BOGO', '085357597377', 'foto_siswa/F14.JPG', 22099, '$2y$12$wWgihIH5gu5jyOnzTHFlDO3g6VIEUH0PJ/iFgS.Czp2FA0zLjwX46', 1, '2024-08-02 08:38:44', '2024-08-02 08:38:44'),
('9cabb657-874b-4e38-873e-5e6af9b44f3f', 'e72a9bc2-aaf7-4665-b692-68233706316d', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Reza Rizqian Irsyad', '2007-03-02', 'AIR BAKOMAN', '085357587456', 'foto_siswa/R26.JPG', 22105, '$2y$12$WIEkNscEF992paFhywgJ/uF.0/P86YITKJmpNQ4kZ.52k.Ki9GEpq', 1, '2024-08-02 08:38:45', '2024-08-02 08:38:45'),
('9cabb658-0178-49a7-a8ea-90307ef5bd9d', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Tahta Yudhistira', '2007-10-15', 'SERANG', '081315902901', 'foto_siswa/F15.JPG', 22117, '$2y$12$YGMBFARfPYwfkM2CUJtqqOMmVcq18UedE/BcPAkkgWdJqHKVUpVyG', 1, '2024-08-02 08:38:45', '2024-08-02 08:38:45'),
('9cabb658-7c8d-4d3a-a0f5-be2a75521072', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Afifah Daniyah Syamila', '2007-04-25', 'BANDAR LAMPUNG', '088290714108', 'foto_siswa/R27.JPG', 22005, '$2y$12$AjLwbLBbAn/3u.hY3hsq/ewlAjSAGpw0Dk6w8PdF1xwuiN/eV7IdS', 1, '2024-08-02 08:38:45', '2024-08-02 08:38:45'),
('9cabb658-f455-4b16-a33d-e64ddd05bd2d', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Alyaa Rosyaadah', '2007-04-17', 'BUMI DIPASENA', '082182714120', 'foto_siswa/R28.JPG', 22013, '$2y$12$8NN8wtd7X7stUD6giN6mxujpWLA9aZxKB2ru.qQqzdQZfaVJVbam.', 1, '2024-08-02 08:38:46', '2024-08-02 08:38:46'),
('9cabb659-6de1-482f-92f0-3d6937182f8f', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Amanda Asfa Awliyawati', '2007-02-18', 'KOTABUMI', '082376461917', 'foto_siswa/R29.JPG', 22014, '$2y$12$czkEc1ekGKg0N7Bj0Tq4Wus2UTkFiy.zmEthUf7GGnfBPhGRWJHOe', 1, '2024-08-02 08:38:46', '2024-08-02 08:38:46'),
('9cabb659-e598-49a8-be15-71a228caea23', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Azarine Zuleika Syah', '2007-01-16', 'BANDARLAMPUNG', '082178870002', 'foto_siswa/R30.JPG', 22020, '$2y$12$QWKXfqaiNE96i.f3IwtKPOxzCou6PkRqD4y/dku16WEGYquvno1j.', 1, '2024-08-02 08:38:46', '2024-08-02 08:38:46'),
('9cabb65a-5f6e-4ec7-8ec4-e978e4e124fc', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Chairunnisa Putri Andira', '2007-11-17', 'WAY KANAN', '082376791001', 'foto_siswa/R31.JPG', 22025, '$2y$12$u2xw0ANDQ3rlTTdrd0QNOOySURis5E16W0ex9j7mJwcbnLOtOwdCe', 1, '2024-08-02 08:38:47', '2024-08-02 08:38:47'),
('9cabb65a-da82-43ea-b010-7e9a53bf8fde', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Emylia Putri', '2007-05-22', 'Jakarta', '085368384471', 'foto_siswa/R32.JPG', 22031, '$2y$12$/tx5biRLpa9zCVDLXSM6JumZfEYceD7A549AixVVO.fX5KgWMEMhS', 1, '2024-08-02 08:38:47', '2024-08-02 08:38:47'),
('9cabb65b-5548-4a36-b58e-064bd9400363', '55f0c807-6b7e-4076-8184-e0f705ed0123', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Fherischa Oktaviana Putri', '2007-10-10', 'GISTING', '082280566466', 'foto_siswa/F16.JPG', 22038, '$2y$12$sGjBnjCP9xo9x1AvKd4L4.7kJ01.uzxuXkQWgsLQOfuP.hhKCcUEO', 1, '2024-08-02 08:38:47', '2024-08-02 08:38:47'),
('9cabb65b-d10a-4df1-b115-79393aba349a', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Ghefira Afifah Az Zahra', '2007-12-10', 'RUMBIA', '085383105949', 'foto_siswa/R33.JPG', 22041, '$2y$12$OKzRknbjg.lxKN1S.nuTluLdaqiBZ/ew05bKenF.f6j1iE/nsfQt2', 1, '2024-08-02 08:38:48', '2024-08-02 08:38:48'),
('9cabb65c-5158-4c6c-bf44-3ba00f19c3cf', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Keyzia Alya Mukthabita', '2007-02-02', 'BANDAR LAMPUNG', '085279337500', 'foto_siswa/R34.JPG', 22052, '$2y$12$5oIJA4TpscBiCFmXQoHQQeYnV7XUv/OPmL11AH0euiNekTOcY.GxS', 1, '2024-08-02 08:38:48', '2024-08-02 08:38:48'),
('9cabb65c-cba0-4d61-a994-be400c0d073d', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Mazia Asma Humaida', '2006-05-20', 'BANDAR LAMPUNG', '085376033302', 'foto_siswa/R35.JPG', 22062, '$2y$12$/6VecfHxpvyybQM81fK0w.tuvN90hBWGd6vVG1/kqM9GqXRVb3FDG', 1, '2024-08-02 08:38:48', '2024-08-02 08:38:48'),
('9cabb65d-4622-4345-9618-8d30a33fe736', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Nashita Aynara', '2007-12-19', 'TANGERANG', '081273412313', 'foto_siswa/R36.JPG', 22089, '$2y$12$isJb2Q2rCDZ4iInsw2wFXu8uhQWfxFjKDJWf....bbfywHto9VWPy', 1, '2024-08-02 08:38:49', '2024-08-02 08:38:49'),
('9cabb65d-c007-46f6-b9f1-d424fbf3fe7c', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Naysilla Keyzha Aurelly', '2007-05-09', 'GISTING', '085267912781', 'foto_siswa/R37.JPG', 22092, '$2y$12$OSzIJLOqkwr.ytq49xvF7edlVXMZhLZEagM7eGRybR6tNwo0wZ/6i', 1, '2024-08-02 08:38:49', '2024-08-02 08:38:49'),
('9cabb65e-3b60-4aec-94b9-2b4b62a9d298', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Pinkan Shepianti Ivanka', '2006-09-29', 'GISTING', '082122734454', 'foto_siswa/R38.JPG', 22095, '$2y$12$yAZPrZjvs0VFI5sfprKIM.0EkTGXgbTvKNwVLEjIGGcBBs87S2QfS', 1, '2024-08-02 08:38:49', '2024-08-02 08:38:49'),
('9cabb65e-b5cc-4ddd-9df6-7c5de64b81e8', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Rahadatul \'Aisyi', '2007-01-13', 'PRINGSEWU', '08127243146', 'foto_siswa/R39.JPG', 22098, '$2y$12$NLwX1QKctK.6S7rduP0gTeG1Eu5vNmxYSQ2mkivpHtKmSHU2aLUvS', 1, '2024-08-02 08:38:50', '2024-08-02 08:38:50'),
('9cabb65f-2e91-4e19-87b5-e001fca5bf55', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Roro Ajeng Cahyani', '2007-08-26', 'PRINGSEWU', '082176670661', 'foto_siswa/R40.JPG', 22107, '$2y$12$RWtz3JCTK.Xrm5xSfgqy8OxcnbRVLw6mqdyCRswrEI0nTBE9SYsd6', 1, '2024-08-02 08:38:50', '2024-08-02 08:38:50'),
('9cabb65f-a7aa-4940-984c-b01600fb6975', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Salsabila Rahma Zavi', '2007-02-23', 'GISTING', '085798028026', 'foto_siswa/R41.JPG', 22109, '$2y$12$3YJ0iIQHBUgyauo5MH852ebzEgw2n4i.rGZ0kF8Xq2npQvdsHO1wm', 1, '2024-08-02 08:38:50', '2024-08-02 08:38:50'),
('9cabb660-2051-4f1e-9f9b-931b7d65179a', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Satin Ainani', '2006-10-18', 'TALANGPADANG', '086902324389', 'foto_siswa/R42.JPG', 22112, '$2y$12$mYqpOQFFVyrqKXJEpV.7tO6nA5YoED0Cw1T4Bf.Ic/RWCbNYlXgPC', 1, '2024-08-02 08:38:50', '2024-08-02 08:38:50'),
('9cabb660-9b82-4f6b-b4ef-e0527efe9284', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Zafira Al Zahwa', '2007-10-19', 'PALEMBANG', '082177970759', 'foto_siswa/R43.JPG', 22123, '$2y$12$x9tOuWyfqjwn4AS/1M61DO/kLHngN68ALfhWHkogZWBnFMGY1mxe2', 1, '2024-08-02 08:38:51', '2024-08-02 08:38:51'),
('9cabb661-15d6-476e-892a-bee6c1c9e389', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Zaqia Ranisa Sukma', '2006-12-19', 'GISTING', '085267783440', 'foto_siswa/R44.JPG', 22126, '$2y$12$s9/rmxk7Ro0kBMdd6uiVSeeHb/Ujib2NFxOroLcCSabnMwae2B7RO', 1, '2024-08-02 08:38:51', '2024-08-02 08:38:51'),
('9cabb661-8ef4-4d7f-a435-398ccb352176', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Agies Melsya Rahmadani', '2006-10-16', 'GISTING', '082372763157', 'foto_siswa/R45.JPG', 22006, '$2y$12$lN803K5acB4Gy4IBNiX0MugCFR4pV9GqCkWBAm2dQN37CIljrfhYi', 1, '2024-08-02 08:38:51', '2024-08-02 08:38:51'),
('9cabb662-09fd-44ed-ae2e-df8fa9bd622e', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Ajeng Dwi Prameswari', '2007-06-15', 'KOTABUMI', '082372326671', 'foto_siswa/R46.JPG', 22010, '$2y$12$NKEXaQ2WnvR1EXQhoG0sCeYJ8pPSXQAFLb56aAy11eiu4izia6FiS', 1, '2024-08-02 08:38:52', '2024-08-02 08:38:52'),
('9cabb662-82ce-4a42-845d-16c66b0ebe8f', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Amirah Labibah Alhusna', '2007-07-24', 'BANDAR LAMPUNG', '085383739050', 'foto_siswa/R47.JPG', 22015, '$2y$12$h.VDBUQUynxwBRuyi0DZfuocESI2.QTH.SyO4.B6A06sYnpDRpkoC', 1, '2024-08-02 08:38:52', '2024-08-02 08:38:52'),
('9cabb662-ff32-4ef6-b965-4af9c7699a34', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Amrina Cannesya', '2007-12-30', 'TANJUNG BETUAH', '081288472233', 'foto_siswa/R48.JPG', 22016, '$2y$12$sNrsD23ANwX52Y/XGGlQGuHhNwDXo5nfj06v7BrMI4h40EL6CqhsS', 1, '2024-08-02 08:38:52', '2024-08-02 08:38:52'),
('9cabb663-77f6-4feb-bbf5-5de3ceb9c03c', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Cindy Rabilia Prasasti', '2007-07-01', 'PAGELARAN', '081213108376', 'foto_siswa/R49.JPG', 22026, '$2y$12$VdQkyV8I/OszN8qrNP1fEuxUppEP4ZGvNzcvCTQMVOB3/W1.QoLCm', 1, '2024-08-02 08:38:53', '2024-08-02 08:38:53'),
('9cabb663-effb-48c4-b802-a3b96e0dd294', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Fazhra Batrisyia Al Hadi', '2006-10-13', 'GEDONG TATAAN', '089632710202', 'foto_siswa/R50.JPG', 22037, '$2y$12$pU1OI0v9R3wOlhNBkkTe6u60PfGrifw5QLh8cOlveDRLtRo5D8h0u', 1, '2024-08-02 08:38:53', '2024-08-02 08:38:53'),
('9cabb664-6a25-4c89-9331-bb3a4c8ccfde', '55f0c807-6b7e-4076-8184-e0f705ed0123', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Hana Najla Mufidah', '2006-09-09', 'KOTA BUMI', '081369686095', 'foto_siswa/F17.JPG', 22043, '$2y$12$FgV9yq6QBXAQV8PBSy7ATexkYmHvw1Hgyozkls1Wlcldrf5sreK8a', 1, '2024-08-02 08:38:53', '2024-08-02 08:38:53'),
('9cabb664-e31d-4b66-a2d5-b75e14748b18', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Kayla Althafunnisa', '2008-03-09', 'BUKIT TINGGI', '081214598115', 'foto_siswa/R51.JPG', 22050, '$2y$12$EryUsvaVA/oN5w920yesHOxujZI1wkLNlzQpcoOLq4qMPoCCyv5GG', 1, '2024-08-02 08:38:54', '2024-08-02 08:38:54'),
('9cabb665-5a49-4354-acb7-c236c3c41d4f', '55f0c807-6b7e-4076-8184-e0f705ed0123', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Khoirun Nisa Rahman', '2007-05-14', 'LIWA', '082183200976', 'foto_siswa/F18.JPG', 22053, '$2y$12$C/FdlErxs9rmdJCATqzhGu7eDvCMAedJZ7hOA02C0SBNeiQrxUrcG', 1, '2024-08-02 08:38:54', '2024-08-02 08:38:54'),
('9cabb665-d20a-465c-adc5-bf82b1f99667', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Mufida Afya Rahma', '2007-04-22', 'SIDOMULYO', '085267994035', 'foto_siswa/R52.JPG', 22063, '$2y$12$DkSJ4MmCG3Q.OH5uIRqsXuTa/7/C9bnZlffliOhJ/4m1tBo8dwb2C', 1, '2024-08-02 08:38:54', '2024-08-02 08:38:54'),
('9cabb666-4a69-4990-b7d1-3324ca46ef7c', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Naura Nadya Shofi', '2007-11-28', 'KOTABUMI', '082282817658', 'foto_siswa/R53.JPG', 22090, '$2y$12$3QHfKMxJt2lX1Nqab33tNuJ0RALj6ExsoFXYUSfi.gBgOMEFeDL4K', 1, '2024-08-02 08:38:54', '2024-08-02 08:38:54'),
('9cabb666-c218-479a-8499-1ffca3c74efa', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Nazwa Ardelia Putri', '2006-10-28', 'TANGGAMUS', '085367115511', 'foto_siswa/R54.JPG', 22093, '$2y$12$yCiIhjSk1GhTWjzJwMNI6u6szK6HCQ/3rQlrKZUZ0yzmTdOoqk7t6', 1, '2024-08-02 08:38:55', '2024-08-02 08:38:55'),
('9cabb667-3c3a-4b4d-b2b3-f6603e6fa9b4', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Putri Amaliatul Husna', '2007-02-03', 'BANDAR SARI', '081935507291', 'foto_siswa/R55.JPG', 22096, '$2y$12$Cvvy0WDhv3yxgzBx9aeS.eK.0K/gSgCrE/ePCnCn015xaLPNB6eD2', 1, '2024-08-02 08:38:55', '2024-08-02 08:38:55'),
('9cabb667-b6fe-4cba-83b8-bfc7e9bffd3f', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Rara Fika Apriliza', '2007-04-16', 'BANDAR SARI', '085789486896', 'foto_siswa/R56.JPG', 22101, '$2y$12$pRn8kqqvZLruMyfovKD7Q.U0GEFmXPlfDh5MbRz5PZ8M6IbF6adSu', 1, '2024-08-02 08:38:55', '2024-08-02 08:38:55'),
('9cabb668-2ffe-4c85-82d3-65cb2a3b4965', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Ribbi Fayyaza', '2007-11-30', 'PARDASUKA', NULL, 'foto_siswa/F19.JPG', 22106, '$2y$12$8U2/hY2vfG5Wu0GPUeESY.W538DWrdwr4NU67ggz8CiheWLYvOvl.', 1, '2024-08-02 08:38:56', '2024-08-02 08:38:56'),
('9cabb668-a8cf-43f3-bdff-695a9a7d97a3', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Salsabila Ramadhaniyah', '2006-10-06', 'BANDUNG BARU', '085366439433', 'foto_siswa/R57.JPG', 22110, '$2y$12$3kNYL90t2mW1YkVbRLIW7O.xU2l3LfXcRmxinv/wUmUJ/ezIWDI0i', 1, '2024-08-02 08:38:56', '2024-08-02 08:38:56'),
('9cabb669-1fb4-461b-8de6-26772d7665bc', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Syifa Allya Jayanti', '2007-09-27', 'BANDAR LAMPUNG', '08127962584', 'foto_siswa/R58.JPG', 22116, '$2y$12$AMNykp2rK..gmRCGml231OPXY/4fElVg5P.KaUnhpZ8cMTmKHUlba', 1, '2024-08-02 08:38:56', '2024-08-02 08:38:56'),
('9cabb669-97b7-47cc-ac7d-5dc26d6cf19f', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Zuleika Amelia Florean', '2006-11-15', 'KEDATON', '08127254228', 'foto_siswa/R59.JPG', 22127, '$2y$12$GiiqJL5/DGaG3PanRAHyDOLRSykQ.seoFOv6uP86bB6MdE3E.suUu', 1, '2024-08-02 08:38:57', '2024-08-02 08:38:57'),
('9cabb66a-111e-45b3-8a94-9acf05ec4619', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Alya Mukhbita', '2006-07-12', 'TANJUNG KARANG', '0063883569', 'foto_siswa/R60.JPG', 22012, '$2y$12$xRxl5sMBEmcYVT0RrkqaUu2SzSFkWtDrM7o0Z6r3vInnsXZDVoIaG', 1, '2024-08-02 08:38:57', '2024-08-02 08:38:57'),
('9cabb66a-8b26-4e34-b752-4629b6592d8a', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Arsyafida Pahlawanidya Mustika', '2007-04-04', 'PRINGSEWU', '0074796461', 'foto_siswa/R61.JPG', 22018, '$2y$12$OuBf2IvBva0BrYBrRGwt0uf2fEKbgH0WhljcOQPsbxeIwVm4MQnme', 1, '2024-08-02 08:38:57', '2024-08-02 08:38:57'),
('9cabb66b-06f8-436a-a7a9-1ad7e2202e7f', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Assyifa Nurullaili Salsabila', '2007-07-06', 'GISTING', '0073959089', 'foto_siswa/R62.JPG', 22019, '$2y$12$lVLHCYdFEE2/CnSOqJqEIeO.wZ5cYhTHtobd8LuXcZ9GEAmNsRQ6i', 1, '2024-08-02 08:38:58', '2024-08-02 08:38:58'),
('9cabb66b-81ff-4807-8350-59666c39cb9c', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Bintang Noerwasqitha', '2007-11-14', 'TEKAD', '0073129131', 'foto_siswa/R63.JPG', 22024, '$2y$12$8c38D/SFn6feZhAZmE5IPOpEnzXgAHm76iO4jA2C2kiq7G/P6BygS', 1, '2024-08-02 08:38:58', '2024-08-02 08:38:58'),
('9cabb66b-fc52-48da-876f-c4ec190b9d05', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Dzikrina Khansa Asy Syahida', '2007-04-26', 'TANGGAMUS', '0075148241', 'foto_siswa/R64.JPG', 22029, '$2y$12$owbBZr39I1EiPwnWddbw6.Y2pkmB59VG7rCfkyefQV62hvwbFoTdi', 1, '2024-08-02 08:38:58', '2024-08-02 08:38:58'),
('9cabb66c-74fd-4de0-9003-f98a3150e686', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Ghaisani Venara Janeeta', '2008-01-07', 'BANDAR LAMPUNG', '0082220169', 'foto_siswa/R65.JPG', 22040, '$2y$12$QMR71LH/nuqUF/9nK0vEguViY04B7/MfgNMSIQhFXcOFTr526UdlS', 1, '2024-08-02 08:38:59', '2024-08-02 08:38:59'),
('9cabb66c-ebdb-460a-804e-f797c2e39dd1', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Hannadia Hafydda', '2006-12-13', 'PRINGSEWU', '0065127414', 'foto_siswa/R66.JPG', 22044, '$2y$12$qozlTq6/qwFCkKj2Iam3H.4UMFbi/DDBk8yqUCju5FyeLMVYUSCAK', 1, '2024-08-02 08:38:59', '2024-08-02 08:38:59'),
('9cabb66d-629e-478e-95ae-f34c5b21d567', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Kayla Oktavia', '2007-10-30', 'PAGELARAN', '0072618576', 'foto_siswa/R67.JPG', 22051, '$2y$12$uvGSPMSumZxcCpldGIWJ2ulgCvdIvzMnaNQc5FVgpS5lD/bhSQhy6', 1, '2024-08-02 08:38:59', '2024-08-02 08:38:59'),
('9cabb66d-da89-4e4d-9e81-7e01d403ab42', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Mutia Bilqist Asror', '2007-08-26', 'SENDANGREJO', '0077974662', 'foto_siswa/R68.JPG', 22083, '$2y$12$A1byHul55o60ByKvX/AfCel2sYcU/PK4MZ7q/lWbAMzYrEQycV7wS', 1, '2024-08-02 08:38:59', '2024-08-02 08:38:59'),
('9cabb66e-5191-4105-834e-c5ec9add1a23', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Nafsa Nazila Qurota A\'yun', '2007-02-19', 'PASAR MULYA KRUI', '0073537983', 'foto_siswa/R69.JPG', 22087, '$2y$12$PtR/oE1POQgFz3yZ8toF3OYHLa5aKSzfUm1Wh0PZtzTSxb5N31gLi', 1, '2024-08-02 08:39:00', '2024-08-02 08:39:00'),
('9cabb66e-c95e-4e8f-9ab7-d7e5ebde17e8', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Nayla Mardhia Rachmani', '2007-01-16', 'BANDAR LAMPUNG', '0075604077', 'foto_siswa/R70.JPG', 22091, '$2y$12$7aO9AfAKbcyTd0c6irOIA..RJhQf/Eg5AtUa29H4zupJMG4ny9QFW', 1, '2024-08-02 08:39:00', '2024-08-02 08:39:00'),
('9cabb66f-427b-4b89-b906-691c0a81fe26', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Oryza Kinanti Aditia', '2007-12-07', 'WAY KANAN', '0074035927', 'foto_siswa/R71.JPG', 22094, '$2y$12$gFvsqHC37H3a5UZTlQHrZeyMUp4niJCDf1fNqQaS1Sx.sxnPHGIFG', 1, '2024-08-02 08:39:00', '2024-08-02 08:39:00'),
('9cabb66f-bb50-4944-957c-3e9b2aba7f45', '6e0d4a4e-fe7e-4011-bcfd-e6af1d905033', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Qisti Aulia', '2007-03-23', 'PARDASUKA', '0075008695', 'foto_siswa/R72.JPG', 22097, '$2y$12$RVLB4umi07slR8JRlQ3XsuSaBpLjxWhV2oaG0RtElIOrqaQKU4yPW', 1, '2024-08-02 08:39:01', '2024-08-02 08:39:01'),
('9cabb670-3697-42cd-818e-fed2d5e42e7a', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Razwa Auryn Dianri', '2007-05-22', 'GISTING', '0074084440', 'foto_siswa/R73.JPG', 22102, '$2y$12$gHGwMB78oxn0OAJFPbJ43e/I6JUj2ajo5uHU1qOyhZyKuvs39x1QW', 1, '2024-08-02 08:39:01', '2024-08-02 08:39:01'),
('9cabb670-b06a-41a4-89f9-50655cf49af3', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Sakinah Farhana Al-Qisthi', '2007-05-09', 'WARGOMULYO', '0073410074', 'foto_siswa/R74.JPG', 22108, '$2y$12$EPXFuP3pVv9yof/EiiCMIOx9rLXPOK75.51vNNHLuPX2eTcDAKzZi', 1, '2024-08-02 08:39:01', '2024-08-02 08:39:01'),
('9cabb671-2a9e-4d7d-9246-1925c6385ea6', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Shidqia Husna Azzahra', '2007-05-15', 'METRO', '0076581850', 'foto_siswa/R75.JPG', 22113, '$2y$12$S0Bnc95jfQ8X/1DQMv2W0OTKMONxsyZwR7ot/TwwngVEu7IRB.G9C', 1, '2024-08-02 08:39:02', '2024-08-02 08:39:02'),
('9cabb671-a67c-48fd-9e40-4fc3b832368c', 'f069a8f8-a69e-4d65-bcec-d8b21b7c3bf1', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Tasya Wulandari', '2007-04-09', 'KOTABUMI', '0077300544', 'foto_siswa/R76.JPG', 22118, '$2y$12$6W7AqZ5K6tOJ/iV4a/04AOwpTHTfxOfLo.Boxw1hYPxGigiIZOX3W', 1, '2024-08-02 08:39:02', '2024-08-02 08:39:02'),
('9cabb672-223e-41a8-b7d1-912ddcff9e51', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Yuliana Putri Rahmawati', '2007-07-24', 'BANDAR LAMPUNG', '0074065888', 'foto_siswa/R77.JPG', 22122, '$2y$12$Ixjppc.TaWj8mHUsDFmBqOSptyw/apPFUJ3MX1jcZpYaPWdUwenKy', 1, '2024-08-02 08:39:02', '2024-08-02 08:39:02'),
('9cabb672-9cee-46dd-bbc2-1ca3a6e94d47', 'd48df278-bfb9-4956-86b5-caff718d5efa', '5d7f24da-4191-4dc5-b35e-b3181352f4e7', 'Zalva Nurhidayah', '2007-06-09', 'TANGGAMUS', '0074569228', 'foto_siswa/R78.JPG', 22125, '$2y$12$HCge5H9RRrqm8gmxaYJOt.7e/M8cNJe1MBX8gNW2B4QHsnYGsrn8C', 1, '2024-08-02 08:39:03', '2024-08-02 08:39:03'),
('9cabb673-1886-4562-ab42-5ef71df3c82b', 'b9a3bf85-65c2-4a23-aedf-0c8f75d5a420', '0a3c9a02-91b4-4d16-80c4-333c74a8821a', 'Nur Khasanah ', NULL, NULL, NULL, 'foto_siswa/R79.JPG', 22129, '$2y$12$VHvxKS7aAf.MVYGn.PgRMe4RvT5DRseW5vF5S8rM5SJn.DXT8AjBi', 1, '2024-08-02 08:39:03', '2024-08-02 08:39:03'),
('9cabb673-9091-414e-a91c-f33d7315384f', 'd293962b-c0aa-4a64-ae0e-71d47f1ee41a', '3a404cd8-c979-4afe-b449-1f9add4a6b20', 'Muhammad Rakha Fadli', NULL, NULL, NULL, 'foto_siswa/F21.JPG', 22128, '$2y$12$9bpqDf9BjZpQoy0fONHZKuVKqgyln./4jCdDjWQCjQ59UfqzuSIQO', 1, '2024-08-02 08:39:03', '2024-08-02 08:39:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_pelajarans`
--

CREATE TABLE `tahun_pelajarans` (
  `id` char(36) NOT NULL,
  `nama_tahun_pelajaran` varchar(255) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_pelajarans`
--

INSERT INTO `tahun_pelajarans` (`id`, `nama_tahun_pelajaran`, `semester`, `status`, `created_at`, `updated_at`) VALUES
('88ccc4c0-d59c-4409-8808-f14099ddfedb', '2024/2025', '1', 1, '2024-07-24 10:00:54', '2024-07-24 10:00:59'),
('ba5041ef-3f87-4d38-9881-81bd2584e4ae', '2024/2025', '2', 0, '2024-07-24 10:01:08', '2024-07-29 02:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan_komentars`
--

CREATE TABLE `tanggapan_komentars` (
  `id` char(36) NOT NULL,
  `komentar_id` char(36) NOT NULL,
  `author_id` char(36) NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` char(36) NOT NULL,
  `alumni_id` char(36) NOT NULL,
  `rating` int(11) NOT NULL,
  `isi_testimonial` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `alumni_id`, `rating`, `isi_testimonial`, `status`, `created_at`, `updated_at`) VALUES
('0abb4517-5594-4a0e-af3b-4fff0e66d12b', '9ca9c9f3-e8e0-4a1a-a397-4df4ef69f47f', 5, 'Alhamdulillah bersyukur banget bisa dibimbing sama tim lanjut study  imbos hingga saya bisa lolos FKG UMY ternyata bimbel yang saya ikuti selama ini tidak hanya untuk masuk ptn saja sebab saya tes di umy materinya sama dengan tes utbk 90% sama semua penalaran yang saya pelajari dimasa bimbel', 1, '2024-08-01 09:42:14', '2024-08-01 09:42:14'),
('5903354d-ef61-43c5-9e97-f213d74bf9b4', '9ca9a046-025d-4238-9263-4fc5c045186b', 5, 'Program studi lanjut imbos membantu saya dalam memperoleh informasi terkait Perguruan Tinggi Negeri bahkan Kedinasan, kami juga bisa ikut latihan fisik yang disediakan dari program ini, pokoknya mantap', 1, '2024-08-01 09:39:20', '2024-08-01 09:39:20'),
('87ecc7a8-2b9d-44a2-a04f-b70c282a63a3', '9ca9a046-39dc-492f-ae63-479d01385e9e', 5, 'Bimbelnya studi lanjut imbos sangat seru tidak membosankan dan tentornya pun menyesuaikan dengan kemampuan kami sehingga  materi yang diberikan kepada kami dapat kami tangkap dengan baik', 1, '2024-08-01 09:40:07', '2024-08-01 09:40:07'),
('a6f83b92-f50b-4836-a89e-44a9269ccdd9', '9ca9a046-151b-495c-b13a-7a4ac727a78d', 5, 'Bimbel studi lanjut imbos ,sangat menyenangkan, pengajarna selalu bersedia meluangkan waktu jika kami bertanya, soal-soal yag diberikan juga selalu update, kami juga bisa konsultasi terkait jurusan pilihan kita', 1, '2024-08-01 09:39:40', '2024-08-01 09:39:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tryouts`
--

CREATE TABLE `tryouts` (
  `id` char(36) NOT NULL,
  `tahun_pelajaran_id` char(36) NOT NULL,
  `nama_tryout` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tryouts`
--

INSERT INTO `tryouts` (`id`, `tahun_pelajaran_id`, `nama_tryout`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
('183030f9-f09a-46f0-b76e-a72963fb8370', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK 2', NULL, 1, '2024-07-24 10:04:09', '2024-08-02 03:57:48'),
('48c946d4-d98c-423c-bb3d-1d77a98b3a7a', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK DAN SKD 3', NULL, 1, '2024-08-02 03:58:56', '2024-08-02 03:58:56'),
('5350ab80-ef00-4a1b-98ac-64c4b2e45e5d', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT SKD 1', NULL, 1, '2024-07-29 02:43:00', '2024-08-02 03:58:05'),
('8e0574f7-8fd4-4dc1-b8ba-3da93a084151', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK DAN SKD 2', NULL, 1, '2024-08-02 03:58:50', '2024-08-02 03:58:50'),
('bd4cc2e3-34fe-4998-8bd5-bc15520a3daf', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT SKD 3', NULL, 1, '2024-08-02 03:58:21', '2024-08-02 03:58:21'),
('d8b0e46d-7dc0-4956-8831-9c131d0d71c8', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK 1', NULL, 1, '2024-07-24 10:04:01', '2024-08-02 03:57:17'),
('e04417ca-c8f3-4ddd-ba08-0a7cdcc59085', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK 3', NULL, 1, '2024-07-24 10:04:15', '2024-08-02 03:57:56'),
('ef438d49-a2a4-41ba-81ec-5ff4e00354b8', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT UTBK DAN SKD 1', NULL, 1, '2024-08-02 03:58:43', '2024-08-02 03:58:43'),
('f554a65d-61dd-443f-9680-f2726bd93338', '88ccc4c0-d59c-4409-8808-f14099ddfedb', 'TRY OUT SKD 2', NULL, 1, '2024-08-02 03:58:15', '2024-08-02 03:58:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_guru_id_foreign` (`guru_id`),
  ADD KEY `absensis_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `absensi_details`
--
ALTER TABLE `absensi_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_details_absensi_id_foreign` (`absensi_id`),
  ADD KEY `absensi_details_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `absensi_gurus`
--
ALTER TABLE `absensi_gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beritas_kategori_id_foreign` (`kategori_id`),
  ADD KEY `beritas_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gurus_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indeks untuk tabel `jenis_perguruan_tinggis`
--
ALTER TABLE `jenis_perguruan_tinggis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_beritas`
--
ALTER TABLE `kategori_beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komentars_berita_id_foreign` (`berita_id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilais_tryout_id_foreign` (`tryout_id`),
  ADD KEY `nilais_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `nilais_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `program_bimbels`
--
ALTER TABLE `program_bimbels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sertifikat_perkembangans`
--
ALTER TABLE `sertifikat_perkembangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sertifikat_perkembangans_no_sertifikat_unique` (`no_sertifikat`),
  ADD KEY `sertifikat_perkembangans_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `sertifikat_tryouts`
--
ALTER TABLE `sertifikat_tryouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sertifikat_tryouts_no_sertifikat_unique` (`no_sertifikat`),
  ADD KEY `sertifikat_tryouts_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `setting_sertifikats`
--
ALTER TABLE `setting_sertifikats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `siswas_program_bimbel_id_foreign` (`program_bimbel_id`);

--
-- Indeks untuk tabel `tahun_pelajarans`
--
ALTER TABLE `tahun_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggapan_komentars`
--
ALTER TABLE `tanggapan_komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanggapan_komentars_komentar_id_foreign` (`komentar_id`),
  ADD KEY `tanggapan_komentars_author_id_foreign` (`author_id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_alumni_id_foreign` (`alumni_id`);

--
-- Indeks untuk tabel `tryouts`
--
ALTER TABLE `tryouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tryouts_tahun_pelajaran_id_foreign` (`tahun_pelajaran_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_gurus`
--
ALTER TABLE `absensi_gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `absensi_details`
--
ALTER TABLE `absensi_details`
  ADD CONSTRAINT `absensi_details_absensi_id_foreign` FOREIGN KEY (`absensi_id`) REFERENCES `absensis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_details_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD CONSTRAINT `beritas_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beritas_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_beritas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD CONSTRAINT `komentars_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilais_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilais_tryout_id_foreign` FOREIGN KEY (`tryout_id`) REFERENCES `tryouts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat_perkembangans`
--
ALTER TABLE `sertifikat_perkembangans`
  ADD CONSTRAINT `sertifikat_perkembangans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat_tryouts`
--
ALTER TABLE `sertifikat_tryouts`
  ADD CONSTRAINT `sertifikat_tryouts_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswas_program_bimbel_id_foreign` FOREIGN KEY (`program_bimbel_id`) REFERENCES `program_bimbels` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan_komentars`
--
ALTER TABLE `tanggapan_komentars`
  ADD CONSTRAINT `tanggapan_komentars_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_komentars_komentar_id_foreign` FOREIGN KEY (`komentar_id`) REFERENCES `komentars` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `alumnis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tryouts`
--
ALTER TABLE `tryouts`
  ADD CONSTRAINT `tryouts_tahun_pelajaran_id_foreign` FOREIGN KEY (`tahun_pelajaran_id`) REFERENCES `tahun_pelajarans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
